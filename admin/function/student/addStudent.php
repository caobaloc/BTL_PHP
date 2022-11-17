<?php

ob_start() ?>
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
    <link rel="icon" href="../../assets/frontend/images/logo.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../assets/frontend/css/style.css">
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <?php $page = "student";
    include('../../common/menu_function.php'); ?>
    <div class="main-content">
        <header>
            <div class="name-content" style="line-height: 55px; width: 45%;">
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars">
                        </span>
                    </label>
                    Thêm sinh viên
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
                    <h2>THÊM SINH VIÊN</h2>
                    <table class="button-add">
                        <tr>
                            <td>
                                <label for="text-student-id">Mã sinh viên: </label>
                            </td>
                            <td>
                                <input type="text" name="text-student-id" value="<?php
                                                                                    $sql = "SELECT ma_sv FROM sinhvien";
                                                                                    $query = mysqli_query($conn, $sql);

                                                                                    $result = array();
                                                                                    if (mysqli_num_rows($query) > 0) {
                                                                                        while ($row = mysqli_fetch_assoc($query)) {
                                                                                            $result = $row;
                                                                                        }
                                                                                    }

                                                                                    $msv = array_pop($result) + 1;

                                                                                    $msv_sub = date("Y") . substr($msv . "", 4, 6);

                                                                                    echo ($msv_sub)
                                                                                    ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-name">Họ tên: </label>
                            </td>
                            <td>
                                <input type="text" name="text-student-name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-class">Lớp: </label>
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM lop";
                                $query = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($query) {
                                    echo "<select name=\"class-name\">";
                                    foreach ($query as $item) {
                                        $i++;
                                        $lop_fullname = $item['ten_lop'];
                                        $lop_id = $item['id'];
                                        echo "<option value=\"$lop_id\">" . $lop_fullname . "</option>";
                                    }
                                    echo '</select>';
                                }
                                ?>
                                <!-- <input type="text" name="text-name-classroom-teacher"> -->
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-birthday-of-students">Ngày sinh: </label>
                            </td>
                            <td>
                                <input type="date" name="text-birthday-of-students">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-phone-of-students">Số điện thoại: </label>
                            </td>
                            <td>
                                <input type="text" name="text-phone-of-students">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-email">Email: </label>
                            </td>
                            <td>
                                <input type="text" name="text-student-email">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-address">Địa chỉ: </label>
                            </td>
                            <td>
                                <input type="text" name="text-student-address">
                            </td>
                        </tr>
                        <tr class="bt-add">
                            <td colspan="2" style="text-align: center; background: none;">
                                <input type="submit" value="Thêm mới" name="btn-add-student">
                            </td>
                        </tr>
                    </table>

                </form>
            </div>
            <?php
            if (isset($_POST['btn-add-student'])) {
                $student_id = trim($_POST['text-student-id']);
                $student_id = addslashes($student_id);
                $student_name = trim($_POST['text-student-name']);
                $student_name = addslashes($student_name);
                $student_class = trim($_POST['class-name']);
                $student_class = addslashes($student_class);
                $student_birthday = trim($_POST['text-birthday-of-students']);
                $student_birthday = addslashes($student_birthday);
                $student_phone = trim($_POST['text-phone-of-students']);
                $student_phone = addslashes($student_phone);
                $student_email = trim($_POST['text-student-email']);
                $student_email = addslashes($student_email);
                $student_address = trim($_POST['text-student-address']);
                $student_address = addslashes($student_address);



                if ($student_id == "" || $student_name == "" || $student_class == "" || $student_phone == "" || $student_email == "" || $student_address == "") {
                    echo "<p>Vui lòng nhập đầy đủ thông tin!</p>";
                } else if (!filter_var($student_email, FILTER_VALIDATE_EMAIL)) {
                    echo "<p> Vui lòng nhập đúng email </p>";
                } else {
                    $result = array();
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $result = $row;
                        }
                    }

                    $tk_id = array_pop($result) + 1;

                    $sql1 = "INSERT INTO `taikhoan` (`tai_khoan`, `mat_khau`, `role`) VALUES ('$student_id','123456','2')";
                    $query1 = mysqli_query($conn, $sql1);

                    $sql = "SELECT id FROM taikhoan";
                    $query = mysqli_query($conn, $sql);

                    $sql2 = "INSERT INTO `sinhvien` (`ma_sv`, `ten_sv`, `ngay_sinh`, `dia_chi`, `sdt`, `email`, `cong_no`,`tk_id`, `lop_id`)
                    VALUES ($student_id, '$student_name' , '$student_birthday', '$student_address', '$student_phone', '$student_email', 0, $tk_id, $student_class)";
                    $query2 = mysqli_query($conn, $sql2);
                    header('Location: ../../student.php');
                }
            }
            ?>
        </main>
    </div>
    <script src="../../assets/js/btn.js"></script>

</body>

</html>
<?php ob_end_flush() ?>