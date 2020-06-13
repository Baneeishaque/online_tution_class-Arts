<?php
include_once 'db_config.php';

if (isset($_POST['submit'])) {

//    echo 'from submission section';
//    var_dump($_POST);

    $stream_id = filter_input(INPUT_POST, 'stream-id');
    if ($stream_id == "NA") {

        //No Stream ID
        header("Location: add_subject.php?message=no-stream-id");
        exit();
    }

    $subject_name = filter_input(INPUT_POST, 'subject-name');

    $subject_insertion_sql = "INSERT INTO `subjects`(`stream_id`, `subject_name`) VALUES ('$stream_id','$subject_name')";

    $subject_insertion_query_result = $db_connection->query($subject_insertion_sql);

    if ($subject_insertion_query_result == 1) {

        //Insertion Success
        header("Location: add_subject.php?message=success");
        exit();

    } else {

        //Insertion Failure
        header("Location: add_subject.php?message=failure");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head.php';
print_head("Admin", "Add Subjects");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Courses", "Add Subjects");
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if ($_GET['message'] == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Subject Added successfully...</div>';

                } elseif ($_GET['message'] == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                } elseif ($_GET['message'] == 'no-stream-id') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Please Select Stream...</div>';
                }
            }
            ?>

            <h3>Add Subject</h3>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal tasi-form" method="post" action="add_subject.php">
                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Stream With Course</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="stream-id" required>
                                        <option value="NA">Select Please...</option>
                                        <?php

                                        $stream_fetch_sql = "SELECT `stream_id`, `stream_name`, `streams`.`course_id`,`course_name` FROM `streams`,`courses` WHERE `courses`.`course_id`=`streams`.`course_id` ORDER BY `course_name`,`stream_name`";

                                        $stream_fetch_query_result = $db_connection->query($stream_fetch_sql);

                                        while ($stream_fetch_query_result_row = mysqli_fetch_assoc($stream_fetch_query_result)) {

                                            echo '<option value="' . $stream_fetch_query_result_row['stream_id'] . '">' . $stream_fetch_query_result_row['course_name'] . ' ' . $stream_fetch_query_result_row['stream_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Subject Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" name="subject-name" required>
                                </div>
                            </div>

                            <br>
                            <div class="form-group has-error">

                                <center>
                                    <a href="add_subject.php">
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
    include_once 'footer.php';
    ?>
</section>

<?php
include_once 'scripts.php';
?>

</body>
</html>
