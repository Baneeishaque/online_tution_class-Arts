<?php
include_once '../db_config.php';

if (isset($_POST['submit'])) {

//    echo 'from submission section';
//    var_dump($_POST);

    $subject_name = filter_input(INPUT_POST, 'course-name');

    $subject_insertion_sql = "INSERT INTO `courses`(`course_name`) VALUES ('$subject_name')";

    $subject_insertion_query_result = $db_connection->query($subject_insertion_sql);

    if ($subject_insertion_query_result == 1) {

        //Insertion Success
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success");
        exit();

    } else {

        //Insertion Failure
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Admin", "Add Courses");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Courses", "All Courses", $db_connection);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if (filter_input(INPUT_GET, 'message') == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Course Added successfully...</div>';

                } elseif (filter_input(INPUT_GET, 'message') == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Add Course</h3>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal tasi-form" method="post"
                              action="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>">
                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Course Name</label>
                                <div class="col-lg-10">
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" name="course-name" required>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div class="form-group has-error">

                                <center>
                                    <a href="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>">
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

    <?php
    include_once 'footer.php';
    ?>
</section>

<?php
include_once 'scripts.php';
?>

</body>
</html>
