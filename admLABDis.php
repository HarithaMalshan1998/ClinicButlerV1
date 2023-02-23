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
          document.getElementById("checkup_indx").style.display = "none";
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

  <!-- data in drug date -->
  <?php
    if(isset($_GET['action'])){

      if($_GET['action']=='drgnumsrc'){
        $drg_name=$_GET['drg_name'];
        $drg_capa=$_GET['drg_capa'];
        $drg_vol=$_GET['drg_vol'];
        $drg_number=$_GET['drg_number'];
        $prc_o_pill=$_GET['prc_o_pill'];
        $drg_activation=$_GET['drg_activation'];
      
      }else{
        $drg_name="";
        $drg_capa="";
        $drg_vol="";
        $drg_number="";
        $prc_o_pill="";
        $drg_activation="";
      }
    }else{
      $drg_name="";
      $drg_capa="";
      $drg_vol="";
      $drg_number="";
      $prc_o_pill="";
      $drg_activation="";
    }
  ?>
  <?php
    if(isset($_GET['action'])){

      if($_GET['action']=='drgnmesrc'){
        $drg_name2=$_GET['drg_name'];
      
      }else{
        $drg_name2="";
      }
    }else{
      $drg_name2="";
    }
  ?>
  <!-- srch drug data to tbl -->
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if(!empty($drg_number)){

      $srchclinicaldt = "SELECT * FROM drug_info WHERE drg_number='$drg_number' AND drg_activation='1' ORDER BY drg_number";
      $clinical = mysqli_query($conn, $srchclinicaldt);

    }elseif(!empty($drg_name2)){

      $srchclinicaldt = "SELECT * FROM drug_info WHERE drg_name='$drg_name2' AND drg_activation='1' ORDER BY drg_number";
      $clinical = mysqli_query($conn, $srchclinicaldt);

    }else{

      $srchclinicaldt = "SELECT * FROM drug_info WHERE drg_activation='1' ORDER BY drg_number";
      $clinical = mysqli_query($conn, $srchclinicaldt);

    }
  
  ?>

  <!-- checkup data -->
  <?php
    if(isset($_GET['action'])){

      if($_GET['action']=='checkuplst'){
        $checkup_indx=$_GET['checkup_indx'];
        $checkup_name=$_GET['checkup_name'];
        $category_id=$_GET['category_id'];
        $category=$_GET['category'];
        $checkup_price=$_GET['checkup_price'];
        $lst_activation=$_GET['lst_activation'];
      
      }else{
        $checkup_indx="";
        $checkup_name="";
        $category_id="";
        $category="";
        $checkup_price="";
        $lst_activation="";
      }
    }else{
      $checkup_indx="";
      $checkup_name="";
      $category_id="";
      $category="";
      $checkup_price="";
      $lst_activation="";
    }
  ?>
  <!-- srch checkup cate data to drop -->
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $resultcheckup = $conn->query("SELECT * FROM checkup_cate WHERE activation_cate='1'") 

  ?>
  <!-- srch drug data to tbl -->
  <?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_hospital_gampola";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if($category_id=="ALL"){

      $srchcheckupcat = "SELECT * FROM checkup_cate ORDER BY category_id";
      $checkupcatlst = mysqli_query($conn, $srchcheckupcat);

    }else{

      if(!empty($category_id)){

        $srchcheckupcat = "SELECT * FROM checkup_cate WHERE category_id='$category_id'";
        $checkupcatlst = mysqli_query($conn, $srchcheckupcat);

      }else{

        $srchcheckupcat = "SELECT * FROM checkup_cate ORDER BY category_id";
        $checkupcatlst = mysqli_query($conn, $srchcheckupcat);

      }
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
        if ($_GET['msg']=='drgins') {
          ?>
            echo "<script type='text/javascript'>alert('Durg Insert');</script>";
          <?php
        }
        elseif ($_GET['msg']=='drgup') {
          ?>
            echo "<script type='text/javascript'>alert('Drug Details Updated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='drgdel') {
          ?>
            echo "<script type='text/javascript'>alert('Delete The Drug');</script>";
          <?php
        }
        elseif ($_GET['msg']=='cateok') {
          ?>
          echo "<script type='text/javascript'>alert('Checkup Category Activated');</script>";
          <?php
        }
        elseif ($_GET['msg']=='actall') {
          ?>
          echo "<script type='text/javascript'>alert('Activated All Checkup Category');</script>";
          <?php
        }
        elseif ($_GET['msg']=='upckup') {
          ?>
          echo "<script type='text/javascript'>alert('Update Checkup details');</script>";
          <?php
        }
        elseif ($_GET['msg']=='dectokcat') {
          ?>
          echo "<script type='text/javascript'>alert('Deactivate Checkup Category');</script>";
          <?php
        }
        elseif ($_GET['msg']=='addchckok') {
          ?>
          echo "<script type='text/javascript'>alert('Add New Checkup');</script>";
          <?php
        }
      }
    ?>

    <?php
      if (isset($_GET['errormsg'])) {
        if ($_GET['errormsg']=='errdrg') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Wrong Drug Number -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='errdrgins') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Drug Insert -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='errdrgup') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Drug Update -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erdrgdel') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Drug Delete -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='errchck') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Wrong Name -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erchcate') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Checkup Category Activation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='catup') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In category Activation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erupch') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Checkup Details Update -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='erdectokcat') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Checkup Category Deactivation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='empty') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Empty Data -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='chckactiv') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Checkup In Activation -!!');</script>";
          <?php
        }
        elseif ($_GET['errormsg']=='addckerror') {
          ?>
          echo "<script type='text/javascript'>alert('!!- Error In Checkup Activated -!!');</script>";
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

                <button class="btn Proceed"onclick="location.href='http://localhost/ClinicButler/admCS.php';"><i class="fa fa-wrench fa-1.5x"></i>&nbsp;&nbsp;Advance Clinic Setting</button>
                
              </div>

              <div class="btn_main">

                <button class="btn Proceed"><i class="fa fa-medkit fa-1.5x"></i>&nbsp;&nbsp;Dispensary & Lab Setting</button>
                
              </div>

          </div>
        </div>

        <div class="line"></div>

        <div class="dtfrm">
                    
          <div class="AdvncLBaCHCKUP" id="npd">
            <!-- logo div -->
            <div class="secnme" id="SECNME">              
              <div class="ACSlogo">
                <a class="Logo" id="secnm">Dispensary & Lab Setting</a>
              </div>
            </div>

            <!-- form container div -->
            <div class="ctrlfrm" id="CTRLFRM">

              <!-- drug information form -->
              <div class="drginff" id="NWCLINI"> 

                <!-- drug logo div -->
                <div class="frmName" id="FRMNAME">

                  <div class="Clogo">
                    <div class="cliniLogo">
                      <a class="Logo" id="secnm">Drug Information</a>
                    </div>
                    <div class="undrlin"></div>
                  </div>

                  <div class="clinisrchbr">
                    <form action="./crd/SETadm.php" id="updtEmdt" method="POST">
                      <input type="text" id="drug_number" name="drug_number" placeholder="Drug Num# Or Name Whith mg">
                      <button class="btn Proceed" id="srchdrg" name="action" value="srchdrg"><i class="fa fa-search fa-1.5x"></i></button>
                    </form>
                  </div>

                </div>

                <!-- Drug data form -->
                <div class="cliniDtaFrm">

                  <div class="meddt">
                    <form action="./crd/SETadm.php" id="updtEmdt" method="POST">

                      <!-- tablet name -->
                      <div class="tbltnme">
                        <p>Drug Name & Vol</p>
                        <input type="text" id="drg_name" name="drg_name" placeholder="Drug Name" value="<?php echo $drg_name ?>" required>                      
                        <input class="Mgdrg" type="text" id="drg_capa" name="drg_capa" placeholder="Volume" value="<?php echo $drg_capa ?>" required>
                        
                        <select name="drg_vol" id="drg_vol" required>
                          <option  selected="selected" value="<?php echo $drg_vol ?>"><?php if($drg_vol=='mg'){echo"mg";}elseif($drg_vol=='ml'){echo"ml";}else{echo"<-- Volume -->";} ?></option>
                          <option value="">----------------------</option>
                          <option value="mg">mg</option>
                          <option value="ml">ml</option>
                        </select>

                      </div>

                      <!-- tablet number -->
                      <div class="tbltnmbr">
                        <p>Drug Number</p>
                        <input type="text" id="drg_number" name="drg_number" placeholder="Drug Num#" value="<?php echo $drg_number ?>" required>
                      </div>

                      <!-- price of a one pill -->
                      <div class="tbltprce">
                        <p> Price Of One Item </p>
                        <input type="number" id="prc_o_pill" name="prc_o_pill" placeholder="Tablet Price RS:" value="<?php echo $prc_o_pill ?>" required>
                          <script>
                            var inputBox = document.getElementById("T_num");

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
                        <p class="pp"> Rs/= </p>
                      </div>

                      <!-- available tablet -->
                      <div class="tbltavbl">
                        <p> Drug Availability </p>
                        <select name="drg_activation" id="drg_activation" required>
                          <option  selected="selected" value="<?php echo $drg_activation ?>"><?php if($drg_activation=='1'){echo"In Stock";}elseif($drg_activation=='0'){echo"Out Of Stock";}else{echo"<- Availability ->";} ?></option>
                          <option>---------------------------</option>
                          <option value="1">In Stock</option>
                          <option value="0">Out Of Stock</option>
                        </select>
                      </div>

                      <!-- date -->
                      <div class="ddt">
                        <p> Current Date </p>
                        <p class="dd"> 
                          <span id="datetime" name="issuedfrom1"></span>
                            <script>
                            var dt = new Date();
                            document.getElementById("datetime").innerHTML =  (dt.getFullYear()) +"-"+ (("0"+(dt.getMonth()+1)).slice(-2)) +"-"+(("0"+dt.getDate()).slice(-2));
                            </script> 
                        </p>

                      </div>

                  </div>
                    
                  <div class="smtblt">

                    <div class="alltblt">

                      <table  class="tblst" id="tb">
                        <tr class="tr-header">
                          <th class="drgNme">Drug Name</th>
                          <th class="drgNum">Drug Number</th>
                          <th class="drgvol">Volume</th>
                          <th class="drgava">Availability</th>
                        </tr>
                        <?php while($row1 = mysqli_fetch_array($clinical)):;?>
                          <tr class="DrgINFO">
                            <td class="drgNmeTry"><?php echo $row1[0]; ?></td>
                            <td class="drgNumTry"><?php echo $row1[3]; ?></td>
                            <td class="drgvolTry"><?php echo $row1[1]; ?><?php echo $row1[2]; ?></td>
                            <td class="drgavaTry"><?php echo $row1[5]; ?></td>
                          </tr>
                        <?php endwhile;?>
                      </table>

                    </div>
                    
                  </div>

                  <div class="btnBR">
                    <button class="btn ADD" id="ADDdrg" name="action" value="ADDdrg"><i class="fa fa-plus-circle fa-1.5x"></i></button>
                    <button class="btn CHNG" id="UPDdrg" name="action" value="UPDdrg"><i class="fa fa-upload fa-1.5x"></i></button>
                    <button class="btn DACT" id="DELdrg" name="action" value="DELdrg"><i class="fa fa-trash fa-1.5x"></i></button>
                  </div>
                  </form>

                </div> 

              </div>

              <!-- checkup information form -->
              <div class="chckupinff" id="NWDCTR"> 

                <!-- checkup logo div -->
                <div class="frmNme" id="FRMNME">
                
                  <div class="Dlogo">
                    <div class="docLogo">
                      <a class="Logo" id="secnm">Checkup Information</a>
                    </div>
                    <div class="undrlin"></div>
                  </div>

                  <div class="dtrsrchbr">
                    <form action="./crd/SETadm.php" id="updtEmdt" method="POST">
                      <input type="text" id="ctorchcknme" name="ctorchcknme" placeholder="Checkup Or category Name">
                      <button class="btn Proceed" id="srchchckup" name="action" value="srchchckup"><i class="fa fa-search fa-1.5x"></i></button>
                    </form>
                  </div>

                </div>

                <!-- checkup data form -->
                <div class="checkupFrm">

                  <div class="chckupdt">
                    <form action="./crd/SETadm.php" id="updtEmdt" method="POST">

                      <!-- checkup name -->
                      <div class="chckupnme">
                        <p>CheckUp Name</p>
                        <input type="text" id="checkup_name" name="checkup_name" placeholder="Checkup Name" value="<?php echo $checkup_name ?>" >
                        <input type="text" id="checkup_indx" name="checkup_indx" placeholder="Checkup indx" value="<?php echo $checkup_indx ?>" >
                      </div>

                      <!-- checkup category -->
                      <div class="chckupcato">
                        <p>CheckUp Category</p>
                        <select name="category_id" id="category_id" required>
                          <option value="<?php echo $category_id ?>" selected="category"> <?php if(!empty($category_id)){echo"$category_id - $category";}elseif($category_id=="ALL"){echo"ALL";}else{echo"<- Category List ->";} ?> </option>

                          <option value="">------------------------------</option>
                          <?php
                            while($rows = $resultcheckup->fetch_assoc()){
                              $category_id1 = $rows['category_id'];
                              $category1 = $rows['category'];
                              echo "<option value='$category_id1'>$category_id1 - $category1</option>";
                            }
                          ?>
                        </select>
                      </div>

                      <!-- price of checkup -->
                      <div class="chckupprce">
                        <p> Price Of CheckUp </p>
                        <input type="number" id="checkup_price" name="checkup_price" placeholder="Checkup Price RS:" value="<?php echo $checkup_price ?>" >
                          <script>
                            var inputBox = document.getElementById("T_num");

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
                        <p class="pp"> Rs/= </p>
                      </div>

                      <!-- available checkup -->
                      <div class="chckupavbl">
                        <p> CheckUp Availability </p>
                        <select name="lst_activation" id="lst_activation">
                          <option  selected="selected" value="<?php echo $lst_activation ?>"><?php if($lst_activation=='1'){echo"Available";}elseif($lst_activation=='0'){echo"Not Available";}else{echo"<- Availability ->";} ?></option>
                          <option value="">------------------------------</option>
                          <option value="1">Available</option>
                          <option value="0">Not Available</option>
                        </select>
                      </div>

                      <!-- date -->
                      <div class="ddt">
                        <p> Current Date </p>
                        <p class="dd"> 
                          <span id="datetime2" name="issuedfrom1"></span>
                            <script>
                            var dt = new Date();
                            document.getElementById("datetime2").innerHTML =  (dt.getFullYear()) +"-"+ (("0"+(dt.getMonth()+1)).slice(-2)) +"-"+(("0"+dt.getDate()).slice(-2));
                            </script> 
                        </p>

                      </div>

                  </div>
                  
                  <div class="chckupblt">

                    <div class="alltblt">

                      <table  class="tblst" id="tb">
                        <tr class="tr-header">
                          <th class="chckupid">ID</th>
                          <th class="chckupNme">CheckUp Category</th>
                          <th class="chckupact">Activation</th>
                        </tr>
                        <?php while($row1 = mysqli_fetch_array($checkupcatlst)):;?>
                          <tr class="chckupINFO">
                            <td class="chckupIDTry"><?php echo $row1[0]; ?></td>
                            <td class="chckupNmeTry"><?php echo $row1[1]; ?></td>
                            <td class="chckupACT"><?php echo $row1[2]; ?></td>
                          </tr>
                        <?php endwhile;?>
                      </table>

                    </div>
                    
                  </div>

                  <div class="btnBR">
                    <button class="btn ACT" id="actchcate" name="action" value="actchcate"><i class="fa fa-check-circle fa-1.5x"></i></button>
                    <button class="btn CHNG" id="updchck" name="action" value="updchck"><i class="fa fa-upload fa-1.5x"></i></button>
                    <button class="btn DACT" id="dacchcate" name="action" value="dacchcate"><i class="fa fa-ban fa-1.5x"></i></button>
                    <button class="btn ADD" id="addchechup" name="action" value="addchechup"><i class="fa fa-plus-circle fa-1.5x"></i></button>
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