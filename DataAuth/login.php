<?php 
session_start();
ob_start(); 
if (isset($_POST["email"]) && isset($_POST["password"]) &&
    !empty(trim($_POST["email"])) && !empty(trim($_POST["password"]))) {
        $email = trim($_POST["email"]);
        $pass = trim($_POST["password"]);
        
        require_once("../connection.php");
        