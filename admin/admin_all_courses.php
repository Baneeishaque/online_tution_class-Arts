<?php

include_once '../db_config.php';

$student_fetch_sql = "SELECT `course_id`, `course_name` FROM `courses`";
//    echo $student_login_sql;

$student_fetch_query_result = $db_connection->query($student_fetch_sql);
?>
<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head_for_admin.php';
print_head("Admin", "All Courses");
?>

<body>

<section id="container">

    <?php
    include_once 'header.php';
    print_header("admin");

    include_once 'admin_sidebar.php';
    print_sidebar("Courses", "All Courses", $db_connection);
    ?>

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <h3>Current Courses</h3>
                        </div>
                        <div class="col-md-6">
                            <a href="admin_add_course.php">
                                <button class="btn btn-primary btn-block">Add Courses</button>
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
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Course Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($student_fetch_query_result_row = mysqli_fetch_assoc($student_fetch_query_result)) {

                                echo '<tr>
                                <td><a href="#">' . $student_fetch_query_result_row['course_id'] . '</a></td>
                                <td>' . $student_fetch_query_result_row['course_name'] . '</td>
                            </tr>';
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
