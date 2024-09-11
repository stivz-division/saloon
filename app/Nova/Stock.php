<?php

namespace App\Nova;

use App\Domain\Enum\StockType;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Stock extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Stock>
     */
    public static $model = \App\Models\Stock::class;

    /**
     * The single value that should be used to represent the resource when
     * being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search
        = [
            'id',
        ];

    public static $displayInNavigation = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Подписка', 'subscription', Subscription::class),

            Select::make('Тип', 'type')->options([
                StockType::Percent->value => StockType::Percent->name(),
                StockType::Price->value => StockType::Price->name(),
            ])
                ->rules('required')
                ->required(),

            Text::make('Описание', 'description')
                ->nullable(),

            Number::make('Процент скидки', 'percent')
                ->step(1)
                ->hide()
                ->dependsOn('type', function (
                    Number      $field,
                    NovaRequest $request,
                    FormData    $formData
                ) {
                    if ($formData->get('type')
                        === StockType::Percent->value
                    ) {
                        $field->show()
                            ->required()
                            ->rules('required', 'int', 'max:100', 'min:0');
                    }
                }),

            Number::make('Цена со скидкой', 'price')
                ->hide()
                ->step(0.01)
                ->dependsOn('type', function (
                    Number      $field,
                    NovaRequest $request,
                    FormData    $formData
                ) {
                    if ($formData->get('type')
                        === StockType::Price->value
                    ) {
                        $field->show()
                            ->required()
                            ->rules('required', 'numeric');
                    }
                }),

            DateTime::make('Начало акции', 'start_at')
                ->rules('required')
                ->required(),

            DateTime::make('Конец акции', 'end_at')
                ->rules('required')
                ->required(),

            Boolean::make('Активен?', 'is_active')
                ->default(false),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
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
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
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
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
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
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

}
