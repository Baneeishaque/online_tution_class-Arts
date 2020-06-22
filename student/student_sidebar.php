<?php

function print_student_sidebar($db_connection, $stream_id, $subject_id)
{
    $main_Section_bolded = false;
    echo '    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="#"><img src="../assets/img/logo.jpg" class="img-circle" width="60"></a></p>

                <h5 class="centered">Student</h5>';

    $assigned_courses_sql = "SELECT `subject_id`,`subject_name`,`streams`.`stream_name`,`courses`.`course_name` FROM `subjects`,`streams`,`courses` WHERE `subjects`.`stream_id`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id` AND `subjects`.`stream_id`='$stream_id'";

    $assigned_courses_sql_result = $db_connection->query($assigned_courses_sql);

    while ($assigned_courses_sql_result_row = mysqli_fetch_assoc($assigned_courses_sql_result)) {

        echo '<li class="sub-menu">
                    <a ';

        if ($subject_id == $assigned_courses_sql_result_row['subject_id']) {

            echo 'class="active"';
            $main_Section_bolded = true;
        }

        echo ' href="javascript:">
                        <i class="fa fa-th"></i>
                        <span>' . $assigned_courses_sql_result_row['subject_name'] . ' - ' . $assigned_courses_sql_result_row['course_name'] . ' ' . $assigned_courses_sql_result_row['stream_name'] . ' Notes</span>
                    </a>
                    <ul class="sub">
                        <li ';
        if ($main_Section_bolded) {
            echo 'class="active"';
            $main_Section_bolded = false;
        }
        echo '><a href="student_all_notes.php?subject-id=' . $assigned_courses_sql_result_row['subject_id'] . '&subject-name=' . $assigned_courses_sql_result_row['subject_name'] . ' - ' . $assigned_courses_sql_result_row['course_name'] . ' ' . $assigned_courses_sql_result_row['stream_name'] . '">All Notes</a></li>
                    </ul>
                </li>';
    }

    echo '</ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->';
}
