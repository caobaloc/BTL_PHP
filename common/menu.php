<div class="sidebar">
    <div class="sidebar-brand">
        <a href="index.php" style="text-decoration: none; color: white;">
            <img src="assets/frontend/images/logo.png" alt="" style="height: 40px">
        </a>
        <a href="index.php" style="text-decoration: none; color: white;">
            <h2>HaUI Management</h2>
        </a>
    </div>
    <div class="sidebar-menu">
        <ul>

            <li>
                <a href="index.php" class="btn <?php if ($page == 'student')  echo 'active'; ?>">
                    <span class="las la-clipboard-list"></span>
                    <span>Thông tin sinh viên</span>
                </a>
            </li>
            <li>
                <a href="kqht.php" class="btn <?php if ($page == 'kqht')  echo 'active'; ?>">
                    <span class="las la-marker"></span>
                    <span>Kết quả học tập</span>
                </a>
            </li>
            <li>
                <a href="dkhp.php" class="btn <?php if ($page == 'dkhp')  echo 'active'; ?>">
                    <span class="las la-shopping-bag"></span>
                    <span>Đăng ký học phần</span>
                </a>
            </li>
            <li>
                <a href="xcc.php" class="btn <?php if ($page == 'xcc')  echo 'active'; ?>">
                    <span class="las la-receipt"></span>
                    <span>Xem chứng chỉ</span>
                </a>
            </li>
            <li>
                <a href="diemrenluyen.php" class="btn <?php if ($page == 'diemrenluyen')  echo 'active'; ?>">
                    <span class="las la-receipt"></span>
                    <span>Điểm rèn luyện</span>
                </a>
            </li>

        </ul>

    </div>
    <div class="group-name" style="color: white;">
        <p>© Nhóm 18 - 2022</p>
    </div>
</div>