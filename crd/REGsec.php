<?php
    session_start();
        if (!isset($_SESSION['section_name']) or $_SESSION['section_name']=="" ){
        session_destroy();   
        header("Location: http://localhost/ClinicButler/Home.php");
      }
      elseif (!isset($_SESSION['hospital_name']) or $_SESSION['hospital_name']=="" ){
        header("Location: http://localhost/ClinicButler/logout.php");
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

if($action=='addNewP'){
  
  $patient_regNum=$_POST['PregNum'];
  $patient_fullName=$_POST['fullname'];
  $patient_NIC=$_POST['patientNIC'];
  $patient_Dob=$_POST['pDOB'];
  $patient_Gender=$_POST['gend'];
  $patient_Mobile=$_POST['Mtpn'];
  $patient_fixed_Number=$_POST['Ftpn'];
  $patient_email=$_POST['email'];
  $patient_password=md5($_POST['password']);
  $patient_Address=$_POST['Hadd'];

  $sql = "INSERT INTO patient_data (patient_regNum, patient_fullName, patient_NIC, patient_Dob, patient_Gender, patient_Mobile, patient_fixed_Number, patient_email, patient_password, patient_Address) VALUES 
  ('$patient_regNum' , '$patient_fullName' , '$patient_NIC' , '$patient_Dob' , '$patient_Gender' , '$patient_Mobile' , '$patient_fixed_Number' , '$patient_email' , '$patient_password' , '$patient_Address')";

    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
	    header("Location: http://localhost/ClinicButler/regANcha.php?insert=ok");
    } else {
        header("Location: http://localhost/ClinicButler/regANcha.php?insert=error");
    }

}elseif($action=='updtCliniDT') {

    $patient_regNum=$_POST['patient_regNum'];
    $doc_regno=$_POST['doc_regno'];
    $clinic_id=$_POST['clinic_id'];
    $old_clinic_date=$_POST['old_clinic_date'];
    $new_cliniDT=$_POST['new_cliniDT'];

    $pcdate = date('Y-m-d');

    if($pcdate>$new_cliniDT){

        header("Location: http://localhost/ClinicButler/regANchacliniup.php?errorMessage=olddate");

    }else{
        $sql = "SELECT * FROM clinic_calendar WHERE clinic_id='$clinic_id' AND clinic_date='$new_cliniDT' AND clinicalendar_activation='1'";
        $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
        
                $sql = "UPDATE patient_passbook SET nxt_clinic_date='$new_cliniDT' WHERE patient_regNum='$patient_regNum' AND clinic_id='$clinic_id' AND chck_activat='1'";
                    if ($conn->query($sql)== TRUE){
                        header("Location: http://localhost/ClinicButler/regANchacliniup.php?updat=yes");
                    } else{
                        header("Location: http://localhost/ClinicButler/regANchacliniup.php?errorMessage=error");
                    }
    
            }else {
                header("Location: http://localhost/ClinicButler/regANchacliniup.php?errorMessage=nodate");
            }

    }


}elseif($action=='srchcPdt'){

    $patient_regNum=$_POST['patient_regNum'];
    $clinic_id=$_POST['clinic_id'];
    $Old_clini_date=$_POST['Old_clini_date'];
    $chck_activat='1';

    $sql = "SELECT * FROM patient_data WHERE patient_regNum='$patient_regNum' OR patient_NIC='$patient_regNum'";
    $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $patient_RegNum=$row['patient_regNum'];
                $patient_fullName=$row['patient_fullName'];
            }

            $sql = "SELECT * FROM patient_passbook WHERE clinic_id='$clinic_id' AND patient_regNum='$patient_RegNum' AND nxt_clinic_date='$Old_clini_date' AND chck_activat='$chck_activat'";
            $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $clinic_ID=$row['clinic_id'];
                        $nxt_clinic_date=$row['nxt_clinic_date'];
                    }

                    header("Location: http://localhost/ClinicButler/regANchacliniup.php?action=search&patient_regNum=$patient_RegNum&patient_fullName=$patient_fullName&clinic_id=$clinic_ID&patient_clinic_date=$nxt_clinic_date");

                }else {
                    header("Location: http://localhost/ClinicButler/regANchacliniup.php?errorMessage=Ddterr");
                }

        }else{
            header("Location: http://localhost/ClinicButler/regANchacliniup.php?errorMessage=no");
        }

}elseif($action=='updtPdt') {

    $patient_FullName=$_POST['patient_FullName'];
    $patient_regNum=$_POST['patient_regNum'];
    $Patient_NIC=$_POST['Patient_NIC'];
    $Patient_Dob=$_POST['Patient_Dob'];
    $patient_Gender=$_POST['patient_Gender'];
    $patient_Mobile=$_POST['patient_Mobile'];
    $patient_fixed_Number=$_POST['patient_fixed_Number'];
    $patient_email=$_POST['patient_email'];
    $patient_password=$_POST['patient_password'];
    $patient_Address=$_POST['patient_Address'];
    //$datetime = date('Y-m-d') . " - " . date(" H:i:s", time());
    if(strlen(trim($patient_password))<=0){
        
        $sql = "UPDATE patient_data SET patient_FullName='$patient_FullName',Patient_NIC='$Patient_NIC',Patient_Dob='$Patient_Dob',patient_Gender='$patient_Gender',patient_Mobile='$patient_Mobile',patient_fixed_Number='$patient_fixed_Number',patient_Address='$patient_Address' WHERE patient_regNum='$patient_regNum'";
             if ($conn->query($sql)== TRUE){
                 header("Location: http://localhost/ClinicButler/regANchaupdt.php?updat=yes");
             } else{
                 header("Location: http://localhost/ClinicButler/regANchaupdt.php?errorMessage=error");
             }

    }else{

            $patient_password_EN=md5($_POST['patient_password']);
            
            $sql = "UPDATE patient_data SET patient_password='$patient_password_EN',patient_email='$patient_email' WHERE patient_regNum='$patient_regNum'";
             if ($conn->query($sql)== TRUE){
                 header("Location: http://localhost/ClinicButler/regANchaupdt.php?updat=yes");
             } else{
                 header("Location: http://localhost/ClinicButler/regANchaupdt.php?errorMessage=error");
             }

        }
    
}elseif($action=='srchPdt') {

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
            header("Location: http://localhost/ClinicButler/regANchaupdt.php?errorMessage=no");
        }

}

$conn->close();
?>