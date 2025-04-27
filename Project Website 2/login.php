<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'project_users');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['username'];
    $password = $_POST['password'];

    // Query the database for the user
    $stmt = $conn->prepare("SELECT * FROM users WHERE mail = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password directly (no hashing)
        if ($password === $user['password']) {
            $_SESSION['user'] = $user;
            header("Location: form.php");
            exit;
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "No user found with this email!";
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
    <title>Login</title>
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
            <a href="logout.php">Log-Out</a>
        </nav>
    </header>
    <main>
        <section class="login-container">
            <h2>Login</h2>
            <p><?php echo $message; ?></p>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="username">Username or Gmail ID</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
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
