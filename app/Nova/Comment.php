<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Comment extends Resource
{
    public static $priority = 4;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Comment>
     */
    public static $model = \App\Models\Comment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public function subtitle()
    {
        return  \Str::limit(strip_tags($this->message), 30);
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['id', 'name', 'email', 'message'];

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

            Text::make('name')->rules('required', 'string', 'max:30'),

            Email::make('email')
                ->rules('nullable', 'email', 'max:100')
                ->displayUsing(fn($email) => $request->isResourceIndexRequest() ? 'Email' : $email),

            Trix::make('message')
                ->rules('required', 'string', 'max:10000')
                ->alwaysShow(),

            Text::make('message')
                ->onlyOnIndex()
                ->displayUsing(fn() => $this->subtitle()),

            BelongsTo::make('Group')->dontReorderAssociatables(),
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
