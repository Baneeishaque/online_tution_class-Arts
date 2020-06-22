<?php
session_start();
include_once '../db_config.php';
if (isset($_POST['submit'])) {

//    echo 'from form submission...';
//    var_dump($_POST);

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $teacher_login_sql = "SELECT `teachers`.`teacher_id`, `full_name`, `mobile_number`, `email_address`, `status`, `username`, `password`,`subjects`.`subject_id`,`subjects`.`subject_name`,`streams`.`stream_id`,`streams`.`stream_name`,`courses`.`course_id`,`courses`.`course_name` FROM `teachers`,`assigns`,`subjects`,`streams`,`courses` WHERE `assigns`.`teacher_id`=`teachers`.`teacher_id` AND `assigns`.`subject_id`=`subjects`.`subject_id` AND `subjects`.`stream_id`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id` AND `username`='$username' AND `password`='$password'";
//    echo $teacher_login_sql;

    $teacher_login_query_result = $db_connection->query($teacher_login_sql);
//    var_dump($teacher_login_query_result);

    if (mysqli_num_rows($teacher_login_query_result) == 0) {

        //No User
        //Or Teacher is not assigned a stream
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=no_user");
        exit();

    } else {

        $teacher_login_query_result_row = mysqli_fetch_assoc($teacher_login_query_result);

        //Goto Teacher Home
        $_SESSION['teacher_id'] = $teacher_login_query_result_row['teacher_id'];
        header("Location: teacher_all_notes.php?subject-id=" . $teacher_login_query_result_row['subject_id'] . "&subject-name=" . $teacher_login_query_result_row['subject_name'] . ' - ' . $teacher_login_query_result_row['course_name'] . ' ' . $teacher_login_query_result_row['stream_name']);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once '../admin/head_for_admin.php';
print_head("Teacher", "Authentication");
?>

<body>

<div id="login-page">
    <div class="container">

        <form class="form-login" action="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>" method="post">
            <h2 class="form-login-heading">authentication</h2>
            <?php
            if (isset($_GET['message'])) {

                if (filter_input(INPUT_GET, 'message') == 'no_user') {

                    echo '            <div class="alert alert-danger"><b>Oh snap!</b> Invalid credentials...</div>';
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
