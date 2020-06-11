<?php
include_once 'db_config.php';
if (isset($_POST['submit'])) {

//    echo 'from submission section';
//    var_dump($_POST);

    $username = $_POST['username'];
    $password = $_POST['password'];

    $student_login_sql = "SELECT `student_id`, `full_name`, `mobile_number`, `email_address`, `studying_class`, `status`, `username`, `password` FROM `students` WHERE `username`='$username' AND `password`='$password'";
//    echo $student_login_sql;

    $student_login_query_result = $db_connection->query($student_login_sql);
//    var_dump($student_login_query_result);

    if (mysqli_num_rows($student_login_query_result) == 0) {

        //No User
        header("Location: index.php?message=no_user");
        exit();

    } else {

        $student_login_query_result_row = mysqli_fetch_assoc($student_login_query_result);
//        var_dump($student_login_query_result_row);
        if ($student_login_query_result_row['status'] == 0) {

            //Unverified User
            header("Location: index.php?message=unverified_user");
            exit();

        } else {

            //Goto Home
        }
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

    <title>DASHGUM - Student Authentication</title>

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

        <form class="form-login" action="index.php" method="post">
            <h2 class="form-login-heading">sign in now</h2>
            <?php
            if (isset($_GET['message'])) {

                if ($_GET['message'] == 'success') {

                    echo '            <div class="alert alert-success"><b>Well done!</b> You have successfully registered, please wait for confirmation...</div>';

                } else if ($_GET['message'] == 'no_user') {

                    echo '            <div class="alert alert-danger"><b>Oh snap!</b> Invalid credentials...</div>';

                } else if ($_GET['message'] == 'unverified_user') {

                    echo '<div class="alert alert-warning"><b>Warning!</b> Better check yourself, you\'re not verified yet...</div>';
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
                <hr>

                <div class="registration">
                    Don't have an account yet?<br/>
                    <a class="" href="registration.php">
                        Create an account
                    </a>
                </div>

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
