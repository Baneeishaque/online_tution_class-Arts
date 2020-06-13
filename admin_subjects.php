<?php
include_once 'db_config.php';

if (isset($_GET['action'])) {

//    if ($_GET['action'] == 'delete-subject') {
//
//        $subject_id = $_GET['subject-id'];
//
//        $student_fetch_sql="SELECT `subject_id` FROM `subjects`,`students` WHERE `subjects`.`stream_id`=`students`.`studying_class` AND `subject_id`='$subject_id'";
//        $student_fetch_sql_result=$db_connection->query($student_fetch_sql);
//        if(mysqli_num_rows($student_fetch_query_result)!=0){
//
//            //There are students
//            header("Location: admin_subjects.php?message=still-students");
//            exit();
//        }
//
//        $subject_delete_sql = "DELETE FROM `subjects` WHERE `subject_id`='$subject_id'";
//        $subject_delete_query_result = $db_connection->query($subject_delete_sql);
//        if ($subject_delete_query_result == 1) {
//
//            //Delete Success
//            header("Location: admin_subjects.php?message=success");
//            exit();
//
//        } else {
//
//            //Delete Failure
//            header("Location: admin_subjects.php?message=failure");
//            exit();
//        }
//    }
}

$subject_fetch_sql = "SELECT `subject_id`,`courses`.`course_name`,`streams`.`stream_name`, `subject_name` FROM `subjects`,`streams`,`courses` WHERE `subjects`.`stream_id`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id`";

$subject_fetch_query_result = $db_connection->query($subject_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head.php';
print_head("Admin", "All Subjects");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Courses", "All Subjects");
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if ($_GET['message'] == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Subject Deleted successfully...</div>';

                } elseif ($_GET['message'] == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';

                } elseif ($_GET['message'] == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> There are registered students for this subject...</div>';
                }
            }
            ?>

            <h3>Current Subjects</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">

                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> Sl. No.</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Subject Name With Stream
                                    & Course
                                </th>
                                <th><i class=" fa fa-edit"></i> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($subject_fetch_query_result_row = mysqli_fetch_assoc($subject_fetch_query_result)) {

                                echo '<tr>
                                <td>' . $i . '</td>
                                <td>' . $subject_fetch_query_result_row['subject_name'] . ' - ' . $subject_fetch_query_result_row['course_name'] . ' ' . $subject_fetch_query_result_row['stream_name'] . '</td>
                                <td>
                                      <a href="admin_subjeccts.php?action=delete-subject&subject-id=' . $subject_fetch_query_result_row['subject_id'] . '"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a>
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
