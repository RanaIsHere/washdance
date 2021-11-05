<?php

namespace App\Orchid\Screens;

use App\Models\Members;
use App\Orchid\Filters\PackageFilter;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class MembershipsScreen extends Screen
{
    public $member;

    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Memberships';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'wd_members' => Members::filters()->paginate()
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
            Layout::table('wd_members', [
                TD::make('id', 'ID')->render(
                    function (Members $members) {
                        return $members->id;
                    }
                ),
                TD::make('member_name', 'MEMBER NAME')->filter(Input::make())->render(
                    function (Members $members) {
                        return $members->member_name;
                    }
                ),
                TD::make('member_address', 'MEMBER ADDRESS')->render(
                    function (Members $members) {
                        return $members->member_address;
                    }
                ),
                TD::make('member_phone', 'MEMBER PHONE')->filter(Input::make())->render(
                    function (Members $members) {
                        return $members->member_phone;
                    }
                ),
                TD::make('gender', 'GENDER')->filter(Input::make())->render(
                    function (Members $members) {
                        return $members->gender;
                    }
                ),
                TD::make('edit', 'ACTIONS')->render(
                    function (Members $members) {
                        return Link::make('Edit')->class('btn btn-primary')->route('platform.membership', $members);
                    }
                )
            ]),
        ];
    }
}
