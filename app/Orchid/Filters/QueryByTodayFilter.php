<?php

namespace App\Orchid\Filters;

use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateTimer;



class QueryByTodayFilter extends Filter
{
    /**
     * @var array
     */
    public $parameters = ['attended_on'];

    /**
     * @return string
     */
    public function name(): string
    {
        return '';
    }

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        dd($this->request->get('attended_on'));
        return $builder->where('attended_on', $this->request->get('attended_on'));
    }

    /**
     * @return Field[]
     */
    public function display(): array
    {
        return [
            DateTimer::make('attented_on')
                ->format('Y-m-d')
                ->value($this->request->get('attended_on'))
                ->placeholder('Search...')
                ->title('Search')
        ];
    }
}
