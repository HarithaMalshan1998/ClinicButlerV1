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

if($action=='srchbdr'){

  $dr_n=$_POST['dr_n'];

  $sql = "SELECT * FROM doctor_details WHERE (doc_regno='$dr_n' OR doc_nic='$dr_n' OR doc_name='$dr_n') AND doc_activation='1'";
  $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $doc_name=$row['doc_name'];
              $doc_regno=$row['doc_regno'];
              $doc_nic=$row['doc_nic'];
              $gender=$row['gender'];
          }        
              header("Location: http://localhost/ClinicButler/infor.php?action=docsearch&doc_name=$doc_name&doc_regno=$doc_regno&doc_nic=$doc_nic&gender=$gender");
      }else {
          header("Location: http://localhost/ClinicButler/infor.php?errormsg=nodr");
      }

  

}elseif($action=='srchclndt'){
    
  $cln_dt=$_POST['cln_dt'];
  $clinic_id=$_POST['clinic_id'];

  $sql = "SELECT * FROM clinic_details WHERE clinic_id='$clinic_id' OR clinic_name='$clinic_id' AND clinic_activation='1'";
  $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $clinic_id=$row['clinic_id'];
              $clinic_name=$row['clinic_name'];
          }        
              header("Location: http://localhost/ClinicButler/inforclniclndr.php?action=clinsearch&clinic_id=$clinic_id&clinic_name=$clinic_name");
      }else {
          header("Location: http://localhost/ClinicButler/inforclniclndr.php?errormsg=nocln");
      }
  

}

$conn->close();
?>