<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
}
$tkid = $_SESSION['username'];

// $subject_name = trim($_POST['subject_name']);
// $subject_name = addslashes($subject_name);
// echo "monhoc: " . $subject_name;
?>

<!DOCTYPE html>
<html lang="en">

<?php include('common/head.php'); ?>

<body>
    <?php $page = "student";
    include('common/menu.php'); ?>
    <div class="main-content">
        <header>
            <div class="name-content" style="line-height: 55px; width: 30%;">
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars">
                        </span>
                    </label>
                    Nhập điểm
                </h1>
            </div>
            <?php include('common/search.php'); ?>
            <?php include('common/logout.php'); ?>
        </header>
        <?php

        if (isset($_POST['btn_logout'])) {
            unset($_SESSION['username']);
            header('Location: ../login.php');
        }
        ?>
        <main>
            <div class="main-table">


                <h2>DANH SÁCH SINH VIÊN</h2>
                <div class="list-student">
                    <table class="module-table">
                        <tr>
                            <th>STT</th>
                            <th>Mã sinh viên</th>
                            <th>Họ và tên</th>
                            <th>Tên lớp</th>
                            <th>Học kỳ</th>
                            <th>Điểm tự đánh giá</th>
                            <th>Điểm GVCN đánh giá</th>
                            <th>Điểm cộng</th>
                            <th>Chức năng</th>
                        </tr>
                        <?php
                        $sql1 = "SELECT lop.id as lop_id, lop.ten_lop, sinhvien.ma_sv, sinhvien.ten_sv, 
                        diemrenluyen.id as drl_id, diemrenluyen.hoc_ky, diemrenluyen.diem_tu_danh_gia, diemrenluyen.diem_gv_danh_gia, diemrenluyen.diem_cong FROM sinhvien 
                                                    INNER JOIN lop ON sinhvien.lop_id = lop.id
                                                    INNER JOIN diemrenluyen ON diemrenluyen.sv_id = sinhvien.id
                                                    INNER JOIN giaovien ON lop.id = giaovien.lop_id
                        WHERE giaovien.ten_gv = '$tkid'";


                        $query1 = mysqli_query($conn, $sql1);
                        $i = 0;
                        if ($query1) {
                            foreach ($query1 as $item) {
                                $i++;
                                echo "<tr>";
                                echo "<td>$i</td>";
                                echo "<td>" . $item['ma_sv'] . "</td>";
                                echo "<td>" . $item['ten_sv'] . "</td>";
                                echo "<td>" . $item['ten_lop'] . "</td>";
                                echo "<td>" . $item['hoc_ky'] . "</td>";
                                echo "<td>" . $item['diem_tu_danh_gia'] . "</td>";
                                echo "<td><input style=\"height: 40px; width:80px; text-align:center;\" type=\"text\"
                                        value = " . $item['diem_gv_danh_gia'] . "></td>"; //diem gvcn danh gia
                                echo "<td><input style=\"height: 40px; width:80px; text-align:center;\" type=\"text\"
                                        value = " . $item['diem_cong'] . "></td>"; //diem cong
                                echo "<td style='text-align: center;'> <a href='function/mark/updateMark.php?id=" . $item['drl_id'] . "'><input class='btnSua' type='button' value='Nhập điểm' '></a></td>";
                            }
                        } else {
                            echo "<p>Query errors!</p>";
                        }
                        ?>
                    </table>
                    <div class="btn-them">
                        <a href='function\mark\showMark.php'><input type='button' value='Lọc danh sách' class="btnThem"></a>
                    </div>
                </div>
            </div>
        </main>
    </div>


</body>

</html>