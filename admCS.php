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

  <!-- data in clinic -->
  <?php
    if(isset($_GET['action'])){
      if($_GET['action']=='clinsearch'){
        $clinic_id=$_GET['clinic_id'];
        $clinic_name=$_GET['clinic_name'];
        $clinic_activation=$_GET['clinic_activation'];
      }
    }else{
      $clinic_id="";
      $clinic_name="";
      $clinic_activation="";
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

    if(empty($clinic_id)){
      $srchclinidttbl = "SELECT * FROM clinic_calendar WHERE clinic_date>='$pcdate' ORDER BY clinic_date";
      $datadate = mysqli_query($conn, $srchclinidttbl);

    }else{
      $srchclinidttbl = "SELECT * FROM clinic_calendar WHERE clinic_date>='$pcdate' AND clinicalendar_activation='1' AND clinic_id='$clinic_id' ORDER BY clinic_date";
      $datadate = mysqli_query($conn, $srchclinidttbl);
    }
  
  ?>
  <!-- data in doc -->
  <?php
    if(isset($_GET['action1'])){
      if($_GET['action1']=='docsearch'){
        $doc_name=$_GET['doc_name'];
        $doc_regno=$_GET['doc_regno'];
        $doc_nic=$_GET['doc_nic'];
        $gender=$_GET['gender'];
        $doc_activation=$_GET['doc_activation'];
        $doc_username=$_GET['doc_username'];
        $clinic_id1=$_GET['clinic_id1'];
      }
    }else{
      $doc_name="";
      $doc_regno="";
      $doc_nic="";
      $gender="";
      $doc_activation="";
      $doc_username="";
      $clinic_id1="";
    }
  ?>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $srchclinidttbl = "SELECT * FROM clinic_details WHERE clinic_id='$clinic_id1'";
    $result = $conn->query($srchclinidttbl);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $clinic_id2=$row['clinic_id'];
                $clinic_name2=$row['clinic_name'];
            }
          }else{
            $clinic_id2='';
            $clinic_name2='';
          }
  
  ?>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $resultclinlst = $conn->query("SELECT * FROM clinic_details WHERE clinic_activation='1'") 

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
        if ($_GET['msg']=='clnact') {
          ?>
            echo "<script type='text/javascript'>alert('The Clinic Is Activated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='clnup') {
          ?>
            echo "<script type='text/javascript'>alert('The Clinic Data Updated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='decln') {
          ?>
            echo "<script type='text/javascript'>alert('The Clinic Deactivted');</script>";
          <?php
        }
        elseif ($_GET['msg']=='addncln') {
          ?>
          echo "<script type='text/javascript'>alert('New Clinic Insert To The System');</script>";
          <?php
        }
        elseif ($_GET['msg']=='dract') {
          ?>
          echo "<script type='text/javascript'>alert('The DR. Activation');</script>";
          <?php
        }
        elseif ($_GET['msg']=='drpassup') {
          ?>
          echo "<script type='text/javascript'>alert('Doctor Password Is Updated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='drdtup') {
          ?>
          echo "<script type='text/javascript'>alert('Doctor Password Is Updated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='drdeact') {
          ?>
          echo "<script type='text/javascript'>alert('This Doctor Is Deactivated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='inndr') {
          ?>
          echo "<script type='text/javascript'>alert('New Doctor Is Insert To The System');</script>";
          <?php
        }
      }
    ?>

    <?php
      if (isset($_GET['errormsg'])) {
        if ($_GET['errormsg']=='nocln') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Wrong Clinic Number -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erclnact') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Clinic Activation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erclnup') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Clinic Data Update -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erclnde') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Clinic Deactivation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='ernclnad') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In New Clinic Insert -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erdract') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error in DR. Activation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erdruppsup') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error in Doctor Passwod Update -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erdrdtup') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error in Doctor Details Update -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erdrdeact') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error in Doctor Deactivation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='dractiv') {
          ?>
          echo "<script type='text/javascript'>alert('!!- This Doctor In Action -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erinndr') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Doctor Insert -!!');</script>";
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

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/adm.php';"><i class="fa fa-cogs fa-1.5x"></i>&nbsp;&nbsp;Section Account Setting</button>
                   
              </div>

              <div class="btn_main">

                <button class="btn Proceed"><i class="fa fa-wrench fa-1.5x"></i>&nbsp;&nbsp;Advance Clinic Setting</button>
                
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/admLABDis.php';"><i class="fa fa-medkit fa-1.5x"></i>&nbsp;&nbsp;Dispensary & Lab Setting</button>
                
              </div>

          </div>
        </div>

        <div class="line"></div>

        <div class="dtfrm">
                    
          <div class="Advnclinset" id="npd">

            <!-- logo div -->
            <div class="secnme" id="SECNME">              
              <div class="ACSlogo">
                <a class="Logo" id="secnm">Advance Clinic Setting</a>
              </div>
            </div>

            <!-- form container div -->
            <div class="ctrlfrm" id="CTRLFRM">

              <!-- add new clinic form -->
              <div class="nwclini" id="NWCLINI"> 

                <!-- clinic logo div -->
                <div class="frmName" id="FRMNAME">

                  <div class="Clogo">
                    <div class="cliniLogo">
                      <a class="Logo" id="secnm">Clinic Setting</a>
                    </div>
                    <div class="undrlin"></div>
                  </div>

                  <div class="clinisrchbr">
                    <form action="./crd/SETadm.php" id="updtEmdt" method="POST">
                      <input type="text" id="clinic_id" name="clinic_id" placeholder="Clinic Number">
                      <button class="btn Proceed" id="srchcln_num" name="action" value="srchcln_num"><i class="fa fa-search fa-1.5x"></i></button>
                    </form>
                  </div>

                </div>

                <!-- clinic data form -->
                <div class="cliniDtaFrm">
                  <form action="./crd/SETadm.php" id="updtEmdt" method="POST">

                  <div class="Clinicnme">
                    <p>Clinic Name</p>
                    <input type="text" id="emp_name" name="clin_nme" placeholder="Clinic Name" value="<?php echo $clinic_name ?>" >
                    <input class="clninum" type="text" id="clin_id" name="clin_id" placeholder="Clinic Number" value="<?php echo $clinic_id ?>" >
                  </div>

                  <div class="doclst">

                    <div class="drlst">
                      <p>Activation Status</p>
                    </div>
                    <div class="act">
                      <select name="clin_act" id="doc_regno">
                        <option value="<?php echo $clinic_activation ?>" selected="selected"> <?php if($clinic_activation=='1'){echo"Activate";}elseif($clinic_activation=='0'){echo"Deactivate";}else{echo"Clinic Activation";} ?></option>
                        <option value="">-----------------</option>
                        <option value="1">Activate</option>
                        <option value="0">Deactivate</option>
                      </select>
                    </div>
                  </div>

                </div>

                <!-- clinic calander logo div -->
                <div class="frmclndr" id="FRMCLNDR">

                  <div class="Clogo">
                    <div class="cliniLogo">
                      <a class="Logo" id="secnm">Dates Calendar</a>
                    </div>
                    <div class="undrlin"></div>
                  </div>

                  <div class="calandredit">
                    <button class="btn WY" id="clndrpge" name="action" value="clndrpge" ><i class="fa fa-calendar fa-1.5x"></i>&nbsp;&nbsp;Date & Room Settings</button>
                  </div>

                </div>

                <!-- clinic calander data form -->
                <div class="cliniclndrDtaFrm">

                  <div class="allclinidt">

                    <table  class="clinitblbdy" id="tb">
                      <tr class="tr-header">
                        <th class="DocIDtry">Room</th>
                        <th class="clinicDTTRY">DATE</th>
                        <th class="clinicFRM">FROM</th>
                        <th class="clinicTO">&nbsp;&nbsp;TO&nbsp;&nbsp;</th>
                      </tr>
                      <?php while($row1 = mysqli_fetch_array($datadate)):;?>
                        <tr class="cliniINFO">
                          <td class="DocID"><?php echo $row1[8]; ?></td>
                          <td class="cliniDTdt"><?php echo $row1[1]; ?></td>
                          <td class="cliniDTfrm"><?php echo $row1[2]; ?></td>
                          <td class="cliniDTto"><?php echo $row1[3]; ?></td>
                        </tr>
                      <?php endwhile;?>
                    </table>

                  </div>

                  <div class="bntbr">
                    <button class="btn ACT" id="actclin" name="action" value="actclin"><i class="fa fa-check-circle fa-1.5x"></i></button>
                    <button class="btn CHNG" id="updclin" name="action" value="updclin"><i class="fa fa-upload fa-1.5x"></i></button>
                    <button class="btn DACT" id="dactclin" name="action" value="dactclin"><i class="fa fa-ban fa-1.5x"></i></button>
                    <button class="btn ADD" id="addNclin" name="action" value="addNclin"><i class="fa fa-plus-circle fa-1.5x"></i></button>
                  </div>

                </div>
                 
                </form>

              </div> 

              <!-- add new doctor form -->
              <div class="nwdctr" id="NWDCTR"> 

                <!-- logo div -->
                <div class="frmNme" id="FRMNME">
                
                  <div class="Dlogo">
                    <div class="docLogo">
                      <a class="Logo" id="secnm">Doctors Profile Edit</a>
                    </div>
                    <div class="undrlin"></div>
                  </div>

                  <div class="dtrsrchbr">
                    <form action="./crd/SETadm.php" id="updtEmdt" method="POST">
                      <input type="text" id="doc_regno" name="doc_regno" placeholder="DR. Reg Or NIC Number">
                      <button class="btn Proceed" id="srchdoc_num" name="action" value="srchdoc_num"><i class="fa fa-search fa-1.5x"></i></button>
                    </form>
                  </div>

                </div>

                <!-- doctor data form -->
                <div class="DtrDtaFrm">
                  <form action="./crd/SETadm.php" id="updtEmdt" method="POST">

                  <div class="Doctornme">
                    <p>Doctor Name</p>
                    <input type="text" id="doc_name" name="doc_name" placeholder="Doctor Full Name" value="<?php echo $doc_name ?>" required>
                  </div>

                  <div class="Doctoregn">
                    <p>Doctor Reg Num#</p>
                    <input class="drnum" type="text" id="doc_regno" name="doc_regno" placeholder="Doctor Reg Number" value="<?php echo $doc_regno ?>" required>
                  </div>

                  <div class="drinf">
                    <p>Doctor NIC</p>
                    <input class="drnum" type="text" onKeyPress="if(this.value.length==10) return false;" id="doc_nic" name="doc_nic" placeholder="Doctor NIC Number" value="<?php echo $doc_nic ?>"required>
                  </div>

                  <div class="drgen">
                    <p>Doctor Gender</p>
                    <select name="gender" id="gender" required>
                      <option value="<?php echo $gender ?>" selected="selected"> <?php if($gender=='Female'){echo"FEMALE";}elseif($gender=='Male'){echo"MALE";}else{echo"<- Dr. gender ->";} ?></option>
                      <option value="">------------------</option>
                      <option value="Female">FEMALE</option>
                      <option value="Male">MALE</option>
                    </select>
                  </div>

                  <div class="activemsgd">
                    <p>Doctor Activation</p>
                    <select name="doc_active" id="doc_active" required>
                      <option value="<?php echo $doc_activation ?>" selected="selected"> <?php if($doc_activation=='1'){echo"Activate";}elseif($doc_activation=='0'){echo"Deactivate";}else{echo"<- Dr. Activation ->";} ?></option>
                      <option value="">------------------</option>
                      <option value="1">Activate</option>
                      <option value="0">Deactivate</option>
                    </select>
                  </div>

                  <div class="cliniLST">

                    <div class="secdrp">
                      <p>Doctor Clinic</p>
                      <select name="clinic_id" id="clinic_id" required>
                        <option value="<?php echo $clinic_id2 ?>" selected="SECTION">Now In <?php echo $clinic_name2 ?> Clinic</option>

                        <option value=""><- Clinic List In Hospital -></option>
                        <?php
                          while($rows = $resultclinlst->fetch_assoc()){
                            $clinic_id = $rows['clinic_id'];
                            $clinic_name = $rows['clinic_name'];
                            echo "<option value='$clinic_id'>$clinic_id - $clinic_name</option>";
                          }
                        ?>
                      </select>
                    </div>

                  </div>

                  <div class="mpass">

                    <div class="mail">
                      <div class="Enme">
                        <p>Email Address</p>
                      </div>
                      <div class="etbx">
                        <input type="email" id="doc_username" name="doc_username" placeholder="Example@Email.com" value="<?php echo $doc_username ?>" required>
                      </div>
                    </div>

                    <div class="pass">
                      <div class="pss">
                        <p>Password</p>
                      </div>
                      <div class="ptbx">
                        <input type="text" id="doc_password" name="doc_password" placeholder="Password" required>
                      </div>
                    </div>

                  </div>

                  <div class="btnBR">
                    <button class="btn ACT" id="actdoc" name="action" value="actdoc"><i class="fa fa-check-circle fa-1.5x"></i></button>
                    <button class="btn CHNG" id="upddoc" name="action" value="upddoc"><i class="fa fa-upload fa-1.5x"></i></button>
                    <button class="btn DACT" id="dactdoc" name="action" value="dactdoc"><i class="fa fa-ban fa-1.5x"></i></button>
                    <button class="btn ADD" id="addNdoc" name="action" value="addNdoc"><i class="fa fa-plus-circle fa-1.5x"></i></button>
                  </div>

                  </form>
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