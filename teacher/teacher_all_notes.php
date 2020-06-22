<?php
session_start();
include_once '../db_config.php';

if (!isset($_GET['subject-id'])) {

    header('Location: teacher.php');
    exit;
}

if (isset($_GET['action'])) {

    if (filter_input(INPUT_GET, 'action') == 'delete-note') {

        $student_id = filter_input(INPUT_GET, 'note-id');

        $student_update_sql = "UPDATE `notes` SET `status`=1 WHERE `note_id`='$student_id'";

//        echo $student_update_sql;

        $student_update_query_result = $db_connection->query($student_update_sql);

        if ($student_update_query_result == 1) {

            //Update Success
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success&subject-id=" . $_GET['subject-id'] . "&subject-name" . $_GET['subject-name']);
            exit();

        } else {

            //Update Failure
            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure&subject-id=" . $_GET['subject-id'] . "&subject-name" . $_GET['subject-name']);
            exit();
        }
    }
    if (filter_input(INPUT_GET, 'action') == 'edit-note') {

//        header("Location: teacher_edit_notes.php?subject-id=" . $_GET['subject-id'] . "&subject-name=" . $_GET['subject-name']);
//        exit();
    }
}

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['teacher_id'])) {

    header('Location: teacher.php');
    exit;
}

$student_fetch_sql = "SELECT `note_id`, `notes`.`teacher_id`, `notes`.`subject_id`, `title`, `description`, `file`,`subjects`.`subject_name`,`courses`.`course_id`,`courses`.`course_name`,`streams`.`stream_id`,`streams`.`stream_name` FROM `notes`,`subjects`,`streams`,`courses` WHERE `notes`.`subject_id`=`subjects`.`subject_id` AND `subjects`.`stream_id`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id` AND `notes`.`status`=0 AND `notes`.`teacher_id`='" . $_SESSION['teacher_id'] . "' AND `notes`.`subject_id`=" . $_GET['subject-id'] . "";
//echo $student_fetch_sql;

$student_fetch_query_result = $db_connection->query($student_fetch_sql);
//echo $student_fetch_query_result;
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once '../admin/head_for_admin.php';
print_head("Teacher", "Notes");
?>

<body>

<section id="container">

    <?php
    include_once '../admin/header.php';
    print_header("teacher");

    include_once 'teacher_sidebar.php';
    print_teacher_sidebar($db_connection, $_SESSION['teacher_id'], $_GET['subject-id'], "All Notes");
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if (filter_input(INPUT_GET, 'message') == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Note Deleted successfully...</div>';

                } elseif (filter_input(INPUT_GET, 'message') == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Notes : <?php echo $_GET['subject-name']; ?></h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">

                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> Sl. No</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Course</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Title</th>
                                <th><i class="fa fa-bookmark"></i> Description</th>
                                <th><i class="fa fa-bookmark"></i> File</th>
                                <th><i class=" fa fa-edit"></i> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($student_fetch_query_result_row = mysqli_fetch_assoc($student_fetch_query_result)) {

                                echo '<tr>
                                <td>' . $i . '</td>
                                <td>' . $student_fetch_query_result_row['subject_name'] . ' - ' . $student_fetch_query_result_row['course_name'] . ' ' . $student_fetch_query_result_row['stream_name'] . '</td>
                                <td>' . $student_fetch_query_result_row['title'] . '</td>
                                <td>' . $student_fetch_query_result_row['description'] . '</td>
                                <td>' . $student_fetch_query_result_row['file'] . '</td>
                                <td>
                                    <a href="notes/' . $student_fetch_query_result_row['file'] . '"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button></a>
                                     <a href="' . basename($_SERVER["SCRIPT_FILENAME"]) . '?action=edit-note&note-id=' . $student_fetch_query_result_row['note_id'] . '&subject-id=' . $_GET['subject-id'] . '&subject-name=' . $_GET['subject-name'] . '"><button class="btn btn-warning btn-xs"><i class="fa fa fa-pencil"></i></button></a>
                                     <a href="' . basename($_SERVER["SCRIPT_FILENAME"]) . '?action=delete-note&note-id=' . $student_fetch_query_result_row['note_id'] . '&subject-id=' . $_GET['subject-id'] . '&subject-name=' . $_GET['subject-name'] . '"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></a>

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
    include_once '../admin/footer.php';
    ?>

</section>

<?php
include_once '../admin/scripts.php';
?>

</body>
</html>
