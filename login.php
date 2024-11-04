<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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

        .btn-back {
            position: absolute;
            top: 10px;
            left: 10px;
        }

        .btn-logout {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>

<body>
    <?php
    include ("dbcon.php");

    if (isset($_SESSION['currentUser'])) {
        header("location: menu.php");
    }

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $sql = "SELECT * FROM regis WHERE userName='$username' AND role='$role'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if (mysqli_num_rows($result) > 0) {

            if ($row['userName'] == $username && $password == $row["password"]) {
                $_SESSION['currentUser'] = $username;
                $_SESSION['role'] = $role;
                header("location: menu.php");
                //echo "login successfuly";
            } else {
                echo "<div class='alert alert-danger'>Invalid Username or Password.</div>";
            }


        } else {
            echo "<div class='alert alert-danger'>Account doesn't exist or Role doesn't match.</div>";
        }

    }
    ?>
    
    <div class="container">
        <h1>LOGIN</h1>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required />
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select name="role" class="form-control">
                    <option value="admin">Admin</option>
                    <option value="student">Student</option>
                    <option value="coach">Coach</option>
                    <option value="tournamentManager">Tournament Manager</option>
                    <option value="dean">Dean</option>
                </select>
            </div>
            <button type="submit" name="login" class="btn btn-primary">LOGIN</button>
        </form>
        <p>Don't have an account yet? <a href="registration.php">Sign Up</a></p>
    </div>

   
</body>

</html>
