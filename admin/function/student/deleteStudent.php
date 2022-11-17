<?php
session_start();

if(isset($_SESSION['username'])) {
    include('../../../connection.php');
    $student_id = $_GET['id'];
    $sql = "DELETE FROM sinhvien WHERE id = $student_id";
    $query = mysqli_query($conn, $sql);
    header('Location: ../../student.php');
}
