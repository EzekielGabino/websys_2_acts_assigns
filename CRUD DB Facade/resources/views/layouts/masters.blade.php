<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Home Page')</title>
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
</head>
<body>
    @include('partials.header')
    <div>
        @yield('content')
    </div>
    @include('partials.footer')

    @stack('scripts')
</body>
</html>