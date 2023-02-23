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
  <img src="./images/lgimg.png" style="height:100%; width:100%;">
  <Header>
    <div class="container">
      <Nav class="nav">
        <div class="logo">
          <a class="Logo">Clinic Manegment System</a>
        </div>
      </Nav>
    </div>
  </Header>
  

  <?php
    if (isset($_GET['errorMessage'])) {
      if ($_GET['errorMessage']=='erroract') {
        ?>
          echo "<script type='text/javascript'>alert('##!! - Error In System Activation - !!##');</script>";
        <?php
      }
      elseif ($_GET['errorMessage']=='error') {
        ?>
          echo "<script type='text/javascript'>alert('!! - Wrong User Name OR Password - !!');</script>";
        <?php
      }
    }
  ?>

  <section class="app-body dynemics" id="Register">

    <div class="sectionContainer">

      <div class="formSide">
        <form method="POST" action="./crd/logins.php">
          <div class="form" id="bookForm">

            <div class="usernme">
              
              <div class="icls">
                <i class="fa fa-user" aria-hidden="true"></i> 
              </div>
              <div class="usrnmetxtbx">
                <input type="text" id="hospital_user_name" name="hospital_user_name" placeholder="User Name Or Registration Number">
              </div>

            </div>

            <div class="userpswrd">

              <div class="iclsp">
                <i class="fa fa-key" aria-hidden="true"></i>
              </div>
              <div class="usrpswrdtxtbx">
                <input type="Password" id="hospital_password" name="hospital_password" placeholder="User Password">
              </div>

            </div>

            <div class="btn-main">
              <button class="btn Proceed" id="log" name="action" value="Login">Login</button>
            </div>
            
          </div>
        </form>
      </div>

    </div>
  </section>
  <script src="./Js/main.js"></script>
</body>

</html>