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
    if(isset($_GET['action'])){
      if($_GET['action']=='clinsearch'){
        $clinic_id=$_GET['clinic_id'];
        $clinic_name=$_GET['clinic_name'];
      }
    }else{
      $clinic_id="";
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

    $pcdate = date('Y-m-d');

    if(!empty($clinic_id)){
      $srchongocln = "SELECT * FROM clinic_calendar WHERE clinic_date>='$pcdate' AND clinicalendar_activation='1' AND clinic_id='$clinic_id' ORDER BY clinic_date";
      $smplelst = mysqli_query($conn, $srchongocln);
    }else {
      $srchongocln = "SELECT * FROM clinic_calendar WHERE clinic_date>='$pcdate' AND clinicalendar_activation='1' ORDER BY clinic_date";
      $smplelst = mysqli_query($conn, $srchongocln);
    }

  ?>

  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $pcdate = date('Y-m-d');

    if(!empty($clinic_id)){
      $srchongocln = "SELECT clinic_date,doc_name FROM ((clinic_calendar INNER JOIN clinic_details ON clinic_calendar.clinic_id = clinic_details.clinic_id)INNER JOIN doctor_details ON clinic_calendar.doc_regno = doctor_details.doc_regno) WHERE clinic_date>='$pcdate' AND clinicalendar_activation='1'";
      $dr = mysqli_query($conn, $srchongocln);
    }else {
      $srchongocln = "SELECT clinic_date,doc_name FROM ((clinic_calendar INNER JOIN clinic_details ON clinic_calendar.clinic_id = clinic_details.clinic_id)INNER JOIN doctor_details ON clinic_calendar.doc_regno = doctor_details.doc_regno) WHERE clinic_date>='$pcdate' AND clinicalendar_activation='1'";
      $dr = mysqli_query($conn, $srchongocln);
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
        <a href="http://localhost/ClinicButler/Home.php"><i class="fa fa-home fa-2x"></i></a>
        </div>

      </Nav>
      
    </div>

  </Header>

    <?php
      if (isset($_GET['errormsg'])) {
        if ($_GET['errormsg']=='nocln') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Check Clinic number Or Activation -!!');</script>";
          <?php
        }
      }
    ?>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">
      
        <div class="infctrlbtnbr">
          <div class="btnbar" id="bookForm">

              <div class="mtil">
                  <p><?php echo $_SESSION['section_name']; ?> Panal</p>
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/infor.php';"><i class="fa fa-stethoscope fa-1.5x"></i>&nbsp;&nbsp;DR. Clinics</button>
                   
              </div>

              <div class="btn_main">

                <button class="btn Proceed"><i class="fa fa-calendar-check fa-1.5x"></i>&nbsp;&nbsp;Clinic Calendar</button>
                
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick=" window.open('http://localhost/ClinicButler/inforclnicongo.php', '_blank'); return false;"><i class="fa fa-clock fa-1.5x"></i>&nbsp;&nbsp;Ongoin Clinics</button>
                
              </div>

          </div>
        </div>

        <div class="line"></div>

        <div class="infdtfrm">
                    
          <div class="dtcl" id="npd">

            <div class="secnme">

              <Nav class="snmetry">
                
                <div class="scname">
                
                  <div class="selog">
                    <a class="Logo">Clinics And Dates Informations</a>
                  </div>

                </div>
                
              </nav>

            </div>

            <div class="secinfdr" id="chpd">

              <div class="drinf">


                <form action="./crd/inforset.php" id="updtEmdt" method="POST">
                  <div class="drsrchbr">
                    <input type="text" id="clinic_id" name="clinic_id" placeholder="Clinic Number Or Name">
                    <button class="btn Proceed" id="srchwmp" name="action" value="srchclndt"><i class="fa fa-search fa-1.5x"></i></button>
                  </div>
                </form>
                    
                <div class="clnnme">
                  <p>Clinic Name:</p>
                  <input type="text" id="hospital_user_name" placeholder="Clinic Name"  value="<?php echo $clinic_name ?>" readonly>
                </div>

                <div class="clnno">
                  <p>Clinic Number:</p>
                  <input type="text" id="hospital_user_name" placeholder="Clinic Number"  value="<?php echo $clinic_id ?>" readonly>
                </div>

                <div class="clndlt">

                  <div class="alltblt">

                    <table  class="tblst" id="tb">
                      <tr class="tr-header">
                        <th class="DocIDtry">CLINIC DATE</th>
                        <th class="docname">DOCTOR NAME</th>
                      </tr>
                      <?php while($row1 = mysqli_fetch_array($dr)):;?>
                          <tr class="chckupINFO">
                            <td class="DocIDtry"><?php echo $row1[0]; ?></td>
                            <td class="docnametry"><?php echo $row1[1]; ?></td>
                          </tr>
                      <?php endwhile;?>
                    </table>

                  </div>

                </div>
                  
              </div>

              <div class="lnpg"></div>

              <div class="tmetbl">

                <div class="alltblt">

                  <table  class="tblst" id="tb">
                    <tr class="tr-header">
                      <th class="calID">ID</th>
                      <th class="ClnDT">DATE</th>
                      <th class="ClnFRm">FROM</th>
                      <th class="ClnTO">TO</th>
                      <th class="ClnROOM">ROOM</th>
                    </tr>
                      <?php while($row1 = mysqli_fetch_array($smplelst)):;?>
                        <tr class="chckupINFO">
                          <td class="calIDtry"><?php echo $row1[0]; ?></td>
                          <td class="ClnDTtry"><?php echo $row1[1]; ?></td>
                          <td class="ClnFRmtry"><?php echo $row1[2]; ?></td>
                          <td class="ClnTOtry"><?php echo $row1[3]; ?></td>
                          <td class="ClnROOMtry"><?php echo $row1[8]; ?></td>
                        </tr>
                      <?php endwhile;?>
                  </table>

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