<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
    </head>
    <body>
        @include('layouts.header')

        <!-- Page Content -->
        @yield('content')

        @include('layouts.footer')
        @include('layouts.script')
    </body>
</html>
