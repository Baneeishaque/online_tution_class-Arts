<?php

include_once '../db_config.php';
if (isset($_GET['action'])) {
    if (filter_input(INPUT_GET, 'action') == 'delete-course') {

        $course_id = filter_input(INPUT_GET, 'course-id');

        $stream_fetch_sql = "SELECT `stream_id` FROM `streams`,`courses` WHERE `streams`.`course_id`=`courses`.`course_id` AND `courses`.`course_id` = '$course_id'";
        $stream_fetch_sql_result = $db_connection->query($stream_fetch_sql);
        if (mysqli_num_rows($stream_fetch_sql_result) != 0) {

            //There are students
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=still-streams");
            exit();
        }

        $course_delete_sql = "DELETE FROM `courses` WHERE `course_id`='$course_id'";

        $course_delete_query_result = $db_connection->query($course_delete_sql);

        if ($course_delete_query_result == 1) {

            //Update Success
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success");
            exit();

        } else {

//            echo $db_connection->error;
            //Update Failure
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure");
            exit();
        }

    }
}

$stream_fetch_sql = "SELECT `course_id`, `course_name` FROM `courses`";
$student_fetch_query_result = $db_connection->query($stream_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Admin", "All Courses");
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

                if (filter_input(INPUT_GET, 'message') == 'still-streams') {

                    echo '<br>
                    <div class="alert alert-danger"><b>Oh snap!</b> There are still streams for this course...</div>';

                } else if (filter_input(INPUT_GET, 'message') == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Course Deleted successfully...</div>';

                } elseif (filter_input(INPUT_GET, 'message') == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <h3>Current Courses</h3>
                        </div>
                        <div class="col-md-6">
                            <a href="admin_add_course.php">
                                <button class="btn btn-primary btn-block">Add Courses</button>
                            </a>
                        </div>
                    </div>
                </div><!-- /row -->
            </div>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">

                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> Sl. No.</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Course Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($student_fetch_query_result_row = mysqli_fetch_assoc($student_fetch_query_result)) {

                                echo '<tr>
                                <td>' . $i++ . '</td>
                                <td>' . $student_fetch_query_result_row['course_name'] . '</td>
                                <td><a href="' . basename($_SERVER["SCRIPT_FILENAME"]) . '?action=delete-course&course-id=' . $student_fetch_query_result_row['course_id'] . '"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></a></td>
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

    <?php
    include_once 'footer.php';
    ?>
</section>

<?php
include_once 'scripts.php';
?>

</body>
</html>
