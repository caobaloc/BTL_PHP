<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

include('../../../connection.php');

if (isset($_GET['id'])) {
    $mark_id  = $_GET['id'];
    $sql = "SELECT * FROM diemrenluyen WHERE id = $mark_id";
    $query = mysqli_query($conn, $sql);

    $result = array();

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
} else {
    $mark_id = '';
}
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
            <div>
                <form method="POST">
                    <h2>NHẬP ĐIỂM RÈN LUYỆN</h2>
                    <table class="button-add">
                        <tr>
                            <td>
                                <label for="text-mark-1">Điểm GVCN đánh giá: </label>
                            </td>
                            <td>
                                <input type="text" name="text-mark-1" value="<?php if ($mark_id) echo $result['diem_gv_danh_gia']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-mark-2">Điểm cộng học tập: </label>
                            </td>
                            <td>
                                <input type="text" name="text-mark-2" value="<?php if ($mark_id) echo $result['diem_cong']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center" colspan="2">
                                <input type="submit" value="Cập nhật" name="btn-update-mark" class="bt-add">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <?php
            if (isset($_POST['btn-update-mark'])) {

                $drl_gv = trim($_POST['text-mark-1']);
                $drl_gv = addslashes($drl_gv);
                $drl_pluss = trim($_POST['text-mark-2']);
                $drl_pluss = addslashes($drl_pluss);

                $result = array();
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $result = $row;
                    }
                }

                if (($drl_gv < 0 || $drl_gv > 100) || ($drl_pluss < 0 || $drl_pluss > 100)) {
                    echo "<p>Điểm phải trong khảng 0-100</p>";
                } else {
                    $sql2 = "UPDATE `diemrenluyen` SET `diem_gv_danh_gia`='$drl_gv',`diem_cong`='$drl_pluss' WHERE id = $mark_id";
                    $query2 = mysqli_query($conn, $sql2);

                    header('Location: ../../listStudent.php');
                }
            }
            ?>
        </main>
    </div>
    <script src="../../assets/js/btn.js"></script>

</body>

</html>
<?php ob_end_flush() ?>