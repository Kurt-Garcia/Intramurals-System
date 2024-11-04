<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "intramz");
if ($con) {
    //echo "Successfully Connected.";
} else {
    echo "Connection Failed.";
}
?>