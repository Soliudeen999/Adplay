<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{-- @if(config('app.env') == 'local') --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('jQuery-Smart-Wizard/styles/smart_wizard.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('jQuery-Smart-Wizard/styles/demo_style.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('js/app.js') }}" defer></script>

    {{-- @else --}}
    <link rel="stylesheet" href="{{ secure_asset('css/app.css') }}">
    <link href="{{ secure_asset('jQuery-Smart-Wizard/styles/smart_wizard.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ secure_asset('jQuery-Smart-Wizard/styles/demo_style.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ secure_asset('js/app.js') }}" defer></script>

    {{-- @endif --}}
    @yield('css')
    <!-- Scripts -->
    {{-- <script src="{{ asset('vue/js/vueApp.js') }}" defer=""></script> --}}
</head>

<body>
    @include('sweetalert::alert')
    @include('layouts.nav')
    @include('layouts.sidenav')
    <main class="content" id="app">
        {{-- TopBar --}}

        @include('layouts.topbar')
        @yield('content')
        {{-- Footer --}}
        @include('layouts.footer')
    </main>
   
    {{-- @if(config('app.env') == 'local') --}}
    <script src="{{ asset('jQuery-Smart-Wizard/js/jquery-1.4.2.min.js') }}"></script>
    <script src="{{ asset('jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>
    {{-- @else --}}
    {{-- For heroku --}}
    <script src="{{ secure_asset('jQuery-Smart-Wizard/js/jquery-1.4.2.min.js') }}"></script>
    <script src="{{ secure_asset('jQuery-Smart-Wizard/js/jquery.smartWizard.js') }}"></script>

    {{-- @endif --}}
    @yield('scripts')
</body>

</html>
