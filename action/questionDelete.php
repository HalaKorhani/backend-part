<?php
header("Content-Type: application/json");
session_start();
if(isset($_POST["id"]) && !empty(trim($_POST["id"])) && is_numeric($_POST["id"])){
    $id = trim($_POST["id"]);
    require_once("../connection.php");
    try {
        error_log("Deleting question with ID: " . $id);
        $sql = "DELETE FROM questions WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        error_log("Rows affected: " . $stmt->rowCount());
        if ($stmt->rowCount() > 0) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Question not found"]);
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo json_encode(["success" => false, "message" => "Database error"]);
    }
    exit();
} else {
    echo json_encode(["success" => false, "message" => "Invalid ID"]);
    exit();
}
