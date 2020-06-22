<?php
include_once '../db_config.php';

function checkExistingUsername($dbConnection)
{
    $random_number = rand(0, 999);
    $studentFetchSql = "SELECT `teacher_id` FROM `teachers` WHERE `username`='teacher$random_number'";
    $studentFetchSqlResult = $dbConnection->query($studentFetchSql);
    if (mysqli_num_rows($studentFetchSqlResult) != 0) {

        checkExistingUsername($dbConnection);

    } else {

        return $random_number;
    }
}

if (isset($_POST['submit'])) {

    //TODO : Unique Mobile Number - db
    //TODO : Unique Email ID - db

    $full_name = filter_input(INPUT_POST, 'full_name');
    $mobile_number = filter_input(INPUT_POST, 'mobile_number');
    $email_address = filter_input(INPUT_POST, 'email_address');

    $random_number = checkExistingUsername($db_connection);
    $teacher_insertion_sql = "INSERT INTO `teachers`(`full_name`, `mobile_number`, `email_address`,`status`,`username`,`password`) VALUES ('$full_name','$mobile_number','$email_address',1,'teacher$random_number','password$random_number')";

    $teacher_insertion_query_result = $db_connection->query($teacher_insertion_sql);

    if ($teacher_insertion_query_result == 1) {

        //Insertion Success
        header("Location: " . basename($_SERVER["SCRIPT_FILENAME"]) . "?message=success&random=$random_number");
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
print_head("Admin", "Add Teachers");
?>
<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Teachers", "All Teachers", $db_connection);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <?php
            if (isset($_GET['message'])) {

                if ($_GET['message'] == 'success') {

                    echo '<br>
            <div class="alert alert-success"><b>Well done!</b> Teacher Added successfully, Credentials : teacher' . $_GET['random'] . ' & password' . $_GET['random'] . '</div>';

                } elseif ($_GET['message'] == 'failure') {

                    echo '<br>
            <div class="alert alert-danger"><b>Oh snap!</b> Try Again...</div>';
                }
            }
            ?>

            <h3>Add Teacher</h3>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal tasi-form" method="post"
                              action="<?php echo basename($_SERVER["SCRIPT_FILENAME"]); ?>">
                            <div class="form-group has-success">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Full Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputSuccess" name="full_name" required>
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Mobile Number</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputError" name="mobile_number"
                                           required>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label class="col-sm-2 control-label col-lg-2" for="inputWarning">Email Address</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" id="inputWarning" name="email_address"
                                           required>
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

</body>
</html>
