<?php

namespace App\Services;

use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Helper\ProgressBar;

use DB;
use App\Model\Users;

class RestructureUsers
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $con = DB::connection('mysql_old');
        $users = $con->table('users')->get();

        $console = new ConsoleOutput();
        $progress = new ProgressBar($console, count($users));
        $progress->setOverwrite(true);
        $progress->setRedrawFrequency(1);

        foreach ($users as $user) 
        {
            try 
            {
                $data = [
                    'email' => $user->email,
                    'password' => $user->password_hash,
                    'registration_ip' => $user->registration_ip,
                    'authentication_key' => $user->auth_key,
                    'authorization_level' => 0
                ];

                $fill = Users::create($data);

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
