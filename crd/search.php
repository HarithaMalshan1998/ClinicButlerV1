<?php
    session_start();
    if (!isset($_SESSION['hospital_name']) or $_SESSION['hospital_name']=="" ){
         session_destroy();   
        header("Location: http://localhost/ClinicButler/login.php");
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

if ($action=='srchPdt') {

    $patient_regNum=$_POST['patient_regNum'];

    $sql = "SELECT * FROM patient_data WHERE patient_regNum='$patient_regNum' OR patient_NIC='$patient_regNum'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $patient_regNum=$row['patient_regNum'];
                $patient_fullName=$row['patient_fullName'];
                $patient_NIC=$row['patient_NIC'];
                $patient_Dob=$row['patient_Dob'];
                $patient_Gender=$row['patient_Gender'];
                $patient_Mobile=$row['patient_Mobile'];
                $patient_fixed_Number=$row['patient_fixed_Number'];
                $patient_email=$row['patient_email'];
                $patient_Address=$row['patient_Address'];        

                header("Location: http://localhost/ClinicButler/regANchaupdt.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_NIC=$patient_NIC&patient_Dob=$patient_Dob&patient_Gender=$patient_Gender&patient_Mobile=$patient_Mobile&patient_fixed_Number=$patient_fixed_Number&patient_email=$patient_email&patient_Address=$patient_Address");
            }
        }else {
            header("Location: http://localhost/ClinicButler/regANchaupdt.php?search=no");
        }

}elseif($action=='srchcPdt'){

    $patient_regNum=$_POST['patient_regNum'];
    $clinic_id=$_POST['clinic_id'];
    $Old_clini_date=$_POST['Old_clini_date'];
    $clinic_attend='0';

    
    $sql = "SELECT * FROM patient_date WHERE (patient_regNum='$patient_regNum' OR patient_NIC='$patient_regNum') AND clinic_id='$clinic_id' AND patient_clinic_date='$Old_clini_date' AND clinic_attend='$clinic_attend'";
    $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $doc_regno=$row['doc_regno'];
                $patient_regNum=$row['patient_regNum'];
                $clinic_id =$row['clinic_id'];
                $patient_clinic_date =$row['patient_clinic_date'];
            }

            $sql = "SELECT * FROM patient_data WHERE patient_regNum='$patient_regNum'";
            $result = $conn->query($sql);
            
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $patient_regNum=$row['patient_regNum'];
                        $patient_fullName=$row['patient_fullName'];
                        $patient_NIC=$row['patient_NIC'];
                    }

                    $sql = "SELECT * FROM clinic_details WHERE clinic_id='$clinic_id'";
                    $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $clinic_id=$row['clinic_id'];
                                $clinic_name=$row['clinic_name'];
                            }

                            header("Location: http://localhost/ClinicButler/regANchacliniup.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&clinic_id=$clinic_id&clinic_name=$clinic_name&patient_clinic_date=$patient_clinic_date");

                        }else {
                            header("Location: http://localhost/ClinicButler/regANchacliniup.php?search=Ddterr");
                        }

                }else{
                    header("Location: http://localhost/ClinicButler/regANchacliniup.php?search=Pdterr");
                }

        }else {
            header("Location: http://localhost/ClinicButler/regANchacliniup.php?search=errattenP");
        }

}


$conn->close();
?>