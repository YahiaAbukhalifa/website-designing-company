@extends('admin.partials.header')

@section('title', 'Edit Project')
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
        --danger-color: #f87171;
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

    .projects-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 40px;
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: var(--shadow-glass);
        position: relative;
        overflow: hidden;
        animation: fadeIn 0.8s ease-out;
    }

    .projects-container::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--main-color), transparent);
        opacity: 0.5;
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

    .projects-container h2 {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--main-color), #d4c19c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 2rem;
        text-align: center;
        text-shadow: 0 0 30px rgba(162, 146, 114, 0.3);
    }

    .success-message {
        background: rgba(74, 222, 128, 0.1);
        border: 1px solid rgba(74, 222, 128, 0.3);
        color: var(--success-color);
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(10px);
    }

    .error-message {
        background: rgba(248, 113, 113, 0.1);
        border: 1px solid rgba(248, 113, 113, 0.3);
        color: var(--danger-color);
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(10px);
    }

    .error-list {
        background: rgba(248, 113, 113, 0.1);
        border: 1px solid rgba(248, 113, 113, 0.3);
        color: var(--danger-color);
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(10px);
        list-style: none;
    }

    .error-list li {
        margin-bottom: 0.5rem;
        padding-left: 1rem;
        position: relative;
    }

    .error-list li::before {
        content: '•';
        position: absolute;
        left: 0;
        color: var(--danger-color);
    }

    .form-group {
        margin-bottom: 2rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.8rem;
        color: var(--main-color);
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid var(--glass-border);
        border-radius: 12px;
        padding: 1rem;
        color: var(--text-color);
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--main-color);
        box-shadow: 0 0 0 3px rgba(162, 146, 114, 0.1);
        background: rgba(255, 255, 255, 0.08);
        transform: translateY(-2px);
    }

    .current-image-info {
        margin-top: 1rem;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 8px;
        border: 1px solid var(--glass-border);
    }

    .current-image {
        max-width: 120px;
        height: auto;
        border-radius: 8px;
        margin-top: 0.5rem;
        border: 2px solid var(--glass-border);
        transition: all 0.3s ease;
    }

    .current-image:hover {
        transform: scale(1.05);
        border-color: var(--main-color);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--main-color), #d4c19c);
        color: var(--bg-body);
        border: none;
        border-radius: 12px;
        padding: 1rem 2.5rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.95rem;
        margin-right: 1rem;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(162, 146, 114, 0.3);
    }

    .btn-cancel {
        color: var(--main-color);
        text-decoration: none;
        padding: 1rem 1.5rem;
        border: 1px solid var(--main-color);
        border-radius: 12px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
        font-weight: 500;
        display: inline-block;
    }

    .btn-cancel:hover {
        background: var(--main-color);
        color: var(--bg-body);
        transform: translateY(-2px);
        text-decoration: none;
    }

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 1px solid var(--glass-border);
    }

    @media (max-width: 768px) {
        .projects-container {
            margin: 20px;
            padding: 20px;
        }

        .projects-container h2 {
            font-size: 2rem;
        }

        .form-actions {
            flex-direction: column;
            gap: 1rem;
        }

        .btn-submit,
        .btn-cancel {
            width: 100%;
            text-align: center;
            margin-right: 0;
        }
    }
</style>
@endsection

@section('content')
    <div class="projects-container">
        <h2>Edit Project</h2>
        
        @if (session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif
        
        @if (session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif
        
        @if ($errors->any())
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        
        <form method="POST" action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" required class="form-control">
            </div>
            
            <div class="form-group">
    <label for="project_category" class="form-label">Project Category</label>
    <select name="project_category" id="project_category" required class="form-control" style="background-color: #000000;">
        <option value="" disabled>Select a category</option>
        <option value="interior" {{ old('project_category', $project->project_category) == 'interior' ? 'selected' : '' }}>Interior</option>
        <option value="commercial" {{ old('project_category', $project->project_category) == 'commercial' ? 'selected ' : '' }}>Commercial</option>
        <option value="official" {{ old('project_category', $project->project_category) == 'official' ? 'selected' : '' }}>Official</option>
        <option value="residential" {{ old('project_category', $project->project_category) == 'residential' ? 'selected' : '' }}>Residential</option>
    </select>
</div>
            <div class="form-group">
                <label for="image">Image (leave blank to keep current)</label>
                <input type="file" name="image" id="image" accept="image/*" class="form-control">
                <div class="current-image-info">
                    <p>Current Image:</p>
                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->name }}" class="current-image">
                </div>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit">Update Project</button>
                <a href="{{ route('admin.projects') }}" class="btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
@endsection