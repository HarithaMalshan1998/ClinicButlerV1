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

  <!-- data in clinic date -->
  <?php
    if(isset($_GET['action'])){
      if($_GET['action']=='clinddtsrch'){
        $doc_name=$_GET['doc_name'];
        $doc_regno=$_GET['doc_regno'];
        $clinic_id=$_GET['clinic_id'];
        $clinic_name=$_GET['clinic_name'];
      }else{
        $doc_name="";
        $doc_regno="";
        $clinic_id="";
        $clinic_name="";
      }
    }else{
      $doc_name="";
      $doc_regno="";
      $clinic_id="";
      $clinic_name="";
    }
  ?>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($clinic_id=="ALL"){
      
      $id2="ALL";

    }else{

      $srchroomnme = "SELECT * FROM clin_room WHERE clinic_id='$clinic_id'";
      $result = $conn->query($srchroomnme);
  
          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                $id1=$row['id'];
                $room_activ1=$row['room_activ'];
              }
            }else{
               $id1="";
               $room_activ1="";
            }
  
        if(empty($id1) AND empty($room_activ1)){
  
          $id2="";
  
        }else{
          if($room_activ1=="0"){
            $id2="Check Activation Of-$id1 Room";
          }else{
            $id2="$id1";
          }
        }

    }
  
  ?>
  <!-- srch clinic dates to tbl -->
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    $pcdate = date('Y-m-d');

    if(empty($doc_regno) OR ($clinic_id=="ALL")){

      $srchclinicaldt = "SELECT * FROM clinic_calendar WHERE clinic_date>='$pcdate' ORDER BY clinic_date";
      $clinical = mysqli_query($conn, $srchclinicaldt);

    }else{

      $srchclinicaldt = "SELECT * FROM clinic_calendar WHERE doc_regno='$doc_regno' AND clinic_date>='$pcdate' ORDER BY clinic_date";
      $clinical = mysqli_query($conn, $srchclinicaldt);

    }
  
  ?>

  <!-- data in clinic room -->
  <?php
    if(isset($_GET['action'])){
      if($_GET['action']=='clnrmsrc'){
        $id=$_GET['id'];
        $room_name=$_GET['room_name'];
        $room_device=$_GET['room_device'];
        $clinic_id1=$_GET['clinic_id1'];
        $room_activ=$_GET['room_activ'];
      }else{
        $id="";
        $room_name="";
        $room_device="";
        $clinic_id1="";
        $room_activ="";
      }
    }else{
      $id="";
      $room_name="";
      $room_device="";
      $clinic_id1="";
      $room_activ="";
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
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if(empty($id)){

      $srchclinidttbl = "SELECT * FROM clin_room ORDER BY id";
      $clinicRoom = mysqli_query($conn, $srchclinidttbl);

    }else{

      $srchclinidttbl = "SELECT * FROM clin_room WHERE id='$id' AND room_name='$room_name' ORDER BY id";
      $clinicRoom = mysqli_query($conn, $srchclinidttbl);

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
        <a href="http://localhost/ClinicButler/admCS.php"><i class="fa fa-arrow-circle-left  fa-2x"></i></a>
        </div>

      </Nav>
      
    </div>

  </Header>

    <?php
      if (isset($_GET['msg'])) {
        if ($_GET['msg']=='dtyes') {
          ?>
            echo "<script type='text/javascript'>alert('Clinic Date Deleted');</script>";
          <?php
        }
        elseif ($_GET['msg']=='tmeyes') {
          ?>
            echo "<script type='text/javascript'>alert('The Clinic Data Deactivated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='dtyes') {
          ?>
            echo "<script type='text/javascript'>alert('Delete Clinic Date');</script>";
          <?php
        }
        elseif ($_GET['msg']=='insertNclindt') {
          ?>
          echo "<script type='text/javascript'>alert('Add New Clinic Time');</script>";
          <?php
        }
        elseif ($_GET['msg']=='romupy') {
          ?>
          echo "<script type='text/javascript'>alert('Clinic Room Details Updated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='romdeact') {
          ?>
          echo "<script type='text/javascript'>alert('Clinic Room Deactivated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='okrmin') {
          ?>
          echo "<script type='text/javascript'>alert('New Clinic Room Insert To The System');</script>";
          <?php
        }
      }
    ?>

    <?php
      if (isset($_GET['errormsg'])) {
        if ($_GET['errormsg']=='drnoAct') {
          ?>
          echo "<script type='text/javascript'>alert('!!- The Doctor Not In Action -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='dtclindtdel') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Delete Clinic Date -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='datetimeempt') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Epty Data -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='tmeclindtdel') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Clinic date Deactivation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='oldddt') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Old Clinic Date -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='roomact') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Room Not Activated -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='clindttmsme') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Another Clinic In That Time And Date -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='clindataerror') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Epmty Clinic Date And Time -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erinsertNclindt') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Ensert New Clinic Date -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='errom') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Wrong Clinic Room -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='errorup') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Room Activation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='eromup') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Room Update -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='indaterm') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Cannot Deactivate, Clinic In Action -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erromde') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Clinic Room Deactivation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='rmactiv') {
          ?>
          echo "<script type='text/javascript'>alert('!!- That room In Action -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erromins') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Clinic Room Insterst -!!');</script>";
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

                <button class="btn Proceed" style="background-color:rgba(194, 192, 192, 0.452);"><i class="fa fa-cogs fa-1.5x"></i>&nbsp;&nbsp;Section Account Setting</button>
                   
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="location.href='http://localhost/ClinicButler/admCS.php';"><i class="fa fa-wrench fa-1.5x"></i>&nbsp;&nbsp;Advance Clinic Setting</button>
                
              </div>

              <div class="btn_main">

                <button class="btn Proceed" style="background-color:rgba(194, 192, 192, 0.452);"><i class="fa fa-medkit fa-1.5x"></i>&nbsp;&nbsp;Dispensary & Lab Setting</button>
                
              </div>

          </div>
        </div>

        <div class="line"></div>

        <div class="dtfrm">
                    
          <div class="Advnclindtset" id="npd">
            <!-- logo div -->
            <div class="secnme" id="SECNME">              
              <div class="ACSlogo">
                <a class="Logo" id="secnm">Clinic Date & Room Setting</a>
              </div>
            </div>
            <!-- form container div -->
            <div class="ctrlfrm" id="CTRLFRM">

              <!-- add new clinic date form -->
              <div class="nwclinidt" id="NWCLINI"> 

                <!-- clinic logo div -->
                <div class="frmName" id="FRMNAME">

                  <div class="Clogo">
                    <div class="cliniLogo">
                      <a class="Logo" id="secnm"> Clinic Date Setting</a>
                    </div>
                    <div class="undrlin"></div>
                  </div>

                  <div class="clinisrchbr">
                    <form action="./crd/SETadm.php" id="updtEmdt" method="POST">
                      <input type="text" id="doc_regno" name="doc_regno" placeholder="DR.Reg OR NIC Number">
                      <button class="btn Proceed" id="srchdrnm" name="action" value="srchdrnm"><i class="fa fa-search fa-1.5x"></i></button>
                    </form>
                  </div>

                </div>

                <!-- clinic date data form -->
                <div class="cliniDtedtfrm">
                  <form action="./crd/SETadm.php" id="updtEmdt" method="POST">

                  <div class="Clinicnme">
                    <input type="text" id="clinic_name" name="clinic_name" placeholder="Clinic Name" value="<?php echo $clinic_name ?>" required readonly>
                    <input class="clninum" type="text" id="clinic_id" name="clinic_id" placeholder="Clinic Number" value="<?php echo $clinic_id ?>" required readonly>
                  </div>

                  <div class="doclst">
                    <input type="text" id="doc_name" name="doc_name" placeholder="DR. Name" value="<?php echo $doc_name ?>" required readonly>
                    <input class="clninum" type="text" id="doc_regno" name="doc_regno" placeholder="DR. Number" value="<?php echo $doc_regno ?>" required readonly>
                  </div>

                  <div class="clnDTslct">

                    <div class="connME">
                      <p>Select Clinic Date</p>
                    </div>
                    <div class="ddt">
                      <input type="date" id="clinic_date" name="clinic_date" value="<?php echo $clinic_date ?>">
                    </div>

                  </div>

                  <div class="frmto">

                    <div class="frm">
                      <p>From</p>
                    </div>
                    <div class="frmddt">
                      <input type="time" id="clinic_timeF" name="clinic_timeF" value="<?php echo $clinic_timeF ?>">
                    </div>

                    <div class="to">
                      <p>To</p>
                    </div>

                    <div class="toddt">
                      <input type="time" id="clinic_timeT" name="clinic_timeT" value="<?php echo $clinic_timeT ?>">
                    </div>

                  </div>

                  <div class="clnrm">

                    <div class="rmcon">
                      <p>Clinic Room Id</p>
                    </div>
                    <div class="rmnme">
                      <input type="text" id="id" name="id" placeholder="Room Number" value="<?php echo $id2 ?>" readonly required>
                    </div>

                  </div>

                </div>

                <!-- clinic calander data form -->
                <div class="cliniclndrDtaFrm">

                  <div class="allclinidt">

                    <table  class="clinitblbdy" id="tb">
                      <tr class="tr-header">
                        <th class="CLNRom">ROOM</th>
                        <th class="Drnum">DR.ID</th>
                        <th class="clinicDTTRY">DATE</th>
                        <th class="clinicFRM">FROM</th>
                        <th class="clinicTO">&nbsp;&nbsp;TO&nbsp;&nbsp;</th>
                      </tr>
                      <?php while($row1 = mysqli_fetch_array($clinical)):;?>
                        <tr class="cliniINFO">
                          <td class="roomID"><?php echo $row1[8]; ?></td>
                          <td class="DrId"><?php echo $row1[5]; ?></td>
                          <td class="cliniDTdt"><?php echo $row1[1]; ?></td>
                          <td class="cliniDTfrm"><?php echo $row1[2]; ?></td>
                          <td class="cliniDTto"><?php echo $row1[3]; ?></td>
                        </tr>
                      <?php endwhile;?>
                    </table>

                  </div>

                  <div class="bntbr">
                    <button class="btn ADD" id="addNclindt" name="action" value="addNclindt"><i class="fa fa-plus-circle fa-1.5x"></i></button>
                    <button class="btn DACT" id="dactclindt" name="action" value="dactclindt"><i class="fa fa-ban fa-1.5x"></i></button>
                  </div>

                </div>

                </form>  

              </div>

              <!-- room form -->
              <div class="chngclidt" id="NWDCTR">

                <!-- logo div -->
                <div class="frmNme" id="FRMNME">
                
                  <div class="Dlogo">
                    <div class="docLogo">
                      <a class="Logo" id="secnm">Clinic Room Setting</a>
                    </div>
                    <div class="undrlin"></div>
                  </div>

                  <div class="dtrsrchbr">
                    <form action="./crd/SETadm.php" id="updtEmdt" method="POST">
                      <input type="text" id="room_name" name="room_name" placeholder="Room Number OR Name">
                      <button class="btn Proceed" id="srchclnrm" name="action" value="srchclnrm"><i class="fa fa-search fa-1.5x"></i></button>
                    </form>
                  </div>

                </div>

                <!-- clinic date data form -->
                <div class="cliniDtedt">
                  <form action="./crd/SETadm.php" id="updtEmdt" method="POST">

                  <div class="Clinicnme">
                    <p>Clinic Room Details</p>
                    <input type="text" id="room_name" name="room_name" placeholder="Room Name" value="<?php echo $room_name ?>" >
                    <input class="clninum" type="text" id="id" name="id" placeholder="Room Id" value="<?php echo $id ?>" >
                  </div>

                  <div class="romact">

                    <div class="rmactcon">
                      <p>Room Activation</p>
                    </div>

                    <div class="drlst">
                      <select name="room_activ" id="room_activ" required>
                        <option value="<?php echo $room_activ ?>" selected="selected"> <?php if($room_activ=='1'){echo"Activate";}elseif($room_activ=='0'){echo"Deactivate";}else{echo"Clinic Activation";} ?></option>
                        <option value=""><-- Activation Status --></option>
                        <option value="">----------------------</option>
                        <option value="1">Activate</option>
                        <option value="0">Deactivate</option>
                      </select>
                    </div>

                  </div>

                  <div class="romdvc">

                    <div class="rmactcon">
                      <p>Device Name</p>
                    </div>

                    <div class="drlst">
                      <input type="text" id="room_device" name="room_device" placeholder="Device Name" value="<?php echo $room_device ?>" >
                    </div>

                  </div>

                  <div class="doclst">

                    <div class="drlst">
                      <select name="clinic_id" id="clinic_id" required>
                        <option value="<?php echo $clinic_id2 ?>" selected="SECTION"><?php echo $clinic_name2 ?> Clinic</option>

                        <option value=""><-- Clinics In Hospital --></option>

                        <?php
                          while($rows = $resultclinlst->fetch_assoc()){
                            $clinic_id = $rows['clinic_id'];
                            $clinic_name = $rows['clinic_name'];
                            echo "<option value='$clinic_id'>$clinic_id - $clinic_name Clinic </option>";
                          }
                        ?>
                        
                      </select>
                    </div>

                  </div>

                </div>

                <!-- clinic calander logo div -->
                <div class="dtclnd" id="FRMCLNDR">

                  <div class="Clogo">
                    <div class="cliniLogo">
                      <a class="Logo" id="secnm">Room Allocations</a>
                    </div>
                    <div class="undrlin"></div>
                  </div>

                </div>

                <!-- clinic calander data form -->
                <div class="cliniclndrAloFrm">

                  <div class="allclinidt">

                    <table  class="clinitblbdy" id="tb">
                      <tr class="tr-header">
                        <th class="DocIDtry">ID</th>
                        <th class="clinicDTTRY">Name</th>
                        <th class="clinicFRM">Clinic Id</th>
                        <th class="clinicTO">Active</th>
                      </tr>
                      <?php while($row1 = mysqli_fetch_array($clinicRoom)):;?>
                        <tr class="cliniINFO">
                          <td class="DocID"><?php echo $row1[0]; ?></td>
                          <td class="cliniDTdt"><?php echo $row1[1]; ?></td>
                          <td class="cliniDTfrm"><?php echo $row1[3]; ?></td>
                          <td class="cliniDTto"><?php echo $row1[4]; ?></td>
                        </tr>
                      <?php endwhile;?>
                    </table>

                  </div>

                  <div class="bntbr">
                    <button class="btn ACT" id="actroom" name="action" value="actroom"><i class="fa fa-check-circle fa-1.5x"></i></button>
                    <button class="btn CHNG" id="updroom" name="action" value="updroom"><i class="fa fa-upload fa-1.5x"></i></button>
                    <button class="btn DACT" id="dactclin" name="action" value="dactroom"><i class="fa fa-ban fa-1.5x"></i></button>
                    <button class="btn ADD" id="addroom" name="action" value="addroom"><i class="fa fa-plus-circle fa-1.5x"></i></button>
                  </div>

                </div>

                </form> 

              </div>

            </div>

          </div>

        </div>
        
      </div>

    </section>
  <script src="./Js/main.js"></script>
</body>

</html>