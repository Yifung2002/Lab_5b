<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'lab_5b');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    // Verify user
    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user; 
            header('Location: User.php'); 
            exit();
        }
    }
    echo "Invalid username or password, try <a href='login.php'>login</a> again.";
}
?>

<form method="POST" action="">
    Matric: <input type="text" name="matric" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<a href="registration.php">Register here if you have not.</a>
