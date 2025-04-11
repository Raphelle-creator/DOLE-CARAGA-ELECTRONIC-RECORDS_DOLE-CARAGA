<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | DOLE CARAGA Electronic Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --dole-blue: #0056b3;
            --dole-yellow: #ffc107;
            --dole-dark-blue: #003366;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            min-height: 100vh;
        }
        
        .login-container {
            display: flex;
            width: 100%;
        }
        
        .login-left {
            flex: 1;
            background: linear-gradient(135deg, var(--dole-dark-blue) 0%, var(--dole-blue) 100%);
            color: white;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-left::before {
            content: "";
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            transform: rotate(30deg);
        }
        
        .login-left-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .login-logo {
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .login-logo img {
            height: 70px;
        }
        
        .login-right {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .login-card {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
        }
        
        .login-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--dole-dark-blue);
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .form-control {
            padding: 12px 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
            margin-bottom: 5px;
        }
        
        .form-control:focus {
            border-color: var(--dole-blue);
            box-shadow: 0 0 0 0.25rem rgba(0, 86, 179, 0.25);
        }
        
        .btn-login {
            background-color: var(--dole-blue);
            color: white;
            padding: 12px;
            border-radius: 6px;
            font-weight: 600;
            width: 100%;
            border: none;
            transition: all 0.3s;
            margin-top: 1rem;
        }
        
        .btn-login:hover {
            background-color: var(--dole-dark-blue);
            color: white;
        }
        
        .password-container {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .forgot-password {
            position: absolute;
            right: 0;
            top: 100%;
            margin-top: 5px;
        }
        
        .forgot-password a {
            color: var(--dole-blue);
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .login-footer {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }
        
        .input-group-text {
            background-color: #f1f3f4;
            border: 1px solid #ddd;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 1rem;
        }
        
        @media (max-width: 992px) {
            .login-container {
                flex-direction: column;
            }
            
            .login-left {
                padding: 2rem 1rem;
            }
            
            .login-left-content {
                max-width: 100%;
            }
        }
        
        @media (max-width: 576px) {
            .login-card {
                padding: 1.5rem;
            }
            
            .login-title {
                font-size: 1.5rem;
            }
            
            .remember-me {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            
            .forgot-password {
                position: static;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Left Side -->
        <div class="login-left">
            <div class="login-left-content">
                <div class="login-logo">
                    <img src="{{ asset('storage/images/logo.png') }}" alt="DOLE CARAGA Logo">
                    <h2 class="mt-3">DOLE CARAGA</h2>
                </div>
                <h3 class="fw-bold mb-3">Electronic Records Management System</h3>
                <p class="mb-4">Secure access to your documents and workflows. Streamline your processes with our digital solution.</p>
                
                <div class="system-features">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-shield-alt fa-lg me-3"></i>
                        <span>Role-based secure access</span>
                    </div>
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-file-upload fa-lg me-3"></i>
                        <span>Document management</span>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tasks fa-lg me-3"></i>
                        <span>Workflow automation</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Side  -->
        <div class="login-right">
            <div class="login-card">
                <h1 class="login-title">Sign In</h1>
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if(session('success'))
                    <p>{{ session('success') }}</p>
                @endif
                
                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="text" class="form-control" id="username" name="username" required autofocus placeholder="Enter your username">
                        </div>
                    </div>
                    
                    <div class="password-container">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                        </div>
                        <div class="forgot-password">
                            <a href="#" class="text-decoration-none">Forgot password?</a>
                        </div>
                    </div>
                    
                    <div class="remember-me">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-login">
                        <i class="fas fa-sign-in-alt me-2"></i> Login
                    </button>
                    
                    <div class="login-footer">
                        <p>Need help? Contact <a href="mailto:it.caraga@dole.gov.ph">IT Support</a></p>
                        <p class="mb-0">&copy; {{ date('Y') }} DOLE CARAGA. All rights reserved.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>