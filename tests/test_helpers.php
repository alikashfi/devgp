<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

function create($model, $attributes = [], $count = null): Model|Collection
{
    return resolve($model)->factory($count)->create($attributes);
}

function make($model, $attributes = [], $count = null): Model|Collection
{
    return resolve($model)->factory($count)->make($attributes);
}