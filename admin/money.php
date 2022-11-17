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
    <?php $page = "money";
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
                            <th>Tên lớp</th>
                            <th>Tên khoa</th>
                            <th>Tiền nợ</th>
                            <th>Chức năng</th>
                        </tr>
                        <?php
                        include('../connection.php');
                        $sql = "SELECT diem.id, ma_sv, ten_sv, ten_lop, ten_khoa, cong_no FROM sinhvien INNER JOIN lop ON  sinhvien.lop_id = lop.id 
                        INNER JOIN khoa ON lop.khoa_id = khoa.id INNER JOIN diem ON diem.sv_id = sinhvien.id";
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
                                echo "<td>" . $item['ten_lop'] . "</td>";
                                echo "<td>" . $item['ten_khoa'] . "</td>";
                                echo "<td>" . $item['cong_no'] . "</td>";
                                echo "<td style='text-align: center;'> <a href='function/money/addMoney.php?id=" . $item['id'] . "'><input class='btnChapNhan' type='button' value='Xác nhận'></a></td>";
                                // echo "<td style='text-align: center;'> <a href='function/student/editStudent.php?id=" . $item['student_id'] . "'><input id='btnSua' type='button' value='Sửa' '></a> </td>";
                            }
                        } else {
                            echo "<p>Query errors!</p>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </main>
    </div>


</body>

</html>