<?php
session_start();
include_once 'Database.php';
include_once 'User.php';
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["email"]) and !empty($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        /**
         * procedural way ↓
         *   $connection = mysqli_connect("localhost", "root", "", "sliate");
         * Object Oriented way ↓
         */

        $database = new Database();
        $connection = $database->getConnection();

        if (!$connection) {
            $_SESSION["message"] = "connection_failed";
        } else {
            /**
             * $select_query = "SELECT id,email,password,role,address,status,course_code FROM users WHERE email='" . $email . "' AND password='" . $password . "'; ";
             * $result = mysqli_query($connection, $select_query);
             */
            $user = new User("", $email, $password);
            $result = $user->getUser();

            if (mysqli_num_rows($result) === 1) {

                $row = mysqli_fetch_assoc($result);

                if ($row['email'] === $email && $row['password'] === md5($password)) {
                    if ($row['status'] == 1) {
                        $_SESSION["message"] = "login_success";
                        $_SESSION["user"] = ucfirst(strchr($email, "@", true));
                        sleep(2);
                        if ($row['role'] == 'student') {
                            if ($row['address'] == "") {
                                $id = $row['id'];
                                header("location:profile.php");
                                $_SESSION["userid"] = $id;
                            } else {
                                header("location:student_dashboard.php");
                                $_SESSION["user_course_code"] = $row['course_code'];
                            }
                        } else {
                            header("location:dashboard.php");
                        }
                    } else {
                        $_SESSION["message"] = "need_admin_validation";
                    }
                } else {
                    $_SESSION["message"] = "login_error";
                }
            } else {
                $_SESSION["message"] = "login_error";
            }
        }
    } else {
        $_SESSION["message"] = "empty_inputs";
    }
} else {
    $_SESSION["message"] = "welcome";
}
?>

<?php
include_once "login.html";
?>