<?php
// Include the database connection file
include('../../backEnd/connection.php');

// Check if the vehicle_id is provided in the URL
if (isset($_GET['vehicle_id'])) {
    $vehicle_id = $_GET['vehicle_id'];

    // Fetch vehicle details based on the provided vehicle_id
    $sql = "SELECT * FROM vehicle WHERE vehicle_id = $vehicle_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $vehicle = $result->fetch_assoc();

        // Display the reservation form
        echo "<html>
                <head>
                    <title>Reserve Vehicle</title>
                    <!-- Add Bootstrap and your CSS styling here -->
                    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
                    <style>
                        /* Add your custom styling here */
                    </style>
                </head>
                <body>
                    <div class='container mt-4'>
                        <h2 class='mb-4'>Reserve Vehicle</h2>
                        <div class='card'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$vehicle['vehicle_name']}</h5>
                                <p class='card-text'>Price per Hour: {$vehicle['price_per_hour']}</p>
                                <p class='card-text'>Type: {$vehicle['vehicle_type']}</p>
                                <p class='card-text'>Company: {$vehicle['company_name']}</p>
                                <form action='process_reservation.php' method='post'>
                                    <input type='hidden' name='vehicle_id' value='{$vehicle['vehicle_id']}'>
                                    <div class='form-group'>
                                        <label for='reservation_date'>Reservation Date:</label>
                                        <input type='date' class='form-control' name='reservation_date' required>
                                    </div>
                                    <div class='form-group'>
                                        <label for='reservation_hours'>Reservation Hours:</label>
                                        <input type='number' class='form-control' name='reservation_hours' required>
                                    </div>
                                    <button type='submit' class='btn btn-primary'>Submit Reservation</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </body>
              </html>";
    } else {
        echo "Vehicle not found.";
    }
} else {
    echo "Vehicle ID not provided.";
}

// Close the database connection
$conn->close();
?>