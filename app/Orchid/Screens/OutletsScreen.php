<?php

namespace App\Orchid\Screens;

use App\Models\Outlets;
use App\Models\User;
use App\Notifications\OutletsCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
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
        return [
            'wd_outlets' => Outlets::filters()->paginate()
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
            Layout::tabs([
                'List' => Layout::table('wd_outlets', [
                    TD::make('id', 'ID')->sort()->render(
                        function (Outlets $outlets) {
                            return $outlets->id;
                        }
                    ),
                    TD::make('outlet_name', 'OUTLET NAME')->filter(Input::make())->render(
                        function (Outlets $outlets) {
                            return $outlets->outlet_name;
                        }
                    ),
                    TD::make('outlet_address', 'OUTLET ADDRESS')->filter(Input::make())->render(
                        function (Outlets $outlets) {
                            return $outlets->outlet_address;
                        }
                    ),
                    TD::make('outlet_phone', 'OUTLET PHONE')->render(
                        function (Outlets $outlets) {
                            return $outlets->outlet_phone;
                        }
                    ),
                    TD::make('status', 'OUTLET STATUS')->render(
                        function (Outlets $outlets) {
                            return $outlets->status;
                        }
                    )->filter(Input::make()->datalist(['ACTIVE', 'CLOSED', 'BANKRUPT'])),
                ]),

                'Registration' => Layout::rows([
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
                ]),
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

        $outlets = new Outlets;
        $user = User::all();

        $outlets->outlet_name = $validatedData['outlet_name'];
        $outlets->outlet_address = $validatedData['outlet_address'];
        $outlets->outlet_phone = $validatedData['outlet_phone'];
        $outlets->status = $validatedData['outlet_status'];

        if ($outlets->save()) {
            Alert::success("Outlet succesfully registered.");
            Notification::send($user, new OutletsCreated);
        } else {
            Alert::error("Outlet cannot be registered.");
        }
    }
}
