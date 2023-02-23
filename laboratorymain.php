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
          document.getElementById("chckupcolldt").style.display = "none";
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
  <!-- get patient data and prescription -->
  <?php
    if(isset($_GET['action'])){
      if($_GET['action']=='search'){
        $patient_regNum=$_GET['patient_regNum'];
        $patient_fullName=$_GET['patient_fullName'];
        $patient_Gender=$_GET['patient_Gender'];
        $age=$_GET['age'];
        $patient_Mobile=$_GET['patient_Mobile'];
        $patient_fixed_Number=$_GET['patient_fixed_Number'];
        $patient_Address=$_GET['patient_Address'];
        $patient_email=$_GET['patient_email'];
        $chckupcolldt=$_GET['chckupcolldt'];
        //upload
        $chckupid=$_GET['chckupid'];
        //catch msg
        $chckup=$_GET['chckup'];
      }else{
        $patient_regNum="";
        $patient_fullName="";
        $patient_Gender="";
        $age="";
        $patient_Mobile="";
        $patient_fixed_Number="";
        $patient_Address="";
        $patient_email="";
        $chckupcolldt="";
        //upload
        $chckupid="";
        //catch msg
        $chckup="";
      }
    }else{
      $patient_regNum="";
      $patient_fullName="";
      $patient_Gender="";
      $age="";
      $patient_Mobile="";
      $patient_fixed_Number="";
      $patient_Address="";
      $patient_email="";
      $chckupcolldt="";
      //upload
      $chckupid="";
      //catch msg
      $chckup="";
    }
  ?>

  <!-- search other data -->
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT COUNT(*) AS CheckUpcount FROM sample_reslt WHERE upload='0' AND patient_regNum='$patient_regNum' AND clt_date='$chckupcolldt'";
      $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $CheckUpcount =$row['CheckUpcount'];
            }
        }else {
          $CheckUpcount="";
        }

  ?>

  <!-- srch collect checkup data to tbl -->
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

      $srchcheckupsmpl = "SELECT * FROM sample_reslt WHERE patient_regNum='$patient_regNum' AND clt_date='$chckupcolldt' ORDER BY upload";
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
      if ($chckup=='no') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Check Sample Id - !!##');</script>";
        <?php
      }
      elseif ($chckup=='erfile') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - This File Type Can not Upload  - !!##');</script>";
        <?php
      }
      elseif ($chckup=='erfileup') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Error In File Upload  - !!##');</script>";
        <?php
      }
      elseif ($chckup=='errorfileup') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - File Not Uploaded  - !!##');</script>";
        <?php
      }
      elseif ($chckup=='erfileupsys') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Erro In The File Upload System - !!##');</script>";
        <?php
      }
      elseif ($chckup=='canerr') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Error In Cancel Sample Collection - !!##');</script>";
        <?php
      }
      elseif ($chckup=='done') {
        ?>
          echo "<script type='text/javascript'>alert('!! - Report Uploaded Finish - !!');</script>";
        <?php
      }
      elseif ($chckup=='Update') {
        ?>
          echo "<script type='text/javascript'>alert('!! - Report File Updated - !!');</script>";
        <?php
      }
      elseif ($chckup=='em') {
        ?>
          echo "<script type='text/javascript'>alert('!! - Sample Id Is Empty - !!');</script>";
        <?php
      }
      elseif ($chckup=='del') {
        ?>
          echo "<script type='text/javascript'>alert('!! - File Is Deleted - !!');</script>";
        <?php
      }
      elseif ($chckup=='erdel') {
        ?>
          echo "<script type='text/javascript'>alert('!! - Error In File Deleted - !!');</script>";
        <?php
      }
      elseif ($chckup=='dela') {
        ?>
          echo "<script type='text/javascript'>alert('!! - All Files Are Deleted - !!');</script>";
        <?php
      }
  ?>
  
  <?php
    if (isset($_GET['Message'])) {
      if ($_GET['Message']=='emptydt') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - Some Importent Data Is Missing  - !!##');</script>";
        <?php
      }
      elseif ($_GET['Message']=='no') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - Wrong Patient Registration Number  - !!##');</script>";
        <?php
      }
      elseif ($_GET['Message']=='upload') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - file uploaded - !!##');</script>";
        <?php
      }
    }
  ?>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">

        <div class="createTest">

          <div class="sectionName">
            <a class="Logo">Patient Data</a>
          </div>

          <div class="patifrm">
            <form action="./crd/Labset.php" id="updtEmdt" method="POST" enctype="multipart/form-data">

              <div class="srch-item">
                <input type="text" id="pregn" name="pregn" placeholder="NIC OR Reg Number">
                <input type="date" class="drorclin" id="smplecoldt" name="smplecoldt" placeholder="Sample Collect Date">
                <button class="btn search" id="srchchckuplstfrslt" name="action" value="srchchckuplstfrslt"><i class="fa fa-search fa-1.5x"></i></button>
              </div>
              
          </div>
          
          <div class="dvline"></div>

          <div class="tst">

            <input type="text" id="patient_regNum" name="patient_regNum" placeholder="Reg Number" value="<?php echo $patient_regNum ?>" readonly>
            <input type="text" id="patient_fullName" name="patient_fullName" placeholder="Full Name" value="<?php echo $patient_fullName ?>" readonly>
            <input type="text" id="chckupcolldt" name="chckupcolldt" placeholder="chckupcolldt" value="<?php echo $chckupcolldt ?>" readonly>
            
            <input class="gen" type="text" id="patient_Gender" name="patient_Gender" placeholder="Gender" value="<?php echo $patient_Gender ?>" readonly>

            <input class="age" type="text" id="age" name="age" placeholder="Age" value="<?php echo $age ?>" readonly>

            <input type="number" id="tpn" onKeyPress="if(this.value.length==10) return false;" name="patient_Mobile" placeholder="phone number" value="<?php if($patient_fixed_Number=='0' AND $patient_Mobile=='0'){echo "0";}elseif($patient_fixed_Number=='0'){echo $patient_Mobile;}elseif($patient_Mobile=='0'){echo $patient_fixed_Number;}elseif($patient_fixed_Number==$patient_fixed_Number AND $patient_Mobile==$patient_Mobile){echo $patient_Mobile;} ?>" readonly>
              <script>
                var inputBox = document.getElementById("tpn");

                  var invalidChars = [
                  "-",
                  "+",
                  "e",
                  "E",
                  ".",
                  ];

                  inputBox.addEventListener("keydown", function(e) {
                    if (invalidChars.includes(e.key)) {
                      e.preventDefault();
                    }
                });
              </script>
              
            <input type="text" id="patient_email" name="patient_email" placeholder="email" value="<?php echo $patient_email ?>" readonly>
              
            <input class="chcnt" type="text" id="CheckUpcount" name="CheckUpcount" placeholder="Number Of checkUps" value="<?php echo $CheckUpcount ?>" readonly>

            <textarea class="home" type="text" id="patient_Address" name="patient_Address" placeholder="address" readonly><?php echo $patient_Address ?></textarea>

          </div>

        </div>

        <div class="line"></div>

        <div class="dtfrm">

          <div class="LABmain">

            <!-- search tab -->
            <div class="srch_container">

              <Nav class="srch">
                <div class="lablogo">
                  <!-- addsetion -->
                  <a class="Logo"><?php echo $_SESSION['section_name']; ?></a>
                </div>
              </Nav> 

            </div>
            
            <!-- data show -->
            <div class="dtshw">

              <div class="upcon">

                <div class="headr">
                  <p>Upload Patient CheckUp Reports</p>
                </div>

                <div class="upldrcont">

                  <div class="chckupidrnme">
                    <input type="text" id="chckupid" name="chckupid" placeholder="Sample Id" value="<?php echo $chckupid ?>">
                  </div>

                  <div class="uplodrcon">
                    <input type="file" id="file" name="file" placeholder="Select Your File">
                    <button class="btn upload" id="upload" name="action" value="upload"><i class="fa fa-upload fa-lg"></i></button>
                  </div>

                </div>

                <div class="btnbr">
                    <button class="btn ok" id="okchckup" name="action" value="okchckup"><i class="fa fa-check fa-lg"></i></button>
                    <button class="btn update" id="updtchckup" name="action" value="updtchckup"><i class="fa fa-wrench fa-lg"></i></button>
                    <button class="btn cancel" id="delchckup" name="action" value="delchckup"><i class="fa fa-ban fa-lg"></i></button>
                </div>

                </form>
                
              </div>
              
              <div class="dttbl">

                <div class="collsample">

                  <table  class="chckuptblbdy" id="tb">
                    <tr class="tr-header">
                      <th class="cID">ID</th>
                      <th class="chckup">CHECKUP NAME</th>
                      <th class="filechckup">File Name</th>
                      <th class="uplrdchckup">Upload Status</th>
                    </tr>
                    <?php while($row1 = mysqli_fetch_array($smplelst)):;?>
                      <tr class="chckupINFO">
                        <td class="PIDtry"><?php echo $row1[0]; ?></td>
                        <td class="Chckuptry"><?php echo $row1[5]; ?></td>
                        <td class="filechckuptry"><?php echo $row1[6]; ?></td>
                        <td class="uplrdchckuptry"><?php echo $row1[8]; ?></td>
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