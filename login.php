<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/frontend/images/icons/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="assets/frontend/css/login/util.css">
    <link rel="stylesheet" type="text/css" href="assets/frontend/css/login/main.css">
</head>

<body>
    <div class="login-main">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST">
                    <span class="login100-form-title p-b-26">
                        Đăng nhập
                    </span>
                    <span class="login100-form-title p-b-48">
                        <img src="images/logo.png" alt="" style="width: 150px;">
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
                        <input class="input100" type="text" name="username">
                        <span class="focus-input100" data-placeholder="Tên đăng nhập"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="password">
                        <span class="focus-input100" data-placeholder="Mật khẩu"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" name="btn_submit">
                                Đăng nhập
                            </button>
                        </div>
                    </div>

                    <div class="text-center p-t-50">
                        <span class="txt1">
                            <a href="">Quên mật khẩu</a>
                        </span>
                    </div>
                </form>
                <?php
                include("./connection.php");

                if (isset($_POST["btn_submit"])) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];
                    #chong sql injection
                    $username = strip_tags($username);
                    $username = trim(addslashes($username));
                    $password = strip_tags($password);
                    $password = trim(addslashes($password));

                    if ($username == "" || $password == "") {
                        echo "Tên tài khoản hoặc mật khẩu không được để trống!";
                    } else {
                        $sql = "SELECT * FROM taikhoan WHERE tai_khoan = '$username' AND mat_khau = '$password'";

                        $query = mysqli_query($conn, $sql);
                        $num_rows = mysqli_num_rows($query);

                        $result = array();
                        if (mysqli_num_rows($query) > 0) {
                            $row = mysqli_fetch_assoc($query);
                            $result = $row;
                        }

                        $role = $result['role'];
                        // var_dump($role);
                        // die();
                        if ($num_rows == 0) {
                            echo "Tên đăng nhập hoặc mật khẩu không đúng!";
                        } else {

                            $_SESSION['username'] = $username;
                            if ($role == 0) {
                                header('Location: admin/index.php');
                            } else if ($role == 1) {
                                $sql1 = "SELECT isGVCN FROM giaovien INNER JOIN taikhoan ON taikhoan.id = giaovien.tk_id WHERE taikhoan.tai_khoan = '$username'";
                                // var_dump($sql1);
                                // die();
                                $query1 = mysqli_query($conn, $sql1);
                                $result1 = array();
                                if (mysqli_num_rows($query1) > 0) {
                                    $row = mysqli_fetch_assoc($query1);
                                    $result1 = $row;
                                }
                                if($result1['isGVCN'] == 0) {
                                    header('Location: teacher/index.php');
                                }
                                else {
                                    header('Location: teacher_cn/index.php');
                                }
                            } else {
                                header('Location: index.php');
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <script src="assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/vendor/animsition/js/animsition.min.js"></script>
    <script src="assets/vendor/bootstrap/js/popper.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/select2/select2.min.js"></script>
    <script src="assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="assets/vendor/daterangepicker/daterangepicker.js"></script>
    <script src="assets/vendor/countdowntime/countdowntime.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>