<?php
    include ("dbcon.php");
    include("nav.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Custom Styles -->
    <style>
        body {
            text-align: center;
            padding-top: 50px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .menu-link {
            display: block;
            margin-bottom: 15px;
            font-size: 18px;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 30px;
        }

        .btn-logout {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == "admin") {
                echo "<h1>Welcome Admin!</h1>";
                echo "<a href='addDepartment.php' class='btn btn-secondary menu-link'>Create Department Data</a>";
                echo "<a href='addEvent.php' class='btn btn-secondary menu-link'>Add Event</a>";
                echo "<a href='listOfEvent.php' class='btn btn-secondary menu-link'>List of Event</a>";

            } elseif ($_SESSION['role'] == "student") {
                echo "<h1>Student Menu</h1>";
                echo "<a href='studentInfo.php' class='btn btn-primary menu-link'>Fill-up Your Info</a>";

            } elseif ($_SESSION['role'] == "tournamentManager") {
                echo "<h1>Tournament Manager Menu</h1>";
                echo "<a href='tournamentManagerinfo.php' class='btn btn-primary menu-link'>Fill-up Your Info</a>";

            } elseif ($_SESSION['role'] == "coach") {
                echo "<h1>Coach Menu</h1>";
                echo "<a href='coachInfo.php' class='btn btn-secondary menu-link'>Fill-up Your Info</a>";
                echo "<a href='athletes.php' class='btn btn-secondary menu-link'>My Athletes</a>";
                echo "<a href='pendingAthletes.php' class='btn btn-secondary menu-link'>Pending Athletes</a>";

            } elseif ($_SESSION['role'] == "dean") {
                echo "<h1>Dean Menu</h1>";
                echo "<a href='deanInfo.php' class='btn btn-primary menu-link'>Fill-up Your Info</a>";
            }       
        }
        ?>
    </div>
</body>

</html>
