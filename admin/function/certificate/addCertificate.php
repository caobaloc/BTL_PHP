<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../../login.php');
}
include('../../../connection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HaUI Management</title>
    <link rel="icon" href="../../../../assets/frontend/images/logo.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/frontend/css/style.css">
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <?php $page = "certificate";
    include('../../common/menu_function.php'); ?>
    <div class="main-content">
        <header>
            <div class="name-content" style="line-height: 55px; width: 30%;">
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars">
                        </span>
                    </label>
                    Thêm chứng chỉ
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
            <div>
                <form method="POST">
                    <H2>THÊM CHỨNG CHỈ</H2>
                    <table class="button-add">
                        <tr>
                            <td>
                                <label for="text-cer-name">Mã sinh viên: </label>
                            </td>
                            <td>
                                <input type="text" name="text-cer-msv">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-cer-name">Tên chứng chỉ: </label>
                            </td>
                            <td>
                                <input type="text" name="text-cer-name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-cer-credit">Thời gian nộp: </label>
                            </td>
                            <td>
                                <input type="date" name="text-cer-time">
                            </td>
                        </tr>
                        <tr class="bt-add">
                            <td colspan="2" style="text-align: center">
                                <input type="submit" value="Thêm mới" name="btn-add-cer">
                            </td>
                        </tr>
                    </table>

                </form>
            </div>
            <?php

            if (isset($_POST['btn-add-cer'])) {
                $cer_msv = trim($_POST['text-cer-msv']);
                $cer_msv = addslashes($cer_msv);
                $cer_name = trim($_POST['text-cer-name']);
                $cer_name = addslashes($cer_name);
                $cer_time = trim($_POST['text-cer-time']);
                $cer_time = addslashes($cer_time);
                $cer_note = trim("Đang xử lý");
                $cer_note = addslashes($cer_note);

                $sql1 = "SELECT id from sinhvien WHERE ma_sv = $cer_msv";
                $query1 = mysqli_query($conn, $sql1);

                $result = array();
                if (mysqli_num_rows($query1) > 0) {
                    while ($row = mysqli_fetch_assoc($query1)) {
                        $result = $row;
                    }
                }

                $sv_id = $result['id'];

                // var_dump($cer_fault . " " . $cer_teacher);
                // die();

                if ($cer_name == "" || $cer_time == "" || $cer_note == "" || $cer_msv == "") {
                    echo "<p>Vui lòng nhập đầy đủ thông tin!</p>";
                } else if (mysqli_num_rows($query1) == 0) {
                    echo "<p>Không có sinh viên!</p>";
                } else {
                    $sql = "INSERT INTO `chungchi`(`ten_cc`, `thoi_gian_nop`, `tinh_trang`, `sv_id`)
                    VALUES ('$cer_name','$cer_time','$cer_note', $sv_id)";
                    $query = mysqli_query($conn, $sql);
                    header('Location: ../../certificate.php');
                }
            }
            ?>
        </main>
    </div>
    <script src="../../assets/js/btn.js"></script>

</body>

</html>
<?php ob_end_flush() ?>