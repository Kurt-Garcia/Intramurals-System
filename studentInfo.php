<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athlete Info</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            padding-top: 50px;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
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

<body style="text-align: center;">
    <?php   
        include("dbcon.php");
        include("nav.php");

        if(isset($_POST['save'])){
            $idNum = $_POST['idNum'];
            $eventID = $_POST['eventID'];
            $lastName = $_POST['lastName'];
            $firstName = $_POST['firstName'];
            $middleInit = $_POST['middleInit'];
            $course = $_POST['course'];
            $year = $_POST['year'];
            $civilStatus = $_POST['civilStatus'];
            $gender = $_POST['gender'];
            $birthdate = $_POST['birthdate'];
            $contactNo = $_POST['contactNo'];
            $address = $_POST['address'];
            $coachID = $_POST['coachID'];

            $sql = "SELECT * FROM coach WHERE userName=$coachID";
            $result = mysqli_query($con,$sql);    
            $row = mysqli_fetch_array($result);
            
            $coachDeptID = $row['deptID'];
            
            $deanID;
            $deptID;
            $sql = "SELECT dean.userName, dean.deptID, department.deptID AS ID, department.deptName FROM dean INNER JOIN department ON dean.deptID = department.deptID WHERE department.deptName = '$course'";
            $result = mysqli_query($con, $sql);
            if($row=mysqli_fetch_array($result)){
                $deanID = $row['userName'];
                $deptID = $row['ID'];
                if($deptID === $coachDeptID ){
                    $sql = "INSERT INTO `athlete`(`idNum`, `eventID`, `deptID`, `lastName`, `firstName`, `middleInit`, `course`, `year`, `civilStatus`, `gender`, `birthdate`, `contactNo`, `address`, `coachID`, `deanID`) VALUES ($idNum,$eventID,$deptID,'$lastName','$firstName','$middleInit','$course',$year,'$civilStatus','$gender','$birthdate','$contactNo','$address',$coachID,$deanID)";
                    $result = mysqli_query($con, $sql);
                    echo "Successful";
                }else{
                    echo "Course does'nt match with Coach Department.";
                }
            }else{
                echo "Failed";
            }
        }
    ?>
    </br>
    
    <a href="menu.php" class="btn btn-primary btn-back">BACK</a>
    <h1>Athlete Info</h1>
    <div class="container">
        <form method="POST" action="studentInfo.php">
            <div class="form-group">
                <label for="idNum">ID</label>
                <input type="text" name="idNum" class="form-control" value="<?php echo $_SESSION['currentUser']?>" readonly />
            </div>
            <div class="form-group">
                <label for="eventID">Event</label>
                <select name="eventID" class="form-control" required>
                    <?php
                        $sql = "SELECT * FROM event";
                        $result = mysqli_query($con,$sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value=$row[eventID]>$row[eventName]</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="lastName">Lastname</label>
                <input type="text" name="lastName" class="form-control" required/>
            </div>

            <div class="form-group">
                <label for="firstName">Firstname</label>
                <input type="text" name="firstName" class="form-control" required/>
            </div>

            <div class="form-group">
                <label for="middleInit">Middle Initial</label>
                <input type="text" name="middleInit" class="form-control" required/>
            </div>

            <div class="form-group">
                <label for="course">Course</label>
                <select name="course" class="form-control" required>
                    <option value="CCS">CCS</option>
                    <option value="CSBA">BSBA</option>
                    <option value="BSCRIM">BSCRIM</option>
                </select>
            </div>

            <div class="form-group">
                <label for="year">Year</label>
                <select name="year" class="form-control" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
            </div>

            <div class="form-group">
                <label for="civilStatus">Civil Status</label>
                <select name="civilStatus" class="form-control" required>
                    <option value="single">Single</option>
                    <option value="married">Married</option>
                    <option value="divorced">Divorced</option>
                    <option value="widowed">Widowed</option>
                </select>
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="male" required>
                    <label class="form-check-label">Male</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="female" required>
                    <label class="form-check-label">Female</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="others" required>
                    <label class="form-check-label">Others</label>
                </div>
            </div>

            <div class="form-group">
                <label for="birthdate">Birthdate</label>
                <input type="date" name="birthdate" class="form-control" required/>
            </div>
            
            <div class="form-group">
                <label for="contactNo">Contact #</label>
                <input type="text" name="contactNo" class="form-control" required/>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" required/>
            </div>

            <div class="form-group">
                <label for="coachID">Coach</label>
                <select name="coachID" class="form-control" required>
                    <?php
                        $sql = "SELECT * FROM coach";
                        $result = mysqli_query($con,$sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value=$row[userName]>$row[fName] $row[lName]</option>";
                        }
                    ?>
                </select>
            </div>

            <button type="submit" name="save" class="btn btn-primary">SAVE</button>
        </form>
    </div>
</body>

</html>
