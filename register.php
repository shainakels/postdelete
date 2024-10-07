<?php
include("db.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql= "INSERT INTO users (username,password) VALUES ('$username','$password')";

    if ($conn->query($sql)===TRUE) {

        $message = "REGISTER SUCCESS";

    } else {
        $message = "REGISTER FAIL";
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
    <title>REGISTER</title>
</head>
<body>
    <h1>REGISTER</h1>
    <?php if(isset($message)): ?>
       <p1> <?php echo $message ?></p1>
    <?php endif; ?>

        <form method="post" action="register.php">
            Username: <input type="text" name="username" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" value="REGISTER">
        </form>

        <form action="login.php">
            <input type="submit" value="LOGIN PAGE">
        </form>
        
</body>
</html>