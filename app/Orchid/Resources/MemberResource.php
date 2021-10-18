<?php

namespace App\Orchid\Resources;

use Orchid\Crud\Resource;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\TD;
use Orchid\Screen\Sight;

use App\Models\Member;

class MemberResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Member::class;

    /**
     * Get the fields displayed by the resource.
     *
     * @return array
     */
    public function fields(): array
    {
        return [
            Input::make('name')
                ->title('Nome')
                ->required()
                ->placeholder('Inserisci il nome qui.'),
            Input::make('surname')
                ->title('Cognome')
                ->required()
                ->placeholder('Inserisci il cognome qui.'),
            Input::make('fiscal_code')
                ->title('Codice Fiscale')
                ->placeholder('Inserisci il codice fiscale qui.'),
            Input::make('phone_number')
                ->title('Recapito Telefonico')
                ->required()
                ->placeholder('Inserisci il recapito telefonico qui.'),
            DateTimer::make('birth_date')
                ->title('Data di nascita')
                ->placeholder('Inserisci la data di nascita qui.'),
            Input::make('birth_place')
                ->title('Luogo di nascita')
                ->placeholder('Inserisci il luogo di nascita qui.'),
            Input::make('city')
                ->title('Residenza')
                ->placeholder('Inserisci il comune di residenza qui.'),
            Input::make('address')
                ->title('Indirizzo')
                ->placeholder('Inserisci l\'indirizzo qui.'),
            Input::make('civic_number')
                ->title('Numero civico')
                ->placeholder('Inserisci il numero civico qui.'),
        ];
    }

    /* 'name',
        'surname',
        'fiscal_code',
        'phone_number',
        'birth_date',
        'birth_place',
        'city',
        'address',
        'civic_number' */

    /**
     * Get the columns displayed by the resource.
     *
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id'),

            TD::make('name', 'Nome'),
            TD::make('surname', 'Cognome'),
            TD::make('phone_number', 'Recapito'),
        ];
    }

    /**
     * Get the sights displayed by the resource.
     *
     * @return Sight[]
     */
    public function legend(): array
    {
        return [
            Sight::make('name'),
            Sight::make('surname'),
            Sight::make('fiscal_code'),
            Sight::make('phone_number'),
            Sight::make('birth_date')
                ->render(function ($model) {
                    return $model->birth_date ? $model->birth_date->toDateString(): '';
                }),
            Sight::make('birth_place'),
            Sight::make('city'),
            Sight::make('address'),
            Sight::make('civic_number'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @return array
     */
    public function filters(): array
    {
        return [];
    }
}
