<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = resolve('App\Services\RestructureUsers');
        // $user->run();

        // $video = resolve('App\Services\RestructureVideo');
        // $video->run();

        // $category = resolve('App\Services\RestructureCategory');
        // $category->run();

        // $profile = resolve('App\Services\RestructureProfile');
        // $profile->run();

        $endcards = resolve('App\Services\RestructureEndcards');
        $endcards->run();
    }
}
