<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Tag extends Model
{
    use HasFactory, HasSlug, FilterQueryString;

    protected $guarded = [];
    protected $hidden = ['id', 'pivot']; // just in case
    protected $filters = ['sort', 'search', 'limit'];

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    // Filter tags by "search" url parameter
    public function search($query, $value)
    {
        return $query->where('name', 'LIKE', "%$value%")
            ->orWhere('slug', 'LIKE', "%$value%");
    }

    // Limit tags by "limit" url parameter
    public function limit($query, $value)
    {
        return $query->when(
            is_numeric($value),
            fn($q) => $q->limit($value)
        );
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage('en')
            ->slugsShouldBeNoLongerThan(30);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


}
