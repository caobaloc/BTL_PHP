<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
$tkid = $_SESSION['username'];
include('../../../connection.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HaUI Management</title>
    <link rel="icon" href="../../assets/frontend/images/logo.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/frontend/css/style.css">
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <?php $page = "mark";
    include('../../common/menu_function.php'); ?>
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

            <div class="search-wrapper">
                <span class="las la-search"></span>
                <input type="search" placeholder="Tìm kiếm">
            </div>

            <div class="user-wrapper">
                <div>
                    <form action="" method="POST">
                        <p>Xin chào! <b><?php echo $_SESSION['username']; ?></b></p>
                        <button name="btn_logout">
                            <span class="las la-power-off">Log out</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>
        <?php
        if (isset($_POST['btn_logout'])) {
            unset($_SESSION['username']);
            header('Location: ../../../login.php');
        }
        ?>
        <main>

            <div class="main-table">
                <form method="POST">
                    <div class="search-sv">
                        <p>
                        <h3>Chọn học phần: </h3>
                        </p>
                        <?php
                        $sql = "SELECT monhoc.id, ten_mon_hoc FROM monhoc
                                INNER JOIN giaovien ON monhoc.gv_id = giaovien.id
                                WHERE giaovien.ten_gv = '$tkid'";
                        $query = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($query) {
                            echo "<select name=\"monhoc-name\">";
                            echo "<option disabled selected hidden >Chọn học phần</option>";
                            foreach ($query as $item) {
                                $i++;
                                $monhoc_fullname = $item['ten_mon_hoc'];
                                $monhoc_id = $item['id'];
                                echo "<option value=\"$monhoc_id\">" . $monhoc_fullname . "</option>";
                            }
                            echo '</select>';
                        }
                        ?>
                        <span><a><input type='submit' value='Lọc' name="btn-loc-mh" class="btnThem"></a></span>
                    </div>
                </form>
                <h2>DANH SÁCH SINH VIÊN THEO HỌC PHẦN</h2>
                <div class="list-student">
                    <table class="module-table">
                        <tr>
                            <th>STT</th>
                            <th>Mã sinh viên</th>
                            <th>Họ và tên</th>
                            <th>Tên môn</th>
                            <th>Điểm tp 1</th>
                            <th>Điểm tp 2</th>
                            <th>Điểm thi</th>
                            <th>Chức năng</th>
                        </tr>
                        <?php
                        if (isset($_POST['btn-loc-mh'])) {
                            $monhoc_name = trim($_POST['monhoc-name']);

                            $sql1 = "SELECT diem.id as diem_id, sinhvien.id as sv_id, monhoc.id as mh_id, monhoc.ten_mon_hoc, sinhvien.ma_sv, sinhvien.ten_sv, diem_tp_1, diem_tp_2, diem_thi FROM sinhvien 
                        INNER JOIN diem ON  diem.sv_id = sinhvien.id 
                        INNER JOIN monhoc ON monhoc.id = diem.mon_id
                        INNER JOIN giaovien ON monhoc.gv_id = giaovien.id
                        WHERE monhoc.id = $monhoc_name";
                            // var_dump($sql1);
                            // die();
                            $query1 = mysqli_query($conn, $sql1);
                            $i = 0;
                            foreach ($query1 as $item) {
                                $i++;
                                echo "<tr>";
                                echo "<td>$i</td>";
                                echo "<td>" . $item['ma_sv'] . "</td>";
                                echo "<td>" . $item['ten_sv'] . "</td>";
                                echo "<td>" . $item['ten_mon_hoc'] . "</td>";
                                echo "<td><input style=\"height: 40px; width:80px; text-align:center;\" type=\"text\" name=\"text-student-point1\" 
                                        value = " . $item['diem_tp_1'] . " ></td>"; //diem lan 1
                                echo "<td><input style=\"height: 40px; width:80px; text-align:center;\" type=\"text\" name=\"text-student-point2\"
                                        value = " . $item['diem_tp_2'] . "></td>"; //diem lan 2
                                echo "<td><input style=\"height: 40px; width:80px; text-align:center;\" type=\"text\" name=\"text-student-pointmain\"
                                        value = " . $item['diem_thi'] . "></td>"; //diem thi 
                                echo "<td style='text-align: center;'> <a href='updateMark.php?id=" . $item['diem_id'] . "'><input class='btnSua' type='button' value='Nhập điểm' '></a></td>";
                            }
                        }

                        ?>
                    </table>

                </div>
            </div>
        </main>
    </div>
    <script src="../../assets/js/btn.js"></script>

</body>

</html>
<?php ob_end_flush() ?>