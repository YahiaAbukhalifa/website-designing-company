<footer class="footer">
    <div class="footer-container">
        <div class="footer-main">
            <div class="footer-brand">
                <div class="footer-logo">
                    <img src="{{ asset('assets/logo.png') }}" alt="YAHIA Design Logo">
                    <h3>YAHIA Design</h3>
                </div>
                <p class="footer-description">
                    Transforming visions into architectural masterpieces through innovative design,
                    exceptional craftsmanship, and unwavering commitment to excellence.
                </p>
                <div class="footer-social">
                    <a href="#" class="social-link" aria-label="Facebook">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" stroke="currentColor" stroke-width="2" />
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" stroke="currentColor" stroke-width="2" />
                            <path d="M17.5 6.5h.01" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="LinkedIn">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <circle cx="4" cy="4" r="2" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="footer-links">
                <div class="footer-column">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="{{ route('home') }}#services">Architectural Design</a></li>
                        <li><a href="{{ route('home') }}#services">Interior Design</a></li>
                        <li><a href="{{ route('home') }}#services">Structural Design</a></li>
                        <li><a href="{{ route('home') }}#services">Electrical Design</a></li>
                        <li><a href="{{ route('home') }}#services">Mechanical Design</a></li>
                        <li><a href="{{ route('home') }}#services">Facade Design</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Projects</h4>
                    <ul>
                        <li><a href="{{ route('portfolio', ['category' => 'residential']) }}">Residential</a></li>
                        <li><a href="{{ route('portfolio', ['category' => 'commercial']) }}">Commercial</a></li>
                        <li><a href="{{ route('portfolio', ['category' => 'interior']) }}">Interior</a></li>
                        <li><a href="{{ route('portfolio', ['category' => 'official']) }}">Official</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="{{ route('portfolio') }}">Portfolio</a></li>
                        <li><a href="{{ route('home') }}#services">Our Process</a></li>
                        <li><a href="{{ route('home') }}#contact">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Contact Info</h4>
                    <div class="contact-info">
                        <div class="contact-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="currentColor" stroke-width="2" />
                                <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2" />
                            </svg>
                            <div>
                                <span>123 Design Street</span>
                                <span>Damietta, Egypt</span>
                            </div>
                        </div>
                        <div class="contact-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"
                                    stroke="currentColor" stroke-width="2" />
                            </svg>
                            <span>+20 123 456 7890</span>
                        </div>
                        <div class="contact-item">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"
                                    stroke="currentColor" stroke-width="2" />
                                <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" />
                            </svg>
                            <span>info@YAHIAdesign.com</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p>© 2025 <a href="https://mostaql.com/u/Yahiya_Mohammed/portfolio">Yahia Abukhalifa</a>. All rights reserved.</p>
                <div class="footer-legal">
                    <a href="#">Privacy Policy</a>
                    <span class="separator">•</span>
                    <a href="#">Terms of Service</a>
                    <span class="separator">•</span>
                    <a href="#">Cookie Policy</a>
                </div>
            </div>
        </div>
        <div class="footer-bg-element footer-bg-1"></div>
        <div class="footer-bg-element footer-bg-2"></div>
    </footer>