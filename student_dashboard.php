<?php
    session_start();
?>
<?php
if (!isset($_SESSION["user"])) {
    header('location:index.php');
    session_destroy();
} else {
    //query goes here...
    $connection = mysqli_connect("localhost", "root", "", "sliate");
    if (!$connection) {
        $_SESSION["message"] = "connection_failed";
    } else {
        $user_course_code = $_SESSION["user_course_code"];//'SLIATE-2022-ICT-2'
        $task_select_query = "SELECT tasks.id, tasks.title, tasks.task, course.name ,tasks.course_code, tasks.created_at FROM tasks INNER JOIN course ON tasks.course_code=course.code AND tasks.course_code='".$user_course_code."';";
        $task_result = mysqli_query($connection, $task_select_query);

        //counting task rows
        $_SESSION['task_row_count']=$task_result->num_rows;

    }
}
?>

<?php
include_once "student_dashboard.html";
?>