<?php
include_once '../db_config.php';
$student_fetch_sql = "SELECT `stream_id`, `stream_name`,`courses`.`course_name` FROM `streams`,`courses` WHERE `streams`.`course_id`=`courses`.`course_id` ORDER BY `course_name`,`streams`.`stream_id`";
$student_fetch_query_result = $db_connection->query($student_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Admin", "All Streams");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Courses", "All Streams", $db_connection);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <h3>Current Streams</h3>
                        </div>
                        <div class="col-md-6">
                            <a href="admin_add_stream.php">
                                <button class="btn btn-primary btn-block">Add Streams</button>
                            </a>
                        </div>
                    </div>
                </div><!-- /row -->
            </div>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">

                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> Sl. No.</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Stream With Course Name
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            while ($student_fetch_query_result_row = mysqli_fetch_assoc($student_fetch_query_result)) {

                                echo '<tr>
                                <td><a href="#">' . $i . '</a></td>
                                <td>' . $student_fetch_query_result_row['course_name'] . ' - ' . $student_fetch_query_result_row['stream_name'] . '</td>
                            </tr>';
                                $i++;
                            }
                            ?>

                            </tbody>
                        </table>
                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div><!-- /row -->

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
