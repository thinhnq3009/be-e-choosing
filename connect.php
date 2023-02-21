<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT");

$server_name = "localhost";
$username = "root";
$password = "";
$dbname = "e-choosing";
error_reporting(0);
// Tạo kết nối
$conn = mysqli_connect($server_name, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
