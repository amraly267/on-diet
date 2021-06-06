<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DashboardCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:dummy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load dummy data to dashboard via executing seeders';

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
     * @return int
     */
    public function handle()
    {
        \Artisan::call('migrate:fresh');
        \Artisan::call('db:seed --class=CreateSettingSeeder');
        \Artisan::call('db:seed --class=PermissionTableSeeder');
        \Artisan::call('db:seed --class=CreateAdminSeeder');
        dd('success');
        return 0;
    }
}
