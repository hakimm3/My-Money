<?php

namespace App\Console;

use App\Models\Cron;
use App\Models\User;
use App\Exports\IncomeExport;
use App\Console\Commands\SendMail;
use App\Exports\PengeluaranExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Console\Scheduling\Schedule;
use Google\Service\AndroidManagement\Command;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\SendMail::class,
    ];

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
