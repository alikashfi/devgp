<?php

use App\Models\DailyIp;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class);

uses(RefreshDatabase::class);

test('it logs daily_views at 00:00', function () {
    $a = create(Group::class);
    $b = create(Group::class);

    $this->travelTo(Carbon::parse('2020-01-02 00:00'));
    $this->artisan('schedule:run');

    $this->assertDatabaseHas('daily_views', ['group_id' => $a->id, 'views' => $a->daily_views, 'date' => '2020-01-01']);
    $this->assertDatabaseHas('daily_views', ['group_id' => $b->id, 'views' => $b->daily_views, 'date' => '2020-01-01',]);

    $this->assertEquals(0, Group::sum('daily_views'));
});

test('daily_ips table truncates at 00:00', function () {
    DailyIp::create(['group_id' => create(Group::class)->id, 'ip' => '0.0.0.0']);

    $this->travelTo(Carbon::parse('2020-01-02 00:00'));
    $this->artisan('schedule:run');

    $this->assertEquals(0, DailyIp::count());
});