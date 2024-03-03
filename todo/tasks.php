<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "123";
$dbname = "tdl";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted to add a new task
if (isset($_POST['description'])) {
    $description = $_POST['description'];
    $sql = "INSERT INTO tasks (description) VALUES ('$description')";
    $conn->query($sql);
}

// Check if form is submitted to delete a task
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM tasks WHERE id=$id";
    $conn->query($sql);
}

// Fetch tasks from the database
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li data-id='" . $row['id'] . "'>" . $row['description'] . "<button class='delete'>Delete</button></li>";
    }
} else {
    echo "<li>No tasks found.</li>";
}

$conn->close();

?>
