<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestDbConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:test-connection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test database connection and list tables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Test connection
            DB::connection()->getPdo();
            $this->info('Successfully connected to the database.');
            
            // Get database name
            $database = DB::connection()->getDatabaseName();
            $this->info("Database: {$database}");
            
            // List tables
            $tables = DB::select('SHOW TABLES');
            $this->info("\nTables in the database:");
            
            if (empty($tables)) {
                $this->info('No tables found in the database.');
            } else {
                foreach ($tables as $table) {
                    $tableName = $table->{"Tables_in_{$database}"};
                    $this->line("- {$tableName}");
                }
            }
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error('Could not connect to the database.');
            $this->error($e->getMessage());
            return 1;
        }
    }
}
