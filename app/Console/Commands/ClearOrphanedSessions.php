<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class ClearOrphanedSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sessions:clear-orphaned 
                           {--dry-run : Show what would be cleared without actually clearing}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear orphaned session IDs from users and admins tables';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        $this->info('Checking for orphaned sessions...');
        
        // Get all valid session IDs from sessions table
        $validSessions = DB::table('sessions')->pluck('id')->toArray();
        
        // Check users
        $usersWithOrphanedSessions = User::whereNotNull('active_session_id')
            ->whereNotIn('active_session_id', $validSessions)
            ->get();
            
        // Check admins
        $adminsWithOrphanedSessions = Admin::whereNotNull('active_session_id')
            ->whereNotIn('active_session_id', $validSessions)
            ->get();
        
        $totalOrphaned = $usersWithOrphanedSessions->count() + $adminsWithOrphanedSessions->count();
        
        if ($totalOrphaned === 0) {
            $this->info('✅ No orphaned sessions found!');
            return;
        }
        
        $this->warn("Found {$totalOrphaned} orphaned sessions:");
        $this->table(
            ['Type', 'Count', 'Details'],
            [
                ['Users', $usersWithOrphanedSessions->count(), $usersWithOrphanedSessions->pluck('email')->implode(', ')],
                ['Admins', $adminsWithOrphanedSessions->count(), $adminsWithOrphanedSessions->pluck('email')->implode(', ')],
            ]
        );
        
        if ($isDryRun) {
            $this->info('🔍 This was a dry run. No changes were made.');
            $this->info('Run without --dry-run to actually clear orphaned sessions.');
            return;
        }
        
        if ($this->confirm('Do you want to clear these orphaned sessions?')) {
            // Clear orphaned sessions
            $usersCleared = User::whereNotNull('active_session_id')
                ->whereNotIn('active_session_id', $validSessions)
                ->update(['active_session_id' => null]);
                
            $adminsCleared = Admin::whereNotNull('active_session_id')
                ->whereNotIn('active_session_id', $validSessions)
                ->update(['active_session_id' => null]);
            
            $this->info("✅ Cleared {$usersCleared} user sessions and {$adminsCleared} admin sessions.");
        } else {
            $this->info('Operation cancelled.');
        }
    }
}
