<?php
ob_start()
?>
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
    <?php $page = "certificate";
    include('../../common/menu_function.php'); ?>
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
            header('Location: ../../../login.php');
        }
        ?>
        <main>
            <div class="main-table">
                <form method="POST">
                    <div class="search-sv">
                        <p>
                        <h3>Nhập mã sinh viên: </h3>
                        </p>
                        <input type="text" name="text-msv" class="text-msv"><span><a><input type='submit' value='Tìm kiếm' name="btn-tim-cer" class="btnThem"></a></span>
                    </div>
                </form>
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
                            <th>Chức năng</th>
                        </tr>
                        <?php
                        include('../../../connection.php');

                        if (isset($_POST['btn-tim-cer'])) {
                            $ma_sv = $_POST['text-msv'];

                            $sql = "SELECT chungchi.id, ma_sv, ten_sv, ten_cc, thoi_gian_nop, tinh_trang FROM chungchi 
                                INNER JOIN sinhvien ON chungchi.sv_id = sinhvien.id
                                WHERE ma_sv = $ma_sv";
                            $query = mysqli_query($conn, $sql);
                        }
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
                                echo "<td style='text-align: center;'> <a href='editCertificate.php?id=" . $item['id'] . "'><input class='btnSua' type='button' value='Sửa' '></a>   <a href='deleteCertificate.php?id=" . $item['id'] . "' onclick=\"return confirm('Bạn có chắc chắn muốn xoá chứng chỉ?');\"><input class='btnXoa' type='button' value='Xoá'></a><a href='controlCertificate.php?id=" . $item['id'] . "'><input class='btnChapNhan' type='button' value='Xử lý'></a></td>";
                            }
                        }
                        ?>
                    </table>
                    <div class="btn-them">
                        <a href='addCertificate.php'><input type='button' value='Thêm' class="btnThem"></a>
                    </div>
                </div>
            </div>
        </main>
    </div>


</body>

</html>