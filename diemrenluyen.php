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
    <?php $page = "diemrenluyen"; include('common/menu.php'); ?>
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
            <div class="main-table">
                <h2>ĐÁNH GIÁ ĐIỂM RÈN LUYỆN</h2>
                <form method="POST">
                    
                    <table class="module-table">
                        <tr>
                            <th>STT</th>
                            <th>Kì học</th>
                            <th>Điểm tự đánh giá</th>
                            <th>Điểm chủ nhiệm lớp đánh giá</th>
                            <th>Điểm cộng học tập</th>
                            <th>Tổng điểm</th>
                            <th>Xếp loại</th>
                            <th>Trạng thái</th>
                        </tr>
                        <?php
                            $sql = "SELECT *FROM diemrenluyen INNER JOIN sinhvien ON sinhvien.id = diemrenluyen.sv_id WHERE sinhvien.ma_sv = $student_id";
                            $i=0;
                            $query = mysqli_query($conn,$sql);
                            foreach($query as $item){
                                $i++;
                                $tongdiem = $item['diem_cong']+$item['diem_gv_danh_gia'];
                                if($tongdiem >100){
                                    $tongdiem =100;
                                }
                                echo "<tr>";
                                echo "<td>".$i."</td>";
                                echo "<td><a href='function/listDanhGia.php?hk=".$item['hoc_ky']."'><input style='width: 200px;' type='button' value = 'Đánh giá kì ".$item['hoc_ky']."'/></td>";
                                echo "<td>".$item['diem_tu_danh_gia']."</td>";
                                echo "<td>".$item['diem_gv_danh_gia']."</td>";
                                echo "<td>".$item['diem_cong']."</td>";
                                
                                echo "<td>".$tongdiem."</td>";
                                if($tongdiem == 0 || $item['diem_gv_danh_gia'] ==0 || $item['diem_tu_danh_gia'] == 0 ){
                                    echo "<td>Chưa đánh giá</td>";
                                }
                                else  if($tongdiem >=90 && $tongdiem<=100){
                                    echo "<td>Xuất sắc</td>";
                                }
                                else if($tongdiem >=80 && $tongdiem<=89){
                                    echo "<td>Tốt</td>";
                                }
                                else if($tongdiem >=65 && $tongdiem<=79){
                                    echo "<td>Khá</td>";
                                }
                                else if($tongdiem >=50 && $tongdiem<=64){
                                    echo "<td>Trung Bình</td>";
                                }
                                else if($tongdiem >=35 && $tongdiem<=49){
                                    echo "<td>Yếu</td>";
                                }
                                else{
                                    echo "<td>Kém</td>";
                                }
                                if($tongdiem == 0){
                                    echo "<td>Đang xét đánh giá</td>";
                                }
                                else{
                                    echo "<td>Hoàn thành</td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </table>
                </form>
            </div>
        </main>
    </div>
    <script src="assets/js/btn.js"></script>
    <a href="" style="width: 200px;"></a>
</body>

</html>
<?php ob_end_flush() ?>