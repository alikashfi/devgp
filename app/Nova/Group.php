<?php

namespace App\Nova;

use Illuminate\Http\Request;
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
    public static $search = ['id'];

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

            Text::make('Name')->rules('required', 'string', 'max:50'),

            Text::make('Slug')
                ->rules('required', 'string', 'max:30', 'regex:/^[a-zA-Z0-9\._-]{1,}$/')
                ->creationRules('unique:groups,slug')
                ->updateRules('unique:groups,slug,{{resourceId}}'),

            URL::make('Link')
                ->displayUsing(fn($link) => $request->isResourceIndexRequest() ? 'Link' : $link)
                ->rules('required', 'url', 'max:100'),

            URL::make('Support Link')
                ->displayUsing(fn($support_link) => $request->isResourceIndexRequest() ? 'Support Link' : $support_link)
                ->rules('nullable', 'url', 'max:100'),

            Trix::make('Description')
                ->rules('nullable', 'string', 'max:10000'),

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
// todo: ->showWhenPeeking() for image and members maybe
            HasMany::make('Comments')
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

    private function DailyViewsFieldName($request)
    {
        return $request->isResourceIndexRequest() ? 'Daily' : 'Daily Views';
    }
}
