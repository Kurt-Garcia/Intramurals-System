<?php
if (!isset($_SESSION['currentUser'])) {
    header("location: login.php");
}


if (isset($_POST['logout'])) {
    $_SESSION = array();
    session_destroy();
    unset($_SESSION);

    header("location: login.php");
}
?>

<form method="POST" action="">
    <button type="submit" name="logout" class="btn btn-danger btn-logout">LOGOUT</button>
</form>