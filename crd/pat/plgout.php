<?php
session_start();

session_unset(($_SESSION['hospital_name']) AND ($_SESSION['section_name'])); 
session_destroy();
header("Location: http://localhost/ClinicButler/plogin.php");

?>