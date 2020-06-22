<?php

//error_reporting(E_ALL);

function print_sidebar($main_section, $sub_section, $db_connection)
{
    echo '    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="#"><img src="../assets/img/logo.jpg" class="img-circle" width="60"></a></p>

                <h5 class="centered">Administrator</h5>';

//                <li class="sub-menu">
//                    <a ';
//
//    if ($main_section == "Students") {
//
//        echo 'class="active"';
//    }
//
//    echo ' href="javascript:">
//                        <i class="fa fa-th"></i>
//                        <span>Students</span>
//                    </a>
//                    <ul class="sub">';
//    echo '             <li ';
//
//    if ($sub_section == "Current Students") {
//
//        echo 'class="active"';
//    }
//
//    echo '><a href="#">Current Students</a></li>
//                        <li ';
//
//    if ($sub_section == "Suspended Students") {
//
//        echo 'class="active"';
//    }
//
//    echo '><a href="#">Suspended Students</a></li>';
//    echo '              <li ';
//
//    if ($sub_section == "Add Students") {
//
//        echo 'class="active"';
//    }
//
//    echo '><a href="admin_add_student.php">Add Students</a></li>
//                    </ul>
//                </li>';
    echo '<li class="sub-menu">
                    <a ';

    if ($main_section == "Teachers") {

        echo 'class="active"';
    }

    echo ' href="javascript:">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Teachers</span>
                    </a>
                    <ul class="sub">
                        <li ';

    if ($sub_section == "Current Teachers") {

        echo 'class="active"';
    }

    echo '><a href="admin_current_teachers.php">Current Teachers</a></li>
                        <li ';

    if ($sub_section == "Assign Teachers") {

        echo 'class="active"';
    }

    echo '><a href="admin_assign_teachers.php">Assign Teachers</a></li>
                        <li ';

    if ($sub_section == "Unassigned Teachers") {

        echo 'class="active"';
    }

    echo '><a href="admin_unassigned_teachers.php">Unassigned Teachers</a></li>
                        <li ';

    if ($sub_section == "Suspended Teachers") {

        echo 'class="active"';
    }

    echo '><a href="admin_suspended_teachers.php">Suspended Teachers</a></li>';
//                        <li ';
//
//    if ($sub_section == "Add Teachers") {
//
//        echo 'class="active"';
//    }
//
//    echo '><a href="admin_add_teacher.php">Add Teachers</a></li>
    echo '<li ';

    if ($sub_section == "All Teachers") {

        echo 'class="active"';
    }

    echo '><a href="admin_all_teachers.php">All Teachers</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a ';

    if ($main_section == "Courses") {

        echo 'class="active"';
    }

    echo ' href="javascript:">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Courses</span>
                    </a>
                    <ul class="sub">
                        <li ';

    if ($sub_section == "All Courses") {

        echo 'class="active"';
    }

    echo '><a href="admin_all_courses.php">All Courses</a></li>';
//                        <li ';
//
//    if ($sub_section == "Add Courses") {
//
//        echo 'class="active"';
//    }
//
//    echo '><a href="admin_add_course.php">Add Courses</a></li>
    echo '<li ';

    if ($sub_section == "All Streams") {

        echo 'class="active"';
    }

    echo '><a href="admin_all_streams.php">All Streams</a></li>';
//                        <li ';
//
//    if ($sub_section == "Add Streams") {
//
//        echo 'class="active"';
//    }
//
//    echo '><a href="admin_add_stream.php">Add Streams</a></li>
    echo '<li ';

    if ($sub_section == "All Subjects") {

        echo 'class="active"';
    }

    echo '><a href="admin_all_subjects.php">All Subjects</a></li>';
//                        <li ';
//
//    if ($sub_section == "Add Subjects") {
//
//        echo 'class="active"';
//    }
//
//    echo '><a href="admin_add_subject.php">Add Subjects</a></li>
//    echo                '<li ';
//
//    if ($sub_section == "Add Batchs") {
//
//        echo 'class="active"';
//    }
//
//    echo '><a href="admin_add_batch.php">Add Batchs</a></li>
    echo '<li ';

    if ($sub_section == "All Batchs") {

        echo 'class="active"';
    }

    echo '><a href="admin_all_batchs.php">All Batchs</a></li>
                        
                    </ul>
                </li>
                <li class="sub-menu">
                    <a ';

    if ($main_section == "Parents") {

        echo 'class="active"';
    }

    echo ' href="javascript:">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Parents</span>
                    </a>
                    <ul class="sub">
                        <li ';

    if ($sub_section == "All Parents") {

        echo 'class="active"';
    }

    echo '><a href="#">All Parents</a></li>
                        <li ';

    if ($sub_section == "Assign Parents") {

        echo 'class="active"';
    }

    echo '><a href="#">Assign Parents</a></li>
                        <li ';

    if ($sub_section == "Add Parents") {

        echo 'class="active"';
    }

    echo '><a href="#">Add Parents</a></li>
                    </ul>
                </li>

                <li class="sub-menu">
                    <a ';

    if ($main_section == "Students") {

        echo 'class="active"';
    }

    echo ' href="javascript:">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Students</span>
                    </a>
                    <ul class="sub">';

    $assigned_courses_sql = "SELECT `streams`.`stream_id`,`streams`.`stream_name`,`courses`.`course_name` FROM `streams`,`courses` WHERE `streams`.`course_id`=`courses`.`course_id` ORDER BY `courses`.`course_name`,`streams`.`stream_name`";

    $assigned_courses_sql_result = $db_connection->query($assigned_courses_sql);
    while ($assigned_courses_sql_result_row = mysqli_fetch_assoc($assigned_courses_sql_result)) {

        echo '<li ';
        if ($sub_section == $assigned_courses_sql_result_row['stream_id']) {
            echo 'class="active"';
        }
        echo '><a href="admin_students.php?stream-id=' . $assigned_courses_sql_result_row['stream_id'] . '&stream-name=' . $assigned_courses_sql_result_row['course_name'] . ' ' . $assigned_courses_sql_result_row['stream_name'] . '">' . $assigned_courses_sql_result_row['course_name'] . ' ' . $assigned_courses_sql_result_row['stream_name'] . '</a></li>';
    }

    echo '          </ul>
                </li>
                
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->';
}
