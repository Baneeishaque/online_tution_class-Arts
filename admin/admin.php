<?php
include_once '../db_config.php';
if (isset($_POST['submit'])) {

//    echo 'from submission section';
//    var_dump($_POST);

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $admin_login_sql = "SELECT `admin_id`, `username`, `passowrd` FROM `admin` WHERE `username`='$username' AND `passowrd`='$password'";

    $admin_login_query_result = $db_connection->query($admin_login_sql);

    if (mysqli_num_rows($admin_login_query_result) == 0) {

        //No User
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=no_user");
        exit();

    } else {

        //Goto Admin Home
        header("Location: admin_current_teachers.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Administrator", "Authentication");
?>

<body>

<div id="login-page">
    <div class="container">

        <form class="form-login" action="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>" method="post">
            <h2 class="form-login-heading">authentication</h2>
            <?php
            if (isset($_GET['message'])) {

                if ($_GET['message'] == 'no_user') {

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
include_once 'index_scripts_for_admin.php';
include_once 'backstrech_for_admin.php'
?>

</body>
</html>
