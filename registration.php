<?php
$conn = new mysqli('localhost', 'root', '', 'lab_5b');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 
    $role = $_POST['role'];

     $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";
     if ($conn->query($sql)) {
         echo "Registration successful!";
     } else {
         echo "Error: " . $conn->error;
     }
 }
 ?>

<form method="POST" action="">
    Matric: <input type="text" name="matric" required><br>
    Name: <input type="text" name="name" required><br>
    Password: <input type="password" name="password" required><br>
    Role: 
    <select name="role" required>
        <option value="please_select" selected disabled>Please select</option>
        <option value="student">Student</option>
        <option value="lecturer">Lecturer</option>
    </select><br>
    <button type="submit">Submit</button>
</form>
