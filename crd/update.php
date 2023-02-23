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

if($action=='updtPdt') {

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
                 header("Location: http://localhost/ClinicButler/regANchaupdt.php?updatePdt=yes");
             } else{
                 header("Location: http://localhost/ClinicButler/regANchaupdt.php?updatePdt=error");
             }

        }else{

            $patient_password_EN=md5($_POST['patient_password']);
            
            $sql = "UPDATE patient_data SET patient_password='$patient_password_EN',patient_email='$patient_email' WHERE patient_regNum='$patient_regNum'";
             if ($conn->query($sql)== TRUE){
                 header("Location: http://localhost/ClinicButler/regANchaupdt.php?updatePpass=yes");
             } else{
                 header("Location: http://localhost/ClinicButler/regANchaupdt.php?updatePpass=error");
             }

        }
    
} elseif($action=='updtCliniDT') {

    $patient_regNum=$_POST['patient_regNum'];
    $doc_regno=$_POST['doc_regno'];
    $clinic_id=$_POST['clinic_id'];
    $old_clinic_date=$_POST['old_clinic_date'];
    $new_cliniDT=$_POST['new_cliniDT'];

    if(strlen(trim($new_cliniDT))<=0){

        header("Location: http://localhost/ClinicButler/regANchacliniup.php?updatecliniDT=Wempterror");

    }else{
        
        $sql = "UPDATE patient_date SET patient_clinic_date='$new_cliniDT' WHERE patient_clinic_date='$old_clinic_date' AND patient_regNum='$patient_regNum' AND doc_regno='$doc_regno' AND clinic_id='$clinic_id'";
             if ($conn->query($sql)== TRUE){
                 header("Location: http://localhost/ClinicButler/regANchacliniup.php?updateCdt=yes");
             } else{
                 header("Location: http://localhost/ClinicButler/regANchacliniup.php?updateCdt=error");
             }

    }


} elseif($action=='ATCemp') {

    $emp_id=$_POST['emp_id'];
    $emp_NIC=$_POST['emp_NIC'];
    $section_ID=$_POST['section_ID'];
    $emp_activation='0';

    $sql = "SELECT * FROM section_staff WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id') AND emp_activation='$emp_activation'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        
            $sql1 = "UPDATE section_staff SET emp_activation='1' WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id')";
                 if ($conn->query($sql1)== TRUE){
                     header("Location: http://localhost/ClinicButler/adm.php?activ=yes");
                 } else{
                     header("Location: http://localhost/ClinicButler/adm.php?activ=error");
                 }
        }else {
            header("Location: http://localhost/ClinicButler/adm.php?activ=activ");
        }

} elseif($action=='UPDTemp') {

    $emp_id=$_POST['emp_id'];
    $emp_NIC=$_POST['emp_NIC'];
    $emp_name=$_POST['emp_name'];
    $gender=$_POST['gender'];
    $Date_Ob=$_POST['Date_Ob'];
    $mobile_num=$_POST['mobile_num'];
    $fixed_num=$_POST['fixed_num'];
    $section_user_name=$_POST['section_user_name'];
    $section_password=$_POST['section_password'];
    $section_ID=$_POST['section_ID'];
    $emp_activation='1';

    if(strlen(trim($section_password))<=0){

        $sql = "SELECT * FROM section_staff WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id') AND emp_activation='$emp_activation'";
        $result = $conn->query($sql);

            if ($result->num_rows > 0) {
        
                $sql = "UPDATE section_staff SET emp_id='$emp_id',emp_NIC='$emp_NIC',emp_name='$emp_name',gender='$gender',Date_Ob='$Date_Ob',mobile_num='$mobile_num',fixed_num='$fixed_num',section_ID='$section_ID',emp_activation='$emp_activation' WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id')";
                 if ($conn->query($sql)== TRUE){
                     header("Location: http://localhost/ClinicButler/adm.php?updateEmp=yes");
                 } else{
                     header("Location: http://localhost/ClinicButler/adm.php?updateEmp=error");
                 }

            }else {
                header("Location: http://localhost/ClinicButler/adm.php?updateEmp=activ");
            }

    }else{

        $section_password_EN=md5($_POST['section_password']);
        
        $sql = "UPDATE section_staff SET section_password='$section_password_EN',section_user_name='$section_user_name' WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id')";
         if ($conn->query($sql)== TRUE){
             header("Location: http://localhost/ClinicButler/adm.php?updatePpass=yes");
         } else{
             header("Location: http://localhost/ClinicButler/adm.php?updatePpass=error");
         }

    }

} elseif($action=='DATCemp') {

    $emp_id=$_POST['emp_id'];
    $emp_NIC=$_POST['emp_NIC'];
    $section_ID=$_POST['section_ID'];
    $emp_activation='1';

    $sql = "SELECT * FROM section_staff WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id') AND emp_activation='$emp_activation'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        
            $sql1 = "UPDATE section_staff SET emp_activation='0' WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id')";
                 if ($conn->query($sql1)== TRUE){
                     header("Location: http://localhost/ClinicButler/adm.php?activ=yes");
                 } else{
                     header("Location: http://localhost/ClinicButler/adm.php?activ=error");
                 }
        }else {
            header("Location: http://localhost/ClinicButler/adm.php?activ=activ");
        }

} elseif($action=='ADDnwEPM') {
    // insert qury run
    $emp_id=$_POST['emp_id'];
    $emp_NIC=$_POST['emp_NIC'];
    $emp_name=$_POST['emp_name'];
    $gender=$_POST['gender'];
    $Date_Ob=$_POST['Date_Ob'];
    $mobile_num=$_POST['mobile_num'];
    $fixed_num=$_POST['fixed_num'];
    $section_user_name=$_POST['section_user_name'];
    $section_password=md5($_POST['section_password']);
    $section_ID=$_POST['section_ID'];
    $emp_activation='1';

    $sql = "SELECT * FROM section_staff WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id')";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            header("Location: http://localhost/ClinicButler/adm.php?activ=activ");
        }else {

            if(strlen(trim($section_user_name AND $section_password))<=0){

                $sql = "INSERT INTO section_staff (emp_id, emp_NIC, emp_name, gender, Date_Ob, mobile_num, fixed_num, section_ID, emp_activation) VALUES 
                ('$emp_id' , '$emp_NIC' , '$emp_name' , '$gender' , '$Date_Ob' , '$mobile_num' , '$fixed_num' , '$section_ID' , '$emp_activation')";
            
                if ($conn->query($sql) === TRUE) {
                    //echo "New record created successfully";
                    header("Location: http://localhost/ClinicButler/adm.php?insert=ok");
                } else {
                    header("Location: http://localhost/ClinicButler/adm.php?insert=error");
                }

            }else{

                $sql = "INSERT INTO section_staff (emp_id, emp_NIC, emp_name, gender, Date_Ob, mobile_num, fixed_num, section_user_name, section_password, section_ID, emp_activation) VALUES 
                ('$emp_id' , '$emp_NIC' , '$emp_name' , '$gender' , '$Date_Ob' , '$mobile_num' , '$fixed_num' , '$section_user_name' , '$section_password' , '$section_ID' , '$emp_activation')";
            
                if ($conn->query($sql) === TRUE) {
                    //echo "New record created successfully";
                    header("Location: http://localhost/ClinicButler/adm.php?insertWup=ok");
                } else {
                    header("Location: http://localhost/ClinicButler/adm.php?insertWup=error");
                }

            }
        }

}


$conn->close();
?>