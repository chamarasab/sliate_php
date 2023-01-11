<?php
session_start();
include_once 'Database.php';
include_once 'User.php';
?>

<?php
$_SESSION["message"] = "incomplete_profile";
$userid = $_SESSION["userid"];
?>

<?php
/**
 * retrieve existing details...
 * $connection = mysqli_connect("localhost", "root", "", "sliate");
 */

$database = new Database();
$connection = $database->getConnection();

if (!$connection) {
    $_SESSION["message"] = "connection_failed";
} else {
    /**
     * getting current logged user's details...
     * $students_select_query = "SELECT * FROM users WHERE id='" . $userid . "'";
     * $students_result = mysqli_query($connection, $students_select_query);
     */


    $user = new User("", "", "");
    $record = $user->getSignedUser($userid);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["mobile"]) and !empty($_POST["address"]) and !empty($_POST["gender"]) and !empty($_POST["dob"])) {
        $mobile = $_POST["mobile"];
        $address = $_POST["address"];
        $gender = $_POST["gender"];
        $dob = $_POST["dob"];

        $update_query = "UPDATE users SET mobile='" . $mobile . "',address='" . $address . "',gender='" . $gender . "',dob='" . $dob . "',updated_at=now() WHERE id='" . $userid . "'";
        $result = mysqli_query($connection, $update_query);

        if ($result) {
            $_SESSION["message"] = "update_success";
            header('location:index.php');
            session_destroy();
        } else {
            $_SESSION["message"] = "update_error";
        }
    } else {
        $_SESSION["message"] = "empty_inputs";
    }
} else {
    $_SESSION["message"] = "welcome";
}


?>

<?php
include_once "user_profile.html";
?>