<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ResetUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset user table and seed';


    /**
     * Execute the console command.
     *
     * @return mixed
     */

    public function handle()
    {
        User::truncate();
        \Artisan::call('db:seed', [ '--class' => 'UsersTableSeeder' ]);
        $this->info('User Table is migrated and seed');
    }
    
}
