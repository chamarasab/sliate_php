<?php
session_start();
?>

<?php
if (!isset($_SESSION["user"])) {
    header('location:index.php');
    session_destroy();
} else {

}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["class_code"]) and !empty($_POST["class_name"]) and !empty($_POST["class_duration"]) and !empty($_POST["class_fee"])) {
        $code = $_POST["class_code"];
        $name = $_POST["class_name"];
        $duration = $_POST["class_duration"];
        $fee = $_POST["class_fee"];

        //insert query goes here...
        $connection = mysqli_connect("localhost", "root", "", "sliate");
        if (!$connection) {
            $_SESSION["message"] = "connection_failed";
        } else {
            $insert_query = "INSERT INTO course (code, name, duration, fee) VALUES ('" . $code . "','" . $name . "', '" . $duration . "','" . $fee . "'); ";
            $result = mysqli_query($connection, $insert_query);

            if ($result) {
                $_SESSION["message"] = "insert_success";
                //sleep(2);
                //header('location:dashboard.php');
            } else {
                $_SESSION["message"] = "insert_error";
            }
        }
        //query end
    } else {
        $_SESSION["message"] = "empty_inputs";
    }
} else {
    $_SESSION["message"] = "welcome";
}
?>

<?php include_once 'add_class.html'; ?>