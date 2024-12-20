<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'lab_5b');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "SELECT * FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found!";
        exit();
    }
} else {
    echo "No user specified!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $_POST['matric']; 
    $name = $_POST['name'];

    $sql = "UPDATE users SET name = '$name' WHERE matric = '$matric'";

    if ($conn->query($sql)) {
        echo "User updated successfully!";
        header('Location: update.php'); 
        exit();
    } else {
        echo "Error updating user: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <form method="POST" action="">
        Matric: <input type="text" name="matric" value="<?php echo $user['matric']; ?>" readonly><br>
        Name: <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>
        Access Level: <input type="text" name="level" value="<?php echo ucfirst($user['role']); ?>" readonly><br>
        <button type="submit">Update</button>
        <a href="update.php">Cancel</a>
    </form>
</body>
</html>
