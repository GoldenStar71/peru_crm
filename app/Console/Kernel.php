<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\CustomCommand::class,
        \App\Console\Commands\DbClearCommand::class,
        \App\Console\Commands\ProviderCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('cronjob:rides')
                ->everyMinute();

        $schedule->command('cronjob:providers')
                ->everyFiveMinutes();        
           
        $schedule->command('cronjob:demodata')
                ->weeklyOn(1, '8:00');
        $schedule->call('App\Http\Controllers\AdminController@DBbackUp')->everyMinute();                
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
