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
          $patient_NIC=$_GET['patient_NIC'];
          $patient_Dob=$_GET['patient_Dob'];
          $patient_Gender=$_GET['patient_Gender'];
          $patient_Mobile=$_GET['patient_Mobile'];
          $patient_fixed_Number=$_GET['patient_fixed_Number'];
          $patient_email=$_GET['patient_email'];
          $patient_Address=$_GET['patient_Address'];
        }
      }else{
        $patient_regNum="";
        $patient_fullName="";
        $patient_NIC="";
        $patient_Dob="";
        $patient_Gender="";
        $patient_Mobile="";
        $patient_fixed_Number="";
        $patient_email="";
        $patient_Address="";
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
            echo "<script type='text/javascript'>alert('Patient Data Were Entered Update Without Any Error');</script>";
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
        elseif ($_GET['errorMessage']=='error') {
          ?>
            echo "<script type='text/javascript'>alert('!!- Error In Patient Data Update, please double-check enterd patient Data -!!');</script>";
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

                <button class="btn Proceed" ><i class="fa fa-wrench fa-1.5x"></i>&nbsp;&nbsp;Change Patient Details</button>
                
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/regANchacliniup.php';" ><i class="fa fa-calendar-check fa-1.5x"></i>&nbsp;&nbsp;Change Clinic Date</button>
                
              </div>

          </div>
        </div>

        <div class="line"></div>

        <div class="dtfrm">

          <div class="UPDTPDT" id="chpd">
            <!-- update patiant details frm -->
            <div class="dttry">
              <!-- oneside -->
              <div class="nwpdtfrm">

                <div class="secnme">
                  <Nav class="snmetry">
                    <div class="scname">
                      <a class="Logo">Change Patient Details</a>
                    </div>
                  </nav>
                  <div class="undrlin"></div>
                </div>
                <!-- startdataform -->
                <div class="uppadtfrm">
                  <form action="./crd/REGsec.php" id="updtPdt" method="POST">

                  <div class="inwfnme">
                    <p>Name With Initials</p>
                    <input type="text" id="patient_fullName" name="patient_FullName" placeholder="Patient Name With Initials" value="<?php echo $patient_fullName ?>" >
                    <input class="regnum" type="text" id="patient_regNum" name="patient_regNum" placeholder="Patient Registration Number" value="<?php echo $patient_regNum ?>" readonly>
                  </div>

                  <div class="nicdb">
                    <div class="NICnum">
                      <p>NIC Number</p>
                      <input type="text" id="patient_NIC" onKeyPress="if(this.value.length==10) return false;" name="Patient_NIC" placeholder="Patient NIC Number" value="<?php echo $patient_NIC ?>" required>
                    </div>
                    <div class="pDOB">
                      <p>Date Of Birth</p>
                      <input type="date" id="patient_Dob" name="Patient_Dob" placeholder="Patient Date Of Birth" value="<?php echo $patient_Dob ?>"required>
                    </div>
                  </div>

                  <div class="sx">
                    <p>Gender :&nbsp;&nbsp;</P>
                    <select name="patient_Gender" id="patient_Gender" required>
                      <option value="<?php echo $patient_Gender ?>" selected="GENDER" disabled ><?php echo $patient_Gender ?></option>
                      <!-- <option value="" selected="GENDER" disabled selected></option> -->
                      <option value="MALE">MALE</option>
                      <option value="FEMALE">FEMALE</option>
                    </select>
                  </div>

                  <div class="tpnnoo">
                    <p>Telephone Number &nbsp;&nbsp;</P>
                    <input type="number" id="patient_Mobile" onKeyPress="if(this.value.length==10) return false;" name="patient_Mobile" placeholder="Mobile Number" value="<?php echo $patient_Mobile ?>">
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

                    <input class="tpnno" type="number" id="patient_fixed_Number" onKeyPress="if(this.value.length==10) return false;" name="patient_fixed_Number" placeholder="Fixed Number" value="<?php echo $patient_fixed_Number ?>">
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
                    <input type="email" id="patient_email" name="patient_email" placeholder="Example@Email.com" value="<?php echo $patient_email ?>">
                  </div>

                  <div class="pass">
                    <p>Password</p>
                    <input type="text" id="patient_password" name="patient_password" placeholder="Password">
                  </div>

                  <div class="addrss">
                    <p>Address</p>
                    <textarea class="homeadd" type="text" id="patient_Address" name="patient_Address" placeholder="Home Address" required><?php echo $patient_Address ?></textarea>
                    <button class="btn Proceed" id="updtPdt" name="action" value="updtPdt"><i class="fa fa-upload fa-1.5x"></i>&nbsp;&nbsp;UPLOAD</button>
                  </div>
                  </form>
                </div>
                <!-- enddataform -->
              </div>
              <!-- endofoneside -->
              <!-- otherside -->
              <div class="nwrgnm">
                
                <div class="prenum">

                  <Nav class="rgnsec">
                    <div class="renwnum">
                      <a class="Logo">Registration Number&nbsp;&nbsp;<i class="fa fa-id-badge fa-1.5x"></i></a>
                    </div>
                  </nav>

                </div>
                
                <div class="Prgnum">
                <form action="./crd/REGsec.php" id="srchPdt" method="POST">
                  <input type="text" id="patient_regNum" name="patient_regNum" placeholder="Registration Or NIC Number">
                  <button class="btn Proceed" id="srchPdt" name="action" value="srchPdt"><i class="fa fa-search fa-1.5x"></i></button>
                </form>
                </div>

                <div class="uPnpadbnt">
                  <button class="btn Cancel" onclick="location.href='http://localhost/ClinicButler/regANchaupdt.php';"><i class="fa fa-eraser fa-2x"></i></button>
                </div>

              </div>
              <!-- endofotherside -->
              
            </div>
            <!-- end update patiant details frm -->
             
          </div>

        </div>
        
      </div>

    </section>
</body>

</html>