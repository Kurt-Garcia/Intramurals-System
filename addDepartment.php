<?php
    include ("dbcon.php");
    include("nav.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Department</title>

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
        if (isset($_POST['save'])) {
            $deptID = $_POST['deptID'];
            $deptName = $_POST['deptName'];

            $sql = "SELECT * FROM department WHERE deptID=$deptID AND deptName='$deptName'";
            $result = mysqli_query($con, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<div class='alert alert-danger'>Department already exists.</div>";
            } else {
                $sql = "INSERT INTO `department`(`deptID`, `deptName`) VALUES ($deptID,'$deptName')";
                mysqli_query($con, $sql);
                header("location: menu.php");
            }
        }
    ?>

    <div class="container">
        <h1>Create Department</h1>
        <form method="POST" action="addDepartment.php">
            <div class="form-group">
                <label for="deptID">Department ID:</label>
                <input type="number" name="deptID" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="deptName">Department Name:</label>
                <input type="text" name="deptName" class="form-control" required>
            </div>
            <button type="submit" name="save" class="btn btn-secondary">SAVE</button>
        </form>
    </div>
</body>

</html>
