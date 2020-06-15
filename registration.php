<?php
include_once 'db_config.php';
if (isset($_POST['submit'])) {

//    echo 'from submission section';

    //TODO : Unique Mobile Number - db
    //TODO : Unique Email ID - db

    $full_name = $_POST['full_name'];
    $mobile_number = $_POST['mobile_number'];
    $email_address = $_POST['email_address'];
    $studying_class = $_POST['studying_class'];

    $student_insertion_sql = "INSERT INTO `students`(`full_name`, `mobile_number`, `email_address`, `studying_class`) VALUES ('$full_name','$mobile_number','$email_address','$studying_class')";

    $student_insertion_query_result = $db_connection->query($student_insertion_sql);
//    echo $student_insertion_query_result;

    if ($student_insertion_query_result == 1) {

        //Insertion Success
        header("Location: student.php?message=success");
        exit();

    } else {

//        echo $db_connection->error;
        //Insertion Failure
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=failure");
        exit();
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
            }
            ?>
            <div class="login-wrap">
                <input type="text" class="form-control" placeholder="Full Name" name="full_name" required autofocus>
                <br>
                <input type="number" class="form-control" placeholder="Mobile Number" name="mobile_number" required>
                <br>
                <input type="email" class="form-control" placeholder="Email Address" name="email_address" required>
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

                        echo '<option value="' . $course_fetch_query_result_row['stream_id'] . '">' . $course_fetch_query_result_row['course_name'] . ' ' . $course_fetch_query_result_row['stream_name'] . '</option>';
                    }
                    ?>
                </select>
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

</body>
</html>
