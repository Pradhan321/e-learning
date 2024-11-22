<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if the email already exists
    $checkEmailQuery = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('This email is already registered. Please use a different email.');</script>";
    } else {
        $insertQuery = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "<script>alert('Registration successful! You can now log in.');</script>";
            echo "<script>window.location.href = 'login.php';</script>";
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: url('back.avif') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 70%;
            max-width: 900px;
            display: flex;
        }

        .info-section {
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .info-section h2 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .info-section p {
            font-size: 1rem;
            line-height: 1.5;
            text-align: center;
            margin-bottom: 20px;
        }

        .info-section button {
            background: white;
            color: #007bff;
            padding: 10px 20px;
            font-weight: bold;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .info-section button:hover {
            background: #0056b3;
            color: white;
        }

        .form-section {
            flex: 1.5;
            padding: 40px;
        }

        .form-section h2 {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        button[type="submit"] {
            background: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button[type="submit"]:hover {
            background: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .info-section {
                text-align: center;
                padding: 20px;
            }

            .form-section {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Info Section -->
        <div class="info-section">
            <h2>Welcome to Our Platform</h2>
            <p>Join our platform to explore exclusive content, learn, and grow. Register today and start your journey!</p>
            <button onclick="window.location.href='login.php';">Already have an account?</button>
        </div>
        <!-- Form Section -->
        <div class="form-section">
            <h2>Register</h2>
            <form action="register.php" method="POST">
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>
</body>
</html>
