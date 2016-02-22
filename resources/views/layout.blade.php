<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0, shrink-to-fit=no">
        <meta name="description" content="@yield('pageDescription')">
        <title>@yield('pageTitle') | Docs</title>
    </head>
    <body>
        @include('v3._partials.menu')

        @yield('content')
    </body>
</html>
