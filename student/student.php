<?php
session_start();
include_once '../db_config.php';
if (isset($_POST['submit'])) {

//    echo 'from submission section';
//    var_dump($_POST);

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $student_login_sql = "SELECT `student_id`, `full_name`, `mobile_number`, `email_address`, `studying_class`, `status`, `username`, `password` FROM `students` WHERE `username`='$username' AND `password`='$password'";
//    echo $student_login_sql;

    $student_login_query_result = $db_connection->query($student_login_sql);
//    var_dump($student_login_query_result);

    if (mysqli_num_rows($student_login_query_result) == 0) {

        //No User
        header("Location:  " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=no_user");
        exit();

    } else {

        $student_login_query_result_row = mysqli_fetch_assoc($student_login_query_result);
//        var_dump($student_login_query_result_row);
        if ($student_login_query_result_row['status'] == 0) {

            //Unverified User
            header("Location:  " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=unverified_user");
            exit();

        } else if ($student_login_query_result_row['status'] == 2) {

            //Unverified User
            header("Location:  " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=suspended_user");
            exit();

        } else {

            //Goto Home
            $_SESSION['stream_id'] = $student_login_query_result_row['studying_class'];
            $subject_fetch_sql = "SELECT `subject_id`,`subject_name`,`streams`.`stream_name`,`courses`.`course_name` FROM `subjects`,`streams`,`courses` WHERE `subjects`.`stream_id`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id` AND `subjects`.`stream_id`=" . $_SESSION['stream_id'];
            $subject_fetch_sql_result = $db_connection->query($subject_fetch_sql);
            $subject_fetch_sql_result_row = mysqli_fetch_assoc($subject_fetch_sql_result);
            header("Location: student_all_notes.php?subject-id=" . $subject_fetch_sql_result_row['subject_id'] . "&subject-name=" . $subject_fetch_sql_result_row['subject_name'] . " - " . $subject_fetch_sql_result_row['course_name'] . " " . $subject_fetch_sql_result_row['stream_name']);
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once '../admin/head_for_admin.php';
print_head("Student", "Authentication");
?>

<body>

<div id="login-page">
    <div class="container">

        <form class="form-login" action="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>" method="post">
            <h2 class="form-login-heading">sign in now</h2>
            <?php
            if (isset($_GET['message'])) {

                if ($_GET['message'] == 'success') {

                    echo '            <div class="alert alert-success"><b>Well done!</b> You have successfully registered, please wait for confirmation...</div>';

                } else if ($_GET['message'] == 'no_user') {

                    echo '            <div class="alert alert-danger"><b>Oh snap!</b> Invalid credentials...</div>';

                } else if ($_GET['message'] == 'unverified_user') {

                    echo '<div class="alert alert-warning"><b>Warning!</b> Better check yourself, you\'re not verified yet...</div>';

                } else if ($_GET['message'] == 'suspended_user') {

                    echo '<div class="alert alert-warning"><b>Warning!</b> Better check with authorities, you\'re suspended...</div>';
                }
            }
            ?>
            <div class="login-wrap">
                <input type="text" class="form-control" placeholder="User ID" name="username" required autofocus>
                <br>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <br>

                <button class="btn btn-theme btn-block" type="submit" name="submit"><i class="fa fa-lock"></i> Sign In
                </button>
                <hr>

                <div class="registration">
                    Don't have an account yet?<br/>
                    <a class="" href="../registration.php">
                        Create an account
                    </a>
                </div>

            </div>

        </form>

    </div>
</div>

<?php
include_once '../admin/index_scripts_for_admin.php';
include_once '../admin/backstrech_for_admin.php'
?>

</body>
</html>
