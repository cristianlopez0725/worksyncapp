<?php
session_start();

if (isset($_SESSION["usu_id"])) {
   
    session_unset();

    session_destroy();
}

header("Location: index.php");
exit();
?>


