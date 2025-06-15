@extends('admin.partials.header')

@section('title', 'Contact Us')
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

        .contact-container {
            max-width: 1400px;
            margin: 20px auto;
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

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 2rem 0;
            position: relative;
        }

        .page-title {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--main-color), #d4c19c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 30px rgba(162, 146, 114, 0.3);
        }

        .add-receiver-btn {
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

        .add-receiver-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(162, 146, 114, 0.4);
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(10px);
            z-index: 1001;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .popup-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .popup-content {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.8);
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            width: 90%;
            max-width: 500px;
            box-shadow: var(--shadow-glass);
            transition: all 0.3s ease;
        }

        .popup-overlay.active .popup-content {
            transform: translate(-50%, -50%) scale(1);
        }

        .popup-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--card-border);
        }

        .popup-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--main-color);
        }

        .close-btn {
            background: none;
            border: none;
            color: var(--text-color);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .close-btn:hover {
            background: rgba(162, 146, 114, 0.2);
            color: var(--main-color);
        }

        .success-message {
            background: rgba(74, 222, 128, 0.1);
            border: 1px solid rgba(74, 222, 128, 0.3);
            color: var(--success-color);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
        }

        .error-list {
            background: rgba(248, 113, 113, 0.1);
            border: 1px solid rgba(248, 113, 113, 0.3);
            color: var(--danger-color);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1rem;
            list-style: none;
        }

        .error-list li {
            margin-bottom: 0.5rem;
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
            width: 100%;
        }

        .delete-btn {
            background: transparent;
            border: unset;
            color: red;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(162, 146, 114, 0.3);
        }

        .section-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow-glass);
            margin-bottom: 2rem;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .section-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--main-color), transparent);
            opacity: 0.5;
        }

        .section-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-hover);
            border-color: var(--main-color);
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--main-color);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .section-icon {
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

        .table-responsive {
            overflow-x: auto;
            border-radius: 12px;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }

        .data-table th,
        .data-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--card-border);
        }

        .data-table th {
            background: var(--gradient-accent);
            font-weight: 600;
            color: var(--main-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 0.8rem;
        }

        .data-table tbody tr {
            transition: all 0.3s ease;
        }

        .data-table tbody tr:hover {
            background: rgba(162, 146, 114, 0.1);
            transform: scale(1.01);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            opacity: 0.6;
            color: var(--text-color);
        }

        .empty-state-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--main-color);
            display: block;
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

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        @media (max-width: 768px) {
            .contact-container {
                padding: 1rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .add-receiver-btn {
                top: 160px;
                right: 20px;
                padding: 0.8rem 1.5rem;
            }

            .popup-content {
                width: 95%;
                padding: 1.5rem;
            }

            .section-title {
                font-size: 1.5rem;
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
    <div class="floating-elements"></div>

    <button class="add-receiver-btn" onclick="openPopup()">+ Add Email Receiver</button>

    <div class="contact-container">
        <div class="page-header">
            <h2 class="page-title">Contact Us Management</h2>
        </div>

        <!-- Email Receivers List -->
        <div class="section-card">
            <h3 class="section-title">
                <span class="section-icon">📧</span>
                Email Receivers
            </h3>

            @if ($receivers->isEmpty())
                <div class="empty-state">
                    <span class="empty-state-icon">📭</span>
                    <p>No email receivers found.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Added At</th>
                                <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($receivers as $receiver)
                                <tr>
                                    <td>{{ $receiver->id }}</td>
                                    <td>{{ $receiver->name }}</td>
                                    <td>{{ $receiver->email }}</td>
                                    <td>{{ $receiver->created_at }}</td>
                                    <td>
                                        <form action="{{ route('admin.contact.destroy', $receiver->id) }}" method="POST"
                                            class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn"
                                                onclick="return confirm('Are you sure you want to delete this receiver?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Contact Submissions List -->
        <div class="section-card">
            <h3 class="section-title">
                <span class="section-icon">💬</span>
                Contact Submissions
            </h3>

            @if ($contacts->isEmpty())
                <div class="empty-state">
                    <span class="empty-state-icon">📝</span>
                    <p>No contact submissions found.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                                <th>Submitted At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->message }}</td>
                                    <td>{{ $contact->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Popup for Add Email Receiver -->
    <div class="popup-overlay" id="popupOverlay" onclick="closePopup()">
        <div class="popup-content" onclick="event.stopPropagation()">
            <div class="popup-header">
                <h3 class="popup-title">Add Email Receiver</h3>
                <button class="close-btn" onclick="closePopup()">&times;</button>
            </div>

            @if (session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('admin.contact-us.receivers.store') }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="form-control">
                </div>
                <button type="submit" class="btn-primary">Add Receiver</button>
            </form>
        </div>
    </div>

    <script>
        function openPopup() {
            document.getElementById('popupOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePopup() {
            document.getElementById('popupOverlay').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Auto-show popup if there are validation errors
        @if ($errors->any())
            document.addEventListener('DOMContentLoaded', function() {
                openPopup();
            });
        @endif

        // Auto-close popup on successful submission
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    closePopup();
                }, 3000);
            });
        @endif
    </script>
@endsection
