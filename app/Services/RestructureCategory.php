<?php

namespace App\Services;

use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

use DB;
use App\Model\Category;

class RestructureCategory
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $con = DB::connection('mysql_old');
        $categories = $con->table('category')->get();

        $console = new ConsoleOutput();
        $progress = new ProgressBar($console, count($categories));
        $progress->setOverwrite(true);
        $progress->setRedrawFrequency(1);

        foreach ($categories as $category) 
        {
            try 
            {
                $data = [
                    'code' => $category->code,
                    'name' => $category->category
                ];

                $fill = Category::create($data);

                $progress->advance();
            } 
            catch (Exception $ex) 
            {
                $progress->clear();
                $console->writeln($ex->getMessage());
                $progress->display();
            }
        }

        $progress->finish();
        $console->writeln('');
        $console->writeln('DONE!!');
    }
}
