<?php

namespace App\Orchid\Screens;

use App\Models\Outlets;
use App\Models\Packages;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Alert;

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
        return [
            Button::make('Register Packages')->icon('paper-plane')->method('registerPackages')
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
                Relation::make('outlet_id')->title('Outlet ID')->required()->placeholder('Outlet ID')->fromModel(Outlets::class, 'outlet_name', 'id'),
                Select::make('package_type')
                    ->options(config('enums.package_type'))
                    ->title('Package Types')
                    ->required(),
                Input::make('package_name')->title('Package Name')->required()->placeholder('Super Cleaner 1000 Standard'),
                Input::make('package_price')->title('Package Price')
                    ->mask([
                        'alias' => 'currency',
                        'prefix' => 'Rp. ',
                        'groupSeparator' => ',',
                        'digitsOptional' => true,
                        'numericInput' => true
                    ])
                    ->required()
            ])
        ];
    }

    public function registerPackages(Request $request)
    {
        $validatedData = $request->validate([
            'outlet_id' => ['required'],
            'package_type' => ['required'],
            'package_name' => ['required'],
            'package_price' => ['required']
        ]);

        $package_price = str_replace(['Rp.', '.', ',', ' '], "", $validatedData['package_price']);

        $packages = new Packages;

        $packages->outlet_id = $validatedData['outlet_id'];
        $packages->package_type = $validatedData['package_type'];
        $packages->package_name = $validatedData['package_name'];
        $packages->package_price = (int)$package_price;

        if ($packages->save()) {
            Alert::success("Package succesfully registered.");
        } else {
            Alert::error("Package cannot be registered.");
        }
    }
}
