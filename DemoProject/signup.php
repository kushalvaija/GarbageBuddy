<!DOCTYPE html>
<html>
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }

        .form-header h1 {
            margin-bottom: 5px;
            font-size: 24px;
        }

        .form-header p {
            opacity: 0.9;
        }

        .form-content {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        input[type=text], input[type=password] {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input[type=text]:focus, input[type=password]:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            outline: none;
        }

        .remember-me {
            display: flex;
            align-items: center;
            margin: 15px 0;
        }

        .remember-me input[type="checkbox"] {
            margin-right: 10px;
            width: 18px;
            height: 18px;
        }

        .terms {
            margin: 15px 0;
            color: #666;
            font-size: 13px;
        }

        .terms a {
            color: #667eea;
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        button {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .cancelbtn {
            background-color: #f1f1f1;
            color: #333;
        }

        .cancelbtn:hover {
            background-color: #e0e0e0;
        }

        .signupbtn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .signupbtn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .nav-links {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }

        .nav-link, .nav-link1 {
            text-decoration: none;
            padding: 8px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
            text-align: center;
            min-width: 100px;
            font-size: 14px;
        }

        .nav-link {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
            border: none;
        }

        .nav-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .nav-link1 {
            background: linear-gradient(135deg, #007BFF 0%, #0056b3 100%);
            color: white;
            border: none;
        }

        .nav-link1:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        @media (max-width: 480px) {
            .button-group {
                flex-direction: column;
            }
            
            .nav-links {
                flex-direction: column;
                align-items: center;
                gap: 15px;
            }

            .nav-link, .nav-link1 {
                width: 100%;
                max-width: 200px;
            }
        }

        /* Wave Animation */
        .wave-container {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 200px;
            overflow: hidden;
            z-index: 0;
        }

        .wave {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 200%;
            height: 200px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: 1200px 200px;
            animation: wave 15s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
            transform-origin: bottom center;
        }

        .wave:nth-child(2) {
            bottom: 10px;
            opacity: 0.5;
            animation: wave 12s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite reverse;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="rgba(255,255,255,0.1)"/></svg>');
        }

        .wave:nth-child(3) {
            bottom: 20px;
            opacity: 0.2;
            animation: wave 18s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" fill="rgba(255,255,255,0.1)"/></svg>');
        }

        @keyframes wave {
            0% {
                transform: translateX(0) translateY(0) rotate(0deg) scaleY(1);
            }
            25% {
                transform: translateX(-25%) translateY(20px) rotate(2deg) scaleY(1.1);
            }
            50% {
                transform: translateX(-50%) translateY(0) rotate(0deg) scaleY(1);
            }
            75% {
                transform: translateX(-75%) translateY(-20px) rotate(-2deg) scaleY(0.9);
            }
            100% {
                transform: translateX(-100%) translateY(0) rotate(0deg) scaleY(1);
            }
        }

        /* Particle Animation */
        .particles {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 200px;
            z-index: 1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            left: 10%;
            bottom: 20%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            left: 30%;
            bottom: 30%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            left: 50%;
            bottom: 25%;
            animation-delay: 4s;
        }

        .particle:nth-child(4) {
            left: 70%;
            bottom: 35%;
            animation-delay: 6s;
        }

        .particle:nth-child(5) {
            left: 90%;
            bottom: 15%;
            animation-delay: 8s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) translateX(0) scale(1);
                opacity: 0;
            }
            25% {
                transform: translateY(-30px) translateX(15px) scale(1.2);
                opacity: 0.5;
            }
            50% {
                transform: translateY(-60px) translateX(0) scale(1);
                opacity: 0.8;
            }
            75% {
                transform: translateY(-90px) translateX(-15px) scale(0.8);
                opacity: 0.5;
            }
            100% {
                transform: translateY(-120px) translateX(0) scale(1);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Wave Animation -->
    <div class="wave-container">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>

    <!-- Particle Animation -->
    <div class="particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="form-container">
        <div class="form-header">
            <h1>Sign Up</h1>
            <p>Please fill in this form to create an account.</p>
        </div>
        
        <form action="connect_signup.php" method="POST">
            <div class="form-content">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" placeholder="Enter Email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="psw">Password</label>
                    <input type="password" placeholder="Enter Password" name="psw" required>
                </div>

                <div class="form-group">
                    <label for="psw-repeat">Repeat Password</label>
                    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
                </div>

                <div class="remember-me">
                    <input type="checkbox" checked="checked" name="remember">
                    <label>Remember me</label>
                </div>

                <div class="terms">
                    By creating an account you agree to our <a href="#">Terms & Privacy</a>.
                </div>

                <div class="button-group">
                    <button type="button" class="cancelbtn" onclick="window.location.href='home.php'">Cancel</button>
                    <button type="submit" class="signupbtn">Sign Up</button>
                </div>

                <div class="nav-links">
                    <a href="home.php" class="nav-link">HOME</a>
                    <a href="login.php" class="nav-link1">LOGIN</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
