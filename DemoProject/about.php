<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Garbage Buddy</title>
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
            color: var(--white);
        }

        .hero-content h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }

        .hero-content p {
            font-size: 1.4rem;
            margin-bottom: 2.5rem;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        /* Mission Section */
        .mission {
            padding: 8rem 2rem;
            background: var(--white);
        }

        .mission-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .mission-text h2 {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .mission-text p {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            color: var(--text-color);
        }

        .mission-image {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }

        .mission-image img {
            width: 100%;
            height: auto;
            display: block;
            transition: var(--transition);
        }

        .mission-image:hover img {
            transform: scale(1.05);
        }

        /* Services Section */
        .services {
            padding: 8rem 2rem;
            background: var(--light-bg);
        }

        .services-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
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
            text-align: center;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .service-card i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }

        .service-card h3 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        /* Impact Section */
        .impact {
            padding: 8rem 2rem;
            background: var(--white);
        }

        .impact-content {
            max-width: 1200px;
            margin: 0 auto;
        }

        .impact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2.5rem;
        }

        .impact-card {
            text-align: center;
            padding: 2.5rem;
            background: var(--light-bg);
            border-radius: 15px;
            transition: var(--transition);
        }

        .impact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .impact-card i {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .impact-card h3 {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        /* Footer */
        .footer {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 4rem 2rem;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2.5rem;
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
        }

        .social-links a:hover {
            color: var(--secondary-color);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
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

            .mission-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .services-grid,
            .impact-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <a href="home.php" class="logo">
                <i class="fas fa-recycle"></i>
                Garbage Buddy
            </a>
            <nav class="nav-links">
                <a href="login.php">LOGIN</a>
                <a href="home.php">HOME</a>
                <a href="#about">ABOUT</a>
                <a href="photos.php">PHOTOS</a>
                <a href="contact.php">CONTACT</a>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <video autoplay muted loop playsinline>
            <source src="backdemo.mp4" type="video/mp4">
        </video>
        <div class="hero-content" data-aos="fade-up">
            <h1>Making Our City Cleaner</h1>
            <p>Join us in our mission to create a cleaner, greener environment by reporting plastic waste in your neighborhood.</p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission" id="about">
        <div class="mission-content">
            <div class="mission-text" data-aos="fade-right">
                <h2>Our Mission</h2>
                <p>Garbage Buddy is a community-driven initiative that empowers citizens to report plastic waste in their neighborhoods. By simply taking a photo and sharing the location, you can help our waste management teams efficiently collect and dispose of plastic waste.</p>
                <p>Our platform connects concerned citizens with waste management services, making it easier to keep our streets clean and our environment healthy.</p>
            </div>
            <div class="mission-image" data-aos="fade-left">
                <img src="pic1.png" alt="Clean Environment">
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="services-content">
            <div class="section-title" data-aos="fade-up">
                <h2>Our Services</h2>
                <p>Making waste management efficient and effective</p>
            </div>
            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-camera"></i>
                    <h3>Photo Reporting</h3>
                    <p>Easily report plastic waste by taking photos and sharing locations</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-map-marker-alt"></i>
                    <h3>Location Tracking</h3>
                    <p>Accurate location tracking for efficient waste collection</p>
                </div>
                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-truck"></i>
                    <h3>Waste Collection</h3>
                    <p>Timely collection and proper disposal of reported waste</p>
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
                    <i class="fas fa-trash-alt"></i>
                    <h3>1000+</h3>
                    <p>Reports Handled</p>
                </div>
                <div class="impact-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-users"></i>
                    <h3>500+</h3>
                    <p>Active Users</p>
                </div>
                <div class="impact-card" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-map-marked-alt"></i>
                    <h3>50+</h3>
                    <p>Areas Covered</p>
                </div>
                <div class="impact-card" data-aos="fade-up" data-aos-delay="400">
                    <i class="fas fa-leaf"></i>
                    <h3>100%</h3>
                    <p>Environment Friendly</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div>
                <h3>Garbage Buddy</h3>
                <p>Making our city cleaner, one click at a time.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
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
            once: true
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