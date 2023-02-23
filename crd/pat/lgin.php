<?php
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

    if($action=='Loginp'){

        $patient_email=$_POST['patient_email'];
        $patient_passwordd=md5($_POST['patient_password']);
    
        $sql = "SELECT * FROM patient_data WHERE patient_regNum='$patient_email' or patient_email='$patient_email'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {

                $patient_password=$row['patient_password'];
                $patient_regNum=$row['patient_regNum'];
            
                    if($patient_password==$patient_passwordd){
                        //die("ok");
                        session_start();
                        $_SESSION['patient_regNum']=$patient_regNum;
                        header("Location: http://localhost/ClinicButler/pHome.php");
                    }else{
                        //die("Wrong User Password");
                        header("Location: http://localhost/ClinicButler/plogin.php?errorMessage=errorusrpass");
                        session_destroy();
                    }
    
            }

        }else {
            //die("Wrong User Email Address OR Registration Number");
          header("Location: http://localhost/ClinicButler/plogin.php?errorMessage=errorusrnme");
          session_destroy();
        }

    }

//Select query from userdetails table   
$conn->close();

?>
