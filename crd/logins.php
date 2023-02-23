<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "log_in";
// Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
 } 

 $action=$_POST['action'];

  if($action=='Login'){

    $hospital_user_name=$_POST['hospital_user_name'];
    $hospital_password=md5($_POST['hospital_password']);
    //  $today = date("g:i a");
  
    $sql = "SELECT * FROM hospital_login WHERE ( hospital_user_name='$hospital_user_name' or hospital_number='$hospital_user_name' ) AND hospital_password='$hospital_password' ";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
      $hospital_name=$row['hospital_name'];
      $hospital_activation=$row['hospital_activation'];
  
      if($hospital_activation=='1'){
        session_start();
        $_SESSION['hospital_name']=$hospital_name;
        header("Location: http://localhost/ClinicButler/Home.php");
      }else{
        header("Location: http://localhost/ClinicButler/login.php?errorMessage=erroract");
        session_destroy();
      }
  
    }
    }else {
      header("Location: http://localhost/ClinicButler/login.php?errorMessage=error");
      session_destroy();
    }

  }elseif($action=='pasup'){

    $hnsnum=$_POST['hnsnum'];
    $npass=md5($_POST['npass']);
    $rnpass=md5($_POST['rnpass']);

      if($npass==$rnpass){

        $sql = "UPDATE hospital_login SET hospital_password='$rnpass' WHERE hospital_number='$hnsnum'";
            if ($conn->query($sql)== TRUE){
                header("Location: http://localhost/ClinicButler/adm.php?passchng=yes");
            }else{
                header("Location: http://localhost/ClinicButler/adm.php?passchng=error");
            }

      }else{
        header("Location: http://localhost/ClinicButler/adm.php?pass=Nsme");
      }

  }


//Select query from userdetails table   
$conn->close();

?>
