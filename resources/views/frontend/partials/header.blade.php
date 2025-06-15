<nav>
    <header>
        <a href="{{ route('home') }}"><img src="{{ asset('assets/logo.png') }}" alt="logo"></a>
        <ul class="megaMenu">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="has-submenu">
                <a href="{{ route('portfolio') }}" aria-haspopup="true" aria-expanded="false">Projects</a>
                <ul class="submenu">
                    <li><a href="{{ route('portfolio', ['category' => 'residential']) }}">Residential</a></li>
                    <li><a href="{{ route('portfolio', ['category' => 'commercial']) }}">Commercial</a></li>
                    <li><a href="{{ route('portfolio', ['category' => 'interior']) }}">Interior</a></li>
                    <li><a href="{{ route('portfolio', ['category' => 'official']) }}">Official</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="{{ route('home') }}#services" aria-haspopup="true" aria-expanded="false">Services</a>
                <ul class="submenu">
                    <li><a onclick="location.href='./#Electrical'">Electrical Design</a></li>
                    <li><a onclick="location.href='./#Structural'">Structural Design</a></li>
                    <li><a onclick="location.href='./#Architectural'">Architectural Design</a></li>
                    <li><a onclick="location.href='./#Projects_Management'">Projects Management</a></li>
                    <li><a onclick="location.href='./#Facade'">Facade Design</a></li>
                    <li><a onclick="location.href='./#Mechanical'">Mechanical Design</a></li>
                    <li><a onclick="location.href='./#Interior'">Interior Design</a></li>
                    <li><a onclick="location.href='./#Supervision'">Supervision</a></li>
                </ul>
            </li>
            <li><a href="{{ route('order') }}">Order</a></li>
        </ul>
        <a href="{{ route('order') }}" class="contact-button">Order Now!</a>
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
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="mobile-menu-item" data-submenu="projects">
                <span class="mobile-menu-label" aria-haspopup="true" aria-expanded="false">Projects</span>
                <svg class="mobile-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <ul class="mobile-submenu" id="mobile-submenu-projects">
                    <li><a href="{{ route('portfolio', ['category' => 'residential']) }}">Residential</a></li>
                    <li><a href="{{ route('portfolio', ['category' => 'commercial']) }}">Commercial</a></li>
                    <li><a href="{{ route('portfolio', ['category' => 'interior']) }}">Interior</a></li>
                    <li><a href="{{ route('portfolio', ['category' => 'official']) }}">Official</a></li>
                </ul>
            </li>
            <li class="mobile-menu-item" data-submenu="services">
                <span class="mobile-menu-label" aria-haspopup="true" aria-expanded="false">Services</span>
                <svg class="mobile-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M9 18l6-6-6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <ul class="mobile-submenu" id="mobile-submenu-services">
                    <li><a onclick="location.href='./#Electrical'">Electrical Design</a></li>
                    <li><a onclick="location.href='./#Structural'">Structural Design</a></li>
                    <li><a onclick="location.href='./#Architectural'">Architectural Design</a></li>
                    <li><a onclick="location.href='./#Projects_Management'">Projects Management</a></li>
                    <li><a onclick="location.href='./#Facade'">Facade Design</a></li>
                    <li><a onclick="location.href='./#Mechanical'">Mechanical Design</a></li>
                    <li><a onclick="location.href='./#Interior'">Interior Design</a></li>
                    <li><a onclick="location.href='./#Supervision'">Supervision</a></li>
                </ul>
            </li>
            <li><a href="{{ route('order') }}">Order</a></li>
        </ul>
        <div class="mobile-nav-actions">
            <a class="mobile-expert-btn" href="{{ route('order') }}">Order Now!</a>
        </div>
    </div>
</div>