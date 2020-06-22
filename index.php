<!DOCTYPE html>
<html lang="en">

<?php
include_once 'head.php';
print_head("", "Authentication");
?>

<body>

<div id="login-page">
    <div class="container">

        <form class="form-login" action="student/student.php" method="post">
            <h2 class="form-login-heading">sign in now</h2>

            <div class="login-wrap">

                <a href="student/student.php">
                    <button class="btn btn-theme btn-block" type="button" name="submit"><i class="fa fa-lock"></i>
                        Student Sign
                        In
                    </button>
                </a>
                <hr>
                <a href="teacher/teacher.php">
                    <button class="btn btn-theme btn-block" type="button" name="submit"><i class="fa fa-lock"></i>
                        Teacher Sign
                        In
                    </button>
                </a>
                <hr>
                <a href="#">
                    <button class="btn btn-theme btn-block" type="button" name="submit"><i class="fa fa-lock"></i>
                        Parent Sign
                        In
                    </button>
                </a>
                <hr>
                <a href="admin/admin.php">
                    <button class="btn btn-theme btn-block" type="button" name="submit"><i class="fa fa-lock"></i>
                        Administrator Sign
                        In
                    </button>
                </a>
                <hr>

                <div class="registration">
                    Don't have an account yet?<br/>
                    <a class="" href="registration.php">
                        Create an account (Students Only)
                    </a>
                </div>

            </div>

        </form>

    </div>
</div>

<?php
include_once 'index_scripts.php';
include_once 'backstrech.php';
?>

</body>
</html>
