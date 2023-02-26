<?php

namespace App\Nova;

use App\Nova\Metrics\DailyViews;
use App\Nova\Metrics\ViewsPerDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Color;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;

class Group extends Resource
{
    public static $priority = 1;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Group>
     */
    public static $model = \App\Models\Group::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['id', 'name', 'slug', 'link', 'support_link', 'description'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Avatar::make('image')
                ->rules('nullable', 'image', 'max:2048')
                ->preview(fn($image) => $image)
                ->thumbnail(fn($image) => $image)
                ->disableDownload()
                ->showWhenPeeking()
                ->store(fn() => ['image' => \App\Models\Group::storeImage($request)])
                ->delete(fn($r, $model, $d, $path) => basename($path) !== 'default.jpg' ? $model->deleteImage($path) : null)
                ->prunable()
                ->acceptedTypes('image/*'),

            ID::make()
                ->sortable()
                ->showWhenPeeking(),

            Text::make('Name')
                ->rules('required', 'string', 'max:50')
                ->showWhenPeeking(),

            Text::make('Slug')
                ->rules('required', 'string', 'max:30', 'regex:/^[a-zA-Z0-9\._-]{1,}$/')
                ->creationRules('unique:groups,slug')
                ->updateRules('unique:groups,slug,{{resourceId}}'),

            URL::make('Link')
                ->rules('required', 'url', 'max:100')
                ->creationRules('unique:groups,link')
                ->updateRules('unique:groups,link,{{resourceId}}')
                ->showWhenPeeking()
                ->displayUsing(fn($link) => $request->isResourceIndexRequest() ? 'Link' : $link),

            URL::make('Support Link')
                ->rules('nullable', 'url', 'max:100')
                ->displayUsing(fn($support_link) => $request->isResourceIndexRequest() ? 'Support Link' : $support_link),

            Trix::make('Description')
                ->rules('nullable', 'string', 'max:10000')
                ->alwaysShow(),

            Number::make('Members')
                ->rules('nullable', 'integer', 'min:0', 'max:16777215')
                ->min(0)
                ->max(16777215)
                ->sortable(),

            Number::make('Views')
                ->rules('nullable', 'integer', 'min:0', 'max:16777215')
                ->sortable()
                ->exceptOnForms(),

            Number::make($this->DailyViewsFieldName($request), 'daily_views')
                ->rules('nullable', 'integer', 'min:0', 'max:65535', 'lt:views')
                ->sortable()
                ->exceptOnForms(),

            DateTime::make('Created At')->onlyOnDetail(),

            DateTime::make('Updated At')->onlyOnDetail(),

            HasMany::make('Comments'),

            BelongsToMany::make('Tags'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [
            (new ViewsPerDay)->width('full')
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    private function DailyViewsFieldName($request)
    {
        return $request->isResourceIndexRequest() ? 'Daily' : 'Daily Views';
    }
}
