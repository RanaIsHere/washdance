<?php

namespace App\Orchid\Screens;

use App\Models\TransactionDetails;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class InvoicesScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Invoices';
    public $description = 'Check previous transactions in simplified form.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'wd_transaction_details' => TransactionDetails::all(),
            'wd_transactions' => Transactions::all()
        ];
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
            Layout::table('wd_transactions', [
                TD::make('id', 'ID')->render(
                    function (Transactions $transaction) {
                        return $transaction->id;
                    }
                ),
                TD::make('outlet_id', 'OUTLET ID')->render(
                    function (Transactions $transaction) {
                        return $transaction->outlet_id;
                    }
                ),
                TD::make('invoice_code', 'INVOICE CODE')->render(
                    function (Transactions $transaction) {
                        return $transaction->invoice_code;
                    }
                ),
                TD::make('transaction_date', 'TRANSACTION DATE')->render(
                    function (Transactions $transaction) {
                        return $transaction->transaction_date;
                    }
                ),
                TD::make('paid_status', 'STATUS')->render(
                    function (Transactions $transaction) {
                        return $transaction->paid_status;
                    }
                ),
                TD::make('view', 'ACTIONS')->render(
                    function (Transactions $transaction) {
                        return DropDown::make()
                            ->icon('options-vertical')
                            ->list([
                                Link::make('View Invoice')
                                    ->class('btn')
                                    ->route('platform.invoice', $transaction),
                                Link::make('Edit Invoice')
                                    ->class('btn')
                                    ->route('platform.invoice.edit', $transaction)
                            ]);
                    }
                )
            ])
        ];
    }
}
