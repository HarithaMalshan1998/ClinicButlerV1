<?php

  // session_start();
  //   if (!isset($_SESSION['doc_name']) or $_SESSION['doc_name']=="" ){
  //       header("Location: http://localhost/ClinicButler/Home.php");
  //     }
  //     elseif (!isset($_SESSION['clinic_id']) or $_SESSION['clinic_id']=="" ){  
  //     header("Location: http://localhost/ClinicButler/Home.php");
  //     }
  //     elseif (!isset($_SESSION['hospital_name']) or $_SESSION['hospital_name']=="" ){
  //       header("Location: http://localhost/ClinicButler/logout.php");
  //     }
  //     elseif (!isset($_SESSION['doc_regno']) or $_SESSION['doc_regno']=="" ){
  //       header("Location: http://localhost/ClinicButler/logout.php");
  //     }
  //     elseif (!isset($_SESSION['section_name']) or $_SESSION['section_name']=="" ){
  //         session_destroy();   
  //         header("Location: http://localhost/ClinicButler/Home.php");
  //     }

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

if(isset($_GET['file_id'])){

  $id = $_GET['file_id'];
  $clectddt = $_GET['clectddt'];
  $prgnum=$_GET['prgnum'];

  $sql = "SELECT * FROM sample_reslt WHERE id='$id' AND patient_regNum='$prgnum' AND clt_date='$clectddt' AND pay_typ='1'";
  $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        $sql = "SELECT * FROM sample_reslt WHERE id='$id' AND patient_regNum='$prgnum' AND clt_date='$clectddt' AND upload='1'";
        $result = $conn->query($sql);
      
            if ($result->num_rows > 0) {

              $sql="SELECT * FROM sample_reslt WHERE id='$id' AND patient_regNum='$prgnum' AND clt_date='$clectddt'";
              $result = mysqli_query($conn,$sql);
              $file = mysqli_fetch_assoc($result);
              $fielpath = 'C:/xampp/htdocs/ClinicButler/uploads/'.$file['file_Nme'];
            
              if(file_exists($fielpath)){
                header('Content-Type: application/octet-stream');
                header('Content-Description: File Transfer');
                header('Content-Disposition: Attachment; filename=' .basename($fielpath));
                header('Expires:0');
                header('Cache-Control: must-revalidete');
                header('pragma:public');
                header('Content-Length;' . filesize('C:/xampp/htdocs/ClinicButler/uploads/'.$file['file_Nme']));
                readfile('C:/xampp/htdocs/ClinicButler/uploads/'.$file['file_Nme']);
              }
              
            }else {
                header("Location: http://localhost/ClinicButler/laboratory.php?Message=noup");
            }
        
      }else {
          header("Location: http://localhost/ClinicButler/laboratory.php?Message=nopay");
      }

}elseif(isset($_GET['id'])){

  $id = $_GET['id'];
  $prgnum=$_GET['prgnum'];

  $sql = "SELECT * FROM sample_reslt WHERE id='$id' AND patient_regNum='$prgnum' AND pay_typ='1'";
  $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        $sql="SELECT * FROM sample_reslt WHERE id='$id' AND patient_regNum='$prgnum'";
        $result = mysqli_query($conn,$sql);
        $file = mysqli_fetch_assoc($result);
        $fielpath = 'C:/xampp/htdocs/ClinicButler/uploads/'.$file['file_Nme'];
      
        if(file_exists($fielpath)){
          header('Content-Type: application/octet-stream');
          header('Content-Description: File Transfer');
          header('Content-Disposition: Attachment; filename=' .basename($fielpath));
          header('Expires:0');
          header('Cache-Control: must-revalidete');
          header('pragma:public');
          header('Content-Length;' . filesize('C:/xampp/htdocs/ClinicButler/uploads/'.$file['file_Nme']));
          readfile('C:/xampp/htdocs/ClinicButler/uploads/'.$file['file_Nme']);
        }
        
      }else {
          header("Location: http://localhost/ClinicButler/clinic.php?errorMessage=nopay");
      }

}elseif(isset($_GET['pfile_id'])){

  $id = $_GET['pfile_id'];
  $prgnum=$_GET['prgnum'];

  $sql = "SELECT * FROM sample_reslt WHERE id='$id' AND patient_regNum='$prgnum' AND pay_typ='1'";
  $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        $sql = "SELECT * FROM sample_reslt WHERE id='$id' AND patient_regNum='$prgnum' AND upload='1'";
        $result = $conn->query($sql);
      
            if ($result->num_rows > 0) {

              $sql="SELECT * FROM sample_reslt WHERE id='$id' AND patient_regNum='$prgnum'";
              $result = mysqli_query($conn,$sql);
              $file = mysqli_fetch_assoc($result);
              $fielpath = 'C:/xampp/htdocs/ClinicButler/uploads/'.$file['file_Nme'];
            
              if(file_exists($fielpath)){
                header('Content-Type: application/octet-stream');
                header('Content-Description: File Transfer');
                header('Content-Disposition: Attachment; filename=' .basename($fielpath));
                header('Expires:0');
                header('Cache-Control: must-revalidete');
                header('pragma:public');
                header('Content-Length;' . filesize('C:/xampp/htdocs/ClinicButler/uploads/'.$file['file_Nme']));
                readfile('C:/xampp/htdocs/ClinicButler/uploads/'.$file['file_Nme']);
              }
              
            }else {
                header("Location: http://localhost/ClinicButler/pchckupanrslttbl.php?Message=noup");
            }
        
      }else {
          header("Location: http://localhost/ClinicButler/pchckupanrslttbl.php?Message=nopay");
      }

}



$conn->close();
?>