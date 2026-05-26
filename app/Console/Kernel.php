<?php

namespace App\Console;

use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(\Illuminate\Console\Scheduling\Schedule $schedule): void
    {
        // Define scheduled commands here.
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/../routes/console.php');
    }
}
