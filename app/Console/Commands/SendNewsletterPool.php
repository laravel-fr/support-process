<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Process;
use Illuminate\Process\Pool;

class SendNewsletterPool extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-newsletter-pool';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Launch users newsletters simultaneously.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $chunkSize = 10_000;

        $bar = $this->output->createProgressBar(User::count() / $chunkSize);

        User::chunkById($chunkSize, function ($users) use ($bar) {
     
            $chunked = $users->chunk(2000);
     
            $command = 'php artisan send-newsletter --ids=';
     
            $pool = Process::pool(function (Pool $pool) use ($command, $chunked) {
                $pool->command($command . $chunked->get(0)->pluck('id'));
                $pool->command($command . $chunked->get(1)->pluck('id'));
                $pool->command($command . $chunked->get(2)->pluck('id'));
                $pool->command($command . $chunked->get(3)->pluck('id'));
                $pool->command($command . $chunked->get(4)->pluck('id'));
            })->start();

            while ($pool->running()->isNotEmpty()) {
                usleep(10000); // 0,01s
            }

            $bar->advance();
        });

        $bar->finish();
    }
}
