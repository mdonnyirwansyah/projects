<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Navigation\MenuItem;
use Filament\Support\Colors\Color;
use Filament\Navigation\NavigationItem;
use Filament\Navigation\NavigationGroup;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use ShuvroRoy\FilamentSpatieLaravelBackup\Pages\Backups;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin;

class AppPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('app')
            ->path('app')
            ->login()
            ->passwordReset()
            ->emailVerification()
            ->profile()
            ->colors([
                'primary' => Color::Sky,
            ])
            ->sidebarCollapsibleOnDesktop()
            ->userMenuItems([
                'logout' => MenuItem::make()->label('Log Out'),
            ])
            ->navigationGroups([
                NavigationGroup::make()
                     ->label('PROJECT MANAGEMENTS'),
                NavigationGroup::make()
                     ->label('USER MANAGEMENTS'),
                NavigationGroup::make()
                    ->label('SETTINGS'),
                NavigationGroup::make()
                    ->label('CREDITS'),
            ])
            ->navigationItems([
                NavigationItem::make('Log Viewer')
                    ->url(fn(): string => route('log-viewer.index'), shouldOpenInNewTab: true)
                    ->visible(fn(): bool => auth()->user()?->hasRole('super_admin'))
                    ->icon('heroicon-o-document-text')
                    ->group('SETTINGS')
                    ->sort(2),
                NavigationItem::make('Github')
                    ->url('https://github.com/mdonnyirwansyah/projects', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-link')
                    ->group('CREDITS')
                    ->sort(1),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugin(FilamentSpatieLaravelBackupPlugin::make()
                ->usingPage(Backups::class)
                ->usingPolingInterval('10s')
            )
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            ->spa()
            ->unsavedChangesAlerts();
    }
}
