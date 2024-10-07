<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $post_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Post deleted successfully!."; 
    } else {
        $_SESSION['message'] = "Error deleting post..."; 
    }

    header("Location: home.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST['post_id'])) {
    $username = $_SESSION['username'];
    $content = $_POST['content'];

    $sql = "INSERT INTO posts (username, content) VALUES ('$username', '$content')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Posted!"; 
    } else {
        $_SESSION['message'] = "Error posting..."; 
    }
}

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);

$postsql = "SELECT * FROM posts";
$postresults = $conn->query($postsql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POSTS</title>
</head>
<body>
    <h1>POSTS</h1>
    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="post" action="home.php">
        Post Content: <input type="text" name="content" required><br>
        <input type="submit" value="POST">
    </form>

    <?php while ($post = $postresults->fetch_assoc()): ?>
        <p>
            <b><?php echo htmlspecialchars($post['username']); ?></b>
            <br>
            <?php echo htmlspecialchars($post['content']); ?>
            <form method="post" action="home.php" style="display:inline;">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this post?');">
            </form>
        </p>
    <?php endwhile; ?>
</body>
</html>
