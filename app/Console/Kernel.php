<?php

namespace App\Console;

use App\Models\DailyIp;
use App\Models\Group;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $this->logDailyViews();
            Group::query()->update(['daily_views' => 0]);
        })->daily();

        $schedule->call(function () {
            DailyIp::truncate();
        })->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    public function logDailyViews()
    {
        $yesterday = now()->subDay()->format('Y-m-d');
        foreach (Group::select(['id', 'daily_views'])->get() as $group) {
            $group->dailyViews()->create(['views' => $group->daily_views, 'date' => $yesterday]);
        }
    }
}
