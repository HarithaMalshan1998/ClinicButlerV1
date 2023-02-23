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
    header("Location: http://localhost/ClinicButler/login.php");
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
      if($_GET['action']=='search'){
        $patient_regNum=$_GET['patient_regNum'];
        $patient_fullName=$_GET['patient_fullName'];
        $clinic_id=$_GET['clinic_id'];
        $patient_clinic_date=$_GET['patient_clinic_date'];
      }
    }else{
      $patient_regNum="";
      $patient_fullName="";
      $clinic_id="";
      $patient_clinic_date="";
    }
  ?>

  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $resultdocsrch = $conn->query("SELECT * FROM doctor_details WHERE clinic_id='$clinic_id' AND doc_activation='1'") 

  ?>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $pcdate = date('Y-m-d');

    if(empty($clinic_id)){

      $srchclinidttbl = "SELECT * FROM clinic_calendar WHERE clinic_date>='$pcdate' AND clinicalendar_activation='1' ORDER BY clinic_date";
      $datadate = mysqli_query($conn, $srchclinidttbl);

    }else{

      $srchclinidttbl = "SELECT * FROM clinic_calendar WHERE clinic_date>='$pcdate' AND clinicalendar_activation='1' AND clinic_id='$clinic_id' ORDER BY clinic_date";
      $datadate = mysqli_query($conn, $srchclinidttbl);

    }

  ?>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);    

    $sql = "SELECT * FROM clinic_details WHERE clinic_id='$clinic_id'";
    $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $clinic_name=$row['clinic_name'];
            }
        
        }else {
          $clinic_name="";
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
      if (isset($_GET['updat'])) {
        if ($_GET['updat']=='yes') {
          ?>
            echo "<script type='text/javascript'>alert('Update Patient Clinic Date');</script>";
          <?php
        }
      }
    ?>

    <?php
      if (isset($_GET['errorMessage'])) {
        if ($_GET['errorMessage']=='no') {
          ?>
            echo "<script type='text/javascript'>alert('!!- please double-check enterd patient registration or NIC numer -!!');</script>";
          <?php
        }
        elseif ($_GET['errorMessage']=='Ddterr') {
          ?>
            echo "<script type='text/javascript'>alert('!!- Error In Clinic Date & Clinic ID -!!');</script>";
          <?php
        }
        elseif ($_GET['errorMessage']=='olddate') {
          ?>
            echo "<script type='text/javascript'>alert('!!- That Date Is Old Date -!!');</script>";
          <?php
        }
        elseif ($_GET['errorMessage']=='nodate') {
          ?>
            echo "<script type='text/javascript'>alert('!!- There Are No Clinick In That Date -!!');</script>";
          <?php
        }
        elseif ($_GET['errorMessage']=='error') {
          ?>
            echo "<script type='text/javascript'>alert('!!- Error In Clinic Update -!!');</script>";
          <?php
        }
      }
    ?>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">
      
        <div class="rgnavtb">
          <div class="btnbar" id="bookForm">

              <div class="mtil">
                  <p><?php echo $_SESSION['section_name']; ?></p>
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/regANcha.php';" ><i class="fa fa-user-plus fa-1.5x"></i>&nbsp;&nbsp;Enter New Patient</button>
                
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/regANchaupdt.php';" ><i class="fa fa-wrench fa-1.5x"></i>&nbsp;&nbsp;Change Patient Details</button>
                
              </div>

              <div class="btn_main">

                <button class="btn Proceed" ><i class="fa fa-calendar-check fa-1.5x"></i>&nbsp;&nbsp;Change Clinic Date</button>
                
              </div>

          </div>
        </div>

        <div class="line"></div>

        <div class="dtfrm">
          
          <div class="CHNCLINIDT" id="chcd">
            <!-- change clinic date frm -->
            <div class="dttry">
              <!-- oneside -->
              <div class="nwpdtfrm">

                <div class="secnme">
                  <Nav class="snmetry">
                    <div class="scname">
                      <a class="Logo">Change Clinic Date</a>
                    </div>
                  </nav>
                  <div class="undrlin"></div>
                </div>
                <!-- startdataform -->
                <div class="upclinidtfrm">
                  <form action="./crd/REGsec.php" id="updtCliniDT" method="POST">

                  <div class="CPinwfnme">
                    <p>Name With Initials</p>
                    <input type="text" id="patient_fullName" name="patient_fullName" placeholder="Patient Name With Initials" value="<?php echo $patient_fullName ?>" readonly>
                    <input class="regnum" type="text" id="patient_regNum" name="patient_regNum" placeholder="Patient Registration Number" value="<?php echo $patient_regNum ?>" readonly>
                  </div>

                  <div class="clininum">
                    <p>Clinic Number:</p>
                    <input type="text" id="clinic_id" name="clinic_id" placeholder="Clinic Number" value="<?php echo $clinic_id ?>"readonly>
                    <input class="clininME" type="text" id="hospital_user_name" name="search_checkup_report" placeholder="Clinic Name" value="<?php echo $clinic_name ?>"readonly>
                  </div>

                  <div class="oLdClinidt">
                    <p>Old Clinic Date: &nbsp;&nbsp;&nbsp;&nbsp;</P>
                    <input type="text" id="old_clinic_date" name="old_clinic_date" placeholder="Patient Old Clinic Date" value="<?php echo $patient_clinic_date ?>" readonly>
                  </div>

                  <div class="DRNmer">
                    <p>Doctor Name :&nbsp;&nbsp;</P>
                    <select name="doc_regno" id="doc_regno">
                      <option value="" selected="Doctor Name" disabled >Doctor Name</option>
                      <?php
                      while($rows = $resultdocsrch->fetch_assoc()){
                        $doc_regno = $rows['doc_regno'];
                        $doc_name = $rows['doc_name'];
                        echo "<option value='$doc_regno'>$doc_regno-$doc_name</option>";
                      }
                      ?>
                    </select>
                  </div>

                  <div class="NWclinidt">
                    <p>New Clinic Date: &nbsp;&nbsp;</P>
                    <input type="date" id="new_cliniDT" name="new_cliniDT" placeholder="Patient New Clinic Date" required>
                    <button class="btn Proceed" id="updtCliniDT" name="action" value="updtCliniDT"><i class="fa fa-upload fa-1.5x"></i>&nbsp;&nbsp;CHANGE</button>
                  </div>
                  </form>

                  <div class="alonclinidt">
                    <p>Onwards Clinics:</p>
                    <div class="allclinidt">

                      <table  class="clinitblbdy" id="tb">
                        <tr class="tr-header">
                          <th class="clinicID">CLINIC ID</th>
                          <th class="clinicDTTRY">DATE</th>
                          <th class="clinicFRM">FROM</th>
                          <th class="clinicTO">TO</th>
                        </tr>
                        <?php while($row1 = mysqli_fetch_array($datadate)):;?>
                          <tr class="cliniINFO">
                            <td class="clinicIdty"><?php echo $row1[4]; ?></td>
                            <td class="cliniDTdt"><?php echo $row1[1]; ?></td>
                            <td class="cliniDTfrm"><?php echo $row1[2]; ?></td>
                            <td class="cliniDTto"><?php echo $row1[3]; ?></td>
                          </tr>
                        <?php endwhile;?>
                      </table>

                    </div>
                  </div>

                </div>
                <!-- enddataform -->
              </div>
              <!-- endofoneside -->
              <!-- otherside -->
              <div class="nwrgnm">
                
                <div class="prenum">

                  <Nav class="rgnsec">
                    <div class="renwnum">
                      <a class="Logo">Verify Patient Data&nbsp;&nbsp;<i class="fa fa-id-badge fa-1.5x"></i></a>
                    </div>
                  </nav>

                </div>

                <div class="Prgnumnic">
                  <form action="./crd/REGsec.php" id="srchcPdt" method="POST">
                    <input type="text" id="patient_regNum" name="patient_regNum" placeholder="Registration Or NIC Number">
                    <input type="text" id="clinic_id" name="clinic_id" placeholder="Clinic Number">
                    <input type="date" id="Old_clini_date" name="Old_clini_date" placeholder="Old Clinic Date">
                    <button class="btn Proceed" id="srchcPdt" name="action" value="srchcPdt"><i class="fa fa-search fa-1.5x"></i></button>
                  </form>
                </div>

                <div class="clrbtn">
                  <button class="btn Cancel" onclick="location.href='http://localhost/ClinicButler/regANchacliniup.php';"><i class="fa fa-eraser fa-2x"></i></button>
                </div>
                
              </div>
              <!-- endofotherside -->
              
            </div>
            <!-- end change clinic date frm -->
          </div>

        </div>
        
      </div>

    </section>
</body>

</html>