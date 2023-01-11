<?php
session_start();
include_once 'Database.php';
?>

<?php
if (!isset($_SESSION["user"])) {
    header('location:index.php');
    session_destroy();
} else {

    //$connection = mysqli_connect("localhost", "root", "", "sliate");

    $database = new Database();
    $connection = $database->getConnection();

    if (!$connection) {
        $_SESSION["message"] = "connection_failed";
    } else {
        $select_query = "SELECT code from course";
        $result = mysqli_query($connection, $select_query);
    }
}
?>

<?php
//insert data

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["course_id"]) and !empty($_POST["task_title"]) and !empty($_POST["task_content"])) {
        $course_id = $_POST["course_id"];
        $task_title = $_POST["task_title"];
        $task_content = $_POST["task_content"];

        if ($course_id == "Select course") {
            $_SESSION["message"] = "select_empty";
        } else {
            //insert query goes here...
            //$connection = mysqli_connect("localhost", "root", "", "sliate");
            if (!$connection) {
                $_SESSION["message"] = "connection_failed";
            } else {
                $insert_query = "INSERT INTO tasks (course_code,title,task) VALUES ('" . $course_id . "','" . $task_title . "','" . $task_content . "'); ";
                $result = mysqli_query($connection, $insert_query);

                if ($result) {
                    $_SESSION["message"] = "insert_success";
                    sleep(2);
                    header('location:dashboard.php');
                } else {
                    $_SESSION["message"] = "insert_error";
                }
            }
            //query end
        }
    } else {
        $_SESSION["message"] = "empty_inputs";
    }
} else {
    $_SESSION["message"] = "welcome";
}


?>


<?php include_once "add_task.html"; ?>