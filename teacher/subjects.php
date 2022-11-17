<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
}
include('../connection.php');
$tkid = $_SESSION['username'];

// $subject_name = trim($_POST['subject_name']);
// $subject_name = addslashes($subject_name);
// echo "monhoc: " . $subject_name;
?>

<!DOCTYPE html>
<html lang="en">

<?php include('common/head.php'); ?>

<body>
    <?php $page = "subjects";
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
                <h2>DANH SÁCH SINH VIÊN THEO HỌC PHẦN</h2>
                <div class="list-student">
                    <table class="module-table">
                        <tr>
                            <th>STT</th>
                            <th>Mã sinh viên</th>
                            <th>Họ và tên</th>
                            <th>Điểm thành phần 1</th>
                            <th>Điểm thành phần 2</th>
                            <th>Điểm thi</th>
                            <th>Chức năng</th>
                        </tr>
                        <?php
                        $sql1 = "SELECT diem.id as diem_id, sinhvien.id as sv_id, monhoc.id as mh_id, sinhvien.ma_sv, sinhvien.ten_sv, diem_tp_1, diem_tp_2, diem_thi FROM sinhvien 
                        INNER JOIN diem ON  diem.sv_id = sinhvien.id 
                        INNER JOIN monhoc ON monhoc.id = diem.mon_id
                        INNER JOIN giaovien ON monhoc.gv_id = giaovien.id
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
                                echo "<td><input style=\"height: 40px; width:80px; text-align:center;\" type=\"text\" name=\"text-student-point1\" 
                                        value = " . $item['diem_tp_1'] . " ></td>"; //diem lan 1
                                echo "<td><input style=\"height: 40px; width:80px; text-align:center;\" type=\"text\" name=\"text-student-point2\"
                                        value = " . $item['diem_tp_2'] . "></td>"; //diem lan 2
                                echo "<td><input style=\"height: 40px; width:80px; text-align:center;\" type=\"text\" name=\"text-student-pointmain\"
                                        value = " . $item['diem_thi'] . "></td>"; //diem thi 
                                echo "<td style='text-align: center;'> <a href='function/mark/updateMark.php?id=" . $item['diem_id'] . "'><input class='btnSua' type='button' value='Nhập điểm' '></a></td>";
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