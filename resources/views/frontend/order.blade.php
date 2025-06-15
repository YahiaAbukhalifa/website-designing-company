@extends('layouts.frontend')

@section('title', 'Order')

@section('content')
    <section class="order" id="order">
        <div class="order-container">
            <div class="order-header">
                <div class="section-badge">Start Your Project</div>
                <h2 class="order-title">Request a Project</h2>
                <p class="order-subtitle">Complete the form below to begin your journey with YAHIA Design. Our team will review your request and get back to you promptly.</p>
            </div>
            @if(session('success'))
<div class="alert alert-success alert-dismissible" id="successAlert">
    <span class="alert-icon">✓</span>
    <span>{{ session('success') }}</span>
</div>
@endif
            <form class="order-form" id="orderForm" method="POST" action="{{ route('order.submit') }}">
                @csrf
                <!-- Progress Steps -->
                <div class="progress-steps">
                    <div class="step active" data-step="1">
                        <div class="step-circle">
                            <span class="step-number">1</span>
                        </div>
                        <span class="step-label">Contact Info</span>
                    </div>
                    <div class="step" data-step="2">
                        <div class="step-circle">
                            <span class="step-number">2</span>
                        </div>
                        <span class="step-label">Project Details</span>
                    </div>
                    <div class="step" data-step="3">
                        <div class="step-circle">
                            <span class="step-number">3</span>
                        </div>
                        <span class="step-label">Location & Area</span>
                    </div>
                    <div class="step" data-step="4">
                        <div class="step-circle">
                            <span class="step-number">4</span>
                        </div>
                        <span class="step-label">Features</span>
                    </div>
                </div>

                <!-- Form Steps -->
                <div class="form-steps">
                    <!-- Step 1: Contact Information -->
                    <div class="form-step active" data-step="1">
                        <h3 class="step-title">Contact Information</h3>
                        <div class="form-group">
                            <label for="fullName">Full Name <span class="required">*</span></label>
                            <input type="text" id="fullName" name="full_name" value="{{ old('full_name') }}" required>
                            @error('full_name')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number <span class="required">*</span></label>
                                <input type="tel" id="phoneNumber" name="phone_number" value="{{ old('phone_number') }}" required>
                                @error('phone_number')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Project Details -->
                    <div class="form-step" data-step="2">
                        <h3 class="step-title">Project Details</h3>
                        <div class="form-group">
                            <label for="projectStatus">Project Status <span class="required">*</span></label>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="planning" name="project_status" value="planning" {{ old('project_status') == 'planning' ? 'checked' : '' }}>
                                    <label for="planning">
                                        <span class="radio-custom"></span>
                                        Planning Phase
                                    </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="design" name="project_status" value="design" {{ old('project_status') == 'design' ? 'checked' : '' }}>
                                    <label for="design">
                                        <span class="radio-custom"></span>
                                        Design Phase
                                    </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="construction" name="project_status" value="construction" {{ old('project_status') == 'construction' ? 'checked' : '' }}>
                                    <label for="construction">
                                        <span class="radio-custom"></span>
                                        Ready for Construction
                                    </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="renovation" name="project_status" value="renovation" {{ old('project_status') == 'renovation' ? 'checked' : '' }}>
                                    <label for="renovation">
                                        <span class="radio-custom"></span>
                                        Renovation Project
                                    </label>
                                </div>
                            </div>
                            @error('project_status')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="projectCategory">Project Category <span class="required">*</span></label>
                            <div class="radio-group">
                                <div class="radio-option">
                                    <input type="radio" id="residential" name="project_category" value="residential" {{ old('project_category') == 'residential' ? 'checked' : '' }}>
                                    <label for="residential">
                                        <span class="radio-custom"></span>
                                        Residential
                                    </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="commercial" name="project_category" value="commercial" {{ old('project_category') == 'commercial' ? 'checked' : '' }}>
                                    <label for="commercial">
                                        <span class="radio-custom"></span>
                                        Commercial
                                    </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="villa" name="project_category" value="villa" {{ old('project_category') == 'villa' ? 'checked' : '' }}>
                                    <label for="villa">
                                        <span class="radio-custom"></span>
                                        Villa
                                    </label>
                                </div>
                                <div class="radio-option">
                                    <input type="radio" id="apartment" name="project_category" value="apartment" {{ old('project_category') == 'apartment' ? 'checked' : '' }}>
                                    <label for="apartment">
                                        <span class="radio-custom"></span>
                                        Apartment Building
                                    </label>
                                </div>
                            </div>
                            @error('project_category')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Step 3: Location & Area -->
                    <div class="form-step" data-step="3">
                        <h3 class="step-title">Location & Area Details</h3>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="city">City <span class="required">*</span></label>
                                <input type="text" id="city" name="city" value="{{ old('city') }}" required>
                                @error('city')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="district">District <span class="required">*</span></label>
                                <input type="text" id="district" name="district" value="{{ old('district') }}" required>
                                @error('district')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="landArea">Land Area (m²) <span class="required">*</span></label>
                            <input type="number" id="landArea" name="land_area" min="0" step="0.01" value="{{ old('land_area') }}" required>
                            @error('land_area')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="numberOfFlats">Number of Flats <span class="required">*</span></label>
                                <input type="number" id="numberOfFlats" name="number_of_flats" min="0" value="{{ old('number_of_flats') }}" required>
                                @error('number_of_flats')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cellarCount">Cellar Count <span class="required">*</span></label>
                                <input type="number" id="cellarCount" name="cellar_count" min="0" value="{{ old('cellar_count') }}" required>
                                @error('cellar_count')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="floorCount">Floor Count</label>
                            <input type="number" id="floorCount" name="floor_count" min="0" value="{{ old('floor_count') }}">
                            @error('floor_count')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Step 4: Features -->
                    <div class="form-step" data-step="4">
                        <h3 class="step-title">Project Features</h3>
                        <div class="features-grid">
                            <div class="checkbox-option">
                                <input type="checkbox" id="groundFloor" name="ground_floor" value="1" {{ old('ground_floor') ? 'checked' : '' }}>
                                <label for="groundFloor">
                                    <span class="checkbox-custom"></span>
                                    Ground Floor
                                </label>
                            </div>
                            <div class="checkbox-option">
                                <input type="checkbox" id="firstRound" name="first_round" value="1" {{ old('first_round') ? 'checked' : '' }}>
                                <label for="firstRound">
                                    <span class="checkbox-custom"></span>
                                    First Round
                                </label>
                            </div>
                            <div class="checkbox-option">
                                <input type="checkbox" id="upperAnnex" name="upper_annex" value="1" {{ old('upper_annex') ? 'checked' : '' }}>
                                <label for="upperAnnex">
                                    <span class="checkbox-custom"></span>
                                    Upper Annex
                                </label>
                            </div>
                            <div class="checkbox-option">
                                <input type="checkbox" id="driversRoom" name="drivers_room" value="1" {{ old('drivers_room') ? 'checked' : '' }}>
                                <label for="driversRoom">
                                    <span class="checkbox-custom"></span>
                                    Driver's Room
                                </label>
                            </div>
                            <div class="checkbox-option">
                                <input type="checkbox" id="swimmingPool" name="swimming_pool" value="1" {{ old('swimming_pool') ? 'checked' : '' }}>
                                <label for="swimmingPool">
                                    <span class="checkbox-custom"></span>
                                    Swimming Pool
                                </label>
                            </div>
                            <div class="checkbox-option">
                                <input type="checkbox" id="mensDiwaniya" name="mens_diwaniya" value="1" {{ old('mens_diwaniya') ? 'checked' : '' }}>
                                <label for="mensDiwaniya">
                                    <span class="checkbox-custom"></span>
                                    Men's Diwan
                                </label>
                            </div>
                            <div class="checkbox-option">
                                <input type="checkbox" id="womensDiwaniya" name="womens_diwaniya" value="1" {{ old('womens_diwaniya') ? 'checked' : '' }}>
                                <label for="womensDiwaniya">
                                    <span class="checkbox-custom"></span>
                                    Women's Diwan
                                </label>
                            </div>
                            <div class="checkbox-option">
                                <input type="checkbox" id="parking" name="parking" value="1" {{ old('parking') ? 'checked' : '' }}>
                                <label for="parking">
                                    <span class="checkbox-custom"></span>
                                    Parking
                                </label>
                            </div>
                            <div class="checkbox-option">
                                <input type="checkbox" id="multipleFloors" name="multiple_floors" value="1" {{ old('multiple_floors') ? 'checked' : '' }}>
                                <label for="multipleFloors">
                                    <span class="checkbox-custom"></span>
                                    Multiple Floors
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Navigation -->
                <div class="form-navigation">
                    <button type="button" class="btn btn-secondary" id="prevBtn" style="display: none;">Previous</button>
                    <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn" style="display: none;">Submit Order</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('orderForm');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');
            const steps = document.querySelectorAll('.step');
            const formSteps = document.querySelectorAll('.form-step');
            const progressLine = document.getElementById('progressLine');
            let currentStep = 1;

            function updateProgress() {
                steps.forEach((step, index) => {
                    if (index < currentStep) {
                        step.classList.add('active');
                    } else {
                        step.classList.remove('active');
                    }
                });
            }

            function showStep(step) {
                formSteps.forEach(fs => fs.classList.remove('active'));
                document.querySelector(`.form-step[data-step="${step}"]`).classList.add('active');
                prevBtn.style.display = step === 1 ? 'none' : 'inline-block';
                nextBtn.style.display = step === 4 ? 'none' : 'inline-block';
                submitBtn.style.display = step === 4 ? 'inline-block' : 'none';
                updateProgress();
            }

            function validateStep(step) {
                const inputs = document.querySelectorAll(`.form-step[data-step="${step}"] input[required]`);
                let valid = true;
                inputs.forEach(input => {
                    if (!input.value.trim()) {
                        input.classList.add('error');
                        valid = false;
                    } else {
                        input.classList.remove('error');
                    }
                });
                // Special validation for radio groups
                const radioGroups = document.querySelectorAll(`.form-step[data-step="${step}"] .radio-group`);
                radioGroups.forEach(group => {
                    const checked = group.querySelector('input[type="radio"]:checked');
                    if (!checked) {
                        group.classList.add('error');
                        valid = false;
                    } else {
                        group.classList.remove('error');
                    }
                });
                return valid;
            }

            nextBtn.addEventListener('click', () => {
                if (validateStep(currentStep)) {
                    currentStep++;
                    showStep(currentStep);
                }
            });

            prevBtn.addEventListener('click', () => {
                currentStep--;
                showStep(currentStep);
            });

            form.addEventListener('submit', (e) => {
                if (!validateStep(currentStep)) {
                    e.preventDefault();
                }
            });

            // Initialize the first step
            showStep(currentStep);
        });
    </script>
@endsection