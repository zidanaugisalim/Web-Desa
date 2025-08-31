<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Stunting;
use App\Models\User;

class FixStuntingsUserData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fix-stuntings-user-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix stuntings records that have null user_id';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for stuntings records without user_id...');
        
        // Find stuntings records with null user_id
        $stuntingsWithoutUser = Stunting::whereNull('user_id')->get();
        
        if ($stuntingsWithoutUser->isEmpty()) {
            $this->info('No stuntings records found without user_id.');
            return;
        }
        
        $this->info("Found {$stuntingsWithoutUser->count()} stuntings records without user_id.");
        
        // Get the first available user
        $firstUser = User::first();
        
        if (!$firstUser) {
            $this->error('No users found in the database. Cannot fix stuntings records.');
            return;
        }
        
        $this->info("Assigning all records to user: {$firstUser->name} (ID: {$firstUser->id})");
        
        // Update all records without user_id
        $updated = Stunting::whereNull('user_id')->update(['user_id' => $firstUser->id]);
        
        $this->info("Successfully updated {$updated} stuntings records.");
    }
}
