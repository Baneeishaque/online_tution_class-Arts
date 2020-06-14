<?php
include_once '../db_config.php';

if (isset($_POST['submit'])) {

//    echo 'from submission section';

    //TODO : Unique Mobile Number - db
    //TODO : Unique Email ID - db

    $full_name = filter_input(INPUT_POST, 'full_name');
    $mobile_number = filter_input(INPUT_POST, 'mobile_number');
    $email_address = filter_input(INPUT_POST, 'email_address');
    $studying_class = filter_input(INPUT_POST, 'studying_class');

    $random_number = rand(0, 999);
    $student_insertion_sql = "INSERT INTO `students`(`full_name`, `mobile_number`, `email_address`, `studying_class`,`status`,`username`,`password`) VALUES ('$full_name','$mobile_number','$email_address','$studying_class',1,'teacher$random_number','password$random_number')";
//    echo $student_insertion_sql;

    $student_insertion_query_result = $db_connection->query($student_insertion_sql);
//    echo $student_insertion_query_result;

    if ($student_insertion_query_result == 1) {

        //Insertion Success
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success&random=$random_number");
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
print_head("Admin", "Add Students");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Students", "Add Students");
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if (filter_input(INPUT_GET, 'message') == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Student Added successfully, Credentials : student' . filter_input(INPUT_GET, 'random') . ' & password' . filter_input(INPUT_GET, 'random') . '</div>';

                } elseif (filter_input(INPUT_GET, 'message') == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Add Student</h3>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal tasi-form" method="post"
                              action="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>">
                            <div class="form-group has-success">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Full Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputSuccess" name="full_name" required>
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Mobile Number</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" id="inputError" name="mobile_number"
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
                                <label class="col-sm-2 control-label col-lg-2">Stream</label>
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
