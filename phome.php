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
      if (!isset($_SESSION['patient_regNum']) or $_SESSION['patient_regNum']=="" ){
          session_destroy();   
          header("Location: ./crd/pat/plgout.php");
        }

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

  ?>

  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $patient_regNum=$_SESSION['patient_regNum'];

    $sql = "SELECT * FROM patient_data WHERE patient_regNum='$patient_regNum'";
      $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $patient_fullName=$row['patient_fullName'];
                $patient_Mobile=$row['patient_Mobile'];
                $patient_fixed_Number=$row['patient_fixed_Number'];
            }
        }else {
          $patient_fullName="";
          $patient_Mobile="";
          $patient_fixed_Number="";
        }

  ?>
  <!-- //date countdown -->
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $patient_regNum=$_SESSION['patient_regNum'];
    $pcdate = date('Y-m-d');

    $sql = "SELECT * FROM patient_passbook WHERE patient_regNum='$patient_regNum' AND chck_activat='1' AND nxt_clinic_date>='$pcdate' ORDER BY nxt_clinic_date ASC LIMIT 1";
      $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $nxt_clinic_date=$row['nxt_clinic_date'];
            }

            $sql = "SELECT COUNT(chck_activat) AS dtcnt FROM patient_passbook WHERE nxt_clinic_date='$nxt_clinic_date' AND patient_regNum='$patient_regNum' AND chck_activat='1'";
            $result = $conn->query($sql);
      
              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      $dtcnt=$row['dtcnt'];
                  }
              }else {
                $dtcnt="";
              }

        }else {
          $nxt_clinic_date="";
        }

  ?>

  <?php

    $pcdate = date('Y-m-d');

    if($pcdate==$nxt_clinic_date){

      $msg="You Have Clinic ";

    }else{

      $start = new DateTime($nxt_clinic_date);
      $end = new DateTime(date('Y-m-d'));

      $interval = $end->diff($start);
      $days = $interval->days;
      
    }

  ?>

  <Header>

    <div class="container">

      <Nav class="nav">
        <div class="hnlogo">
          <a class="Logo">CLINIC BUTLER</a>
          <div class="slogo">
            <nalogo class="Logo">Patient Clinical Data Manegment System.</nalogo>
          </div>
        </div>

        <div class="nav-items">
        <a onclick="location.href='./crd/pat/plgout.php';"><i class="fa fa-power-off fa-2x"></i></a>
        </div>

      </Nav>
      
    </div>

  </Header>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">
      
        <div class="pnavtb">

          <div class="pro" onclick="location.href='http://localhost/ClinicButler/ppasssup.php';">

            <div class="proim">
              <a><i class="fa fa-user-circle"></i></a>            
            </div>

            <div class="prodt">

              <div class="panme">
                <a><?php echo $patient_fullName; ?></a>
              </div>

              <div class="patpn">
                <a><?php if($patient_fixed_Number=='0' AND $patient_Mobile=='0'){echo "0";}elseif($patient_fixed_Number=='0'){echo $patient_Mobile;}elseif($patient_Mobile=='0'){echo $patient_fixed_Number;}elseif($patient_fixed_Number==$patient_fixed_Number AND $patient_Mobile==$patient_Mobile){echo $patient_Mobile;} ?></a>
              </div>

            </div>

          </div>

          <div class="btnbr">

            <div class="btn_main">

              <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/ppriscpt.php';"><i class="fa fa-list-alt fa-1.5x"></i>&nbsp;&nbsp;priscription</button>
                    
            </div>

            <div class="btn_main">

              <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/pchckupanrslt.php';"><i class="fa fa-flask fa-1.5x"></i>&nbsp;&nbsp;CheckUPS</button>
                    
            </div>

            <div class="btn_main">

              <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/pmycln.php';"><i class="fa fa-heartbeat fa-1.5x"></i>&nbsp;&nbsp;My Clinic</button>
                    
            </div>

            <div class="btn_main">

              <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/pistract.php';"><i class="fa fa-exclamation-circle fa-1.5x"></i>&nbsp;&nbsp;instructions</button>
                    
            </div>

            <div class="btn_main">

              <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/pcontact.php';"><i class="fa fa-phone-square fa-1.5x"></i>&nbsp;&nbsp;Contact Us</button>
                    
            </div>
          
          </div>

        </div>

        <div class="phcon">
          
          <div class="advrdv">

            <div class="imgcnt">

              <img class="mySlides" src="./images/pimg/1.jpg">
              <img class="mySlides" src="./images/pimg/2.jpg">
              <img class="mySlides" src="./images/pimg/3.jpg">
              <img class="mySlides" src="./images/pimg/4.jfif">
              <img class="mySlides" src="./images/pimg/5.jpg">
              <img class="mySlides" src="./images/pimg/6.jpg">
              
              <script>
                var myIndex = 0;
                carousel();

                function carousel() {
                  var i;
                  var x = document.getElementsByClassName("mySlides");
                    for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";  
                    }
                    myIndex++;
                    if (myIndex > x.length) {myIndex = 1}    
                    x[myIndex-1].style.display = "block";  
                    setTimeout(carousel, 3700); // Change image every 2 seconds
                }
              </script>
              
            </div>

          </div>

          <div class="dttdv">

            <div class="Clndtcndn">
              <a>

                <?php if($nxt_clinic_date==''){echo "You currently have no clinics";}elseif($days=='1' AND $dtcnt=='1'){echo "$days More Day To Clinic";}elseif($days>'1' AND $dtcnt=='1'){echo "You Also Have $days Day To Clinic";}else{echo "You Also Have $days Days To Clinics";} ?>
              
              </a>              
            </div>

            <div class="ddtlnk">
              <a><?php echo $nxt_clinic_date; ?></a>
            </div>

          </div>

        </div>
        

      </div>

    </section>

  <script src="./Js/main.js"></script>
</body>

</html>