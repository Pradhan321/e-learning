<?php
include 'db.php';

$selectedCourse = $_GET['course'] ?? '';

$courseQuery = $conn->prepare("SELECT id FROM courses WHERE course_name = '$selectedCourse'");
$courseQuery->execute();
$courseResult = $courseQuery->get_result();
$course = $courseResult->fetch_assoc();

if ($course) {
    $courseId = $course['id'];

    $quizQuery = $conn->prepare("SELECT * FROM quiz_questions WHERE course_id = '$courseId'");
    $quizQuery->execute();
    $quizQuestions = $quizQuery->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($selectedCourse); ?> Quiz</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #ffffff);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        h2 {
            font-size: 2.5rem;
            color: #1976d2;
            margin-bottom: 30px;
            font-family: 'Raleway', sans-serif;
        }

        .quiz-form {
            text-align: left;
        }

        .quiz-form p {
            font-size: 1.2rem;
            color: #444;
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 1rem;
            margin: 10px 0;
            padding: 10px;
            background: #f5f5f5;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        label:hover {
            background: #e3f2fd;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            margin-top: 20px;
            padding: 12px 25px;
            font-size: 1.2rem;
            background: linear-gradient(45deg, #42a5f5, #1e88e5);
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        input[type="submit"]:hover {
            background: linear-gradient(45deg, #1e88e5, #1565c0);
            transform: scale(1.05);
        }

        p {
            font-size: 1.1rem;
            color: #666;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 2rem;
            }

            .quiz-form p {
                font-size: 1rem;
            }

            label {
                font-size: 0.9rem;
            }

            input[type="submit"] {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo htmlspecialchars($selectedCourse); ?> Quiz</h2>

        <?php if ($quizQuestions->num_rows > 0): ?>
            <form method="POST" action="result.php?course=<?php echo urlencode($selectedCourse); ?>" class="quiz-form">
                <?php while ($row = $quizQuestions->fetch_assoc()): ?>
                    <p><?php echo htmlspecialchars($row['question']); ?></p>
                    <label><input type="radio" name="response[<?php echo htmlspecialchars($row['id']); ?>]" value="<?php echo htmlspecialchars($row['option1']); ?>"> <?php echo htmlspecialchars($row['option1']); ?></label>
                    <label><input type="radio" name="response[<?php echo htmlspecialchars($row['id']); ?>]" value="<?php echo htmlspecialchars($row['option2']); ?>"> <?php echo htmlspecialchars($row['option2']); ?></label>
                    <label><input type="radio" name="response[<?php echo htmlspecialchars($row['id']); ?>]" value="<?php echo htmlspecialchars($row['option3']); ?>"> <?php echo htmlspecialchars($row['option3']); ?></label>
                    <label><input type="radio" name="response[<?php echo htmlspecialchars($row['id']); ?>]" value="<?php echo htmlspecialchars($row['option4']); ?>"> <?php echo htmlspecialchars($row['option4']); ?></label>
                <?php endwhile; ?>
                <input type="submit" value="Submit Quiz">
            </form>
        <?php else: ?>
            <p>Sorry, no quiz available for this course.</p>
        <?php endif; ?>
    </div>
</body>
</html>
