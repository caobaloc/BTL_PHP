<?php
session_start();
include('../../../connection.php');

if (isset($_SESSION['username'])) {
    if (isset($_POST['key_search'])) {
        $keySearch = $_POST['key_search'];

        $sql = "SELECT * FROM sinhvien WHERE ten_sv LIKE '%$keySearch%' OR ma_sv LIKE '%$keySearch%'";
        $query = mysqli_query($conn, $sql);
        $result = '';
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $result .= "<tr><td>" . $row['ten_sv'] . "</td></tr>";
            }
        }
        echo $result;
    } else {
        echo "Không tìm thấy MSV!";
    }
} else {
    header('Location: ../../../login.php');
}
