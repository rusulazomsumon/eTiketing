<?php
// Include the database connection file
include('../../backEnd/connection.php');

// Fetch details for the first user and their reservation details
$sql = "SELECT
            u.id AS user_id,
            u.username,
            u.mobile,
            u.mail,
            v.vehicle_name AS reserved_car,
            r.reservation_date,
            r.reservation_hours,
            (r.reservation_hours * v.price_per_hour) AS total_price
        FROM
            users u
        LEFT JOIN
            reservations r ON u.id = r.vehicle_id  -- Corrected column name
        LEFT JOIN
            vehicle v ON r.vehicle_id = v.id
        ORDER BY
            u.id
        LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    echo "<html>
            <head>
                <title>User and Reservation Details</title>
                <!-- Add Bootstrap and your CSS styling here -->
                <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
                <style>
                    /* Add your custom styling here */
                </style>
            </head>
            <body>
                <div class='container mt-4'>
                    <h2 class='mb-4'>User and Reservation Details</h2>
                    <div class='card'>
                        <div class='card-body'>
                            <h5 class='card-title'>User Information</h5>
                            <p class='card-text'>User ID: {$user['user_id']}</p>
                            <p class='card-text'>Username: {$user['username']}</p>
                            <p class='card-text'>Mobile: {$user['mobile']}</p>
                            <p class='card-text'>Email: {$user['mail']}</p>
                        </div>
                    </div>
                    <div class='card mt-4'>
                        <div class='card-body'>
                            <h5 class='card-title'>Reserved Car Details</h5>
                            <p class='card-text'>Car: {$user['reserved_car']}</p>
                            <p class='card-text'>Reservation Date: {$user['reservation_date']}</p>
                            <p class='card-text'>Reservation Hours: {$user['reservation_hours']}</p>
                            <p class='card-text'>Total Price: {$user['total_price']}</p>
                        </div>
                    </div>
                </div>
            </body>
        </html>";
} else {
    echo "No users found in the database.";
}

// Close the database connection
$conn->close();
?>