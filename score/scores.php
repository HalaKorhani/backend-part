<?php
require_once("../connection.php");
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quizID = $_POST['quizID'];
    $userID = $_SESSION['userID'];
    $score = 0;
