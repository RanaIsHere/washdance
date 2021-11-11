<?php

namespace App\Orchid\Screens;

use App\Models\TransactionDetails;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
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
                    function (Transactions $transactions) {
                        return $transactions->id;
                    }
                ),
                TD::make('outlet_id', 'OUTLET ID')->render(
                    function (Transactions $transactions) {
                        return $transactions->outlet_id;
                    }
                ),
                TD::make('invoice_code', 'INVOICE CODE')->render(
                    function (Transactions $transactions) {
                        return $transactions->invoice_code;
                    }
                ),
                TD::make('transaction_date', 'TRANSACTION DATE')->render(
                    function (Transactions $transactions) {
                        return $transactions->transaction_date;
                    }
                ),
                TD::make('paid_status', 'STATUS')->render(
                    function (Transactions $transactions) {
                        return $transactions->paid_status;
                    }
                ),
                TD::make('view', 'ACTIONS')->render(
                    function (Transactions $transactions) {
                        return Button::make('View Invoices')
                            ->class('btn btn-primary')
                            ->route('platform.invoice', $transactions);
                    }
                )
            ])
        ];
    }
}
