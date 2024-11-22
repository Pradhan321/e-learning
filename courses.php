<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$courseList = ["HTML", "CSS", "JavaScript", "PHP"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Courses</title>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;600&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 90%;
            max-width: 1200px;
            text-align: center;
            margin: 20px auto;
        }

        h2 {
            font-family: 'Raleway', sans-serif;
            font-size: 2.5rem;
            color: #333;
            margin-bottom: 30px;
        }

        .courses {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: #f9f9f9;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .card-content {
            padding: 20px;
        }

        .card-content h3 {
            font-size: 1.5rem;
            color: #444;
            margin-bottom: 10px;
        }

        .card-content a {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 20px;
            background: #007bff;
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .card-content a:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        form {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        form input[type="password"] {
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            width: 300px;
            margin-bottom: 10px;
            outline: none;
            transition: border 0.3s;
        }

        form input[type="password"]:focus {
            border-color: #007bff;
        }

        form input[type="submit"] {
            padding: 12px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        form input[type="submit"]:hover {
            background-color: #c82333;
            transform: translateY(-3px);
        }

        footer {
            background-color: #333;
            padding: 15px;
            text-align: center;
            margin-top: 20px;
        }

        footer p {
            font-size: 1rem;
            color: #fff;
            background: linear-gradient(45deg, white, grey);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Available Courses</h2>
        <div class="courses">
            <div class="card">
                <img src="html.jpg" alt="HTML Course">
                <div class="card-content">
                    <h3>HTML</h3>
                    <a href="content.php?course=HTML">View Course</a>
                </div>
            </div>
            <div class="card">
                <img src="css.png" alt="CSS Course">
                <div class="card-content">
                    <h3>CSS</h3>
                    <a href="content.php?course=CSS">View Course</a>
                </div>
            </div>
            <div class="card">
                <img src="javascript.jpg" alt="JavaScript Course">
                <div class="card-content">
                    <h3>JavaScript</h3>
                    <a href="content.php?course=JavaScript">View Course</a>
                </div>
            </div>
            <div class="card">
                <img src="php.jpg" alt="PHP Course">
                <div class="card-content">
                    <h3>PHP</h3>
                    <a href="content.php?course=PHP">View Course</a>
                </div>
            </div>
        </div>
        <form action="delete_account.php" method="POST" onsubmit="return confirm('Are you sure you want to Logout your account?');">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>">
            <input type="password" name="password" placeholder="Confirm Password" required>
            <input type="submit" value="Log Out">
        </form>
    </div>
    <footer>
        <p>Powered by Code Vita</p>
    </footer>
</body>
</html>
