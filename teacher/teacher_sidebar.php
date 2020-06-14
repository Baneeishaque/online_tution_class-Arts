<?php

function print_teacher_sidebar($db_connection, $teacher_id, $subject_id, $sub_section)
{
    echo '    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="#"><img src="../assets/img/logo.jpg" class="img-circle" width="60"></a></p>

                <h5 class="centered">Teacher</h5>';

    $assigned_courses_sql = "SELECT `subjects`.`subject_id`,`subjects`.`subject_name`,`streams`.`stream_name`,`courses`.`course_name` FROM `assigns`,`subjects`,`streams`,`courses` WHERE `assigns`.`subject_id`=`subjects`.`subject_id` AND `subjects`.`stream_id`=`streams`.`stream_id` AND `streams`.`course_id`=`courses`.`course_id` AND `teacher_id`='" . $teacher_id . "'";

    $assigned_courses_sql_result = $db_connection->query($assigned_courses_sql);
    $main_section_bolded = false;

    while ($assigned_courses_sql_result_row = mysqli_fetch_assoc($assigned_courses_sql_result)) {

        echo '<li class="sub-menu">
                    <a ';

        if ($subject_id == $assigned_courses_sql_result_row['subject_id']) {

            echo 'class="active"';
            $main_section_bolded = true;
        }

        echo ' href="javascript:">
                        <i class="fa fa-th"></i>
                        <span>' . $assigned_courses_sql_result_row['subject_name'] . ' - ' . $assigned_courses_sql_result_row['course_name'] . ' ' . $assigned_courses_sql_result_row['stream_name'] . ' Notes</span>
                    </a>
                    <ul class="sub">
                        <li ';

        if ($sub_section == "All Notes" && $main_section_bolded) {

            echo 'class="active"';
            $main_section_bolded = false;
        }

        echo '><a href="teacher_all_notes.php?subject-id=' . $assigned_courses_sql_result_row['subject_id'] . '&subject-name=' . $assigned_courses_sql_result_row['subject_name'] . ' - ' . $assigned_courses_sql_result_row['course_name'] . ' ' . $assigned_courses_sql_result_row['stream_name'] . '">All Notes</a></li>
                        <li ';

        if ($sub_section == "Upload Notes" && $main_section_bolded) {

            echo 'class="active"';
            $main_section_bolded = false;
        }

        echo '><a href="teacher_upload_notes.php?subject-id=' . $assigned_courses_sql_result_row['subject_id'] . '&subject-name=' . $assigned_courses_sql_result_row['subject_name'] . ' - ' . $assigned_courses_sql_result_row['course_name'] . ' ' . $assigned_courses_sql_result_row['stream_name'] . '">Upload Notes</a></li>
                    </ul>
                </li>';
    }

    echo '</ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->';
}
