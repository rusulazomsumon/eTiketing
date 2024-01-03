<?php
include('backEnd/connection.php');

session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: backEnd/login.php"); 
    exit();
}

$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome, <?php echo $username; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- ########Header Area ###### -->
        <a class="navbar-brand" href="#">
                <h1>Bus eTicketing and Vehicle Reservation System</h1>
        </a>
        <nav class="navbar navbar-expand-lg navbar-light text-info bg-light">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-info" aria-current="page" href="#">Bus</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="#">Train</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-info" href="#">Contact</a>
                </li>
                </ul>
            </div>
            <!-- nav area -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <!-- user icon -->
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="media/user-icon.png" alt="User Icon" class="mr-2" width="20" height="20">
                            <?php echo $username; ?>
                        </a>
                        <!-- user dropdown option -->
                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="backEnd/user">Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="backEnd/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

         <!-- #########Rent A Car######### -->
         <div class="card">
            <div class="card-body">
                <h5 class="card-title">Vehicle Reservation</h5>
                <a href="backEnd/rent/vehicle.php" class="btn btn-primary">Find Your Vehicle</a>
            
            </div>
        </div>

        <!-- ######eBus Tikiting ######## -->
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Bus Ticket Booking</h5>
                <form action="search_tickets.php" method="post">
                    <?php

                    // Fetch unique 'from' values from the bus_trip table
                    $fromQuery = "SELECT DISTINCT departure_from FROM bus_trip";
                    $fromResult = $conn->query($fromQuery);

                    // Fetch unique 'to' values from the bus_trip table
                    $toQuery = "SELECT DISTINCT destination_to FROM bus_trip";
                    $toResult = $conn->query($toQuery);
                    ?>

                    <div class="form-group">
                        <label for="from">From:</label>
                        <select class="form-control" name="from" required>
                            <?php
                            while ($fromRow = $fromResult->fetch_assoc()) {
                                echo "<option value='{$fromRow['departure_from']}'>{$fromRow['departure_from']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="to">To:</label>
                        <select class="form-control" name="to" required>
                            <?php
                            while ($toRow = $toResult->fetch_assoc()) {
                                echo "<option value='{$toRow['destination_to']}'>{$toRow['destination_to']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <!-- ############Date############### -->

                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>

                    <!-- ############Seact Selection############### -->
                    <div class="form-group">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">1</th>
                                    <th scope="col">2</th>
                                    <th scope="col">3</th>
                                    <th scope="col">4</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $seatCount = 40;
                                $rows = ceil($seatCount / 4);

                                for ($i = 0; $i < $rows; $i++) {
                                    echo "<tr>";
                                    // Display row label (English letter)
                                    echo "<th scope='row'>" . chr(65 + $i) . "</th>";

                                    for ($j = 1; $j <= 4; $j++) {
                                        $seatNumber = $i * 4 + $j;
                                        echo "<td onclick='selectSeat($seatNumber)' style='cursor: pointer;' id='seat{$seatNumber}'>$seatNumber</td>";
                                    }

                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <input type="hidden" name="selected_seat" id="selected_seat" value="">
                    </div>

                        <style>
                            /* Add hover effect */
                            table td:hover {
                                background-color: #f0f0f0;
                            }
                        </style>

                        <script>
                            function selectSeat(seatNumber) {
                                // Set the selected seat in the hidden input field
                                document.getElementById('selected_seat').value = seatNumber;

                                // Optional: Highlight the selected seat for visual feedback
                                resetSeatStyles();
                                document.getElementById('seat' + seatNumber).style.backgroundColor = '#aaffaa';
                            }

                            function resetSeatStyles() {
                                // Reset all seat styles
                                var seats = document.querySelectorAll('table td');
                                seats.forEach(function (seat) {
                                    seat.style.backgroundColor = '';
                                });
                            }
                        </script>



                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <?php
        // Close the database connection
        $conn->close();
        ?>


       

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
