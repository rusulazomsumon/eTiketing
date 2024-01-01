<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "ebus");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];

// Retrieve user information from the database
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $address = $row["address"];
    $mail = $row["mail"];
    $role = $row["role"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Profile</h2>
        <a href="/ebus">Home</a>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $name; ?></h5>
                <p class="card-text">Username: <?php echo $username; ?></p>
                <p class="card-text">Address: <?php echo $address; ?></p>
                <p class="card-text">Email: <?php echo $mail; ?></p>

                <?php if ($role == 1): ?>
                    <!-- Display the "Dashboard" link for users with role=1 -->
                    <a href="../../dashboard/" class="btn btn-primary">Dashboard</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
