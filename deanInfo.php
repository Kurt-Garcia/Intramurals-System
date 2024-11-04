<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dean Info</title>

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
    <?php
        include("dbcon.php");
        include("nav.php");

        if(isset($_POST["save"])){
            $userName = $_SESSION['currentUser'];
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $mobile = $_POST["mobile"];
            $deptID = $_POST["deptID"];

            $sql = "SELECT * FROM dean WHERE userName=$userName";
            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) === 0){
                $sql = "INSERT INTO `dean`(`userName`,`fName`, `lName`, `mobile`, `deptID`) VALUES ($userName,'$fname','$lname',$mobile,$deptID)";
                mysqli_query($con, $sql);
                header("location: menu.php");
            }else{
                echo "<div class='alert alert-danger'>Already exists.</div>";
            }
        }
    ?>
    
    <div class="container">
        <a href="menu.php" class="btn btn-primary btn-back">BACK</a>
        <h1 class="mt-4 mb-4">Dean Info</h1>
        
        <form method="POST" action="deanInfo.php">
            <div class="form-group">
                <label for="userName">Username:</label>
                <input type="number" name="userName" value="<?php echo $_SESSION['currentUser']?>" class="form-control" readonly/>
            </div>
            <div class="form-group">
                <label for="fname">Firstname:</label>
                <input type="text" name="fname" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="lname">Lastname:</label>
                <input type="text" name="lname" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="mobile">Mobile:</label>
                <input type="text" name="mobile" class="form-control" maxlength="11" required/>
            </div>
            <div class="form-group">
                <label for="deptID">Department:</label>
                <select name="deptID" class="form-control">
                    <?php
                        $sql = "SELECT * FROM department";
                        $result = mysqli_query($con, $sql);
                        
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                                echo "<option value=$row[deptID]>$row[deptName]</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <button type="submit" name="save" class="btn btn-primary">SAVE</button>
        </form>
    </div>
</body>

</html>
