<?php
session_start();
include_once 'Database.php';
include_once 'User.php';
?>

<?php
if (!isset($_SESSION["user"])) {
    header('location:index.php');
    session_destroy();
} else {
    if ($_SESSION["user"] == "Chamara") {
        /**
         * $connection = mysqli_connect("localhost", "root", "", "sliate");
         */

        $database = new Database();
        $connection = $database->getConnection();

        if (!$connection) {
            $_SESSION["message"] = "connection_failed";
        } else {
            /**
             * $students_select_query = "SELECT users.id AS userid, users.name AS username, users.address AS useraddress, users.status, course.name AS coursename, course.code FROM users LEFT OUTER JOIN course ON users.course_code=course.code WHERE users.role='student';";
             * $students_result = mysqli_query($connection, $students_select_query);
             */

            $user = new User("", "", "");
            $students_result = $user->getStudents();

            //counting students rows
            $_SESSION['students_row_count'] = $students_result->num_rows;

            /**
             * tasks
             */
            $task_select_query = "SELECT tasks.id, tasks.title, tasks.task, course.name ,tasks.course_code, tasks.created_at FROM tasks INNER JOIN course ON tasks.course_code=course.code;";
            $task_result = mysqli_query($connection, $task_select_query);

            //counting task rows
            $_SESSION['task_row_count'] = $task_result->num_rows;

            $courses_query = "SELECT code FROM course";
            $courses_result = mysqli_query($connection, $courses_query);
        }
    } else {
        header("location:index.php");
        session_destroy();
        //You're violating administration rules.
    }
}
?>

<?php include_once 'dashboard.html'; ?>