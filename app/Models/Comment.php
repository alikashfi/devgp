<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Comment extends Model
{
    use HasFactory, SoftDeletes, FilterQueryString;

    protected $fillable = ['group_id', 'name', 'email', 'message'];
    protected $hidden = ['id', 'group_id', 'email', 'deleted_at']; // just in case
    protected $visible = ['name', 'message', 'created_at'];
    protected $filters = ['sort'];
    const UPDATED_AT = null;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
