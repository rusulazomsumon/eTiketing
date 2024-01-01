<?php
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
                            <a class="dropdown-item" href="backEnd">Dashboard</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="backEnd/logout.php">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- ######eBus Tikiting ######## -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Bus Ticket Booking</h5>
                <form action="search_tickets.php" method="post">
                    <div class="form-group">
                        <label for="from">From:</label>
                        <input type="text" class="form-control" name="from" required>
                    </div>
                    <div class="form-group">
                        <label for="to">To:</label>
                        <input type="text" class="form-control" name="to" required>
                    </div>
                    <div class="form-group">
                        <label for="date">Date:</label>
                        <input type="date" class="form-control" name="date" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <!-- #########Rent A Car######### -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rent A Car</h5>
                <p>Select your location:</p>
                <a href="backEnd/rent/inside_dhaka.php" class="btn btn-primary">Inside Dhaka</a>
                <a href="backEnd/rent/outside_dhaka.php" class="btn btn-primary">Outside Dhaka</a>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
