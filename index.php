<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

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
    <?php $page = "student"; include('common/menu.php'); ?>
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
                <form method="POST" enctype="multipart/form-data">
                    <h2>THÔNG TIN SINH VIÊN</h2>
                    <table class="button-add">
                        <tr>
                            <td>
                                <label for="text-student-lasttname">Mã sinh viên: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-student-lastname" value="<?php if ($student_id) echo $result['ma_sv']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-lasttname">Họ và tên: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-student-lastname" value="<?php if ($student_id) echo $result['ten_sv']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-lasttname">Ngày sinh: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="date" name="text-student-lastname" value="<?php if ($student_id) echo $result['ngay_sinh']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-phone-of-students">Số điện thoại: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-phone-of-students" value="<?php if ($student_id) echo $result['sdt']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-email">Email: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-student-email" value="<?php if ($student_id) echo $result['email']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-address">Địa chỉ: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-student-address" value="<?php if ($student_id) echo $result['dia_chi']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-address">Lớp: </label>
                            </td>
                            <td>
                                <?php

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
                            <td>
                                <label for="text-student-nationality">Quốc tịch: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-student-password" value="<?php if ($student_id) echo $result['quoc_tich']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Dân tộc: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-student-password" value="<?php if ($student_id) echo $result['dan_toc']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Tôn giáo: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-student-password" value="<?php if ($student_id) echo $result['ton_giao']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">CCCD/CMTND: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-student-password" value="<?php if ($student_id) echo $result['cccd']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Ngày cấp: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="date" name="text-student-password" value="<?php if ($student_id) echo $result['ngay_cap']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Nơi cấp: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-student-password" value="<?php if ($student_id) echo $result['noi_cap']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Ảnh mặt trước: </label>
                            </td>
                            <td>
                                <img src="admin/uploads/anhtruoc/<?php if ($student_id) echo $result['anh_mat_truoc']; ?>" alt="" style="width: 150px; height:150px; ">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Ảnh mặt sau: </label>
                            </td>
                            <td>
                                <img src="admin/uploads/anhsau/<?php if ($student_id) echo $result['anh_mat_sau']; ?>" alt="" style="width: 150px; height:150px; ">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Ảnh chân dung: </label>
                            </td>
                            <td>
                                <img src="admin/uploads/anhchandung/<?php if ($student_id) echo $result['anh_chan_dung']; ?>" alt="" style="width: 150px; height:150px; ">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center" colspan="2">
                                <a href="function/editStudent.php"><input type="button" value="Sửa" name="btn-edit-student" class="bt-add"></a>
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