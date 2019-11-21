<?php

// $route = Route::currentRouteName();
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" route="{{ $route }}">

<head>
    <title>Unlimited Cashback | Online Shopping | Shop at CU Rewards Malaysia</title>
    @include('partials.header-meta')
    @include('partials.header-style')
</head>

<body>
    <script>
        if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            document.write("<script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c08841b9d70600011a13d4d&product=sop' async='async'><\/script>");
        }
    </script>

    <div id="app">
        @yield('global-content')
        <mq-layout mq="lg" class="desktop">
            @include('partials.desktop.header')
            <div class="content-body">
                @yield('desktop-content')
            </div>
            @include('partials.desktop.footer')
        </mq-layout>
        <mq-layout :mq="['sm', 'md']" class="mobile">
            <div class="offscreen-wrapper">
                @include('partials.mobile.content-body')
                @include('partials.mobile._search')
            </div>
        </mq-layout>

        @includeWhen(!is_authenticated(), 'components.modals.register-modal')
        @includeWhen(!is_authenticated(), 'components.modals.forgot-password-modal')
        @includeWhen((!is_authenticated() && request()->session()->has('resetToken')), 'components.modals.reset-password-modal')
        @includeWhen((request()->session()->has('hasSetPin') && request()->session()->get('hasSetPin') == false), 'components.modals.pin-modal')
        @includeWhen(is_authenticated() && !has_claim_daily_reward() && !is_production(), 'components.modals.daily-reward-modal')
        @includeWhen(is_authenticated(), 'components.modals.offline-checkout-modal')
        @include('components.modals.calculator-modal')
        @stack('modal')
    </div>

    @include('partials.body-script')
    @include('components.global-scripts')
    @stack('js-end')
</body>

</html>