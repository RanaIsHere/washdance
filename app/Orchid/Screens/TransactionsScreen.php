<?php

namespace App\Orchid\Screens;

use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use App\Models\User;
use App\Notifications\TransactionFailed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Matrix;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
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
            'wd_transaction_details' => TransactionDetails::all(),
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
                Layout::view('topTransactionsHeader')
            ]),

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
                    Select::make('transaction_discount')
                        ->options([
                            0 => 'No Discount',
                            0.10 => '10% Discount',
                            0.20 => '20% Discount',
                            0.30 => '30% Discount'
                        ])
                        ->title('Discount')
                        ->required()
                        ->help('Discounts are good.'),

                    Quill::make('notes')
                        ->title('Important Notes')
                        ->toolbar(['text', 'color', 'list'])
                        ->help("A member may have a request to the outlet, and it is your job to add that to this row. <br> Keep in mind that this is required to have some text. <br> </span>")
                        ->value("Customer did not request anything, or their request were not allowed.")
                ]),

                Layout::rows([
                    Matrix::make('package_id')
                        ->columns([
                            'Package' => 'package_id',
                            'Quantity' => 'quantity'
                        ])
                        ->title('Packages')
                        ->fields([
                            'package_id' => Select::make('package_id')->fromModel(Packages::class, 'package_name', 'id')->required(),
                            'quantity' => Input::make()->type('number')->required()->min(1)
                        ])
                ])
            ])
        ];
    }

    public function addTransactions(Request $request)
    {
        $validatedData = $request->validate([
            'outlet_id' => ['required'],
            'member_id' => ['required'],
            'transaction_discount' => ['required'],
            'notes' => ['required'],
            'package_id' => ['required']
        ]);
        // dd($validatedData);

        $user = User::all();
        $transactions = new Transactions;

        $transactions->outlet_id = $validatedData['outlet_id'];
        $transactions->user_id = Auth::user()->id;
        $transactions->member_id = $validatedData['member_id'];
        $transactions->invoice_code = 'TCP';
        $transactions->transaction_date = now();
        $transactions->transaction_deadline = now()->addDays(4);
        $transactions->transaction_paydate = now()->addDays(5);
        $transactions->transaction_paid = 0;
        $transactions->transaction_paid_extra = 0;
        $transactions->transaction_discount = $validatedData['transaction_discount'];
        $transactions->transaction_tax = 0;
        $transactions->status = 'NEW';
        $transactions->paid_status = 'UNPAID';

        if ($transactions->save()) {
            $tax = 0;

            foreach ($validatedData['package_id'] as $i => $pkg) {
                // dump($validatedData['package_id'][$i]);

                $transaction_details = new TransactionDetails;

                $transaction_details->transaction_id = $transactions->id;
                $transaction_details->package_id = $validatedData['package_id'][$i]['package_id'];
                $transaction_details->quantity = $validatedData['package_id'][$i]['quantity'];
                $transaction_details->notes = $validatedData['notes'];

                if ($transaction_details->save()) {
                    $cash = $transaction_details->packages->package_price * (int)$validatedData['package_id'][$i]['quantity'];
                    $tax += ((2 / 100) * $cash);
                    $discountedCash = ($transactions->transaction_discount / 100) * $cash;
                    $total = ($tax + $discountedCash);

                    $transactions->invoice_code = 'TCP' . $transactions->member_id . $transactions->user_id . $transactions->id;
                    $transactions->transaction_paid = $total;
                    $transactions->transaction_paid_extra = $tax;
                    $transactions->transaction_tax = $tax;

                    if ($transactions->update()) {
                        Alert::success('Transaction\'s successful!');
                    } else {
                        Alert::warning('Transaction\'s failed!');
                        break;
                    }
                } else {
                    Alert::warning('Transaction failed! Contact your nearest administrator of your outlet for consultation with this issue!');
                    break;
                }
            }
        } else {
            Alert::warning('Transaction failed! Contact your nearest administrator of your outlet for consultation with this issue!');
            Notification::send($user, new TransactionFailed);
        }
    }
}
