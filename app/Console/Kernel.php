<?php
namespace App\Console;

use App\Console\Commands\CheckDebtDueDates;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        CheckDebtDueDates::class, // Dòng này bắt buộc
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('debt:check-due-dates')->everyMinute(); // hoặc daily
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
