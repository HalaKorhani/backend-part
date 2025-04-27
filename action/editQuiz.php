<?php
require_once("../connection.php");

if (
    !isset($_POST['quizID']) || empty(trim($_POST['quizID'])) ||
    !isset($_POST['title']) || empty(trim($_POST['title']))
) {
    // Invalid input, redirect back or show error
    header("Location: ../quiz/quiz.php");
    exit();
}

$quizID = trim($_POST['quizID']);
$title = trim($_POST['title']);

try {
    $sql = "UPDATE quiz SET title = :title WHERE id = :quizID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':quizID' => $quizID,
    ]);
} catch (PDOException $e) {
    // Log error or handle it as needed
    header("Location: ../quiz/quiz.php");
    exit();
}

header("Location: ../quiz/quiz.php");
exit();
?>
