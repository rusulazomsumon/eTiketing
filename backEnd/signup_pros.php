<?php
session_start();

// Include the database connection file
include('connection.php');

// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $mobile = $_POST["mobile"];
    $mail = $_POST["mail"];
    $sex = $_POST["sex"];
    $role = $_POST["role"];

    // Check if the username is already taken
    $check_username = "SELECT id FROM users WHERE username = '$username'";
    $result_username = $conn->query($check_username);

    if ($result_username->num_rows > 0) {
        echo "Username already taken. Please choose a different username.";
    } else {
        // Insert user data into the database
        $insert_sql = "INSERT INTO users (username, password, name, address, mobile, mail, sex, role)
                       VALUES ('$username', '$password', '$name', '$address', '$mobile', '$mail', '$sex', '$role')";

        if ($conn->query($insert_sql) === TRUE) {
            // Registration successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
