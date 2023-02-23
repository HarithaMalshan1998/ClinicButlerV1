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
  <img src="./images/pimg/log.jpg" style="height:100%; width:100%;">
  
  <?php
    if (isset($_GET['errorMessage'])) {
      if ($_GET['errorMessage']=='errorusrnme') {
        ?>
          echo "<script type='text/javascript'>alert('!- Wrong User Email Address OR Registration Number -!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='errorusrpass') {
        ?>
          echo "<script type='text/javascript'>alert('!- Wrong User Password -!');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='yes') {
        ?>
          echo "<script type='text/javascript'>alert('Your Password Updated...');</script>";
        <?php
      }
    }
  ?>

  <section class="app-body dynemics" id="Register">

    <div class="sectionContainer">

      <div class="PformSide">

        <div class=logo>

          <div class="lg">                
            <img src="./images/circle-i.png">          
          </div>

        </div>

        <div class="lgfrm">

          <form method="POST" action="./crd/pat/lgin.php">

            <div class="form" id="bookForm">

              <div class="usernme">
                
                <div class="icls">
                  <i class="fa fa-user" aria-hidden="true"></i> 
                </div>
                <div class="usrnmetxtbx">
                  <input type="text" id="patient_email" name="patient_email" placeholder="User Name Or Registration Number" required>
                </div>

              </div>

              <div class="userpswrd">

                <div class="iclsp">
                  <i class="fa fa-key" aria-hidden="true"></i>
                </div>
                <div class="usrpswrdtxtbx">
                  <input type="Password" id="patient_password" name="patient_password" placeholder="User Password" required>
                </div>

              </div>

              <div class="btnbr">
                <button class="btn Proceed" id="Loginp" name="action" value="Loginp">Log In</button>
              </div>
              
            </div>
            
          </form>
            
          </div>

        </div>
      </div>

    </div>
  </section>
  <script src="./Js/main.js"></script>
</body>

</html>