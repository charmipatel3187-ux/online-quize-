<?php
include "config/database.php";

$sql = "SELECT * FROM questions";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Online Quiz</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">

        <h1>Online Quiz</h1>
        <div class="quiz-instructions">

    <h2>Quiz Instructions</h2>

    <p>1. Read each question carefully.</p>
    <p>2. Select one correct answer for each question.</p>
    <p>3. Answer all questions before submitting.</p>
    <p>4. Click Submit Quiz to see your result.</p>

</div>

<hr>
        <nav>
    <a href="index.php">Home</a> |
    <a href="quiz.php">Take Quiz</a> |
    <a href="admin.php">Admin</a>
</nav>

<br><br>

        <p>Answer the following question:</p>

       <form action="result.php" method="POST" onsubmit="return validateQuiz();">

    

    <?php
$number = 1;

while ($row = mysqli_fetch_assoc($result)) {
?>

   <div class="quiz-question">

    <h3>
        <?php echo $number . ". " . $row['question']; ?>
    </h3>

    <label class="quiz-option">
    <input type="radio" name="q<?php echo $row['id']; ?>" value="a">
    <?php echo $row['option_a']; ?>
</label>
    <br><br>

    <label class="quiz-option">
    <input type="radio" name="q<?php echo $row['id']; ?>" value="a">
    <?php echo $row['option_b']; ?>
</label>
    <br><br>

   <label class="quiz-option">
    <input type="radio" name="q<?php echo $row['id']; ?>" value="a">
    <?php echo $row['option_c']; ?>
</label>
    <br><br>

   <label class="quiz-option">
    <input type="radio" name="q<?php echo $row['id']; ?>" value="a">
    <?php echo $row['option_d']; ?>
</label>

    <hr>

<?php
$number++;
}
?>

<button type="submit">Submit Quiz</button>

</form>
<hr>
    </div>
    <script src="js/script.js"></script>

</body>

</html>