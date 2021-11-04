<?php

namespace App\Orchid\Screens;

use App\Models\Members;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class MembershipScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Membership';
    public $description = 'This privilege is only available to administrators.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Members $members): array
    {
        return [
            'member' => $members
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
            Button::make('Back')->icon('back')->method('goBackRoute'),
            Button::make('Save info')->class('btn btn-primary')->icon('pencil')->method('setMember'),
            Button::make('Delete membership')->class('btn btn-danger')->method('deleteMember')
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
            Layout::rows([
                Input::make('member.member_name')
                    ->vertical()
                    ->title('Member Name')
                    ->required()
                    ->placeholder('The name of the member'),

                Input::make('member.member_address')
                    ->vertical()
                    ->title('Member Address')
                    ->required()
                    ->placeholder('The address of the member'),

                Select::make('member.gender')
                    ->options([
                        'MALE' => 'MALE',
                        'FEMALE' => 'FEMALE'
                    ])
                    ->vertical()
                    ->title('Gender')
                    ->required()
                    ->placeholder('The gender of the member'),

                Input::make('member.member_phone')
                    ->vertical()
                    ->title('Member Phone Number')
                    ->required()
                    ->placeholder('The phone number of the member'),
            ])
        ];
    }

    public function setMember(Members $members, Request $request)
    {
        if ($members->fill($request->get('member'))->save()) {
            Alert::success('Member has been set!');

            return redirect()->route('platform.memberships');
        } else {
            Alert::warning('Member failed to set!');
        }
    }

    public function deleteMember(Members $members)
    {
        if ($members->delete()) {
            Alert::warning('Successfully deleted a member of this franchise.');
            return redirect()->route('platform.memberships');
        } else {
            Alert::info('Membership cannot be deleted.');
        }
    }

    public function goBackRoute()
    {
        Alert::info('Discarded changes from editing.');
        return redirect()->route('platform.memberships');
    }
}
