<?php

namespace App\Nova;

use App\Domain\Enum\AdvertisementTopTariffsType;
use App\Enums\WriteDownType;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class AdvertisementTopTariff extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\AdvertisementTopTariff>
     */
    public static $model = \App\Models\AdvertisementTopTariff::class;

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
        return 'Поднятие в ТОП';
    }

    public static function singularLabel()
    {
        return 'Поднятие в ТОП';
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

            Number::make('Период поднятия в днях', 'count_days')
                ->step(1)
                ->required()
                ->rules('required', 'min:1'),

            Select::make('Тип', 'type')
                ->onlyOnForms()
                ->options(
                    collect(AdvertisementTopTariffsType::cases())
                        ->keyBy('value')
                        ->map(fn($item) => $item->name())
                )->required(),

            Text::make('В конкретное время?', 'start_time')
                ->help('Пример: 16:49:49')
                ->hide()
                ->nullable()
                ->dependsOn('type', function (
                    Text $field,
                    NovaRequest $request,
                    FormData $formData
                ) {
                    if ($formData->get('type')
                        === AdvertisementTopTariffsType::ConcreteTime->value
                    ) {
                        $field->show()->rules('required', 'string');
                    }
                }),

            Number::make('Каждые n минут?', 'minutes')
                ->step(1)
                ->hide()
                ->nullable()
                ->dependsOn('type', function (
                    Number $field,
                    NovaRequest $request,
                    FormData $formData
                ) {
                    if ($formData->get('type')
                        === AdvertisementTopTariffsType::Minute->value
                    ) {
                        $field->show()->rules('required', 'int');
                    }
                }),

            Boolean::make('Активен?', 'status')
                ->default(true),

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
