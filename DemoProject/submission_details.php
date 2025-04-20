<?php
session_start();
require_once 'connect_submission.php';

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['user_email'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $description = $_POST['description'];
    
    // Handle photo upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['photo'];
        $tmp_name = $file['tmp_name'];
        $name = $file['name'];
        
        // Create uploads directory if it doesn't exist
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }
        
        // Generate unique filename
        $extension = pathinfo($name, PATHINFO_EXTENSION);
        $unique_name = uniqid() . '_' . time() . '.' . $extension;
        $upload_path = "uploads/" . $unique_name;
        
        if (move_uploaded_file($tmp_name, $upload_path)) {
            // Save submission to database
            if (saveSubmission($con, $user_email, $name, $phone, $location, $date, $time, $description, $upload_path)) {
                $success_message = "Submission saved successfully!";
            } else {
                $error_message = "Failed to save submission. Please try again.";
            }
        } else {
            $error_message = "Failed to upload photo. Please try again.";
        }
    } else {
        $error_message = "No photo was uploaded. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Details - Garbage Buddy</title>
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
            background: var(--light-bg);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at top right, rgba(0, 166, 81, 0.1), transparent 50%),
                        radial-gradient(circle at bottom left, rgba(255, 107, 0, 0.1), transparent 50%);
            z-index: -1;
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 800px;
            transition: var(--transition);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin: 1rem auto;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }

        .header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--gradient-secondary);
            border-radius: 4px;
        }

        .header p {
            color: var(--text-color);
            font-size: 1.1rem;
            opacity: 0.8;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .detail-card {
            background: var(--white);
            padding: 1.2rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .detail-card h3 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .detail-card p {
            color: var(--text-color);
            font-size: 1rem;
            line-height: 1.4;
        }

        .photo-section {
            margin-top: 2rem;
            text-align: center;
        }

        .photo-section h2 {
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .photo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .photo-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .photo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .photo-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            border: none;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(0,166,81,0.3);
        }

        .btn-secondary {
            background: var(--gradient-secondary);
            color: var(--white);
            box-shadow: 0 4px 15px rgba(255,107,0,0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.2);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1.5rem;
                margin: 0.5rem;
            }

            .details-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .photo-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
                gap: 0.8rem;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Submission Details</h1>
            <p>Thank you for your contribution to keeping our city clean!</p>
        </div>

        <?php if (isset($success_message)): ?>
            <div class="alert alert-success">
                <?php echo $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-error">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="details-grid">
            <div class="detail-card">
                <h3><i class="fas fa-user"></i> Name</h3>
                <p><?php echo htmlspecialchars($_POST['name'] ?? 'Not provided'); ?></p>
            </div>
            <div class="detail-card">
                <h3><i class="fas fa-phone"></i> Phone Number</h3>
                <p><?php echo htmlspecialchars($_POST['phone'] ?? 'Not provided'); ?></p>
            </div>
            <div class="detail-card">
                <h3><i class="fas fa-map-marker-alt"></i> Location</h3>
                 <p>
                     <?php
                         $location = $_POST['location'] ?? 'Not provided';
                         if ($location !== 'Not provided') {
                        $mapLink = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($location);
                         echo '<a href="' . $mapLink . '" target="_blank">' . htmlspecialchars($location) . '</a>';
                        } else {
                      echo $location;
                      }
                         ?>
                 </p>
            </div>

            <div class="detail-card">
                <h3><i class="fas fa-calendar"></i> Date</h3>
                <p><?php echo htmlspecialchars($_POST['date'] ?? 'Not provided'); ?></p>
            </div>
            <div class="detail-card">
                <h3><i class="fas fa-clock"></i> Time</h3>
                <p><?php echo htmlspecialchars($_POST['time'] ?? 'Not provided'); ?></p>
            </div>
            <div class="detail-card">
                <h3><i class="fas fa-info-circle"></i> Description</h3>
                <p><?php echo htmlspecialchars($_POST['description'] ?? 'Not provided'); ?></p>
            </div>
        </div>

        <div class="photo-section">
            <h2>Submitted Photo</h2>
            <div class="photo-grid">
                <?php
                if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                    $file = $_FILES['photo'];
                    $tmp_name = $file['tmp_name'];
                    $name = $file['name'];
                    
                    // Create uploads directory if it doesn't exist
                    if (!file_exists('uploads')) {
                        mkdir('uploads', 0777, true);
                    }
                    
                    // Generate unique filename
                    $extension = pathinfo($name, PATHINFO_EXTENSION);
                    $unique_name = uniqid() . '_' . time() . '.' . $extension;
                    $upload_path = "uploads/" . $unique_name;
                    
                    if (move_uploaded_file($tmp_name, $upload_path)) {
                        echo '<div class="photo-card" data-aos="fade-up">';
                        echo '<img src="' . htmlspecialchars($upload_path) . '" alt="Submitted photo">';
                        echo '</div>';
                    } else {
                        echo '<p class="error-message">Failed to upload photo. Please try again.</p>';
                    }
                } else {
                    echo '<p class="error-message">No photo was uploaded. Please try again.</p>';
                }
                ?>
            </div>
        </div>

        <div class="action-buttons">
            <a href="camera.php" class="btn btn-primary">
                <i class="fas fa-camera"></i>
                Submit Another
            </a>
            <a href="my_submissions.php" class="btn btn-secondary">
                <i class="fas fa-list"></i>
                View My Submissions
            </a>
            <a href="home.php" class="btn btn-secondary">
                <i class="fas fa-home"></i>
                Back to Home
            </a>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });
    </script>
</body>
</html> 