<?php

namespace App\Orchid\Screens;

use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use App\Orchid\Layouts\salesChart;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ReportsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Reports';
    public $description = 'The reports of all transactions, ingoing and outgoing traffic between customers and cashier.';

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
            'transactions' => [Transactions::countByDays()->toChart('salesChart')]
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
            Button::make('Export')
                ->icon('printer')
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
                Layout::view('reports.reportsMetric')
            ]),

            Layout::columns([
                salesChart::class
            ])
        ];
    }
}
