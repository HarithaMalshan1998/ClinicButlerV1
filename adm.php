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
          document.getElementById("led").style.display = "none";
          document.getElementById("ded").style.display = "none";
          document.getElementById("rcse").style.display = "none";
          document.getElementById("ied").style.display = "none";
          document.getElementById("aed").style.display = "none";
          //hide section deactivate button
          document.getElementById("Dlab").style.display = "none";
          document.getElementById("Ddis").style.display = "none";
          document.getElementById("Dreg").style.display = "none";
          document.getElementById("Dinfo").style.display = "none";
          //hide section activate button
          document.getElementById("Alab").style.display = "none";
          document.getElementById("Adis").style.display = "none";
          document.getElementById("Areg").style.display = "none";
          document.getElementById("Ainfo").style.display = "none";
          document.getElementById("passchange").style.display = "none";
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
      if($_GET['action']=='search'){
        $emp_name=$_GET['emp_name'];
        $emp_id=$_GET['emp_id'];
        $emp_NIC=$_GET['emp_NIC'];
        $Date_Ob=$_GET['Date_Ob'];
        $gender=$_GET['gender'];
        $section_ID=$_GET['section_ID'];
        $mobile_num=$_GET['mobile_num'];
        $fixed_num=$_GET['fixed_num'];
        $section_user_name=$_GET['section_user_name'];
        $emp_activation=$_GET['emp_activation'];
      }
    }else{
      $emp_name="";
      $emp_id="";
      $emp_NIC="";
      $Date_Ob="";
      $gender="";
      $section_ID="";
      $mobile_num="";
      $fixed_num="";
      $section_user_name="";
      $emp_activation="";
    }
  ?>

  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $resultsectsrch = $conn->query("SELECT * FROM section WHERE sec_activation='1'") 

  ?>

  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $srchclinidttbl = "SELECT * FROM section WHERE section_ID='$section_ID'";
    $result = $conn->query($srchclinidttbl);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $section_name=$row['section_name'];
                $section_ID=$row['section_ID'];
            }
          }else{
            $section_name='';
            $section_ID='';
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
      if (isset($_GET['msg'])) {
        if ($_GET['msg']=='avyes') {
          ?>
            echo "<script type='text/javascript'>alert('This Employee Is Activated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='yespassup') {
          ?>
            echo "<script type='text/javascript'>alert('This Employee Password Updated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='updempyes') {
          ?>
            echo "<script type='text/javascript'>alert('This Employee Details Are Updated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='activno') {
          ?>
          echo "<script type='text/javascript'>alert('This Employee Is Almost Deactivated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='deactys') {
          ?>
          echo "<script type='text/javascript'>alert('This Employee Is Deactivated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='insnwepmok') {
          ?>
          echo "<script type='text/javascript'>alert('New Employee In Action');</script>";
          <?php
        }
        elseif ($_GET['msg']=='secacti') {
          ?>
          echo "<script type='text/javascript'>alert('This Section Activated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='secde') {
          ?>
          echo "<script type='text/javascript'>alert('This Section Activated');</script>";
          <?php
        }
      }
    ?>

    <?php
      if (isset($_GET['errormsg'])) {
        if ($_GET['errormsg']=='actived') {
          ?>
          echo "<script type='text/javascript'>alert('!!- This Employee Is Activated Employee -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='errorav') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Employee Activation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='errorpassup') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Employee Password Update -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erupdateEmp') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Employee Details Update -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='activno') {
          ?>
          echo "<script type='text/javascript'>alert('!!- This Employee Is Not Activated -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='deactno') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Employee Deactivation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='activin') {
          ?>
          echo "<script type='text/javascript'>alert('!!- This Employee Is Almost In Avtion -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erinsnwepmok') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Add New Employee -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='noemp') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Wrong Employee ID Or NIC -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='errorsecac') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Section Activation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='errorsecde') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Section Deactivation -!!');</script>";
          <?php
        }
      }
    ?>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">
      
        <div class="admctrlbtnbr">
          <div class="btnbar" id="bookForm">

              <div class="mtil">
                  <p><?php echo $_SESSION['section_name']; ?> Panal</p>
              </div>

              <div class="btn_main">

                <button class="btn Proceed"><i class="fa fa-cogs fa-1.5x"></i>&nbsp;&nbsp;Section Account Setting</button>
                   
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/admCS.php';"><i class="fa fa-wrench fa-1.5x"></i>&nbsp;&nbsp;Advance Clinic Setting</button>
                
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/admLABDis.php';"><i class="fa fa-medkit fa-1.5x"></i>&nbsp;&nbsp;Dispensary & Lab Setting</button>
                
              </div>

          </div>
        </div>

        <div class="line"></div>

        <div class="dtfrm">
                    
          <div class="seclgs" id="npd">

            <div class="secnme">
              <Nav class="snmetry">
                <div class="scname">
                  <a class="Logo">Section Account Setting</a>
                </div>
              </nav>
            </div>

            <!-- button slide -->
            <div class="secbntbr">
              <div class="btlrow">
                <button class="btn Proceed" onclick="LSFuntion()"><i class="fa fa-flask fa-1.5x"></i>&nbsp;&nbsp;Laboratory</button>
                  <script>
                    function LSFuntion() {
                        //show lable
                      var y = document.getElementById("led");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                      var y = document.getElementById("Dlab");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                      var y = document.getElementById("Alab");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                        //hide o lable
                      var z = document.getElementById("secnm");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("ded");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("rcse");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("ied");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("aed");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //end
                        //hide deactivaion button
                      var z = document.getElementById("Ddis");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Dreg");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Dinfo");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //hide activaion button
                      var z = document.getElementById("Adis");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Areg");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Ainfo");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //hide change password div
                      var z = document.getElementById("passchange");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                    }
                  </script> 
                <button class="btn Proceed" onclick="DSFuntion()"><i class="fa fa-plus-circle fa-1.5x"></i>&nbsp;&nbsp;Dispensary</button>
                  <script>
                    function DSFuntion() {
                        //show logbtn
                      var y = document.getElementById("ded");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                      var y = document.getElementById("Ddis");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                      var y = document.getElementById("Adis");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                        //hide btn
                      var z = document.getElementById("secnm");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("led");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("rcse");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("ied");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("aed");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //end
                        //hide deactivaion button
                      var z = document.getElementById("Dlab");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Dreg");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Dinfo");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //hide deactivaion button
                      var z = document.getElementById("Alab");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Areg");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Ainfo");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //hide change password div
                      var z = document.getElementById("passchange");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                    }
                  </script>
                <button class="btn Proceed" onclick="RCSFuntion()"><i class="fa fa-registered fa-1.5x"></i>&nbsp;&nbsp;Registration...</button>
                  <script>
                    function RCSFuntion() {
                        //show logbtn
                      var y = document.getElementById("rcse");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                      var y = document.getElementById("Dreg");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                      var y = document.getElementById("Areg");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                        //hide btn
                      var z = document.getElementById("secnm");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("led");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("ded");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("ied");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("aed");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //end
                        //hide deactivaion button
                      var z = document.getElementById("Dlab");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Ddis");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Dinfo");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //hide activaion button
                      var z = document.getElementById("Alab");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Adis");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Ainfo");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //hide change password div
                      var z = document.getElementById("passchange");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                    }
                  </script>
                <button class="btn Proceed" onclick="ISFuntion()"><i class="fa fa-info-circle fa-1.5x"></i>&nbsp;&nbsp;Information</button>
                  <script>
                    function ISFuntion() {
                        //show logbtn
                      var y = document.getElementById("ied");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                      var y = document.getElementById("Dinfo");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                      var y = document.getElementById("Ainfo");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                        //hide btn
                      var z = document.getElementById("secnm");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("led");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("ded");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("rcse");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("aed");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //end
                        //hide deactivaion button
                      var z = document.getElementById("Dlab");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Ddis");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Dreg");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //hide activaion button
                      var z = document.getElementById("Alab");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Adis");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Areg");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //hide change password div
                      var z = document.getElementById("passchange");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                    }
                  </script>
                <button class="btn Proceed" onclick="ASFuntion()"><i class="fa fa-user-circle fa-1.5x"></i>&nbsp;&nbsp;Admin</button>
                  <script>
                    function ASFuntion() {
                        //show logbtn
                      var y = document.getElementById("aed");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                        //hide change password div
                        var y = document.getElementById("passchange");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                        //hide btn
                      var z = document.getElementById("secnm");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("led");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("ded");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("rcse");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("ied");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //end
                        //hide deactivaion button
                      var z = document.getElementById("Dlab");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Ddis");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Ddis");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Dinfo");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //hide activaion button
                      var z = document.getElementById("Alab");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Adis");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Adis");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("Ainfo");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                    }
                  </script>
              </div>
            </div>
            <!-- end button slide -->

            <div class="secupdt" id="chpd">
              <!-- update patiant details frm -->
              <div class="dttry">

                <!-- oneside -->
                <div class="nwpdtfrm">

                  <div class="secnme">
                    <Nav class="snmetry">
                      <div class="scname">
                        <a class="Logo" id="secnm">Section Employee Details</a>
                        <a class="Logo" id="led">Laboratory Seaction Employee Details</a>
                        <a class="Logo" id="ded">Dispensary Section Employee Details</a>
                        <a class="Logo" id="rcse">Registration & Changes Section Employee Details</a>
                        <a class="Logo" id="ied">Information Section Employee Details</a>
                        <a class="Logo" id="aed">Admin Section Employee Details</a>
                      </div>
                    </nav>
                    <div class="undrlin"></div>
                  </div>

                  <!-- startdataform -->
                  <div class="upsecdtfrm">
                    <form action="./crd/SETadm.php" id="updtEmdt" method="POST">

                      <div class="inwfnme">
                        <p>Employee Name With Initials</p>
                        <input type="text" id="emp_name" name="emp_name" placeholder="Employee Name With Initials" value="<?php echo $emp_name ?>" >
                        <input class="regnum" type="text" id="emp_id" name="emp_id" placeholder="Employee Registration Number" value="<?php echo $emp_id ?>">
                      </div>

                      <div class="nicdb">
                        <div class="NICnum">
                          <p> Employee NIC Number</p>
                          <input type="text" id="emp_NIC" onKeyPress="if(this.value.length==10) return false;" name="emp_NIC" placeholder="Employee NIC Number" value="<?php echo $emp_NIC ?>" required>
                        </div>
                        <div class="pDOB">
                          <p>Date Of Birth</p>
                          <input type="date" id="Date_Ob" name="Date_Ob" placeholder="Patient Date Of Birth" value="<?php echo $Date_Ob ?>"required>
                        </div>
                      </div>

                      <div class="sx">
                        <div class="gen">
                          <p>Gender :&nbsp;&nbsp;</P>
                          <select name="gender" id="gender" required>
                            <option value="<?php echo $gender ?>" selected="GENDER"><?php echo $gender ?></option>
                            <option >--------------------</option>
                            <option value="MALE">MALE</option>
                            <option value="FEMALE">FEMALE</option>
                          </select>
                        </div>

                        <div class="secc">
                          <p>Section :&nbsp;&nbsp;</P>
                          <select name="section_ID" id="sect" required>
                            <option value="<?php echo $section_ID ?>" selected="SECTION">Now In <?php echo $section_name ?> Section</option>
                            <option value="">!-- Section List --!</option>
                            <?php
                              while($rows = $resultsectsrch->fetch_assoc()){
                                $section_ID = $rows['section_ID'];
                                $section_name = $rows['section_name'];
                                echo "<option value='$section_ID'> -> $section_name Section </option>";
                              }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="tpnnoo">
                        <p>Contact Number &nbsp;&nbsp;</P>
                        <input type="number" id="mobile_num" onKeyPress="if(this.value.length==10) return false;" name="mobile_num" placeholder="Mobile Number" value="<?php echo $mobile_num ?>">
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

                        <input class="tpnno" type="number" id="fixed_num" onKeyPress="if(this.value.length==10) return false;" name="fixed_num" placeholder="Fixed Number" value="<?php echo $fixed_num ?>">
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
                      </div>

                      <div class="mail">
                        <p>Email Address</p>
                        <input type="email" id="section_user_name" name="section_user_name" placeholder="Example@Email.com" value="<?php echo $section_user_name ?>">
                      </div>

                      <div class="pass">
                        <p>Password</p>
                        <input type="text" id="section_password" name="section_password" placeholder="Password">
                      </div>

                      <div class="btnbx">
                        <button class="btn ACT" id="ATCemp" name="action" value="ATCemp"><i class="fa fa-check-circle fa-1.5x"></i></button>
                        <button class="btn CHNG" id="UPDTemp" name="action" value="UPDTemp"><i class="fa fa-upload fa-1.5x"></i></button>
                        <button class="btn DACT" id="DATCemp" name="action" value="DATCemp"><i class="fa fa-ban fa-1.5x"></i></button>
                        <button class="btn ADD" id="ADDnwEPM" name="action" value="ADDnwEPM"><i class="fa fa-plus-circle fa-1.5x"></i></button>
                        <button class="btn Cancel" name="action" value="Clear"><i class="fa fa-eraser fa-2x"></i></button>
                      </div>

                    </form>

                  </div>
                  <!-- enddataform -->

                </div>
                <!-- endofoneside -->

                <div class="sline"></div>

                  <!-- otherside -->
                  <div class="nwrgnm">
                    
                    <div class="prenum">

                      <Nav class="rgnsec">
                        <div class="renwnum">
                          <a class="Logo">Employee Number&nbsp;&nbsp;<i class="fa fa-id-card fa-1.5x"></i></a>
                        </div>
                      </nav>

                    </div>
                    
                    <div class="Prgnum">
                      <form action="./crd/SETadm.php" id="srchwmp" method="POST">
                        <input type="text" id="emp_id" name="emp_id" placeholder="Employee Reg Or NIC Number">
                        <button class="btn Proceed" id="srchwmp" name="action" value="srchwmp"><i class="fa fa-search fa-1.5x"></i></button>
                      </form>
                    </div>

                    <div class="uPnpadbnt">
                      <div class="actemP">
                        <?php if($emp_activation=='0'){echo "<h4 style=color:red>! This Employee Not Active</h4>";}elseif($emp_activation=='1'){echo "<h4 style=color:green>This Employer is Active</h4>";} ?>
                      </div>

                    </div>

                    <div class="secdact">
                      <form action="./crd/SETadm.php" id="srchwmp" method="POST">

                        <div class="btnbx">
                          <button class="btn AACT" id="Alab" name="action" value="Alb"><i class="fa fa-unlock fa-1.5x"></i>&nbsp;&nbsp;This Section</button>
                          <button class="btn DACT" id="Dlab" name="action" value="Dalb"><i class="fa fa-lock fa-1.5x"></i>&nbsp;&nbsp;This Section</button>

                          <button class="btn AACT" id="Adis" name="action" value="Adis"><i class="fa fa-unlock fa-1.5x"></i>&nbsp;&nbsp;This Section</button>
                          <button class="btn DACT" id="Ddis" name="action" value="Dadis"><i class="fa fa-lock fa-1.5x"></i>&nbsp;&nbsp;This Section</button>

                          <button class="btn AACT" id="Areg" name="action" value="Areg"><i class="fa fa-unlock fa-1.5x"></i>&nbsp;&nbsp;This Section</button>
                          <button class="btn DACT" id="Dreg" name="action" value="Dareg"><i class="fa fa-lock fa-1.5x"></i>&nbsp;&nbsp;This Section</button>

                          <button class="btn AACT" id="Ainfo" name="action" value="Ainf"><i class="fa fa-unlock fa-1.5x"></i>&nbsp;&nbsp;This Section</button>
                          <button class="btn DACT" id="Dinfo" name="action" value="Dainf"><i class="fa fa-lock fa-1.5x"></i>&nbsp;&nbsp;This Section</button>
                        </div>

                      </form>  

                      <div class="setsite" id="passchange">
                        <form action="./crd/logins.php" id="srchwmp" method="POST">
                          <div class=pass>
                            <input type="text" id="hnsnum" name="hnsnum" placeholder="Hospital Number">
                            <input type="text" id="npass" name="npass" placeholder="New Password">
                            <input type="text" id="rnpass" name="rnpass" placeholder="Enter Again New Password">                            
                          </div>
                          <div class=chngbtnbx>
                            <button class="btn CHGE" id="pasup" name="action" value="pasup"><i class="fa fa-key fa-1.5x"></i>  Update</button>
                          </div>
                        </form>
                      </div>

                    </div>

                  </div>
                  <!-- endofotherside -->
                
                </div>
                <!-- end update patiant details frm -->
              
              </div>

            </div>

          </div>
        
        </div>

      </div>

    </section>
  <script src="./Js/main.js"></script>
</body>

</html>