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

    $random_number = rand(0, 999);
    $student_insertion_sql = "INSERT INTO `students`(`full_name`, `mobile_number`, `email_address`, `studying_class`,`status`,`username`,`password`) VALUES ('$full_name','$mobile_number','$email_address','$studying_class',1,'teacher$random_number','password$random_number')";
//    echo $student_insertion_sql;

    $student_insertion_query_result = $db_connection->query($student_insertion_sql);
//    echo $student_insertion_query_result;

    if ($student_insertion_query_result == 1) {

        //Insertion Success
        header("Location: add_student.php?message=success");
        exit();

    } else {

        //Insertion Failure
        header("Location: add_student.php?message=failure");
        exit();
    }
}

//if (isset($_GET['action'])) {
//
//    if ($_GET['action'] == 'verify-student') {
//
//        $student_id = $_GET['student-id'];
//
//        $student_update_sql = "UPDATE `students` SET `status`=1 WHERE `student_id`='$student_id'";
//
//        $student_update_query_result = $db_connection->query($student_update_sql);
//
//        if ($student_update_query_result == 1) {
//
//            //Update Success
//            header("Location: admin_home.php?message=success");
//            exit();
//
//        } else {
//
//            //Update Failure
//            header("Location: admin_home.php?message=failure");
//            exit();
//        }
//    }
//}
//
//$student_fetch_sql = "SELECT `student_id`, `full_name`, `mobile_number`, `email_address`, `status`, `username`, `password`,`courses`.`course_id`,`courses`.`course_name`,`streams`.`stream_id`,`streams`.`stream_name` FROM `students`,`courses`,`streams` WHERE `status` = 0 AND `studying_class`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id`";
////    echo $student_login_sql;
//
//$student_fetch_query_result = $db_connection->query($student_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>TIRUR ARTS COLLEGE - Admin : Add Students</title>

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

<section id="container">
    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a class="logo" href="#"><b>TIRUR ARTS COLLEGE</b></a>
        <!--logo end-->

        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="student.php">Logout</a></li>
            </ul>
        </div>
    </header>
    <!--header end-->

    <!-- **********************************************************************************************************************************************************
    MAIN SIDEBAR MENU
    *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="#"><img src="assets/img/logo.jpg" class="img-circle" width="60"></a></p>

                <h5 class="centered">Administrator</h5>

                <li class="sub-menu">
                    <a class="active" href="javascript:">
                        <i class="fa fa-th"></i>
                        <span>Students</span>
                    </a>
                    <ul class="sub">
                        <li><a href="admin_students.php">Current Students</a></li>
                        <li><a href="admin_home.php">Unverified Students</a></li>
                        <li><a href="suspended_students.php">Suspended Students</a></li>
                        <li class="active"><a href="add_student.php">Add Students</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Teachers</span>
                    </a>
                    <ul class="sub">
                        <li><a href="admin_teachers.php">Current Teachers</a></li>
                        <li><a href="assign_teachers.php">Assign Teachers</a></li>
                        <!-- <li><a href="admin_unverified_teachers.php">Unverified Teachers</a></li> -->
                        <li><a href="add_teacher.php">Add Teachers</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Courses</span>
                    </a>
                    <ul class="sub">
                        <li><a href="admin_courses.php">All Courses</a></li>
                        <li><a href="add_course.php">Add Courses</a></li>
                        <li><a href="admin_streams.php">All Streams</a></li>
                        <li><a href="add_stream.php">Add Streams</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Parents</span>
                    </a>
                    <ul class="sub">
                        <li><a href="#">All Parents</a></li>
                        <li><a href="#">Assign Parents</a></li>
                        <li><a href="#">Add Parents</a></li>
                    </ul>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->

    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if ($_GET['message'] == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Student Added successfully, Credentials : student' . $_GET['random'] . ' & password' . $_GET['random'] . '</div>';

                } elseif ($_GET['message'] == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Add Student</h3>

            <!--            <div class="row mt">-->
            <!--                <div class="col-md-12">-->
            <!--                    <div class="content-panel">-->
            <!--                        <table class="table table-striped table-advance table-hover">-->
            <!---->
            <!--                            <thead>-->
            <!--                            <tr>-->
            <!--                                <th><i class="fa fa-bullhorn"></i> Full Name</th>-->
            <!--                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Studying Course</th>-->
            <!--                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Studying Stream</th>
-->
            <!--                                <th><i class="fa fa-bookmark"></i> Mobile Number</th>-->
            <!--                                <th><i class=" fa fa-edit"></i> Actions</th>-->
            <!--                            </tr>-->
            <!--                            </thead>-->
            <!--                            <tbody>-->
            <!--                            --><?php
            //                            while ($student_fetch_query_result_row = mysqli_fetch_assoc($student_fetch_query_result)) {
            //
            //                                echo '<tr>
            //                                <td><a href="#">' . $student_fetch_query_result_row['full_name'] . '</a></td>
            //                                <td>' . $student_fetch_query_result_row['course_name'] . ' ' . $student_fetch_query_result_row['stream_name'] . '</td>
            //                                <td>' . $student_fetch_query_result_row['mobile_number'] . '</td>
            //                                <td>
            //                                    <a href="admin_home.php?action=verify-student&student-id=' . $student_fetch_query_result_row['student_id'] . '"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button></a>
            //                                </td>
            //                            </tr>';
            //                            }
            //                            ?>
            <!---->
            <!--                            </tbody>-->
            <!--                        </table>-->
            <!--                    </div>-->
            <!-- /content-panel -->
            <!--                </div>-->
            <!-- /col-md-12 -->
            <!--            </div>-->
            <!-- /row -->

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal tasi-form" method="post" action="add_student.php">
                            <div class="form-group has-success">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Full Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputSuccess" name="full_name" required>
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Mobile Number</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputError" name="mobile_number"
                                           required>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label class="col-sm-2 control-label col-lg-2" for="inputWarning">Email Address</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" id="inputWarning" name="email_address"
                                           required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Course</label>
                                <div class="col-lg-10">
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
                                </div>
                            </div>

                            <br>
                            <div class="form-group has-error">
                                <!--                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Class</label>-->
                                <!--                                <div class="col-lg-10">-->
                                <!--                                    <input type="number" class="form-control" id="inputError">-->
                                <!--                                </div>-->
                                <center>
                                    <a href="add_student.php">
                                        <button type="button" class="btn btn-danger">Reset</button>
                                    </a>
                                    <button class="btn btn-success" type="submit" name="submit">Submit</button>
                                </center>
                            </div>
                        </form>
                    </div><!-- /form-panel -->
                </div><!-- /col-lg-12 -->
            </div>

        </section>
        <!-- /wrapper -->
    </section><!-- /MAIN CONTENT -->

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            2020 - Tirur Arts College
            <a href="admin_home.php" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>

<!--common script for all pages-->
<script src="assets/js/common-scripts.js"></script>

<!--script for this page-->

<script>
    //custom select box

    $(function () {
        $('select.styled').customSelect();
    });

</script>

</body>
</html>
