<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Event</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .btn-logout {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .btn-back {
            position: absolute;
            top: 10px;
            left: 10px;
        }
    </style>
</head>

<body style="text-align: center;">
    <a href="login.php" class="btn btn-danger btn-logout">Logout</a>
    <a href="menu.php" class="btn btn-dark btn-back">BACK</a>

    <?php
     include("dbcon.php");
     include("nav.php");

     if(isset($_GET['delete'])){
        $eventID = $_GET['delete'];

        $sql = "DELETE FROM event WHERE eventID=$eventID";
        mysqli_query($con, $sql);
        header("location: listOfEvent.php");
     }

    ?>

    </br>

    <h1>List of Events</h1>
    <div class = "container">
        <table class = "table table-bordered table-stripled">
            <thead class = "thead-dark">
                <tr>
                    <th colspan='5'>Athletic Events</th>
                </tr>

                <tr>
                    <th class = "text-center">Event</th>
                    <th class = "text-center">Number of Participants</th>
                    <th class = "text-center">Tournament Manager</th>
                    <th colspan="2" class = "text-center">Actions</th>
                </tr>  
                
                <tr>
                    <th></th>
                    <th class = "text-center">Men | Women</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody style="text-align: center;">
                
                    <?php 
                        $sql = "SELECT event.eventID, event.eventName, event.noOfParticipant, tournamentmanager.userName, tournamentmanager.fName, tournamentmanager.lName FROM event INNER JOIN tournamentmanager ON event.tournamentManager = tournamentmanager.userName WHERE category='Athletic'";
                        $result = mysqli_query($con,$sql);

                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                            <tr>
                                <td>$row[eventName]</td>
                                <td>$row[noOfParticipant]</td>
                                <td>$row[fName] $row[lName]</td>
                                <td><a href='listOfEvent.php?delete=$row[eventID]'>Delete</a></td>
                                <td><a href='eventUpdate.php?update=$row[eventID]'>Update</a></td>
                            </tr>
                                ";
                        }
                    ?>
            
                <tr class="thead-dark">
                    <th colspan='5'>Cultural Events</th>
                </tr>
                <tr>
                    <?php 
                        $sql = "SELECT event.eventID, event.eventName, event.noOfParticipant, tournamentmanager.userName, tournamentmanager.fName, tournamentmanager.lName FROM event INNER JOIN tournamentmanager ON event.tournamentManager = tournamentmanager.userName WHERE category='Cultural'";
                        $result = mysqli_query($con,$sql);

                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                            <tr>
                                <td>$row[eventName]</td>
                                <td>$row[noOfParticipant]</td>
                                <td>$row[fName] $row[lName]</td>
                                <td><a href='listOfEvent.php?delete=$row[eventID]'>Delete</a></td>
                                <td><a href='eventUpdate.php?update=$row[eventID]'>Update</a></td>
                            </tr>
                            ";
                        }
                    ?>
                </tr>
                <tr class="thead-dark">
                    <th colspan='5'>Academic Events</th>
                </tr>
                <tr>
                    <?php 
                        $sql = "SELECT event.eventID, event.eventName, event.noOfParticipant, tournamentmanager.userName, tournamentmanager.fName, tournamentmanager.lName FROM event INNER JOIN tournamentmanager ON event.tournamentManager = tournamentmanager.userName WHERE category='Academic'";
                        $result = mysqli_query($con,$sql);

                        while ($row = mysqli_fetch_array($result)) {
                            echo "
                            <tr>
                                <td>$row[eventName]</td>
                                <td>$row[noOfParticipant]</td>
                                <td>$row[fName] $row[lName]</td>
                                <td><a href='listOfEvent.php?delete=$row[eventID]'>Delete</a></td>
                                <td><a href='eventUpdate.php?update=$row[eventID]'>Update</a></td>
                            </tr>
                            ";
                        }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>