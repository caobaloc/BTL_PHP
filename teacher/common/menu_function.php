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
                <a href="../../mark.php" class="btn <?php if ($page == 'mark')  echo 'active'; ?>">
                    <span class="las la-marker"></span>
                    <span>Điểm</span>
                </a>
            </li>
            <li>
                <a href="../../details.php" class="btn <?php if ($page == 'detail')  echo 'active'; ?>">
                    <span class="las la-user-circle"></span>
                    <span>Thông tin</span>
                </a>
            </li>
        </ul>

    </div>
    <!-- <div class="group-name" style="color: white;">
        <p>© Nhóm 18 - 2022</p>
    </div> -->
</div>