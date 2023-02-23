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

<script>
  window.addEventListener
  (
      "load", 
      function()
      {
          document.getElementById("clinic_ID").style.display = "none";
      }, false
  );
</script>

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
        $patient_Mobile=$_GET['patient_Mobile'];
        $patient_fixed_Number=$_GET['patient_fixed_Number'];
        $patient_Address=$_GET['patient_Address'];
        $clinic_ID=$_GET['clinic_ID'];
        $patient_NIC=$_GET['patient_NIC'];
        $drug_name=$_GET['drug_name'];
        //error msg
        $srch=$_GET['srch'];
      }else{
        $patient_regNum="";
        $patient_fullName="";
        $patient_Dob="";
        $patient_Gender="";
        $age="";
        $patient_Mobile="";
        $patient_fixed_Number="";
        $patient_Address="";
        $clinic_ID="";
        $patient_NIC="";
        $drug_name="";
        //error msg
        $srch="";
      }
    }else{
      $patient_regNum="";
      $patient_fullName="";
      $patient_Dob="";
      $patient_Gender="";
      $age="";
      $patient_Mobile="";
      $patient_fixed_Number="";
      $patient_Address="";
      $clinic_ID="";
      $patient_NIC="";
      $drug_name="";
      //error msg
      $srch="";
    }
  ?>

  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if(!empty($patient_regNum)){

      $sql = "SELECT * FROM patient_passbook WHERE patient_regNum='$patient_regNum' AND clinic_id=$clinic_ID AND chck_activat='1'";
        $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  $drg_lst =$row['drg_lst'];
              }
          }else {
            $drg_lst="";
          }
    }else {
      $drg_lst="";
    }

  ?>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if(!empty($drug_name)){

      $sql = "SELECT * FROM drug_info WHERE drg_name='$drug_name'";
        $result = $conn->query($sql);

          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  $drg_name =$row['drg_name'];
                  $drg_number =$row['drg_number'];
                  $drg_capa =$row['drg_capa'];
                  $drg_vol =$row['drg_vol'];
                  $prc_o_pill =$row['prc_o_pill'];
                  $drg_activation =$row['drg_activation'];
              }
          }else {
            $drg_name="";
            $drg_number ="";
            $drg_capa ="";
            $drg_vol ="";
            $prc_o_pill ="";
            $drg_activation ="";
          }
    }else {
      $drg_name="";
      $drg_number ="";
      $drg_capa ="";
      $drg_vol ="";
      $prc_o_pill ="";
      $drg_activation ="";
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
      if ($srch=='nodrg') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - That Drug Is Not In Stock - !!##');</script>";
        <?php
      }
      elseif ($srch=='nodrg') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - That Drug Is Not In Stock - !!##');</script>";
        <?php
      }
      elseif ($srch=='iss') {
        ?>
          echo "<script type='text/javascript'>alert('!! - Drugs Are Issue To The Patient - !!');</script>";
        <?php
      }
      elseif ($srch=='isser') {
        ?>
          echo "<script type='text/javascript'>alert('!! - There Are No Drugs To Issue - !!');</script>";
        <?php
      }
  ?>
  <?php
    if (isset($_GET['Message'])) {
      if ($_GET['Message']=='no') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - Error Pation Reg Number Or Clinic Id  - !!##');</script>";
        <?php
      }
      elseif ($_GET['Message']=='cancl') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - Cancel Issuing Drugs  - !!##');</script>";
        <?php
      }
    }
  ?>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">

        <div class="Drugdea">

          <div class="sectionName">
            <a class="Logo">Drugs Information</a>
          </div>

          <div class="srch-items">
            <form action="./crd/disSet.php" id="updtCliniDT" method="POST">
            <div class="psrch">
              <input class="srchp" type="text" id="pregn" name="pregn" placeholder="NIC or Gre Num#">
              <input class="srchcli" type="text" id="clinid" name="clinid" placeholder="Clinic Id">
              <button class="btn Proceed" id="srchcPdtAndpCnt" name="action" value="srchcPdtAndpCnt"><i class="fa fa-search fa-1.5x"></i></button>
            </div>
          </div>

          <div class="patientdt">

            <input class="pfname" type="text" id="patient_fullName" name="patient_fullName" placeholder="Patient Full Name" value="<?php echo $patient_fullName ?>" readonly>

            <input class="pnic" type="text" id="patient_NIC" name="patient_NIC" placeholder="Patient NIC Number" value="<?php echo $patient_NIC ?>" readonly>
            <input class="preg" type="text" id="patient_regNum" name="patient_regNum" placeholder="Patient Reg Number" value="<?php echo $patient_regNum ?>" readonly>
            
            <input class="pdob" type="date" id="patient_Dob" name="patient_Dob" placeholder="Patient Date Of Birth" value="<?php echo $patient_Dob ?>" readonly>
            <input class="page" type="text" id="age" name="age" placeholder="Patient Age" value="<?php echo $age ?>" readonly>
            
            <input class="pgen" type="text" id="patient_Gender" name="patient_Gender" placeholder="Patient Gender" value="<?php echo $patient_Gender ?>" readonly>
            
            <input class="pmnm" type="text" id="patient_Mobile" name="patient_Mobile" placeholder="Patient Mobile Number" value="<?php echo $patient_Mobile ?>" readonly>
            
            <input class="pfnm" type="text" id="patient_fixed_Number" name="patient_fixed_Number" placeholder="Patient Fixed Number" value="<?php echo $patient_fixed_Number ?>" readonly>
            <input class="pfnm" type="text" id="clinic_ID" name="clinic_ID" placeholder="Clinic Id" value="<?php echo $clinic_ID ?>" readonly>
            
            <textarea class="homeadd" type="text" id="patient_Address" name="patient_Address" placeholder="Home Address" readonly><?php echo $patient_Address ?></textarea>
          </div>

        </div>

        <div class="line"></div>

        <div class="dtfrm">

          <!-- search tab -->
          <div class="srch_container">
            <Nav class="srch">
              <div class="lablogo">
              <!-- addsetion -->
                <a class="Logo"><?php echo $_SESSION['section_name']; ?> Section</a>
              </div>
            </Nav>
          </div>
          
          <!-- data show -->
          <div class="disdtshw">
            <div class="allmed">

              <div class="prscripdv">
                <div class="priscrip">
                  <textarea class="pris" type="text" id="drg_lst" name="drg_lst" placeholder="Prescription" readonly><?php echo $drg_lst ?></textarea>
                </div>
              </div>

              <div class="drgtblbg">

                  <div class="dvhdr">
                    <p>About Drugs</p>
                  </div>

                  <div class="medINF">

                    <div class="medsrch">
                      <input type="text" id="drg_nme" name="drg_nme" placeholder="Drug Name">
                      <button class="btn Proceed"  id="srchcdrginf" name="action" value="srchcdrginf"><i class="fa fa-search fa-1.5x"></i></button>
                    </div>

                    <div class="ln"></div>
                    
                    <div class="mednme">
                      <p>Drug Name:</p>
                      <input type="text" id="hospital_user_name" placeholder="Drug Name"  value="<?php echo $drg_name ?>" readonly>
                    </div>

                    <div class="medno">
                      <p>Drug Number:</p>
                      <input type="text" id="hospital_user_name" placeholder="Drug Number"  value="<?php echo $drg_number ?>" readonly>
                    </div>

                    <div class="meddos">
                      <p>Drug Dose:</p>
                      <input type="text" id="hospital_user_name" placeholder="Drug Dose"  value="<?php echo $drg_capa ?><?php echo $drg_vol ?>" readonly>
                    </div>

                    <div class="medprice">
                      <p>Drug Price:</p>
                      <input type="text" id="hospital_user_name" placeholder="Drug Price"  value="<?php echo $prc_o_pill ?>" readonly>
                    </div>

                    <div class="medprice">
                      <p>Drug Availability:</p>
                      <input type="text" id="hospital_user_name"  value="<?php if($drg_activation=='1'){echo "Available";}elseif($drg_activation=='0'){echo "Not Available";}else{echo"";}  ?>" placeholder="Availability" readonly>
                    </div>

                  </div>

              </div>
              
            </div>
          </div>
                    
          <div class="butonItem">
            <div class="btnItm">
              <button class="btn Proceed" id="issu" name="action" value="issu"><i class="fa fa-credit-card fa-1.5x"></i>ISSUE</button>
              <button class="btn Cancel" id="can" name="action" value="can"><i class="fa fa-times fa-1.5x"></i>CANCEL</button>
            </div>
          </div>
          </form>

        </div>
        
      </div>

    </section>
  <script src="./Js/main.js"></script>
</body>

</html>