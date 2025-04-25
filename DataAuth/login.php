<?php 
session_start();
ob_start(); 
if (isset($_POST["email"]) && isset($_POST["password"]) &&
    !empty(trim($_POST["email"])) && !empty(trim($_POST["password"]))) {
        $email = trim($_POST["email"]);
        $pass = trim($_POST["password"]);
        
        require_once("../connection.php");
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $user1 = $stmt->fetch(PDO::FETCH_ASSOC)
        if (!$user1) {
            $_SESSION["login"] = false;
            $_SESSION["msg"] = "incorrect username or password";
            header("location:../Auth/login.php");
            die();
        }        