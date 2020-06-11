<?php
include_once 'db_config.php';

if (isset($_POST['submit'])) {

//    echo 'from submission section';

    //TODO : Unique Mobile Number - db
    //TODO : Unique Email ID - db

    $full_name = $_POST['full_name'];
    $mobile_number = $_POST['mobile_number'];
    $email_address = $_POST['email_address'];
//    $teaching_class = $_POST['teaching_class'];

//    $teacher_insertion_sql = "INSERT INTO `teachers`(`full_name`, `mobile_number`, `email_address`, `teaching_class`,`status`) VALUES ('$full_name','$mobile_number','$email_address','$teaching_class',1)";
    $random_number = rand(0, 999);
    $teacher_insertion_sql = "INSERT INTO `teachers`(`full_name`, `mobile_number`, `email_address`, `teaching_class`,`status`,`username`,`password`) VALUES ('$full_name','$mobile_number','$email_address','',1,'teacher$random_number','password$random_number')";

    $teacher_insertion_query_result = $db_connection->query($teacher_insertion_sql);

    if ($teacher_insertion_query_result == 1) {

        //Insertion Success
        header("Location: add_teacher.php?message=success&random=$random_number");
        exit();

    } else {

        //Insertion Failure
        header("Location: add_teacher.php?message=failure");
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

    <title>TIRUR ARTS COLLEGE - Admin : Add Teachers</title>

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
                        <li><a href="add_student.php">Add Students</a></li>
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
                        <li class="active"><a href="add_teacher.php">Add Teachers</a></li>
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
            <div class="alert alert-success"><b>Well done!</b> Teacher Added successfully, Credentials : teacher' . $_GET['random'] . ' & password' . $_GET['random'] . '</div>';

                } elseif ($_GET['message'] == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Add Teacher</h3>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal tasi-form" method="post" action="add_teacher.php">
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
                            <!--                            <div class="form-group">-->
                            <!--                                <label class="col-sm-2 control-label col-lg-2">Course</label>-->
                            <!--                                <div class="col-lg-10">-->
                            <!--                                    <select class="form-control" name="teaching_class" id="studying_course">-->
                            <!--                                        <option value="NA">Select Please...</option>-->
                            <!--                                        --><?php
                            //
                            //                                        $course_fetch_sql = "SELECT `stream_id`, `stream_name`, `streams`.`course_id`,`course_name` FROM `streams`,`courses` WHERE `courses`.`course_id`=`streams`.`course_id` ORDER BY `course_name`,`stream_name`";
                            //
                            //                                        $course_fetch_query_result = $db_connection->query($course_fetch_sql);
                            //
                            //                                        while ($course_fetch_query_result_row = mysqli_fetch_assoc($course_fetch_query_result)) {
                            //
                            //                                            echo '<option value="' . $course_fetch_query_result_row['stream_id'] . '">' . $course_fetch_query_result_row['course_name'] . ' ' . $course_fetch_query_result_row['stream_name'] . '</option>';
                            //                                        }
                            //                                        ?>
                            <!--                                    </select>-->
                            <!--                                </div>-->
                            <!--                            </div>-->

                            <br>
                            <div class="form-group has-error">

                                <center>
                                    <a href="add_teacher.php">
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
