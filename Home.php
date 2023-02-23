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
  <img class="mySlides" src="./images/lab.jpg" style="height:100%; width:100%;">
  <img class="mySlides" src="./images/clinic.jpg" style="height:100%; width:100%;">
  <img class="mySlides" src="./images/dispen.jpg" style="height:100%; width:100%;">
  <img class="mySlides" src="./images/reg.jpg" style="height:100%; width:100%;">
  <img class="mySlides" src="./images/info.jpg" style="height:100%; width:100%;">
  <img class="mySlides" src="./images/admin.jpg" style="height:100%; width:100%;">

  <script>
    var myIndex = 0;
    carousel();

    function carousel() {
      var i;
      var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
        }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}    
        x[myIndex-1].style.display = "block";  
        setTimeout(carousel, 2000); // Change image every 2 seconds
    }
  </script>

<script>
  window.addEventListener
  (
      "load", 
      function()
      {
          document.getElementById("lablog").style.display = "none";
          document.getElementById("clinilog").style.display = "none";
          document.getElementById("dislog").style.display = "none";
          document.getElementById("rclog").style.display = "none";
          document.getElementById("infolog").style.display = "none";
          document.getElementById("addlog").style.display = "none";
          document.getElementById("clinicNo").style.display = "none";
      }, false
  );
</script>

<?php
    session_start();
    if (!isset($_SESSION['hospital_name']) or $_SESSION['hospital_name']=="" ){
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
        <a href="./crd/logout.php"><i class="fa fa-power-off fa-2x"></i></a>
        </div>

      </Nav>
      
    </div>

  </Header>
  

  <?php
    if (isset($_GET['errorMessage'])) {
      if ($_GET['errorMessage']=='EMPaccactive') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Check Your Activation - !!##');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='usernmeorpass') {
        ?>
          echo "<script type='text/javascript'>alert('!! - Wrong User Name OR Password - !!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='wrngsec') {
        ?>
          echo "<script type='text/javascript'>alert('!! - You Cannot Login To This Section - !!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='secactiv') {
        ?>
          echo "<script type='text/javascript'>alert('!! - This Section In The Desable Period - !!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='secerror') {
        ?>
          echo "<script type='text/javascript'>alert('!! - Promlem In The Section Login - !!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='usernmeorpassd') {
        ?>
          echo "<script type='text/javascript'>alert('!! - Wrong User Name OR Password OR Doc. Reg# - !!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='errorclinact') {
        ?>
          echo "<script type='text/javascript'>alert('!! - This Clinic In The Desable Period - !!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='errorddt') {
        ?>
          echo "<script type='text/javascript'>alert('!! - You Cannot Login Today. Becaus There Are No Clinic For You - !!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='errorddtact') {
        ?>
          echo "<script type='text/javascript'>alert('!! - You Cannot Login Today. Becaus This Clinic Is Canceled - !!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='errorroom') {
        ?>
          echo "<script type='text/javascript'>alert('!! - You Cannot Login Today. This Is Wrong Clinic Room - !!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='errordevice') {
        ?>
          echo "<script type='text/javascript'>alert('!! - You Cannot Login Today. This Is Wrong Device - !!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='errorroomact') {
        ?>
          echo "<script type='text/javascript'>alert('!! - You Cannot Login Today. This Clinic Room In Desable Period - !!');</script>";
        <?php
      }
    }
  ?>

    <section class="app-body dynemics" id="Register">

      <div class="sectionContainer">
      
        <div class="navtb">
          <div class="bar" id="bookForm">

              <div class="mtil">
                  <p>Sections of the Clinic</p>
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="lbFuntion()"><i class="fa fa-flask fa-1.5x"></i>&nbsp;&nbsp;Laboratory</button>
                  <script>
                    function lbFuntion() {
                      var x = document.getElementById("itm");
                        if (x.innerHTML === "","Clinic","Dispensary","Registration & Changes","Information","Admin") {
                          x.innerHTML = "Laboratory";
                        } else {
                          x.innerHTML = "";
                        }
                      var k = document.getElementById("clinicNo");
                        if (k.style.display === "block","none") {
                          k.style.display = "none";
                        } else {
                          k.style.display = "none";
                        }
                        //hide btn
                      var z = document.getElementById("log");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("clinilog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("dislog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("rclog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("infolog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("addlog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //end
                        //show logbtn
                      var y = document.getElementById("lablog");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                    }
                  </script>
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="clFunction()"><i class="fa fa-stethoscope fa-1.5x"></i>&nbsp;&nbsp;Clinic</button>
                  <script>
                      function clFunction() {
                        var y = document.getElementById("itm");
                          if (y.innerHTML === "","Laboratory","Dispensary","Registration & Changes","Information","Admin") {
                            y.innerHTML = "Clinic";
                          } else {
                            y.innerHTML = "";
                            }
                      var k = document.getElementById("clinicNo");
                        if (k.style.display === "block","none") {
                          k.style.display = "block";
                        } else {
                          k.style.display = "block";
                        }
                        //hide btn
                      var z = document.getElementById("log");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("lablog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("dislog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("rclog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("infolog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("addlog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //end
                        //show logbtn
                      var y = document.getElementById("clinilog");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                      }
                  </script>  
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="disFunction()"><i class="fa fa-plus-circle fa-1.5x"></i>&nbsp;&nbsp;Dispensary</button>
                  <script>
                    function disFunction() {
                      var x = document.getElementById("itm");
                        if (x.innerHTML === "","Laboratory","Clinic","Registration & Changes","Information","Admin") {
                          x.innerHTML = "Dispensary";
                        } else {
                          x.innerHTML = "";
                          }
                      var k = document.getElementById("clinicNo");
                        if (k.style.display === "block","none") {
                          k.style.display = "none";
                        } else {
                          k.style.display = "none";
                        }
                        //hide btn
                      var z = document.getElementById("log");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("lablog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("clinilog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("rclog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("infolog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("addlog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //end
                        //show logbtn
                      var y = document.getElementById("dislog");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                    }
                  </script> 
                  
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="rcFunction()"><i class="fa fa-registered fa-1.5x"></i>&nbsp;&nbsp;Registration & Changes</button>
                  <script>
                    function rcFunction() {
                      var x = document.getElementById("itm");
                        if (x.innerHTML === "","Laboratory","Clinic","Dispensary","Information","Admin") {
                          x.innerHTML = "Registration & Changes";
                        } else {
                          x.innerHTML = "";
                          }
                      var k = document.getElementById("clinicNo");
                        if (k.style.display === "block","none") {
                          k.style.display = "none";
                        } else {
                          k.style.display = "none";
                        }
                        //hide btn
                      var z = document.getElementById("log");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("lablog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("clinilog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("dislog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("infolog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("addlog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //end
                        //show logbtn
                      var y = document.getElementById("rclog");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                    }
                  </script> 
    
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="infFunction()"><i class="fa fa-info-circle fa-1.5x"></i>&nbsp;&nbsp;Information</button>
                  <script>
                    function infFunction() {
                      var x = document.getElementById("itm");
                        if (x.innerHTML === "","Laboratory","Clinic","Dispensary","Registration & Changes","Admin") {
                          x.innerHTML = "Information";
                        } else {
                          x.innerHTML = "";
                          }
                      var k = document.getElementById("clinicNo");
                        if (k.style.display === "block","none") {
                          k.style.display = "none";
                        } else {
                          k.style.display = "none";
                        }
                        //hide btn
                      var z = document.getElementById("log");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("lablog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("clinilog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("dislog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("rclog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("addlog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //end
                        //show logbtn
                      var y = document.getElementById("infolog");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                    }
                  </script> 
    
              </div>

              <div class="btn_main">

                <button class="btn Proceed" onclick="admFunction()"><i class="fa fa-user-circle fa-1.5x"></i>&nbsp;&nbsp;Admin</button>
                  <script>
                    function admFunction() {
                      var x = document.getElementById("itm");
                        if (x.innerHTML === "","Laboratory","Clinic","Dispensary","Registration & Changes","Information") {
                          x.innerHTML = "Admin";
                        } else {
                          x.innerHTML = "";
                          }
                      var k = document.getElementById("clinicNo");
                        if (k.style.display === "block","none") {
                          k.style.display = "none";
                        } else {
                          k.style.display = "none";
                        }
                        //hide btn
                      var z = document.getElementById("log");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("lablog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("clinilog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("dislog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("rclog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                      var z = document.getElementById("infolog");
                        if (z.style.display === "block","none") {
                          z.style.display = "none";
                        } else {
                          z.style.display = "none";
                        }
                        //end
                        //show logbtn
                      var y = document.getElementById("addlog");
                        if (y.style.display === "none","block") {
                          y.style.display = "block";
                        } else {
                          y.style.display = "block";
                        }
                    }
                  </script>
    
              </div>

          </div>
        </div>

        <div class="line"></div>

        <div class="logfrm">

          <div class="log">

            <form method="POST" action="./crd/sectionlog.php" id="formLOG">

            <div class="mtil">
                <p id="itm">Section Login</p>
            </div>

            <div class="form" id="bookForm">
              <input type="email" id="username" name="section_user_name" placeholder="User Name">
              <input type="Password" id="password" name="section_password" placeholder="User Password">
              <input type="text" id="clinicNo" name="doc_regno" placeholder="Doctor Registration Number">

              <div class="btn-main">
              <button class="btn Proceed" id="log" type="submit">LOGIN</button>
                <script>
                  document.getElementById("log").addEventListener("click", function(event){
                    event.preventDefault()
                  });
                </script>
              <button class="btn Proceed" id="lablog" type="submit" name="action" value="lab">LOGIN LABORATORY</button>
              <button class="btn Proceed" id="clinilog" type="submit" name="action" value="clini">LOGIN CLINIC</button>
              <button class="btn Proceed" id="dislog" type="submit" name="action" value="dis">LOGIN DISPENSARY</button>
              <button class="btn Proceed" id="rclog" type="submit" name="action" value="rc">LOGIN REGISTRATION & CHANGES</button>
              <button class="btn Proceed" id="infolog" type="submit" name="action" value="info">LOGIN INFORMATION</button>
              <button class="btn Proceed" id="addlog" type="submit" name="action" value="add">LOGIN ADMIN</button>
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