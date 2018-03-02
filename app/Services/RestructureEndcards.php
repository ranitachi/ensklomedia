<?php

namespace App\Services;

use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

use DB;
use App\Model\Video;
use App\Model\Endcards;

class RestructureEndcards
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
                $videoid = Video::where('slug', $video->slug)->first();

                if (!is_null($video->turunan1)) 
                {
                    $data = [
                        'video_id' => $videoid->id,
                        'title' => NULL,
                        'link' => $video->turunan1
                    ];

                    $fill = Endcards::create($data);
                } 
                
                if(!is_null($video->turunan2))
                {
                    $data = [
                        'video_id' => $videoid->id,
                        'title' => NULL,
                        'link' => $video->turunan2
                    ];

                    $fill = Endcards::create($data);
                }
                
                if(!is_null($video->turunan3))
                {
                    $data = [
                        'video_id' => $videoid->id,
                        'title' => NULL,
                        'link' => $video->turunan3
                    ];

                    $fill = Endcards::create($data);
                }
                
                if(!is_null($video->turunan4))
                {
                    $data = [
                        'video_id' => $videoid->id,
                        'title' => NULL,
                        'link' => $video->turunan4
                    ];

                    $fill = Endcards::create($data);
                }
                
                if(!is_null($video->turunan5))
                {
                    $data = [
                        'video_id' => $videoid->id,
                        'title' => NULL,
                        'link' => $video->turunan5
                    ];

                    $fill = Endcards::create($data);
                }

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
