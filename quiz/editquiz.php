<?php
require_once("../connection.php");

if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    // Redirect if no quiz ID provided
    header("Location: ../quiz/quiz.php");
    exit();
}

$quizID = trim($_GET['id']);

try {
    $sql = "SELECT * FROM quiz WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $quizID]);
    $quiz = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$quiz) {
        // Quiz not found
        header("Location: ../quiz/quiz.php");
        exit();
    }
} catch (PDOException $e) {
    // Handle error
    header("Location: ../quiz/quiz.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Quiz</h2>
    <form action="../action/editQuiz.php" method="POST">
        <input type="hidden" name="quizID" value="<?= htmlspecialchars($quiz['id']) ?>" />
        <div class="mb-3">
            <label for="title" class="form-label">Quiz Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($quiz['title']) ?>" required />
        </div>
        <button type="submit" class="btn btn-primary">Update Quiz</button>
    </form>
</div>
</body>
</html>
