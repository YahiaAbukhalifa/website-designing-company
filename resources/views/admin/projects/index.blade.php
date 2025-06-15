@extends('admin.partials.header')

@section('title', 'Projects')
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
            min-height: 100vh;
        }

        .projects-container {
            max-width: 1400px;
            margin: 20px auto;
            padding: 2rem;
            animation: fadeIn 0.8s ease-out;
            position: relative;
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
            position: relative;
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

        .add-project-btn {
            position: fixed;
            top: 150px;
            right: 30px;
            background: linear-gradient(135deg, var(--main-color), #d4c19c);
            color: var(--bg-body);
            border: none;
            border-radius: 50px;
            padding: 1rem 2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.9rem;
            z-index: 1000;
            box-shadow: var(--shadow-glass);
        }

        .add-project-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(162, 146, 114, 0.3);
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1001;
            animation: fadeIn 0.3s ease-out;
        }

        .popup-overlay.active {
            display: flex;
        }

        .popup-content {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-glass);
            width: 90%;
            max-width: 500px;
            position: relative;
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .popup-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 1.5rem;
            cursor: pointer;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .popup-close:hover {
            background: rgba(248, 113, 113, 0.2);
            color: var(--danger-color);
        }

        .popup-title {
            font-size: 1.5rem;
            color: var(--main-color);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--main-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            width: 100%;
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

        .btn-primary {
            width: 100%;
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

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(162, 146, 114, 0.3);
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border-left: 4px solid;
        }

        .alert-success {
            background: rgba(74, 222, 128, 0.1);
            color: var(--success-color);
            border-left-color: var(--success-color);
        }

        .alert-error {
            background: rgba(248, 113, 113, 0.1);
            color: var(--danger-color);
            border-left-color: var(--danger-color);
        }

        .error-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .error-list li {
            background: rgba(248, 113, 113, 0.1);
            color: var(--danger-color);
            padding: 0.5rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 6px;
            border-left: 3px solid var(--danger-color);
        }

        .projects-section {
            margin-top: 2rem;
        }

        .section-title {
            font-size: 1.8rem;
            color: var(--main-color);
            margin-bottom: 2rem;
            font-weight: 600;
            text-align: center;
        }

        .table-container {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-glass);
        }

        .projects-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .projects-table th,
        .projects-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--card-border);
        }

        .projects-table th {
            background: var(--gradient-accent);
            font-weight: 600;
            color: var(--main-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
        }

        .projects-table tbody tr {
            transition: all 0.3s ease;
        }

        .projects-table tbody tr:hover {
            background: rgba(162, 146, 114, 0.1);
            transform: scale(1.01);
        }

        .project-image {
            max-width: 100px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--card-border);
        }

        .action-link {
            color: var(--info-color);
            text-decoration: none;
            font-weight: 500;
            margin-right: 1rem;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .action-link:hover {
            background: rgba(96, 165, 250, 0.2);
            text-decoration: none;
        }

        .delete-btn {
            color: var(--danger-color);
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 500;
            padding: 0.3rem 0.8rem;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .delete-btn:hover {
            background: rgba(248, 113, 113, 0.2);
        }

        .delete-form {
            display: inline;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            opacity: 0.6;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--main-color);
        }

        @media (max-width: 768px) {
            .projects-container {
                padding: 1rem;
            }

            .dashboard-title {
                font-size: 2rem;
            }

            .add-project-btn {
                top: 160px;
                right: 20px;
                padding: 0.8rem 1.5rem;
            }

            .popup-content {
                width: 95%;
                margin: 1rem;
            }

            .projects-table {
                font-size: 0.8rem;
            }

            .projects-table th,
            .projects-table td {
                padding: 0.5rem;
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
    </style>
@endsection

@section('content')
    <button class="add-project-btn" onclick="openPopup()">+ Add New Project</button>
    <div class="projects-container">
        <div class="dashboard-header">
            <h2 class="dashboard-title">Projects Management</h2>
        </div>


        <!-- Add Project Popup -->
        <div class="popup-overlay" id="projectPopup">
            <div class="popup-content">
                <button class="popup-close" onclick="closePopup()">&times;</button>
                <h3 class="popup-title">Add New Project</h3>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif

                <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="project_category" class="form-label">Project Category</label>
                        <select name="project_category" id="project_category" required class="form-control"
                            style="background-color: #000000;">
                            <option value="" disabled>Select a
                                category</option>
                            <option value="interior" >Interior
                            </option>
                            <option value="commercial">
                                Commercial</option>
                            <option value="official" >Official
                            </option>
                            <option value="residential" >
                                Residential</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" accept="image/*" required class="form-control">
                    </div>
                    <button type="submit" class="btn-primary">Add Project</button>
                </form>
            </div>
        </div>

        <!-- Projects List -->
        <div class="projects-section">
            @if ($projects->isEmpty())
                <div class="empty-state">
                    <div class="empty-state-icon">📁</div>
                    <p>No projects found.</p>
                </div>
            @else
                <div class="table-container">
                    <table class="projects-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->id }}</td>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->project_category }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}"
                                            class="project-image">
                                    </td>
                                    <td>{{ $project->created_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.projects.edit', $project->id) }}"
                                            class="action-link">Edit</a>
                                        <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this project?')"
                                                class="delete-btn">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById('projectPopup').classList.add('active');
        }

        function closePopup() {
            document.getElementById('projectPopup').classList.remove('active');
        }

        // Close popup when clicking outside
        document.getElementById('projectPopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closePopup();
            }
        });

        // Close popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup();
            }
        });
    </script>
@endsection
