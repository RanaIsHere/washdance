<?php

namespace App\Orchid\Screens;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class EditInvoiceScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Invoice';
    public $description = 'Edit the information entered by cashiers, and customers to the invoices.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Transactions $transaction): array
    {
        return [
            'transaction' => $transaction,
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
            Button::make('Update')->icon('paper-plane')->method('updateInvoice')
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
                Layout::view('invoiceHeader')
            ]),

            Layout::columns([
                Layout::view('invoiceBody')
            ]),

            Layout::columns([
                Layout::rows([
                    Select::make('transaction.paid_status')
                        ->options([
                            'UNPAID',
                            'PAID'
                        ])
                        ->title('The status of the payment')
                        ->required()
                        ->help('Options of PAID and UNPAID in a transaction.')
                ]),

                Layout::rows([
                    Select::make('transaction.status')
                        ->options([
                            'NEW',
                            'PROCESSING',
                            'FINISHED',
                            'PULLED'
                        ])
                        ->title('The status of the transaction process')
                        ->required()
                        ->help('Options of NEW, PROCESSING, FINISHED, and PULLED within a transactions.')
                ])
            ])
        ];
    }

    public function updateInvoice(Transactions $transaction, Request $request)
    {
        if ($transaction->fill($request->get('transaction'))->save()) {
            Alert::success('Successfully edited an invoice!');

            return redirect()->route('platform.invoices');
        } else {
            Alert::warning('Editing failure!');
        }
    }
}
