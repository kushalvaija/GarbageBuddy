<?php
session_start();
require_once 'connect_submission.php';

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['user_email'];
$submissions = getUserSubmissions($con, $user_email);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Submissions - Clean City</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #00A651;
            --secondary: #FF6B00;
            --accent: #2C3E50;
            --text: #333333;
            --light: #F5F5F5;
            --white: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            backdrop-filter: blur(10px);
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            color: var(--primary);
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .header p {
            color: var(--text);
            font-size: 1.1rem;
        }

        .submissions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .submission-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .submission-card:hover {
            transform: translateY(-5px);
        }

        .submission-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .submission-details {
            padding: 1.5rem;
        }

        .submission-details h3 {
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .submission-info {
            margin-bottom: 1rem;
        }

        .submission-info p {
            color: var(--text);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .submission-info i {
            color: var(--secondary);
            margin-right: 0.5rem;
            width: 20px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: var(--white);
        }

        .btn-secondary {
            background: var(--light);
            color: var(--text);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .no-submissions {
            text-align: center;
            padding: 3rem;
            color: var(--text);
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .submissions-grid {
                grid-template-columns: 1fr;
            }

            .action-buttons {
                flex-direction: column;
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
            <h1>My Submissions</h1>
            <p>View all your reported issues and their status</p>
        </div>

        <?php if (empty($submissions)): ?>
            <div class="no-submissions">
                <h3>No submissions yet</h3>
                <p>Start contributing by reporting issues in your area</p>
            </div>
        <?php else: ?>
            <div class="submissions-grid">
                <?php foreach ($submissions as $submission): ?>
                    <div class="submission-card">
                        <img src="<?php echo htmlspecialchars($submission['photo_path']); ?>" alt="Submission Photo" class="submission-image">
                        <div class="submission-details">
                            <h3><?php echo htmlspecialchars($submission['location']); ?></h3>
                            <div class="submission-info">
                                <p><i class="fas fa-user"></i> <?php echo htmlspecialchars($submission['name']); ?></p>
                                <p><i class="fas fa-phone"></i> <?php echo htmlspecialchars($submission['phone']); ?></p>
                                <p><i class="fas fa-calendar"></i> <?php echo date('F j, Y', strtotime($submission['date'])); ?></p>
                                <p><i class="fas fa-clock"></i> <?php echo htmlspecialchars($submission['time']); ?></p>
                                <p><i class="fas fa-info-circle"></i> <?php echo htmlspecialchars($submission['description']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="action-buttons">
            <a href="camera.php" class="btn btn-primary">
                <i class="fas fa-camera"></i>
                Submit New Issue
            </a>
            <a href="home.php" class="btn btn-secondary">
                <i class="fas fa-home"></i>
                Back to Home
            </a>
        </div>
    </div>
</body>
</html> 