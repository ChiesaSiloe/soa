<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Sight;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\SundayListTable;

use App\Models\Service;
use Orchid\Screen\Repository;

class PlatformScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'SOA';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Un portale per il servizio d\'ordine.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'services' => Service::with('member')->where('attended_on', '>=', now()->toDateString())->paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Segna frequenza')->icon('pencil')->href('/admin/add'),
            Link::make('Registra Membro')->icon('plus')->href('/admin/crud/create/member-resources')
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
            SundayListTable::class
        ];
    }
}
