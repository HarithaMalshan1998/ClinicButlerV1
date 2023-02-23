<?php
    session_start();
    if (!isset($_SESSION['doc_name']) or $_SESSION['doc_name']=="" ){
        header("Location: http://localhost/ClinicButler/Home.php");
      }
      elseif (!isset($_SESSION['clinic_id']) or $_SESSION['clinic_id']=="" ){  
      header("Location: http://localhost/ClinicButler/Home.php");
      }
      elseif (!isset($_SESSION['hospital_name']) or $_SESSION['hospital_name']=="" ){
        header("Location: http://localhost/ClinicButler/logout.php");
      }
      elseif (!isset($_SESSION['doc_regno']) or $_SESSION['doc_regno']=="" ){
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

}elseif($action=='subpPbook'){
  
  $disF_patient=$_POST['disF_patient'];
  $dis_stts=$_POST['dis_stts'];
  $commF_patient=$_POST['commF_patient'];

  $chckup_lst=$_POST['chckup_lst'];
  $drg_lst=$_POST['drg_lst'];

  $patient_regNum=$_POST['patient_regNum'];
  $patient_clinic_date=$_POST['patient_clinic_date'];

  $doc_regno=$_SESSION['doc_regno'];
  $clinic_id =$_SESSION['clinic_id'];

  $pcdate = date('Y-m-d');

  die($disF_patient . $dis_stts . $commF_patient . $chckup_lst . $drg_lst . $patient_regNum . $pcdate . $patient_clinic_date . $clinic_id . $doc_regno);

}elseif($action=='srchcPdtAndpCnt'){

  $patient_ID=$_POST['pregn'];

  if($patient_ID=="*"){

      die("ok");

  }else{

      $sql = "SELECT * FROM patient_data WHERE patient_regNum='$patient_ID' OR patient_NIC='$patient_ID'";
      $result = $conn->query($sql);
  
          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  $patient_regNum =$row['patient_regNum'];
                  $patient_fullName =$row['patient_fullName'];
                  $patient_Dob =$row['patient_Dob'];
                  $patient_Gender =$row['patient_Gender'];
                  $age = date_diff(date_create($patient_Dob), date_create('now'))->y;
              }
                  header("Location: http://localhost/ClinicButler/clinic.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_Dob=$patient_Dob&patient_Gender=$patient_Gender&age=$age");
          }else {
              header("Location: http://localhost/ClinicButler/clinic.php?search=no");
          }

  }

  

}

$conn->close();
?>