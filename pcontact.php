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
    
    <img class="mySlides" src="./images/dispen.jpg" style="height:100%; width:100%;">


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
  <!-- srch patient pris -->

  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $pcdate = date('Y-m-d');

    $srchongocln = "SELECT cliniccalendar_indx,clinic_date,clinic_timeF,clinic_timeT,clinic_name,doc_name,id FROM ((clinic_calendar INNER JOIN clinic_details ON clinic_calendar.clinic_id = clinic_details.clinic_id)INNER JOIN doctor_details ON clinic_calendar.doc_regno = doctor_details.doc_regno) WHERE clinic_date>='$pcdate' AND clinic_timeT>='$tme' AND clinicalendar_activation='1'";
    $smplelst = mysqli_query($conn, $srchongocln);

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
            <a onclick="location.href='http://localhost/ClinicButler/phome.php';"><i class="fa fa-home fa-2x"></i></a>
        </div>

      </Nav>
      
    </div>

  </Header>

  <?php
    if (isset($_GET['Message'])) {
      if ($_GET['Message']=='nopay') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - You Has Paid Half Of Checkup Bill. Therefore Checkup Reports Cannot Be Issued. - !!##');</script>";
        <?php
      }
      elseif ($_GET['Message']=='noup') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - The Checkup File Not Uploaded. - !!##');</script>";
        <?php
      }
    }
  ?>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">
      
        <div class="pcon">

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

              <button class="btn Proceed" style="background-color:rgba(194, 192, 192, 0.452);"><i class="fa fa-phone-square fa-1.5x"></i>&nbsp;&nbsp;Contact Us</button>
                    
            </div>
          
          </div>

        </div>

        <div class="pcontnum">
          
          <div class="advrdv">

            <div class="imgcnt">
              <a>Contact Us</a>
            </div>

          </div>

          <div class="dttdv">

            <div class="Clndtcndn">

              <div class="contcnumtry">

                <div class="chckupINFO">

                  <div class="numb"><a>Emergency Hotline	  –</a></div>
                  <div class="num"><a>1111 / 011 111 1111</a></div>

                </div>

                <div class="chckupINFO">

                  <div class="numb"><a>General Line	  – </a></div>
                  <div class="num"><a>011 111 1111</a></div>

                </div>

                <div class="chckupINFO">

                  <div class="numb"><a>Fax	  –</a></div>
                  <div class="num"><a>1111 / 011 111 1111</a></div>

                </div>

                <div class="chckupINFO">

                  <div class="numb"><a>Email	  –</a></div>
                  <div class="num"><a>ExampleEmail@gmail.coom</a></div>

                </div>

              </div>

            </div>

          </div>

        </div>
        

      </div>

    </section>

  <script src="./Js/main.js"></script>
</body>

</html>