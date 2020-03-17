<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Repositories\MailRepository;

class DailyReportMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:reportmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily Mail Report at 12:00 AM';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();


    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mailRepository = new MailRepository();
        $mailRepository->DailyReportMail();
        echo "Mail Send Successfully";
    }
}
