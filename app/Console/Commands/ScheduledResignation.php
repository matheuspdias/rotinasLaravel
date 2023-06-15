<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class ScheduledResignation extends Command
{   /*
        para criar comandos php artisan make:command NomeCommand 
    * */
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scheduled-resignation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inativa e apaga os usuários com demissões agendadas';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::now()->format('Y-m-d');

        User::where('scheduled_resignation', '<=', $today)
            ->where('active', '1')
            ->whereNull('deleted_at')
            ->update(['deleted_at' => $today, 'active' => 0]);
    }
}
