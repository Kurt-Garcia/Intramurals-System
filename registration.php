<?php
include ("dbcon.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

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

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
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
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $role = $_POST['role'];

        $sql = "SELECT * FROM regis WHERE username='$username'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "User already exist.";
        } else {
            if ($password == $confirmPassword) {
                $sql = "INSERT INTO regis (`userName`, `password`, `confirmPassword`, `role`) VALUES ($username,'" . $password . "','" . $confirmPassword . "', '" . $role . "') ";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    header("location: login.php");
                    //echo "Register Success";
                } else {
                    echo "Register Failed";
                }
            } else {
                echo "Password do not match.";
            }
        }
    }
    ?>

    </br>

    <div class="container">
        <h1>Register Here</h1>
        <form method="POST" action="registration.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="number" name="username" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" name="confirmPassword" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="student">Student</option>
                    <option value="tournamentManager">Tournament Manager</option>
                    <option value="coach">Coach</option>
                    <option value="dean">Dean</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>
</body>

</html>