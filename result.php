<?php
session_start();
include 'db.php';

$selectedCourse = $_GET['course'] ?? '';
$userAnswers = $_POST; 

$courseQuery = $conn->prepare("SELECT id FROM courses WHERE course_name = '$selectedCourse'");
$courseQuery->execute();
$courseResult = $courseQuery->get_result();
$course = $courseResult->fetch_assoc();

if ($course) {
    $courseId = $course['id'];

    $quizQuery = $conn->prepare("SELECT * FROM quiz_questions WHERE course_id = '$courseId'");
    $quizQuery->execute();
    $quizQuestions = $quizQuery->get_result();

    $score = 0;
    $totalQuestions = $quizQuestions->num_rows;
    $mistakes = [];

    while ($question = $quizQuestions->fetch_assoc()) {
        $questionId = $question['id'];
        $correctAnswer = $question['correct_option'];

        if (isset($userAnswers["response"][$questionId])) {
            $userAnswer = $userAnswers["response"][$questionId];
            if ($userAnswer === $correctAnswer) {
                $score++;
            } else {
                $mistakes[$question['question']] = [
                    'user_answer' => $userAnswer,
                    'correct_answer' => $correctAnswer
                ];
            }
        } else {
            $mistakes[$question['question']] = [
                'user_answer' => 'Not Answered',
                'correct_answer' => $correctAnswer
            ];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Result</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .result-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 40px;
            max-width: 700px;
            width: 90%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }
        h2 {
            text-align: center;
            color: #3498db;
            margin-bottom: 30px;
            font-size: 28px;
        }
        .score-box {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
        }
        .score-box p {
            font-size: 20px;
            font-weight: bold;
        }
        .answers-list {
            margin: 20px 0;
        }
        .answer-item {
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f7f9fb;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .answer-item.correct {
            background-color: #e0f7e9; 
            border: 1px solid #2ecc71;
        }
        .answer-item.incorrect {
            background-color: #fbeaea; 
            border: 1px solid #e74c3c;
        }
        .answer-item p {
            margin: 5px 0;
        }
        .user-answer {
            color: #e74c3c; 
        }
        .correct-answer {
            color: #2ecc71;
        }
        a.back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        a.back-link:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h2>Quiz Result for <?php echo htmlspecialchars($selectedCourse); ?></h2>
        <div class="score-box">
            <p>You scored <strong><?php echo $score; ?></strong> out of <strong><?php echo $totalQuestions; ?></strong></p>
        </div>

        <div class="answers-list">
            <?php foreach ($mistakes as $question => $details): ?>
                <div class="answer-item incorrect">
                    <p><strong>Question:</strong> <?php echo htmlspecialchars($question); ?></p>
                    <p><strong>Your Answer:</strong> <span class="user-answer"><?php echo htmlspecialchars($details['user_answer']); ?></span></p>
                    <p><strong>Correct Answer:</strong> <span class="correct-answer"><?php echo htmlspecialchars($details['correct_answer']); ?></span></p>
                </div>
            <?php endforeach; ?>
        </div>

        <a href="courses.php" class="back-link">Back to Courses</a>
    </div>
</body>
</html>
