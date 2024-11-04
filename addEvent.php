<?php
    include ("dbcon.php");
    include("nav.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!-- Custom Styles -->
    <style>
        body {
            padding-top: 50px;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
        }

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

<body>
<a href="menu.php" class="btn btn-dark btn-back">BACK</a>
    <?php
        if(isset($_POST["save"])){
            $eventID = $_POST["eventID"];
            $category = $_POST["category"];
            $eventName = $_POST["eventName"];
            $noOfParticipant = $_POST["noOfParticipant"];
            $tournamentManager = $_POST["tournamentManager"];

            $sql = "SELECT * FROM event WHERE eventID=$eventID";
            $result = mysqli_query($con, $sql);
            
            if(mysqli_num_rows($result) === 0){
                $sql = "INSERT INTO `event`(`eventID`, `category`, `eventName`, `noOfParticipant`, `tournamentManager`) VALUES ($eventID,'$category','$eventName',$noOfParticipant,$tournamentManager)";
                $result = mysqli_query($con, $sql);
                header("location: menu.php");
            }else{
                echo "Event already exist.";
            }
            
        }

    ?>

    </br>

    <div class="container">
        <h1>Add Event</h1>
        <form method="POST" action="addEvent.php">
            <div class="form-group">
                <label>Event ID</label>
                <input type="number" name="eventID" class="form-control" required/>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category" class="form-control" required>
                    <option value="Athletic">Athletic</option>
                    <option value="Cultural">Cultural</option>
                    <option value="Academic">Academic</option>
                </select>
            </div>

            <div class="form-group">
                <label>Event Name</label>
                <input type="text" name="eventName" class="form-control" required/>
            </div>

            <div class="form-group">
                <label># of Participants</label>
                <input type="number" name="noOfParticipant" class="form-control" required/>
            </div>

            <div class="form-group">
                <label>Tournament Manager</label>
                    <select name="tournamentManager" class="form-control" required>
                        <?php             
                            $sql = "SELECT * FROM tournamentmanager";
                            $result = mysqli_query($con, $sql); 
                            
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value=$row[userName]>$row[fName] $row[lName]</option>";
                            }
                        ?>
                    </select>
            </div>

            <button type="submit" name="save" class="btn btn-secondary">SAVE</button>
        </form>
    </div>
</body>
</html>