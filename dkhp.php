<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
include('connection.php');

$tien_no = 0;
$student_id  = $_SESSION['username'];
$sql = "SELECT * FROM sinhvien WHERE ma_sv = $student_id";
$query = mysqli_query($conn, $sql);

$result = array();

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $result = $row;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HaUI Management</title>
    <link rel="icon" href="assets/frontend/images/logo.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/frontend/css/style.css">
</head>

<body>
    <input type="checkbox" id="nav-toggle">

    <?php $page = "dkhp"; include('common/menu.php'); ?>
    <div class="main-content">
        <header>
            <div class="name-content" style="line-height: 55px; width: 30%;">
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars">
                        </span>
                    </label>
                    Trang chủ
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
            header('Location: login.php');
        }
        ?>
        <main>
            <div>
                <form method="POST">
                    <h2>ĐĂNG KÝ HỌC PHẦN</h2>
                    <table class="button-add">
                        <tr>
                            <td colspan="3">
                                <label for="text-student-lasttname">Môn học: </label>
                            </td>
                            <td colspan="3">
                                <?php
                                $sql1 = "SELECT khoa.id FROM sinhvien INNER JOIN lop ON lop.id = sinhvien.lop_id INNER JOIN khoa ON khoa.id = lop.khoa_id WHERE sinhvien.ma_sv = $student_id";
                                $query1 = mysqli_query($conn, $sql1);

                                $result = array();

                                if (mysqli_num_rows($query1) > 0) {
                                    while($row = mysqli_fetch_assoc($query1)) {
                                        $result = $row;
                                    }
                                }

                                $sql = "SELECT * FROM monhoc";
                                $query = mysqli_query($conn, $sql);
                                if ($query) {
                                    echo "<select name=\"monhoc\">";
                                    foreach ($query as $item) {
                                        $i++;
                                        $mamon = $item['id'];
                                        $tenmon = $item['ten_mon_hoc'];
                                        $khoa_id = $item['khoa_id'];
                                        if ($result['id'] == $khoa_id) {
                                            echo "<option value=\"$mamon\">" . $tenmon . "</option>";
                                        }
                                    }
                                    echo '</select>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>STT</th>
                            <th>Tên môn</th>
                            <th>Số tín</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Chức năng</th>
                        </tr>
                        <?php

                        $sql = "SELECT monhoc.id as idmh,ten_mon_hoc,so_tin,ngay_bat_dau,ngay_ket_thuc,diem.nop_tien as nop_tien,diem.id as idd FROM monhoc INNER JOIN diem ON diem.mon_id = monhoc.id INNER JOIN sinhvien ON sinhvien.id = diem.sv_id
                                    WHERE sinhvien.ma_sv = $student_id";
                        // var_dump($sql);
                        // die();
                        $query = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($query) {
                            foreach ($query as $item) {
                                $i++;
                                echo "<tr>";
                                echo "<td>" . $i . "</td>";
                                echo "<td>" . $item['ten_mon_hoc'] . "</td>";
                                echo "<td>" . $item['so_tin'] . "</td>";
                                echo "<td>" . $item['ngay_bat_dau'] . "</td>";
                                echo "<td>" . $item['ngay_ket_thuc'] . "</td>";
                                echo  "<td> <a href='function/deleteMonHoc.php?id=" . $item['idd'] . "'><input class='btnXoa' type='button' value='Huỷ'></a></td>";
                                if ($item['nop_tien'] == 0) {
                                    $tien_no += $item['so_tin'] * 350000;
                                }
                            }
                        }
                        $sql1 = "UPDATE sinhvien SET cong_no = $tien_no WHERE sinhvien.ma_sv = $student_id";
                        $query = mysqli_query($conn, $sql1);
                        ?>
                        <tr>
                            <td colspan="5">
                                Số tiền nợ:
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM sinhvien WHERE sinhvien.ma_sv = $student_id";
                                $query = mysqli_query($conn, $sql);
                                if ($query) {
                                    foreach ($query as $item) {
                                        echo $item['cong_no'];
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center" colspan="6">
                                <input type="submit" value="Đăng ký" name="btn-dangky" class="bt-add">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                if (isset($_POST['btn-dangky'])) {
                    $monhoc = $_POST['monhoc'];
                    $sv_id = null;
                    $sql = "SELECT id from sinhvien WHERE ma_sv = $student_id";
                    $query = mysqli_query($conn, $sql);
                    foreach ($query as $item) {
                        $sv_id = $item['id'];
                    }
                    $i = 2;
                    $sql1 = "SELECT  *FROM diem WHERE sv_id = $sv_id";
                    $query1 = mysqli_query($conn, $sql1);
                    foreach ($query1 as $item1) {
                        $i++;
                    }
                    $sql2 = "INSERT INTO diem(id,mon_id,sv_id,nop_tien)
                        values ($i,$monhoc,$sv_id,0)";
                    $query3 = mysqli_query($conn, $sql2);
                    header('Location: dkhp.php');
                }
                ?>
            </div>
        </main>
    </div>
    <script src="assets/js/btn.js"></script>

</body>

</html>
<?php ob_end_flush() ?>