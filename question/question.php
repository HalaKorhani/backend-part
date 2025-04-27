<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Questions</title>
</head>
<body>
    <h2>QUESTIONS</h2>
    <a href="createQuestion.php">  
        <button type="button" class="btn btn-info">Create question</button>
    </a>

    <?php
    require_once("../connection.php");
    session_start();

    try {
        $sql = "SELECT questions.*, quiz.title AS quizTitle, quiz.id AS quizID
                FROM questions
                JOIN quiz ON questions.quizID = quiz.id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        echo "<p>Debug: Fetched " . count($questions) . " questions from database.</p>";
        echo "<pre>Raw questions data: " . htmlspecialchars(print_r($questions, true)) . "</pre>";

    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error fetching questions: " . htmlspecialchars($e->getMessage()) . "</div>";
        $questions = [];
    }

    $quizzes = [];
    foreach($questions as $question) {
        $quizzes[$question['quizTitle']][] = $question; 
    }

    foreach ($quizzes as $quizTitle => $quizQuestions) {
        $quizID = $quizQuestions[0]['quizID']; 

        echo "<h3>Quiz: " . htmlspecialchars($quizTitle) . "</h3>";

        echo "<form action='../score/scores.php' method='post'>";
        echo "<input type='hidden' name='quizID' value='" . htmlspecialchars($quizID) . "' />";

        echo "<table class='table table-striped'>";
        echo "<thead><tr><th scope='col'>ID</th><th scope='col'>Question</th><th scope='col'>Options</th><th scope='col'>Actions</th><th scope='col'>Delete</th></tr></thead>";
        echo "<tbody>";

        foreach ($quizQuestions as $question) {
            $options = json_decode($question['options'], true); 

            echo "<tr>";
            echo "<td>" . htmlspecialchars($question['id']) . "</td>";
            echo "<td>" . htmlspecialchars($question['questionText']) . "</td>";
            echo "<td>";

            foreach ($options as $index => $option) {
                echo "<label><input type='radio' name='question_" . htmlspecialchars($question['id']) . "' value='" . htmlspecialchars($index) . "' /> " . htmlspecialchars($option) . "</label><br />";
            }

            echo "</td>";
            echo "<td>";
            echo "<a href='editquestion.php?id=" . htmlspecialchars($question['id']) . "' class='btn btn-warning'>Update</a>";
            echo "</td>";
            echo "<td>";
            echo "<button type='button' class='btn btn-danger' onclick='deleteQuestion(" . htmlspecialchars($question['id']) . ")'>Delete</button>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</tbody></table>"; 

        echo "<button type='submit' class='btn btn-primary'>Submit Quiz</button>";
        echo "</form><hr />";
    }
    ?>

<script>
function deleteQuestion(id) {
    const urlencoded = new URLSearchParams();
    urlencoded.append("id", id);

    const requestOptions = {
        method: "POST",
        body: urlencoded,
    };

    fetch("../action/questionDelete.php", requestOptions)
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                Failed to delete question.
                let rows = document.querySelectorAll("table tbody tr");
                for (let row of rows) {
                    let firstTd = row.querySelector("td:first-child");
                    if (firstTd && firstTd.textContent.trim() === id.toString()) {
                        row.remove();
                        break;
                    }
                }
            } else {
                alert("Failed to delete question.");
            }
        })
        .catch(error => {
            console.error("Error deleting question:", error);
            alert("Error deleting question.");
        });
}
</script>

</body>
</html>
