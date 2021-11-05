<?php

namespace App\Orchid\Screens;

use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
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
    // public $permissions = ['platform.modules.cashier'];

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'wd_outlets' => Outlets::all(),
            'wd_members' => Members::all(),
            'wd_packages' => Packages::all(),
            'wd_transactions' => Transactions::all(),
            'wd_transaction_details' => TransactionDetails::all()
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
            Button::make('Add Transactions')->icon('paper-plane')->method('addTransactions')
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
            Layout::columns([
                Layout::rows([
                    Select::make('outlet_id')
                        ->fromModel(Outlets::class, 'outlet_name', 'id')
                        ->title('Outlets')
                        ->required()
                        ->help("Pick the outlets that you are serving in."),

                    Select::make('member_id')
                        ->fromModel(Members::class, 'member_name', 'id')
                        ->title('Members')
                        ->required()
                        ->help("Pick the member that you are interacting with."),

                    Relation::make('package_id.')
                        ->fromModel(Packages::class, 'package_name', 'id')
                        ->multiple()
                        ->title('Packages')
                        ->required()
                        ->help("Pick the member that you are interacting with."),
                ]),

                Layout::table('wd_packages', []),

                Layout::rows([
                    Quill::make('notes')
                        ->title('Important Notes')
                        ->help("A member may have a request to the outlet, and it is your job to add that to this row. <br> Keep in mind that this is required to have some text. <br> <span class='text-danger fw-bold'> Be warned that short deadlines are not permitted. </span>")
                        ->toolbar(['text', 'color', 'list'])
                        ->value("Customer did not request anything, or their request were not allowed.")
                ])
            ])
        ];
    }

    public function addTransactions(Request $request)
    {
        $validatedData = $request->all();
        dd($validatedData);
    }
}
