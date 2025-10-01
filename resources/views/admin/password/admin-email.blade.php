<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow-x: hidden;
        }

        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 20s infinite;
        }

        .circle:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }

        .circle:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            left: 80%;
            animation-delay: 3s;
        }

        .circle:nth-child(3) {
            width: 100px;
            height: 100px;
            top: 80%;
            left: 10%;
            animation-delay: 6s;
        }

        .circle:nth-child(4) {
            width: 60px;
            height: 60px;
            top: 30%;
            left: 70%;
            animation-delay: 9s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) translateX(0);
            }
            25% {
                transform: translateY(-30px) translateX(30px);
            }
            50% {
                transform: translateY(-60px) translateX(-30px);
            }
            75% {
                transform: translateY(-30px) translateX(30px);
            }
        }

        .forgot-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .forgot-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-container {
            text-align: center;
            margin-bottom: 30px;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .logo-icon i {
            font-size: 40px;
            color: white;
        }

        .forgot-title {
            color: #333;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .forgot-subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            color: #555;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            z-index: 10;
        }

        .form-control {
            padding: 12px 15px 12px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
            background: white;
            outline: none;
        }

        .btn-reset {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            margin-bottom: 15px;
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .btn-reset:active {
            transform: translateY(0);
        }

        .btn-back {
            width: 100%;
            padding: 14px;
            background: transparent;
            border: 2px solid #667eea;
            border-radius: 10px;
            color: #667eea;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-back:active {
            transform: translateY(0);
        }

        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #667eea;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            animation: slideIn 0.6s ease-out 0.3s both;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .info-box i {
            color: #667eea;
            margin-right: 10px;
        }

        .info-box p {
            margin: 0;
            color: #555;
            font-size: 13px;
            line-height: 1.6;
        }

        .success-message {
            display: none;
            text-align: center;
            animation: fadeIn 0.5s ease-in;
        }

        .success-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #56ab2f 0%, #a8e063 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        .success-icon i {
            font-size: 50px;
            color: white;
        }

        .success-message h3 {
            color: #333;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .success-message p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .footer-text {
            text-align: center;
            color: #999;
            font-size: 13px;
            margin-top: 20px;
        }

        @media (max-width: 576px) {
            .forgot-card {
                padding: 30px 20px;
            }

            .forgot-title {
                font-size: 24px;
            }

            .logo-icon {
                width: 70px;
                height: 70px;
            }

            .logo-icon i {
                font-size: 35px;
            }
        }

        .hidden {
            display: none;
        }

        .show {
            display: block;
        }
    </style>
</head>
<body>
    <div class="animated-bg">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>

    <div class="forgot-container">
        <div class="forgot-card">
            <!-- Initial Forgot Password Form -->
            <div id="forgotForm">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <h1 class="forgot-title">Forgot Password?</h1>
                    <p class="forgot-subtitle">No worries! Enter your email address and we'll send you a link to reset your password.</p>
                </div>

               @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="info-box">
                    <i class="fas fa-info-circle"></i>
                    <p>You'll receive an email with instructions to reset your password. Please check your spam folder if you don't see it.</p>
                </div>

                <form id="resetForm" method="post" action="{{ route('admin.password.email') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" class="form-control" id="emailInput" placeholder="admin@example.com" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-reset">
                        <i class="fas fa-paper-plane me-2"></i>Send Reset Link
                    </button>

                    <button type="button" class="btn btn-back" onclick="window.history.back();">
                        <i class="fas fa-arrow-left me-2"></i>Back to Login
                    </button>
                </form>
            </div>

            <!-- Success Message (Hidden by default) -->
            <div id="successMessage" class="success-message hidden">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h3>Check Your Email</h3>
                <p>We've sent a password reset link to <strong id="emailDisplay"></strong></p>
                <p class="mb-4">Please check your inbox and click on the link to reset your password. The link will expire in 24 hours.</p>
                
                <button type="button" class="btn btn-reset" onclick="location.reload();">
                    <i class="fas fa-redo me-2"></i>Resend Email
                </button>

                <button type="button" class="btn btn-back" onclick="window.history.back();">
                    <i class="fas fa-arrow-left me-2"></i>Back to Login
                </button>
            </div>

            <div class="footer-text">
                <p>&copy; 2025 Admin Dashboard. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add floating animation to form input
        const emailInput = document.getElementById('emailInput');
        
        emailInput.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
            this.parentElement.style.transition = 'transform 0.3s ease';
        });

        emailInput.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });

        // Form submission
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('emailInput').value;
            const btn = this.querySelector('.btn-reset');
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
            this.submit(); 
        });

        // Email validation with visual feedback
        emailInput.addEventListener('input', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (this.value && emailRegex.test(this.value)) {
                this.style.borderColor = '#56ab2f';
            } else if (this.value) {
                this.style.borderColor = '#e74c3c';
            } else {
                this.style.borderColor = '#e0e0e0';
            }
        });
    </script>
</body>
</html>