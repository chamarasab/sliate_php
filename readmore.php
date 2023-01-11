<?php
    session_start()
?>
<?php
    if (!empty($_SESSION['taskid'])) {
        $taskid = $_SESSION['taskid'];
        $connection = mysqli_connect("localhost", "root", "", "sliate");
        $task_details = $connection->query("SELECT task FROM tasks WHERE id='" . $taskid . "'");
        $task = $task_details->fetch_assoc();
       // echo $task["task"];
    } else {
        session_destroy();
        header('location:index.php');
    }

    include_once "readmore.html";
?>
