<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('common/head.php') ?>

<body>
    <input type="checkbox" id="nav-toggle">
    <?php $page = "course"; include('common/menu.php'); ?>

    <div class="main-content">
        <header>
            <div class="name-content" style="line-height: 55px; width: 30%;">
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars">
                        </span>
                    </label>
                    Khoá học
                </h1>
            </div>
            <?php include('common/search.php'); ?>
            <?php include('common/logout.php'); ?>
        </header>
        <?php
        if (isset($_POST['btn_logout'])) {
            unset($_SESSION['username']);
            header('Location: ../login.php');
        }
        ?>
        <main>
            <div class="main-table">
                <h2>DANH SÁCH MÔN HỌC</h2>
                <div class="list-course">
                    <table class="module-table">
                        <tr>
                            <th>STT</th>
                            <th>Tên môn</th>
                            <th>Số tín chỉ</th>
                            <th>Học kỳ</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Giáo viên giảng dạy</th>
                            <th>Chức năng</th>
                        </tr>
                        <?php
                        include('../connection.php');
                        $sql = "SELECT monhoc.id, ten_mon_hoc, so_tin, hoc_ky, ngay_bat_dau, ngay_ket_thuc, giaovien.ten_gv FROM monhoc INNER JOIN giaovien ON monhoc.gv_id = giaovien.id";
                        $query = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($query) {
                            foreach ($query as $item) {
                                $i++;
                                echo "<tr>";
                                echo "<td>$i</td>";
                                echo "<td>" . $item['ten_mon_hoc'] . "</td>";
                                echo "<td>" . $item['so_tin'] . "</td>";
                                echo "<td>" . $item['hoc_ky'] . "</td>";
                                echo "<td>" . $item['ngay_bat_dau'] . "</td>";
                                echo "<td>" . $item['ngay_ket_thuc'] . "</td>";
                                echo "<td>" . $item['ten_gv'] . "</td>";
                                echo "<td style='text-align: center;'> <a href='function/course/editCourse.php?id=" . $item['id'] . "'><input class='btnSua' type='button' value='Sửa' '></a>   <a href='function/course/deleteCourse.php?id=" . $item['id'] . "'><input class='btnXoa' type='button' value='Xoá'></a></td>";
                            }
                        } else {
                            echo "<p>Query errors!</p>";
                        }                   
                        ?>
                    </table>
                    <div class="btn-them">
                        <a href='function/course/addCourse.php'><input type='button' value='Thêm' class="btnThem"></a>
                    </div>
                </div>
            </div>
        </main>
    </div>


</body>

</html>