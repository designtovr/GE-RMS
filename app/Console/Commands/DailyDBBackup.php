<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DailyDBBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:dbbackup';

    protected $process;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup DB Daily at 12:00 AM';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->process = new Process(sprintf(
            'mysqldump -u%s -p%s %s > %s',
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_DATABASE'),
            env('DAILY_BACKUP_PATH').'\backup.sql'
        ));
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $this->process->mustRun();

            $this->info('The backup has been proceed successfully.');
        } catch (ProcessFailedException $exception) {
            $this->error('The backup process has been failed.');
        }
        return;
        /*echo "Executing Backup Command";
        //$bk_command = 'mysqldump --user '. env('DB_USERNAME').' --password  --databases '.env('DB_DATABASE'). ' > '.env('DAILY_BACKUP_PATH').'\backup.sql';
        $bk_command = 'mysqldump --user srinivas --password Srinivas123# --databases '.env('DB_DATABASE'). ' > '.env('DAILY_BACKUP_PATH').'\backup.sql';
        //$bk_command = 'mysqldump -u root -p ge_rms_1 > C:\xampp\htdocs\ge\backup.sql';
        //echo($bk_command);
        //$status = DB::select($bk_command);
        echo $bk_command;
        shell_exec($bk_command);
        echo "\nBackup Command Executed";*/
    }
}