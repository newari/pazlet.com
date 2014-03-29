<?php
session_start();
unset($_SESSION['upldmin_id']);
header("Location:../index.php");

?>