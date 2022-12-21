<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "approval_system";

$koneksi = mysqli_connect($host, $username, $password, $database);

if(!$koneksi){
    echo "Koneksi Ke Database Gagal";
}

?>