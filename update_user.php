<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'lab_5b');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data for pre-filling the form
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

// Update user data in the database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $_POST['matric']; // Matric remains unchanged
    $name = $_POST['name'];

    $sql = "UPDATE users SET name = '$name' WHERE matric = '$matric'";

    if ($conn->query($sql)) {
        echo "User updated successfully!";
        // Redirect back to the user list or another page
        header('Location: update.php'); // Replace with the correct page name
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
        <!-- Matric field (read-only since it shouldn't be changed) -->
        Matric: <input type="text" name="matric" value="<?php echo $user['matric']; ?>" readonly><br>

        <!-- Name field (editable) -->
        Name: <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>

        <!-- Level field (read-only, cannot be updated) -->
        Access Level: <input type="text" name="level" value="<?php echo ucfirst($user['role']); ?>" readonly><br>

        <!-- Submit button -->
        <button type="submit">Update</button>
        
        <!-- Cancel link -->
        <a href="update.php">Cancel</a>
    </form>
</body>
</html>
