<?php
include_once '../db_config.php';

if (isset($_POST['submit'])) {

//    echo 'from submission section';

    $teacher_id = filter_input(INPUT_POST, 'teacher-id');
    $subject_id = filter_input(INPUT_POST, 'subject-id');

    $teacher_assign_sql = "INSERT INTO `assigns`(`teacher_id`, `subject_id`) VALUES ('$teacher_id','$subject_id')";

    $teacher_assign_query_result = $db_connection->query($teacher_assign_sql);

    if ($teacher_assign_query_result == 1) {

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
print_head("Admin", "Assign Teachers");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Teachers", "Assign Teachers", $db_connection);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if (filter_input(INPUT_GET, 'message') == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Teacher Assigned successfully...</div>';

                } elseif (filter_input(INPUT_GET, 'message') == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Assign Teacher</h3>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal tasi-form" method="post"
                              action="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>">

                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Subject With Stream</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="subject-id" required>
                                        <option value="NA">Select Please...</option>
                                        <?php

                                        $subject_fetch_sql = "SELECT `subject_id`,`courses`.`course_name`,`streams`.`stream_name`, `subject_name` FROM `subjects`,`streams`,`courses` WHERE `subjects`.`stream_id`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id` ORDER BY `subject_name`";

                                        $subject_fetch_query_result = $db_connection->query($subject_fetch_sql);

                                        while ($subject_fetch_query_result_row = mysqli_fetch_assoc($subject_fetch_query_result)) {

                                            echo '<option value="' . $subject_fetch_query_result_row['subject_id'] . '">' . $subject_fetch_query_result_row['subject_name'] . ' - ' . $subject_fetch_query_result_row['course_name'] . ' ' . $subject_fetch_query_result_row['stream_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Teacher</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="teacher-id">
                                        <option value="NA">Select Please...</option>
                                        <?php

                                        $subject_fetch_sql = "SELECT `teacher_id`, `full_name`, `mobile_number`, `email_address`, `status`, `username`, `password` FROM `teachers` WHERE `status`!=3 ORDER BY `full_name`";

                                        $subject_fetch_query_result = $db_connection->query($subject_fetch_sql);

                                        while ($subject_fetch_query_result_row = mysqli_fetch_assoc($subject_fetch_query_result)) {

                                            echo '<option value="' . $subject_fetch_query_result_row['teacher_id'] . '">' . $subject_fetch_query_result_row['full_name'] . ' ' . $subject_fetch_query_result_row['mobile_number'] . '</option>';
                                        }
                                        ?>
                                    </select>
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
