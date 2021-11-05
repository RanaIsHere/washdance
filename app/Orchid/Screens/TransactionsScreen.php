<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class TransactionsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Transactions';
    public $description = 'Manage customers transactions after their registration with the systems.';
    public $permissions = ['platform.modules.cashier'];

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
            Button::make('Add Transactions')->icon('paper-plane')
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
            Layout::rows([])
        ];
    }
}
