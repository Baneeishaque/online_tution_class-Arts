<?php
include_once '../db_config.php';

if (isset($_GET['action'])) {

    if (filter_input(INPUT_GET, 'action') == 'delete-stream') {

        $stream_id = filter_input(INPUT_GET, 'stream-id');

        $batch_fetch_sql = "SELECT `batch_id` FROM `batchs`,`streams` WHERE `batchs`.`stream_id`=`streams`.`stream_id` AND `streams`.`stream_id` = '$stream_id'";
        $batch_fetch_sql_result = $db_connection->query($batch_fetch_sql);
        if (mysqli_num_rows($batch_fetch_sql_result) != 0) {

            //There are students
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=still-batchs");
            exit();
        }

        $batch_fetch_sql = "SELECT `student_id` FROM `students`,`streams` WHERE `studying_class`=`streams`.`stream_id` AND `streams`.`stream_id` = '$stream_id'";
        $batch_fetch_sql_result = $db_connection->query($batch_fetch_sql);
        if (mysqli_num_rows($batch_fetch_sql_result) != 0) {

            //There are students
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=still-students");
            exit();
        }

        $batch_fetch_sql = "SELECT `subject_id` FROM `subjects`,`streams` WHERE `subjects`.`stream_id`=`streams`.`stream_id` AND `streams`.`stream_id` = '$stream_id'";
        $batch_fetch_sql_result = $db_connection->query($batch_fetch_sql);
        if (mysqli_num_rows($batch_fetch_sql_result) != 0) {

            //There are students
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=still-subjects");
            exit();
        }

        $course_delete_sql = "DELETE FROM `streams` WHERE `stream_id`='$stream_id'";

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

$student_fetch_sql = "SELECT `stream_id`, `stream_name`,`courses`.`course_name` FROM `streams`,`courses` WHERE `streams`.`course_id`=`courses`.`course_id` ORDER BY `course_name`,`streams`.`stream_id`";
$student_fetch_query_result = $db_connection->query($student_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Admin", "All Streams");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Courses", "All Streams", $db_connection);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if (filter_input(INPUT_GET, 'message') == 'still-batchs') {

                    echo '<br>
                    <div class="alert alert-danger"><b>Oh snap!</b> There are still batchs for this stream...</div>';

                } else if (filter_input(INPUT_GET, 'message') == 'still-students') {

                    echo '<br>
                    <div class="alert alert-danger"><b>Oh snap!</b> There are still students for this stream...</div>';

                } else if (filter_input(INPUT_GET, 'message') == 'still-subjects') {

                    echo '<br>
                    <div class="alert alert-danger"><b>Oh snap!</b> There are still subjects for this stream...</div>';

                } else if (filter_input(INPUT_GET, 'message') == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Stream Deleted successfully...</div>';

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
                            <h3>Current Streams</h3>
                        </div>
                        <div class="col-md-6">
                            <a href="admin_add_stream.php">
                                <button class="btn btn-primary btn-block">Add Streams</button>
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
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Stream With Course Name
                                </th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($student_fetch_query_result_row = mysqli_fetch_assoc($student_fetch_query_result)) {

                                echo '<tr>
                                <td><a href="#">' . $i++ . '</a></td>
                                <td>' . $student_fetch_query_result_row['course_name'] . ' - ' . $student_fetch_query_result_row['stream_name'] . '</td>
                                <td><a href="' . basename($_SERVER["SCRIPT_FILENAME"]) . '?action=delete-stream&stream-id=' . $student_fetch_query_result_row['stream_id'] . '"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></a></td>
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
