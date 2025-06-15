@extends('layouts.frontend')

@section('title', 'Portfolio')

@section('content')

    <section class="latest-projects" id="projects">
        <div class="projects-container">
            <div class="projects-header">
                <h2 class="projects-title">Our Latest Projects</h2>
                <p class="projects-subtitle">Explore our diverse portfolio of architectural masterpieces, from
                    residential homes to commercial complexes</p>
            </div>

            <!-- Filter Buttons -->
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">All Projects</button>
                <button class="filter-btn" data-filter="residental">Residential</button>
                <button class="filter-btn" data-filter="commercial">Commercial</button>
                <button class="filter-btn" data-filter="interior">Interior</button>
                <button class="filter-btn" data-filter="official">Official</button>
            </div>

            <!-- Projects Grid -->
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

            <!-- Call to Action -->
            <div class="projects-cta">
                <h3>Ready to Start Your Project?</h3>
                <p>Let's bring your architectural vision to life</p>
                <a href="./order.html" class="cta-button">Get Started</a>
            </div>
        </div>

        <!-- Image Popup Modal -->
        <div class="image-popup" id="imagePopup">
            <span class="close-button" id="closePopup">&times;</span>
            <img id="popupImage" src="" alt="Project Image">
        </div>
    </section>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
            // Select all project cards
            const projectCards = document.querySelectorAll('.project-card');
            const filterButtons = document.querySelectorAll('.filter-btn');
            const imagePopup = document.getElementById('imagePopup');
            const popupImage = document.getElementById('popupImage');
            const closePopup = document.getElementById('closePopup');

            // Function to apply filter
            function applyFilter(filterValue) {
                // Update active button
                filterButtons.forEach(btn => {
                    btn.classList.toggle('active', btn.getAttribute('data-filter') === filterValue);
                });

                // Filter project cards
                projectCards.forEach(card => {
                    if (filterValue === 'all' || card.getAttribute('data-category') === filterValue) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeInUp 0.6s ease-out';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            // Get category from URL
            const urlParams = new URLSearchParams(window.location.search);
            const initialCategory = urlParams.get('category') || 'all';

            // Apply initial filter based on URL
            applyFilter(initialCategory);

            // Filter button click handlers
            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const filterValue = button.getAttribute('data-filter');

                    // Update URL without reloading the page
                    const newUrl = filterValue === 'all'
                        ? 'portfolio'
                        : `portfolio?category=${filterValue}`;
                    history.pushState({}, '', newUrl);

                    // Apply filter
                    applyFilter(filterValue);
                });
            });

            // Popup functionality
            const zoomIcons = document.querySelectorAll('.project-overlay-content svg');
            zoomIcons.forEach(icon => {
                icon.addEventListener('click', (e) => {
                    e.preventDefault();
                    const projectCard = icon.closest('.project-card');
                    const projectImage = projectCard.querySelector('.project-image img');
                    popupImage.src = projectImage.src;
                    imagePopup.style.display = 'flex';
                });
            });

            // Close popup handlers
            closePopup.addEventListener('click', () => {
                imagePopup.style.display = 'none';
            });

            imagePopup.addEventListener('click', (e) => {
                if (e.target === imagePopup) {
                    imagePopup.style.display = 'none';
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && imagePopup.style.display === 'flex') {
                    imagePopup.style.display = 'none';
                }
            });

            // Handle browser back/forward buttons
            window.addEventListener('popstate', () => {
                const params = new URLSearchParams(window.location.search);
                const category = params.get('category') || 'all';
                applyFilter(category);
            });
        });
    </script>
    @endsection