<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

include('../connection.php');


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
    <link rel="icon" href="../assets/frontend/images/logo.png">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/frontend/css/style.css">
</head>

<body>
    <input type="checkbox" id="nav-toggle">
    <div class="sidebar">
        <div class="sidebar-brand">
            <a href="index.php" style="text-decoration: none; color: white;">
                <img src="../assets/frontend/images/logo.png" alt="" style="height: 40px">
            </a>
            <a href="../index.php" style="text-decoration: none; color: white;">
                <h2>HaUI Management</h2>
            </a>
        </div>

        <div class="sidebar-menu">
            <ul>

                <li>
                    <a href="../index.php" class="btn <?php if ($page == 'student')  echo 'active'; ?>">
                        <span class="las la-clipboard-list"></span>
                        <span>Thông tin sinh viên</span>
                    </a>
                </li>
                <li>
                    <a href="../kqht.php" class="btn <?php if ($page == 'kqht')  echo 'active'; ?>">
                        <span class="las la-marker"></span>
                        <span>Kết quả học tập</span>
                    </a>
                </li>
                <li>
                    <a href="../dkhp.php" class="btn <?php if ($page == 'dkhp')  echo 'active'; ?>">
                        <span class="las la-shopping-bag"></span>
                        <span>Đăng ký học phần</span>
                    </a>
                </li>
                <li>
                    <a href="../xcc.php" class="btn <?php if ($page == 'club')  echo 'active'; ?>">
                        <span class="las la-receipt"></span>
                        <span>Xem chứng chỉ</span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- <div class="group-name" style="color: white;">
        <p>© Nhóm 18 - 2022</p>
    </div> -->
    </div>
    <div class="main-content">
        <header>
            <div class="name-content" style="line-height: 55px; width: 30%;">
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars">
                        </span>
                    </label>
                    Thông tin
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
                    <h2>CẬP NHẬT SINH VIÊN</h2>
                    <table class="button-add">
                        <tr>
                            <td>
                                <label for="text-student-lasttname">Mã sinh viên: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-student-masv" value="<?php if ($student_id) echo $result['ma_sv']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-lasttname">Họ và tên: </label>
                            </td>
                            <td>
                                <input disabled="disabled" type="text" name="text-student-tensv" value="<?php if ($student_id) echo $result['ten_sv']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-lasttname">Ngày sinh: </label>
                            </td>
                            <td>
                                <input type="date" name="text-student-ngaysinh" value="<?php if ($student_id) echo $result['ngay_sinh']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-phone-of-students">Số điện thoại: </label>
                            </td>
                            <td>
                                <input type="text" name="text-student-sdt" value="<?php if ($student_id) echo $result['sdt']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-email">Email: </label>
                            </td>
                            <td>
                                <input type="text" name="text-student-email" value="<?php if ($student_id) echo $result['email']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-address">Địa chỉ: </label>
                            </td>
                            <td>
                                <input type="text" name="text-student-diachi" value="<?php if ($student_id) echo $result['dia_chi']; ?>">
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
                                <input type="text" name="text-student-quoctich" value="<?php if ($student_id) echo $result['quoc_tich']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Dân tộc: </label>
                            </td>
                            <td>
                                <input type="text" name="text-student-dantoc" value="<?php if ($student_id) echo $result['dan_toc']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Tôn giáo: </label>
                            </td>
                            <td>
                                <input type="text" name="text-student-tongiao" value="<?php if ($student_id) echo $result['ton_giao']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">CCCD/CMTND: </label>
                            </td>
                            <td>
                                <input type="text" name="text-student-cccd" value="<?php if ($student_id) echo $result['cccd']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Ngày cấp: </label>
                            </td>
                            <td>
                                <input type="date" name="text-student-ngaycap" value="<?php if ($student_id) echo $result['ngay_cap']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Nơi cấp: </label>
                            </td>
                            <td>
                                <input type="text" name="text-student-noicap" value="<?php if ($student_id) echo $result['noi_cap']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Ảnh mặt trước: </label>
                            </td>
                            <td>
                                <input type="file" name="anhtruoc" value="<?php if ($student_id) echo $result['anh_mat_truoc']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Ảnh mặt sau: </label>
                            </td>
                            <td>
                                <input type="file" name="anhsau" value="<?php if ($student_id) echo $result['anh_mat_sau']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="text-student-nationality">Ảnh chân dung: </label>
                            </td>
                            <td>
                                <input type="file" name="anhchandung" value="<?php if ($student_id) echo $result['anh_chan_dung']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center" colspan="2">
                                <input type="submit" value="Cập nhật" name="btn-edit-student" class="bt-add">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                if (isset($_POST['btn-edit-student'])) {

                    $ngaysinh = trim($_POST['text-student-ngaysinh']);
                    $diachi = trim($_POST['text-student-diachi']);
                    $quoctich = trim($_POST['text-student-quoctich']);
                    $dantoc = trim($_POST['text-student-dantoc']);
                    $tongiao = trim($_POST['text-student-tongiao']);
                    $cccd = trim($_POST['text-student-cccd']);
                    $ngaycap = trim($_POST['text-student-ngaycap']);
                    $noicap = trim($_POST['text-student-noicap']);
                    // $anhtruoc = trim($_POST['anhtruoc']);
                    // $anhsau = trim($_POST['anhsau']);
                    $anhsaufile = basename($_FILES['anhsau']['name']);
                    $anhsaufile_tmp = $_FILES['anhsau']['tmp_name'];
                    // $chandung = trim($_POST['anhchandung']);
                    $anhchandungfile = basename($_FILES['anhchandung']['name']);
                    $anhchandungfile_tmp = $_FILES['anhchandung']['tmp_name'];
                    $sdt = trim($_POST['text-student-sdt']);
                    $email = trim($_POST['text-student-email']);
                    $path = "../uploads/anhtruoc/";
                    $path1 = "../uploads/anhsau/";
                    $path2 = "../uploads/anhchandung/";
                    $anhtruocfile = basename($_FILES['anhtruoc']['name']);
                    $anhtruocfile_tmp = $_FILES['anhtruoc']['tmp_name'];
                    move_uploaded_file($anhtruocfile_tmp, $path . $anhtruocfile);
                    move_uploaded_file($anhsaufile_tmp, $path1 . $anhsaufile);
                    move_uploaded_file($anhchandungfile_tmp, $path2 . $anhchandungfile);

                    $sql = "UPDATE sinhvien SET 
                                ngay_sinh = '$ngaysinh',
                                dia_chi='$diachi',
                                quoc_tich = '$quoctich',
                                dan_toc = '$dantoc',
                                ton_giao = '$tongiao',
                                cccd = '$cccd',
                                ngay_cap = '$ngaycap',
                                noi_cap = '$noicap',
                                anh_mat_truoc = '$anhtruocfile',
                                anh_mat_sau = '$anhsaufile',
                                anh_chan_dung = '$anhchandungfile',
                                sdt = '$sdt',
                                email = '$email'
                                WHERE ma_sv = $student_id";
                    $query = mysqli_query($conn, $sql);
                    // header('Location: ../index.php');
                }
                ?>
            </div>
        </main>
    </div>
    <script src="../assets/js/btn.js"></script>

</body>

</html>
<?php ob_end_flush() ?>