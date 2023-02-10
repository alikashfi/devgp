<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyView extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function scopeAlreadyVisited($query, Group $group)
    {
        return $query->whereGroupId($group->id)->whereIp(request()->ip())->exists();
    }
}
