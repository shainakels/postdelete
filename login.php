<?php
session_start();
include("db.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql= "SELECT * FROM users WHERE username ='$username' AND password='$password'";
    $result = $conn->query($sql);



    if ($result->num_rows > 0) {

        $_SESSION['username'] = $username;
        $message = "Welcome " . $_SESSION['username'];
        header('Location:home.php');
    } else {
        $message = "Invalid username or password";
    }
}


if (isset($_SESSION['username'])) {
    $message = "Welcome " . $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if(isset($message)): ?>
       <p1> <?php echo $message ?></p1>
    <?php endif; ?>

        <form method="post" action="login.php">
            Username: <input type="text" name="username" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" value="Login">
        </form>

        <form method="post" action="logout.php">
            <input type="submit" value="Logout">
        </form>
        
</body>
</html>