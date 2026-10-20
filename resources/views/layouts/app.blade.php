<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" data-theme="dark" class="k-scrollbar">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <style>[v-cloak] { display: none; }</style>
    <script>window.appLocale = "{{ app()->getLocale() }}";</script>
    @vite('resources/js/app.js')
    @stack('head')
</head>
<body>
    <div id="app" v-cloak>
        <k-layout>
            <template #sidebar>
                <k-sidebar :items="{{ Js::from($sidebarItems) }}" :module="{{ Js::from($sidebarModule) }}"></k-sidebar>
            </template>
            <template #header>
                <k-header :actions="{{ Js::from($headerActions) }}" :user="{{ Js::from($headerUser) }}">
                    <k-header-modal id="account-modal" size="md">
                        <template #header>
                            <div class="d-flex align-items-center gap-3">
                                <k-avatar who="{{ $headerUser['fullName'] }}" size="large"></k-avatar>
                                <div>
                                    <div class="b-medium-font normal-text-color">{{ $headerUser['fullName'] }}</div>
                                    <div class="b-small-font muted-text-color">{{ $headerUser['email'] }}</div>
                                </div>
                            </div>
                        </template>
                        <div class="header-content-row">
                            <div class="header-content-icon"><span class="icon-md primary-color"><k-icon name="sign-out"></k-icon></span></div>
                            <div class="header-content-content"><a class="link" href="{{ route('legacy.logout') }}">Odjava</a></div>
                        </div>
                    </k-header-modal>
                </k-header>
            </template>
            @yield('content')
        </k-layout>
    </div>
    @stack('scripts')
</body>
</html>
