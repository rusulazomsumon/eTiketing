<?php
// Include your database connection code here
include('backEnd/connection.php');


// Set default values
$user_id = 1; // Replace with your logic to get the actual user ID
$bus_trip_id = 1; // Replace with your logic to get the actual bus trip ID

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $from = $_POST['from'];
    $to = $_POST['to'];
    $date = $_POST['date'];
    $selected_seat = $_POST['selected_seat'];

    // Insert into seat_reservation table
    $insertQuery = "INSERT INTO seat_reservation (user_id, bus_trip_id, seat_number, reservation_date)
                    VALUES ('$user_id', '$bus_trip_id', '$selected_seat', '$date')";

    if ($conn->query($insertQuery) === TRUE) {
        header("Location: eticket.php");
    } else {
        echo "Error: " . $insertQuery . "<br>" . $conn->error;
    }
}
?>
