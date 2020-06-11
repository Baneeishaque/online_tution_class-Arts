<?php
session_start();
include_once 'db_config.php';

if (isset($_POST['submit'])) {

//    echo 'from submission section';

    //TODO : Unique Mobile Number - db
    //TODO : Unique Email ID - db

    $stream_id = $_POST['stream_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $note_file = $_POST['note_file'];

    $target_dir = "notes/";
    $file_name = $_FILES["note_file"]["name"];
    $target_file = $target_dir . basename($_FILES["note_file"]["name"]);
    move_uploaded_file($_FILES["note_file"]["tmp_name"], $target_file);

    $student_insertion_sql = "INSERT INTO `notes`(`teacher_id`, `stream_id`, `title`, `description`, `file`) VALUES ('" . $_SESSION['teacher_id'] . "','$stream_id','$title','$description','$file_name')";
//    echo $student_insertion_sql;

    $student_insertion_query_result = $db_connection->query($student_insertion_sql);
//    echo $student_insertion_query_result;

    if ($student_insertion_query_result == 1) {

        //Insertion Success
        header("Location: add_note.php?message=success");
        exit();

    } else {

        //Insertion Failure
        header("Location: add_note.php?message=failure");
        exit();
    }
}

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['teacher_id'])) {

    header('Location: teacher.php');
    exit;
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
                <li><a class="logout" href="teacher.php">Logout</a></li>
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

                <h5 class="centered">Teacher</h5>

                <li class="sub-menu">
                    <a class="active" href="javascript:">
                        <i class="fa fa-th"></i>
                        <span>Notes</span>
                    </a>
                    <ul class="sub">
                        <li><a href="teacher_home.php">All Notes</a></li>
                        <li class="active"><a href="#">Upload Notes</a></li>
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
            <div class="alert alert-success"><b>Well done!</b> Note Uploaded successfully...';

                } elseif ($_GET['message'] == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Add Notes</h3>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal tasi-form" method="post" action="add_note.php"
                              enctype="multipart/form-data">
                            <input type="hidden" name="stream_id" value="<?php echo $_SESSION['stream_id'] ?>">
                            <div class="form-group has-success">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Course</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputSuccess" name="course_name"
                                           value="<?php echo $_SESSION['teaching_stream'] ?>"
                                           required disabled>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Title</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputSuccess" name="title" required>
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Description</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputError" name="description">
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">File</label>
                                <div class="col-lg-10">
                                    <input type="file" class="form-control" id="inputError" name="note_file" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group has-error">

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
