<?php
include_once '../db_config.php';

if (isset($_GET['action'])) {

    if (filter_input(INPUT_GET, 'action') == 'verify-student') {

        $student_id = filter_input(INPUT_GET, 'student-id');

        //TODO : Check for existing username
        $random_number = rand(0, 999);
        $student_update_sql = "UPDATE `students` SET `status`=1,`username`='student$random_number',`password`='password$random_number' WHERE `student_id`='$student_id'";
//        echo $student_update_sql;

        $student_update_query_result = $db_connection->query($student_update_sql);

        if ($student_update_query_result == 1) {

            //Update Success
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success&random=$random_number");
            exit();

        } else {

//            echo $db_connection->error;
            //Update Failure
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure");
            exit();
        }
    } elseif (filter_input(INPUT_GET, 'action') == 'delete-student') {

        $student_id = filter_input(INPUT_GET, 'student-id');

        $student_update_sql = "UPDATE `students` SET `status`=3 WHERE `student_id`='$student_id'";
//        echo $student_update_sql;

        $student_update_query_result = $db_connection->query($student_update_sql);

        if ($student_update_query_result == 1) {

            //Update Success
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success2");
            exit();

        } else {

            //Update Failure
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure");
            exit();
        }
    }
}

$student_fetch_sql = "SELECT `student_id`, `full_name`, `mobile_number`, `email_address`, `status`, `username`, `password`,`courses`.`course_id`,`courses`.`course_name`,`streams`.`stream_id`,`streams`.`stream_name` FROM `students`,`courses`,`streams` WHERE `status` = 0 AND `studying_class`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id`";

$student_fetch_query_result = $db_connection->query($student_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Admin", "Unverified Students");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Students", "Unverified Students");
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if (filter_input(INPUT_GET, 'message') == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Student Verified successfully, Credentials : student' . filter_input(INPUT_GET, 'random') . ' & password' . filter_input(INPUT_GET, 'random') . '</div>';

                } else if (filter_input(INPUT_GET, 'message') == 'success2') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Student Deleted successfully...</div>';

                } elseif (filter_input(INPUT_GET, 'message') == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Unverified Students</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">

                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> Full Name</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Studying Course</th>
                                <th><i class="fa fa-bookmark"></i> Mobile Number</th>
                                <th><i class="fa fa-bookmark"></i> Email ID</th>
                                <th><i class=" fa fa-edit"></i> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($student_fetch_query_result_row = mysqli_fetch_assoc($student_fetch_query_result)) {

                                echo '<tr>
                                <td><a href="#">' . $student_fetch_query_result_row['full_name'] . '</a></td>
                                <td>' . $student_fetch_query_result_row['course_name'] . ' ' . $student_fetch_query_result_row['stream_name'] . '</td>
                                <td>' . $student_fetch_query_result_row['mobile_number'] . '</td>
                                <td>' . $student_fetch_query_result_row['email_address'] . '</td>
                                <td>
                                    <a href="' . basename($_SERVER["SCRIPT_FILENAME"]) . '?action=verify-student&student-id=' . $student_fetch_query_result_row['student_id'] . '"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button></a>
                                    <a href="' . basename($_SERVER["SCRIPT_FILENAME"]) . '?action=delete-student&student-id=' . $student_fetch_query_result_row['student_id'] . '"><button class="btn btn-danger btn-xs"><i class="fa fa-times-circle "></i></button></a>
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

    <?php
    include_once 'footer.php';
    ?>

</section>

<?php
include_once 'scripts.php';
?>

</body>
</html>
