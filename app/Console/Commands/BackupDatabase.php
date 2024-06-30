<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup the database and upload to Google Drive';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = 'backup_' . Carbon::now()->format('Y_m_d_H_i_s') . '.sql';
        $filepath = storage_path('app/' . $filename);

        // Create the database backup
        $command = sprintf('mysqldump --user=%s --password=%s --host=%s %s > %s',
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_HOST'),
            env('DB_DATABASE'),
            $filepath
        );

        $result = null;
        $output = null;
        exec($command, $output, $result);

        if ($result === 0) {
            // Upload the backup to Google Drive
            Storage::disk('google')->put($filename, file_get_contents($filepath));

            // Optionally, delete the local backup file
            unlink($filepath);

            $this->info('Database backup was successful and uploaded to Google Drive.');
        } else {
            $this->error('Failed to create database backup.');
        }

        return 0;
    }
}
