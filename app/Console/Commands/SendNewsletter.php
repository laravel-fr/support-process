<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send-newsletter {--ids=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Launch users newsletters.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $ids = $this->option('ids');

        $userIds = explode(',', $ids);
 
        foreach($userIds as $id) {
            // launch newsletters
        }
    }
}
