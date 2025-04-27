<?php
require_once('../connection.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "Error: Data must be sent using the POST method.";
    exit;
}

if (!isset($_POST['quizID']) || !is_numeric($_POST['quizID'])) {
    echo "Error: Quiz ID (quizID) is missing or invalid.";
    exit;
}
$quizID = (int)$_POST['quizID'];

$userAnswers = [];
foreach ($_POST as $key => $value) {
    if (strpos($key, 'question_') === 0) {
        $questionId = substr($key, strlen('question_'));
        if (is_numeric($questionId)) {
            $userAnswers[(int)$questionId] = (int)$value;
        }
    }
}

if (empty($userAnswers)) {
    echo "You did not answer any questions!";
    exit;
}

$correctAnswers = [];
$totalQuestionsInQuiz = 0;
try {
    $sql = "SELECT id, correct_answer_index FROM questions WHERE quizID = :quizID";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':quizID', $quizID, PDO::PARAM_INT);
    $stmt->execute();

    $questionsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($questionsData)) {
        echo "Error: No questions found for this quiz (ID: $quizID).";
        exit;
    }

    foreach ($questionsData as $question) {
        $correctAnswers[$question['id']] = $question['correct_answer_index'];
    }
    $totalQuestionsInQuiz = count($questionsData);

} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo "An error occurred while connecting to the database. Please try again later.";
    exit;
}

$score = 0;
foreach ($userAnswers as $questionId => $userAnswerIndex) {
    if (isset($correctAnswers[$questionId]) && $userAnswerIndex === $correctAnswers[$questionId]) {
        $score++;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Quiz Result</title>
    <style>
        body { padding: 20px; }
        .result-container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            text-align: center;
        }
        .score {
            font-size: 2.5em;
            font-weight: bold;
            color: #0d6efd;
        }
        .total {
            font-size: 1.2em;
            color: #6c757d;
        }
        .message {
            margin-top: 15px;
            font-style: italic;
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <h2>Quiz Result</h2>
        <hr>
        <p class="total">You answered correctly</p>
        <p class="score"><?php echo htmlspecialchars($score); ?></p>
        <p class="total">out of <?php echo htmlspecialchars($totalQuestionsInQuiz); ?> questions.</p>

        <?php
        if (isset($saveMessage)) {
            echo "<p class='message'>" . htmlspecialchars($saveMessage) . "</p>";
        } else {
            echo "<p class='message' style='color: orange;'>Note: The result was not saved as the user registration system is currently disabled.</p>";
        }
        ?>

        <br>
        <a href="../question/question.php" class="btn btn-secondary">Return to Questions</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>