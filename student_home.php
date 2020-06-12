<?php
session_start();
include_once 'db_config.php';

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['stream_id'])) {

    header('Location: student.php');
    exit;
}

$note_fetch_sql = "SELECT DISTINCT `note_id`, `teacher_id`, `notes`.`stream_id`, `title`, `description`, `file`, `notes`.`status`,`courses`.`course_id`,`courses`.`course_name`,`streams`.`stream_id`,`streams`.`stream_name` FROM `notes`,`streams`,`courses`,`students` WHERE `notes`.`stream_id`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id` AND `notes`.`stream_id`='" . $_SESSION['stream_id'] . "' AND `notes`.`status`=0";
//echo $student_fetch_sql;

$note_fetch_query_result = $db_connection->query($note_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>TIRUR ARTS COLLEGE - Admin Home</title>

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

                <h5 class="centered">Student</h5>

                <li class="sub-menu">
                    <a class="active" href="javascript:">
                        <i class="fa fa-th"></i>
                        <span>Notes</span>
                    </a>
                    <ul class="sub">
                        <li class="active"><a href="#">All Notes</a></li>
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

            <h3>Notes</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">

                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> Sl. No</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Course</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Title</th>
                                <th><i class="fa fa-bookmark"></i> Description</th>
                                <th><i class=" fa fa-edit"></i> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($note_fetch_query_result_row = mysqli_fetch_assoc($note_fetch_query_result)) {

                                echo '<tr>
                                <td>' . $i . '</td>
                                <td>' . $note_fetch_query_result_row['course_name'] . ' ' . $note_fetch_query_result_row['stream_name'] . '</td>
                                <td>' . $note_fetch_query_result_row['title'] . '</td>
                                <td>' . $note_fetch_query_result_row['description'] . '</td>
                                <td>
                                <a href="notes/' . $note_fetch_query_result_row['file'] . '"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button></a>
                                </td>
                            </tr>';
                            }
                            ?>

                            </tbody>
                        </table>
                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div><!-- /row -->

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
