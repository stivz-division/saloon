<?php

namespace App\Nova;

use App\Domain\Enum\PromocodeType;
use App\Nova\Actions\Promocode\GeneratePromocode;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Promocode extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Promocode>
     */
    public static $model = \App\Models\Promocode::class;

    /**
     * The single value that should be used to represent the resource when
     * being displayed.
     *
     * @var string
     */
    public static $title = 'code';

    public static $group = 'Акции';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search
        = [
            'id', 'code',
        ];

    public static $with
        = [
            'user',
        ];

    public static function label()
    {
        return 'Промокоды';
    }

    public static function singularLabel()
    {
        return 'Промокод';
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

            Select::make('Тип', 'type')->options([
                PromocodeType::ClientAdvertisement->value       => PromocodeType::ClientAdvertisement->value,
                PromocodeType::MasterClientAdvertisement->value => PromocodeType::MasterClientAdvertisement->value,
                PromocodeType::MasterSubscription->value        => PromocodeType::MasterSubscription->value,
            ])->required(),

            Text::make('Промокод', 'code')
                ->sortable()
                ->required()
                ->rules('required'),

            Boolean::make('Активен', 'is_active')
                ->default(false),

            Panel::make('Кто применил', [
                Boolean::make('Использован', 'is_used')
                    ->readonly()
                    ->sortable()
                    ->filterable()
                    ->default(false),

                BelongsTo::make('Кто использовал', 'user', User::class)
                    ->sortable()
                    ->readonly()
                    ->searchable()
                    ->filterable()
                    ->nullable(),

                DateTime::make('Когда использован', 'used_at')
                    ->readonly()
                    ->nullable()
                    ->default(null),
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
        return [
        ];
    }

}
