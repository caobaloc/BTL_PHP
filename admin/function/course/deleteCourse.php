<?php
session_start();

if(isset($_SESSION['username'])) {
    include('../../../connection.php');
    $course_id = $_GET['id'];
    $sql = "DELETE FROM monhoc WHERE id = $course_id";
    $query = mysqli_query($conn, $sql);
    header('Location: ../../course.php');
}
