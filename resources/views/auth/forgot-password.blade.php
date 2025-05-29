<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mathporia | Reset Password</title>
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
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        .bg-decoration {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .bg-decoration:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .bg-decoration:nth-child(2) {
            width: 60px;
            height: 60px;
            top: 20%;
            right: 10%;
            animation-delay: -2s;
        }

        .bg-decoration:nth-child(3) {
            width: 40px;
            height: 40px;
            bottom: 30%;
            left: 20%;
            animation-delay: -4s;
        }

        .bg-decoration:nth-child(4) {
            width: 100px;
            height: 100px;
            bottom: 10%;
            right: 20%;
            animation-delay: -1s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Character decorations */
        .character {
            position: absolute;
            font-size: 60px;
            opacity: 0.8;
        }

        .character.wizard {
            top: 15%;
            left: 8%;
            animation: bounce 3s ease-in-out infinite;
        }

        .character.robot {
            bottom: 20%;
            left: 10%;
            animation: bounce 3s ease-in-out infinite 1s;
        }

        .character.student {
            top: 20%;
            right: 10%;
            animation: bounce 3s ease-in-out infinite 2s;
        }

        .character.teacher {
            bottom: 15%;
            right: 8%;
            animation: bounce 3s ease-in-out infinite 0.5s;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        /* Back button */
        .back-btn {
            position: absolute;
            top: 30px;
            left: 30px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        /* Main container */
        .container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 10;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .title {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #666;
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        /* Step indicator */
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            gap: 20px;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .step.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .step.inactive {
            background: #f0f0f0;
            color: #999;
        }

        .step.completed {
            background: #28a745;
            color: white;
        }

        /* Form styles */
        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            color: #555;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            background: white;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-input.error {
            border-color: #dc3545;
            background: #fff5f5;
        }

        .form-input.success {
            border-color: #28a745;
            background: #f8fff8;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background: #6c757d;
            margin-right: 10px;
        }

        .btn-secondary:hover {
            background: #5a6268;
            box-shadow: 0 10px 25px rgba(108, 117, 125, 0.3);
        }

        .button-group {
            display: flex;
            gap: 10px;
        }

        .button-group .submit-btn {
            flex: 1;
        }

        .status-message {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            text-align: center;
        }

        .status-success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .status-error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
        }

        .status-info {
            background: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
        }

        .password-strength {
            margin-top: 8px;
            font-size: 12px;
        }

        .strength-indicator {
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            margin: 5px 0;
            overflow: hidden;
        }

        .strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { width: 25%; background: #dc3545; }
        .strength-fair { width: 50%; background: #ffc107; }
        .strength-good { width: 75%; background: #17a2b8; }
        .strength-strong { width: 100%; background: #28a745; }

        .password-requirements {
            margin-top: 10px;
            font-size: 12px;
            color: #666;
        }

        .requirement {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 4px 0;
        }

        .requirement.met {
            color: #28a745;
        }

        .requirement.unmet {
            color: #dc3545;
        }

        .back-to-login {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e1e5e9;
        }

        .back-to-login a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .back-to-login a:hover {
            color: #764ba2;
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 30px 25px;
            }
            
            .character {
                display: none;
            }
            
            .back-btn {
                top: 20px;
                left: 20px;
                padding: 10px 16px;
            }

            .step-indicator {
                gap: 10px;
            }

            .step {
                padding: 6px 12px;
                font-size: 12px;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <!-- Background decorations -->
    <div class="bg-decoration"></div>
    <div class="bg-decoration"></div>
    <div class="bg-decoration"></div>
    <div class="bg-decoration"></div>

    <!-- Character decorations -->
    <div class="character wizard">🧙‍♂️</div>
    <div class="character robot">🤖</div>
    <div class="character student">👨‍🎓</div>
    <div class="character teacher">👩‍🏫</div>

    <!-- Back button -->
    <a href="login" class="back-btn" onclick="goBackToLogin()">
        <span>←</span>
        Kembali ke Login
    </a>

    <div class="container">
        <div class="header">
            <h1 class="title">Reset Password</h1>
            <p class="subtitle">
                Ikuti langkah-langkah berikut untuk mengatur ulang password Anda
            </p>
        </div>

        <!-- Step Indicator -->
        <div class="step-indicator">
            <div class="step active" id="step1-indicator">
                <span>1</span> Verifikasi Email
            </div>
            <div class="step inactive" id="step2-indicator">
                <span>2</span> Password Baru
            </div>
            <div class="step inactive" id="step3-indicator">
                <span>3</span> Selesai
            </div>
        </div>

        <!-- Status Messages -->
        <div id="status-message" class="status-message" style="display: none;"></div>

        <!-- Step 1: Email Verification -->
        <div class="form-step active" id="step1">
            <form id="verify-email-form">
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input" 
                        placeholder="masukkan@email.com"
                        required
                    >
                </div>
                <button type="submit" class="submit-btn">
                    Verifikasi Email
                </button>
            </form>
        </div>

        <!-- Step 2: New Password -->
        <div class="form-step" id="step2">
            <form id="reset-password-form">
                <div class="form-group">
                    <label for="new-password" class="form-label">Password Baru</label>
                    <input 
                        type="password" 
                        id="new-password" 
                        name="new-password" 
                        class="form-input" 
                        placeholder="Masukkan password baru"
                        required
                    >
                    <div class="password-strength">
                        <div class="strength-indicator">
                            <div class="strength-bar" id="strength-bar"></div>
                        </div>
                        <div id="strength-text">Kekuatan password: <span>Lemah</span></div>
                        <div class="password-requirements">
                            <div class="requirement unmet" id="req-length">
                                <span>✗</span> Minimal 8 karakter
                            </div>
                            <div class="requirement unmet" id="req-uppercase">
                                <span>✗</span> Huruf besar (A-Z)
                            </div>
                            <div class="requirement unmet" id="req-lowercase">
                                <span>✗</span> Huruf kecil (a-z)
                            </div>
                            <div class="requirement unmet" id="req-number">
                                <span>✗</span> Angka (0-9)
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm-password" class="form-label">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        id="confirm-password" 
                        name="confirm-password" 
                        class="form-input" 
                        placeholder="Konfirmasi password baru"
                        required
                    >
                </div>

                <div class="button-group">
                    <button type="button" class="submit-btn btn-secondary" onclick="previousStep()">
                        Kembali
                    </button>
                    <button type="submit" class="submit-btn">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Step 3: Success -->
        <div class="form-step" id="step3">
            <div class="status-message status-success">
                <h3 style="margin-bottom: 10px;">🎉 Password Berhasil Diubah!</h3>
                <p>Password Anda telah berhasil diperbarui. Silakan login dengan password baru Anda.</p>
            </div>
            <button class="submit-btn" onclick="goBackToLogin()">
                Kembali ke Login
            </button>
        </div>

        <div class="back-to-login">
            <span>Sudah ingat password? </span>
            <a href="login" onclick="goBackToLogin()">Masuk sekarang</a>
        </div>
    </div>

    <script>
        let currentStep = 1;
        let userEmail = '';
        let resetToken = '';

        // CSRF Token untuk Laravel
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Step 1: Email Verification
        document.getElementById('verify-email-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value.trim();
            const emailInput = document.getElementById('email');
            
            showMessage('Memverifikasi email...', 'info');
            
            // AJAX request untuk memverifikasi email
            fetch('/forgot-password/verify-email', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: email
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    userEmail = email;
                    resetToken = data.token; // Token untuk reset password
                    emailInput.classList.remove('error');
                    emailInput.classList.add('success');
                    
                    showMessage('Email terverifikasi! Silakan masukkan password baru.', 'success');
                    
                    setTimeout(() => {
                        nextStep();
                    }, 1500);
                } else {
                    showMessage(data.message || 'Email tidak ditemukan dalam sistem.', 'error');
                    emailInput.classList.add('error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('Terjadi kesalahan. Silakan coba lagi.', 'error');
                emailInput.classList.add('error');
            });
        });

        // Step 2: Password Reset
        document.getElementById('reset-password-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            
            // Validate passwords match
            if (newPassword !== confirmPassword) {
                showMessage('Password konfirmasi tidak cocok.', 'error');
                document.getElementById('confirm-password').classList.add('error');
                return;
            }

            // Validate password strength
            if (!isPasswordStrong(newPassword)) {
                showMessage('Password harus memenuhi semua persyaratan keamanan.', 'error');
                return;
            }

            showMessage('Sedang memperbarui password...', 'info');

            // AJAX request untuk mengupdate password
            fetch('/forgot-password/reset-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    email: userEmail,
                    token: resetToken,
                    password: newPassword,
                    password_confirmation: confirmPassword
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage('Password berhasil diperbarui!', 'success');
                    setTimeout(() => {
                        nextStep();
                    }, 2000);
                } else {
                    showMessage(data.message || 'Gagal memperbarui password.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('Terjadi kesalahan. Silakan coba lagi.', 'error');
            });
        });

        // Password strength checker
        document.getElementById('new-password').addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });

        // Confirm password validation
        document.getElementById('confirm-password').addEventListener('input', function() {
            const newPassword = document.getElementById('new-password').value;
            const confirmInput = this;
            
            if (this.value && this.value !== newPassword) {
                confirmInput.classList.add('error');
                confirmInput.classList.remove('success');
            } else if (this.value === newPassword && newPassword) {
                confirmInput.classList.remove('error');
                confirmInput.classList.add('success');
            }
        });

        function checkPasswordStrength(password) {
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /[0-9]/.test(password)
            };

            // Update requirement indicators
            updateRequirement('req-length', requirements.length);
            updateRequirement('req-uppercase', requirements.uppercase);
            updateRequirement('req-lowercase', requirements.lowercase);
            updateRequirement('req-number', requirements.number);

            // Calculate strength
            const metRequirements = Object.values(requirements).filter(Boolean).length;
            const strengthBar = document.getElementById('strength-bar');
            const strengthText = document.getElementById('strength-text').querySelector('span');

            switch (metRequirements) {
                case 0:
                case 1:
                    strengthBar.className = 'strength-bar strength-weak';
                    strengthText.textContent = 'Sangat Lemah';
                    break;
                case 2:
                    strengthBar.className = 'strength-bar strength-fair';
                    strengthText.textContent = 'Lemah';
                    break;
                case 3:
                    strengthBar.className = 'strength-bar strength-good';
                    strengthText.textContent = 'Baik';
                    break;
                case 4:
                    strengthBar.className = 'strength-bar strength-strong';
                    strengthText.textContent = 'Kuat';
                    break;
            }
        }

        function updateRequirement(id, met) {
            const element = document.getElementById(id);
            if (met) {
                element.classList.remove('unmet');
                element.classList.add('met');
                element.querySelector('span').textContent = '✓';
            } else {
                element.classList.remove('met');
                element.classList.add('unmet');
                element.querySelector('span').textContent = '✗';
            }
        }

        function isPasswordStrong(password) {
            return password.length >= 8 &&
                /[A-Z]/.test(password) &&
                /[a-z]/.test(password) &&
                /[0-9]/.test(password);
        }

        function nextStep() {
            document.getElementById(`step${currentStep}`).classList.remove('active');
            document.getElementById(`step${currentStep}-indicator`).classList.remove('active');
            document.getElementById(`step${currentStep}-indicator`).classList.add('completed');
            
            currentStep++;
            
            document.getElementById(`step${currentStep}`).classList.add('active');
            document.getElementById(`step${currentStep}-indicator`).classList.remove('inactive');
            document.getElementById(`step${currentStep}-indicator`).classList.add('active');
            
            hideMessage();
        }

        function previousStep() {
            document.getElementById(`step${currentStep}`).classList.remove('active');
            document.getElementById(`step${currentStep}-indicator`).classList.remove('active');
            document.getElementById(`step${currentStep}-indicator`).classList.add('inactive');
            
            currentStep--;
            
            document.getElementById(`step${currentStep}`).classList.add('active');
            document.getElementById(`step${currentStep}-indicator`).classList.remove('completed');
            document.getElementById(`step${currentStep}-indicator`).classList.add('active');
            
            hideMessage();
        }

        function showMessage(message, type) {
            const messageEl = document.getElementById('status-message');
            messageEl.textContent = message;
            messageEl.className = `status-message status-${type}`;
            messageEl.style.display = 'block';
        }

        function hideMessage() {
            document.getElementById('status-message').style.display = 'none';
        }

        function goBackToLogin() {
            // Redirect ke halaman login
            window.location.href = '/login';
        }

        // Add some interactive effects
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
</script>
</body>
</html>