<?php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Verification</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
        }
        .upload-label {
            display: inline-block;
            margin-bottom: 10px;
        }
        input[type="file"] {
            display: none;
        }
        .upload-label {
            border: 1px solid #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        button {
            display: inline-block;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        #result {
            margin-top: 20px;
        }
        .photoPreview {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }
        .photoDiv {
            margin-top: 20px;
            position: relative;
        }
        .deleteButton {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: red;
            color: white;
            border: none;
            padding: 5px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Image Verification</h1>
        <form id="uploadForm">
            <label for="imageUpload" class="upload-label">Select an image</label>
            <input type="file" id="imageUpload" name="imageUpload" accept="image/*">
            <button type="submit">Verify Image</button>
        </form>
        <div id="result"></div>
        <div id="photoContainer"></div>
        <div><a href="coupon.php" class="nav-item nav-link"><button type="button">Submit and Get Coupon</button></a></div>
    </div>

    <script>
        document.getElementById('imageUpload').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function(event) {
                var imageUrl = event.target.result;

                var newImage = document.createElement('img');
                newImage.src = imageUrl;
                newImage.className = 'photoPreview';

                var photoContainer = document.getElementById('photoContainer');
                var photoDiv = document.createElement('div');
                photoDiv.className = 'photoDiv';
                photoDiv.appendChild(newImage);

                var deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.className = 'deleteButton';
                deleteButton.addEventListener('click', function() {
                    photoContainer.removeChild(photoDiv);
                });
                photoDiv.appendChild(deleteButton);

                photoContainer.appendChild(photoDiv);
            };

            reader.readAsDataURL(file);
        });

        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const imageUpload = document.getElementById('imageUpload').files[0];
            if (imageUpload) {
                const resultDiv = document.getElementById('result');
                resultDiv.textContent = 'Verifying image...';
                setTimeout(() => {
                    // Simulate an image verification result
                    const isTrash = Math.random() < 0.5; // Randomly decide if it's trash or not
                    if (isTrash) {
                        resultDiv.textContent = 'Image verification completed. The image is trash.';
                    } else {
                        resultDiv.textContent = 'Image verification completed. The image is not trash.';
                    }
                }, 2000); // Simulate a 2-second verification process
            } else {
                alert('Please upload an image.');
            }
        });
    </script>
</body>
</html>