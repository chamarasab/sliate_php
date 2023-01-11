<?php
session_start();
include_once 'Database.php';
include_once 'User.php';
?>
<?php
//$connection = mysqli_connect("localhost", "root", "", "sliate");

$database = new Database();
$connection = $database->getConnection();

$user_id = $_SESSION['student_userid']; //$_GET['id'];
$validate = 1;
$invalidate = 0;


$find_user = $connection->query("SELECT status,address FROM users WHERE id='" . $user_id . "';");
$row = $find_user->fetch_assoc();

if ($row["status"] == 1) {
    $result = $connection->query("UPDATE users SET status='" . $invalidate . "' WHERE id='" . $user_id . "'");
    header("location:http://localhost/sliate/dashboard.php");
    $_SESSION["message"] = "Student account status changed";
} else {
    if ($row["address"] == "") {
        $_SESSION["message"] = "welcome";
        $student_details = $connection->query("SELECT name FROM users WHERE id='" . $user_id . "'");
        $student = $student_details->fetch_assoc();

        $course_details = "SELECT code from course";
        $course_codes = mysqli_query($connection, $course_details);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST["course_id"])) {
                $course_id = $_POST["course_id"];
                if ($course_id == "Select course") {
                    $_SESSION["message"] = "select_empty";
                } else {
                    $reg_no = str_replace("-", "", $course_id) . $user_id;
                    $update_query = "UPDATE users SET course_code='" . $course_id . "', reg_no='" . $reg_no . "',status=1,updated_at=now() WHERE id='" . $user_id . "'";
                    $update_result = mysqli_query($connection, $update_query);

                    if ($update_result) {
                        header('location:dashboard.php');
                        $_SESSION["message"] = "Update success";
                    } else {
                        $_SESSION["message"] = "update_error";
                    }
                }
            } else {
                $_SESSION["message"] = "empty_inputs";
            }
        }

        include_once "update_status.html";
    } else {
        $result = $connection->query("UPDATE users SET status='" . $validate . "' WHERE id='" . $user_id . "'");
        header("location:http://localhost/sliate/dashboard.php");
        $_SESSION["message"] = "Student account status changed";
    }
}

?>