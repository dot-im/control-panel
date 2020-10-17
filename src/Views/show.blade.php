<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="dns-prefetch" href="//fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        {{-- if css file exists load from file --}}
        @if(file_exists(public_path('assets/control-panel/css/control-panel.css')))
            <link rel="stylesheet" href="{{ asset('assets/control-panel/css/control-panel.css') }}">
        @else
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

            {{-- include css file content form vendor if not file exists --}}
            <style>
                {!! file_get_contents(base_path('vendor/dot-im/control-panel/src/Dist/css/control-panel.css')) !!}
            </style>
        @endif

        <title>@lang('Control Panel')</title>
    </head>
    <body>

        <div id="application">
            {{------------------------------
            | Include Control Panel Header |
            ------------------------------}}
            @include('control-panel::includes.header')

            {{-------------------------------
            | Include Control Panel Sidebar |
            -------------------------------}}
            @include('control-panel::includes.sidebar')

            <main class="container my-4" id="main" data-view></main>
        </div>

        @if(file_exists(public_path('assets/control-panel/js/control-panel.js')))
            <script src="{{ asset('assets/control-panel/js/control-panel.js') }}"></script>
        @else
            <script>
                {!! file_get_contents(base_path('vendor/dot-im/control-panel/src/Dist/js/control-panel.js'))  !!}
            </script>
        @endif

        <script>
            window.router({
                viewSelector: "data-view",
                routeSelector: "data-route",
                indexPage: "{{ config('control-panel.index-page') }}",
                axiosConfig: {
                    headers: {
                        'X-Requested-Withs': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }
            });
        </script>
    </body>
</html>
