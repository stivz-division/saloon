<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Subscription extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Subscription>
     */
    public static $model = \App\Models\Subscription::class;

    /**
     * The single value that should be used to represent the resource when
     * being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static $group = 'Пользователи';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search
        = [
            'id', 'name',
        ];

    public static function label()
    {
        return 'Подписки';
    }

    public static function singularLabel()
    {
        return 'Подписка';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Название', 'name')
                ->sortable()
                ->required()
                ->rules('required'),

            Number::make('Объявлений', 'advertisement_count')
                ->step(1)
                ->required()
                ->rules('required', 'min:1'),

            Number::make('Дней размещения', 'published_days')
                ->step(1)
                ->required()
                ->rules('required', 'min:1'),

            Number::make('Цена', 'price')
                ->step(1)
                ->required()
                ->rules('required'),

            Boolean::make('Активен', 'status')
                ->default(false),

            Panel::make('Акция', [
                HasOne::make('Активная акция', 'stock', Stock::class),
            ]),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     *
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
     *
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
     *
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
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

}
