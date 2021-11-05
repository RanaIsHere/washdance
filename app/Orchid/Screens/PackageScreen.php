<?php

namespace App\Orchid\Screens;

use App\Models\Outlets;
use App\Models\Packages;
use App\Orchid\Filters\PackageFilter;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\TD;
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
        return [
            'wd_packages' => Packages::filters()->paginate()
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
            Layout::tabs([
                'List' => Layout::table('wd_packages', [
                    TD::make('id', 'ID')->render(
                        function (Packages $packages) {
                            return $packages->id;
                        }
                    ),
                    TD::make('outlet_id', 'OUTLET NAME')->render(
                        function (Packages $packages) {
                            return $packages->outlets->outlet_name;
                        }
                    ),
                    TD::make('package_type', 'PACKAGE TYPE')->filter(Input::make())->render(
                        function (Packages $packages) {
                            return $packages->package_type;
                        }
                    ),
                    TD::make('package_name', 'PACKAGE NAME')->filter(Input::make())->render(
                        function (Packages $packages) {
                            return $packages->package_name;
                        }
                    ),
                    TD::make('package_price', 'PACKAGE PRICE')->render(
                        function (Packages $packages) {
                            return $packages->package_price;
                        }
                    )
                ]),

                // TODO : Possible error with package selection types. Can come up empty or chosen wrong types.
                'Registration' => Layout::rows([
                    Relation::make('outlet_id')->title('Outlet ID')->required()->placeholder('Outlet ID')->fromModel(Outlets::class, 'outlet_name', 'id'),
                    Select::make('package_type')
                        ->options(config('enums.package_type'))
                        ->title('Package Types')
                        ->required(),
                    Input::make('package_name')
                        ->title('Package Name')
                        ->required()
                        ->placeholder('Super Cleaner 1000 Standard')
                        ->help('Package names has to be unique. <br> <span class="fw-bold text-danger"> A recommended format is (Package Name) (Price) (Outlet Name) </span>'),
                    Input::make('package_price')
                        ->type('number')
                        ->title('Package Price')
                        ->placeholder('Rp.')
                        ->help('This franchise only accepts IDR (Rp.)')
                        ->required()
                ])
            ]),
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

        if (Packages::where('package_name', $validatedData['package_name'])->first() != null) {
            Alert::error("Package name MUST be unique.");

            return redirect()->route('platform.packages');
        }

        $packages = new Packages;

        $packages->outlet_id = $validatedData['outlet_id'];
        $packages->package_type = $validatedData['package_type'];
        $packages->package_name = $validatedData['package_name'];
        $packages->package_price = (int)$package_price;

        if ($packages->save()) {
            Alert::success("Package succesfully registered.");
        } else {
            Alert::error("Package cannot be registered. Check registration data all over again.");
        }
    }
}
