<?php
session_start();
include_once 'db_config.php';
if (isset($_POST['submit'])) {

    echo 'from form submission...';
//    var_dump($_POST);

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $teacher_login_sql = "SELECT `teacher_id`, `full_name`, `mobile_number`, `email_address`, `teaching_class`, `status`, `username`, `password`,`stream_id`,`stream_name`,`courses`.`course_id`,`course_name` FROM `teachers`,`streams`,`courses` WHERE `teaching_class`=`stream_id` AND `courses`.`course_id`=`streams`.`course_id` AND `username`='$username' AND `password`='$password'";
//    echo $teacher_login_sql;

    $teacher_login_query_result = $db_connection->query($teacher_login_sql);
    var_dump($teacher_login_query_result);

    if (mysqli_num_rows($teacher_login_query_result) == 0) {

        //No User
        //Or Teacher is not assigned a stream
        header("Location: teacher.php?message=no_user");
        exit();

    } else {

        $teacher_login_query_result_row = mysqli_fetch_assoc($teacher_login_query_result);

        //Goto Teacher Home
        $_SESSION['teacher_id'] = $teacher_login_query_result_row['teacher_id'];
        $_SESSION['stream_id'] = $teacher_login_query_result_row['stream_id'];
        $_SESSION['teaching_stream'] = $teacher_login_query_result_row['course_name'] . ' ' . $teacher_login_query_result_row['stream_name'];
        header("Location: teacher_home.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>TIRUR ARTS COLLEGE - Teacher Authentication</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- **********************************************************************************************************************************************************
MAIN CONTENT
*********************************************************************************************************************************************************** -->

<div id="login-page">
    <div class="container">

        <form class="form-login" action="teacher.php" method="post">
            <h2 class="form-login-heading">authentication</h2>
            <?php
            if (isset($_GET['message'])) {

                if ($_GET['message'] == 'no_user') {

                    echo '            <div class="alert alert-danger"><b>Oh snap!</b> Invalid credentials...</div>';
                }
            }
            ?>
            <div class="login-wrap">
                <input type="text" class="form-control" placeholder="User ID" name="username" required autofocus>
                <br>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <br>

                <button class="btn btn-theme btn-block" type="submit" name="submit"><i class="fa fa-lock"></i> Sign In
                </button>

            </div>

        </form>

    </div>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
<script>
    $.backstretch("assets/img/login-bg.jpg", {speed: 500});
</script>

</body>
</html>
