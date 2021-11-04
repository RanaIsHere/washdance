<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Reports')
                ->icon('monitor')
                ->route('platform.example')
                ->title('Admin')
                ->badge(function () {
                    return 6;
                }),

            Menu::make('Administration')
                ->icon('heart')
                ->list([
                    Menu::make('Outlet Registration')->route('platform.outlets')->icon('bag'),
                    Menu::make('Package Registration')->route('platform.packages')->icon('bag'),
                    Menu::make('Memberships')->route('platform.memberships')->icon('bag'),
                    Menu::make(__('Users'))->icon('user')->route('platform.systems.users')->permission('platform.systems.users')
                ]),

            Menu::make('Member Registration')
                ->title('Cashier')
                ->icon('note')
                ->route('platform.members'),

            Menu::make('Transactions')
                ->icon('briefcase')
                ->route('platform.example.advanced'),

            Menu::make('Invoices')
                ->icon('list')
                ->route('platform.example.editors'),

            Menu::make('Company Overview')
                ->title('Overview')
                ->icon('layers')
                ->route('platform.example.layouts'),

            Menu::make('Company Chart')
                ->icon('bar-chart')
                ->route('platform.example.charts'),

            Menu::make('Blog')
                ->icon('grid')
                ->route('platform.example.cards')
                ->divider(),

            // Menu::make('Documentation')
            //     ->title('Docs')
            //     ->icon('docs')
            //     ->url('https://orchid.software/en/docs'),

            // Menu::make('Changelog')
            //     ->icon('shuffle')
            //     ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
            //     ->target('_blank')
            //     ->badge(function () {
            //         return Dashboard::version();
            //     }, Color::DARK()),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles')
                ->title(__('Access rights'))
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make('Profile')
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
