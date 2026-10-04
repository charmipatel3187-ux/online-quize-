<!DOCTYPE html>
<html>

<head>
    <title>Quiz Result</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

        <h1>Quiz Result</h1>

        <?php

        include "config/database.php";

        $score = 0;

        $sql = "SELECT * FROM questions";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {

            $question_id = $row['id'];
            $correct_answer = $row['correct_answer'];

            if (isset($_POST['q' . $question_id])) {

                $user_answer = $_POST['q' . $question_id];

                if ($user_answer == $correct_answer) {
                    $score++;
                }
            }
        }

        ?>

       <?php
$total_questions = mysqli_num_rows($result);
?>

<div class="result-box">

    <h2>
        Your Score
    </h2>

    <p class="score">
        <?php echo $score; ?> / <?php echo $total_questions; ?>
    </p>

</div>

      <?php

if ($score == $total_questions) {

    echo "<p>Excellent! All answers are correct.</p>";

} elseif ($score >= ceil($total_questions / 2)) {

    echo "<p>Good job! Keep practicing.</p>";

} else {

    echo "<p>Keep practicing and try again.</p>";

}

?>
        <br>

        <a href="quiz.php">
    <button type="button">Try Again</button>
</a>

<a href="index.php">
    <button type="button">Home</button>
</a>

<br><br>

<a href="admin.php">
    <button type="button">Admin Panel</button>
</a>

    </div>

</body>

</html>