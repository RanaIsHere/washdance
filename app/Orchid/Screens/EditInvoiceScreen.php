<?php

namespace App\Orchid\Screens;

use App\Models\Transactions;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
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
            Button::make('Delete')->icon('trash')->method('deleteInvoice'),
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
                Layout::view('invoice')
            ])
        ];
    }

    public function deleteInvoice(Request $request)
    {
        //
    }

    public function updateInvoice(Request $request)
    {
        //
    }
}
