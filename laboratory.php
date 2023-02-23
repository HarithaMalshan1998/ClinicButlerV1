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
          document.getElementById("Pregnum1").style.display = "none";
          document.getElementById("billdt1").style.display = "none";
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
        $clinic_ID=$_GET['clinic_ID'];
        $patient_email=$_GET['patient_email'];
        // error
        $chckup=$_GET['chckup'];
        //checkUp
        $Nme=$_GET['Nme'];
        $Cate=$_GET['Cate'];
        $prc=$_GET['prc'];
        $avb=$_GET['avb'];
        //result
        $clectddt=$_GET['clectddt'];
        $prgnum=$_GET['prgnum'];
        $pay_typ=$_GET['pay_typ'];
      }else{
        $patient_regNum="";
        $patient_fullName="";
        $patient_Gender="";
        $age="";
        $patient_Mobile="";
        $patient_fixed_Number="";
        $patient_Address="";
        $clinic_ID="";
        $patient_email="";
        // error
        $chckup="";
        //checkUp
        $Nme="";
        $Cate="";
        $prc="";
        $avb="";
        $pay_typ="";
        //result
        $clectddt="";
        $prgnum="";
      }
    }else{
      $patient_regNum="";
      $patient_fullName="";
      $patient_Gender="";
      $age="";
      $patient_Mobile="";
      $patient_fixed_Number="";
      $patient_Address="";
      $clinic_ID="";
      $patient_email="";
      // error
      $chckup="";
      //checkUp
      $Nme="";
      $Cate="";
      $prc="";
      $avb="";
      $pay_typ="";
      //result
      $clectddt="";
      $prgnum="";
    }
  ?>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM patient_passbook WHERE patient_regNum='$patient_regNum' AND clinic_id=$clinic_ID AND chck_activat='1'";
    $result = $conn->query($sql);

      if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $chckup_lst =$row['chckup_lst'];
            }
        }else {
          $chckup_lst="";
        }

  ?>
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM checkup_cate WHERE category_id='$Cate'";
      $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $catego =$row['category'];
            }
        }else {
          $catego="";
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

    $pcdate = date('Y-m-d');

    if($chckup=='insrtdon'){

      $srchcheckupsmpl = "SELECT * FROM sample_reslt WHERE patient_regNum='$patient_regNum' AND clt_date='$pcdate' AND clinic_id='$clinic_ID' ORDER BY id";
      $smplelst = mysqli_query($conn, $srchcheckupsmpl);

    }
    elseif($chckup=='deldon'){

      $srchcheckupsmpl = "SELECT * FROM sample_reslt WHERE patient_regNum='$patient_regNum' AND clt_date='$pcdate' AND clinic_id='$clinic_ID' ORDER BY id";
      $smplelst = mysqli_query($conn, $srchcheckupsmpl);

    }
    elseif($chckup=='rsltok'){

      $srchcheckupsmpl = "SELECT * FROM sample_reslt WHERE patient_regNum='$prgnum' AND clt_date='$clectddt' AND upload='1' AND activations='1' ORDER BY id";
      $smplelst = mysqli_query($conn, $srchcheckupsmpl);

    }
    else{

      $srchcheckupsmpl = "SELECT * FROM sample_reslt WHERE patient_regNum='$patient_regNum' AND clt_date='$pcdate' AND clinic_id='$clinic_ID' AND activations='1' ORDER BY id";
      $smplelst = mysqli_query($conn, $srchcheckupsmpl);

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
      if ($chckup=='no') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - That CheckUp Is Not Available - !!##');</script>";
        <?php
      }
      elseif ($chckup=='instrno') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Error In Collect Sample  - !!##');</script>";
        <?php
      }
      elseif ($chckup=='nodel') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Error In Remove Sample  - !!##');</script>";
        <?php
      }
      elseif ($chckup=='uperr') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Error In Comfirmation Of Sample Collection - !!##');</script>";
        <?php
      }
      elseif ($chckup=='canerr') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Error In Cancel Sample Collection - !!##');</script>";
        <?php
      }
      elseif ($chckup=='chupsrch') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Wrong CheckUp Name - !!##');</script>";
        <?php
      }
      elseif ($chckup=='erin') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Can Not Collect Sample With Empty Values - !!##');</script>";
        <?php
      }
      elseif ($chckup=='norslt') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - There Are No Sample Collection And Recheck Enterd Data - !!##');</script>";
        <?php
      }
      elseif ($chckup=='bemp') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - Can Not Find Data With Empty Values - !!##');</script>";
        <?php
      }
      elseif ($chckup=='pyfl') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - Issue All Checkup Report To The patient - !!##');</script>";
        <?php
      }
      elseif ($chckup=='pyfld') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - Checkup Reports All Most Issuied To The patient - !!##');</script>";
        <?php
      }
  ?>
  <?php
    if (isset($_GET['Message'])) {
      if ($_GET['Message']=='updon') {
        ?>
        echo "<script type='text/javascript'>alert('!! - Collected Sample Comfirm  - !!');</script>";
        <?php
      }
      elseif ($_GET['Message']=='chcan') {
        ?>
        echo "<script type='text/javascript'>alert('!! - Cancel Sample Collection  - !!');</script>";
        <?php
      }
      elseif ($_GET['Message']=='no') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - Wrong Patient Id Or Clinic Number - !!##');</script>";
        <?php
      }
      elseif ($_GET['Message']=='nopay') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - This Patient Has Paid Half Of Patient Bill. Therefore Checkup Reports Cannot Be Issued. - !!##');</script>";
        <?php
      }
      elseif ($_GET['Message']=='noup') {
        ?>
        echo "<script type='text/javascript'>alert('##!! - The Checkup File Not Uploaded. - !!##');</script>";
        <?php
      }
    }
  ?>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">

        <div class="createTest">

          <div class="sectionName">
            <a class="Logo">Patient Chackup</a>
          </div>

          <div class="patifrm">
            <form action="./crd/Labset.php" id="updtEmdt" method="POST">

              <div class="srch-item">
                <input type="text" id="pregn" name="pregn" placeholder="NIC OR Reg Number">
                <input type="text" class="drorclin" id="clinid" name="clinid" placeholder="Clinic Number">
                <button class="btn search" id="srchchckuplst" name="action" value="srchchckuplst"><i class="fa fa-search fa-1.5x"></i></button>
              </div>
              
          </div>
          
          <div class="dvline"></div>

          <div class="tst">

            <input type="text" id="patient_regNum" name="patient_regNum" placeholder="Reg Number" value="<?php echo $patient_regNum ?>" readonly>
            <input type="text" id="patient_fullName" name="patient_fullName" placeholder="Full Name" value="<?php echo $patient_fullName ?>" readonly>
            <input type="text" id="clinic_ID" name="clinic_ID" placeholder="clinic_ID" value="<?php echo $clinic_ID ?>" readonly>
            
            <input class="gen" type="text" id="patient_Gender" name="patient_Gender" placeholder="Gender" value="<?php echo $patient_Gender ?>" readonly>

            <input class="age" type="text" id="age" name="age" placeholder="Age" value="<?php echo $age ?>" readonly>

            <textarea type="text" id="patient_Address" name="patient_Address" placeholder="address" readonly><?php echo $patient_Address ?></textarea>

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

            <select class="Pty" id="pay_typ" name="pay_typ">
              <option value="<?php echo $pay_typ ?>" selected="paytype"><?php if($pay_typ=='1'){echo "Full Pay";}elseif($pay_typ=='0'){echo "Half Pay";}else{echo "Payment Type";} ?></option>
              <option >-----------------------</option>
              <option value="1">Full Pay</option>
              <option value="0">Half Pay</option>
            </select>

            <p class="dd"> 
              <span id="datetime" name="issuedfrom1"></span>
                <script>
                var dt = new Date();
                document.getElementById("datetime").innerHTML =  (dt.getFullYear()) +"-"+ (("0"+(dt.getMonth()+1)).slice(-2)) +"-"+(("0"+dt.getDate()).slice(-2));
              </script> 
            </p>

            <textarea class="checkuplst" type="text" id="chckup_lst" name="chckup_lst" placeholder="Checkup List" readonly><?php echo $chckup_lst ?></textarea>

          </div>

        </div>

        <div class="line"></div>

        <div class="dtfrm">

          <div class="FRNTLAB">

            <!-- search tab -->
            <div class="srch_container">
              <Nav class="srch">
                <div class="lablogo">
                  <!-- addsetion -->
                  <a class="Logo"><?php echo $_SESSION['section_name']; ?> Section</a>
                </div>
                <div class="srch-items">
                  <input type="text" id="Pregnum" name="Pregnum" placeholder="Patient Regnumber To Collect Result">
                  <input class="DDtt" type="date" id="billdt" name="billdt" placeholder="Billing Date">
                  <button class="btn Proceed" id="srchrpt" name="action" value="srchrpt"><i class="fa fa-search fa-1.5x"></i></button>

                  <input type="text" id="Pregnum1" name="P_regnum" value="<?php echo $prgnum ?>">
                  <input class="DDtt" type="date" id="billdt1" name="bill_dt" value="<?php echo $clectddt ?>">
                </div>
              </Nav> 
            </div>
            
            <!-- data show -->
            <div class="dtshw">

              <div class="allchckupdea">

                <!-- sample collection -->
                <div class="checkupdtv">

                  <div class="dvhdr">
                    <p> Collected Sample List</p>
                  </div>

                  <div class="chckupdatafrm">

                    <div class="dttry">
                      <div class="chckupnme">
                        <p>CheckUp Name</p>
                      </div>
                      <div class="clter">
                        <input type="text" id="ckeckup_name" name="ckeckup_name" placeholder="CheckUp Name">
                      </div>
                    </div>

                    <div class="btnbr">
                      <div class="btnbx">
                        <button class="btn ADD" id="addsam" name="action" value="addsam"><i class="fa fa-plus-circle fa-1.5x"></i></button>
                        <button class="btn DACT" id="DELL" name="action" value="DELL"><i class="fa fa-trash fa-1.5x"></i></button>
                      </div>                      
                    </div>

                  </div>

                  <div class="datatbl">

                    <div class="collsample">

                      <table  class="chckuptblbdy" id="tb">
                        <tr class="tr-header">
                          <th class="pID">ID</th>
                          <th class="chckup">CHECKUP NAME</th>
                          <th class="down">VIEW</th>
                        </tr>
                        <?php while($row1 = mysqli_fetch_array($smplelst)):;?>
                          <tr class="chckupINFO">
                            <td class="PIDtry"><?php echo $row1[0]; ?></td>
                            <td class="Chckuptry"><?php echo $row1[5]; ?></td>
                            <td class="DownTry">
                              <a href="./crd/Download.php?file_id=<?php echo $row1[0]; ?>&clectddt=<?php echo $clectddt; ?>&prgnum=<?php echo $prgnum; ?>"><i class="fa fa-download fa-2x"></i></a>
                            </td>
                          </tr>
                        <?php endwhile;?>
                      </table>

                    </div>

                  </div>

                </div>
                
                <div class="line"></div>

                <!-- About checkups -->
                <div class="reportcheckup">

                  <div class="dvhdr">
                    <p>About CheckUp</p>
                  </div>

                  <div class="chckupINF">

                    <div class="chckupsrch">
                      <input type="text" id="chup_nme" name="chup_nme" placeholder="CheckUp Name">
                      <button class="btn Proceed"  id="srchchup" name="action" value="srchchup"><i class="fa fa-search fa-1.5x"></i></button>
                    </div>

                    <div class="ln"></div>
                    
                    <div class="chckupnme">
                      <p>CheckUp Name:</p>
                      <input type="text" id="hospital_user_name" placeholder="CheckUp Name"  value="<?php echo $Nme ?>" readonly>
                    </div>

                    <div class="chckupcate">
                      <p>CheckUp Category:</p>
                      <input type="text" id="hospital_user_name" placeholder="CheckUp Category"  value="<?php echo $catego ?>" readonly>
                    </div>

                    <div class="chckupprice">
                      <p>CheckUp Price:</p>
                      <input type="text" id="hospital_user_name" placeholder="CheckUp Price"  value="<?php echo $prc ?>" readonly>
                    </div>

                    <div class="chckupactiv">
                      <p>CheckUp Availability:</p>
                      <input type="text" id="hospital_user_name"  value="<?php if($avb=='1'){echo "Available";}elseif($avb=='0'){echo "Not Available";}else{echo"";}  ?>" placeholder="Availability" readonly>
                    </div>

                  </div>
                  
                </div>

              </div>

            </div>
            
            <!-- button -->
            <div class="butonItem">
              <div class="btnItm">
                <button class="btn Proceed" id="get" name="action" value="get"><i class="fa fa-plus fa-1.5x"></i>GET</button>
                <button class="btn get" id="issu" name="action" value="issu"><i class="fa fa-check fa-1.5x"></i>Issue</button>
                <button class="btn Cancel" id="cans" name="action" value="cans"><i class="fa fa-ban fa-1.5x"></i>CANCEL</button>
              </div>
            </div>
            </form>

          </div>

        </div>
        
      </div>

    </section>
  <script src="./Js/main.js"></script>
</body>

</html>