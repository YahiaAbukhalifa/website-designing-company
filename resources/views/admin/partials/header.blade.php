<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    @yield('header')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('CSS/main.css') }}">
    <link rel="stylesheet" href="{{ asset('CSS/header.css') }}">
    @yield('css')

</head>

<body>
    <nav>
        <header>
            <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('assets/logo.png') }}" alt="logo"></a>
            <ul class="megaMenu">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.contact-us') }}">Contact</a></li>
                <li><a href="{{ route('admin.projects') }}">Projects</a></li>
                <li><a href="{{ route('admin.project-requests') }}">Orders</a></li>
            </ul>
            <div class="buttons">
                <a href="{{ route('admin.project-requests') }}" class="contact-button">Manage Requests</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="logout-large">
                    @csrf
                    <button type="submit" class="mobile-expert-btn logout-btn">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
            <div class="mobile-toggle" id="mobileToggle" aria-label="Toggle mobile menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </header>
    </nav>
    <div class="mobile-nav-overlay" id="mobileNavOverlay">
        <div class="mobile-nav-content">
            <ul class="mobile-nav-menu">
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.contact-us') }}">Contact</a></li>
                <li><a href="{{ route('admin.projects') }}">Projects</a></li>
                <li><a href="{{ route('admin.project-requests') }}">Orders</a></li>
            </ul>
            <div class="mobile-nav-actions">
                <a class="mobile-expert-btn" href="{{ route('admin.project-requests') }}">Manage Requests</a>
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="mobile-expert-btn logout-btn">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <script src="{{ asset('JS/script.js') }}"></script>

</body>

</html>
