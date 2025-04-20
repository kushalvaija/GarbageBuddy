<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery - Garbage Buddy</title>
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
        }

        .gallery-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .gallery-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .gallery-header h1 {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .gallery-header p {
            color: var(--text-color);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .filter-buttons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .filter-btn {
            padding: 0.8rem 1.5rem;
            background: var(--white);
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-color);
            color: var(--white);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
        }

        .gallery-item {
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .gallery-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            display: block;
        }

        .gallery-item-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            padding: 1.5rem;
            color: var(--white);
            transform: translateY(100%);
            transition: var(--transition);
        }

        .gallery-item:hover .gallery-item-overlay {
            transform: translateY(0);
        }

        .gallery-item-category {
            font-size: 0.9rem;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
        }

        .gallery-item-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .gallery-item-description {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .gallery-container {
                padding: 2rem 1rem;
            }

            .gallery-header h1 {
                font-size: 2rem;
            }

            .filter-buttons {
                gap: 0.5rem;
            }

            .filter-btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }

            .gallery-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="gallery-container">
        <div class="gallery-header" data-aos="fade-up">
            <h1>Our Photo Gallery</h1>
            <p>Explore our journey in waste management and recycling through these inspiring images</p>
        </div>

        <div class="filter-buttons" data-aos="fade-up" data-aos-delay="100">
            <button class="filter-btn active" data-category="all">All Categories</button>
            <button class="filter-btn" data-category="before-after">Before and After Cleanup</button>
            <button class="filter-btn" data-category="recycling">Recycling Process</button>
            <button class="filter-btn" data-category="community">Community Engagement</button>
            <button class="filter-btn" data-category="collection">Waste Collection</button>
            <button class="filter-btn" data-category="environment">Environmental Impact</button>
            <button class="filter-btn" data-category="education">Educational Content</button>
            <button class="filter-btn" data-category="success">Success Stories</button>
            <button class="filter-btn" data-category="infrastructure">Infrastructure</button>
            <button class="filter-btn" data-category="awareness">Awareness Campaign</button>
            <button class="filter-btn" data-category="technology">Technology Integration</button>
        </div>

        <div class="gallery-grid">
            <div class="gallery-item" data-aos="fade-up">
                <img src="pic1.png" alt="Waste Management">
                <div class="gallery-item-overlay">
                    <div class="gallery-item-category">Waste Collection</div>
                    <div class="gallery-item-title">Efficient Collection</div>
                    <div class="gallery-item-description">Our team collecting waste from residential areas</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up">
                <img src="pic2.png" alt="Recycling Process">
                <div class="gallery-item-overlay">
                    <div class="gallery-item-category">Recycling</div>
                    <div class="gallery-item-title">Sorting Facility</div>
                    <div class="gallery-item-description">Advanced sorting process for recyclable materials</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up">
                <img src="pic3.png" alt="Community Cleanup">
                <div class="gallery-item-overlay">
                    <div class="gallery-item-category">Community</div>
                    <div class="gallery-item-title">Cleanup Drive</div>
                    <div class="gallery-item-description">Local residents participating in cleanup activities</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up">
                <img src="pic4.png" alt="Waste Processing">
                <div class="gallery-item-overlay">
                    <div class="gallery-item-category">Processing</div>
                    <div class="gallery-item-title">Waste Processing</div>
                    <div class="gallery-item-description">Modern waste processing facility in action</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up">
                <img src="pic5.png" alt="Environmental Impact">
                <div class="gallery-item-overlay">
                    <div class="gallery-item-category">Environment</div>
                    <div class="gallery-item-title">Clean Environment</div>
                    <div class="gallery-item-description">Results of our waste management efforts</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up">
                <img src="pic6.png" alt="Team Work">
                <div class="gallery-item-overlay">
                    <div class="gallery-item-category">Team</div>
                    <div class="gallery-item-title">Dedicated Team</div>
                    <div class="gallery-item-description">Our team working together for a cleaner city</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });

        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const galleryItems = document.querySelectorAll('.gallery-item');

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                button.classList.add('active');

                const category = button.getAttribute('data-category');

                galleryItems.forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html> 