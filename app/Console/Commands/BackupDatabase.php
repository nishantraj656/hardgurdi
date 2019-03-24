<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */


    protected $process;  
    protected $commanding;   
    public function __construct()
    {
        $pathofDB = "/opt/lampp/bin/";
        $pathtoBackFile = storage_path('backups/backup.sql');
        $username = env('DB_USERNAME', 'forge');
        $password = env('DB_PASSWORD', 'forge');
        $database = env('DB_DATABASE', 'forge');
        $this->commanding = $pathofDB.'mysqldump -u '.$username.' -p '.$password.' '.$database.' > '.$pathtoBackFile;
        parent::__construct();
        $this->process = new Process(sprintf($this->commanding));
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

            $this->info('The backup has been proceed successfully.'.$this->commanding);
        } catch (ProcessFailedException $exception) {
            $this->error($this->commanding.'The backup process has been failed.'.$exception);
        }
    }
}
