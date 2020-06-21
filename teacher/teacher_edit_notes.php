<?php
session_start();

//var_dump($_GET);

include_once '../db_config.php';

if (!isset($_GET['subject-id'])) {

    header('Location: teacher.php');
    exit;
}

if (isset($_POST['submit'])) {

//    echo 'from submission section';

    $subject_id = $_POST['subject_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $note_file = $_POST['note_file'];

    $target_dir = "notes/";
    $file_name = $_FILES["note_file"]["name"];
    $target_file = $target_dir . basename($_FILES["note_file"]["name"]);
    move_uploaded_file($_FILES["note_file"]["tmp_name"], $target_file);

    $student_insertion_sql = "INSERT INTO `notes`(`teacher_id`, `subject_id`, `title`, `description`, `file`) VALUES ('" . $_SESSION['teacher_id'] . "','$subject_id','$title','$description','$file_name')";
//    echo $student_insertion_sql;

    $student_insertion_query_result = $db_connection->query($student_insertion_sql);
//    echo $student_insertion_query_result;

    if ($student_insertion_query_result == 1) {

        //Insertion Success
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success&subject-id=" . $_GET['subject-id'] . "&subject-name" . $_GET['subject-name']);
        exit();

    } else {

        //Insertion Failure
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure&subject-id=" . $_GET['subject-id'] . "&subject-name" . $_GET['subject-name']);
        exit();
    }
}

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['teacher_id'])) {

    header('Location: teacher.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once '../admin/head_for_admin.php';
print_head("Teacher", "Edit Notes");
?>

<body>

<section id="container">

    <?php
    include_once '../admin/header.php';
    print_header("teacher");

    include_once 'teacher_sidebar.php';
    print_teacher_sidebar($db_connection, $_SESSION['teacher_id'], $_GET['subject-id'], "Upload Notes");
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if ($_GET['message'] == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Note Updated successfully...';

                } elseif ($_GET['message'] == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Add Notes : <?php echo $_GET['subject-name']; ?></h3>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal tasi-form" method="post"
                              action="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>?subject-id=<?php echo $_GET['subject-id']; ?>&subject-name=<?php echo $_GET['subject-name']; ?>"
                              enctype="multipart/form-data">
                            <input type="hidden" name="subject_id" value="<?php echo $_GET['subject-id']; ?>">
                            <div class="form-group has-success">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Subject With
                                    Stream</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputSuccess" name="course_name"
                                           value="<?php echo $_GET['subject-name']; ?>"
                                           required disabled>
                                </div>
                            </div>
                            <div class="form-group has-success">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Title</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputSuccess" name="title" required>
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Description</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputError" name="description">
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">File</label>
                                <div class="col-lg-10">
                                    <input type="file" class="form-control" id="inputError" name="note_file" required>
                                </div>
                            </div>
                            <br>
                            <div class="form-group has-error">

                                <center>
                                    <a href="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>?subject-id=<?php echo $_GET['subject-id']; ?>&subject-name=<?php echo $_GET['subject-name']; ?>">
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
    include_once '../admin/footer.php';
    ?>

</section>

<?php
include_once '../admin/scripts.php';
?>

</body>
</html>
