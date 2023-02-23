<?php
    session_start();
      if (!isset($_SESSION['section_name']) or $_SESSION['section_name']=="" ){
        session_destroy();   
        header("Location: http://localhost/ClinicButler/Home.php");
      }
      elseif (!isset($_SESSION['hospital_name']) or $_SESSION['hospital_name']=="" ){
        header("Location: http://localhost/ClinicButler/logout.php");
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

$action=$_POST['action'];

if($action=='srchchckuplst'){

  $patient_ID=$_POST['pregn'];
  $clinic_ID=$_POST['clinid'];
  
  
      $sql = "SELECT * FROM patient_data WHERE patient_regNum='$patient_ID' OR patient_NIC='$patient_ID'";
      $result = $conn->query($sql);
  
          if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  $patient_regNum =$row['patient_regNum'];
                  $patient_fullName =$row['patient_fullName'];
                  $patient_Gender =$row['patient_Gender'];
                  $patient_Dob =$row['patient_Dob'];
                  $age = date_diff(date_create($patient_Dob), date_create('now'))->y;
                  $patient_Address =$row['patient_Address'];
                  $patient_Mobile =$row['patient_Mobile'];
                  $patient_fixed_Number =$row['patient_fixed_Number'];
                  $patient_email =$row['patient_email'];
              }
                  header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=&Nme=&Cate=e&prc=&avb=&pay_typ=&clectddt=&prgnum=");
          }else {
              header("Location: http://localhost/ClinicButler/laboratory.php?Message=no");
          }
  

}elseif($action=='addsam'){

    $patient_regNum =$_POST['patient_regNum'];
    $patient_fullName =$_POST['patient_fullName'];
    $patient_Gender =$_POST['patient_Gender'];
    $age = $_POST['age'];
    $patient_Address =$_POST['patient_Address'];
    $patient_Mobile =$_POST['patient_Mobile'];
    $patient_email =$_POST['patient_email'];
    $clinic_ID=$_POST['clinic_ID'];
    $pay_typ=$_POST['pay_typ'];

    $ckeckup_name=$_POST['ckeckup_name'];
    $pcdate = date('Y-m-d');
  
  
    $sql = "SELECT * FROM checkup_lst WHERE checkup_name='$ckeckup_name' AND lst_activation='1'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {

          if(empty($patient_regNum) OR empty($clinic_ID)){

              header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=erin&Nme=&Cate=&prc=&avb=&clectddt=&prgnum=&pay_typ=$pay_typ");

          }else{

            $sql = "INSERT INTO sample_reslt (id, patient_regNum, clinic_id, clt_date, pay_typ, checkup_name) VALUES 
            ('' , '$patient_regNum' , '$clinic_ID' , '$pcdate' , '$pay_typ' , '$ckeckup_name')";

            if ($conn->query($sql) === TRUE) {
                //echo "New record created successfully";
                header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=insrtdon&Nme=&Cate=&prc=&avb=&clectddt=&prgnum=&pay_typ=$pay_typ");
            } else {
              header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=instrno&Nme=&Cate=&prc=&avb=&clectddt=&prgnum=&pay_typ=$pay_typ");
            }

          }

        }else {
          header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=no&Nme=&Cate=e&prc=&avb=&clectddt=&prgnum=&pay_typ=$pay_typ");
        }


  
}elseif($action=='DELL'){

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Address =$_POST['patient_Address'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_email =$_POST['patient_email'];
  $clinic_ID=$_POST['clinic_ID'];
  $pay_typ=$_POST['pay_typ'];

  $ckeckup_name=$_POST['ckeckup_name'];
  $pcdate = date('Y-m-d');

  $sql = "SELECT * FROM sample_reslt WHERE (checkup_name='$ckeckup_name' OR id='$ckeckup_name') AND patient_regNum='$patient_regNum' AND clinic_id='$clinic_ID' AND clt_date='$pcdate'";
  $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        $sql = "DELETE FROM sample_reslt WHERE (checkup_name='$ckeckup_name' OR id='$ckeckup_name') AND patient_regNum='$patient_regNum' AND clinic_id='$clinic_ID' AND clt_date='$pcdate'";
          if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=deldon&Nme=&Cate=&prc=&avb=&clectddt=&prgnum=&pay_typ=$pay_typ");
          } else{
            header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=nodel&Nme=&Cate=&prc=&avb=&clectddt=&prgnum=&pay_typ=$pay_typ");
          } 

      }else {
            header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=nodel&Nme=&Cate=&prc=&avb=&clectddt=&prgnum=&pay_typ=$pay_typ");
      }

}elseif($action=='get'){

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Address =$_POST['patient_Address'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_email =$_POST['patient_email'];
  $clinic_ID=$_POST['clinic_ID'];
  $pay_typ=$_POST['pay_typ'];

  $ckeckup_name=$_POST['ckeckup_name'];
  $pcdate = date('Y-m-d');

  if($pay_typ=='1'){

    $sql = "UPDATE sample_reslt SET activations='1' ,pay_typ='1' WHERE patient_regNum='$patient_regNum' AND clinic_id='$clinic_ID' AND clt_date='$pcdate'";
      if ($conn->query($sql)== TRUE){
        header("Location: http://localhost/ClinicButler/laboratory.php?Message=updon");
      } else{
        header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=uperr&Nme=&Cate=&prc=&avb=&clectddt=&prgnum=&pay_typ=$pay_typ");
      }
  
  }else{

    $sql = "UPDATE sample_reslt SET activations='1' ,pay_typ='0' WHERE patient_regNum='$patient_regNum' AND clinic_id='$clinic_ID' AND clt_date='$pcdate'";
      if ($conn->query($sql)== TRUE){
        header("Location: http://localhost/ClinicButler/laboratory.php?Message=updon");
      } else{
        header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=uperr&Nme=&Cate=&prc=&avb=&clectddt=&prgnum=&pay_typ=$pay_typ");
      }

  }

}elseif($action=='issu'){

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Address =$_POST['patient_Address'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_email =$_POST['patient_email'];
  $clinic_ID=$_POST['clinic_ID'];

  $pay_typ=$_POST['pay_typ'];
  
  $P_regnum=$_POST['P_regnum'];
  $bill_dt=$_POST['bill_dt'];

  if($pay_typ=='1'){

    header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=pyfld&Nme=&Cate=&prc=&avb=&clectddt=$bill_dt&prgnum=$P_regnum&pay_typ=1");
  
  }else{

    $sql = "UPDATE sample_reslt SET pay_typ='1' WHERE patient_regNum='$patient_regNum' AND clinic_id='$clinic_ID'";
      if ($conn->query($sql)== TRUE){
        header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=pyfl&Nme=&Cate=&prc=&avb=&clectddt=$bill_dt&prgnum=$P_regnum&pay_typ=1");
      } else{
        header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=uperr&Nme=&Cate=&prc=&avb=&clectddt=&prgnum=&pay_typ=$pay_typ");
      }

  }

}elseif($action=='cans'){

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Address =$_POST['patient_Address'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_email =$_POST['patient_email'];
  $clinic_ID=$_POST['clinic_ID'];
  $pay_typ=$_POST['pay_typ'];

  $ckeckup_name=$_POST['ckeckup_name'];
  $pcdate = date('Y-m-d');

  if($chup_nme=='*'){

    $sql = "DELETE FROM sample_reslt WHERE patient_regNum='$patient_regNum' AND clinic_id='$clinic_ID' AND clt_date='$pcdate'";
      if ($conn->query($sql)== TRUE){
        header("Location: http://localhost/ClinicButler/laboratory.php");
      } else{
        header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&chckup=canerr&Nme=&Cate=&prc=&avb=&clectddt=&prgnum=&pay_typ=$pay_typ");
      }

  }
  else{
    header("Location: http://localhost/ClinicButler/laboratory.php");
  }

}elseif($action=='srchchup'){

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Address =$_POST['patient_Address'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_email =$_POST['patient_email'];

  $clinic_ID=$_POST['clinic_ID'];
  $pay_typ=$_POST['pay_typ'];

  $ckeckup_name=$_POST['ckeckup_name'];

  $chup_nme=$_POST['chup_nme'];
  
  
  $sql = "SELECT * FROM checkup_lst WHERE checkup_name='$chup_nme'";
  $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $Nme =$row['checkup_name'];
              $Cate =$row['category_id'];
              $prc =$row['checkup_price'];
              $avb =$row['lst_activation'];
          }
              header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&Nme=$Nme&Cate=$Cate&prc=$prc&avb=$avb&chckup=&clectddt=&prgnum=&pay_typ=$pay_typ");
      }else {
        header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&clectddt=&prgnum=&Nme=&Cate=&prc=&avb=&clectddt=prgnum=&chckup=chupsrch&pay_typ=$pay_typ");
      }


}elseif($action=='srchrpt'){

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Address =$_POST['patient_Address'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_email =$_POST['patient_email'];
  $pay_typ=$_POST['pay_typ'];
  
  $Pregnum =$_POST['Pregnum'];
  $billdt =$_POST['billdt'];

  if(empty($Pregnum) OR empty($billdt)){
    header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&clectddt=$clectddt&prgnum=$prgnum&Nme=&Cate=&prc=&avb=&chckup=bemp&pay_typ=$pay_typ");
  }else{
  
    $sql = "SELECT * FROM patient_data WHERE patient_regNum='$Pregnum' OR patient_NIC='$Pregnum'";
    $result = $conn->query($sql);
  
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $patient_regNum =$row['patient_regNum'];
                $patient_fullName =$row['patient_fullName'];
                $patient_Gender =$row['patient_Gender'];
                $patient_Dob =$row['patient_Dob'];
                $age = date_diff(date_create($patient_Dob), date_create('now'))->y;
                $patient_Address =$row['patient_Address'];
                $patient_Mobile =$row['patient_Mobile'];
                $patient_fixed_Number =$row['patient_fixed_Number'];
                $patient_email =$row['patient_email'];
            }
    
            $sql = "SELECT * FROM sample_reslt WHERE patient_regNum='$Pregnum' AND clt_date='$billdt' AND activations='1'";
            $result = $conn->query($sql);
          
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $clectddt =$row['clt_date'];
                        $prgnum =$row['patient_regNum'];
                        $pay_typ =$row['pay_typ'];
                        $clinic_ID =$row['clinic_id'];

                    }
                        header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&clectddt=$clectddt&prgnum=$prgnum&Nme=&Cate=&prc=&avb=&chckup=rsltok&pay_typ=$pay_typ");
                }else {
                  header("Location: http://localhost/ClinicButler/laboratory.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&clinic_ID=$clinic_ID&clectddt=&prgnum=&Nme=&Cate=&prc=&avb=&chckup=norslt&pay_typ=$pay_typ");
                }
  
        }else {
            header("Location: http://localhost/ClinicButler/laboratory.php?Message=no");
        }

  }


}
//lab Admin
elseif($action=='srchchckuplstfrslt'){

  $patient_ID=$_POST['pregn'];
  $smplecoldt=$_POST['smplecoldt'];

  if(empty($patient_ID) OR empty($smplecoldt)){

    header("Location: http://localhost/ClinicButler/laboratorymain.php?Message=emptydt");

  }else{

    $sql = "SELECT * FROM patient_data WHERE patient_regNum='$patient_ID' OR patient_NIC='$patient_ID'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $patient_regNum =$row['patient_regNum'];
                $patient_fullName =$row['patient_fullName'];
                $patient_Gender =$row['patient_Gender'];
                $patient_Dob =$row['patient_Dob'];
                $age = date_diff(date_create($patient_Dob), date_create('now'))->y;
                $patient_Address =$row['patient_Address'];
                $patient_Mobile =$row['patient_Mobile'];
                $patient_fixed_Number =$row['patient_fixed_Number'];
                $patient_email =$row['patient_email'];
            }
                header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$smplecoldt&chckupid=&chckup=");
        }else {
            header("Location: http://localhost/ClinicButler/laboratorymain.php?Message=no");
        }

  }  

}elseif($action=='upload'){ 

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $chckupcolldt =$_POST['chckupcolldt'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_email =$_POST['patient_email'];
  $patient_Address =$_POST['patient_Address'];

  $chckupid =$_POST['chckupid'];
  $file = $_FILES['file'];


  $fileName = $_FILES['file']['name'];
  $fileTMPname = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.',$fileName);
  $fileActualExt = strtolower(end($fileExt));
  $fileDestination = 'C:/xampp/htdocs/ClinicButler/uploads/'.$fileName;

  $allowd = array('jpg', 'jpeg', 'png', 'pdf');

  $sql = "SELECT * FROM sample_reslt WHERE id='$chckupid' AND patient_regNum='$patient_regNum' AND clt_date='$chckupcolldt'";
  $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        if(in_array($fileActualExt, $allowd)){
      
          if($fileError === 0){

            if(move_uploaded_file($fileTMPname, $fileDestination)){
  
              $sql = "UPDATE sample_reslt SET upload='1' ,file_Nme='$fileName' WHERE patient_regNum='$patient_regNum' AND clt_date='$chckupcolldt' AND id='$chckupid'";
                if ($conn->query($sql)== TRUE){

                  header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=&chckup=");

                } else{

                  header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=erfileupsys");

                }

            }else{

              header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=errorfileup");

            }

          }else{

            header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=erfileup");
      
          }
          
        }else{
          header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=erfile");
        }

      }else {
        header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=no");
      }

}elseif($action=='okchckup'){ 

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $chckupcolldt =$_POST['chckupcolldt'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_email =$_POST['patient_email'];
  $patient_Address =$_POST['patient_Address'];

  header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=&chckup=done");

}elseif($action=='updtchckup'){ 

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $chckupcolldt =$_POST['chckupcolldt'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_email =$_POST['patient_email'];
  $patient_Address =$_POST['patient_Address'];

  $chckupid =$_POST['chckupid'];
  $file = $_FILES['file'];


  $fileName = $_FILES['file']['name'];
  $fileTMPname = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.',$fileName);
  $fileActualExt = strtolower(end($fileExt));
  $fileDestination = 'C:/xampp/htdocs/ClinicButler/uploads/'.$fileName;

  $allowd = array('jpg', 'jpeg', 'png', 'pdf');

  $sql = "SELECT * FROM sample_reslt WHERE id='$chckupid' AND patient_regNum='$patient_regNum' AND clt_date='$chckupcolldt'";
  $result = $conn->query($sql);

      if ($result->num_rows > 0) {

        if(in_array($fileActualExt, $allowd)){
      
          if($fileError === 0){

            if(move_uploaded_file($fileTMPname, $fileDestination)){
  
              $sql = "UPDATE sample_reslt SET upload='1' ,file_Nme='$fileName' WHERE patient_regNum='$patient_regNum' AND clt_date='$chckupcolldt' AND id='$chckupid'";
                if ($conn->query($sql)== TRUE){

                  header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=&chckup=Update");

                } else{

                  header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=erfileupsys");

                }

            }else{

              header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=errorfileup");

            }

          }else{

            header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=erfileup");
      
          }
          
        }else{
          header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=erfile");
        }

      }else {
        header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=no");
      }

}elseif($action=='delchckup'){ 

  $patient_regNum =$_POST['patient_regNum'];
  $patient_fullName =$_POST['patient_fullName'];
  $chckupcolldt =$_POST['chckupcolldt'];
  $patient_Gender =$_POST['patient_Gender'];
  $age = $_POST['age'];
  $patient_Mobile =$_POST['patient_Mobile'];
  $patient_email =$_POST['patient_email'];
  $patient_Address =$_POST['patient_Address'];

  $chckupid =$_POST['chckupid'];

  if(empty($chckupid)){

    header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=&chckup=em");

  }elseif($chckupid=="*"){
  
    $sql = "UPDATE sample_reslt SET upload='0' ,file_Nme='' WHERE patient_regNum='$patient_regNum' AND clt_date='$chckupcolldt'";
      if ($conn->query($sql)== TRUE){
  
        header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=&chckup=dela");
  
      } else{
  
        header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=erdel");
  
      }

  }else{

    $sql = "SELECT * FROM sample_reslt WHERE patient_regNum='$patient_regNum' AND clt_date='$chckupcolldt' AND id='$chckupid'";
      $result = $conn->query($sql);

        if ($result->num_rows > 0) {
  
          $sql = "UPDATE sample_reslt SET upload='0' ,file_Nme='' WHERE patient_regNum='$patient_regNum' AND clt_date='$chckupcolldt' AND id='$chckupid'";
            if ($conn->query($sql)== TRUE){
        
              header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=&chckup=del");
        
            } else{
        
              header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=erdel");
        
            }

        }else {
        
          header("Location: http://localhost/ClinicButler/laboratorymain.php?action=search&patient_regNum=$patient_regNum&patient_fullName=$patient_fullName&patient_email=$patient_email&patient_Address=$patient_Address&patient_fixed_Number=$patient_fixed_Number&patient_Mobile=$patient_Mobile&patient_Gender=$patient_Gender&age=$age&chckupcolldt=$chckupcolldt&chckupid=$chckupid&chckup=no");

        }

  }

}

$conn->close();
?>