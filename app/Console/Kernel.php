<?php

namespace App\Console;

use App\Models\Cron;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('send:main')->everyMinute()
        ->when(function () {
            return Cron::shouldRun('send:main', 1);
        });

        $schedule->call(function () {
           Mail::send('emails.backup', [], function($message) {
                $message->to('hakimpbg@gmail.com')->subject('Backup Data');
                $message->from(env('MAIL_FROM_ADDRESS'), 'Backup Data');
           });
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
