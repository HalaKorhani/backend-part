<?php
require_once("../connection.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quizID = $_POST['quizID'];
    $userID = $_SESSION['userID'];
    $score = 0;
    foreach ($_POST as $key => $selectedOption) {
        if (strpos($key, 'question_') === 0) {
            $questionID = substr($key, 9); // Remove "question_" from the ID

            foreach ($_POST as $key => $selectedOption) {
                if (strpos($key, 'question_') === 0) {
                    $questionID = substr($key, 9); // Remove "question_" from the ID
                    $sql = "SELECT correct_answer_index FROM questions WHERE id = :questionID";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['questionID' => $questionID]);
                    $question = $stmt->fetch(PDO::FETCH_ASSOC);
              