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
      if (isset($_GET['errorMessage'])) {
        if ($_GET['errorMessage']=='passnoeq') {
          ?>
            echo "<script type='text/javascript'>alert('Passwords Are You Enterd Not Equal');</script>";
          <?php
        }
        elseif ($_GET['errorMessage']=='error') {
          ?>
            echo "<script type='text/javascript'>alert('Error In Password Update');</script>";
          <?php
        }
      }
    ?>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">
      
        <div class="ppup">

          <div class="pro">

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

              <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/pcontact.php';"><i class="fa fa-phone-square fa-1.5x"></i>&nbsp;&nbsp;Contact Us</button>
                    
            </div>
          
          </div>

        </div>

        <div class="ppassup">
          
          <div class="advrdv">

            <div class="pdttry">
              
              <div class="nmetry">

                <div class="nme">
                  <a>Full Name:</a>
                </div>

                <div class="nmebx">
                  <input type="text" id="patient_regNum" name="patient_regNum" readonly>
                </div>

              </div>

              <div class="gentry">

                <div class="gen">
                  <a>Gender:</a>
                </div>

                <div class="genbx">
                  <input type="text" id="patient_regNum" name="patient_regNum" readonly>
                </div>

              </div>

              <div class="addtry">

                <div class="add">
                  <a>Address:</a>
                </div>

                <div class="addbx">                  
                  <textarea type="text" id="lstmed" name="lstmed" placeholder="List of Medicine" readonly></textarea>
                </div>

              </div>

            </div>

          </div>

          <div class="ln"></div>

          <div class="dttdv">

            <div class="pdttry">
              <form action="./crd/pat/passup.php" id="updtPdt" method="POST">
              
              <div class="nmetry">

                <div class="nme">
                  <a>Old Password As Remember</a>
                </div>

                <div class="nmebx">
                  <input type="text" id="patient_password" name="patient_password" required>
                </div>

              </div>

              <div class="gentry">

                <div class="gen">
                  <a>New Password</a>
                </div>

                <div class="genbx">
                  <input type="text" id="patient_password" name="patient_password" required>
                </div>

              </div>

              <div class="addtry">

                <div class="add">
                  <a>Confirm New Password</a>
                </div>

                <div class="addbx">
                  <input type="text" id="patient_passworda" name="patient_passworda" required>
                </div>

              </div>

            </div>

          </div>

          <div class="btnbr">
            <button class="btn Proceed" id="pssupdtPdt" name="action" value="pssupdtPdt"><i class="fa fa-upload fa-1.5x"></i>&nbsp;&nbsp;Change Password</button>        
          </div>
          </form>

        </div>
        

      </div>

    </section>

  <script src="./Js/main.js"></script>
</body>

</html>