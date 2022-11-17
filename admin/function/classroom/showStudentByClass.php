<?php
ob_start()
?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../../login.php');
}
include('../../../connection.php');
if (isset($_GET['id'])) {
    $lop_id = $_GET['id'];
    $sql = "SELECT * from sinhvien INNER JOIN lop ON sinhvien.lop_id = lop.id WHERE lop.id = $lop_id";
    $query = mysqli_query($conn, $sql);

    $result = array();

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $result = $row;
    }
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
    <?php $page = "classroom";
    include('../../common/menu_function.php'); ?>
    <div class="main-content">
        <header>
            <div class="name-content" style="line-height: 55px; width: 30%;">
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars">
                        </span>
                    </label>
                    Lớp học
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
                <h2>DANH SÁCH SINH VIÊN LỚP <?php echo $result['ten_lop'] ?></h2>
                <div class="list-course">
                    <table class="module-table">
                        <tr>
                            <th>STT</th>
                            <th>Mã SV</th>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Địa chỉ</th>
                        </tr>
                        <?php
                        $i = 0;
                        foreach ($query as $item) {
                            $i++;
                            echo "<tr>";
                            echo "<td>$i</td>";
                            echo "<td>" . $item['ma_sv'] . "</td>";
                            echo "<td>" . $item['ten_sv'] . "</td>";
                            echo "<td>" . $item['ngay_sinh'] . "</td>";
                            echo "<td>" . $item['dia_chi'] . "</td>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </main>
    </div>


</body>

</html>