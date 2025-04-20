<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garbage Buddy - Camera</title>
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

        /* Camera Section */
        .camera-section {
            padding: 8rem 2rem 4rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .camera-container {
            background: var(--white);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 2.5rem;
            margin-top: 2rem;
            transition: var(--transition);
        }

        .camera-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--accent-color);
        }

        .form-group input {
            width: 100%;
            padding: 1rem;
            border: 2px solid #eee;
            border-radius: 8px;
            font-family: inherit;
            transition: var(--transition);
        }

        .form-group input:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0,166,81,0.1);
        }

        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #eee;
            border-radius: 8px;
            font-family: inherit;
            transition: var(--transition);
            min-height: 100px;
            resize: vertical;
        }

        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0,166,81,0.1);
        }

        input[type="datetime-local"] {
            width: 100%;
            padding: 1rem;
            border: 2px solid #eee;
            border-radius: 8px;
            font-family: inherit;
            transition: var(--transition);
        }

        input[type="datetime-local"]:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(0,166,81,0.1);
        }

        /* Camera Button Styles */
        .camera-btn-container {
        text-align: center;
            margin: 2rem 0;
        }

        .camera-btn {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 2rem;
            background: var(--gradient-secondary);
            color: var(--white);
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(255,107,0,0.3);
        }

        .camera-btn i {
            font-size: 1.5rem;
            animation: pulse 2s infinite;
        }

        .camera-btn:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 20px rgba(255,107,0,0.4);
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Photo Preview */
        .photo-container {
            margin-top: 2rem;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .photo-preview {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .photo-preview:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }

        .photo-preview img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .delete-btn {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: rgba(255,0,0,0.8);
            color: var(--white);
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        cursor: pointer;
            transition: var(--transition);
        }

        .delete-btn:hover {
            background: rgba(255,0,0,1);
            transform: scale(1.1);
        }

        /* Footer */
        .footer {
            background: var(--gradient-primary);
            color: var(--white);
            padding: 4rem 2rem;
            margin-top: 4rem;
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

            .camera-section {
                padding: 6rem 1rem 2rem;
            }

            .camera-container {
                padding: 1.5rem;
            }

            .photo-container {
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
                <a href="#photos">PHOTOS</a>
                <a href="#contact">CONTACT</a>
            </nav>
        </div>
    </header>

    <!-- Camera Section -->
    <section class="camera-section">
        <div class="camera-container">
            <form action="submission_details.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" placeholder="Enter the location" required>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                    <input type="hidden" id="time" name="time">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Enter description of the garbage" required></textarea>
                </div>

                <div class="camera-btn-container">
                    <input type="file" accept="image/*" capture="environment" id="cameraInput" name="photo" style="display: none;">
                    <button type="button" class="camera-btn" id="cameraButton">
                        <i class="fas fa-camera"></i>
                        Take Photo
                    </button>
</div>

                <div id="photoContainer" class="photo-container"></div>

                <div class="form-group" style="text-align: center; margin-top: 2rem;">
                    <button type="submit" class="camera-btn" style="background: var(--gradient-primary);">
                        <i class="fas fa-paper-plane"></i>
                        Submit
                    </button>
                </div>
            </form>
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

<script>
document.getElementById('cameraButton').addEventListener('click', function() {
            document.getElementById('cameraInput').click();
});

document.getElementById('cameraInput').addEventListener('change', function(event) {
            var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function(event) {
                var imageUrl = event.target.result;
                var photoContainer = document.getElementById('photoContainer');
                
                // Clear previous preview if any
                photoContainer.innerHTML = '';
                
        var photoDiv = document.createElement('div');
                photoDiv.className = 'photo-preview';
                
                var img = document.createElement('img');
                img.src = imageUrl;
                
                var deleteBtn = document.createElement('button');
                deleteBtn.className = 'delete-btn';
                deleteBtn.innerHTML = '<i class="fas fa-times"></i>';
                deleteBtn.addEventListener('click', function() {
                    photoContainer.removeChild(photoDiv);
                    document.getElementById('cameraInput').value = '';
                });
                
                photoDiv.appendChild(img);
                photoDiv.appendChild(deleteBtn);
        photoContainer.appendChild(photoDiv);
    };

    reader.readAsDataURL(file);
});

        document.querySelector('form').addEventListener('submit', function(e) {
            // Get current time
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const currentTime = `${hours}:${minutes}:${seconds}`;
            
            // Set the hidden time input value
            document.getElementById('time').value = currentTime;
        });
    </script>
</body>
</html>