<?php

namespace App\Orchid\Screens\Pheature;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ToggleScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Pheature Toggles';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Feature toggles dashboard';

    /**
     * @var string
     */
    public $permission = 'platform.systems.toggles';

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
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::view('pheature'),
        ];
    }
}
