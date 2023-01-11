<?php
session_start();
include_once 'User.php';
include_once 'Database.php';
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["name"]) and !empty($_POST["email"]) and !empty($_POST["password"]) and !empty($_POST["confirm_password"])) {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if ($password == $confirm_password) {
            /**
             * $_SESSION["message"] = "Hi " . $name . ", Wait for admin validation";
             * $connection = mysqli_connect("localhost", "root", "", "sliate");
             */
            $database = new Database();
            $connection = $database->getConnection();

            if (!$connection) {
                header('location:register.php');
                $_SESSION["message"] = "connection_failed";
            } else {
                /**
                 * $select_query = "INSERT INTO users (name,email,password,status) VALUES ('" . $name . "','" . $email . "', '" . $password . "',0); ";
                 * $result = mysqli_query($connection, $select_query);
                 */
                $user = new User($name, $email, $password);
                $result = $user->setUser();

                if ($result) {
                    $_SESSION["message"] = "insert_success";
                    sleep(2);
                    header('location:index.php');
                    session_destroy();
                } else {
                    $_SESSION["message"] = "insert_error";
                }
            }
        } else
            $_SESSION["message"] = "pw_error";
    } else {
        $_SESSION["message"] = "empty_inputs";
    }
} else {
    //$_SESSION["message"] = "welcome";
    /**
     * By default, when loading for the first time, drop all sessions and open the page fresh.
     */
    session_destroy();
}
?>

<?php include_once "register.html"; ?>