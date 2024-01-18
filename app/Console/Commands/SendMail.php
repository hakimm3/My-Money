<?php

namespace App\Console\Commands;

use App\Exports\IncomeExport;
use Illuminate\Console\Command;
use App\Exports\PengeluaranExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:main';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $title = "Backup Data";

        $users = \App\Models\User::all();
        dd(env('MAIL_PASSWORD'));
        foreach($users as $user){
            if(is_dir(storage_path('app/public/backup/'. $user->email))){
                $files = glob(storage_path('app/public/backup/'. $user->email .'/*'));
                foreach($files as $file){
                    if(is_file($file)){
                        unlink($file);
                    }
                }
                rmdir(storage_path('app/public/backup/'. $user->email));
            }

            Excel::store(new IncomeExport($user->id), 'public/backup/'. $user->email .'/incomes.xlsx');
            Excel::store(new PengeluaranExport($user->id), 'public/backup/'. $user->email .'/pengeluaran.xlsx');

            Mail::send('emails.backup', [], function($message) use ($title, $user) {
                $message->to($user->email)->subject($title);
                $message->from(env('MAIL_FROM_ADDRESS'), 'Backup Data');
                $message->attach(storage_path('app/public/backup/'. $user->email .'/incomes.xlsx'));
                $message->attach(storage_path('app/public/backup/'. $user->email .'/pengeluaran.xlsx'));
            });
        }

    }
}
