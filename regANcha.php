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
          //document.getElementById("npd").style.display = "none";
          document.getElementById("chpd").style.display = "none";
          document.getElementById("chcd").style.display = "none";
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
  $dbname = "log_in";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
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
      if (isset($_GET['insert'])) {
        if ($_GET['insert']=='ok') {
          ?>
            echo "<script type='text/javascript'>alert('Patient data were entered correctly');</script>";
          <?php
        }
      }
    ?>

    <?php
      if (isset($_GET['insert'])) {
        if ($_GET['insert']=='error') {
          ?>
          echo "<script type='text/javascript'>alert('There was an error entering the patients data, please double-check the data and enter!');</script>";
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

                <button class="btn Proceed"><i class="fa fa-user-plus fa-1.5x"></i>&nbsp;&nbsp;Enter New Patient</button>
                
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/regANchaupdt.php';" ><i class="fa fa-wrench fa-1.5x"></i>&nbsp;&nbsp;Change Patient Details</button>
                
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/regANchacliniup.php';" ><i class="fa fa-calendar-check fa-1.5x"></i>&nbsp;&nbsp;Change Clinic Date</button>
                
              </div>

          </div>
        </div>

        <div class="line"></div>

        <div class="dtfrm">
                    
          <div class="NWPD" id="npd">

            <div class="dttry">
              <!-- oneside -->
              <div class="nwpdtfrm">

                <div class="secnme">
                  <Nav class="snmetry">
                    <div class="scname">
                      <a class="Logo">Enter New Patient</a>
                    </div>
                  </nav>
                  <div class="undrlin"></div>
                </div>
                <!-- startdataform -->
                <div class="nwpadtfrm">
                  <form action="./crd/REGsec.php" id="addNewp" method="POST">

                  <div class="inwfnme">
                    <p>Name With Initials</p>
                    <input type="text" id="P_fullN" name="fullname" placeholder="Patient Name With Initials" required>
                  </div>

                  <div class="nicdb">
                    <div class="NICnum">
                      <p>NIC Number</p>
                      <input type="text" id="P_nic" onKeyPress="if(this.value.length==10) return false;" name="patientNIC" placeholder="Patient NIC Number" required>
                    </div>
                    <div class="pDOB">
                      <p>Date Of Birth</p>
                      <input type="date" id="P-dob" name="pDOB" placeholder="Patient Date Of Birth" required>
                    </div>
                  </div>

                  <div class="sx">
                    <p>Gender :&nbsp;&nbsp;</P>
                    <select id="gndr" name="gend" required>
                      <option value="" disabled selected>GENDER</option>
                      <option value="MALE">MALE</option>
                      <option value="FEMALE">FEMALE</option>
                    </select>
                  </div>

                  <div class="tpnnoo">
                    <p>Telephone Number &nbsp;&nbsp;</P>
                    <input type="number" id="M_tpn" onKeyPress="if(this.value.length==10) return false;" name="Mtpn" placeholder="Mobile Number">
                    <script>
                      var inputBox = document.getElementById("M_tpn");

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

                    <input class="tpnno" type="number" id="F_tpn" onKeyPress="if(this.value.length==10) return false;" name="Ftpn" placeholder="Fixed Number">
                    <script>
                      var inputBox = document.getElementById("F_tpn");

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
                    <input type="email" id="email" name="email" placeholder="Example@Email.com">
                  </div>

                  <div class="pass">
                    <p>Password</p>
                    <input type="text" id="password" name="password" placeholder="Password">
                  </div>

                  <div class="addrss">
                    <p>Address</p>
                    <textarea class="homeadd" type="text" id="H_add" name="H_add" placeholder="Home Address" required></textarea>
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
                      <a class="Logo">Registration Number&nbsp;&nbsp;<i class="fa fa-id-badge fa-1.5x"></i></a>
                    </div>
                  </nav>

                </div>

                <div class="rgnum">
                  <input type="text" id="P_reg_Num" name="PregNum" placeholder="Registration Number" required>
                </div>

                <div class="npadbnt">
                  <button class="btn Proceed" id="NewPadd" name="action" value="addNewP"><i class="fa fa-user-plus fa-1.5x"></i>&nbsp;&nbsp;ADD This Patient</button>
                  <button class="btn Cancel" id="clrdt" name="Clear" type="reset" value="Clear"><i class="fa fa-eraser fa-2x"></i></button>
                </div>

                </form>
              </div>
              <!-- endofotherside -->
              
            </div>

          </div>

        </div>
        
      </div>

    </section>
</body>

</html>