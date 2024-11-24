<?php
$con = mysqli_connect('localhost', 'root', '', 'emsql1');
if (!$con) {
    echo "fail";
    die(mysqli_error($con));
}
?>