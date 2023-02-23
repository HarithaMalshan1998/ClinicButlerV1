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
    if(isset($_GET['action'])){
      if($_GET['action']=='search'){
        $patient_regNum=$_GET['patient_regNum'];
        $patient_fullName=$_GET['patient_fullName'];
        $patient_Dob=$_GET['patient_Dob'];
        $patient_Gender=$_GET['patient_Gender'];
        $age=$_GET['age'];
        // $patient_Mobile=$_GET['patient_Mobile'];
        // $patient_fixed_Number=$_GET['patient_fixed_Number'];
        // $patient_email=$_GET['patient_email'];
        // $patient_Address=$_GET['patient_Address'];
      }else{
        $patient_regNum="";
        $patient_fullName="";
        $patient_Dob="";
        $patient_Gender="";
        $age="";
        // $patient_Mobile="";
        // $patient_fixed_Number="";
        // $patient_email="";
        // $patient_Address="";
      }
    }else{
      $patient_regNum="";
      $patient_fullName="";
      $patient_Dob="";
      $patient_Gender="";
      $age="";
      // $patient_Mobile="";
      // $patient_fixed_Number="";
      // $patient_email="";
      // $patient_Address="";
    }
  ?>

  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $clinic_id =$_SESSION['clinic_id'];

    $sql = "SELECT * FROM patient_passbook WHERE patient_regNum='$patient_regNum' AND chck_activat='1' AND clinic_id='$clinic_id'";
      $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $consult_date =$row['consult_date'];
                $disF_patient =$row['disF_patient'];
                $dis_stts =$row['dis_stts'];
                $commF_patient =$row['commF_patient'];
                $chckup_lst =$row['chckup_lst'];
                $drg_lst =$row['drg_lst'];
                $clinic_iD =$row['clinic_id'];
            }
        }else {
          $consult_date="YYYY-MM-DD";
          $disF_patient="";
          $dis_stts="";
          $commF_patient="";
          $chckup_lst="";
          $drg_lst="";
          $clinic_iD="";
        }

  ?>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $srchcheckupsmpl = "SELECT * FROM sample_reslt WHERE patient_regNum='$patient_regNum' AND clinic_id='$clinic_iD' AND activations='1' AND upload='1' ORDER BY id";
    $smplelst = mysqli_query($conn, $srchcheckupsmpl);

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
      if (isset($_GET['errorMessage'])) {
        if ($_GET['errorMessage']=='no') {
          ?>
            echo "<script type='text/javascript'>alert('##!! - Wrong Patient Registration Number - !!##');</script>";
          <?php
        }
        elseif ($_GET['errorMessage']=='inserror') {
          ?>
            echo "<script type='text/javascript'>alert('!! - Error In Consult - !!');</script>";
          <?php
        }
        elseif ($_GET['errorMessage']=='ok') {
          ?>
            echo "<script type='text/javascript'>alert('!! - End This Consult. Call to Next Patient - !!');</script>";
          <?php
        }
        elseif ($_GET['errorMessage']=='nopay') {
          ?>
            echo "<script type='text/javascript'>alert('!! - Cannot Download without Payment - !!');</script>";
          <?php
        }
      }
    ?>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">

        <div class="patidt">
          
          <div class="sectionName">
            <a class="Logo">About the Patient</a>
          </div>

          <div class="patinfr">
            <form action="./crd/clin.php" id="updtCliniDT" method="POST">

            <div class="fnam">
              <input class="fulNm" type="text" id="patient_fullName" name="patient_fullName" value="<?php echo $patient_fullName ?>" placeholder="Full Name" readonly>
              <input class="regn" type="text" id="patient_regNum " name="patient_regNum" value="<?php echo $patient_regNum ?>" placeholder="Reg #" readonly>
            </div>

            <div class="odtal">              
              <input type="text" class="calen" id="DofBirth" name="DofBirth" placeholder="Date of Birth" value="<?php echo $patient_Dob ?>"  readonly>
              <input type="text" class="agg" id="Age" name="Age" placeholder="Age" value="<?php echo $age ?>" readonly>
              <input type="text" class="gen" id="gndr" name="gndr" placeholder="Gender" value="<?php echo $patient_Gender ?>" readonly>
            </div>

          </div>

          <div class="dvline"></div>

          <div class="dridea">

            <!-- clinic ckeckup list -->
            <div class="ckupdtfrmtbl">

              <div class="allchckupdt">

                <table  class="clinitblbdy" id="tb">
                  <tr class="tr-header">
                    <th class="DocIDtry">Ckeckup</th>
                    <th class="clinicDTTRY">View</th>
                  </tr>
                  <?php while($row1 = mysqli_fetch_array($smplelst)):;?>
                    <tr class="cliniINFO">
                      <td class="DocID"><?php echo $row1[5]; ?></td>
                      <td class="cliniDTdt">
                        <a href="./crd/Download.php?id=<?php echo $row1[0]; ?>&prgnum=<?php echo $patient_regNum; ?>"><i class="fa fa-download fa-2x"></i></a>
                      </td>
                    </tr>
                  <?php endwhile;?>
                </table>

              </div>

            </div>
            
            <div class="drrec">

              <div class="disacont">
                <input class="dfpa" type="text" id="disF_patient" name="disF_patient" placeholder="Disease Of the Patient">
              </div>

              <div class="drcomnt">
                <textarea class="discmntdrbx" type="text" id="dis_stts" name="dis_stts" placeholder="Status"></textarea>
                <textarea class="cmntdrbx" type="text" id="commF_patient" name="commF_patient" placeholder="Comment For The Patient"></textarea>
              </div>

            </div>

          </div>

        </div>

        <div class="line"></div>

        <div class="dtfrm">
          <!-- search tab -->
          <div class="srch_pdcontainer">
            <Nav class="pdatsrch">

              <div class="srch-patdat">
                  <input type="text" id="pregn" name="pregn" placeholder="Patient Reg # OR NIC #">
                  <button class="btn Proceed" id="srchcPdtAndpCnt" name="action" value="srchcPdtAndpCnt"><i class="fa fa-search fa-1.5x"></i></button>
              </div>
              
              <div class="drName">
                <a class="Logo">DR. <?php echo $_SESSION['doc_name']; ?></a>
                  <div class="drNu">
                    <a class="Logo">DR.Number: <?php echo $_SESSION['doc_regno']; ?></a>
                  </div>
                  <div class="clinicNu">
                    <a class="Logo">Clinic Number: <?php echo $_SESSION['clinic_id']; ?></a>
                  </div>
              </div>

            </Nav>  
          </div>
          <!-- end of search tab -->
          
          <!-- data show -->
          <div class="pdtshw">

            <div class="aldt">

              <div class="drsol">
                
                <div class="dtfilfrm">
                  <textarea type="text" id="chckup_lst" name="chckup_lst" placeholder="List of Checkup"></textarea>
                  <textarea type="text" id="drg_lst" name="drg_lst" placeholder="Prescription"></textarea>
                </div>
                
                <div class="nxtdt">
                  <P>Next Clinic Date:</P>
                  <input class="Nxtcddt" type="date" id="nxt_clinic_date" name="nxt_clinic_date">
                  <!-- required> -->
                </div>

                <div class="submitbtn">
                  <button class="btn Proceed" id="subpPbook" name="action" value="subpPbook"><i class="fa fa-check-circle fa-1.5x"></i> Submit</button>
                </div>

              </div>
              
              </form>

              <div class="droldida">
                <div class="panametra">
                  <Nav class="dttra">
                    <div class="paname">
                      <a class="Logo"><?php if(!empty($patient_fullName)){echo $patient_fullName;}else{echo "Patient Full Name";} ?></a>
                    </div>
                  </nav>
                </div>
                <div class="drolddt">
                  <div class="drold">
                    <div class="datecontain">
                      <a class="ddat">Clinic Date: <?php echo $consult_date ?></a>
                    </div>
                    <div class="oldclinidt">
                      <div class="olddt">
                        <input type="text" id="hospital_user_name" name="search_checkup_report" placeholder="Disease Of the Patient" value="<?php echo $disF_patient ?>" readonly>
                        <textarea type="text" class="olddrdes" id="username" name="section_user_name" placeholder="Status" readonly><?php echo $dis_stts ?></textarea>
                        <textarea type="text" class="olddrcom" id="username" name="section_user_name" placeholder="Comment To the Patient" readonly><?php echo $commF_patient ?></textarea>
                        <textarea type="text" class="olddrrchck" id="username" name="section_user_name" placeholder="Given Test Reports" readonly><?php echo $chckup_lst ?></textarea>
                      </div>
                      <div class="olddt-i">
                        <textarea type="text" class="olddrrpre" id="username" name="section_user_name" placeholder="Given Medicines" readonly><?php echo $drg_lst ?></textarea>
                      </div>
                    </div>
                  </div>
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