@extends('admin.partials.header')

@section('title', 'Admin Dashboard')

@section('header')
    <!-- Include Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('css')
    <style>
        :root {
            --bg-body: #010314;
            --text-color: #dfe1f4;
            --font-family: "Roboto", sans-serif;
            --main-color: #a29272;
            --card-bg: rgba(162, 146, 114, 0.08);
            --card-border: rgba(162, 146, 114, 0.2);
            --gradient-accent: linear-gradient(135deg, rgba(162, 146, 114, 0.1) 0%, rgba(162, 146, 114, 0.05) 100%);
            --success-color: #4ade80;
            --warning-color: #fbbf24;
            --danger-color: #f87171;
            --info-color: #60a5fa;
            --glass-bg: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --shadow-glass: 0 8px 32px rgba(0, 0, 0, 0.3);
            --shadow-hover: 0 12px 40px rgba(162, 146, 114, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family);
            background: var(--bg-body);
            background-image:
                radial-gradient(circle at 20% 50%, rgba(162, 146, 114, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(162, 146, 114, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(162, 146, 114, 0.06) 0%, transparent 50%);
            color: var(--text-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
        }

        .dashboard-title {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--main-color), #d4c19c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 30px rgba(162, 146, 114, 0.3);
        }

        .dashboard-subtitle {
            font-size: 1.2rem;
            opacity: 0.8;
            font-weight: 300;
        }

        .grid {
            display: grid;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .grid-2 {
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        }

        .grid-3 {
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        }

        .grid-4 {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-glass);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--main-color), transparent);
            opacity: 0.5;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: var(--main-color);
        }

        .card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--card-border);
        }

        .card-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--main-color);
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: var(--main-color);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(162, 146, 114, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .stat-card:hover::after {
            left: 100%;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--main-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }

        .table-responsive {
            overflow-x: auto;
            border-radius: 12px;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .table th,
        .table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--card-border);
        }

        .table th {
            background: var(--gradient-accent);
            font-weight: 600;
            color: var(--main-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(162, 146, 114, 0.1);
            transform: scale(1.01);
        }

        .form-container {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            align-items: end;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--main-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            padding: 0.8rem 1rem;
            color: var(--text-color);
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--main-color);
            box-shadow: 0 0 0 3px rgba(162, 146, 114, 0.1);
            background: rgba(255, 255, 255, 0.08);
        }

        .btn {
            background: linear-gradient(135deg, var(--main-color), #d4c19c);
            color: var(--bg-body);
            border: none;
            border-radius: 8px;
            padding: 0.8rem 2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(162, 146, 114, 0.3);
        }

        .chart-container {
            position: relative;
            height: 400px;
            margin-top: 2rem;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            opacity: 0.6;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--main-color);
        }

        .badge {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-new {
            background: rgba(74, 222, 128, 0.2);
            color: var(--success-color);
            border: 1px solid rgba(74, 222, 128, 0.3);
        }

        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-elements::before,
        .floating-elements::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(162, 146, 114, 0.05) 0%, transparent 70%);
            animation: float 20s ease-in-out infinite;
        }

        .floating-elements::before {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-elements::after {
            bottom: 10%;
            right: 10%;
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .dashboard-title {
                font-size: 2rem;
            }

            .grid-2,
            .grid-3,
            .grid-4 {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-body);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--main-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #d4c19c;
        }

        .debug-section {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 1rem;
            margin-top: 2rem;
            font-size: 0.9rem;
        }
    </style>
@endsection

@section('content')
    <div class="floating-elements"></div>
    
    <div class="container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Admin Dashboard</h1>
            <p class="dashboard-subtitle">Monitor your application's performance and user activity </p>
        </div>

        <!-- New Requests Section -->
        <div class="grid grid-2">
            <!-- New Project Requests -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-icon">
                            <i class="fas fa-project-diagram"></i>
                        </div>
                        New Project Requests
                        <span class="badge badge-new">{{ $newProjects->count() }} New</span>
                    </div>
                </div>
                <div class="table-responsive">
                    @if ($newProjects->isNotEmpty())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newProjects as $project)
                                    <tr>
                                        <td>{{ $project->id }}</td>
                                        <td>{{ $project->full_name }}</td>
                                        <td>{{ $project->email }}</td>
                                        <td>{{ ucfirst($project->project_category) }}</td>
                                        <td>{{ ($project->created_at) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-project-diagram"></i>
                            <p>No new project requests since your last visit.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- New Contact Requests -->
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        New Contact Requests
                        <span class="badge badge-new">{{ $newContacts->count() }} New</span>
                    </div>
                </div>
                <div class="table-responsive">
                    @if ($newContacts->isNotEmpty())
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($newContacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ Str::limit($contact->message, 50) }}</td>
                                        <td>{{ ($contact->created_at)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-envelope"></i>
                            <p>No new contact us requests since your last visit.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="form-container" >
            <div class="card-header">
                <div class="card-title">
                    <div class="card-icon">
                        <i class="fas fa-filter"></i>
                    </div>
                    Filter Analytics
                </div>
            </div>
            <form method="GET" action="{{ route('admin.dashboard') }}">
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="period">Select Period</label>
                        <select name="period" id="period" class="form-control" onchange="toggleCustomDate(this)">
                            <option value="today" {{ $period == 'today' ? 'selected' : '' }}>Today</option>
                            <option value="last_7_days" {{ $period == 'last_7_days' ? 'selected' : '' }}>Last 7 Days</option>
                            <option value="last_30_days" {{ $period == 'last_30_days' ? 'selected' : '' }}>Last 30 Days</option>
                            <option value="custom" {{ $period == 'custom' ? 'selected' : '' }}>Custom Range</option>
                        </select>
                    </div>
                    <div class="form-group" id="customDateRange" style="display: {{ $period == 'custom' ? 'block' : 'none' }};">
                        <label class="form-label" for="start_date">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate->format('Y-m-d') }}">
                    </div>
                    <div class="form-group" id="customDateRange2" style="display: {{ $period == 'custom' ? 'block' : 'none' }};">
                        <label class="form-label" for="end_date">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate->format('Y-m-d') }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn">
                            <i class="fas fa-search"></i> Apply Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Analytics Section -->
        <div class="grid grid-1" id="public-views">
            <!-- Public Pages Analytics Chart -->
            <div class="card" >
                <div class="card-header">
                    <div class="card-title">
                        <div class="card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        Public Pages Analytics
                    </div>
                </div>
                @if ($publicViews->isNotEmpty())
                    <div class="chart-container">
                        <canvas id="pageAnalyticsChart"></canvas>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-chart-bar"></i>
                        <p>No data available for the selected period.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- JavaScript for toggling custom date range and chart -->
    <script>
        function toggleCustomDate(select) {
            const customDateRange = document.getElementById('customDateRange');
            const customDateRange2 = document.getElementById('customDateRange2');
            const display = select.value === 'custom' ? 'block' : 'none';
            customDateRange.style.display = display;
            customDateRange2.style.display = display;
        }

        @if ($publicViews->isNotEmpty())
            // Initialize Chart
            const ctx = document.getElementById('pageAnalyticsChart').getContext('2d');
            const pageAnalyticsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [@foreach ($publicViews as $view)'{{ ucfirst($view->url) }}', @endforeach],
                    datasets: [{
                        label: 'Total Views',
                        data: [@foreach ($publicViews as $view){{ $view->total_views }}, @endforeach],
                        backgroundColor: 'rgba(162, 146, 114, 0.3)',
                        borderColor: '#a29272',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }, {
                        label: 'Unique Visitors',
                        data: [@foreach ($publicViews as $view){{ $view->unique_visitors }}, @endforeach],
                        backgroundColor: 'rgba(162, 146, 114, 0.1)',
                        borderColor: '#d4c19c',
                        borderWidth: 1,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                color: '#dfe1f4',
                                font: {
                                    family: 'Roboto'
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(1, 3, 20, 0.9)',
                            titleFont: { family: 'Roboto' },
                            bodyFont: { family: 'Roboto' },
                            borderColor: '#a29272',
                            borderWidth: 1,
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(162, 146, 114, 0.1)',
                            },
                            ticks: {
                                color: '#dfe1f4',
                                font: { family: 'Roboto' },
                                stepSize: 1,
                            }
                        },
                        x: {
                            grid: {
                                color: 'rgba(162, 146, 114, 0.1)',
                            },
                            ticks: {
                                color: '#dfe1f4',
                                font: { family: 'Roboto' }
                            }
                        }
                    }
                }
            });
        @endif

        // Add smooth scrolling and animations
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card, .stat-card');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationDelay = Math.random() * 0.3 + 's';
                        entry.target.style.animation = 'fadeIn 0.8s ease-out forwards';
                    }
                });
            }, { threshold: 0.1 });
            cards.forEach((card) => observer.observe(card));
        });
        // Scroll to views section on page load if form was submitted
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.search.includes('period=')) {
        const viewsSection = document.getElementById('public-views');
        if (viewsSection) {
            viewsSection.scrollIntoView({ behavior: 'smooth' });
        }
    }
});
    </script>
@endsection
