<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Group extends Model
{
    use HasFactory, HasSlug, FilterQueryString;

    protected $guarded = [];
    protected $filters = ['category', 'sort', 'search'];

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'group_category');
    }

    /**
     * Filter groups by "category" parameter
     *
     * @return $this
     */
    public function category($query, $value)
    {
        return Category::whereSlug($value)->first()->groups();
    }

    /**
     * Filter groups by "search" parameter
     *
     * @return $this
     */
    public function search($query, $value)
    {
        return $query->where('name', 'LIKE', "%$value%")
            ->orWhere('slug', 'LIKE', "%$value%")
            ->orWhere('description', 'LIKE', "%$value%")
            ->orWhere('address', 'LIKE', "%$value%");
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->usingLanguage('en')
            ->slugsShouldBeNoLongerThan(30);
    }
}
