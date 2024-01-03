<?php
// Include the database connection file
include('../../backEnd/connection.php');

// Fetch available vehicles
$sql = "SELECT * FROM vehicle";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<html>
            <head>
                <title>Available Vehicles</title>
                <!-- Add Bootstrap and your CSS styling here -->
                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
                <style>
                    /* Add your custom styling here */
                </style>
            </head>
            <body>
                <div class='container mt-4'>
                    <h2 class='mb-4'>Available Vehicles</h2>";

    $count = 0;

    while ($row = $result->fetch_assoc()) {
        if ($count % 3 == 0) {
            echo "<div class='row'>";
        }

        // Use a default image path for all vehicles
        $defaultImageURL = "../../media/vehicle.jpg";

        echo "<div class='col-md-4 mb-3'>
                <div class='card'>
                    <img src='{$defaultImageURL}' class='card-img-top' alt='Vehicle Image'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$row['vehicle_name']}</h5>
                        <p class='card-text'>Price per Hour: {$row['price_per_hour']}</p>
                        <p class='card-text'>Type: {$row['vehicle_type']}</p>
                        <p class='card-text'>Company: {$row['company_name']}</p>
                        <a href='reserve.php?vehicle_id={$row['vehicle_id']}' class='btn btn-primary'>Reserve</a>
                    </div>
                </div>
              </div>";

        $count++;

        if ($count % 3 == 0) {
            echo "</div>";
        }
    }

    // Close the last row if the number of vehicles is not a multiple of 3
    if ($count % 3 != 0) {
        echo "</div>";
    }

    echo "</div>
          </body>
          </html>";
} else {
    echo "No available vehicles.";
}

// Close the database connection
$conn->close();
?>