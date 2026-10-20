<?php

namespace App\View\Composers;

use Illuminate\View\View;

final class LayoutComposer
{
    private const INSTRUCTIONS_URL = 'https://www.paragraf.rs/kancelarko/uputstvo-za-pocetak-rada-kancelarko.html';

    private const VIBER_COMMUNITY_URL = 'https://invite.viber.com/?g2=AQBjMlT5Yos8Rk0yujbyIJNI8cuKnB4BzCtbKHbsSrjM7OF%2B84RlGnsE%2BmiiPWYI';

    public function compose(View $view): void
    {
        $view->with([
            'sidebarItems' => $this->sidebarItems(),
            'sidebarModule' => ['icon' => 'contact', 'color' => 'blue-icon', 'label' => (string) config('legacy.module_label')],
            'headerActions' => $this->headerActions(),
            'headerUser' => $this->headerUser(),
        ]);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function sidebarItems(): array
    {
        $kancelarko = $this->kancelarkoUrl();
        $module = '?module_from_url='.config('legacy.module_label');

        return [
            ['icon' => 'adress-book', 'label' => 'Adresar', 'color' => 'blue-icon', 'url' => $kancelarko.'/contacts'.$module],
            [
                'icon' => 'organisation',
                'label' => 'Interna organizacija',
                'color' => 'violet-icon',
                'children' => [
                    ['label' => 'Zaposleni / angažovani', 'url' => $kancelarko.'/employees'.$module],
                    ['label' => 'Radna mesta', 'url' => $kancelarko.'/listwp'.$module],
                    ['label' => 'Organizacione jedinice', 'url' => $kancelarko.'/listou'.$module],
                    ['label' => 'Subjekti', 'url' => $kancelarko.'/offices'.$module],
                ],
            ],
            [
                'icon' => 'instructions',
                'label' => 'Uputstva',
                'color' => 'yellow-icon',
                'children' => [
                    ['label' => 'Uputstvo za elektronsko arhiviranje', 'url' => 'https://www.youtube.com/watch?v=8oaMT9Ef7RA', 'target' => '_blank'],
                    ['label' => 'Sva uputstva: e-Fakture', 'url' => self::INSTRUCTIONS_URL, 'target' => '_blank'],
                    ['label' => 'Sva uputstva: e-Delovodnik (+Arhivska knjiga)', 'url' => self::INSTRUCTIONS_URL.'#pocetak-rada-edelovodnik', 'target' => '_blank'],
                    ['label' => 'Uputstva: Kadrovik', 'url' => self::INSTRUCTIONS_URL.'#pocetak-rada-kadrovik', 'target' => '_blank'],
                    ['label' => 'Arhivska knjiga i elektronsko arhiviranje', 'url' => 'https://www.youtube.com/watch?v=OYZWDYr7FAE', 'target' => '_blank'],
                    ['label' => 'Obuka za Elektronsko Arhiviranje', 'url' => 'https://www.youtube.com/watch?v=qvGXT-OBIpU', 'target' => '_blank'],
                ],
            ],
            ['separator' => true],
            ['icon' => 'viber-logo', 'label' => 'Kancelarko Viber zajednica', 'color' => 'violet-icon', 'url' => self::VIBER_COMMUNITY_URL, 'target' => '_blank'],
        ];
    }

    /**
     * @return array<int, array<string, string>>
     */
    private function headerActions(): array
    {
        return [
            ['id' => 'kancelarko', 'icon' => 'apps', 'tooltip' => 'Kancelarko', 'href' => $this->kancelarkoUrl()],
            ['id' => 'notifications', 'icon' => 'notification', 'tooltip' => 'Obaveštenja', 'href' => route('notifications')],
        ];
    }

    /**
     * @return array{fullName: string, email: string}
     */
    private function headerUser(): array
    {
        return [
            'fullName' => trim((string) session('firstname').' '.(string) session('lastname')),
            'email' => (string) session('username'),
        ];
    }

    private function kancelarkoUrl(): string
    {
        return rtrim((string) config('legacy.kancelarko_url'), '/');
    }
}
