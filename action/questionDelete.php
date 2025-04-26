<?php
header("Content-Type: application/json");
session_start();
if(isset($_POST["id"]) && !empty(trim($_POST["id"])) && is_numeric($_POST["id"])){
    $id = trim($_POST["id"]);
    require_once("../connection.php");
    $sql = "SELECT * FROM `questions`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $questionArray = [];
    foreach($questions as $q){
        $questionArray[] = $q["id"];
    }
    if(!in_array($id , $questionArray)){
        echo json_encode(["error" => "error"]);
    }
    $sql = "DELETE FROM questions WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    echo json_encode(["success" => "success Delete"]);
    die();
}else{ 
    echo json_encode(["error" => "error"]);
}
