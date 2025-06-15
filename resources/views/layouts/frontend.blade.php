<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('CSS/header.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/main.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/homePage.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/projects.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/order.css') }}">

    <title>YAHIA | @yield('title', 'Home')</title>
</head>
<body>
    @include('frontend.partials.header')
    @yield('content')
    @include('frontend.partials.footer')
    <script src="{{ asset('JS/script.js') }}"></script>
    @yield('scripts')
</body>
</html>