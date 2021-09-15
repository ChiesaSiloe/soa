<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\TD;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Relation;
use App\Orchid\Filters\QueryByTodayFilter;


use App\Models\Service;
use App\Models\Member;

class ServiceResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Service::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            DateTimer::make('attended_on')
                ->title('Frequenta il')
                ->required()
                ->format('Y-m-d')
                ->placeholder('Inserisci la data di visita.'),
            Relation::make('member_id')
                ->fromModel(Member::class, 'name')
                ->displayAppend('display_name')
                ->title('Membro'),
        ];
    }

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),

            TD::make('membro')
                ->render(function($model) {
                    return $model->member->display_name;
                }),

            TD::make('attended_on', 'Ha frequentato il')
                ->render(function ($model) {
                    return $model->attended_on->toDateString();
                }),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [
            QueryByTodayFilter::class,
        ];
    }

    /**
     * Get relationships that should be eager loaded when performing an index query.
     *
     * @return array
     */
    public function with(): array
    {
        return ['member'];
    }
}
