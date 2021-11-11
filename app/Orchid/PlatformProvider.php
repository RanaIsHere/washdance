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
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            // Admin Permissions Required
            Menu::make('Reports')
                ->icon('monitor')
                ->route('platform.example')
                ->title('Admin')
                ->badge(function () {
                    return 6;
                })->permission('platform.systems.admin'),

            Menu::make('Administration')
                ->icon('heart')
                ->list([
                    Menu::make('Outlet Registration')->route('platform.outlets')->icon('bag')->permission('platform.systems.admin'),
                    Menu::make('Package Registration')->route('platform.packages')->icon('bag')->permission('platform.systems.admin'),
                    Menu::make('Memberships')->route('platform.memberships')->icon('bag')->permission('platform.systems.admin'),
                    Menu::make(__('Users'))
                        ->icon('user')
                        ->route('platform.systems.users')
                        ->permission('platform.systems.admin'),
                    Menu::make(__('Roles'))
                        ->icon('lock')
                        ->route('platform.systems.roles')
                        ->permission('platform.systems.admin')
                ])->permission('platform.systems.admin'),

            // Cashier Permissions Required
            Menu::make('Member Registration')
                ->title('Cashier')
                ->icon('note')
                ->route('platform.members')->permission('platform.systems.cashier'),

            Menu::make('Transactions')
                ->icon('briefcase')
                ->route('platform.transactions')->permission('platform.systems.cashier'),

            Menu::make('Invoices')
                ->icon('list')
                ->route('platform.invoices')->permission('platform.systems.cashier'),

            // Owner Permissions Required
            Menu::make('Company Overview')
                ->title('Overview')
                ->icon('layers')
                ->route('platform.example.layouts')->permission('platform.systems.owner'),

            Menu::make('Company Chart')
                ->icon('bar-chart')
                ->route('platform.example.charts')->permission('platform.systems.owner'),

            Menu::make('Blog')
                ->icon('grid')
                ->route('platform.example.cards')
                ->divider()->permission('platform.systems.owner'),

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
                // ->addPermission('platform.systems.roles', __('Roles'))
                // ->addPermission('platform.systems.users', __('Users'))
                ->addPermission('platform.systems.admin', __('Admin'))
                ->addPermission('platform.systems.cashier', __('Cashier'))
                ->addPermission('platform.systems.owner', __('Owner')),
        ];
    }
}
