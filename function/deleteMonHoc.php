<?php
session_start();

if(isset($_SESSION['username'])) {
    include('../connection.php');
    $diem_id = $_GET['id'];
    $sql = "DELETE FROM diem WHERE id = $diem_id";
    $query = mysqli_query($conn, $sql);
    header('Location: ../dkhp.php');
}
?>