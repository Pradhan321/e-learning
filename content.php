<?php
include 'db.php';

$selectedCourse = $_GET['course'] ?? ''; 

$courseQuery = $conn->prepare("SELECT id FROM courses WHERE course_name = '$selectedCourse'");
$courseQuery->execute();
$courseResult = $courseQuery->get_result();
$course = $courseResult->fetch_assoc();

if ($course) {
    $courseId = $course['id'];

    $topicQuery = $conn->prepare("SELECT id, topic_name FROM study_content WHERE course_id ='$courseId'");
    $topicQuery->execute();
    $topics = $topicQuery->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Topics</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #6a11cb, #2575fc);
            color: #333;
            line-height: 1.6;
            margin: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px;
            background: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            animation: fadeIn 1s ease-in-out;
        }

        h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #1e88e5;
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        ul li {
            font-size: 1.2rem;
        }

        ul li a {
            text-decoration: none;
            color: #fff;
            padding: 15px 20px;
            display: block;
            background: linear-gradient(120deg, #ff512f, #f09819);
            border-radius: 8px;
            transition: all 0.4s ease;
            text-align: center;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        ul li a:hover {
            background: linear-gradient(120deg, #43cea2, #185a9d);
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }

        p {
            text-align: center;
            font-size: 1.2rem;
            color: #555;
            margin-top: 20px;
            font-weight: 500;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h2 {
                font-size: 2rem;
            }

            ul li a {
                font-size: 1rem;
                padding: 12px 15px;
            }
        }

        footer {
            margin-top: 40px;
            text-align: center;
            color: #fff;
            font-size: 1rem;
        }

        footer a {
            color: ;
            text-decoration: underline;
        }

        footer a:hover {
            color: #ff512f;
        }
        footer p {
    font-size: 1rem;
    font-weight: bold;
    background: linear-gradient(45deg, yellow, orange);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-align: center;
    margin: 10px 0;
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Topics for <?php echo htmlspecialchars($selectedCourse); ?></h2>

        <?php if ($topics->num_rows > 0): ?>
            <ul>
                <?php while ($row = $topics->fetch_assoc()): ?>
                    <li><a href="topic.php?course=<?php echo urlencode($selectedCourse); ?>&topic_id=<?php echo urlencode($row['id']); ?>"><?php echo htmlspecialchars($row['topic_name']); ?></a></li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No topics available for this course.</p>
        <?php endif; ?>
    </div>

    <footer>
        <p>Powered by Code Vita</a></p>
    </footer>
</body>
</html>
