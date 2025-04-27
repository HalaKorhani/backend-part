<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h2 class="mb-4">Create a New Question</h2>
    <form action="../action/addQuestion.php" method="POST">
            <div class="mb-3">

            <label for="quizID" class="form-label">Quiz Name:</label>
             <select class="form-select" id="quizID" name="quizID" required>
        <option value="" disabled selected>Choose a quiz</option>
        <?php 
        require_once("../connection.php");

        $sql = "SELECT * FROM `quiz`";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $quiz = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($quiz as $quiz){
            ?>
            <option value="<?= $quiz['id'] ?>">
                <?php echo $quiz['title'] ?>
            </option>

        <?php } ?>
    </select>
        </div>
    
    <div class="mb-3">
            <label for="questionText" class="form-label">Question Text:</label>
            <textarea class="form-control" id="questionText" name="questionText" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Options:</label>
            <input type="text" class="form-control mb-2" name="options[]" placeholder="Option 1" required>
            <input type="text" class="form-control mb-2" name="options[]" placeholder="Option 2" required>
            <input type="text" class="form-control mb-2" name="options[]" placeholder="Option 3" required>
            <input type="text" class="form-control mb-2" name="options[]" placeholder="Option 4" required>
        </div>

        <div class="mb-3">
            <label for="correct_answer_index" class="form-label">Correct Answer (0, 1, 2, 3):</label>
            <input type="number" class="form-control" id="correct_answer_index" name="correct_answer_index" min="0" max="3" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Question</button>
    </form>
</div>

</body>
</html>