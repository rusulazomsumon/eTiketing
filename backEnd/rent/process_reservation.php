<?php
// Include the database connection file
include('../../backEnd/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $vehicle_id = $_POST['vehicle_id'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_hours = $_POST['reservation_hours'];

    // Insert reservation into the database
    $insertQuery = "INSERT INTO reservations (vehicle_id, reservation_date, reservation_hours) 
                    VALUES ('$vehicle_id', '$reservation_date', '$reservation_hours')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "Reservation successful!";
        // header("Location: details.php");
        // You can redirect the user to a confirmation page or perform additional actions
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request!";
}

// Close the database connection
$conn->close();
?>
