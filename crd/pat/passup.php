<?php
      session_start();
      if (!isset($_SESSION['patient_regNum']) or $_SESSION['patient_regNum']=="" ){
          session_destroy();   
          header("Location: ./crd/pat/plgout.php");
        }
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "base_hospital_gampola";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$action=$_POST['action'];

    if($action=='pssupdtPdt') {

        $patient_regNum=$_SESSION['patient_regNum'];

        $patient_password=$_POST['patient_password'];
        $patient_passworda=$_POST['patient_passworda'];

        if($patient_password!=$patient_passworda){

            header("Location: http://localhost/ClinicButler/ppasssup.php?errorMessage=passnoeq");

        }else{

            $patient_password_EN=md5($_POST['patient_password']);
            
            $sql = "UPDATE patient_data SET patient_password='$patient_password_EN'WHERE patient_regNum='$patient_regNum'";
            if ($conn->query($sql)== TRUE){
                header("Location: http://localhost/ClinicButler/plogin.php?errorMessage=yes");
            } else{
                header("Location: http://localhost/ClinicButler/ppasssup.php?errorMessage=error");
            }
        }
    }

$conn->close();
?>