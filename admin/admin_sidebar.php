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

    echo '<li class="sub-menu">
                    <a ';

    if ($main_section == "Students") {

        echo 'class="active"';
    }

    echo ' href="javascript:">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Students</span>
                    </a>
                    <ul class="sub">';

    $stream_fetch_sql = "SELECT `streams`.`stream_id`,`streams`.`stream_name`,`courses`.`course_name` FROM `streams`,`courses` WHERE `streams`.`course_id`=`courses`.`course_id` ORDER BY `courses`.`course_name`,`streams`.`stream_name`";

    $stream_fetch_sql_result = $db_connection->query($stream_fetch_sql);
    while ($stream_fetch_sql_result_row = mysqli_fetch_assoc($stream_fetch_sql_result)) {

        $batch_fetch_sql = "SELECT `batch_id`, `batch_name` FROM `batchs` WHERE `stream_id`='" . $stream_fetch_sql_result_row['stream_id'] . "'";
        $batch_fetch_sql_result = $db_connection->query($batch_fetch_sql);
        if (mysqli_num_rows($batch_fetch_sql_result) > 0) {

            echo '<li class="sub-menu">
    <a ';

            if ($sub_section == $stream_fetch_sql_result_row['stream_id']) {
                echo 'class="active"';
            }

            echo ' href="javascript:">
        <span>' . $stream_fetch_sql_result_row['course_name'] . ' ' . $stream_fetch_sql_result_row['stream_name'] . '</span>
    </a>
    <ul class="sub">';
            while ($batch_fetch_sql_result_row = mysqli_fetch_assoc($batch_fetch_sql_result)) {

                echo '<li ';
                if ($_GET['batch-id'] == $batch_fetch_sql_result_row['batch_id']) {
                    echo 'class="active"';
                }
                echo '><a href="admin_students.php?stream-id=' . $stream_fetch_sql_result_row['stream_id'] . '&stream-name=' . $stream_fetch_sql_result_row['course_name'] . ' ' . $stream_fetch_sql_result_row['stream_name'] . '&batch-id=' . $batch_fetch_sql_result_row['batch_id'] . '&batch-name=' . $batch_fetch_sql_result_row['batch_name'] . '">' . $batch_fetch_sql_result_row['batch_name'] . '</a></li>';
            }
            echo '</ul>
</li>';

        } else {
            echo '<li ';
            if ($sub_section == $stream_fetch_sql_result_row['stream_id']) {
                echo 'class="active"';
            }
            echo '><a href="admin_students.php?stream-id=' . $stream_fetch_sql_result_row['stream_id'] . '&stream-name=' . $stream_fetch_sql_result_row['course_name'] . ' ' . $stream_fetch_sql_result_row['stream_name'] . '">' . $stream_fetch_sql_result_row['course_name'] . ' ' . $stream_fetch_sql_result_row['stream_name'] . '</a></li>';
        }
    }

    echo '          </ul>
                </li>';

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

    echo '><a href="admin_suspended_teachers.php">Suspended Teachers</a></li>
    <li ';

    if ($sub_section == "All Teachers") {

        echo 'class="active"';
    }

    echo '><a href="admin_all_teachers.php">All Teachers</a></li>
                    </ul>
                </li>';

    echo '<li class="sub-menu">
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
                </li>';

    echo '<li class="sub-menu">
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

    echo '><a href="admin_all_courses.php">All Courses</a></li>
    <li ';

    if ($sub_section == "All Streams") {

        echo 'class="active"';
    }

    echo '><a href="admin_all_streams.php">All Streams</a></li>
    <li ';

    if ($sub_section == "All Subjects") {

        echo 'class="active"';
    }

    echo '><a href="admin_all_subjects.php">All Subjects</a></li>
    <li ';

    if ($sub_section == "All Batchs") {

        echo 'class="active"';
    }

    echo '><a href="admin_all_batchs.php">All Batchs</a></li>
                        
                    </ul>
                </li>';

    echo '</ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->';
}
