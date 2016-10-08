<!DOCTYPE html>
<html>
    <head>
        <title>{{ isset($title) ? $title : 'My Cool Website'}}</title>
        <style>
            body {
                font-family:cursive;
            }
        </style>
        @yield('stylesheets')
    </head>
    <body>
    @yield('content')

    @yield('scripts')
    </body>
</html>