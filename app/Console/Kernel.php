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

        $schedule->call(function () {
            $this->backup();
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

    protected function backup(){
        $title = "Backup Data";

        $users = \App\Models\User::all();
        Mail::send('emails.backup', [], function($message) use ($title, $users) {
            $message->to('hakimpbg@gmail.com')->subject($title);
            $message->from(env('MAIL_FROM_ADDRESS'), 'Backup Data');
        });
        // foreach($users as $user){
        //     if(!is_dir(storage_path('app/public/backup/'. $user->email))){
        //         mkdir(storage_path('app/public/backup/'. $user->email));
        //     }

        //     Excel::store(new IncomeExport($user->id), 'public/backup/'. $user->email .'/incomes.xlsx');
        //     Excel::store(new PengeluaranExport($user->id), 'public/backup/'. $user->email .'/pengeluaran.xlsx');

        //     Mail::send('emails.backup', [], function($message) use ($title, $user) {
        //         $message->to($user->email)->subject($title);
        //         $message->from(env('MAIL_FROM_ADDRESS'), 'Backup Data');
        //         $message->attach(storage_path('app/public/backup/'. $user->email .'/incomes.xlsx'));
        //         $message->attach(storage_path('app/public/backup/'. $user->email .'/pengeluaran.xlsx'));
        //     });
        // }
    }
}
