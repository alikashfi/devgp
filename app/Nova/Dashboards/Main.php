<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\CommentsPerDay;
use App\Nova\Metrics\GroupsPerDay;
use App\Nova\Metrics\TodayComments;
use App\Nova\Metrics\TodayGroups;
use App\Nova\Metrics\TodayViews;
use App\Nova\Metrics\ViewsPerDay;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            // new Help,
            (new ViewsPerDay)->width('3/4'),
            (new TodayViews)->width('1/4')->icon('eye'),
            (new TodayGroups)->width('1/4')->icon('plus'),
            (new GroupsPerDay)->width('3/4'),
            (new CommentsPerDay)->width('3/4'),
            (new TodayComments)->width('1/4')->icon('chat-alt'),
        ];
    }
}
