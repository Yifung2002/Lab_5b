<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'lab_5b');

// Fetch user data
$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);
?>

<table border="1">
    <tr>
        <th>Matric</th>
        <th>Name</th>
        <th>Level</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['matric']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['role']; ?></td>
    </tr>
    <?php endwhile; ?>
</table>
