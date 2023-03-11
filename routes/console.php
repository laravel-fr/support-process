<?php

use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('seed-users', function () {

    $pool = Process::pool(function ($pool) {
        $pool->command('php artisan db:seed');
        $pool->command('php artisan db:seed');
        $pool->command('php artisan db:seed');
        $pool->command('php artisan db:seed');
        $pool->command('php artisan db:seed');
        $pool->command('php artisan db:seed');
        $pool->command('php artisan db:seed');
        $pool->command('php artisan db:seed');
        $pool->command('php artisan db:seed');
        $pool->command('php artisan db:seed');
    })->start();

    $pool->wait();
});
