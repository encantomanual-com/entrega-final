<?php
$con = mysqli_connect('localhost', 'root', '', 'emsql1');
if (!$con) {
    echo "A conexão com o banco falhou";
    die(mysqli_error($con));
}
?>