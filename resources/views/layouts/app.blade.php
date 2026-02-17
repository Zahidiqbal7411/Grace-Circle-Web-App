<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.head')
        @yield('styles')
    </head>
    <body>
        @include('layouts.header')

        <!-- Page Content -->
        @yield('content')

        @include('layouts.footer')
        @include('layouts.script')
        @yield('scripts')
    </body>
</html>
