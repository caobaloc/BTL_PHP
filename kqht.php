<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
$tong_tin = 0;
$diem_tb = 0;
include('connection.php');


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

    <?php $page = "kqht"; include('common/menu.php'); ?>
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
                    <h2>KẾT QUẢ HỌC TẬP</h2>
                    <table class="button-add">
                        <tr>
                            <td colspan="3">
                                <label for="text-student-lasttname">Mã sinh viên: </label>
                            </td>
                            <td colspan="3">
                                <input disabled="disabled" type="text" name="text-student-lastname" value="<?php if ($student_id) echo $result['ma_sv']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <label for="text-student-lasttname">Họ và tên: </label>
                            </td>
                            <td colspan="3">
                                <input disabled="disabled" type="text" name="text-student-lastname" value="<?php if ($student_id) echo $result['ten_sv']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <label for="text-student-address">Lớp: </label>
                            </td>
                            <td colspan="3">
                                <?php
                                include('connection.php');
                                $sql = "SELECT * FROM lop";
                                $query = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($query) {
                                    echo "<select name='student_lop' disabled='disabled'>";
                                    foreach ($query as $item) {
                                        $i++;
                                        $classroom_fullname = $item['ten_lop'];
                                        $classroom_id = $item['id'];
                                        echo "<option value='$classroom_id'>" . $classroom_fullname . "</option>";
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
                            <th>Điểm số 1</th>
                            <th>Điểm số 2</th>
                            <th>Điểm thi</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM sinhvien INNER JOIN diem ON  sinhvien.id = diem.sv_id INNER JOIN monhoc ON monhoc.id = diem.mon_id WHERE sinhvien.ma_sv = $student_id";
                        // var_dump($sql);
                        // die();
                        $query = mysqli_query($conn, $sql);
                        $i = 0;
                        $tong_diem = 0;
                        $tb_mon = 0;
                        if ($query) {
                            foreach ($query as $item) {
                                $i++;
                                echo "<tr>";
                                echo "<td>$i</td>";
                                echo "<td>" . $item['ten_mon_hoc'] . "</td>";
                                echo "<td>" . $item['so_tin'] . "</td>";
                                echo "<td>" . $item['diem_tp_1'] . "</td>";
                                echo "<td>" . $item['diem_tp_2'] . "</td>";
                                echo "<td>" . $item['diem_thi'] . "</td>";
                                if ($item['diem_thi'] != null) {
                                    $tb_mon = ((($item['diem_tp_1'] + $item['diem_tp_2'] * 2) / 3 + $item['diem_thi'] * 2) / 3) * $item['so_tin'];
                                    $tong_tin += $item['so_tin'];
                                    $tong_diem += $tb_mon;
                                }
                            }
                        }
                        if($tong_tin!=0){
                            $diem_tb = ($tong_diem / $tong_tin)*0.4;
                        }
                        
                        ?>
                        <tr>
                            <td colspan="5">Tổng số tín chỉ: </td>
                            <td>
                                <?php
                                echo "<p>" . $tong_tin . "</p>"
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">Điểm tích luỹ</td>
                            <td>
                                <?php
                                echo "<p>" . $diem_tb . "</p>";
                                ?>
                            </td>
                        </tr>
                    </table>

                </form>
            </div>
        </main>
    </div>
    <script src="assets/js/btn.js"></script>

</body>

</html>
<?php ob_end_flush() ?>