<head>
    <meta charset="UTF-8">
    <title>HaUI Management</title>
    <link rel="icon" href="assets/frontend/images/logo.ico" type="image/icon type">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/frontend/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#search').on("keyup", function() {
                var keySearch = $(this).val();
                if (keySearch != "") {
                    $.ajax({
                        method: 'POST',
                        url: 'function/student/searchStudent.php',
                        data: {
                            key_search: keySearch
                        },
                        success: function(response) {
                            $('#showValue').html(response);
                            $('#showValue').css('display', 'none');
                            $('#search').focusout(function() {
                                $('#showValue').css('display', 'block');
                            });
                            $('#search').focusin(function() {
                                $('#showValue').css('display', 'block');
                            });
                        }
                    });
                } else {
                    $('#showValue').css('display', 'none');
                }
            });
        });
    </script>
</head>