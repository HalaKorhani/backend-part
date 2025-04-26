<?php
header("Content-Type: application/json");
session_start();

if(isset($_POST["id"]) && !empty(trim($_POST["id"])) && is_numeric($_POST["id"])){
    $id = trim($_POST["id"]);
    require_once("../connection.php");
    $sql = "SELECT * FROM quiz" ;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $quiz = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    $quizArray = [] ;
    foreach($quiz as $q){
        $quizArray[] = $q["id"] ;
    }
    if(!in_array($id , $quizArray)){
        
        echo json_encode(["error" => "error"]);
    }
    $sql = "DELETE FROM quiz WHERE id=:id";
    $stmt = $pdo->prepare($sql) ;
    $stmt->bindParam(":id" , $id);
    $stmt->execute();
    echo json_encode(["success" => "success Delete"]);
    die();
}else{ 
    echo json_encode(["error" => "error"]);
}