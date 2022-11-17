<?php
session_start();

if (isset($_SESSION['username'])) {
    include('../../../connection.php');
    $mark_id = $_GET['id'];
    $sql = "UPDATE diem SET diem.nop_tien = 1 WHERE id = $mark_id";
    $query = mysqli_query($conn, $sql);

    $sql2 = "SELECT sv_id FROM diem WHERE id = $mark_id";
    $query2 = mysqli_query($conn, $sql2);

    $result = array();

    if (mysqli_num_rows($query2) > 0) {
        while ($row = mysqli_fetch_assoc($query2)) {
            $result = $row;
        }
    }

    $sv_id = $result['sv_id'];
    

    $sql1 = "UPDATE sinhvien SET cong_no = 0 WHERE id = $sv_id";
    $query1 = mysqli_query($conn, $sql1);

    header('Location: ../../money.php');
}
