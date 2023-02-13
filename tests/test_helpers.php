<?php

function create($model, $attributes = [], $count = null)
{
    return resolve($model)->factory($count)->create($attributes);
}

function make($model, $attributes = [], $count = null)
{
    return resolve($model)->factory($count)->make($attributes);
}