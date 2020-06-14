<?php

//error_reporting(E_ALL);

function print_sidebar($main_section, $sub_section)
{
    echo '    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered"><a href="#"><img src="../assets/img/logo.jpg" class="img-circle" width="60"></a></p>

                <h5 class="centered">Administrator</h5>

                <li class="sub-menu">
                    <a ';

    if ($main_section == "Students") {

        echo 'class="active"';
    }

    echo ' href="javascript:">
                        <i class="fa fa-th"></i>
                        <span>Students</span>
                    </a>
                    <ul class="sub">
                        <li ';

    if ($sub_section == "Current Students") {

        echo 'class="active"';
    }

    echo '><a href="admin_current_students.php">Current Students</a></li>
                        <li ';

    if ($sub_section == "Unverified Students") {

        echo 'class="active"';
    }

    echo '><a href="admin_unverified_students.php">Unverified Students</a></li>
                        <li ';

    if ($sub_section == "Suspended Students") {

        echo 'class="active"';
    }

    echo '><a href="admin_suspended_students.php">Suspended Students</a></li>
                        <li ';

    if ($sub_section == "Add Students") {

        echo 'class="active"';
    }

    echo '><a href="admin_add_student.php">Add Students</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
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

    if ($sub_section == "Add Teachers") {

        echo 'class="active"';
    }

    echo '><a href="admin_add_teacher.php">Add Teachers</a></li>
    <li ';

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

    echo '><a href="admin_all_courses.php">All Courses</a></li>
                        <li ';

    if ($sub_section == "Add Courses") {

        echo 'class="active"';
    }

    echo '><a href="#">Add Courses</a></li>
                        <li ';

    if ($sub_section == "All Streams") {

        echo 'class="active"';
    }

    echo '><a href="admin_all_streams.php">All Streams</a></li>
                        <li ';

    if ($sub_section == "Add Streams") {

        echo 'class="active"';
    }

    echo '><a href="#">Add Streams</a></li>
    <li ';

    if ($sub_section == "All Subjects") {

        echo 'class="active"';
    }

    echo '><a href="admin_all_subjects.php">All Subjects</a></li>
    <li ';

    if ($sub_section == "Add Subjects") {

        echo 'class="active"';
    }

    echo '><a href="admin_add_subject.php">Add Subjects</a></li>
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

            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->';
}
