<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('common/head.php'); ?>

<body>
    <input type="checkbox" id="nav-toggle">
    <?php $page = "student";
    include('common/menu.php'); ?>
    <div class="main-content">
        <header>
            <div class="name-content" style="line-height: 55px; width: 30%;">
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars">
                        </span>
                    </label>
                    Sinh viên
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
                <h2>DANH SÁCH SINH VIÊN</h2>
                <div class="list-student">
                    <table class="module-table">
                        <tr>
                            <th>STT</th>
                            <th>Mã sinh viên</th>
                            <th>Họ và tên</th>
                            <th>SĐT</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Tên lớp</th>
                            <th>Tên khoa</th>
                            <th>Chức năng</th>
                        </tr>
                        <?php
                        include('../connection.php');
                        $sql = "SELECT * FROM sinhvien INNER JOIN lop ON  sinhvien.lop_id = lop.id INNER JOIN khoa ON lop.khoa_id = khoa.id";
                        // var_dump($sql);
                        // die();
                        $query = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($query) {
                            foreach ($query as $item) {
                                $i++;
                                echo "<tr>";
                                echo "<td>$i</td>";
                                echo "<td>" . $item['ma_sv'] . "</td>";
                                echo "<td>" . $item['ten_sv'] . "</td>";
                                echo "<td>" . $item['sdt'] . "</td>";
                                echo "<td>" . $item['email'] . "</td>";
                                echo "<td>" . $item['dia_chi'] . "</td>";
                                echo "<td>" . $item['ten_lop'] . "</td>";
                                echo "<td>" . $item['ten_khoa'] . "</td>";
                                echo "<td style='text-align: center;'> <a href='function/student/editStudent.php?id=" . $item['id'] . "'><input class='btnSua' type='button' value='Sửa' '></a>   <a href='function/student/deleteStudent.php?id=" . $item['id'] . "'><input class='btnXoa' type='button' value='Xoá'></a></td>";
                                // echo "<td style='text-align: center;'> <a href='function/student/editStudent.php?id=" . $item['student_id'] . "'><input id='btnSua' type='button' value='Sửa' '></a> </td>";
                            }
                        } else {
                            echo "<p>Query errors!</p>";
                        }
                        ?>
                    </table>
                    <div class="btn-them">
                        <a href='function/student/addStudent.php'><input type='button' value='Thêm' class="btnThem"></a>
                    </div>
                </div>
            </div>
        </main>
    </div>


</body>

</html>