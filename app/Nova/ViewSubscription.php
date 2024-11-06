<?php

namespace App\Nova;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ViewSubscription extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ViewSubscription>
     */
    public static $model = \App\Models\ViewSubscription::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
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
    public static $search = [
        'id', 'name',
    ];

    public static function label(): string
    {
        return 'Подписки';
    }

    public static function singularLabel(): string
    {
        return 'Подписка';
    }

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Название', 'name')
                ->sortable()
                ->required()
                ->rules('required'),

            Number::make('Просмотров', 'views_count')
                ->step(1)
                ->required()
                ->rules('required', 'min:1'),

            Number::make('Количество дней на просмотр', 'viewing_days')
                ->step(1)
                ->required()
                ->rules('required', 'min:1'),

            Number::make('Цена', 'price')
                ->step(1)
                ->required()
                ->rules('required'),

            Boolean::make('Активен', 'status')
                ->default(false),
        ];
    }

    /**
     * Get the cards available for the request.
     */
    public function cards(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     */
    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     */
    public function actions(NovaRequest $request): array
    {
        return [];
    }
}
