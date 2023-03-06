<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        return response()->view('sitemap', [
            'groups' => Group::get(),
            'tags' => Tag::get(),
        ])->header('Content-Type', 'text/xml');
    }
}
