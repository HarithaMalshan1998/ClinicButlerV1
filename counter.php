<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="./css/main.css" />
  <title>ClinicButler</title>
  <!-- add icon to web page. -->
  <link rel="shortcut icon" href="./images/faicon.ico">

</head>

<body>

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

?>

  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $clinid=$_SESSION['clinic_id'];

    $sql = "SELECT * FROM clinic_details WHERE clinic_id='$clinid'";
      $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $clinic_name =$row['clinic_name'];
            }
        }else {
          $clinic_name="";
        }

  ?>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $clinid=$_SESSION['clinic_id'];
    $doc_regno=$_SESSION['doc_regno'];
    $pcdate = date('Y-m-d');

    $sql = "SELECT COUNT(patient_regNum) AS cnt FROM patient_passbook WHERE clinic_id='$clinid' AND doc_regno='$doc_regno' AND consult_date='$pcdate'";
      $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $cnt =$row['cnt'];
            }
        }else {
          $cnt="";
        }

  ?>

  <Header>

    <div class="container">

      <Nav class="nav">
        <div class="hnlogo">
          <a class="Logo"><?php echo $_SESSION['hospital_name']; ?></a>
          <div class="slogo">
            <nalogo class="Logo">Clinic Manegment System</nalogo>
          </div>
        </div>

        <div class="nav-items">
        <a href="http://localhost/ClinicButler/clinic.php"><i class="fa fa-arrow-left fa-2x"></i></a>
        </div>

      </Nav>
      
    </div>

  </Header>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">

        <div class="docdt">
          
          <div class="sectionName">
            <a class="Logo">About The Doctor</a>
          </div>

          <div class="dvline"></div>

          <div class="aldrinf">

            <div class="drnme">
              <a class="drfnme">Doctor Full Name:</a>
            </div>
            <div class="dvline"></div>

            <div class="drflnme">
              <a class="dr">DR. <?php echo $_SESSION['doc_name']; ?></a>
            </div>

            <div class="drregnum">
              <a class="drfnme">Doctor Registration Num#:</a>
            </div>
            <div class="dvline"></div>

            <div class="drrgn">
              <a class="dr"> <?php echo $_SESSION['doc_regno']; ?></a>
            </div>

            <div class="drclin">
              <a class="drfnme">Doctor Clinic Number:</a>
            </div>
            <div class="dvline"></div>

            <div class="drclinnum">
              <a class="dr"> <?php echo $_SESSION['clinic_id']; ?></a>
            </div>

            <div class="drclinnme">
              <a class="drfnme">Clinic Name:</a>
            </div>
            <div class="dvline"></div>

            <div class="clinnme">
              <a class="dr"> <?php echo $clinic_name ?></a>
            </div>

          </div>

        </div>

        <div class="line"></div>

        <div class="dtfrm">
          <!-- search tab -->
          <div class="srch_pdcontainer">
            <Nav class="pdatsrch">

              <a class="Logo">Today Consult Patient Count</a>

            </Nav>  
          </div>
          <!-- end of search tab -->
          
          <!-- data show -->
          <div class="pdtshw">

            <div class="aldt">

              <a class="Logo"> <?php if($cnt<10){echo "000".$cnt;}elseif($cnt<100){echo "00".$cnt;}elseif($cnt<1000){echo "0".$cnt;}elseif($cnt>=1000){echo $cnt;}elseif($cnt=="0"){echo "0000";} ?> </a>
              
            </div>

          </div>

        </div>

      </div>

    </section>
  <script src="./Js/main.js"></script>
</body>

</html>