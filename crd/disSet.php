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

if($action=='srchcPdtAndpCnt'){

  $patient_ID=$_POST['pregn'];
  $clinic_ID=$_POST['clinid'];

    $sql = "SELECT * FROM patient_data WHERE patient_regNum='$patient_ID' OR patient_NIC='$patient_ID'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $patient_regNum =$row['patient_regNum'];
                $patient_fullName =$row['patient_fullName'];
                $patient_NIC =$row['patient_NIC'];
                $patient_Dob =$row['patient_Dob'];
                $patient_Mobile =$row['patient_Mobile'];
                $patient_fixed_Number =$row['patient_fixed_Number'];
                $patient_Address =$row['patient_Address'];
                $patient_Gender =$row['patient_Gender'];
                $age = date_diff(date_create($patient_Dob), date_create('now'))->y;
            }
                header("Location: http://localhost/ClinicButler/dispen.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_NIC=$patient_NIC&patient_Dob=$patient_Dob&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&drug_name=&srch=");
        }else {
            header("Location: http://localhost/ClinicButler/dispen.php?Message=no");
        }

  

}elseif($action=='srchcdrginf'){

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Address =$_POST['patient_Address'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_fixed_Number =$_POST['patient_fixed_Number'];
  $clinic_ID=$_POST['clinic_ID'];
  $drg_nme=$_POST['drg_nme'];
  $patient_NIC=$_POST['patient_NIC'];

  $sql = "SELECT * FROM drug_info WHERE drg_name='$drg_nme'";
  $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $drug_name =$row['drg_name'];
          }
              header("Location: http://localhost/ClinicButler/dispen.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_NIC=$patient_NIC&patient_Dob=$patient_Dob&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&drug_name=$drug_name&srch=");
      }else {
        header("Location: http://localhost/ClinicButler/dispen.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_NIC=$patient_NIC&patient_Dob=$patient_Dob&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&drug_name=&srch=nodrg");
      }
  

}elseif($action=='issu'){

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Address =$_POST['patient_Address'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_fixed_Number =$_POST['patient_fixed_Number'];
  $clinic_ID=$_POST['clinic_ID'];
  $drg_nme=$_POST['drg_nme'];
  
  $drg_lst=$_POST['drg_lst'];

  if(empty($drg_lst)){

    header("Location: http://localhost/ClinicButler/dispen.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_NIC=$patient_NIC&patient_Dob=$patient_Dob&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&drug_name=$drug_name&srch=isser");

  }else{

    header("Location: http://localhost/ClinicButler/dispen.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_NIC=$patient_NIC&patient_Dob=$patient_Dob&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&drug_name=$drug_name&srch=iss");

  }

}elseif($action=='can'){

    header("Location: http://localhost/ClinicButler/dispen.php?Message=cancl");
  

}

$conn->close();
?>