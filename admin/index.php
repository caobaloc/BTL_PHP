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
    <?php $page = "index"; include('common/menu.php') ?>
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
            <div class="bg-img"></div>
            <div class="content-main">
                <div class="cards">
                    <div class="card-single">
                        <div>
                            <h1>
                                <?php
                                include('../connection.php');
                                $sql_student = "SELECT * FROM sinhvien";
                                $query_student = mysqli_query($conn, $sql_student);
                                $num_student = mysqli_num_rows($query_student);
                                echo $num_student;
                                ?>
                            </h1>
                            <span>Sinh viên</span>
                        </div>
                        <div>
                            <span class="las la-users"></span>
                        </div>
                    </div>

                    <div class="card-single">
                        <div>
                            <h1>
                                <?php
                                include('../connection.php');

                                $sql_course = "SELECT * FROM lop";
                                $query_course = mysqli_query($conn, $sql_course);
                                $num_course = mysqli_num_rows($query_course);
                                echo $num_course;
                                ?>
                            </h1>
                            <span>Lớp</span>
                        </div>
                        <div>
                            <span class="las la-book"></span>
                        </div>
                    </div>

                    <div class="card-single">
                        <div>
                            <h1>
                                <?php
                                include('../connection.php');

                                $sql_teacher = "SELECT * FROM giaovien";
                                $query_teacher = mysqli_query($conn, $sql_teacher);
                                $num_teacher = mysqli_num_rows($query_teacher);
                                echo $num_teacher;
                                ?>
                            </h1>
                            <span>Giáo viên</span>
                        </div>
                        <div>
                            <span class="las la-user"></span>
                        </div>
                    </div>

                    <div class="card-single">
                        <div>
                            <h1>
                                <?php
                                include('../connection.php');

                                $sql_club = "SELECT * FROM khoa";
                                $query_club = mysqli_query($conn, $sql_club);
                                $num_club = mysqli_num_rows($query_club);
                                echo $num_club;
                                ?>
                            </h1>
                            <span>Khoa</span>
                        </div>
                        <div>
                            <span class="las la-dice-four"></span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="assets/js/btn.js"></script>

</body>

</html>