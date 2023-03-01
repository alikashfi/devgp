<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Color;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Tag extends Resource
{
    public static $priority = 2;

    public static $tableStyle = 'tight';

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Tag>
     */
    public static $model = \App\Models\Tag::class;

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
    public static $search = ['id', 'name', 'slug', 'title'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->rules('required', 'string', 'max:30')
                ->creationRules('unique:tags,name')
                ->updateRules('unique:tags,name,{{resourceId}}'),

            Text::make('Slug')
                ->rules('required', 'string', 'max:30', 'regex:/^[a-zA-Z0-9\._-]{1,}$/')
                ->creationRules('unique:tags,slug')
                ->updateRules('unique:tags,slug,{{resourceId}}'),

            Text::make('Title')->rules('nullable', 'string', 'max:50'),

            Color::make('Color')->rules('nullable', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/', 'size:7'),

            Trix::make('Description')
                ->rules('nullable', 'string', 'max:10000')
                ->alwaysShow(),

            BelongsToMany::make('Groups'),

            DateTime::make('Created At')->onlyOnDetail(),

            DateTime::make('Updated At')->onlyOnDetail(),
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
        return [];
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
}
