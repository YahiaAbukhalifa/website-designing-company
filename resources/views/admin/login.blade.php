<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('CSS/main.css') }}">
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
            display: flex;
            align-items: center;
            justify-content: center;
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

        .login-container {
            width: 100%;
            max-width: 450px;
            margin: 20px;
            padding: 3rem;
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--shadow-glass);
            position: relative;
            overflow: hidden;
            animation: slideIn 0.8s ease-out;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--main-color), transparent);
            opacity: 0.5;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .login-container h2 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--main-color), #d4c19c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 2rem;
            text-shadow: 0 0 30px rgba(162, 146, 114, 0.3);
            text-align: center;
        }

        .error-message {
            background: rgba(248, 113, 113, 0.1);
            color: var(--danger-color);
            border: 1px solid rgba(248, 113, 113, 0.3);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            text-align: center;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-control {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 1rem 1.2rem;
            color: var(--text-color);
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: var(--font-family);
        }

        .form-control::placeholder {
            color: rgba(223, 225, 244, 0.6);
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--main-color);
            box-shadow: 0 0 0 3px rgba(162, 146, 114, 0.1);
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
        }

        .form-control:focus::placeholder {
            color: rgba(223, 225, 244, 0.8);
            transform: translateY(-2px);
        }

        .login-btn {
            width: 100%;
            background: linear-gradient(135deg, var(--main-color), #d4c19c);
            color: var(--bg-body);
            border: none;
            border-radius: 12px;
            padding: 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            font-size: 1rem;
            font-family: var(--font-family);
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .login-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(162, 146, 114, 0.4);
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:active {
            transform: translateY(-1px);
        }

        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--glass-border);
            opacity: 0.7;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-container {
                margin: 10px;
                padding: 2rem 1.5rem;
                max-width: 400px;
            }

            .login-container h2 {
                font-size: 2rem;
            }

            .form-control {
                padding: 0.9rem 1rem;
                font-size: 0.95rem;
            }

            .login-btn {
                padding: 1rem;
                font-size: 0.95rem;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 5px;
                padding: 1.5rem 1rem;
                max-width: 350px;
            }

            .login-container h2 {
                font-size: 1.8rem;
                margin-bottom: 1.5rem;
            }

            .form-control {
                padding: 0.8rem;
                font-size: 0.9rem;
            }

            .login-btn {
                padding: 0.9rem;
                font-size: 0.9rem;
                letter-spacing: 0.5px;
            }

            .form-group {
                margin-bottom: 1.2rem;
            }
        }

        /* Custom Scrollbar */
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

        /* Input autofill styling */
        .form-control:-webkit-autofill,
        .form-control:-webkit-autofill:hover,
        .form-control:-webkit-autofill:focus {
            -webkit-box-shadow: 0 0 0 1000px rgba(255, 255, 255, 0.05) inset;
            -webkit-text-fill-color: var(--text-color);
            transition: background-color 5000s ease-in-out 0s;
        }
    </style>
</head>

<body>
    <div class="floating-elements"></div>
    <div class="login-container">
        <h2>Admin Login</h2>
        
        @if ($errors->has('email'))
            <div class="error-message">
                {{ $errors->first('email') }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required class="form-control">
            </div>
            
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required class="form-control">
            </div>
            
            <button type="submit" class="login-btn">
                Login
            </button>
        </form>
        
    </div>
</body>

</html>