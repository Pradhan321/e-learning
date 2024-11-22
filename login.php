<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail = $_POST['email'];
    $userPassword = $_POST['password'];

    // Query to fetch user details
    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($userPassword, $row['password'])) {
            session_start(); // Start the session
            $_SESSION['user'] = $row['name']; // Store the user name
            $_SESSION['user_id'] = $row['id']; // Store the user ID
            $_SESSION['user_email'] = $row['email']; // Store the user email
            header("Location: courses.php"); // Redirect to the courses page
            exit;
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('No user found with this email!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;600&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Login Page</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-image: url('back.avif'); /* Add your background image here */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .login-container {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.95); /* Slight transparency for modern look */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            overflow: hidden;
        }

        .login-image {
            flex: 1;
            background: url('back.avif') no-repeat center center/cover;
        }

        .login-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h1 {
            font-size: 2.5rem;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            background: linear-gradient(to right, #007bff, #ff5722); /* Gradient effect */
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
        }

        .login-form p {
            color: #666;
            font-size: 1rem;
            margin-bottom: 20px;
            text-align: center;
            font-family: 'Raleway', sans-serif;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ddd;
            background-color:white;
            color:black;
            border-radius: 6px;
        }

        .login-button {
            padding: 12px;
            font-size: 1rem;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
        }

        .login-button:hover {
            background-color: #0056b3;
        }

        .register-link {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9rem;
            font-family: 'Roboto', sans-serif;
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="login-container">
    <!-- Image Section -->
    <div class="login-image">
        <img src="login2.jpg" alt="Illustration" style="width: 100%; height: 100%; object-fit: cover;">
    </div>
    <!-- Form Section -->
    <div class="login-form">
        <h1>Welcome to Code Vita</h1>
        <p>Web Development</p>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Log In</button>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
</div>

</body>
</html>


