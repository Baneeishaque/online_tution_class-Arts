<?php
include_once '../db_config.php';

if (isset($_GET['action'])) {

    if (filter_input(INPUT_GET, 'action') == 'delete-batch') {

        $batch_id = filter_input(INPUT_GET, 'batch-id');

        $student_fetch_sql = "SELECT `batch_number` FROM `students` WHERE `batch_number`='$batch_id'";
        $student_fetch_sql_result = $db_connection->query($student_fetch_sql);
        if (mysqli_num_rows($student_fetch_sql_result) != 0) {

            //There are students
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=still-students");
            exit();
        }

        $batch_delete_sql = "DELETE FROM `batchs` WHERE `batch_id`='$batch_id'";
        $batch_delete_query_result = $db_connection->query($batch_delete_sql);
        if ($batch_delete_query_result == 1) {

            //Delete Success
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success");
            exit();

        } else {

            //Delete Failure
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure");
            exit();
        }
    }
}

$batch_fetch_sql = "SELECT `batch_id`, `batch_name`, `batchs`.`stream_id`,`streams`.`stream_name`,`courses`.`course_name` FROM `batchs`,`streams`,`courses` WHERE `batchs`.`stream_id`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id`";

$batch_fetch_query_result = $db_connection->query($batch_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Admin", "All Batchs");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Courses", "All Batchs", $db_connection);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if (filter_input(INPUT_GET, 'message') == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Batch Deleted successfully...</div>';

                } elseif (filter_input(INPUT_GET, 'message') == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';

                } elseif (filter_input(INPUT_GET, 'message') == 'still-students') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> There are registered students for this batch...</div>';
                } elseif (filter_input(INPUT_GET, 'message') == 'still-teachers') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> There are assigned teachers for this subject...</div>';
                }
            }
            ?>

            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <h3>Current Batchs</h3>
                        </div>
                        <div class="col-md-6">
                            <a href="admin_add_batch.php">
                                <button class="btn btn-primary btn-block">Add Batchs</button>
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
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Batch Name With Stream
                                    & Course
                                </th>
                                <th><i class=" fa fa-edit"></i> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($batch_fetch_query_result_row = mysqli_fetch_assoc($batch_fetch_query_result)) {

                                echo '<tr>
                                <td>' . $i . '</td>
                                <td>' . $batch_fetch_query_result_row['batch_name'] . ' - ' . $batch_fetch_query_result_row['course_name'] . ' ' . $batch_fetch_query_result_row['stream_name'] . '</td>
                                <td>
                                      <a href="' . basename($_SERVER["SCRIPT_FILENAME"]) . '?action=delete-batch&batch-id=' . $batch_fetch_query_result_row['batch_id'] . '"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>
                                  </td>
                            </tr>';
                                $i++;
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
