@extends('layouts.frontend')

@section('title', 'Home')

@section('content')
    <section class="hero" id="hero">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="text-hero">
            <h1>YAHIA Design</h1>
            <h2>YAHIA Design is a design brand that has surpassed the limits of excellence through its creativity and ideas. Harmony Architectural and Interior Design has reached the taste of its customers by presenting the art of design in its finest origins and different schools and eras</h2>
            <div class="cta-container">
                <a href="{{ route('portfolio') }}" class="cta-btn primary-btn">
                    <span>View Our Work</span>
                </a>
                <a href="{{ route('order') }}" class="cta-btn">
                    <span>Start Your Project</span>
                </a>
            </div>
        </div>
        <div class="scroll-indicator" onclick="scrollToNext()">
            <small>Scroll to explore</small>
        </div>
    </section>

    <section class="services" id="services">
        <div class="services-container">
            <div class="services-header">
                <div class="section-badge">Our Expertise</div>
                <h2 class="services-title">Engineering Excellence</h2>
                <p class="services-subtitle">Comprehensive solutions that transform visions into reality through innovative design and meticulous execution</p>
            </div>
            <div class="services-grid">
                @foreach([
                    ['id' => 'Electrical', 'title' => 'Electrical Design', 'description' => 'Advanced electrical systems design with cutting-edge technology integration, power distribution, and smart building solutions.', 'features' => ['Power Distribution Systems', 'Smart Building Integration', 'Energy Efficiency Optimization'], 'icon' => '<path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />'],
                    ['id' => 'Structural', 'title' => 'Structural Design', 'description' => 'Robust structural engineering solutions ensuring safety, durability, and optimal performance for all construction projects.', 'features' => ['Seismic Analysis & Design', 'Load Bearing Calculations', 'Advanced Material Integration'], 'icon' => '<path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />'],
                    ['id' => 'Architectural', 'title' => 'Architectural Design', 'description' => 'Innovative architectural concepts that blend functionality with aesthetic excellence, creating spaces that inspire and endure.', 'features' => ['Conceptual Design Development', '3D Visualization & Modeling', 'Sustainable Design Practices'], 'icon' => '<path d="M3 21h18M3 7v1a3 3 0 003 3h12a3 3 0 003-3V7M5 21V7h14v14" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />'],
                    ['id' => 'Projects_Management', 'title' => 'Projects Management', 'description' => 'Strategic project oversight ensuring timely delivery, budget optimization, and quality control throughout the entire project lifecycle.', 'features' => ['Timeline & Budget Management', 'Quality Assurance Protocols', 'Stakeholder Coordination'], 'icon' => '<path d="M9 11H5a2 2 0 00-2 2v7a2 2 0 002 2h4a2 2 0 002-2v-7a2 2 0 00-2-2zM19 4h-4a2 2 0 00-2 2v14a2 2 0 002 2h4a2 2 0 002-2V6a2 2 0 00-2-2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />'],
                    ['id' => 'Facade', 'title' => 'Facade Design', 'description' => 'Sophisticated facade solutions that harmonize architectural beauty with environmental performance and structural integrity.', 'features' => ['Climate-Responsive Design', 'Advanced Material Systems', 'Energy Performance Optimization'], 'icon' => '<path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />'],
                    ['id' => 'Mechanical', 'title' => 'Mechanical Design', 'description' => 'Comprehensive mechanical systems engineering including HVAC, plumbing, and fire safety systems for optimal building performance.', 'features' => ['HVAC System Design', 'Plumbing & Fire Safety', 'Energy Management Systems'], 'icon' => '<path d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />'],
                    ['id' => 'Interior', 'title' => 'Interior Design', 'description' => 'Transformative interior spaces that reflect brand identity while optimizing functionality, comfort, and user experience.', 'features' => ['Space Planning & Layout', 'Material & Finish Selection', 'Lighting Design Integration'], 'icon' => '<path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />'],
                    ['id' => 'Supervision', 'title' => 'Supervision', 'description' => 'Expert on-site supervision ensuring construction quality, safety compliance, and adherence to design specifications and standards.', 'features' => ['Construction Quality Control', 'Safety Compliance Monitoring', 'Technical Issue Resolution'], 'icon' => '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /><circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="2" />'],
                ] as $service)
                    <div class="service-card" data-category="design" id="{{ $service['id'] }}">
                        <div class="service-icon">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none">
                                {!! $service['icon'] !!}
                            </svg>
                        </div>
                        <h3>{{ $service['title'] }}</h3>
                        <p>{{ $service['description'] }}</p>
                        <ul class="service-features">
                            @foreach($service['features'] as $feature)
                                <li>{{ $feature }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            <div class="services-cta">
                <div class="cta-content">
                    <h3>Ready to Transform Your Vision?</h3>
                    <p>Let our engineering expertise bring your project to life with precision and innovation.</p>
                    <a href="{{ route('order') }}" class="cta-button">
                        <span>Start Your Project</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="latest-projects" id="projects">
    <div class="projects-container">
        <div class="projects-header">
            <div class="section-badge">Our Portfolio</div>
            <h2 class="projects-title">Latest Projects</h2>
            <p class="projects-subtitle">Discover our most recent architectural achievements showcasing innovation, creativity, and exceptional craftsmanship</p>
        </div>
        <div class="projects-grid">
            @foreach($projects as $project)
                <div class="project-card" data-category="{{ $project->project_category }}">
                    <div class="project-image">
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}" loading="lazy">
                        <div class="project-overlay">
                            <div class="project-overlay-content">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                    <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="project-content">
                        <div class="project-category {{ $project->project_category }}">{{ ucfirst($project->project_category) }}</div>
                        <h3 class="project-name">{{ $project->name }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
        <section class="stats-bar">
            <div class="stats-container">
                <div class="stat-item" data-category="interior">
                    <div class="stat-number">{{ $categoryCounts['interior'] ?? 0 }}+</div>
                    <div class="stat-label">Interior</div>
                </div>
                <div class="stat-item" data-category="commercial">
                    <div class="stat-number">{{ $categoryCounts['commercial'] ?? 0 }}+</div>
                    <div class="stat-label">Commercial</div>
                </div>
                <div class="stat-item" data-category="official">
                    <div class="stat-number">{{ $categoryCounts['official'] ?? 0 }}+</div>
                    <div class="stat-label">Official</div>
                </div>
                <div class="stat-item" data-category="residential">
                    <div class="stat-number">{{ $categoryCounts['residential'] ?? 0 }}+</div>
                    <div class="stat-label">Residential</div>
                </div>
            </div>
        </section>
    </div>
</section>
            <div class="projects-cta">
                <div class="cta-content">
                    <h3>Explore Our Complete Portfolio</h3>
                    <p>Discover more inspiring projects that showcase our commitment to architectural excellence and innovation.</p>
                    <a href="{{ route('portfolio') }}" class="cta-button">
                        <span>View All Projects</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                            <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="contact-container">
            <div class="contact-header">
                <div class="section-badge">Get In Touch</div>
                <h2 class="contact-title">Contact Us</h2>
                <p class="contact-subtitle">Ready to transform your vision into reality? Let's discuss your project and bring your architectural dreams to life</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-info-card">
                        <div class="contact-info-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="currentColor" stroke-width="2" />
                                <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                        <h3>Visit Our Office</h3>
                        <p>123 Design Street<br>Damietta, Egypt</p>
                    </div>
                    <div class="contact-info-card">
                        <div class="contact-info-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                <path
                                    d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72 12.84 12.84 0 00.7 2.81 2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45 12.84 12.84 0 002.81.7A2 2 0 0122 16.92z"
                                    stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                        <h3>Call Us</h3>
                        <p>+20 123 456 7890<br>Available 24/7</p>
                    </div>
                    <div class="contact-info-card">
                        <div class="contact-info-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" stroke="currentColor" stroke-width="2" />
                                <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" />
                            </svg>
                        </div>
                        <h3>Email Us</h3>
                        <p>info@YAHIAdesign.com<br>Quick response guaranteed</p>
                    </div>
                </div>
                <div class="contact-form-wrapper">
                    @if(session('success'))
<div class="alert alert-success alert-dismissible" id="successAlert">
    <span class="alert-icon">✓</span>
    <span>{{ session('success') }}</span>
</div>
@endif
                    <form class="contact-form" id="contactForm" method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                            <span class="form-focus-border"></span>
                            @error('name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                            <span class="form-focus-border"></span>
                            @error('email')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="message">Your Message</label>
                            <textarea id="message" name="message" rows="6" required></textarea>
                            <span class="form-focus-border"></span>
                            @error('message')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="submit-button">
                            <span>Send Message</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                                <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="contact-bg-element contact-bg-1"></div>
        <div class="contact-bg-element contact-bg-2"></div>
    </section>
@endsection

@section('scripts')
    <script>
        // Image popup functionality
        const projectCards = document.querySelectorAll('.project-card');
        const popup = document.createElement('div');
        popup.classList.add('image-popup');
        const closeButton = document.createElement('span');
        closeButton.classList.add('close-button');
        closeButton.innerHTML = '×';
        popup.appendChild(closeButton);
        const popupImage = document.createElement('img');
        popup.appendChild(popupImage);
        document.body.appendChild(popup);

        projectCards.forEach(card => {
            const overlay = card.querySelector('.project-overlay');
            const image = card.querySelector('.project-image img');
            overlay.addEventListener('click', () => {
                popupImage.src = image.src;
                popupImage.alt = image.alt;
                popup.style.display = 'flex';
            });
        });

        closeButton.addEventListener('click', () => {
            popup.style.display = 'none';
        });

        popup.addEventListener('click', (e) => {
            if (e.target === popup) {
                popup.style.display = 'none';
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && popup.style.display === 'flex') {
                popup.style.display = 'none';
            }
        });

        // Mouse movement effect
        document.addEventListener('mousemove', (e) => {
            const mouseX = e.clientX / window.innerWidth;
            const mouseY = e.clientY / window.innerHeight;
            const shapes = document.querySelectorAll('.shape');
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 0.02;
                const x = (mouseX - 0.5) * speed * 100;
                const y = (mouseY - 0.5) * speed * 100;
                shape.style.transform = `translate(${x}px, ${y}px)`;
            });
        });
    </script>
@endsection