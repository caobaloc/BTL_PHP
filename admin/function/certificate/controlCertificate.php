<?php
session_start();

if(isset($_SESSION['username'])) {
    include('../../../connection.php');
    $cer_id = $_GET['id'];
    $tinh_trang = "Đã xử lý";
    $sql = "UPDATE chungchi SET tinh_trang = '$tinh_trang' WHERE id = $cer_id";
    $query = mysqli_query($conn, $sql);
    // var_dump($sql);
    // die();
    header('Location: ../../certificate.php');
}


