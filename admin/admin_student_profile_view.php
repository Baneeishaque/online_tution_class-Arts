<?php
include_once '../db_config.php';
//var_dump($_GET);

if ((!isset($_GET['student-id'])) || (!isset($_GET['stream-id'])) || (!isset($_GET['full-name'])) || (!isset($_GET['mobile-number'])) || (!isset($_GET['email-address'])) || (!isset($_GET['batch-number']))) {

    header('Location: admin_current_teachers.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Admin", "View Student");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Students", $_GET['stream-id'], $db_connection);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <!--            <h3>View Student - --><?php //echo $_GET['full-name']; ?><!--</h3>-->
            <?php

            if (isset($_GET['photo'])) {

                echo '<p class="centered"><a href="#"><img src="photos/' . $_GET['photo'] . '" width="100"></a></p>';

            } else {

                echo '<p class="centered"><a href="#"><img src="../assets/img/logo.jpg" width="100"></a></p>';
            }
            ?>

            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <form class="form-horizontal tasi-form" method="post"
                              action="<?php echo basename($_SERVER["SCRIPT_FILENAME"]) . '?student-id=' . $_GET['student-id'] . '&stream-id=' . $_GET['stream-id'] . '&stream-name=' . $_GET['stream-name'] . '&full-name=' . $_GET['full-name'] . '&mobile-number=' . $_GET['mobile-number'] . '&email-address=' . $_GET['email-address'] . '&batch-number=' . $_GET['batch-number']; ?>"
                              enctype="multipart/form-data">
                            <div class="form-group has-success">
                                <label class="col-sm-2 control-label col-lg-2" for="inputSuccess">Full Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="inputSuccess" name="full_name" required
                                           value="<?php echo $_GET['full-name']; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Mobile Number</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" id="inputError" name="mobile_number"
                                           required value="<?php echo $_GET['mobile-number']; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Additional Mobile
                                    Numbers</label>
                                <div class="col-lg-10">
                                    <input type="number" class="form-control" id="inputError"
                                           name="additional_mobile_number"
                                           value="<?php if (isset($_GET['additional-mobile-number'])) {
                                               echo $_GET['additional-mobile-number'];
                                           } ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group has-warning">
                                <label class="col-sm-2 control-label col-lg-2" for="inputWarning">Email Address</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" id="inputWarning" name="email_address"
                                           required value="<?php echo $_GET['email-address']; ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Additional Email
                                    IDs</label>
                                <div class="col-lg-10">
                                    <input type="email" class="form-control" id="inputError"
                                           name="additional_email_address"
                                           value="<?php if (isset($_GET['additional-email-address'])) {
                                               echo $_GET['additional-email-address'];
                                           } ?>" disabled>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Stream</label>
                                <div class="col-lg-10">
                                    <select class="form-control" name="studying_class" disabled>
                                        <option value="NA">Select Please...</option>
                                        <?php

                                        $course_fetch_sql = "SELECT `stream_id`, `stream_name`, `streams`.`course_id`,`course_name` FROM `streams`,`courses` WHERE `courses`.`course_id`=`streams`.`course_id` ORDER BY `course_name`,`stream_name`";

                                        $course_fetch_query_result = $db_connection->query($course_fetch_sql);

                                        while ($course_fetch_query_result_row = mysqli_fetch_assoc($course_fetch_query_result)) {

                                            if ($course_fetch_query_result_row['stream_id'] == $_GET['stream-id']) {

                                                echo '<option value="' . $course_fetch_query_result_row['stream_id'] . '" selected>' . $course_fetch_query_result_row['course_name'] . ' ' . $course_fetch_query_result_row['stream_name'] . '</option>';
                                            } else {

                                                echo '<option value="' . $course_fetch_query_result_row['stream_id'] . '">' . $course_fetch_query_result_row['course_name'] . ' ' . $course_fetch_query_result_row['stream_name'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Batch</label>
                                <div class="col-lg-10">

                                    <?php

                                    $batchSelectSql = "SELECT `batch_id`,`batch_name` FROM `batchs` WHERE `stream_id`=" . $_GET['stream-id'];
                                    $batchSelectSqlResult = $db_connection->query($batchSelectSql);
                                    if (mysqli_num_rows($batchSelectSqlResult) == 0) {

                                        echo '<select class="form-control" name="batch_number" disabled></select>';

                                    } else {

                                        echo '<select class="form-control" name="batch_number" disabled>';
                                        echo '  <option value="NA">Select Please...</option>';

                                        while ($batchSelectSqlResultRow = mysqli_fetch_assoc($batchSelectSqlResult)) {

                                            if ($batchSelectSqlResultRow['batch_id'] == $_GET['batch-number']) {

                                                echo '<option value="' . $batchSelectSqlResultRow['batch_id'] . '" selected>' . $batchSelectSqlResultRow['batch_name'] . '</option>';

                                            } else {

                                                echo '<option value="' . $batchSelectSqlResultRow['batch_id'] . '">' . $batchSelectSqlResultRow['batch_name'] . '</option>';
                                            }
                                        }
                                        echo '</select>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <br>
                            <div class="form-group has-error">
                                <center>
                                    <a href="<?php echo 'admin_student_profile.php?student-id=' . $_GET['student-id'] . '&stream-id=' . $_GET['stream-id'] . '&stream-name=' . $_GET['stream-name'] . '&full-name=' . $_GET['full-name'] . '&mobile-number=' . $_GET['mobile-number'] . '&email-address=' . $_GET['email-address'] . '&batch-number=' . $_GET['batch-number'] . '&additional-mobile-number=' . $_GET['additional-mobile-number'] . '&additional-email-address=' . $_GET['additional-email-address'] . '&photo=' . $_GET['photo']; ?>&target=update">
                                        <button type="button" class="btn btn-danger">Update Profile</button>
                                    </a>
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
