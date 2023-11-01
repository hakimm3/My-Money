<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cron extends Model
{
    use HasFactory;
    protected $primaryKey = 'command';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['command', 'next_run', 'last_run'];


    public static function shouldRun($command, $days)
    {
        $cron = Cron::find($command);
        $now = Carbon::now();
        if ($cron && $cron->next_run > $now->timestamp) {
            return false;
        }
        Cron::updateOrCreate(['command' => $command], ['next_run' => $now->addDay($days)->timestamp]);
        return true;
    }
}
