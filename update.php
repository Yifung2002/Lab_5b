<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "Session not set. Redirecting to login page...";
    header('Location: login.php');
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'lab_5b');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete functionality
if (isset($_GET['delete'])) {
    $matric = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE matric = '$matric'");
    header('Location: update.php');
    exit();
}

$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);
?>

<table border="1">
    <tr>
        <th>Matric</th>
        <th>Name</th>
        <th>Level</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['matric']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['role']; ?></td>
        <td>
            <a href="update_user.php?matric=<?php echo $row['matric']; ?>">Update</a>
            <a href="update.php?delete=<?php echo $row['matric']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php $conn->close(); ?>
