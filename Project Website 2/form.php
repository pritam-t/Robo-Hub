<?php
session_start();

// Check if the user is logged in by verifying if the session variable 'user' is set
if (!isset($_SESSION['user'])) {
    // Redirect to login.php if not logged in
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Your Project</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Body styling */
        body {
            margin: 0; /* Reset body margin */
            font-family: 'Lato', sans-serif; /* Default font style */
            display: flex;
            flex-direction: column; /* Stack children vertically */
            min-height: 100vh; /* Full viewport height */
        }

        /* Header styling */
        header {
            background-color: #000000; /* Change as needed */
            padding: 20px; /* Space inside header */
            text-align: center; /* Center header text */
        }

        /* Main Page Styling */
        main {
            flex: 1; /* Take up remaining space */
            padding: 20px; /* Padding for main content */
            display: flex; /* Use flexbox for layout */
            justify-content: center; /* Center content horizontally */
            align-items: flex-start; /* Align items to the top */
        }

        /* Form Page Styling */
        .project-submission {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 1200px; /* Increased width */
            text-align: left;
            margin: 20px; /* Add margin around the form */
        }

        /* Title styling for Form Page */
        .project-submission h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 3rem; /* Increased font size for form page */
            color: #f4a300;
            margin-bottom: 30px;
            text-align: center; /* Center the heading */
        }

        /* Input group styling for Form Page */
        .project-input-group {
            margin-bottom: 20px;
        }

        .project-input-group label {
            font-family: 'EB Garamond', serif;
            font-size: 1.6rem; /* Increased font size for labels */
            color: #333;
            display: block;
            margin-bottom: 10px;
        }

        .project-input-group input,
        .project-input-group textarea {
            width: 100%;
            padding: 15px; /* Increased padding for input fields */
            font-size: 1.5rem; /* Increased font size for input fields */
            border-radius: 5px;
            border: 1px solid #ccc;
            font-family: 'EB Garamond', serif;
        }

        /* Submit Button styling */
        button {
            width: 100%;
            padding: 15px; /* Increased padding for submit button */
            background-color: #f4a300;
            color: #fff;
            font-size: 1.8rem; /* Increased font size for button */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Lato', sans-serif; /* Changed font style */
        }

        button:hover {
            background-color: #000000;
        }

        /* Footer styling */
        footer {
            background-color: #333; /* Change as needed */
            color: white; /* Change as needed */
            padding: 20px; /* Space inside footer */
            text-align: center; /* Center footer text */
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img\Logo 2.png" alt="Robo Hub Logo"/>
        </div>
        <nav>
            <a href="index.html">Home</a>
            <a href="explore.html">Explore</a>
            <a href="form.php">Innovate</a>
            <a href="about.html">About Us</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

    <main>
        <section class="project-submission">
            <h2>Submit Your Project</h2>
            <form id="project-form">
                <div class="project-input-group">
                    <label for="project-name">Project Name:</label>
                    <input type="text" id="project-name" required>
                </div>

                <div class="project-input-group">
                    <label for="project-image">Upload Project Image:</label>
                    <input type="file" id="project-image" accept="image/*" required>
                </div>

                <div class="project-input-group">
                    <label for="project-description">Project Description:</label>
                    <textarea id="project-description" required></textarea>
                </div>

                <div class="project-input-group">
                    <label for="project-code">Project Code:</label>
                    <textarea id="project-code" required></textarea>
                </div>

                <div class="project-input-group">
                    <label for="youtube-link">YouTube Link:</label>
                    <input type="url" id="youtube-link" required>
                </div>

                <div class="project-input-group">
                    <label for="circuit-diagram">Upload Circuit Diagram:</label>
                    <input type="file" id="circuit-diagram" accept="image/*" required>
                </div>

                <button type="submit">Submit Project</button>
            </form>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="img\Logo 2.png" alt="Robo Hub Logo">
            </div>
            <div class="footer-links">
                <a href="index.html">Home</a>
                <a href="explore.html">Explore</a>
                <a href="form.php">Innovate</a>
                <a href="about.html">About Us</a>
                <a href="login.php">Login</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Robo Hub. All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.getElementById('project-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting normally

            // Get form values
            const projectName = document.getElementById('project-name').value;
            const projectDescription = document.getElementById('project-description').value;
            const projectCode = document.getElementById('project-code').value;
            const youtubeLink = document.getElementById('youtube-link').value;
            const circuitDiagramFile = document.getElementById('circuit-diagram').files[0]; // Get the uploaded circuit diagram
            const projectImageFile = document.getElementById('project-image').files[0]; // Get the uploaded project image

            // Store form values in localStorage
            localStorage.setItem('projectName', projectName);
            localStorage.setItem('projectDescription', projectDescription);
            localStorage.setItem('projectCode', projectCode);
            localStorage.setItem('youtubeLink', youtubeLink);

            // Handle circuit diagram image upload
            if (circuitDiagramFile) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    localStorage.setItem('circuitDiagram', e.target.result); // Store image data in localStorage
                    // Redirect to the generated page after reading the file
                    window.location.href = 'generated.html';
                }
                reader.readAsDataURL(circuitDiagramFile); // Read the file as a data URL
            }

            // Handle project image upload
            if (projectImageFile) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    localStorage.setItem('projectImage', e.target.result); // Store image data in localStorage
                }
                reader.readAsDataURL(projectImageFile); // Read the file as a data URL
            }
        });
    </script>
</body>
</html>
