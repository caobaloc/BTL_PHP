<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

include('../../../connection.php');

if (isset($_GET['id'])) {
    $course_id  = $_GET['id'];
    $sql = "SELECT * FROM monhoc WHERE id = $course_id";
    $query = mysqli_query($conn, $sql);
    // var_dump($sql);
    // die();

    $result = array();

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
} else {
    $course_id = '';
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
    <?php $page = "course";
    include('../../common/menu_function.php'); ?>
    <div class="main-content">
        <header>
            <div class="name-content" style="line-height: 55px; width: 30%;">
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars">
                        </span>
                    </label>
                    Sửa môn học
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
                    <h2>SỬA MÔN HỌC</h2>
                    <table class="button-add">
                        <tr>
                            <td>
                                <label for="text-course-name">Tên môn: </label>
                            </td>
                            <td>
                                <input type="text" name="text-course-name" value="<?php echo $result['ten_mon_hoc'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-course-credit">Số tín chỉ: </label>
                            </td>
                            <td>
                                <input type="text" name="text-course-credit" value="<?php echo $result['so_tin'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-course-semester">Học kỳ: </label>
                            </td>
                            <td>
                                <input type="text" name="text-course-semester" value="<?php echo $result['hoc_ky'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-course-start-date">Ngày bắt đầu: </label>
                            </td>
                            <td>
                                <input type="date" name="text-course-start-date" value="<?php echo date('Y-m-d', strtotime($result["ngay_bat_dau"])) ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-course-end-date">Ngày kết thúc: </label>
                            </td>
                            <td>
                                <input type="date" name="text-course-end-date" value="<?php echo date('Y-m-d', strtotime($result["ngay_ket_thuc"])) ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-course-fault">Khoa: </label>
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM khoa";
                                $query = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($query) {
                                    echo "<select name=\"fault-name\">";
                                    foreach ($query as $item) {
                                        $i++;
                                        $khoa_fullname = $item['ten_khoa'];
                                        $khoa_id = $item['id'];
                                        echo "<option value=\"$khoa_id\">" . $khoa_fullname . "</option>";
                                    }
                                    echo '</select>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-course-teacher">Giáo viên giảng dạy: </label>
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM giaovien";
                                $query = mysqli_query($conn, $sql);
                                $i = 0;
                                if ($query) {
                                    echo "<select name=\"teacher-name\">";
                                    foreach ($query as $item) {
                                        $i++;
                                        $gv_fullname = $item['ten_gv'];
                                        $gv_id = $item['id'];
                                        echo "<option value=\"$gv_id\">" . $gv_fullname . "</option>";
                                    }
                                    echo '</select>';
                                }
                                ?>
                            </td>
                        </tr>

                        <tr class="bt-add">
                            <td colspan="2" style="text-align: center">
                                <input type="submit" value="Cập nhật" name="btn-update-course">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <?php

            if (isset($_POST['btn-update-course'])) {
                $course_name = trim($_POST['text-course-name']);
                $course_name = addslashes($course_name);
                $course_credit = trim($_POST['text-course-credit']);
                $course_credit = addslashes($course_credit);
                $course_semester = trim($_POST['text-course-semester']);
                $course_semester = addslashes($course_semester);
                $course_start_date = trim($_POST['text-course-start-date']);
                $course_start_date = addslashes($course_start_date);
                $course_end_date = trim($_POST['text-course-end-date']);
                $course_end_date = addslashes($course_end_date);
                $course_fault = trim($_POST['fault-name']);
                $course_fault = addslashes($course_fault);
                $course_teacher = trim($_POST['teacher-name']);
                $course_teacher = addslashes($course_teacher);

                if ($course_name == "" || $course_credit == "" || $course_semester == "" || $course_start_date == "" || $course_end_date == "" || $course_teacher == "" || $course_fault == "") {
                    echo "<p>Vui lòng nhập đầy đủ thông tin!</p>";
                } else if (is_nan($course_credit)) {
                    echo "<p> Vui lòng nhập lại số tín chỉ </p>";
                } else if($course_start_date > $course_end_date) {
                    echo "<p> Ngày kết thúc phải nhỏ hơn ngày bắt đầu </p>";
                }
                else {
                    $sql = "UPDATE `monhoc` SET 
                    `ten_mon_hoc`='$course_name',`so_tin`='$course_credit',`hoc_ky`='$course_semester',`ngay_bat_dau`='$course_start_date',
                    `ngay_ket_thuc`='$course_end_date',`gv_id`='$course_teacher',`khoa_id`='$course_fault' WHERE id = $course_id";
                    // var_dump($sql);
                    // die();
                    $query = mysqli_query($conn, $sql);
                    header('Location: ../../course.php');
                }
            }
            ?>
        </main>
    </div>
    <script src="../../assets/js/btn.js"></script>

</body>

</html>
<?php ob_end_flush() ?>