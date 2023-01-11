<?php

session_start();
//unset($_SESSION["id"]);
//unset($_SESSION["name"]);
session_destroy();
sleep(2);
header("Location:index.php");

?>