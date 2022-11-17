<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
include('connection.php');

$tien_no =0;
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

    <?php $page = "xcc"; include('common/menu.php'); ?>
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
                <form method="POST">
                    <h2>DANH SÁCH CHỨNG CHỈ</h2>
                    <table class="button-add">
                        <tr>
                            <th>STT</th>
                            <th>Tên chứng chỉ</th>
                            <th>Thời gian nộp</th>
                            <th>Tình trạng</th>
                        </tr>
                        <?php
                            
                            $sql = "SELECT * FROM chungchi INNER JOIN sinhvien ON chungchi.sv_id = sinhvien.id WHERE sinhvien.ma_sv = $student_id ";
                            // var_dump($sql);
                            // die();
                            $query = mysqli_query($conn, $sql);
                            $i = 0;
                            if ($query) {
                                foreach ($query as $item) {
                                    $i++;
                                    echo "<tr>";
                                    echo "<td>" . $i . "</td>";
                                    echo "<td>" . $item['ten_cc'] . "</td>";
                                    echo "<td>" . $item['thoi_gian_nop'] . "</td>";
                                    echo "<td>" . $item['tinh_trang'] . "</td>";
                                }
                            }
                        ?>
                    </table>
                </form>
            </div>
        </main>
    </div>
    <script src="assets/js/btn.js"></script>

</body>

</html>
<?php ob_end_flush() ?>