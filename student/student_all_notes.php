<?php
session_start();
include_once '../db_config.php';

if (!isset($_GET['subject-id'])) {

    header('Location: student.php');
    exit;
}

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['stream_id'])) {

    header('Location: student.php');
    exit;
}

$note_fetch_sql = "SELECT `note_id`, `teacher_id`, `title`, `description`, `file` FROM `notes` WHERE `subject_id`='" . $_GET['subject-id'] . "' AND `status`=0";
//echo $note_fetch_sql;

$note_fetch_query_result = $db_connection->query($note_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once '../admin/head_for_admin.php';
print_head("Student", "Notes");
?>

<body>

<section id="container">

    <?php
    include_once '../admin/header.php';
    print_header("student");

    include_once 'student_sidebar.php';
    print_student_sidebar($db_connection, $_SESSION['stream_id'], $_GET['subject-id']);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <h3>Notes : <?php echo $_GET['subject-name']; ?></h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <!--TODO: Include Teacher Name-->
                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> Sl. No</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Title</th>
                                <th><i class="fa fa-bookmark"></i> Description</th>
                                <th><i class="fa fa-bookmark"></i> File</th>
                                <th><i class=" fa fa-edit"></i> Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($note_fetch_query_result_row = mysqli_fetch_assoc($note_fetch_query_result)) {

                                echo '<tr>
                                <td>' . $i . '</td>
                                <td>' . $note_fetch_query_result_row['title'] . '</td>
                                <td>' . $note_fetch_query_result_row['description'] . '</td>
                                <td>' . $note_fetch_query_result_row['file'] . '</td><td>
                                <a href="../teacher/notes/' . $note_fetch_query_result_row['file'] . '"><button class="btn btn-success btn-xs"><i class="fa fa-check"></i></button></a>
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
