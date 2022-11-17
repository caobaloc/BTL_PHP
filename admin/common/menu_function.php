<div class="sidebar">
    <div class="sidebar-brand">
        <a href="index.php" style="text-decoration: none; color: white;">
            <img src="../../assets/frontend/images/logo.png" alt="" style="height: 40px">
        </a>
        <a href="../../index.php" style="text-decoration: none; color: white;">
            <h2>HaUI Management</h2>
        </a>
    </div>

    <div class="sidebar-menu">
        <ul>
            <li>
                <a href="../../index.php" class="btn <?php if ($page == 'index')  echo 'active'; ?>">
                    <span class="las la-igloo"></span>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a href="../../class.php" class="btn <?php if ($page == 'classroom')  echo 'active'; ?>">
                    <span class="las la-users"></span>
                    <span>Lớp học</span>
                </a>
            </li>
            <li>
                <a href="../../student.php" class="btn <?php if ($page == 'student')  echo 'active'; ?>">
                    <span class="las la-clipboard-list"></span>
                    <span>Sinh viên</span>
                </a>
            </li>
            <li>
                <a href="../../certificate.php" class="btn <?php if ($page == 'certificate')  echo 'active'; ?>">
                    <span class="las la-marker"></span>
                    <span>Chứng chỉ</span>
                </a>
            </li>
            <li>
                <a href="../../course.php" class="btn <?php if ($page == 'course')  echo 'active'; ?>">
                    <span class="las la-shopping-bag"></span>
                    <span>Khoá học</span>
                </a>
            </li>
            <li>
                <a href="../../changePassword.php" class="btn <?php if ($page == 'changePassword')  echo 'active'; ?>">
                    <span class="las la-user-circle"></span>
                    <span>Đổi mật khẩu</span>
                </a>
            </li>
        </ul>

    </div>
    <!-- <div class="group-name" style="color: white;">
        <p>© Nhóm 18 - 2022</p>
    </div> -->
</div>