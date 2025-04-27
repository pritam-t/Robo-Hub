<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'project_users');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $grade = $_POST['grade'];
    $email = $_POST['email'];
    $password = $_POST['password']; // No hashing

    // Insert data into users table
    $stmt = $conn->prepare("INSERT INTO users (first, last, grade, mail, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstName, $lastName, $grade, $email, $password);

    if ($stmt->execute()) {
        $message = "Registration successful! <a href='login.php'>Login here</a>";
        header("Location: login.php"); // Redirect to login page
        exit();
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/Logo 2.png" alt="Robo Hub Logo"/>
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
        <section id="register" class="form-section">
            <h1>Register</h1>
            <p class="message"><?php echo $message; ?></p>
            <form id="registration-form" action="register.php" method="POST">
                <div class="input-group">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>
                <div class="input-group">
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>
                <div class="input-group">
                    <label for="grade">Grade:</label>
                    <input type="text" id="grade" name="grade" required>
                </div>
                <div class="input-group">
                    <label for="email">Email ID:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Register</button>
            </form>
            <div class="login-link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="img/Logo 2.png" alt="Robo Hub Logo">
            </div>
            <div class="footer-links">
                <a href="index.html">Home</a>
                <a href="explore.html">Explore</a>
                <a href="form.php">Innovate</a>
                <a href="about.html">About Us</a>
                <a href="login.php">Login</a>
            </div>
        </div>
        <div class="footer-socials">
            <a href="#"><img src="img/facebook.png" alt="Facebook"></a>
            <a href="#"><img src="img/twitter.png" alt="Twitter"></a>
            <a href="#"><img src="img/instagram.png" alt="Instagram"></a>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Robo Hub. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
