<?php

namespace App\Orchid\Screens;

use App\Models\Members;
use App\Models\Outlets;
use App\Models\Packages;
use App\Models\TransactionDetails;
use App\Models\Transactions;
use App\Models\User;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class OverviewScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Company Overview';
    public $description = 'A different type of Overview within the privilege of an owner of the company.';

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
            'user' => User::all()
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
            Layout::columns([
                Layout::view('owner.overview')
            ])
        ];
    }
}
