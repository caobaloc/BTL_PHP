<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
include('../connection.php');
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<?php include('common/head.php') ?>

<body>
    <input type="checkbox" id="nav-toggle">
    <?php $page = "changePassword";
    include('common/menu.php') ?>
    <div class="main-content">
        <header>
            <div class="name-content" style="line-height: 55px; width: 30%;">
                <h1>
                    <label for="nav-toggle">
                        <span class="las la-bars">
                        </span>
                    </label>
                    Đổi mật khẩu
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
            <form method="POST">
                <h2>ĐỔI MẬT KHẨU</h2>
                <table class="button-add">
                    <tr>
                        <td>
                            <label for="text-user-name">Tên tài khoản: </label>
                        </td>
                        <td>
                            <input disabled="disable" type="text" name="text-user-name" value="<?php echo $username ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="text-old-pass">Mật khẩu cũ: </label>
                        </td>
                        <td>
                            <input type="password" name="text-old-pass">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="text-new-pass">Mật khẩu mới: </label>
                        </td>
                        <td>
                            <input type="password" name="text-new-pass">
                        </td>
                    </tr>
                    <tr class="bt-add">
                        <td colspan="2" style="text-align: center">
                            <input type="submit" value="Cập nhật" name="btn-change-pass">
                        </td>
                    </tr>
                </table>
            </form>
            <?php

            if (isset($_POST['btn-change-pass'])) {
                $oldpass = trim($_POST['text-old-pass']);
                $oldpass = addslashes($oldpass);
                $newpass = trim($_POST['text-new-pass']);
                $newpass = addslashes($newpass);

                $sql = "SELECT id, tai_khoan, mat_khau FROM taikhoan WHERE tai_khoan = '$username' && mat_khau = '$oldpass'";
                $query = mysqli_query($conn, $sql);

                $result = array();

                if (mysqli_num_rows($query) > 0) {
                    $row = mysqli_fetch_assoc($query);
                    $result = $row;
                }

                $tk_id = $result['id'];

                // var_dump($oldpass . " " . $newpass);
                // die();

                if (mysqli_num_rows($query) == 0) {
                    echo "<p>Mật khẩu cũ không đúng!</p>";
                } else if ($oldpass == "" || $newpass == "") {
                    echo "<p>Vui lòng nhập đầy đủ mật khẩu cũ và mới!</p>";
                } else if ($oldpass == $newpass) {
                    echo "<p>Mật khẩu cũ và mới trùng nhau!</p>";
                } else {
                    $sql1 = "UPDATE `taikhoan` SET `mat_khau`='$newpass' WHERE id = $tk_id";
                    // var_dump($sql1);
                    // die();
                    $query1 = mysqli_query($conn, $sql1);
                    echo "<p>Đổi mật khẩu thành công!</p>";
                }
            }
            ?>
        </main>
    </div>
</body>

</html>