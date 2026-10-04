<?php

session_start();

$error = "";

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "admin" && $password == "admin123") {

        $_SESSION['admin'] = $username;

        header("Location: admin.php");
        exit();

    } else {

        $error = "Invalid username or password.";

    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Admin Login</title>

    <link rel="stylesheet" href="css/style.css">

</head>

<body>

<div class="container">

    <h1>Admin Login</h1>

    <nav>
        <a href="index.php">Home</a> |
        <a href="quiz.php">Take Quiz</a> |
        <a href="login.php">Admin Login</a>
    </nav>

    <br><br>

    <?php

    if ($error != "") {
        echo "<p>" . $error . "</p>";
    }

    ?>

    <form method="POST">

        <label>Username:</label><br>

        <input type="text" name="username" required>

        <br><br>

        <label>Password:</label><br>

        <input type="password" name="password" required>

        <br><br>

        <button type="submit" name="login">
            Login
        </button>

    </form>

</div>

</body>

</html>