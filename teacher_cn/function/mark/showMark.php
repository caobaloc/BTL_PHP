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
            <form method="POST">
                <div class="search-sv">
                    <p>
                    <h3>Chọn lớp: </h3>
                    </p>
                    <?php
                    $sql = "SELECT lop.id, ten_lop FROM lop
                                INNER JOIN giaovien ON lop.id = giaovien.lop_id
                                WHERE giaovien.ten_gv = '$tkid'";
                    $query = mysqli_query($conn, $sql);
                    $i = 0;
                    if ($query) {
                        echo "<select name=\"lop-name\">";
                        echo "<option disabled selected hidden >Chọn lớp</option>";
                        foreach ($query as $item) {
                            $i++;
                            $lop_fullname = $item['ten_lop'];
                            $lop_id = $item['id'];
                            echo "<option value=\"$lop_id\">" . $lop_fullname . "</option>";
                        }
                        echo '</select>';
                    }
                    ?>
                    <span><a><input type='submit' value='Lọc' name="btn-loc-sv" class="btnThem"></a></span>
                </div>
            </form>
            <div class="main-table">

                <h2>DANH SÁCH SINH VIÊN THEO LỚP</h2>
                <div class="list-student">
                    <table class="module-table">
                        <tr>
                            <th>STT</th>
                            <th>Mã sinh viên</th>
                            <th>Họ và tên</th>
                            <th>Tên lớp</th>
                            <th>Điểm tự dánh giá</th>
                            <th>Điểm GVCN dánh giá</th>
                            <th>Điểm cộng</th>
                            <th>Chức năng</th>
                        </tr>
                        <?php
                        if (isset($_POST['btn-loc-sv'])) {
                            $lop_name = trim($_POST['lop-name']);

                            $sql1 = "SELECT lop.id as lop_id, lop.ten_lop, sinhvien.ma_sv, sinhvien.ten_sv, 
                                        diemrenluyen.id as drl_id, diemrenluyen.hoc_ky, diemrenluyen.diem_tu_danh_gia, diemrenluyen.diem_gv_danh_gia, diemrenluyen.diem_cong FROM sinhvien 
                                        INNER JOIN lop ON sinhvien.lop_id = lop.id
                                        INNER JOIN diemrenluyen ON diemrenluyen.sv_id = sinhvien.id
                                        INNER JOIN giaovien ON lop.id = giaovien.lop_id
                                        WHERE lop.id = $lop_name AND giaovien.ten_gv = '$tkid'";
                            $query1 = mysqli_query($conn, $sql1);

                            $i = 0;
                            foreach ($query1 as $item) {
                                $i++;
                                echo "<tr>";
                                echo "<td>$i</td>";
                                echo "<td>" . $item['ma_sv'] . "</td>";
                                echo "<td>" . $item['ten_sv'] . "</td>";
                                echo "<td>" . $item['ten_lop'] . "</td>";
                                echo "<td>" . $item['diem_tu_danh_gia'] . "</td>";
                                echo "<td><input style=\"height: 40px; width:80px; text-align:center;\" type=\"text\" value = " . $item['diem_gv_danh_gia'] . "></td>"; //diem gvcn danh gia
                                echo "<td><input style=\"height: 40px; width:80px; text-align:center;\" type=\"text\" value = " . $item['diem_cong'] . "></td>"; //diem cong
                                echo "<td style='text-align: center;'> <a href='updateMark.php?id=" . $item['drl_id'] . "'><input class='btnSua' type='button' value='Nhập điểm' '></a></td>";
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