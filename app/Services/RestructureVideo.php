<?php

namespace App\Services;

use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

use DB;
use App\Model\Video;

class RestructureVideo
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $con = DB::connection('mysql_old');
        $videos = $con->table('video')->get();

        $console = new ConsoleOutput();
        $progress = new ProgressBar($console, count($videos));
        $progress->setOverwrite(true);
        $progress->setRedrawFrequency(1);

        foreach ($videos as $video) 
        {
            try 
            {
                $data = [
                    'user_id' => $video->userid,
                    'category_id' => rand(1, 15),
                    'title' => $video->title,
                    'desc' => $video->description,
                    'video_path' => $video->videofile,
                    'image_path' => $video->image,
                    'tags' => $video->tags,
                    'hit' => $video->hit,
                    'slug' => $video->slug
                ];

                $fill = Video::create($data);

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
