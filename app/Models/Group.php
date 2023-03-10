<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Image;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Mehradsadeghi\FilterQueryString\FilterQueryString;

class Group extends Model
{
    use HasFactory, SoftDeletes, HasSlug, FilterQueryString;

    protected $guarded = [];
    protected $hidden = ['id', 'user_id', 'daily_views', 'deleted_at']; // just in case
    protected $filters = ['tag', 'sort', 'search'];
    protected $appends = ['image', 'diff'];
    protected $with = ['tags'];

    public function scopeTops($query)
    {
        return $query->orderBy('members')->orderBy('views');
    }

    public function scopeRelated($query, $group)
    {
        return $query->whereHas('tags', function ($q) use ($group) {
            $q->whereIn('tags.id', $group->tags()->pluck('tags.id')->toArray());
        })->whereNot('id', $group->id)->tops()->limit(min([request('limit'), 10]));
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function dailyViews()
    {
        return $this->hasMany(DailyView::class);
    }

    public function dailyIps()
    {
        return $this->hasMany(DailyIp::class);
    }

    public function getImageAttribute()
    {
        return asset((Storage::getConfig()['directory'] ?? '/images') . '/group/' . ($this->attributes['image'] ?? '../default.jpg'));
    }

    public function getDiffAttribute()
    {
        return $this->created_at?->diffForHumans();
    }

    public function increaseView()
    {
        if (DailyIp::alreadyVisited($this))
            return;
        $this->update(['views' => DB::raw('views + 1'), 'daily_views' => DB::raw('daily_views + 1')]);
        $this->dailyIps()->create(['ip' => request()->ip()]);
    }

    // Filter groups by "tag" url parameter
    public function tag($query, $value)
    {
        $values = explode(',', $value);

        return $query->whereHas('tags', function ($q) use ($values) {
            $q->whereIn('tags.slug', $values);
        });
    }

    // Filter groups by "search" url parameter
    public function search($query, $value)
    {
        return $query->where('name', 'LIKE', "%$value%")
            ->orWhere('slug', 'LIKE', "%$value%")
            ->orWhere('description', 'LIKE', "%$value%")
            ->orWhere('link', 'LIKE', "%$value%");
    }

    public function deleteImage($path = null)
    {
        $image = $path ? basename($path) : $this->getRawOriginal('image');
        return Storage::delete("group/$image");
    }

    protected function storeImage($request)
    {
        if ( ! $request->file('image'))
            return null;

        // naming
        $name = $this->generateFileName($request->slug);

        // resize and convert to jpg
        $image = Image::make($request->image)->resize(200, 200)->encode('jpg', 100);

        // store
        Storage::put("group/{$name}.jpg", $image);

        return "{$name}.jpg";
    }

    protected function generateFileName($slug)
    {
        $name = file_sanitize($slug);
        $numberedName = $name;
        $i = 2;
        while (Storage::exists("group/{$numberedName}.jpg")) {
            $numberedName = $name . $i++;
        }
        return $numberedName;
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
