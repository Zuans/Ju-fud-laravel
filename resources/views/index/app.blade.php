<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/footer_style.css') }}">
    <script src="https://kit.fontawesome.com/f40c32a411.js" crossorigin="anonymous"></script>
    <style>
        @font-face {
            font-family: balsamiq;
            src: url('/font/Balsamiq.ttf');
        }
    </style>
    @yield('style')
</head>

<body>
    @include('part.navbar')
    @yield('content')
    @include('part.footer')
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="/js/bootstrap.min.js"></script>
    @yield('script')
</body>

</html>