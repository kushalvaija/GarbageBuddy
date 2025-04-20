<?php
// Database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'rohith';

// Create connection
$con = new mysqli($host, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Get form data
$EMAIL = $_POST['email'];
$PASS_WORD = $_POST['psw'];

// Prepared statement to fetch data
$stmt = $con->prepare("SELECT email, psw FROM signup WHERE email = ?");
$stmt->bind_param("s", $EMAIL);
$stmt->execute();
$stmt->store_result();

// Check if user exists
if ($stmt->num_rows === 1) {
    $stmt->bind_result($db_email, $db_password);
    $stmt->fetch();

    // Verify password
    if ($PASS_WORD === $db_password) {
        // Start session and store user email
        session_start();
        $_SESSION['user_email'] = $EMAIL;
        $_SESSION['success'] = "Login Successful! Welcome back!";
        
        // Redirect to home page
        header("Location: home.php");
        exit();
    } else {
        echo "Incorrect password";
    }
} else {
    echo "User not found";
}

$stmt->close();
$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garbage Buddy - One Click Can Change Our City</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        :root {
            --primary-color: #00A651;
            --secondary-color: #FF6B00;
            --accent-color: #2C3E50;
            --text-color: #333333;
            --light-bg: #F5F5F5;
            --white: #FFFFFF;
            --transition: all 0.3s ease;
            --gradient-primary: linear-gradient(135deg, #00A651 0%, #00843D 100%);
            --gradient-secondary: linear-gradient(135deg, #FF6B00 0%, #FF8C00 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            overflow-x: hidden;
            background: var(--light-bg);
        }

        /* Floating Background Elements */
        .floating-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(0, 166, 81, 0.1);
            animation: float 15s infinite ease-in-out;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -150px;
            animation-delay: 0s;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            left: -100px;
            animation-delay: 2s;
        }

        .circle-3 {
            width: 150px;
            height: 150px;
            top: 50%;
            right: 10%;
            animation-delay: 4s;
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            50% {
                transform: translate(20px, 20px) rotate(180deg);
            }
            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        /* Header Styles */
        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: var(--transition);
        }

        .header.scrolled {
            background: var(--white);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo i {
            font-size: 2rem;
            color: var(--secondary-color);
            animation: spin 10s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .nav-links {
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            color: var(--text-color);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: var(--transition);
            position: relative;
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: var(--transition);
            transform: translateX(-50%);
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Camera Button Styles */
        .camera-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 1000;
            background: var(--gradient-secondary);
            color: var(--white);
            padding: 1.5rem;
            border-radius: 50%;
            box-shadow: 0 4px 15px rgba(255,107,0,0.3);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            animation: pulse 2s infinite;
        }

        .camera-btn i {
            font-size: 2rem;
            animation: float 3s ease-in-out infinite;
        }

        .camera-btn span {
            font-size: 0.9rem;
            font-weight: 600;
            opacity: 0;
            transform: translateY(20px);
            transition: var(--transition);
        }

        .camera-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(255,107,0,0.4);
        }

        .camera-btn:hover span {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 4px 15px rgba(255,107,0,0.3);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 6px 20px rgba(255,107,0,0.4);
            }
            100% {
                transform: scale(1);
                box-shadow: 0 4px 15px rgba(255,107,0,0.3);
            }
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        @media (max-width: 768px) {
            .camera-btn {
                bottom: 1.5rem;
                right: 1.5rem;
                padding: 1.2rem;
            }

            .camera-btn i {
                font-size: 1.8rem;
            }

            .camera-btn span {
                font-size: 0.8rem;
            }
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            padding: 0 2rem;
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--white);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            animation: fadeInUp 1s ease-out;
        }

        .hero-content p {
            font-size: 1.4rem;
            margin-bottom: 2.5rem;
            color: var(--white);
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            animation: fadeInUp 1s ease-out 0.3s backwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: var(--gradient-secondary);
            color: var(--white);
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(255,107,0,0.3);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 1s ease-out 0.6s backwards;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 20px rgba(255,107,0,0.4);
        }

        /* Services Section */
        .services {
            padding: 8rem 2rem;
            background: var(--light-bg);
            position: relative;
        }

        .services::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1581093458791-9d0a0a1a0f5c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center/cover;
            opacity: 0.05;
            z-index: 0;
        }

        .services-content {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 2px;
            animation: expand 1s ease-out;
        }

        @keyframes expand {
            from { width: 0; }
            to { width: 80px; }
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
        }

        .service-card {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.5s ease;
        }

        .service-card:hover::before {
            transform: scaleX(1);
        }

        .service-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .service-card i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }

        .service-card:hover i {
            transform: scale(1.2) rotate(10deg);
        }

        .service-card h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        /* Impact Section */
        .impact {
            padding: 8rem 2rem;
            background: var(--white);
            position: relative;
        }

        .impact-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .impact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2.5rem;
            margin-top: 3rem;
        }

        .impact-card {
            text-align: center;
            padding: 2.5rem;
            background: var(--light-bg);
            border-radius: 15px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .impact-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--gradient-primary);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.5s ease;
        }

        .impact-card:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        .impact-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .impact-card i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            transition: var(--transition);
        }

        .impact-card:hover i {
            transform: scale(1.2) rotate(10deg);
        }

        .impact-card h3 {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        /* Contact Section */
        .contact {
            padding: 8rem 2rem;
            background: var(--light-bg);
            position: relative;
        }

        .contact-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
            margin-top: 3rem;
        }

        .contact-info {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .contact-info:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .contact-info h3 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .contact-info p {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .contact-info i {
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .contact-form {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .contact-form:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #eee;
            border-radius: 8px;
            font-family: inherit;
            transition: var(--transition);
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0,166,81,0.1);
        }

        /* Footer */
        .footer {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 4rem 2rem;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1581093458791-9d0a0a1a0f5c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') center/cover;
            opacity: 0.1;
            z-index: 0;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem;
            position: relative;
            z-index: 1;
        }

        .footer-section h3 {
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            position: relative;
            display: inline-block;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--secondary-color);
            animation: expand 1s ease-out;
        }

        .footer-section ul {
            list-style: none;
        }

        .footer-section ul li {
            margin-bottom: 1rem;
        }

        .footer-section ul li a {
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-section ul li a:hover {
            color: var(--secondary-color);
            transform: translateX(5px);
        }

        .social-links {
            display: flex;
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .social-links a {
            color: var(--white);
            font-size: 1.5rem;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
        }

        .social-links a:hover {
            color: var(--secondary-color);
            background: var(--white);
            transform: translateY(-3px) rotate(360deg);
        }

        .footer-bottom {
            text-align: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            position: relative;
            z-index: 1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1.2rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .services-grid,
            .impact-grid,
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Animations */
        [data-aos] {
            opacity: 0;
            transition-property: transform, opacity;
        }

        [data-aos].aos-animate {
            opacity: 1;
        }

        /* Success Message Styles */
        .success-message {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #00A651 0%, #00843D 100%);
            color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 166, 81, 0.3);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.5s ease-out, fadeOut 0.5s ease-out 4.5s forwards;
            transform: translateX(0);
        }

        .success-message i {
            font-size: 1.2rem;
            animation: bounce 1s infinite;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-5px);
            }
        }
    </style>
</head>
<body>
    <?php
    if (isset($_SESSION['success'])) {
        echo '<div class="success-message">
                <i class="fas fa-check-circle"></i>
                ' . $_SESSION['success'] . '
              </div>';
        unset($_SESSION['success']);
    }
    ?>
    <!-- Floating Background -->
    <div class="floating-bg">
        <div class="floating-circle circle-1"></div>
        <div class="floating-circle circle-2"></div>
        <div class="floating-circle circle-3"></div>
    </div>

    <!-- Camera Button -->
    <a href="camera.php" class="camera-btn">
        <i class="fas fa-camera"></i>
        <span>Take Photo</span>
    </a>

    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="#" class="logo">
                <i class="fas fa-recycle"></i>
                Garbage Buddy
            </a>
            <nav class="nav-links">
                <a href="login.php">LOGIN</a>
                <a href="home.php">HOME</a>
                <a href="#about">ABOUT</a>
                <a href="#photos">PHOTOS</a>
                <a href="#contact">CONTACT</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <video autoplay muted loop playsinline>
            <source src="backdemo.mp4" type="video/mp4">
        </video>
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
            <h1>Got scrap? Sell it to us.</h1>
            <p>Sell us your recyclable wastes and help contribute to the circular economy.</p>
            <a href="signup.php" class="btn">Get Started</a>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="services-content">
            <div class="section-title" data-aos="fade-up">
                <h2>Our Services</h2>
                <p>Attaining sustainable solutions with ease.</p>
            </div>
            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-trash-alt"></i>
                    <h3>Scrap Collection</h3>
                    <p>Digitised solution for the door-to-door free pickup of 40+ recyclables</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-leaf"></i>
                    <h3>Zero Waste Society</h3>
                    <p>Serving the Residential Societies in achieving their zero waste goals.</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-car"></i>
                    <h3>Vehicle Scrapping</h3>
                    <p>Assisting people in getting rid of their old vehicles sustainably</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Impact Section -->
    <section class="impact">
        <div class="impact-content">
            <div class="section-title" data-aos="fade-up">
                <h2>Our Impact</h2>
                <p>Making a difference in our community</p>
            </div>
            <div class="impact-grid">
                <div class="impact-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-handshake"></i>
                    <h3>11+</h3>
                    <p>Partners</p>
                </div>
                <div class="impact-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-project-diagram"></i>
                    <h3>55+</h3>
                    <p>Projects Done</p>
                </div>
                <div class="impact-card" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-smile"></i>
                    <h3>89+</h3>
                    <p>Happy Clients</p>
                </div>
                <div class="impact-card" data-aos="fade-up" data-aos-delay="400">
                    <i class="fas fa-calendar-check"></i>
                    <h3>150+</h3>
                    <p>Meetings</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact">
        <div class="contact-content">
            <div class="section-title" data-aos="fade-up">
                <h2>Contact Us</h2>
                <p>Get in touch with our team</p>
            </div>
            <div class="contact-grid">
                <div class="contact-info" data-aos="fade-right">
                    <h3>Contact Information</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Hyderabad, Telangana</p>
                    <p><i class="fas fa-phone"></i> +91 54682558554</p>
                    <p><i class="fas fa-envelope"></i> garbagebuddy@mail.com</p>
                </div>
                <div class="contact-form" data-aos="fade-left">
                    <form action="/action_page.php" method="post">
                        <div class="form-group">
                            <input type="text" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Subject" required>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Message" required></textarea>
                        </div>
                        <button type="submit" class="btn">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Garbage Buddy</h3>
                <p>Making our city cleaner, one click at a time.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="home (3).php"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="#about"><i class="fas fa-chevron-right"></i> About</a></li>
                    <li><a href="#photos"><i class="fas fa-chevron-right"></i> Photos</a></li>
                    <li><a href="#contact"><i class="fas fa-chevron-right"></i> Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
                <ul>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> Hyderabad, Telangana</a></li>
                    <li><a href="#"><i class="fas fa-phone"></i> +91 54682558554</a></li>
                    <li><a href="#"><i class="fas fa-envelope"></i> garbagebuddy@mail.com</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Garbage Buddy. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });

        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>