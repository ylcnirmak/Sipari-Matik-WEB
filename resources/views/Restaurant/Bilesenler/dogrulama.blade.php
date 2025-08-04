<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SiparişMatik - Kasiyer Girişi</title>
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        
        /* Gelişmiş arka plan efektleri */
        .background-effects {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }
        
        /* Dalgalı geometrik şekiller */
        .wave-shape {
            position: absolute;
            background: linear-gradient(45deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.1));
            border-radius: 50%;
            animation: morphFloat 12s ease-in-out infinite;
        }
        
        .wave-1 {
            width: 300px;
            height: 300px;
            top: -10%;
            left: -5%;
            animation-delay: 0s;
        }
        
        .wave-2 {
            width: 250px;
            height: 250px;
            top: 20%;
            right: -8%;
            animation-delay: 4s;
        }
        
        .wave-3 {
            width: 200px;
            height: 200px;
            bottom: -5%;
            left: 15%;
            animation-delay: 8s;
        }
        
        .wave-4 {
            width: 180px;
            height: 180px;
            bottom: 25%;
            right: 10%;
            animation-delay: 12s;
        }
        
        /* Parçacık efekti */
        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: particleFloat 20s linear infinite;
        }
        
        .particle:nth-child(odd) {
            background: rgba(147, 197, 253, 0.8);
            animation-duration: 25s;
        }
        
        .particle:nth-child(3n) {
            background: rgba(196, 181, 253, 0.6);
            animation-duration: 30s;
        }
        
        /* Işık çizgileri */
        .light-beam {
            position: absolute;
            width: 2px;
            height: 100px;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.4), rgba(255, 255, 255, 0));
            animation: beamMove 8s ease-in-out infinite;
            transform-origin: center;
        }
        
        .beam-1 {
            top: 10%;
            left: 20%;
            animation-delay: 0s;
        }
        
        .beam-2 {
            top: 60%;
            right: 25%;
            animation-delay: 3s;
        }
        
        .beam-3 {
            bottom: 20%;
            left: 60%;
            animation-delay: 6s;
        }
        
        /* Puls efekti */
        .pulse-ring {
            position: absolute;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: pulseExpand 6s ease-out infinite;
        }
        
        .ring-1 {
            width: 100px;
            height: 100px;
            top: 15%;
            right: 20%;
            animation-delay: 0s;
        }
        
        .ring-2 {
            width: 150px;
            height: 150px;
            bottom: 30%;
            left: 25%;
            animation-delay: 2s;
        }
        
        .ring-3 {
            width: 80px;
            height: 80px;
            top: 70%;
            right: 15%;
            animation-delay: 4s;
        }
        
        @keyframes morphFloat {
            0%, 100% { 
                transform: translateY(0px) translateX(0px) rotate(0deg) scale(1);
                border-radius: 50%;
            }
            25% { 
                transform: translateY(-30px) translateX(20px) rotate(90deg) scale(1.1);
                border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
            }
            50% { 
                transform: translateY(-15px) translateX(-25px) rotate(180deg) scale(0.9);
                border-radius: 70% 30% 30% 70% / 70% 70% 30% 30%;
            }
            75% { 
                transform: translateY(20px) translateX(15px) rotate(270deg) scale(1.2);
                border-radius: 40% 60% 60% 40% / 60% 40% 40% 60%;
            }
        }
        
        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) translateX(0px) rotate(0deg);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100px) translateX(200px) rotate(360deg);
                opacity: 0;
            }
        }
        
        @keyframes beamMove {
            0%, 100% {
                transform: rotate(0deg) scaleY(1);
                opacity: 0.3;
            }
            50% {
                transform: rotate(45deg) scaleY(1.5);
                opacity: 0.8;
            }
        }
        
        @keyframes pulseExpand {
            0% {
                transform: scale(0.5);
                opacity: 0.8;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.3;
            }
            100% {
                transform: scale(2);
                opacity: 0;
            }
        }
        
        /* Orijinal stiller */
        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(25px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            width: 420px;
            max-width: 90vw;
            position: relative;
            z-index: 1;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }
        
        .login-header {
            text-align: center;
        }
        
        .app-name {
            font-size: 28px;
            font-weight: 700;
            color: white;
            margin-bottom: 8px;
            letter-spacing: 1px;
        }
        
        .app-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            font-weight: 400;
        }
        
        .password-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            color: white;
            font-size: 18px;
            font-weight: 600;
            padding: 15px 20px;
            text-align: center;
            letter-spacing: 3px;
            margin: 30px 0 20px 0;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .password-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
            letter-spacing: normal;
        }
        
        .password-input:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
        }

        .keypad {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .key-btn {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            color: white;
            font-size: 24px;
            font-weight: 600;
            height: 65px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .key-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        
        .key-btn:active {
            transform: translateY(0);
            background: rgba(255, 255, 255, 0.3);
        }
        
        .key-clear {
            background: rgba(251, 146, 60, 0.8);
            border-color: rgba(251, 146, 60, 0.3);
        }
        
        .key-clear:hover {
            background: rgba(251, 146, 60, 1);
        }
        
        .key-delete {
            background: rgba(239, 68, 68, 0.8);
            border-color: rgba(239, 68, 68, 0.3);
        }
        
        .key-delete:hover {
            background: rgba(239, 68, 68, 1);
        }
        
        .login-btn {
            width: 100%;
            background: rgba(34, 197, 94, 0.9);
            border: 1px solid rgba(34, 197, 94, 0.3);
            border-radius: 16px;
            color: white;
            font-size: 18px;
            font-weight: 600;
            height: 55px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: none;
        }
        
        .login-btn:hover {
            background: rgba(34, 197, 94, 1);
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(34, 197, 94, 0.4);
        }
        
        .login-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }
        
        .login-btn:disabled:hover {
            background: rgba(34, 197, 94, 0.9);
            transform: none;
            box-shadow: none;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .pulse {
            animation: pulse 0.3s ease-in-out;
        }
        
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 25px;
                width: 350px;
            }
            
            .app-name {
                font-size: 24px;
            }
            
            .password-input {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Gelişmiş arka plan efektleri -->
    <div class="background-effects">
        <!-- Dalgalı şekiller -->
        <div class="wave-shape wave-1"></div>
        <div class="wave-shape wave-2"></div>
        <div class="wave-shape wave-3"></div>
        <div class="wave-shape wave-4"></div>
        
        <!-- Parçacıklar -->
        <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; animation-delay: 3s;"></div>
        <div class="particle" style="left: 30%; animation-delay: 6s;"></div>
        <div class="particle" style="left: 40%; animation-delay: 9s;"></div>
        <div class="particle" style="left: 50%; animation-delay: 12s;"></div>
        <div class="particle" style="left: 60%; animation-delay: 15s;"></div>
        <div class="particle" style="left: 70%; animation-delay: 18s;"></div>
        <div class="particle" style="left: 80%; animation-delay: 2s;"></div>
        <div class="particle" style="left: 90%; animation-delay: 5s;"></div>
        
        <!-- Işık çizgileri -->
        <div class="light-beam beam-1"></div>
        <div class="light-beam beam-2"></div>
        <div class="light-beam beam-3"></div>
        
        <!-- Puls halkaları -->
        <div class="pulse-ring ring-1"></div>
        <div class="pulse-ring ring-2"></div>
        <div class="pulse-ring ring-3"></div>
    </div>

    <!-- Ana giriş paneli -->
    <div class="login-container">
       <div class="login-header">
    <img src="assets/images/yenilogo.png" alt="" height="200" class="auth-logo logo-dark mx-auto">
    <p class="app-subtitle">Kasiyer şifrenizi girin</p>
</div>
        
        <form id="cashierForm">
            <!-- Şifre Input -->
            <input 
                type="password" 
                id="passwordInput" 
                name="password"
                class="password-input" 
                placeholder="Şifrenizi girin"
                maxlength="20"
                autofocus
            >
            
            <!-- Sayı tuş takımı -->
            <div class="keypad">
                <button type="button" class="key-btn" onclick="addDigit('1')">1</button>
                <button type="button" class="key-btn" onclick="addDigit('2')">2</button>
                <button type="button" class="key-btn" onclick="addDigit('3')">3</button>
                <button type="button" class="key-btn" onclick="addDigit('4')">4</button>
                <button type="button" class="key-btn" onclick="addDigit('5')">5</button>
                <button type="button" class="key-btn" onclick="addDigit('6')">6</button>
                <button type="button" class="key-btn" onclick="addDigit('7')">7</button>
                <button type="button" class="key-btn" onclick="addDigit('8')">8</button>
                <button type="button" class="key-btn" onclick="addDigit('9')">9</button>
                <button type="button" class="key-btn key-clear" onclick="clearPassword()">C</button>
                <button type="button" class="key-btn" onclick="addDigit('0')">0</button>
                <button type="button" class="key-btn key-delete" onclick="deleteDigit()">←</button>
            </div>
            
            <!-- Giriş butonu -->
            <button type="submit" class="login-btn" id="loginBtn">
                <span>🔒</span>
                GİRİŞ YAP
            </button>
        </form>
    </div>

    <script>
        // CSRF token ayarla
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        function addDigit(digit) {
            const input = document.getElementById('passwordInput');
            if (input.value.length < 20) {
                input.value += digit;
            }
        }

        function deleteDigit() {
            const input = document.getElementById('passwordInput');
            if (input.value.length > 0) {
                input.value = input.value.slice(0, -1);
            }
        }

        function clearPassword() {
            const input = document.getElementById('passwordInput');
            input.value = '';
        }

        function showError() {
            document.querySelector('.login-container').classList.add('shake');
            setTimeout(() => {
                document.querySelector('.login-container').classList.remove('shake');
            }, 500);
            clearPassword();
        }

        // Form submit eventi
        document.getElementById('cashierForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('passwordInput').value;
            const loginBtn = document.getElementById('loginBtn');
            
            if (!password) {
                showError();
                return;
            }

            // Loading state
            loginBtn.classList.add('loading');
            loginBtn.disabled = true;

            // Form data hazırla
            const formData = new FormData();
            formData.append('password', password);
            formData.append('_token', csrfToken);

            // AJAX ile şifre kontrolü
            fetch('/CashierVerify', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect;
                } else {
                    showError();
                }
            })
            .catch(error => {
                console.error('Hata:', error);
                showError();
            })
            .finally(() => {
                // Loading state kaldır
                loginBtn.classList.remove('loading');
                loginBtn.disabled = false;
            });
        });

        // Enter tuşu için
        document.getElementById('passwordInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('cashierForm').dispatchEvent(new Event('submit'));
            }
        });
        
        // Dinamik parçacık oluşturma
        function createRandomParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 10 + 's';
            particle.style.animationDuration = (15 + Math.random() * 15) + 's';
            document.querySelector('.background-effects').appendChild(particle);
            
            // Parçacığı belirli bir süre sonra kaldır
            setTimeout(() => {
                particle.remove();
            }, 30000);
        }
        
        // Her 2 saniyede bir yeni parçacık oluştur
        setInterval(createRandomParticle, 2000);
    </script>
</body>
</html>