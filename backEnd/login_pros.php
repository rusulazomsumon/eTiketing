<?php
// Include the database connection file
include('connection.php');

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate user credentials
    $sql = "SELECT id FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Start a session and store user information
        session_start();
        $_SESSION["username"] = $username;

        // Redirect to a welcome page or dashboard
        header("Location: ../index.php");
        exit();
    } else {
        echo "Invalid username or password";
    }
}

// Close the database connection
$conn->close();
?>
