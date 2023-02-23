<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="refresh" content="3">

  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="./css/main.css" />
  <title>ClinicButler</title>
  <!-- add icon to web page. -->
  <link rel="shortcut icon" href="./images/faicon.ico">
</head>

<body>
    
  <img class="mySlides" src="./images/ongo.jfif" style="height:100%; width:100%;">


<?php
  session_start();
  if (!isset($_SESSION['section_name']) or $_SESSION['section_name']=="" ){
      session_destroy();   
      header("Location: http://localhost/ClinicButler/Home.php");
    }elseif (!isset($_SESSION['hospital_name']) or $_SESSION['hospital_name']=="" ){
      session_destroy();   
    header("Location: ./crd/logout.php");
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
    date_default_timezone_set('Asia/Colombo');
    $tme = date('H:i:s');

    $pcdate = date('Y-m-d');

    $srchongocln = "SELECT cliniccalendar_indx,clinic_date,clinic_timeF,clinic_timeT,clinic_name,doc_name,id FROM ((clinic_calendar INNER JOIN clinic_details ON clinic_calendar.clinic_id = clinic_details.clinic_id)INNER JOIN doctor_details ON clinic_calendar.doc_regno = doctor_details.doc_regno) WHERE clinic_date='$pcdate' AND clinic_timeT>='$tme' AND clinicalendar_activation='1'";
    $smplelst = mysqli_query($conn, $srchongocln);

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
        <a onclick="javascript:window.close()"><i class="fa fa-times-circle fa-2x"></i></a>
        </div>

      </Nav>
      
    </div>

  </Header>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">

        <div class="ongocln">

            <div class="logo">
                <a>SECTION ONGOING CLINICS</a>
            </div>
            
            <div class="tbl">

                <div class="alltblt">

                  <table  class="tblst" id="tb">
                    <tr class="tr-header">
                      <th class="calID">ID</th>
                      <th class="ClnDT">DATE</th>
                      <th class="ClnFRm">FROM</th>
                      <th class="ClnTO">TO</th>
                      <th class="ClnNME">NAME OF THE CLINIC</th>
                      <th class="ClnDR">NAME OF THE DOCTOR</th>
                      <th class="ClnROOM">CLINIC ROOM</th>
                    </tr>
                      <?php while($row1 = mysqli_fetch_array($smplelst)):;?>
                        <tr class="chckupINFO">
                          <td class="calIDtry"><?php echo $row1[0]; ?></td>
                          <td class="ClnDTtry"><?php echo $row1[1]; ?></td>
                          <td class="ClnFRmtry"><?php echo $row1[2]; ?></td>
                          <td class="ClnTOtry"><?php echo $row1[3]; ?></td>
                          <td class="ClnNMEtry"><?php echo $row1[4]; ?></td>
                          <td class="ClnDRtry"><?php echo $row1[5]; ?></td>
                          <td class="ClnROOMtry"><?php echo $row1[6]; ?></td>
                        </tr>
                      <?php endwhile;?>
                  </table>

                </div>
            </div>

        </div>

      </div>

    </section>
  <script src="./Js/main.js"></script>
</body>

</html>