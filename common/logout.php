<div class="user-wrapper">
    <div>
        <form action="" method="POST">
            <p>Xin chào!
                <b>
                    <?php
                    include('connection.php');
                    $username = $_SESSION['username'];
                    $sql = "SELECT * FROM student WHERE username = '$username'";
                    $query = mysqli_query($conn, $sql);
                    $result = '';
                    if ($query) {
                        while ($row = mysqli_fetch_assoc($query)) {
                            $result .= $row['firstname'] . " " . $row['lastname'];
                        }
                    }
                    echo $result;
                    ?>
                </b>
            </p>
            <button name="btn_logout">
                <span class="las la-power-off">Log out</span>
            </button>
        </form>
    </div>
</div>