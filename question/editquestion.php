<?php
require_once("../connection.php");

if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
   
    header("Location: ../quiz/quiz.php");
    exit();
}

$questionID = trim($_GET['id']);

try {
    $sql = "SELECT * FROM questions WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $questionID]);
    $question = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$question) {
        
        header("Location: ../quiz/quiz.php");
        exit();
    }

    $options = json_decode($question['options'], true);
} catch (PDOException $e) {
    // Handle error
    header("Location: ../quiz/quiz.php");
    exit();
}


try {
    $sql = "SELECT * FROM quiz";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $quizzes = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Question</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Edit Question</h2>
    <form action="../action/editQuestion.php" method="POST">
        <input type="hidden" name="questionID" value="<?= htmlspecialchars($question['id']) ?>" />
        <div class="mb-3">
            <label for="quizID" class="form-label">Quiz Name:</label>
            <select class="form-select" id="quizID" name="quizID" required>
                <option value="" disabled>Choose a quiz</option>
                <?php foreach ($quizzes as $quiz): ?>
                    <option value="<?= htmlspecialchars($quiz['id']) ?>" <?= ($quiz['id'] == $question['quizID']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($quiz['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="questionText" class="form-label">Question Text:</label>
            <textarea class="form-control" id="questionText" name="questionText" rows="4" required><?= htmlspecialchars($question['questionText']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Options:</label>
            <?php for ($i = 0; $i < 4; $i++): ?>
                <input type="text" class="form-control mb-2" name="options[]" placeholder="Option <?= $i + 1 ?>" value="<?= isset($options[$i]) ? htmlspecialchars($options[$i]) : '' ?>" required />
            <?php endfor; ?>
        </div>

        <div class="mb-3">
            <label for="correct_answer_index" class="form-label">Correct Answer (0, 1, 2, 3):</label>
            <input type="number" class="form-control" id="correct_answer_index" name="correct_answer_index" min="0" max="3" value="<?= htmlspecialchars($question['correct_answer_index']) ?>" required />
        </div>

        <button type="submit" class="btn btn-primary">Update Question</button>
    </form>
</div>
</body>
</html>
