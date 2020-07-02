<?php

include_once 'db_config.php';

$hasValues = false;

if (isset($_GET['has-values']) && $_GET['has-values'] == "true") {

    $hasValues = true;
//    var_dump($_GET);
}
if (isset($_POST['submit'])) {

//    echo 'from submission section';
//    var_dump($_POST);

    $full_name = $_POST['full_name'];
    $mobile_number = $_POST['mobile_number'];
    $email_address = $_POST['email_address'];
    $studying_class = $_POST['studying_class'];
    $studying_batch = $_POST['studying_batch'];

    if ($studying_class == "NA") {

        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=no-stream&has-values=true&full_name=" . $full_name . "&mobile_number=" . $mobile_number . "&email_address=" . $email_address . "&studying_class=" . $studying_class);
        exit();
    }

    $batch_sql = "SELECT `batch_id` FROM `batchs` WHERE `stream_id`='$studying_class'";
    $batch_sql_result = $db_connection->query($batch_sql);
//    var_dump($batch_sql_result);
    if (mysqli_num_rows($batch_sql_result) > 0 && $studying_batch == "NA") {

        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=no-batch&has-values=true&full_name=" . $full_name . "&mobile_number=" . $mobile_number . "&email_address=" . $email_address . "&studying_class=" . $studying_class);
        exit();
    }

    $student_insertion_sql = "INSERT INTO `students`(`full_name`, `mobile_number`, `email_address`, `studying_class`,`batch_number`) VALUES ('$full_name','$mobile_number','$email_address','$studying_class','$studying_batch')";

    $student_insertion_query_result = $db_connection->query($student_insertion_sql);
//    echo $student_insertion_query_result;

    if ($student_insertion_query_result == 1) {

        //Insertion Success
        header("Location: student/student.php?message=success");
        exit();

    } else {

//        echo $db_connection->error;
        //Insertion Failure

        if (strpos($db_connection->error, "Duplicate entry") !== false) {

            if (strpos($db_connection->error, "mobile_number") !== false) {

                header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=duplicate-mobile&has-values=true&full_name=" . $full_name . "&mobile_number=" . $mobile_number . "&email_address=" . $email_address . "&studying_class=" . $studying_class);
                exit();

            } else if (strpos($db_connection->error, "email_address") !== false) {

                header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=duplicate-email&has-values=true&full_name=" . $full_name . "&mobile_number=" . $mobile_number . "&email_address=" . $email_address . "&studying_class=" . $studying_class);
                exit();
            }

        } else {

            header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure&has-values=true&full_name=" . $full_name . "&mobile_number=" . $mobile_number . "&email_address=" . $email_address . "&studying_class=" . $studying_class);
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head.php';
print_head("Student", "Registration");
?>

<body>

<div id="login-page">
    <div class="container">

        <form class="form-login" action="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>" method="post">
            <h2 class="form-login-heading">Register Now</h2>
            <?php
            if (isset($_GET['message']) && $_GET['message'] == 'failure') {

                echo '            <div class="alert alert-danger"><b>Oh snap!</b> Change a few things up and try submitting again...</div>';

            } else if (isset($_GET['message']) && $_GET['message'] == 'no-batch') {

                echo '            <div class="alert alert-danger"><b>Oh snap!</b> Select your batch and try submitting again...</div>';

            } else if (isset($_GET['message']) && $_GET['message'] == 'no-stream') {

                echo '            <div class="alert alert-danger"><b>Oh snap!</b> Select your stream and try submitting again...</div>';

            } else if (isset($_GET['message']) && $_GET['message'] == 'duplicate-mobile') {

                echo '            <div class="alert alert-danger"><b>Oh snap!</b> Check your Mobile Number, it is already registered...</div>';

            } else if (isset($_GET['message']) && $_GET['message'] == 'duplicate-email') {

                echo '            <div class="alert alert-danger"><b>Oh snap!</b> Check your Email ID, it is already registered...</div>';
            }
            ?>
            <div class="login-wrap">
                <input type="text" class="form-control" placeholder="Full Name" name="full_name" required
                       autofocus <?php if ($hasValues) {

                    echo "value=\"" . filter_input(INPUT_GET, 'full_name') . "\"";
                } ?>>
                <br>
                <input type="number" class="form-control" placeholder="Mobile Number" name="mobile_number"
                       required <?php if ($hasValues) {

                    echo "value=\"" . $_GET['mobile_number'] . "\"";
                } ?>>
                <br>
                <input type="email" class="form-control" placeholder="Email Address" name="email_address"
                       required <?php if ($hasValues) {

                    echo "value=\"" . $_GET['email_address'] . "\"";
                } ?>>
                <br>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Course</label>
                </div>
                <select class="form-control" name="studying_class" id="studying_course">
                    <option value="NA">Select Please...</option>
                    <?php

                    $course_fetch_sql = "SELECT `stream_id`, `stream_name`, `streams`.`course_id`,`course_name` FROM `streams`,`courses` WHERE `courses`.`course_id`=`streams`.`course_id` ORDER BY `course_name`,`stream_name`";

                    $course_fetch_query_result = $db_connection->query($course_fetch_sql);

                    while ($course_fetch_query_result_row = mysqli_fetch_assoc($course_fetch_query_result)) {

                        if ($hasValues && $course_fetch_query_result_row['stream_id'] == $_GET['studying_class']) {

                            echo '<option value="' . $course_fetch_query_result_row['stream_id'] . '" selected>' . $course_fetch_query_result_row['course_name'] . ' ' . $course_fetch_query_result_row['stream_name'] . '</option>';

                        } else {

                            echo '<option value="' . $course_fetch_query_result_row['stream_id'] . '">' . $course_fetch_query_result_row['course_name'] . ' ' . $course_fetch_query_result_row['stream_name'] . '</option>';
                        }
                    }
                    ?>
                </select>
                <br>

                <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Batch</label>
                </div>

                <?php

                if ($hasValues) {

                    $batch_fetch_sql = "SELECT `batch_id`, `batch_name` FROM `batchs` WHERE `stream_id`='" . $_GET['studying_class'] . "'";
//                    echo $batch_fetch_sql;
                    $batchFetchQueryResult = $db_connection->query($batch_fetch_sql);
//                    var_dump($batchFetchQueryResult);

                    if (mysqli_num_rows($batchFetchQueryResult) > 0) {

                        echo '<select class="form-control" name="studying_batch" id="studying_batch">
                                <option value="NA">Select Please...</option>';
                        while ($batchFetchQueryResultRow = mysqli_fetch_assoc($batchFetchQueryResult)) {

                            echo '<option value="' . $batchFetchQueryResultRow['batch_id'] . '">' . $batchFetchQueryResultRow['batch_name'] . '</option>';
                        }
                    } else {

                        echo '<select class="form-control" name="studying_batch" id="studying_batch" disabled>';
                    }
                    echo '</select>';

                } else {
                    echo '                <select class="form-control" name="studying_batch" id="studying_batch" disabled>
                        <option value="NA">Select Please...</option>
                      </select>';
                }
                ?>
                <br>

                <button class="btn btn-theme btn-block" type="submit" name="submit"><i class="fa fa-lock"></i> Register
                </button>
                <hr>

                <div class="registration">
                    Already have an account?<br/>
                    <a class="" href="student/student.php">
                        Login to your account
                    </a>
                </div>

            </div>

        </form>

    </div>
</div>

<?php
include_once 'index_scripts.php';
include_once 'backstrech.php';
?>

<script>
    $(document).ready(function () {
        $('#studying_course').on('change', function () {

            // alert("from script section...");
            //get selected value from category drop down
            const studyingCourse = $(this).val();

            //select subcategory drop down
            const studyingBatch = $('#studying_batch');

            if (studyingCourse !== "NA") {

                $.get("getBatches.php?stream-id=" + studyingCourse, function (response) {

                    console.log("Response : " + response);
                    const batches = JSON.parse(response);
                    console.log("Batches Count : " + batches.length);
                    studyingBatch.empty();

                    if (batches.length > 0) {

                        studyingBatch.append($("<option />").val("NA").text("Select Please..."));
                        studyingBatch.prop('disabled', false);
                    }

                    for (let i = 0; i < batches.length; i++) {

                        console.log("Batch ID : " + batches[i].batch_id);
                        console.log("Batch NAME : " + batches[i].batch_name);
                        studyingBatch.append($("<option />").val(batches[i].batch_id).text(batches[i].batch_name));
                    }

                });

            } else {
                // disable sub-category drop down
                studyingBatch.prop('disabled', 'disabled');
            }
        });
    });
</script>

</body>
</html>
