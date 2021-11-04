<?php

namespace App\Orchid\Screens;

use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class OutletsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Outlets';
    public $description = 'A dashboard on managing outlets (stores) all over the world.';

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
            Button::make('Register Outlet')->icon('paper-plane')->method('registerOutlet')
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
                Input::make('outlet_name')->title('Outlet Name')->required()->placeholder('The name of the store'),
                Input::make('outlet_address')->title('Outlet Street Address')->required()->placeholder('The address of the store'),
                Input::make('outlet_phone')->title('Outlet Private Phone Number')->required()->placeholder('The phone number of the store'),
                Select::make('outlet_status')
                    ->options([
                        'CLOSED' => 'CLOSED',
                        'BANKRUPT' => 'BANKRUPT',
                        'ACTIVE' => 'ACTIVE'
                    ])
                    ->title('Outlet Status')
                    ->required()
                    ->placeholder('The status of the store')
            ])
        ];
    }

    public function registerOutlet(Request $request)
    {
        $validatedData = $request->validate([
            'outlet_name' => ['required'],
            'outlet_address' => ['required'],
            'outlet_phone' => ['required'],
            'outlet_status' => ['required']
        ]);

        dd($validatedData);
    }
}
