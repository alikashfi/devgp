<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Group extends Model
{
    use HasFactory, HasSlug, FilterQueryString;

    protected $guarded = [];
    protected $filters = ['category', 'sort', 'search'];

    public function scopeTops($query)
    {
        return $query->orderBy('members')->orderBy('views');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'group_category');
    }

    public function dailyViews()
    {
        return $this->hasMany(DailyView::class);
    }

    public function increaseView()
    {
        $this->update(['views' => DB::raw('views + 1'), 'daily_views' => DB::raw('daily_views + 1')]);
        $this->dailyViews()->create(['ip' => request()->ip()]);
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

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
