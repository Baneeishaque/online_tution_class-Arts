<?php
include_once '../db_config.php';

if (isset($_GET['action'])) {

    if (filter_input(INPUT_GET, 'action') == 'enable-teacher') {

        $student_id = filter_input(INPUT_GET, 'teacher-id');

        $student_update_sql = "UPDATE `teachers` SET `status`=1 WHERE `teacher_id`='$student_id'";

        $student_update_query_result = $db_connection->query($student_update_sql);

        if ($student_update_query_result == 1) {

            //Update Success
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success");
            exit();

        } else {

            //Update Failure
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure");
            exit();
        }
    }
}

$teacher_fetch_sql = "SELECT `teacher_id`, `full_name`, `mobile_number` FROM `teachers` WHERE `status` = 2";
//echo $teacher_fetch_sql;

$teacher_fetch_query_result = $db_connection->query($teacher_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Admin", "Suspended Teachers");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Teachers", "Suspended Teachers", $db_connection);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if (filter_input(INPUT_GET, 'message') == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Teacher Enabled successfully...</div>';

                } elseif (filter_input(INPUT_GET, 'message') == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Suspended Teachers</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">

                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> Sl. No.</th>
                                <th><i class="fa fa-bullhorn"></i> Full Name</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i>Assigned Courses</th>
                                <th><i class="fa fa-bookmark"></i> Mobile Number</th>
                                <th><i class=" fa fa-edit"></i> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($teacher_fetch_query_result_row = mysqli_fetch_assoc($teacher_fetch_query_result)) {

                                $assigned_courses_sql = "SELECT `subjects`.`subject_name`,`streams`.`stream_name`,`courses`.`course_name` FROM `assigns`,`subjects`,`streams`,`courses` WHERE `assigns`.`subject_id`=`subjects`.`subject_id` AND `subjects`.`stream_id`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id` AND `teacher_id`='" . $teacher_fetch_query_result_row['teacher_id'] . "'";

                                $assigned_courses_sql_result = $db_connection->query($assigned_courses_sql);
                                $assigned_courses = "";

                                if (mysqli_num_rows($assigned_courses_sql_result) > 0) {

                                    $j = 1;
                                    while ($assigned_courses_sql_result_row = mysqli_fetch_assoc($assigned_courses_sql_result)) {

                                        if ($j != 1) {

                                            $assigned_courses = $assigned_courses . ", ";
                                        }

                                        $assigned_courses = $assigned_courses . $assigned_courses_sql_result_row['subject_name'] . ' - ' . $assigned_courses_sql_result_row['course_name'] . ' ' . $assigned_courses_sql_result_row['stream_name'];

                                        $j++;
                                    }
                                }
                                echo '<tr>
                                <td>' . $i . '</td>
                                <td><a href="#">' . $teacher_fetch_query_result_row['full_name'] . '</a></td>
                                <td>' . $assigned_courses . ' </td >
                                <td > ' . $teacher_fetch_query_result_row['mobile_number'] . ' </td >
                                <td><a href="' . basename($_SERVER["SCRIPT_FILENAME"]) . '?action=enable-teacher&teacher-id=' . $teacher_fetch_query_result_row['teacher_id'] . '"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button></a></td>
                            </tr > ';
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
