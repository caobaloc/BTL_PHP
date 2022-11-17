<?php
session_start();

if(isset($_SESSION['username'])) {
    include('../../../connection.php');
    $cer_id = $_GET['id'];
    $sql = "DELETE FROM chungchi WHERE id = $cer_id";
    $query = mysqli_query($conn, $sql);
    header('Location: ../../certificate.php');
}
