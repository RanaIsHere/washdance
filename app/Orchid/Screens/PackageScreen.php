<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Relation;

class PackageScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Packages';
    public $description = 'Register packages of an outlet';

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
            Layout::rows([
                // Relation::make('id_outlet')->title('Outlet ID')->required()->placeholder('Outlet ID')->fromModel(Packages::class),
            ])
        ];
    }
}
