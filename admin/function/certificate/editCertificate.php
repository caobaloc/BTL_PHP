<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

include('../../../connection.php');

if (isset($_GET['id'])) {
    $cer_id  = $_GET['id'];
    $sql = "SELECT * FROM chungchi INNER JOIN sinhvien ON chungchi.sv_id = sinhvien.id WHERE chungchi.id = $cer_id";
    $query = mysqli_query($conn, $sql);
    // var_dump($sql);
    // die();

    $result = array();

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
    // var_dump($query);
    // die();
} else {
    $cer_id = '';
}
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
                    Sửa chứng chỉ
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
                    <h2>SỬA CHỨNG CHỈ</h2>
                    <table class="button-add">
                        <tr>
                            <td>
                                <label for="text-cer-name">Mã sinh viên: </label>
                            </td>
                            <td>
                                <input disabled="disable" type="text" name="text-cer-msv" value="<?php echo $result['ma_sv'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-cer-name">Tên chứng chỉ: </label>
                            </td>
                            <td>
                                <input type="text" name="text-cer-name" value="<?php echo $result['ten_cc'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-cer-time">Thời gian nộp: </label>
                            </td>
                            <td>
                                <input type="date" name="text-cer-time" value="<?php echo $result['thoi_gian_nop'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-cer-note">Tình trạng: </label>
                            </td>
                            <td>
                                <input disabled="disable" type="text" name="text-cer-note" value="<?php echo $result['tinh_trang'] ?>">
                            </td>
                        </tr>
                        <tr class="bt-add">
                            <td colspan="2" style="text-align: center">
                                <input type="submit" value="Cập nhật" name="btn-edit-cer">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <?php

            if (isset($_POST['btn-edit-cer'])) {
                $cer_msv = trim($_POST['text-cer-msv']);
                $cer_msv = addslashes($cer_msv);
                $cer_name = trim($_POST['text-cer-name']);
                $cer_name = addslashes($cer_name);
                $cer_time = trim($_POST['text-cer-time']);
                $cer_time = addslashes($cer_time);

                if ($cer_name == "" || $cer_time == "") {
                    echo "<p>Vui lòng nhập đầy đủ thông tin!</p>";
                } else {
                    $sql = "UPDATE `chungchi` SET `ten_cc`='$cer_name',`thoi_gian_nop`='$cer_time' WHERE id = $cer_id";
                    // var_dump($sql);
                    // die();
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