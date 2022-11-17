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
    <?php $page = "certificate";
    include('common/menu.php'); ?>

    <div class="main-content">
        <header>
            <div class="name-content" style="line-height: 55px; width: 30%;">
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars">
                        </span>
                    </label>
                    Chứng chỉ
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
                <h2>DANH SÁCH CHỨNG CHỈ</h2>
                <div class="list-course">
                    <table class="module-table">
                        <tr>
                            <th>STT</th>
                            <th>Mã SV</th>
                            <th>Họ tên</th>
                            <th>Tên chứng chỉ</th>
                            <th>Thời gian nộp</th>
                            <th>Tình trạng</th>
                        </tr>
                        <?php
                        include('../connection.php');
                        $sql = "SELECT chungchi.id, ma_sv, ten_sv, ten_cc, thoi_gian_nop, tinh_trang FROM chungchi INNER JOIN sinhvien ON chungchi.sv_id = sinhvien.id";
                        $query = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($query) {
                            foreach ($query as $item) {
                                $i++;
                                echo "<tr>";
                                echo "<td>$i</td>";
                                echo "<td>" . $item['ma_sv'] . "</td>";
                                echo "<td>" . $item['ten_sv'] . "</td>";
                                echo "<td>" . $item['ten_cc'] . "</td>";
                                echo "<td>" . $item['thoi_gian_nop'] . "</td>";
                                echo "<td>" . $item['tinh_trang'] . "</td>";
                            }
                        } else {
                            echo "<p>Query errors!</p>";
                        }
                        ?>
                    </table>
                    <div class="btn-them">
                        <a href='function/certificate/searchCertificate.php'><input type='button' value='Tìm kiếm' class="btnThem"></a>
                    </div>
                </div>
            </div>
        </main>
    </div>


</body>

</html>