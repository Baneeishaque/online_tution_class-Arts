<?php
include_once 'db_config.php';
if (isset($_POST['submit'])) {

//    echo 'from submission section';

    //TODO : Unique Mobile Number - db
    //TODO : Unique Email ID - db

    $full_name = $_POST['full_name'];
    $mobile_number = $_POST['mobile_number'];
    $email_address = $_POST['email_address'];
    $studying_class = $_POST['studying_class'];

    $student_insertion_sql = "INSERT INTO `students`(`full_name`, `mobile_number`, `email_address`, `studying_class`) VALUES ('$full_name','$mobile_number','$email_address','$studying_class')";

    $student_insertion_query_result = $db_connection->query($student_insertion_sql);
//    echo $student_insertion_query_result;

    if ($student_insertion_query_result == 1) {

        //Insertion Success
        header("Location: index.php?message=success");
        exit();

    } else {

        //Insertion Failure
        header("Location: registration.php?message=failure");
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

    <title>TIRUR ARTS COLLEGE - Student Registration</title>

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

        <form class="form-login" action="registration.php" method="post">
            <h2 class="form-login-heading">Register Now</h2>
            <?php
            if (isset($_GET['message']) && $_GET['message'] == 'failure') {

                echo '            <div class="alert alert-danger"><b>Oh snap!</b> Change a few things up and try submitting again...</div>';
            }
            ?>
            <div class="login-wrap">
                <input type="text" class="form-control" placeholder="Full Name" name="full_name" required autofocus>
                <br>
                <input type="number" class="form-control" placeholder="Mobile Number" name="mobile_number" required>
                <br>
                <input type="email" class="form-control" placeholder="Email Address" name="email_address" required>
                <br>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Course</label>
                </div>
                <select class="form-control" name="studying_class" id="studying_course">
                    <option value="NA">Select Please...</option>
                    <?php

                    $course_fetch_sql = "SELECT `stream_id`, `stream_name`, `streams`.`course_id`,`course_name` FROM `streams`,`courses` WHERE `courses`.`course_id`=`streams`.`course_id` ORDER BY `course_name`,`stream_name`";

                    $course_fetch_query_result = $db_connection->query($course_fetch_sql);

                    while ($course_fetch_query_result_row = mysqli_fetch_assoc($course_fetch_query_result)) {

                        echo '<option value="' . $course_fetch_query_result_row['stream_id'] . '">' . $course_fetch_query_result_row['course_name'] . ' ' . $course_fetch_query_result_row['stream_name'] . '</option>';
                    }
                    ?>
                </select>
                <br>

                <!--                <div class="form-group">-->
                <!--                    <label class="col-sm-2 col-sm-2 control-label">Stream</label>-->
                <!--                </div>-->
                <!--                <div id="result">-->
                <!--                    <select class="form-control" name="studying_stream">-->
                <!--                        <option value="NA">Select Please...</option>-->
                <!--                        --><?php
                //
                //                        $stream_fetch_sql = "SELECT `stream_id`, `stream_name` FROM `streams`";
                //
                //                        $stream_fetch_query_result = $db_connection->query($stream_fetch_sql);
                //
                //                        while ($stream_fetch_query_result_row = mysqli_fetch_assoc($stream_fetch_query_result)) {
                //
                //                            echo '<option value="' . $stream_fetch_query_result_row['stream_id'] . '">' . $stream_fetch_query_result_row['stream_name'] . '</option>';
                //                        }
                //                        ?>
                <!--                    </select>-->
                <!--                </div>-->
                <!--                <br>-->

                <button class="btn btn-theme btn-block" type="submit" name="submit"><i class="fa fa-lock"></i> Register
                </button>
                <hr>

                <div class="registration">
                    Already have an account?<br/>
                    <a class="" href="index.php">
                        Login to your account
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

<script>
    // $(document).ready(function () {
    //     const studyingCourseSelector = $('#studying_course');
    //     studyingCourseSelector.change(function () {
    //         alert('from script section ' + studyingCourseSelector.val());
    //         $.ajax({
    //             type: 'GET',
    //             url: 'get_streams.php',
    //             data: 'course-id=' + studyingCourseSelector.val(),
    //             success: function (msg) {
    //                 alert(msg);
    //                 $('#result').html(msg);
    //             }
    //         });
    //     });
    // });
</script>

</body>
</html>
