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

if($action=='lab'){
  
  $section_user_name=$_POST['section_user_name'];
  $section_password=md5($_POST['section_password']);

  $sql = "SELECT * FROM section_staff WHERE section_user_name='$section_user_name' AND section_password='$section_password' ";
  $result = $conn->query($sql);
  
    if ($result->num_rows > 0) {
       // output data of each row
      while($row = $result->fetch_assoc()) {
        $section_ID=$row['section_ID'];
        $emp_activation=$row['emp_activation'];
      }

      if($emp_activation=='1'){

        $sql = "SELECT * FROM section WHERE section_ID='$section_ID'";
        $result = $conn->query($sql);
        $errorMessage="";
          if ($result->num_rows > 0) {
             // output data of each row
            while($row = $result->fetch_assoc()) {
              $section_name=$row['section_name'];
              $sec_activation=$row['sec_activation'];
            }

            if($section_name=='Laboratory'){

              if($sec_activation=='1'){

                    session_start();
                    $_SESSION['section_name']=$section_name;
                    header("Location: http://localhost/ClinicButler/laboratory.php");

              }else{
                header("Location: http://localhost/ClinicButler/Home.php?errorMessage=secactiv");                
              }

            }
            elseif($section_name=='Main Laboratory'){

              if($sec_activation=='1'){

                    session_start();
                    $_SESSION['section_name']=$section_name;
                    header("Location: http://localhost/ClinicButler/laboratorymain.php");

              }else{
                header("Location: http://localhost/ClinicButler/Home.php?errorMessage=secactiv");                
              }

            }
            else{
              header("Location: http://localhost/ClinicButler/Home.php?errorMessage=secerror");
            }
          
          }else {
              header("Location: http://localhost/ClinicButler/Home.php?errorMessage=wrngsec");
            }

      }else{
        header("Location: http://localhost/ClinicButler/Home.php?errorMessage=EMPaccactive");
      }
    
    }else {
        header("Location: http://localhost/ClinicButler/Home.php?errorMessage=usernmeorpass");
    }

}elseif ($action=='clini'){
  
  $section_user_name=$_POST['section_user_name'];
  $section_password=md5($_POST['section_password']);
  $doc_regno=$_POST['doc_regno'];
  $auth = gethostname();
  $pcdate = date('Y-m-d');  

  $sql = "SELECT * FROM doctor_details WHERE doc_username='$section_user_name' AND doc_password='$section_password' AND doc_regno='$doc_regno' ";
  $result = $conn->query($sql);
    if ($result->num_rows > 0) {
       // output data of each row
      while($row = $result->fetch_assoc()) {
        $doc_name=$row['doc_name'];
        $doc_activation =$row['doc_activation'];
        $doc_regno=$row['doc_regno'];
        $clinic_id1=$row['clinic_id'];
        }

        if($doc_activation=='1'){

          $sql = "SELECT * FROM clinic_calendar WHERE clinic_id='$clinic_id1' AND doc_regno='$doc_regno' AND clinic_date='$pcdate'";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            // output data of each row
           while($row = $result->fetch_assoc()) {
             $clinic_activation=$row['clinic_activation'];
             $id=$row['id'];
             $clinicalendar_activation=$row['clinicalendar_activation'];
             $clinic_date=$row['clinic_date'];
             $clinic_id=$row['clinic_id'];
           }

           if($clinic_activation=='1'){

            if($clinic_date==$pcdate){

              if($clinicalendar_activation=='1'){

                $sql = "SELECT * FROM clin_room WHERE id='$id'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  // output data of each row
                 while($row = $result->fetch_assoc()) {
                   $room_device=$row['room_device'];
                   $room_activ=$row['room_activ'];
                 }

                 if($room_device==$auth){

                  if($room_activ=='1'){
                    session_start();
                    $_SESSION['doc_name']=$doc_name;
                    $_SESSION['clinic_id']=$clinic_id;
                    $_SESSION['doc_regno']=$doc_regno;
                    header("Location: http://localhost/ClinicButler/clinic.php");
                  }else{
                   header("Location: http://localhost/ClinicButler/Home.php?errorMessage=errorroomact");
                  }

                 }else{
                  header("Location: http://localhost/ClinicButler/Home.php?errorMessage=errordevice");
                 }

                }else{
                  header("Location: http://localhost/ClinicButler/Home.php?errorMessage=errorroom");
                }

              }else{
               header("Location: http://localhost/ClinicButler/Home.php?errorMessage=errorddtact");
              }

            }else{
             header("Location: http://localhost/ClinicButler/Home.php?errorMessage=errorddt");
            }

           }else{
            header("Location: http://localhost/ClinicButler/Home.php?errorMessage=errorclinact");
           }

          }else{
            header("Location: http://localhost/ClinicButler/Home.php?errorMessage=errorddt");
          }

        }else{
          header("Location: http://localhost/ClinicButler/Home.php?errorMessage=EMPaccactive");
        }

    }else{
      header("Location: http://localhost/ClinicButler/Home.php?errorMessage=usernmeorpassd");
    }
        
}elseif ($action=='dis'){

  $section_user_name=$_POST['section_user_name'];
  $section_password=md5($_POST['section_password']);

  $sql = "SELECT * FROM section_staff WHERE section_user_name='$section_user_name' AND section_password='$section_password' ";
  $result = $conn->query($sql);
  $errorMessage="";
    if ($result->num_rows > 0) {
       // output data of each row
      while($row = $result->fetch_assoc()) {
        $section_ID=$row['section_ID'];
        $emp_activation=$row['emp_activation'];
      }

      if($emp_activation=='1'){

        $sql = "SELECT * FROM section WHERE section_ID='$section_ID'";
        $result = $conn->query($sql);
        $errorMessage="";
          if ($result->num_rows > 0) {
             // output data of each row
            while($row = $result->fetch_assoc()) {
              $section_name=$row['section_name'];
              $sec_activation=$row['sec_activation'];
            }

            if($section_name=='Dispensary'){

              if($sec_activation=='1'){

                    session_start();
                    $_SESSION['section_name']=$section_name;
                    header("Location: http://localhost/ClinicButler/dispen.php");

              }else{
                header("Location: http://localhost/ClinicButler/Home.php?erro=secactiv");                
              }

            }else{
              header("Location: http://localhost/ClinicButler/Home.php?erro=secerror");
            }
          
          }else {
              header("Location: http://localhost/ClinicButler/Home.php?error=wrngsec");
            }

      }else{
        header("Location: http://localhost/ClinicButler/Home.php?erro=EMPaccactive");
      }
    
    }else {
        header("Location: http://localhost/ClinicButler/Home.php?errorMessage=usernmeorpass");
      }

}elseif ($action=='rc'){

  $section_user_name=$_POST['section_user_name'];
  $section_password=md5($_POST['section_password']);

  $sql = "SELECT * FROM section_staff WHERE section_user_name='$section_user_name' AND section_password='$section_password' ";
  $result = $conn->query($sql);
  $errorMessage="";
    if ($result->num_rows > 0) {
       // output data of each row
      while($row = $result->fetch_assoc()) {
        $section_ID=$row['section_ID'];
        $emp_activation=$row['emp_activation'];
      }

      if($emp_activation=='1'){

        $sql = "SELECT * FROM section WHERE section_ID='$section_ID'";
        $result = $conn->query($sql);
        $errorMessage="";
          if ($result->num_rows > 0) {
             // output data of each row
            while($row = $result->fetch_assoc()) {
              $section_name=$row['section_name'];
              $sec_activation=$row['sec_activation'];
            }

            if($section_name=='Registration & Changes'){

              if($sec_activation=='1'){

                    session_start();
                    $_SESSION['section_name']=$section_name;
                    header("Location: http://localhost/ClinicButler/regANcha.php");

              }else{
                header("Location: http://localhost/ClinicButler/Home.php?erro=secactiv");                
              }

            }else{
              header("Location: http://localhost/ClinicButler/Home.php?erro=secerror");
            }
          
          }else {
              header("Location: http://localhost/ClinicButler/Home.php?error=wrngsec");
            }

      }else{
        header("Location: http://localhost/ClinicButler/Home.php?erro=EMPaccactive");
      }
    
    }else {
        header("Location: http://localhost/ClinicButler/Home.php?errorMessage=usernmeorpass");
      }

}elseif ($action=='info'){

  $section_user_name=$_POST['section_user_name'];
  $section_password=md5($_POST['section_password']);

  $sql = "SELECT * FROM section_staff WHERE section_user_name='$section_user_name' AND section_password='$section_password' ";
  $result = $conn->query($sql);
  $errorMessage="";
    if ($result->num_rows > 0) {
       // output data of each row
      while($row = $result->fetch_assoc()) {
        $section_ID=$row['section_ID'];
        $emp_activation=$row['emp_activation'];
      }

      if($emp_activation=='1'){

        $sql = "SELECT * FROM section WHERE section_ID='$section_ID'";
        $result = $conn->query($sql);
        $errorMessage="";
          if ($result->num_rows > 0) {
             // output data of each row
            while($row = $result->fetch_assoc()) {
              $section_name=$row['section_name'];
              $sec_activation=$row['sec_activation'];
            }

            if($section_name=='Information'){

              if($sec_activation=='1'){

                    session_start();
                    $_SESSION['section_name']=$section_name;
                    header("Location: http://localhost/ClinicButler/infor.php");

              }else{
                header("Location: http://localhost/ClinicButler/Home.php?erro=secactiv");                
              }

            }else{
              header("Location: http://localhost/ClinicButler/Home.php?erro=secerror");
            }
          
          }else {
              header("Location: http://localhost/ClinicButler/Home.php?error=wrngsec");
            }

      }else{
        header("Location: http://localhost/ClinicButler/Home.php?erro=EMPaccactive");
      }
    
    }else {
        header("Location: http://localhost/ClinicButler/Home.php?errorMessage=usernmeorpass");
      }
}elseif ($action=='add'){

  $section_user_name=$_POST['section_user_name'];
  $section_password=md5($_POST['section_password']);

  $sql = "SELECT * FROM section_staff WHERE section_user_name='$section_user_name' AND section_password='$section_password' ";
  $result = $conn->query($sql);
  $errorMessage="";
    if ($result->num_rows > 0) {
       // output data of each row
      while($row = $result->fetch_assoc()) {
        $section_ID=$row['section_ID'];
        $emp_activation=$row['emp_activation'];
      }

      if($emp_activation=='1'){

        $sql = "SELECT * FROM section WHERE section_ID='$section_ID'";
        $result = $conn->query($sql);
        $errorMessage="";
          if ($result->num_rows > 0) {
             // output data of each row
            while($row = $result->fetch_assoc()) {
              $section_name=$row['section_name'];
              $sec_activation=$row['sec_activation'];
            }

            if($section_name=='Admin'){

              if($sec_activation=='1'){

                    session_start();
                    $_SESSION['section_name']=$section_name;
                    header("Location: http://localhost/ClinicButler/adm.php");

              }else{
                header("Location: http://localhost/ClinicButler/Home.php?erro=secactiv");                
              }

            }else{
              header("Location: http://localhost/ClinicButler/Home.php?erro=secerror");
            }
          
          }else {
              header("Location: http://localhost/ClinicButler/Home.php?error=wrngsec");
            }

      }else{
        header("Location: http://localhost/ClinicButler/Home.php?erro=EMPaccactive");
      }
    
    }else {
        header("Location: http://localhost/ClinicButler/Home.php?errorMessage=usernmeorpass");
      }
}
$conn->close();
?>