<?php

namespace App\Orchid\Screens;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class InvoiceScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Invoice';
    public $description = 'View past transactions between this outlet, and a customer.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Transactions $transaction): array
    {
        return [
            'transaction' => $transaction
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
            Button::make('Print')->icon('printer')->method('printPage')
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
                Layout::view('leftInvoice'),
                Layout::view('rightInvoice')
            ]),

            Layout::columns([
                Layout::view('invoiceBody')
            ])
        ];
    }

    public function printPage()
    {
        echo '<script type="text/javascript"> window.print() </script>';
    }
}
