<?php

namespace App\Services;

use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

use DB;
use App\Model\Profile;

class RestructureProfile
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $con = DB::connection('mysql_old');
        $profiles = $con->table('profile')->get();

        $console = new ConsoleOutput();
        $progress = new ProgressBar($console, count($profiles));
        $progress->setOverwrite(true);
        $progress->setRedrawFrequency(1);

        foreach ($profiles as $profile) 
        {
            try 
            {
                $data = [
                    'user_id' => $profile->user_id,
                    'name' => $profile->nama,
                    'channel_name' => NULL,
                    'website' => $profile->website,
                    'bio' => $profile->bio,
                    'gender' => $profile->jk,
                    'profession' => $profile->profesi,
                    'province' => $profile->provinsi,
                    'district' => $profile->kabupaten,
                    'address' => $profile->alamat,
                    'phone_number' => $profile->hp,
                    'institute' => $profile->instansi,
                    'educational_level' => $profile->jenjang,
                    'educational_level_detail' => NULL,
                    'place_of_birth' => $profile->tempatlahir,
                    'date_of_birth' => $profile->tgllahir
                ];

                $fill = Profile::create($data);

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
