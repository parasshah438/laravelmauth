<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Admin Dashboard</title>
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

        .reset-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
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

        .reset-card {
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

        .reset-title {
            color: #333;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .reset-subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
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
            padding: 12px 45px 12px 45px;
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

        .form-control.is-valid {
            border-color: #56ab2f;
        }

        .form-control.is-invalid {
            border-color: #e74c3c;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            cursor: pointer;
            z-index: 10;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .password-strength {
            margin-top: 8px;
            height: 4px;
            background: #e0e0e0;
            border-radius: 2px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .strength-bar {
            height: 100%;
            width: 0;
            transition: all 0.3s ease;
        }

        .strength-weak {
            background: #e74c3c;
            width: 33%;
        }

        .strength-medium {
            background: #f39c12;
            width: 66%;
        }

        .strength-strong {
            background: #56ab2f;
            width: 100%;
        }

        .strength-text {
            font-size: 12px;
            margin-top: 5px;
            font-weight: 500;
        }

        .strength-text.weak {
            color: #e74c3c;
        }

        .strength-text.medium {
            color: #f39c12;
        }

        .strength-text.strong {
            color: #56ab2f;
        }

        .requirements {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            animation: slideIn 0.5s ease-out 0.3s both;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .requirements h6 {
            color: #555;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .requirement-item {
            display: flex;
            align-items: center;
            font-size: 12px;
            color: #999;
            margin-bottom: 5px;
            transition: color 0.3s ease;
        }

        .requirement-item i {
            margin-right: 8px;
            font-size: 10px;
            transition: color 0.3s ease;
        }

        .requirement-item.met {
            color: #56ab2f;
        }

        .requirement-item.met i {
            color: #56ab2f;
        }

        .validation-message {
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .validation-message.show {
            display: block;
        }

        .validation-message.error {
            color: #e74c3c;
        }

        .validation-message.success {
            color: #56ab2f;
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
            margin-top: 10px;
        }

        .btn-reset:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .btn-reset:active {
            transform: translateY(0);
        }

        .btn-reset:disabled {
            opacity: 0.6;
            cursor: not-allowed;
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

        .btn-login {
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
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .footer-text {
            text-align: center;
            color: #999;
            font-size: 13px;
            margin-top: 20px;
        }

        @media (max-width: 576px) {
            .reset-card {
                padding: 30px 20px;
            }

            .reset-title {
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

    <div class="reset-container">
        <div class="reset-card">
            <!-- Reset Password Form -->
            <div id="resetForm">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="fas fa-lock-open"></i>
                    </div>
                    <h1 class="reset-title">Reset Password</h1>
                    <p class="reset-subtitle">Create a new strong password for your account. Make sure it's secure and memorable.</p>
                </div>

                 @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                        {{ $errors->first('email') }}
                    </div>       
                @endif
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="passwordResetForm" method="post" action="{{ route('admin.password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="email" class="form-control" id="emailInput" placeholder="admin@example.com">
                        </div>
                        <div class="validation-message" id="emailValidation"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">New Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Enter new password">
                            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                        </div>
                        <div class="password-strength">
                            <div class="strength-bar" id="strengthBar"></div>
                        </div>
                        <div class="strength-text" id="strengthText"></div>
                    </div>

                    <div class="requirements">
                        <h6>Password must contain:</h6>
                        <div class="requirement-item" id="req-length">
                            <i class="fas fa-circle"></i>
                            <span>At least 8 characters</span>
                        </div>
                        <div class="requirement-item" id="req-uppercase">
                            <i class="fas fa-circle"></i>
                            <span>One uppercase letter</span>
                        </div>
                        <div class="requirement-item" id="req-lowercase">
                            <i class="fas fa-circle"></i>
                            <span>One lowercase letter</span>
                        </div>
                        <div class="requirement-item" id="req-number">
                            <i class="fas fa-circle"></i>
                            <span>One number</span>
                        </div>
                        <div class="requirement-item" id="req-special">
                            <i class="fas fa-circle"></i>
                            <span>One special character (!@#$%^&*)</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" class="form-control" name="password_confirmation" id="confirmPasswordInput" placeholder="Confirm new password" required>
                            <i class="fas fa-eye password-toggle" id="toggleConfirmPassword"></i>
                        </div>
                        <div class="validation-message" id="confirmValidation"></div>
                    </div>

                    <button type="submit" class="btn btn-reset" id="submitBtn" disabled>
                        <i class="fas fa-check-circle me-2"></i>Reset Password
                    </button>
                </form>
            </div>

            <!-- Success Message -->
            <div id="successMessage" class="success-message hidden">
                <div class="success-icon">
                    <i class="fas fa-check"></i>
                </div>
                <h3>Password Reset Successfully!</h3>
                <p>Your password has been updated successfully. You can now login with your new password.</p>
                
                <button type="button" class="btn btn-login" onclick="alert('Redirecting to login page...');">
                    <i class="fas fa-sign-in-alt me-2"></i>Go to Login
                </button>
            </div>

            <div class="footer-text">
                <p>&copy; 2025 Admin Dashboard. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        const emailInput = document.getElementById('emailInput');
        const passwordInput = document.getElementById('passwordInput');
        const confirmPasswordInput = document.getElementById('confirmPasswordInput');
        const submitBtn = document.getElementById('submitBtn');
        const strengthBar = document.getElementById('strengthBar');
        const strengthText = document.getElementById('strengthText');

        // Password toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function() {
            togglePasswordVisibility(passwordInput, this);
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            togglePasswordVisibility(confirmPasswordInput, this);
        });

        function togglePasswordVisibility(input, icon) {
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        }

        // Email validation
        emailInput.addEventListener('input', function() {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const validation = document.getElementById('emailValidation');
            
            if (emailRegex.test(this.value)) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                validation.classList.remove('show', 'error');
            } else if (this.value) {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
                validation.textContent = 'Please enter a valid email address';
                validation.classList.add('show', 'error');
            } else {
                this.classList.remove('is-valid', 'is-invalid');
                validation.classList.remove('show');
            }
            checkFormValidity();
        });

        // Password strength checker
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password),
                special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
            };

            // Update requirement items
            updateRequirement('req-length', requirements.length);
            updateRequirement('req-uppercase', requirements.uppercase);
            updateRequirement('req-lowercase', requirements.lowercase);
            updateRequirement('req-number', requirements.number);
            updateRequirement('req-special', requirements.special);

            // Calculate strength
            const metRequirements = Object.values(requirements).filter(Boolean).length;
            let strength = '';
            
            strengthBar.className = 'strength-bar';
            strengthText.className = 'strength-text';

            if (password.length === 0) {
                strengthBar.style.width = '0';
                strengthText.textContent = '';
            } else if (metRequirements <= 2) {
                strengthBar.classList.add('strength-weak');
                strengthText.classList.add('weak');
                strengthText.textContent = 'Weak password';
            } else if (metRequirements <= 4) {
                strengthBar.classList.add('strength-medium');
                strengthText.classList.add('medium');
                strengthText.textContent = 'Medium password';
            } else {
                strengthBar.classList.add('strength-strong');
                strengthText.classList.add('strong');
                strengthText.textContent = 'Strong password';
                this.classList.add('is-valid');
            }

            checkPasswordMatch();
            checkFormValidity();
        });

        // Confirm password validation
        confirmPasswordInput.addEventListener('input', function() {
            checkPasswordMatch();
            checkFormValidity();
        });

        function updateRequirement(id, met) {
            const element = document.getElementById(id);
            if (met) {
                element.classList.add('met');
            } else {
                element.classList.remove('met');
            }
        }

        function checkPasswordMatch() {
            const validation = document.getElementById('confirmValidation');
            
            if (confirmPasswordInput.value && passwordInput.value) {
                if (confirmPasswordInput.value === passwordInput.value) {
                    confirmPasswordInput.classList.remove('is-invalid');
                    confirmPasswordInput.classList.add('is-valid');
                    validation.textContent = 'Passwords match';
                    validation.classList.add('show', 'success');
                    validation.classList.remove('error');
                } else {
                    confirmPasswordInput.classList.remove('is-valid');
                    confirmPasswordInput.classList.add('is-invalid');
                    validation.textContent = 'Passwords do not match';
                    validation.classList.add('show', 'error');
                    validation.classList.remove('success');
                }
            } else {
                confirmPasswordInput.classList.remove('is-valid', 'is-invalid');
                validation.classList.remove('show');
            }
        }

        function checkFormValidity() {
            const emailValid = emailInput.classList.contains('is-valid');
            const passwordValid = passwordInput.classList.contains('is-valid');
            const confirmValid = confirmPasswordInput.classList.contains('is-valid');
            
            submitBtn.disabled = !(emailValid && passwordValid && confirmValid);
        }

        // Form submission
        document.getElementById('passwordResetForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const btn = submitBtn;
            const originalText = btn.innerHTML;
            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Resetting...';
            this.submit(); 
        });

        // Input focus animations
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>