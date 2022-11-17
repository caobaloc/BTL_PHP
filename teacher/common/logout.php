<div class="user-wrapper">
    <div>
        <form action="" method="POST">
            <p>Xin chào!
                <b>
                    <?php
                    include('../connection.php');
                    $username = $_SESSION['username'];
                    echo $username;
                    ?>
                </b>
            </p>
            <button name="btn_logout">
                <span class="las la-power-off">Log out</span>
            </button>
        </form>
    </div>
</div>