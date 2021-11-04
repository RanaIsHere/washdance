<?php

namespace App\Orchid\Screens;

use App\Models\Members;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class MembersScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Member Registration';
    public $description = 'A page to register members to participate in our laundromat franchise.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Register member')->icon('paper-plane')->method('registerMember')
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
                Input::make('member_name')->title('Member name')->required()->placeholder('The name of this member'),
                TextArea::make('member_address')->title('Member address')->required()->placeholder('The address of this member'),
                Input::make('member_phone')->mask('+(99) 999 9999-9999')->title('Member phone number')->required(),
                Select::make('gender')->options(['MALE' => 'MALE', 'FEMALE' => 'FEMALE'])->title('Gender')->required()
            ])
        ];
    }

    public function registerMember(Request $request)
    {
        $validatedData = $request->validate([
            'member_name' => ['required'],
            'member_address' => ['required'],
            'gender' => ['required'],
            'member_phone' => ['required']
        ]);

        $validatedData['member_phone'] = str_replace(["+", "(", ")", " ", "-"], "", $validatedData['member_phone']);

        $members = new Members;

        $members->member_name = $validatedData['member_name'];
        $members->member_address = $validatedData['member_address'];
        $members->gender = $validatedData['gender'];
        $members->member_phone = $validatedData['member_phone'];

        if ($members->save()) {
            Alert::success('Member has been successfully registered on the system.');
        } else {
            Alert::warning('Member has failed to register on the system!');
        }
    }
}
