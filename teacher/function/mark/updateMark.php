<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

include('../../../connection.php');

if (isset($_GET['id'])) {
    $mark_id  = $_GET['id'];
    $sql = "SELECT * FROM diem WHERE id = $mark_id";
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
            header('Location: login.php');
        }
        ?>
        <main>
            <div>
                <form method="POST">
                    <h2>NHẬP ĐIỂM</h2>
                    <table class="button-add">
                        <tr>
                            <td>
                                <label for="text-mark-1">Điểm thành phần 1: </label>
                            </td>
                            <td>
                                <input type="text" name="text-mark-1" value="<?php if ($mark_id) echo $result['diem_tp_1']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-mark-2">Điểm thành phần 2: </label>
                            </td>
                            <td>
                                <input type="text" name="text-mark-2" value="<?php if ($mark_id) echo $result['diem_tp_2']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-exam">Điểm thi: </label>
                            </td>
                            <td>
                                <input type="text" name="text-exam" value="<?php if ($mark_id) echo $result['diem_thi']; ?>">
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

                $student_point1 = trim($_POST['text-mark-1']);
                $student_point1 = addslashes($student_point1);
                $student_point2 = trim($_POST['text-mark-2']);
                $student_point2 = addslashes($student_point2);
                $student_pointmain = trim($_POST['text-exam']);
                $student_pointmain = addslashes($student_pointmain);

                $result = array();
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        $result = $row;
                    }
                }

                if (($student_point1 < 0 || $student_point1 > 10) || ($student_point2 < 0 || $student_point2 > 10) || ($student_pointmain < 0 || $student_pointmain > 10)) {
                    echo "<p>Điểm phải trong khảng 0-10</p>";
                } else {
                    $sql2 = "UPDATE `diem` SET `diem_tp_1`='$student_point1',`diem_tp_2`='$student_point2',`diem_thi`='$student_pointmain' WHERE id = $mark_id";
                    $query2 = mysqli_query($conn, $sql2);

                    header('Location: ../../subjects.php');
                }
            }
            ?>
        </main>
    </div>
    <script src="../../assets/js/btn.js"></script>

</body>

</html>
<?php ob_end_flush() ?>