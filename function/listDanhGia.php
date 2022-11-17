<?php ob_start() ?>
<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}

include('../connection.php');
$hk = $_GET['hk'];
$student_id  = $_SESSION['username'];
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
            <a href="../index.php" style="text-decoration: none; color: white;">
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
                <li>
                    <a href="../diemrenluyen.php" class="btn <?php if ($page == 'club')  echo 'active'; ?>">
                        <span class="las la-receipt"></span>
                        <span>Điểm rèn luyện</span>
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
                    <h2>FORM TỰ ĐÁNH GIÁ ĐIỂM RÈN LUYỆN</h2>
                    <table class="button-add">
                        <tr>
                            <th>STT</th>
                            <th>Tiêu chí đánh giá</th>
                            <th>Điểm tự đánh giá</th>
                            <th>Ghi chú</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Đánh giá về ý thức, thái độ tham gia và kết quả học tập</td>
                            <td><input type="text" name = "diem1"></td>
                            <td style="color:red">Tối đa 9 điểm</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Đánh giá về ý thức chấp hành nội quy, quy chế trong nhà trường</td>
                            <td><input type="text" name = "diem2"></td>
                            <td style="color:red">Tối đa 30 điểm</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Đánh giá về ý thức tham gia các hoạt động chính trị – xã hội, Văn hoá, Văn nghệ, Thể dục, Thể thao, phòng chống tội phạm và các tệ nạn xã hội</td>
                            <td><input type="text" name = "diem3"></td>
                            <td style="color:red">Tối đa 20 điểm</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Đánh giá về ý thức công dân trong quan hệ cộng đồng</td>
                            <td><input type="text" name = "diem4"></td>
                            <td style="color:red">Tối đa 27 điểm</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Đánh giá về ý thức và kết quả tham gia công tác cán bộ lớp, các đoàn thể, tổ chức trong nhà trường hoặc sinh viên đạt được thành tích xuất sắc trong học tập, rèn luyện</td>
                            <td><input type="text" name = "diem5"></td>
                            <td style="color:red">Tối đa 10 điểm</td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <input type="submit" name="btn_gui" value = "Gửi">
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                    if(isset($_POST['btn_gui'])){
                        $diem1  = trim($_POST['diem1']);
                        $diem2  = trim($_POST['diem2']);
                        $diem3  = trim($_POST['diem3']);
                        $diem4  = trim($_POST['diem4']);
                        $diem5  = trim($_POST['diem5']);
                        if(is_numeric($diem1)&&is_numeric($diem2)&&is_numeric($diem3)&&is_numeric($diem4)&&is_numeric($diem5)){
                            if($diem1>9){
                                echo '<script>alert("Vui lòng nhập theo ghi chú!")</script>';
                            }
                            else if($diem2>30){
                                echo '<script>alert("Vui lòng nhập theo ghi chú!")</script>';
                            }
                            else if($diem3>20){
                                echo '<script>alert("Vui lòng nhập theo ghi chú!")</script>';
                            }
                            else if($diem4>27){
                                echo '<script>alert("Vui lòng nhập theo ghi chú!")</script>';
                            }
                            else if($diem5>10){
                                echo '<script>alert("Vui lòng nhập theo ghi chú!")</script>';
                            }
                            else{
                                $tongdiem = $diem1 + $diem2 + $diem3 + $diem4 + $diem5;
                                $sql = "UPDATE diemrenluyen INNER JOIN sinhvien ON sinhvien.id = diemrenluyen.sv_id
                                        SET diem_tu_danh_gia = $tongdiem 
                                        WHERE sinhvien.ma_sv = $student_id AND diemrenluyen.hoc_ky = $hk ";
                                $query = mysqli_query($conn,$sql);
                                header('Location: ../diemrenluyen.php');
                            }
                        }
                        else{
                            echo '<script>alert("Vui lòng nhập điểm là số")</script>';
                        }
                    }
                ?>
            </div>
        </main>
    </div>
    <script src="assets/js/btn.js"></script>
    <a href="" style="width: 200px;"></a>
</body>

</html>
<?php ob_end_flush() ?>