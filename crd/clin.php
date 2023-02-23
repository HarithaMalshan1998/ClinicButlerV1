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

if($action=='srchcPdtAndpCnt'){

  $patient_ID=$_POST['pregn'];

  if($patient_ID=="*"){

    header("Location: http://localhost/ClinicButler/counter.php");

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
              header("Location: http://localhost/ClinicButler/clinic.php?errorMessage=no");
          }

  }  

}elseif($action=='subpPbook'){
  
  $disF_patient=$_POST['disF_patient'];
  $dis_stts=$_POST['dis_stts'];
  $commF_patient=$_POST['commF_patient'];

  $chckup_lst=$_POST['chckup_lst'];
  $drg_lst=$_POST['drg_lst'];

  $patient_regNum=$_POST['patient_regNum'];
  $nxt_clinic_date=$_POST['nxt_clinic_date'];

  $doc_regno=$_SESSION['doc_regno'];
  $clinic_id =$_SESSION['clinic_id'];

  $pcdate = date('Y-m-d');

  $sql = "SELECT * FROM patient_passbook WHERE patient_regNum='$patient_regNum' AND clinic_id='$clinic_id' AND consult_date='$pcdate'";
  $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $id =$row['id'];
          }
        
          $sql = "UPDATE patient_passbook SET disF_patient='$disF_patient' , dis_stts='$dis_stts' , commF_patient='$commF_patient' , drg_lst='$drg_lst' , chckup_lst='$chckup_lst' , nxt_clinic_date='$nxt_clinic_date' WHERE id='$id'";
              if ($conn->query($sql)== TRUE){
            
                $sql = "UPDATE sample_reslt SET activations='0' WHERE patient_regNum='$patient_regNum' AND clinic_id='$clinic_id' AND clt_date<'$pcdate'";
                    if ($conn->query($sql)== TRUE){
                      header("Location: http://localhost/ClinicButler/clinic.php?errorMessage=ok");
                    } else{
                        header("Location: http://localhost/ClinicButler/clinic.php?errorMessage=inserror");
                    }
                    
              } else{
                  header("Location: http://localhost/ClinicButler/clinic.php?errorMessage=inserror");
              }

      }
      else {

        $sql = "INSERT INTO patient_passbook (patient_regNum, doc_regno, clinic_id, consult_date, disF_patient, dis_stts, commF_patient, drg_lst, chckup_lst, nxt_clinic_date, chck_activat) VALUES 
        ('$patient_regNum' , '$doc_regno' , '$clinic_id' , '$pcdate' , '$disF_patient' , '$dis_stts' , '$commF_patient' , '$drg_lst' , '$chckup_lst' , '$nxt_clinic_date' , '1')";
      
          if ($conn->query($sql) === TRUE) {
            
            $sql = "UPDATE patient_passbook SET chck_activat='0' WHERE patient_regNum='$patient_regNum' AND clinic_id='$clinic_id' AND consult_date<'$pcdate'";
                if ($conn->query($sql)== TRUE){
            
                  $sql = "UPDATE sample_reslt SET activations='0' WHERE patient_regNum='$patient_regNum' AND clinic_id='$clinic_id' AND clt_date<'$pcdate'";
                      if ($conn->query($sql)== TRUE){
                        header("Location: http://localhost/ClinicButler/clinic.php?errorMessage=ok");
                      } else{
                          header("Location: http://localhost/ClinicButler/clinic.php?errorMessage=inserror");
                      }

                } else{
                    header("Location: http://localhost/ClinicButler/clinic.php?errorMessage=inserror");
                }
    
          } else {
              header("Location: http://localhost/ClinicButler/clinic.php?errorMessage=inserror");
          }

      }

}

$conn->close();
?>