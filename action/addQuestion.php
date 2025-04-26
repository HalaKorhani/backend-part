<?php
// Include the database connection file to establish the connection to the database
require_once("../connection.php");
$quizID = $_POST['quizID'];
$questionText = $_POST['questionText'];
$options = $_POST['options'];
$correct_answer_index = $_POST['correct_answer_index'];
$optionsJson = json_encode($options);
