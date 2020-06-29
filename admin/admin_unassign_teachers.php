<?php
include_once '../db_config.php';

if (isset($_POST['submit'])) {

//    echo 'from submission section';
//    var_dump($_POST);

    $subject_id = filter_input(INPUT_POST, 'subject_id');
    if ($subject_id == "NA") {

        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=no-subject");
        exit();
    }

    $teacher_id = filter_input(INPUT_POST, 'teacher_id');
    if ($teacher_id == "NA") {

        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=no-teacher");
        exit();
    }

    $teacher_unassign_sql = "DELETE FROM `assigns` WHERE `subject_id`='$subject_id' AND `teacher_id`='$teacher_id'";

    $teacher_unassign_query_result = $db_connection->query($teacher_unassign_sql);

    if ($teacher_unassign_query_result == 1) {

        //Insertion Success
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success");
        exit();

    } else {

        //Insertion Failure
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Admin", "Assign Teachers");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Teachers", "Unassign Teachers", $db_connection);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if (filter_input(INPUT_GET, 'message') == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Teacher Unassigned successfully...</div>';

                } elseif (filter_input(INPUT_GET, 'message') == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                } elseif (filter_input(INPUT_GET, 'message') == 'no-subject') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Please select subject...</div>';
                } elseif (filter_input(INPUT_GET, 'message') == 'no-teacher') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Please select teacher...</div>';
                }
            }
            ?>

            <h3>Unassign Teacher</h3>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal tasi-form" method="post"
                              action="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>">

                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Subject With Stream</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="subject_id" id="subject_id">
                                        <option value="NA">Select Please...</option>
                                        <?php

                                        $subject_fetch_sql = "SELECT DISTINCT `assigns`.`subject_id`,`courses`.`course_name`,`streams`.`stream_name`, `subject_name` FROM `assigns`,`subjects`,`streams`,`courses` WHERE `assigns`.`subject_id`=`subjects`.`subject_id` AND `subjects`.`stream_id`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id`";

                                        $subject_fetch_query_result = $db_connection->query($subject_fetch_sql);

                                        while ($subject_fetch_query_result_row = mysqli_fetch_assoc($subject_fetch_query_result)) {

                                            echo '<option value="' . $subject_fetch_query_result_row['subject_id'] . '">' . $subject_fetch_query_result_row['subject_name'] . ' - ' . $subject_fetch_query_result_row['course_name'] . ' ' . $subject_fetch_query_result_row['stream_name'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Teacher</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="teacher_id" id="teacher_id" disabled>
                                        <option value="NA">Select Please...</option>
                                    </select>
                                </div>
                            </div>

                            <br>
                            <div class="form-group has-error">

                                <center>
                                    <a href="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>">
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

<script>
    $(document).ready(function () {

        // alert("from script section...");
        $('#subject_id').on('change', function () {

            // alert("from script section...");
            //get selected value from category drop down
            const subjectId = $(this).val();

            //select subcategory drop down
            const assignedTeachers = $('#teacher_id');

            if (subjectId !== "NA") {

                $.get("getAssigns.php?subject-id=" + subjectId, function (response) {

                    console.log("Response : " + response);
                    const assigns = JSON.parse(response);
                    console.log("Assigns Count : " + assigns.length);
                    assignedTeachers.empty();

                    if (assigns.length > 0) {

                        assignedTeachers.append($("<option />").val("NA").text("Select Please..."));
                        assignedTeachers.prop('disabled', false);
                    }

                    for (let i = 0; i < assigns.length; i++) {

                        console.log("Assigned Teacher ID : " + assigns[i].teacher_id);
                        console.log("Assigned Teacher Name : " + assigns[i].full_name);
                        assignedTeachers.append($("<option />").val(assigns[i].teacher_id).text(assigns[i].full_name + " - " + assigns[i].mobile_number));
                    }

                });

            } else {
                // disable sub-category drop down
                assignedTeachers.prop('disabled', 'disabled');
            }
        });
    });
</script>

</body>
</html>
