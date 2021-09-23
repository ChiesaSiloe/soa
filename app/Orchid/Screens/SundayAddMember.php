<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Actions\Button;
use Illuminate\Http\Request;

use Orchid\Support\Facades\Toast;



use App\Models\Member;
use App\Models\Service;

class SundayAddMember extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Aggiungi membro';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Aggiungi membro')
                ->icon('pencil')
                ->method('create')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                /** 
                 * DateTimer::make('attended_on')
                 *   ->title('Frequenta il')
                 *   ->required()
                 *   ->format('Y-m-d')
                 *   ->placeholder('Inserisci la data di visita.'),
                 */
                Relation::make('member_id')
                    ->fromModel(Member::class, 'name')
                    ->displayAppend('display_name')
                    ->title('Membro'),
            ])
        ];
    }

    public function create(Request $request)
    {

        // here I make sure that a member will be added one time
        // first I query the database and check for existence, then 
        // if the entry is not available I will add it as new and notify
        // otherwise I will redirect to the main page

        /*Service::with('member')->firstOrCreate([
            'attended_on' => now()->toDateString(), 
            'member_id' => $request->member_id
        ]);*/

        $service = Service::where('member_id', $request->member_id)
            ->where('attended_on', '>=', now()->toDateString())
            ->first();

        if($service) {
            Toast::warning('Membro gia aggiunto');

            return redirect(route('platform.main'));
        }


        
        Service::create([
            'attended_on' => now()->toDatetimeString(), 
            'member_id' => $request->member_id
        ]);

        Toast::success('Membro aggiunto.');
        return redirect(route('platform.main'));
        
    }
}
