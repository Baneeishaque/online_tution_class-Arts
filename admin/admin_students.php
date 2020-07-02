<?php
include_once '../db_config.php';

if (!isset($_GET['stream-id'])) {

    header('Location: admin_current_teachers.php');
    exit;
}

function checkExistingUsername($dbConnection)
{
    $random_number = rand(0, 999);
    $studentFetchSql = "SELECT `student_id` FROM `students` WHERE `username`='tacs$random_number'";
    $studentFetchSqlResult = $dbConnection->query($studentFetchSql);
    if (mysqli_num_rows($studentFetchSqlResult) != 0) {

        checkExistingUsername($dbConnection);

    } else {

        return $random_number;
    }
}

if (isset($_GET['action'])) {

    if (filter_input(INPUT_GET, 'action') == 'verify-student') {

        $student_id = filter_input(INPUT_GET, 'student-id');

        $random_number = checkExistingUsername($db_connection);

        $student_update_sql = "UPDATE `students` SET `status`=2,`username`='tacs$random_number',`password`='pw$random_number' WHERE `student_id`='$student_id'";
//        echo $student_update_sql;

        $student_update_query_result = $db_connection->query($student_update_sql);

        if ($student_update_query_result == 1) {

            //Update Success
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success&random=$random_number&stream-id=" . $_GET['stream-id'] . "&stream-name=" . $_GET['stream-name']);
            exit();

        } else {

//            echo $db_connection->error;
            //Update Failure
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure&stream-id=" . $_GET['stream-id'] . "&stream-name=" . $_GET['stream-name']);
            exit();
        }

    } elseif (filter_input(INPUT_GET, 'action') == 'delete-student') {

        $student_id = filter_input(INPUT_GET, 'student-id');

        $student_update_sql = "DELETE FROM `students` WHERE `student_id`='$student_id'";
//        echo $student_update_sql;

        $student_update_query_result = $db_connection->query($student_update_sql);

        if ($student_update_query_result == 1) {

            //Update Success
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success2&stream-id=" . $_GET['stream-id'] . "&stream-name=" . $_GET['stream-name']);
            exit();

        } else {

            //Update Failure
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure&stream-id=" . $_GET['stream-id'] . "&stream-name=" . $_GET['stream-name']);
            exit();
        }
    } else if (filter_input(INPUT_GET, 'action') == 'suspend-student') {

        $student_id = filter_input(INPUT_GET, 'student-id');

        $student_update_sql = "UPDATE `students` SET `status`=1 WHERE `student_id`='$student_id'";

        $student_update_query_result = $db_connection->query($student_update_sql);

        if ($student_update_query_result == 1) {

            //Update Success
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success3&stream-id=" . $_GET['stream-id'] . "&stream-name=" . $_GET['stream-name']);
            exit();

        } else {

            //Update Failure
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure&stream-id=" . $_GET['stream-id'] . "&stream-name=" . $_GET['stream-name']);
            exit();
        }
    } else if (filter_input(INPUT_GET, 'action') == 'enable-student') {

        $student_id = filter_input(INPUT_GET, 'student-id');
        $student_update_sql = "UPDATE `students` SET `status`=2 WHERE `student_id`='$student_id'";
        $student_update_query_result = $db_connection->query($student_update_sql);
        if ($student_update_query_result == 1) {

            //Update Success
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success4&stream-id=" . $_GET['stream-id'] . "&stream-name=" . $_GET['stream-name']);
            exit();

        } else {

            //Update Failure
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure&stream-id=" . $_GET['stream-id'] . "&stream-name=" . $_GET['stream-name']);
            exit();
        }
    }
}

$student_fetch_sql = "SELECT `student_id`, `full_name`, `mobile_number`, `email_address`, `status`, `username`, `password`,`courses`.`course_id`,`courses`.`course_name`,`streams`.`stream_id`,`streams`.`stream_name`,`batch_number`,`additional_mobile`,`additional_email`,`photo` FROM `students`,`courses`,`streams` WHERE `studying_class`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id` AND `streams`.`stream_id`='" . $_GET['stream-id'] . "'";

if (isset($_GET['batch-id'])) {

    $student_fetch_sql = $student_fetch_sql . " AND `batch_number`=" . $_GET['batch-id'];
}

$student_fetch_sql = $student_fetch_sql . " ORDER BY `status` DESC,`batch_number` ASC, `students`.`full_name` ASC";
//echo $student_fetch_sql;

$student_fetch_query_result = $db_connection->query($student_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Admin", "Students");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Students", $_GET['stream-id'], $db_connection);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if (filter_input(INPUT_GET, 'message') == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Student Verified successfully, Credentials : tacs' . filter_input(INPUT_GET, 'random') . ' & tacs' . filter_input(INPUT_GET, 'random') . '</div>';

                } else if (filter_input(INPUT_GET, 'message') == 'success2') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Student Deleted successfully...</div>';

                } else if (filter_input(INPUT_GET, 'message') == 'success3') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Student Suspended successfully...</div>';

                } else if (filter_input(INPUT_GET, 'message') == 'success4') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Student Enabled successfully...</div>';

                } else if (filter_input(INPUT_GET, 'message') == 'success5') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Student Updated successfully...</div>';

                } elseif (filter_input(INPUT_GET, 'message') == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                } elseif (filter_input(INPUT_GET, 'message') == 'failure2') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap, Upload Failure!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Current Students
                - <?php if (isset($_GET['batch-id'])) {

                    echo $_GET['stream-name'] . ' : ' . $_GET['batch-name'];

                } else {

                    echo $_GET['stream-name'];
                } ?></h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">

                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> Full Name</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Batch</th>
                                <th><i class="fa fa-bookmark"></i> Mobile Number</th>
                                <th><i class="fa fa-bookmark"></i> Email ID</th>
                                <th><i class="fa fa-bookmark"></i> Credentials</th>
                                <th><i class=" fa fa-edit"></i> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($student_fetch_query_result_row = mysqli_fetch_assoc($student_fetch_query_result)) {

                                echo '<tr>';
                                if ($student_fetch_query_result_row['status'] != 0) {

                                    echo '<td><a href="admin_student_profile_view.php?student-id=' . $student_fetch_query_result_row['student_id'] . '&stream-id=' . $_GET['stream-id'] . '&stream-name=' . $student_fetch_query_result_row['course_name'] . ' ' . $student_fetch_query_result_row['stream_name'] . '&full-name=' . $student_fetch_query_result_row['full_name'] . '&mobile-number=' . $student_fetch_query_result_row['mobile_number'] . '&email-address=' . $student_fetch_query_result_row['email_address'] . '&batch-number=' . $student_fetch_query_result_row['batch_number'] . '&additional-mobile-number=' . $student_fetch_query_result_row['additional_mobile'] . '&additional-email-address=' . $student_fetch_query_result_row['additional_email'] . '&photo=' . $student_fetch_query_result_row['photo'] . '">' . $student_fetch_query_result_row['full_name'] . '</a></td>';

                                } else {

                                    echo '<td><a href="#">' . $student_fetch_query_result_row['full_name'] . '</a></td>';
                                }
                                $batchSelectSql = "SELECT `batch_name` FROM `batchs` WHERE `batch_id`=" . $student_fetch_query_result_row['batch_number'];
                                $batchSelectSqlResult = $db_connection->query($batchSelectSql);
                                $batchSelectSqlResultRow = mysqli_fetch_assoc($batchSelectSqlResult);
                                echo '<td > ' . $batchSelectSqlResultRow['batch_name'] . ' </td >';
                                echo '<td>' . $student_fetch_query_result_row['mobile_number'] . '</td>
                                <td>' . $student_fetch_query_result_row['email_address'] . '</td>
                                <td>' . $student_fetch_query_result_row['username'] . ' - ' . $student_fetch_query_result_row['password'] . '</td>
                                <td>';
                                if ($student_fetch_query_result_row['status'] == '0') {

                                    echo ' <a href="admin_student_profile.php?student-id=' . $student_fetch_query_result_row['student_id'] . '&stream-id=' . $_GET['stream-id'] . '&stream-name=' . $student_fetch_query_result_row['course_name'] . ' ' . $student_fetch_query_result_row['stream_name'] . '&full-name=' . $student_fetch_query_result_row['full_name'] . '&mobile-number=' . $student_fetch_query_result_row['mobile_number'] . '&email-address=' . $student_fetch_query_result_row['email_address'] . '&batch-number=' . $student_fetch_query_result_row['batch_number'] . '&additional-mobile-number=' . $student_fetch_query_result_row['additional_mobile'] . '&additional-email-address=' . $student_fetch_query_result_row['additional_email'] . '&photo=' . $student_fetch_query_result_row['photo'] . '&target=verify"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button></a>
                                    <a href="' . basename($_SERVER["SCRIPT_FILENAME"]) . '?action=delete-student&student-id=' . $student_fetch_query_result_row['student_id'] . '&stream-id=' . $_GET['stream-id'] . '&stream-name=' . $student_fetch_query_result_row['course_name'] . ' ' . $student_fetch_query_result_row['stream_name'] . '"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></a>';

                                } else if ($student_fetch_query_result_row['status'] == '1') {

                                    echo '<a href="' . basename($_SERVER["SCRIPT_FILENAME"]) . '?action=enable-student&student-id=' . $student_fetch_query_result_row['student_id'] . '&stream-id=' . $_GET['stream-id'] . '&stream-name=' . $student_fetch_query_result_row['course_name'] . ' ' . $student_fetch_query_result_row['stream_name'] . '"><button class="btn btn-success btn-xs"><i class="fa fa-unlock"></i></button></a>';

                                } else if ($student_fetch_query_result_row['status'] == '2') {

                                    echo '<a href="' . basename($_SERVER["SCRIPT_FILENAME"]) . '?action=suspend-student&student-id=' . $student_fetch_query_result_row['student_id'] . '&stream-id=' . $_GET['stream-id'] . '&stream-name=' . $student_fetch_query_result_row['course_name'] . ' ' . $student_fetch_query_result_row['stream_name'] . '"><button class="btn btn-danger btn-xs"><i class="fa fa-lock" aria-hidden="true"></i></button></a>';
                                }
                                echo '</td>
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
