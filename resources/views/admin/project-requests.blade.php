@extends('admin.partials.header')

@section('title', 'Project Requests')
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

    .project-requests-container {
        width: 90%;
        margin: 20px auto;
        padding: 40px;
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

    .project-requests-container h2 {
        font-size: 3rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--main-color), #d4c19c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 2rem;
        text-shadow: 0 0 30px rgba(162, 146, 114, 0.3);
        text-align: center;
    }

    .project-requests-container h3 {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--main-color);
        margin-bottom: 1.5rem;
        margin-top: 2rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .project-requests-container h3::before {
        content: '';
        width: 4px;
        height: 30px;
        background: linear-gradient(135deg, var(--main-color), #d4c19c);
        border-radius: 2px;
    }

    .project-requests-container p {
        text-align: center;
        padding: 3rem;
        opacity: 0.8;
        font-size: 1.1rem;
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        margin-top: 2rem;
    }

    .table-responsive {
        overflow-x: auto;
        border-radius: 20px;
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        box-shadow: var(--shadow-glass);
        margin-top: 2rem;
        position: relative;
    }

    .table-responsive::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--main-color), transparent);
        opacity: 0.5;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.9rem;
    }

    table th,
    table td {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid var(--card-border);
        vertical-align: top;
    }

    table th {
        background: var(--gradient-accent);
        font-weight: 600;
        color: var(--main-color);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.8rem;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    table tbody tr {
        transition: all 0.3s ease;
    }

    table tbody tr:hover {
        background: rgba(162, 146, 114, 0.1);
        transform: scale(1.01);
    }

    table tbody tr:nth-child(even) {
        background: rgba(255, 255, 255, 0.02);
    }

    table tbody tr:nth-child(even):hover {
        background: rgba(162, 146, 114, 0.1);
    }

    table td {
        word-wrap: break-word;
        max-width: 200px;
    }

    .features-cell {
        font-size: 0.8rem;
        line-height: 1.4;
    }

    .badge {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0.1rem;
    }

    .badge-feature {
        background: rgba(162, 146, 114, 0.2);
        color: var(--main-color);
        border: 1px solid rgba(162, 146, 114, 0.3);
    }

    .status-cell {
        font-weight: 600;
        text-transform: capitalize;
        color: var(--main-color);
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
        .project-requests-container {
            width: 95%;
            padding: 20px;
        }

        .project-requests-container h2 {
            font-size: 2rem;
        }

        .project-requests-container h3 {
            font-size: 1.4rem;
        }

        table th,
        table td {
            padding: 0.8rem 0.5rem;
            font-size: 0.8rem;
        }

        table td {
            max-width: 150px;
        }
    }

    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
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
</style>
@endsection

@section('content')
    <div class="floating-elements"></div>
    <div class="project-requests-container">
        <h2>Project Requests Management</h2>
        
        <h3>Project Requests</h3>
        @if ($projectRequests->isEmpty())
            <p>No project requests found.</p>
        @else
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Land Area</th>
                            <th>City</th>
                            <th>District</th>
                            <th>Category</th>
                            <th>Flats</th>
                            <th>Cellars</th>
                            <th>Floors</th>
                            <th>Features</th>
                            <th>Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projectRequests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->full_name }}</td>
                                <td>{{ $request->phone_number }}</td>
                                <td>{{ $request->email }}</td>
                                <td class="status-cell">{{ $request->project_status }}</td>
                                <td>{{ $request->land_area }}</td>
                                <td>{{ $request->city }}</td>
                                <td>{{ $request->district }}</td>
                                <td>{{ $request->project_category }}</td>
                                <td>{{ $request->number_of_flats }}</td>
                                <td>{{ $request->cellar_count }}</td>
                                <td>{{ $request->floor_count ?? 'N/A' }}</td>
                                <td class="features-cell">
                                    @if($request->ground_floor)<span class="badge badge-feature">Ground Floor</span>@endif
                                    @if($request->first_round)<span class="badge badge-feature">First Round</span>@endif
                                    @if($request->upper_annex)<span class="badge badge-feature">Upper Annex</span>@endif
                                    @if($request->drivers_room)<span class="badge badge-feature">Driver's Room</span>@endif
                                    @if($request->swimming_pool)<span class="badge badge-feature">Swimming Pool</span>@endif
                                    @if($request->mens_diwaniya)<span class="badge badge-feature">Men's Diwaniya</span>@endif
                                    @if($request->womens_diwaniya)<span class="badge badge-feature">Women's Diwaniya</span>@endif
                                    @if($request->parking)<span class="badge badge-feature">Parking</span>@endif
                                    @if($request->multiple_floors)<span class="badge badge-feature">Multiple Floors</span>@endif
                                </td>
                                <td>{{ $request->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection