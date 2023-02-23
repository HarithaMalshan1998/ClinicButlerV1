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
      if($_GET['action']=='docsearch'){
        $doc_name=$_GET['doc_name'];
        $doc_regno=$_GET['doc_regno'];
        $doc_nic=$_GET['doc_nic'];
        $gender=$_GET['gender'];
      }
    }else{
      $doc_name="";
      $doc_regno="";
      $doc_nic="";
      $gender="";
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

    if(!empty($doc_regno)){
      $srchongocln = "SELECT * FROM clinic_calendar WHERE doc_regno='$doc_regno' AND clinic_date>='$pcdate' AND clinicalendar_activation='1'";
      $smplelst = mysqli_query($conn, $srchongocln);
    }else {      
      $srchongocln = "SELECT * FROM clinic_calendar WHERE clinic_date>='$pcdate' AND clinicalendar_activation='1'";
      $smplelst = mysqli_query($conn, $srchongocln);
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
        if ($_GET['errormsg']=='nodr') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Wrong Doctor Number Or Doctor Name -!!');</script>";
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

                <button class="btn Proceed"><i class="fa fa-stethoscope fa-1.5x"></i>&nbsp;&nbsp;DR. Clinics</button>
                   
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/inforclniclndr.php';"><i class="fa fa-calendar-check fa-1.5x"></i>&nbsp;&nbsp;Clinic Calendar</button>
                
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick=" window.open('http://localhost/ClinicButler/inforclnicongo.php', '_blank'); return false;"><i class="fa fa-clock fa-1.5x"></i>&nbsp;&nbsp;Ongoin Clinics</button>
                
              </div>

          </div>
        </div>

        <div class="line"></div>

        <div class="infdtfrm">
                    
          <div class="drcl" id="npd">

            <div class="secnme">

              <Nav class="snmetry">
                
                <div class="scname">
                
                  <div class="selog">
                    <a class="Logo">Clinics Acording To The Doctor</a>
                  </div>

                </div>
                
              </nav>

            </div>

            <div class="secinfdr" id="chpd">

              <div class="drinf">

                <form action="./crd/inforset.php" id="updtEmdt" method="POST">
                  <div class="drsrchbr">
                      <input type="text" id="dr_n" name="dr_n" placeholder="Dr.Reg Number Or Name">
                      <button class="btn Proceed" id="srchbdr" name="action" value="srchbdr"><i class="fa fa-search fa-1.5x"></i></button>
                  </div>
                </form>
                    
                <div class="dnme">
                  <p>Doc Name:</p>
                  <input type="text" id="hospital_user_name" placeholder="Doc Name" value="<?php echo $doc_name ?>" readonly>
                </div>

                <div class="dno">
                  <p>Doc Number:</p>
                  <input type="text" id="hospital_user_name" placeholder="Doc Number" value="<?php echo $doc_regno ?>" readonly>
                </div>

                <div class="dnic">
                  <p>Doc NIC:</p>
                  <input type="text" id="hospital_user_name" placeholder="Doc NIC" value="<?php echo $doc_nic ?>"  readonly>
                </div>

                <div class="dgen">
                  <p>Doc gender:</p>
                  <input type="text" id="hospital_user_name" placeholder="Doc gender" value="<?php echo $gender ?>" readonly>
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