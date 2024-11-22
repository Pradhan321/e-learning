<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <title>E-learning Platform</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Full-width Hero Section */
        .hero {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: url('hero.webp') no-repeat center center/cover;
            text-align: center;
            position: relative;
        }

        .hero-overlay {
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .hero-content {
            z-index: 2;
            position: relative;
            color: #ffffff;
            padding: 20px;
        }

        h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #bb86fc;
            letter-spacing: 1px;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        .button-container {
            display: flex;
            justify-content: center; /* Centers buttons horizontally */
            align-items: center; /* Centers buttons vertically */
            gap: 20px;
        }

        .button-container a {
            text-decoration: none;
        }

        .btn {
            padding: 15px 30px;
            font-size: 1rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            text-align: center;
            transition: transform 0.2s ease-in-out, background-color 0.3s ease-in-out;
        }

        .btn-register {
            background-color: #6200ea;
            color: white;
        }

        .btn-register:hover {
            background-color: #3700b3;
            transform: translateY(-5px);
        }

        .btn-login {
            background-color: #03dac6;
            color: #121212;
        }

        .btn-login:hover {
            background-color: #018786;
            transform: translateY(-5px);
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            p {
                font-size: 1rem;
            }

            .btn {
                font-size: 0.9rem;
                padding: 12px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Welcome to the Code Vita</h1>
            <p>Discover and learn web development topics at your pace. Join now and elevate your skills.</p>
            <div class="button-container">
                <a href="register.php" class="btn btn-register">Register</a>
                <a href="login.php" class="btn btn-login">Login</a>
            </div>
        </div>
    </div>
</body>
</html>
