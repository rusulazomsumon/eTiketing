<?php
// Assuming you have a database connection established
include('backEnd/connection.php');

// Fetch data for user with ID 1 using a JOIN query
$sql = "SELECT
            users.name AS user_name,
            users.mobile,
            users.mail,
            bus_trip.departure_from,
            bus_trip.destination_to,
            seat_reservation.reservation_date,
            bus_trip.trip_time,
            bus_trip.price,
            seat_reservation.seat_number
        FROM seat_reservation
        JOIN users ON seat_reservation.user_id = users.id
        JOIN bus_trip ON seat_reservation.bus_trip_id = bus_trip.id
        WHERE users.id = 1
        ORDER BY seat_reservation.id DESC
        LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='container d-flex justify-content-center mt-5'>";
    echo "<div class='card border-info'>";
    echo "<div class='card-body'>";
    echo "<h5 class='card-title text-info text-center mb-4'>Bus Ticket</h5>";

    while ($row = $result->fetch_assoc()) {
        // Fetch a random image from lorempixel for user profile image
        $randomImageURL = "https://picsum.photos/100/100";

        echo "<div class='text-center'>";
        echo "<img src='{$randomImageURL}' class='img-fluid rounded-circle mb-3' alt='User Image'>";
        echo "<p class='mb-1'><strong>Name:</strong> {$row['user_name']}</p>";
        echo "<p class='mb-1'><strong>Mobile:</strong> {$row['mobile']}</p>";
        echo "<p class='mb-1'><strong>Email:</strong> {$row['mail']}</p>";
        echo "</div>";

        echo "<hr class='my-4'>";

        echo "<div class='text-center'>";
        echo "<p class='mb-1'><strong>From:</strong> {$row['departure_from']}</p>";
        echo "<p class='mb-1'><strong>To:</strong> {$row['destination_to']}</p>";
        echo "<p class='mb-1'><strong>Date:</strong> {$row['reservation_date']}</p>";
        echo "<p class='mb-1'><strong>Time:</strong> {$row['trip_time']}</p>";
        echo "<p class='mb-1'><strong>Price:</strong> {$row['price']}</p>";
        echo "<p class='mb-1'><strong>Seat Number:</strong> {$row['seat_number']}</p>";
        echo "</div>";
    }

    // Payment button
    echo "<div class='mt-4 text-center'>";
    echo "<button class='btn btn-success mr-2' onclick='makePayment()'>Make Payment</button>";
    
    // Print button
    echo "<button class='btn btn-info' onclick='printTicket()'>Print Ticket</button>";
    // home 
    echo "<button class='btn btn-info'><a href='/ebus'>Back To Home</a></button>";
    echo "</div>";

    echo "</div>";
    echo "</div>";
    echo "</div>";

    // JavaScript for payment and printing
    echo "<script>
            function makePayment() {
                // use payment getway 
                alert('Please proceed to the counter for payment.');
            }

            function printTicket() {
                window.print();
            }
          </script>";
} else {
    echo "No data found";
}

// Close the database connection
$conn->close();
?>
