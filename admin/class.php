<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('common/head.php') ?>

<body>
    <input type="checkbox" id="nav-toggle">
    <?php $page = "classroom"; include('common/menu.php') ?>
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
            header('Location: ../login.php');
        }
        ?>
        <main>
            <div class="main-table">
                <h2>DANH SÁCH LỚP HỌC </h2>
                <div class="list-class">
                    <table class="module-table">
                        <tr>
                            <th>STT</th>
                            <th>Tên lớp</th>
                            <th>Sĩ số</th>
                            <th>Tên GVCN</th>
                        </tr>
                        <?php
                        include('../connection.php');
                        $sql = "SELECT lop.id, ten_lop, si_so, ten_gv FROM giaovien INNER JOIN lop ON giaovien.lop_id = lop.id WHERE giaovien.isGVCN = 1";
                        // var_dump($sql);
                        // die();
                        $query = mysqli_query($conn, $sql);
                        $i = 0;
                        if ($query) {
                            foreach ($query as $item) {
                                $i++;
                                echo "<tr>";
                                echo "<td> $i </td>";
                                echo "<td><a href='function/classroom/showStudentByClass.php?id=" . $item['id'] . "'>" . $item['ten_lop'] . "</a></td>";
                                echo "<td>" . $item['si_so'] . "</td>";
                                echo "<td style='text-align: center;'>" . $item['ten_gv'] . "</td>";
                                echo "</tr>";
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