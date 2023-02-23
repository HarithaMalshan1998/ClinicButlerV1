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

    $patient_regNum=$_SESSION['patient_regNum'];
    $pcdate = date('Y-m-d');

    $srchongocln = "SELECT patient_passbook.id,clinic_calendar.clinic_date, clinic_calendar.clinic_timeF, clinic_calendar.clinic_timeT, clinic_details.clinic_name, clin_room.id FROM (((patient_passbook INNER JOIN clinic_calendar ON patient_passbook.nxt_clinic_date = clinic_calendar.clinic_date) INNER JOIN clinic_details ON patient_passbook.clinic_id = clinic_details.clinic_id) INNER JOIN clin_room ON patient_passbook.clinic_id = clin_room.clinic_id) WHERE nxt_clinic_date>='$pcdate' AND patient_regNum='$patient_regNum' AND chck_activat='1'";
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

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">
      
        <div class="clndt">

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

              <button class="btn Proceed" style="background-color:rgba(194, 192, 192, 0.452);"><i class="fa fa-heartbeat fa-1.5x"></i>&nbsp;&nbsp;My Clinic</button>
                    
            </div>

            <div class="btn_main">

              <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/pistract.php';"><i class="fa fa-exclamation-circle fa-1.5x"></i>&nbsp;&nbsp;instructions</button>
                    
            </div>

            <div class="btn_main">

              <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/pcontact.php';"><i class="fa fa-phone-square fa-1.5x"></i>&nbsp;&nbsp;Contact Us</button>
                    
            </div>
          
          </div>

        </div>

        <div class="pclndt">
          
          <div class="advrdv">

            <div class="imgcnt">
              <a>My Clinics</a>
            </div>

          </div>

          <div class="dttdv">

            <div class="Clndtcndn">

                <div class="alltblt">

                  <table  class="tblst" id="tb">
                    <tr class="tr-header">
                      <th class="calID">ID</th>
                      <th class="ClnDT">DATE</th>
                      <th class="ClnFRm">FROM</th>
                      <th class="ClnTO">TO</th>
                      <th class="ClnNME">NAME OF THE CLINIC</th>
                      <th class="ClnROOM">CLINIC ROOM</th>
                    </tr>
                      <?php while($row1 = mysqli_fetch_array($smplelst)):;?>
                        <tr class="chckupINFO">
                          <td class="calIDtry"><?php echo $row1[0]; ?></td>
                          <td class="ClnDTtry"><?php echo $row1[1]; ?></td>
                          <td class="ClnFRmtry"><?php echo $row1[2]; ?></td>
                          <td class="ClnTOtry"><?php echo $row1[3]; ?></td>
                          <td class="ClnNMEtry"><?php echo $row1[4]; ?></td>
                          <td class="ClnROOMtry"><?php echo $row1[5]; ?></td>
                        </tr>
                      <?php endwhile;?>
                  </table>

                </div>

            </div>

          </div>

        </div>
        

      </div>

    </section>

  <script src="./Js/main.js"></script>
</body>

</html>