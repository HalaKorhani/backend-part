<?php
require_once("../connection.php");

if (
    !isset($_POST['quizID']) || empty(trim($_POST['quizID'])) ||
    !isset($_POST['questionText']) || empty(trim($_POST['questionText'])) ||
    !isset($_POST['options']) || !is_array($_POST['options']) || count($_POST['options']) === 0 ||
    !isset($_POST['correct_answer_index']) || !is_numeric($_POST['correct_answer_index'])
) {
    // Invalid input, redirect back or show error
    header("Location: ../quiz/quiz.php");
    exit();
}

$quizID = trim($_POST['quizID']);
$questionText = trim($_POST['questionText']);
$options = $_POST['options'];
$correct_answer_index = (int)$_POST['correct_answer_index'];
$optionsJson = json_encode($options);

try {
    $sql = "INSERT INTO questions (quizID, questionText, options, correct_answer_index)
            VALUES (:quizID, :questionText, :options, :correct_answer_index)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':quizID' => $quizID,
        ':questionText' => $questionText,
        ':options' => $optionsJson,
        ':correct_answer_index' => $correct_answer_index,
    ]);
} catch (PDOException $e) {
    // Log error or handle it as needed
    // For now, redirect back to quiz page
    header("Location: ../quiz/quiz.php");
    exit();
}

header("Location: ../quiz/quiz.php");
exit();
?>
