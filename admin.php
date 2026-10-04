<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
include "config/database.php";

/* UPDATE QUESTION */
if (isset($_POST['update_question'])) {

    $edit_id = $_POST['edit_id'];
    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_answer = $_POST['correct_answer'];

    $sql = "UPDATE questions SET
            question = '$question',
            option_a = '$option_a',
            option_b = '$option_b',
            option_c = '$option_c',
            option_d = '$option_d',
            correct_answer = '$correct_answer'
            WHERE id = $edit_id";

    mysqli_query($conn, $sql);
}


/* GET QUESTION FOR EDIT */
$edit_question = null;

if (isset($_GET['edit_id'])) {

    $edit_id = $_GET['edit_id'];

    $sql = "SELECT * FROM questions WHERE id = $edit_id";
    $edit_result = mysqli_query($conn, $sql);

    $edit_question = mysqli_fetch_assoc($edit_result);
}


/* DELETE QUESTION */
if (isset($_POST['delete_question'])) {

    $delete_id = $_POST['delete_id'];

    $sql = "DELETE FROM questions WHERE id = $delete_id";

    mysqli_query($conn, $sql);
}


/* ADD QUESTION */
if (isset($_POST['add_question'])) {

    $question = $_POST['question'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_answer = $_POST['correct_answer'];

    $sql = "INSERT INTO questions
            (question, option_a, option_b, option_c, option_d, correct_answer)
            VALUES
            ('$question', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_answer')";

    mysqli_query($conn, $sql);
}


/* GET ALL QUESTIONS */
$sql = "SELECT * FROM questions";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>

    <title>Admin - Online Quiz</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</head>

<body>

<div class="container">

    <h1>Quiz Admin Panel</h1>

    <nav>
        <a href="index.php">Home</a> |
        <a href="quiz.php">Take Quiz</a> |
        <a href="admin.php">Admin</a>
    </nav>

    <br><br>

    <p>Manage Quiz Questions</p>
    <a href="logout.php">
    <button type="button">Logout</button>
</a>

    <hr>


    <!-- EDIT QUESTION FORM -->

    <?php if ($edit_question) { ?>

        <h2>Edit Question</h2>

        <form action="admin.php" method="POST">

            <input type="hidden"
                   name="edit_id"
                   value="<?php echo $edit_question['id']; ?>">

            <label>Question:</label><br>

            <input type="text"
                   name="question"
                   value="<?php echo $edit_question['question']; ?>"
                   required>

            <br><br>


            <label>Option A:</label><br>

            <input type="text"
                   name="option_a"
                   value="<?php echo $edit_question['option_a']; ?>"
                   required>

            <br><br>


            <label>Option B:</label><br>

            <input type="text"
                   name="option_b"
                   value="<?php echo $edit_question['option_b']; ?>"
                   required>

            <br><br>


            <label>Option C:</label><br>

            <input type="text"
                   name="option_c"
                   value="<?php echo $edit_question['option_c']; ?>"
                   required>

            <br><br>


            <label>Option D:</label><br>

            <input type="text"
                   name="option_d"
                   value="<?php echo $edit_question['option_d']; ?>"
                   required>

            <br><br>


            <label>Correct Answer:</label><br>

            <select name="correct_answer" required>

                <option value="a"
                    <?php
                    if ($edit_question['correct_answer'] == 'a') {
                        echo 'selected';
                    }
                    ?>>
                    A
                </option>

                <option value="b"
                    <?php
                    if ($edit_question['correct_answer'] == 'b') {
                        echo 'selected';
                    }
                    ?>>
                    B
                </option>

                <option value="c"
                    <?php
                    if ($edit_question['correct_answer'] == 'c') {
                        echo 'selected';
                    }
                    ?>>
                    C
                </option>

                <option value="d"
                    <?php
                    if ($edit_question['correct_answer'] == 'd') {
                        echo 'selected';
                    }
                    ?>>
                    D
                </option>

            </select>

            <br><br>

            <button type="submit" name="update_question">
                Update Question
            </button>

        </form>

        <hr>

    <?php } ?>


    <!-- ADD QUESTION -->

    <h2>Add New Question</h2>

    <form action="admin.php" method="POST">

        <label>Question:</label><br>

        <input type="text"
               name="question"
               required>

        <br><br>


        <label>Option A:</label><br>

        <input type="text"
               name="option_a"
               required>

        <br><br>


        <label>Option B:</label><br>

        <input type="text"
               name="option_b"
               required>

        <br><br>


        <label>Option C:</label><br>

        <input type="text"
               name="option_c"
               required>

        <br><br>


        <label>Option D:</label><br>

        <input type="text"
               name="option_d"
               required>

        <br><br>


        <label>Correct Answer:</label><br>

        <select name="correct_answer" required>

            <option value="">Select Answer</option>

            <option value="a">A</option>

            <option value="b">B</option>

            <option value="c">C</option>

            <option value="d">D</option>

        </select>

        <br><br>

        <button type="submit" name="add_question">
            Add Question
        </button>

    </form>

    <hr>


    <!-- ALL QUESTIONS -->

    <h2>All Questions</h2>

<?php $number = 1; ?>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>

        <div>

           <h3>
    <?php
    echo $number . ". " . $row['question'];
    ?>
</h3>

            <p>
                A. <?php echo $row['option_a']; ?>
            </p>

            <p>
                B. <?php echo $row['option_b']; ?>
            </p>

            <p>
                C. <?php echo $row['option_c']; ?>
            </p>

            <p>
                D. <?php echo $row['option_d']; ?>
            </p>

            <p>
                <strong>Correct Answer:</strong>
                <?php echo strtoupper($row['correct_answer']); ?>
            </p>


            <!-- EDIT BUTTON -->

            <a href="admin.php?edit_id=<?php echo $row['id']; ?>">

                <button type="button">
                    Edit Question
                </button>

            </a>


            <!-- DELETE BUTTON -->

            <form action="admin.php"
                  method="POST"
                  style="display:inline;">

                <input type="hidden"
                       name="delete_id"
                       value="<?php echo $row['id']; ?>">

                <button type="submit"
                        name="delete_question">

                    Delete Question

                </button>

            </form>

            <hr>

        </div>
<?php $number++; ?>
    <?php } ?>

</div>
<script>
$(document).ready(function() {

    $("h2").click(function() {

        $(this).nextUntil("h2").slideToggle();

    });

});
</script>
</body>

</html>