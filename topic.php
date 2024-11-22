<?php
include 'db.php';

$selectedCourse = $_GET['course'] ?? '';
$topicId = $_GET['topic_id'] ?? '';

$topicQuery = $conn->prepare("SELECT topic_name, content FROM study_content WHERE id = '$topicId'");
$topicQuery->execute();
$topicResult = $topicQuery->get_result();
$topic = $topicResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic Content</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ece9e6, #ffffff);
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            width: 100%;
            padding: 40px;
            text-align: left;
            overflow: hidden;
        }

        h2 {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 20px;
            font-family: 'Raleway', sans-serif;
            text-transform: capitalize;
        }

        p {
            font-size: 1.2rem;
            line-height: 1.8;
            color: #555;
            margin-bottom: 30px;
        }

        input[type="button"] {
            padding: 12px 20px;
            font-size: 1rem;
            background: linear-gradient(45deg, #2575fc, #6a11cb);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        input[type="button"]:hover {
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            transform: scale(1.1);
        }

        a {
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 2rem;
            }

            p {
                font-size: 1rem;
            }

            input[type="button"] {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if ($topic): ?>
            <h2><?php echo htmlspecialchars($topic['topic_name']); ?></h2>
            <p><?php echo htmlspecialchars($topic['content']); ?></p>
            <a href="quiz.php?course=<?php echo urlencode($selectedCourse); ?>"><input type="button" value="Take Quiz"></a>
        <?php else: ?>
            <p>No content available for this topic.</p>
        <?php endif; ?>
    </div>
</body>
</html>
