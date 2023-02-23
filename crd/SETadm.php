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
//adm page
if($action=='ATCemp') {

    $emp_id=$_POST['emp_id'];
    $emp_NIC=$_POST['emp_NIC'];
    $section_ID=$_POST['section_ID'];
    $emp_activation='0';

    $sql = "SELECT * FROM section_staff WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id') AND emp_activation='$emp_activation'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        
            $sql1 = "UPDATE section_staff SET emp_activation='1' WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id')";
                 if ($conn->query($sql1)== TRUE){
                     header("Location: http://localhost/ClinicButler/adm.php?msg=avyes");
                 } else{
                     header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorav");
                 }
        }else {
            header("Location: http://localhost/ClinicButler/adm.php?errormsg=actived");
        }

} elseif($action=='UPDTemp') {

    $emp_id=$_POST['emp_id'];
    $emp_NIC=$_POST['emp_NIC'];
    $emp_name=$_POST['emp_name'];
    $gender=$_POST['gender'];
    $Date_Ob=$_POST['Date_Ob'];
    $mobile_num=$_POST['mobile_num'];
    $fixed_num=$_POST['fixed_num'];
    $section_user_name=$_POST['section_user_name'];
    $section_password=$_POST['section_password'];
    $section_ID=$_POST['section_ID'];
    $emp_activation='1';

    if(strlen(trim($section_password))<=0){

        $sql = "SELECT * FROM section_staff WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id') AND emp_activation='$emp_activation'";
        $result = $conn->query($sql);

            if ($result->num_rows > 0) {
        
                $sql = "UPDATE section_staff SET emp_id='$emp_id',emp_NIC='$emp_NIC',emp_name='$emp_name',gender='$gender',Date_Ob='$Date_Ob',mobile_num='$mobile_num',fixed_num='$fixed_num',section_ID='$section_ID',emp_activation='$emp_activation' WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id')";
                 if ($conn->query($sql)== TRUE){
                     header("Location: http://localhost/ClinicButler/adm.php?msg=updempyes");
                 } else{
                     header("Location: http://localhost/ClinicButler/adm.php?errormsg=erupdateEmp");
                 }

            }else {
                header("Location: http://localhost/ClinicButler/adm.php?errormsg=activno");
            }

    }else{

        $section_password_EN=md5($_POST['section_password']);
        
        $sql = "UPDATE section_staff SET section_password='$section_password_EN',section_user_name='$section_user_name' WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id')";
         if ($conn->query($sql)== TRUE){
             header("Location: http://localhost/ClinicButler/adm.php?msg=yespassup");
         } else{
             header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorpassup");
         }

    }

} elseif($action=='DATCemp') {

    $emp_id=$_POST['emp_id'];
    $emp_NIC=$_POST['emp_NIC'];
    $section_ID=$_POST['section_ID'];
    $emp_activation='1';

    $sql = "SELECT * FROM section_staff WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id') AND emp_activation='$emp_activation'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        
            $sql1 = "UPDATE section_staff SET emp_activation='0' WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id')";
                 if ($conn->query($sql1)== TRUE){
                     header("Location: http://localhost/ClinicButler/adm.php?msg=deactys");
                 } else{
                     header("Location: http://localhost/ClinicButler/adm.php?errormsg=deactno");
                 }
        }else {
            header("Location: http://localhost/ClinicButler/adm.php?msg=activno");
        }

} elseif($action=='ADDnwEPM') {
    // insert qury run
    $emp_id=$_POST['emp_id'];
    $emp_NIC=$_POST['emp_NIC'];
    $emp_name=$_POST['emp_name'];
    $gender=$_POST['gender'];
    $Date_Ob=$_POST['Date_Ob'];
    $mobile_num=$_POST['mobile_num'];
    $fixed_num=$_POST['fixed_num'];
    $section_user_name=$_POST['section_user_name'];
    $section_password=md5($_POST['section_password']);
    $section_ID=$_POST['section_ID'];
    $emp_activation='1';

    $sql = "SELECT * FROM section_staff WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id')";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            header("Location: http://localhost/ClinicButler/adm.php?errormsg=activin");
        }else {

            if(strlen(trim($section_user_name AND $section_password))<=0){

                $sql = "INSERT INTO section_staff (emp_id, emp_NIC, emp_name, gender, Date_Ob, mobile_num, fixed_num, section_ID, emp_activation) VALUES 
                ('$emp_id' , '$emp_NIC' , '$emp_name' , '$gender' , '$Date_Ob' , '$mobile_num' , '$fixed_num' , '$section_ID' , '$emp_activation')";
            
                if ($conn->query($sql) === TRUE) {
                    //echo "New record created successfully";
                    header("Location: http://localhost/ClinicButler/adm.php?msg=insnwepmok");
                } else {
                    header("Location: http://localhost/ClinicButler/adm.php?errormsg=erinsnwepmok");
                }

            }else{

                $sql = "INSERT INTO section_staff (emp_id, emp_NIC, emp_name, gender, Date_Ob, mobile_num, fixed_num, section_user_name, section_password, section_ID, emp_activation) VALUES 
                ('$emp_id' , '$emp_NIC' , '$emp_name' , '$gender' , '$Date_Ob' , '$mobile_num' , '$fixed_num' , '$section_user_name' , '$section_password' , '$section_ID' , '$emp_activation')";
            
                if ($conn->query($sql) === TRUE) {
                    //echo "New record created successfully";
                    header("Location: http://localhost/ClinicButler/adm.php?msg=insnwepmok");
                } else {
                    header("Location: http://localhost/ClinicButler/adm.php?errormsg=erinsnwepmok");
                }

            }
        }

}elseif($action=='srchwmp'){

    $emp_id=$_POST['emp_id'];
    $emp_activation='1';
    $emp_activation2='0';

    $sql = "SELECT * FROM section_staff WHERE (emp_id='$emp_id' OR emp_NIC='$emp_id') AND (emp_activation='$emp_activation' OR emp_activation='$emp_activation2')";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $emp_name=$row['emp_name'];
                $emp_id=$row['emp_id'];
                $emp_NIC=$row['emp_NIC'];
                $Date_Ob=$row['Date_Ob'];
                $gender=$row['gender'];
                $section_ID=$row['section_ID'];
                $mobile_num=$row['mobile_num'];
                $fixed_num=$row['fixed_num'];
                $section_user_name=$row['section_user_name'];
                $emp_activation=$row['emp_activation'];
            }        
                header("Location: http://localhost/ClinicButler/adm.php?action=search&emp_name=$emp_name&emp_id=$emp_id&emp_NIC=$emp_NIC&Date_Ob=$Date_Ob&gender=$gender&section_ID=$section_ID&mobile_num=$mobile_num&fixed_num=$fixed_num&section_user_name=$section_user_name&emp_activation=$emp_activation");
        }else {
            header("Location: http://localhost/ClinicButler/adm.php?errormsg=noemp");
        }
}elseif($action=='Clear'){

    header("Location: http://localhost/ClinicButler/adm.php");

}
//adm page section activation
elseif($action=='Alb'){
    
    $sql = "UPDATE section SET sec_activation='1' WHERE section_ID='001'";
        if ($conn->query($sql)== TRUE){
            
            $sql = "UPDATE section SET sec_activation='1' WHERE section_ID='005'";
            if ($conn->query($sql)== TRUE){
                header("Location: http://localhost/ClinicButler/adm.php?msg=secacti");
            } else{
                header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorsecac");
            }

        } else{
            header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorsecac");
        }

}elseif($action=='Dalb'){
    
    $sql = "UPDATE section SET sec_activation='0' WHERE section_ID='001'";
    if ($conn->query($sql)== TRUE){

        $sql = "UPDATE section SET sec_activation='0' WHERE section_ID='005'";
            if ($conn->query($sql)== TRUE){
                header("Location: http://localhost/ClinicButler/adm.php?msg=secde");
            } else{
                header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorsecde");
            }

    } else{
        header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorsecde");
    }

}elseif($action=='Adis'){
    
    $sql = "UPDATE section SET sec_activation='1' WHERE section_ID='002'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/adm.php?msg=secacti");
        } else{
            header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorsecac");
        }

}elseif($action=='Dadis'){
    
    $sql = "UPDATE section SET sec_activation='0' WHERE section_ID='002'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/adm.php?msg=secde");
        } else{
            header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorsecde");
        }

}elseif($action=='Areg'){
    
    $sql = "UPDATE section SET sec_activation='1' WHERE section_ID='003'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/adm.php?msg=secacti");
        } else{
            header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorsecac");
        }

}elseif($action=='Dareg'){
    
    $sql = "UPDATE section SET sec_activation='0' WHERE section_ID='003'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/adm.php?msg=secde");
        } else{
            header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorsecde");
        }

}elseif($action=='Ainf'){
    
    $sql = "UPDATE section SET sec_activation='1' WHERE section_ID='006'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/adm.php?msg=secacti");
        } else{
            header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorsecac");
        }

}elseif($action=='Dainf'){
    
    $sql = "UPDATE section SET sec_activation='0' WHERE section_ID='006'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/adm.php?msg=secde");
        } else{
            header("Location: http://localhost/ClinicButler/adm.php?errormsg=errorsecde");
        }

}

//admcs page clinic
elseif($action=='srchcln_num'){
    
    $clinic_id=$_POST['clinic_id'];

    $sql = "SELECT * FROM clinic_details WHERE clinic_id='$clinic_id' OR clinic_name='$clinic_id'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $clinic_id=$row['clinic_id'];
                $clinic_name=$row['clinic_name'];
                $clinic_activation=$row['clinic_activation'];
            }        
                header("Location: http://localhost/ClinicButler/admcs.php?action=clinsearch&clinic_id=$clinic_id&clinic_name=$clinic_name&clinic_activation=$clinic_activation");
        }else {
            header("Location: http://localhost/ClinicButler/admcs.php?errormsg=nocln");
        }

}elseif($action=='clndrpge'){

    header("Location: http://localhost/ClinicButler/admCScldr.php");

}elseif($action=='actclin'){
    
    $clin_id=$_POST['clin_id'];
    
    $sql = "UPDATE clinic_details SET clinic_activation='1' WHERE clinic_id='$clin_id'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/admcs.php?msg=clnact");
        } else{
            header("Location: http://localhost/ClinicButler/admcs.php?errormsg=erclnact");
        }
}elseif($action=='updclin'){
    
    $clin_id=$_POST['clin_id'];
    $clin_nme=$_POST['clin_nme'];
    
    $sql = "UPDATE clinic_details SET clinic_name='$clin_nme' WHERE clinic_id='$clin_id'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/admcs.php?msg=clnup");
        } else{
            header("Location: http://localhost/ClinicButler/admcs.php?errormsg=erclnup");
        }
}elseif($action=='dactclin'){
    
    $clin_id=$_POST['clin_id'];
    
    $sql = "UPDATE clinic_details SET clinic_activation='0' WHERE clinic_id='$clin_id'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/admcs.php?msg=decln");
        } else{
            header("Location: http://localhost/ClinicButler/admcs.php?errormsg=erclnde");
        }
}elseif($action=='addNclin'){
    
    $clin_id=$_POST['clin_id'];
    $clin_nme=$_POST['clin_nme'];
    $clin_act='1';

    $sql = "INSERT INTO clinic_details (clinic_id, clinic_name, clinic_activation) VALUES 
    ('$clin_id' , '$clin_nme' , '$clin_act')";

    if ($conn->query($sql) === TRUE) {
        header("Location: http://localhost/ClinicButler/admcs.php?msg=addncln");
    } else {
        header("Location: http://localhost/ClinicButler/admcs.php?errormsg=ernclnad");
    }
}
//admcs page doc
elseif($action=='srchdoc_num'){
    
    $doc_regno=$_POST['doc_regno'];

    $sql = "SELECT * FROM doctor_details WHERE doc_regno='$doc_regno' OR doc_nic='$doc_regno'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $doc_name=$row['doc_name'];
                $doc_regno=$row['doc_regno'];
                $doc_nic=$row['doc_nic'];
                $gender=$row['gender'];
                $doc_activation=$row['doc_activation'];
                $doc_username=$row['doc_username'];
                $clinic_id1=$row['clinic_id'];
            }        
                header("Location: http://localhost/ClinicButler/admcs.php?action1=docsearch&doc_name=$doc_name&doc_regno=$doc_regno&doc_nic=$doc_nic&gender=$gender&doc_activation=$doc_activation&doc_username=$doc_username&clinic_id1=$clinic_id1");
        }else {
            header("Location: http://localhost/ClinicButler/admcs.php?errormsg=nodr");
        }

}elseif($action=='actdoc'){
    
    $doc_regno=$_POST['doc_regno'];
    
    $sql = "UPDATE doctor_details SET doc_activation='1' WHERE doc_regno='$doc_regno'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/admcs.php?msg=dract");
        } else{
            header("Location: http://localhost/ClinicButler/admcs.php?errormsg=erdract");
        }

}elseif($action=='upddoc'){

    $doc_nic=$_POST['doc_nic'];
    $doc_name=$_POST['doc_name'];
    $doc_regno=$_POST['doc_regno'];
    $clinic_id=$_POST['clinic_id'];
    $gender=$_POST['gender'];
    $doc_password=$_POST['doc_password'];
    $doc_username=$_POST['doc_username'];
    $doc_activation='1';

    if(strlen(trim($doc_password))<=0){

        $sql = "SELECT * FROM doctor_details WHERE (doc_regno='$doc_regno' OR doc_nic='$doc_nic') AND doc_activation='$doc_activation'";
        $result = $conn->query($sql);

            if ($result->num_rows > 0) {
        
                $sql = "UPDATE doctor_details SET doc_nic='$doc_nic',doc_name='$doc_name',doc_regno='$doc_regno',clinic_id='$clinic_id',gender='$gender' WHERE (doc_regno='$doc_regno' OR doc_nic='$doc_nic')";
                 if ($conn->query($sql)== TRUE){
                     header("Location: http://localhost/ClinicButler/admcs.php?msg=drdtup");
                 } else{
                     header("Location: http://localhost/ClinicButler/admcs.php?errormsg=erdrdtup");
                 }

            }else {
                header("Location: http://localhost/ClinicButler/admcs.php?updatdoc=dactiv");
            }

    }else{

        $dr_password_EN=md5($_POST['doc_password']);
                
                $sql = "UPDATE doctor_details SET doc_password='$dr_password_EN',doc_username='$doc_username' WHERE (doc_regno='$doc_regno' OR doc_nic='$doc_nic')";
                 if ($conn->query($sql)== TRUE){
                     header("Location: http://localhost/ClinicButler/admcs.php?msg=drpassup");
                 } else{
                     header("Location: http://localhost/ClinicButler/admcs.php?errormsg=erdruppsup");
                 }

    }

}elseif($action=='dactdoc'){
    
    $doc_regno=$_POST['doc_regno'];
    
    $sql = "UPDATE doctor_details SET doc_activation='0' WHERE doc_regno='$doc_regno'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/admcs.php?msg=drdeact");
        } else{
            header("Location: http://localhost/ClinicButler/admcs.php?errormsg=erdrdeact");
        }

}elseif($action=='addNdoc'){

    $doc_nic=$_POST['doc_nic'];
    $doc_name=$_POST['doc_name'];
    $doc_regno=$_POST['doc_regno'];
    $clinic_id=$_POST['clinic_id'];
    $gender=$_POST['gender'];
    $doc_password=md5($_POST['doc_password']);
    $doc_username=$_POST['doc_username'];
    $doc_activation='1';

    $sql = "SELECT * FROM doctor_details WHERE (doc_nic='$doc_nic' OR doc_regno='$doc_regno')";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            header("Location: http://localhost/ClinicButler/admcs.php?errormsg=dractiv");
        }else {

            if(strlen(trim($doc_username AND $doc_password))<=0){

                $sql = "INSERT INTO doctor_details (doc_nic, doc_name, doc_regno, clinic_id, gender, doc_activation) VALUES 
                ('$doc_nic' , '$doc_name' , '$doc_regno' , '$clinic_id' , '$gender' , '$doc_activation')";

                if ($conn->query($sql) === TRUE) {
                    //echo "New record created successfully";
                    header("Location: http://localhost/ClinicButler/admcs.php?msg=inndr");
                } else {
                    header("Location: http://localhost/ClinicButler/admcs.php?errormsg=erinndr");
                }

            }else{

                $sql = "INSERT INTO doctor_details (doc_nic, doc_name, doc_regno, clinic_id, gender, doc_password, doc_username, doc_activation) VALUES 
                ('$doc_nic' , '$doc_name' , '$doc_regno' , '$clinic_id' , '$gender' , '$doc_password' , '$doc_username' , '$doc_activation')";

                if ($conn->query($sql) === TRUE) {
                    //echo "New record created successfully";
                    header("Location: http://localhost/ClinicButler/admcs.php?msg=inndr");
                } else {
                    header("Location: http://localhost/ClinicButler/admcs.php?errormsg=erinndr");
                }

            }
        }

}

//admCScldr page clinic date
elseif($action=='srchdrnm'){
    
    $doc_regno=$_POST['doc_regno'];

    if($doc_regno=="*"){

        header("Location: http://localhost/ClinicButler/admCScldr.php?action=clinddtsrch&doc_name=ALL&doc_regno=ALL&clinic_name=ALL&clinic_id=ALL");
    
    }else{

        $sql = "SELECT * FROM doctor_details WHERE (doc_regno='$doc_regno' OR doc_nic='$doc_regno') AND doc_activation='1'";
        $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $doc_name=$row['doc_name'];
                    $doc_regno=$row['doc_regno'];
                    $clinic_id=$row['clinic_id'];
                }
    
                $sql = "SELECT * FROM clinic_details WHERE clinic_id='$clinic_id' AND clinic_activation='1'";
                $result = $conn->query($sql);
            
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $clinic_id=$row['clinic_id'];
                            $clinic_name=$row['clinic_name'];
                        }        
                            header("Location: http://localhost/ClinicButler/admCScldr.php?action=clinddtsrch&doc_name=$doc_name&doc_regno=$doc_regno&clinic_name=$clinic_name&clinic_id=$clinic_id");
                    }else {
                        header("Location: http://localhost/ClinicButler/admCScldr.php?errorMessage=clininoAct");
                    }
    
            }else {
                header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=drnoAct");
            }

    }

}elseif($action=='dactclindt'){    
    
    $clinic_id=$_POST['clinic_id'];
    $doc_regno=$_POST['doc_regno'];

    $clinic_date=$_POST['clinic_date'];
    $clinic_timeF=$_POST['clinic_timeF'];
    $clinic_timeT=$_POST['clinic_timeT'];
    $id=$_POST['id'];

    $pcdate = date('Y-m-d');

    if($id=="ALL"){

        $sql = "DELETE FROM clinic_calendar WHERE clinic_date>='$pcdate'";
            if ($conn->query($sql)== TRUE){
                header("Location: http://localhost/ClinicButler/admcscldr.php?msg=dtyes");
            } else{
                header("Location: http://localhost/ClinicButler/admcscldr.php?errormsg=dtclindtdel");
            }

    }else{

        if($clinic_date<=$pcdate){
                    
            header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=oldddt");

        }else{

            if(!empty($clinic_date)){
    
                $sql = "DELETE FROM clinic_calendar WHERE clinic_date='$clinic_date' AND doc_regno='$doc_regno'";
                    if ($conn->query($sql)== TRUE){
                        header("Location: http://localhost/ClinicButler/admcscldr.php?msg=dtyes");
                    } else{
                        header("Location: http://localhost/ClinicButler/admcscldr.php?errormsg=dtclindtdel");
                    }
    
            }else{
    
                if(!empty($clinic_timeF) AND !empty($clinic_timeT) AND !empty($clinic_date)){
    
                    $sql = "DELETE FROM clinic_calendar WHERE clinic_date='$clinic_date' AND doc_regno='$doc_regno' AND clinic_timeF='$clinic_timeF' AND clinic_timeT='$clinic_timeT'";
                        if ($conn->query($sql)== TRUE){
                            header("Location: http://localhost/ClinicButler/admcscldr.php?msg=tmeyes");
                        } else{
                            header("Location: http://localhost/ClinicButler/admcscldr.php?errormsg=tmeclindtdel");
                        }
                }else{
                    
                    header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=datetimeempt");
                    
                }
    
            }
        }

    }
    

}elseif($action=='addNclindt'){
    
    $clinic_id=$_POST['clinic_id'];
    $clinic_name=$_POST['clinic_name'];
    $doc_regno=$_POST['doc_regno'];
    $doc_name=$_POST['doc_name'];

    $clinic_date=$_POST['clinic_date'];
    $clinic_timeF=$_POST['clinic_timeF'];
    $clinic_timeT=$_POST['clinic_timeT'];
    $id=$_POST['id'];
 
    $clinic_activation='1';
    $doc_activation='1';
    $clinicalendar_activation ='1';

    $pcdate = date('Y-m-d');

    if($clinic_date>=$pcdate){

        $sql = "SELECT * FROM clin_room WHERE id='$id' AND room_activ='1'";
        $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
    
                $sql = "SELECT * FROM clinic_calendar WHERE (( clinic_timeF BETWEEN '$clinic_timeF' and '$clinic_timeT' ) OR ( clinic_timeT BETWEEN '$clinic_timeF' and '$clinic_timeT')) AND clinic_date='$clinic_date'AND id='$id' AND clinicalendar_activation='1'";
                $result = $conn->query($sql);
            
                    if ($result->num_rows > 0) {
    
                        header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=clindttmsme");
                        
                    }else {
                        if(strlen(trim($clinic_date)AND($clinic_timeF)AND($clinic_timeT))<=0){
    
                            header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=clindataerror");
    
                        }else{
                            
                            $sql = "INSERT INTO clinic_calendar (clinic_id, doc_regno, clinic_date, clinic_timeF, clinic_timeT, id, clinic_activation, doc_activation, clinicalendar_activation) VALUES 
                            ('$clinic_id' , '$doc_regno' , '$clinic_date' , '$clinic_timeF' , '$clinic_timeT' , '$id' , '$clinic_activation' , '$doc_activation' , '$clinicalendar_activation')";
                
                            if ($conn->query($sql) === TRUE) {
                                //echo "New record created successfully";
                                header("Location: http://localhost/ClinicButler/admCScldr.php?msg=insertNclindt");
                            } else {
                                header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=erinsertNclindt");
                            }
                            
                        }
    
                    }
                    
            }else {
                header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=roomact");
            }
            
    }else{

        header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=oldddt");
    }

}
//admCScldr page clinic room
elseif($action=='srchclnrm'){
    
    $room_name1=$_POST['room_name'];

    $sql = "SELECT * FROM clin_room WHERE id='$room_name1' OR room_name='$room_name1'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $id=$row['id'];
                $room_name=$row['room_name'];
                $room_device=$row['room_device'];
                $clinic_id1=$row['clinic_id'];
                $room_activ=$row['room_activ'];
            }        
            header("Location: http://localhost/ClinicButler/admCScldr.php?action=clnrmsrc&id=$id&room_name=$room_name&room_device=$room_device&clinic_id1=$clinic_id1&room_activ=$room_activ");
        }else {
            header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=errom");
        }

}elseif($action=='actroom'){
    
    $id=$_POST['id'];
    
    $sql = "UPDATE clin_room SET room_activ='1' WHERE id='$id'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/admCScldr.php?msg=romupyes");
        } else{
            header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=errorup");
        }

}elseif($action=='updroom'){
    
    $room_name=$_POST['room_name'];
    $id=$_POST['id'];
    $room_device=$_POST['room_device'];
    $clinic_id=$_POST['clinic_id'];

    //die($clinic_id);
    
    $sql = "UPDATE clin_room SET id='$id',room_name='$room_name',room_device='$room_device',clinic_id='$clinic_id' WHERE id='$id' OR room_name='$room_name' OR clinic_id='$clinic_id'";
        if ($conn->query($sql)== TRUE){
    
            $sql = "UPDATE clinic_calendar SET id='$id' WHERE clinic_id='$clinic_id'";
                if ($conn->query($sql)== TRUE){
                    header("Location: http://localhost/ClinicButler/admCScldr.php?msg=romupy");
                } else{
                    header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=error");
                }

        } else{
            header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=eromup");
        }

}elseif($action=='dactroom'){
    
    $id=$_POST['id'];

    $pcdate = date('Y-m-d');

    $sql = "SELECT * FROM clinic_calendar WHERE id='$id' AND clinic_date>='$pcdate' ";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=indaterm");
        }else{
            $sql = "UPDATE clin_room SET room_activ='0' WHERE id='$id'";
                if ($conn->query($sql)== TRUE){
                    header("Location: http://localhost/ClinicButler/admCScldr.php?msg=romdeact");
                } else{
                    header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=erromde");
                }
        }

}elseif($action=='addroom'){
    
    $room_name=$_POST['room_name'];
    $id=$_POST['id'];
    $room_device=$_POST['room_device'];
    $clinic_id=$_POST['clinic_id'];
    $room_activ='1';

    $sql = "SELECT * FROM clin_room WHERE id='$id' AND room_name='$room_name'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=rmactiv");

        }else {

                $sql = "INSERT INTO clin_room (id, room_name, room_device, clinic_id, room_activ) VALUES 
                ('$id' , '$room_name' , '$room_device' , '$clinic_id' , '$room_activ')";

                if ($conn->query($sql) === TRUE) {
                    //echo "New record created successfully";
                    header("Location: http://localhost/ClinicButler/admCScldr.php?msg=okrmin");
                } else {
                    header("Location: http://localhost/ClinicButler/admCScldr.php?errormsg=erromins");
                }
        }
}
//admLABDis page drug
elseif($action=='srchdrg'){
    
    $drug_number=$_POST['drug_number'];

    $sql = "SELECT * FROM drug_info WHERE drg_number='$drug_number'";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $drg_name=$row['drg_name'];
                $drg_capa=$row['drg_capa'];
                $drg_vol=$row['drg_vol'];
                $drg_number=$row['drg_number'];
                $prc_o_pill=$row['prc_o_pill'];
                $drg_activation=$row['drg_activation'];
            }        
            header("Location: http://localhost/ClinicButler/admLABDis.php?action=drgnumsrc&drg_name=$drg_name&drg_capa=$drg_capa&drg_vol=$drg_vol&drg_number=$drg_number&prc_o_pill=$prc_o_pill&drg_activation=$drg_activation");
        }else {

            $sql = "SELECT * FROM drug_info WHERE drg_name='$drug_number'";
            $result = $conn->query($sql);
        
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $drg_name=$row['drg_name'];
                    }        
                    header("Location: http://localhost/ClinicButler/admLABDis.php?action=drgnmesrc&drg_name=$drg_name");
                }else {
                    header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=errdrg");
                }
        }

}elseif($action=='ADDdrg'){
    
    $drg_name=$_POST['drg_name'];
    $drg_capa=$_POST['drg_capa'];
    $drg_vol=$_POST['drg_vol'];
    $drg_number=$_POST['drg_number'];
    $prc_o_pill=$_POST['prc_o_pill'];

    $sql = "SELECT * FROM drug_info WHERE drg_name='$drg_name' AND drg_capa='$drg_capa' AND drg_vol='$drg_vol' AND drg_number='$drg_number' AND (drg_activation='1' OR drg_activation='0')";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
    
            $sql = "UPDATE drug_info SET prc_o_pill='$prc_o_pill' ,drg_activation='1' WHERE drg_number='$drg_number'";
                if ($conn->query($sql)== TRUE){
                    header("Location: http://localhost/ClinicButler/admLABDis.php?msg=drgins");
                } else{
                    header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=errdrgins");
                }

        }else {

                $sql = "INSERT INTO drug_info (drg_name, drg_capa, drg_vol, drg_number, prc_o_pill, drg_activation) VALUES 
                ('$drg_name' , '$drg_capa' , '$drg_vol' , '$drg_number' , '$prc_o_pill' , '1')";

                if ($conn->query($sql) === TRUE) {
                    //echo "New record created successfully";
                    header("Location: http://localhost/ClinicButler/admLABDis.php?msg=drgins");
                } else {
                    header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=errdrgins");
                }
        }
        
}elseif($action=='UPDdrg'){
    
    $drg_name=$_POST['drg_name'];
    $drg_capa=$_POST['drg_capa'];
    $drg_vol=$_POST['drg_vol'];
    $drg_number=$_POST['drg_number'];
    $prc_o_pill=$_POST['prc_o_pill'];
    $drg_activation=$_POST['drg_activation'];

        $sql = "UPDATE drug_info SET drg_name='$drg_name' ,drg_capa='$drg_capa' ,drg_vol='$drg_vol'  ,drg_number='$drg_number' ,prc_o_pill='$prc_o_pill' ,drg_activation='$drg_activation' WHERE drg_number='$drg_number' OR (drg_name='$drg_name' AND drg_capa='$drg_capa' AND drg_vol='$drg_vol')";
            if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/admLABDis.php?msg=drgup");
            } else{
                header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=errdrgup");
            }

}elseif($action=='DELdrg'){
    
    $drg_number=$_POST['drg_number'];

    $sql = "UPDATE drug_info SET drg_activation='0' WHERE drg_number='$drg_number'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/admLABDis.php?msg=drgdel");
        } else{
            header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=erdrgdel");
        }

}
//admLABDis page checkUP
elseif($action=='srchchckup'){
    
    $ctorchcknme=$_POST['ctorchcknme'];

    if($ctorchcknme=="*"){

        header("Location: http://localhost/ClinicButler/admLABDis.php?action=checkuplst&checkup_indx=ALL&checkup_name=ALL&category_id=ALL&category=ALL&checkup_price=ALL&lst_activation=ALL");

    }else{

        $sql = "SELECT * FROM checkup_cate WHERE category='$ctorchcknme'";
        $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $category_id=$row['category_id'];
                    $category=$row['category'];
                    $activation_cate=$row['activation_cate'];
                }       
                header("Location: http://localhost/ClinicButler/admLABDis.php?action=checkuplst&checkup_indx=$checkup_indx&checkup_name=$category&category_id=$category_id&category=$category&checkup_price=$checkup_price&lst_activation=$activation_cate");
            }else {

                $sql = "SELECT * FROM checkup_lst WHERE checkup_name='$ctorchcknme'";
                $result = $conn->query($sql);
            
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            $checkup_indx=$row['checkup_indx'];
                            $checkup_name=$row['checkup_name'];
                            $category_id2=$row['category_id'];
                            $checkup_price=$row['checkup_price'];
                            $lst_activation=$row['lst_activation'];
                        }

                        $sql = "SELECT * FROM checkup_cate WHERE category_id='$category_id2'";
                        $result = $conn->query($sql);
                    
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $category_id=$row['category_id'];
                                    $category=$row['category'];
                                }       
                                header("Location: http://localhost/ClinicButler/admLABDis.php?action=checkuplst&checkup_indx=$checkup_indx&checkup_name=$checkup_name&category_id=$category_id&category=$category&checkup_price=$checkup_price&lst_activation=$lst_activation");
                            }
                    }else {
                        header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=errchck");
                    }

            }
    }

}elseif($action=='actchcate'){
    
    $checkup_name=$_POST['checkup_name'];
    $category_id=$_POST['category_id'];

    if($checkup_name=="ALL" AND $category_id=="ALL"){

        $sql = "UPDATE checkup_cate SET activation_cate='1' WHERE activation_cate='0'";
            if ($conn->query($sql)== TRUE){

                $sql = "UPDATE checkup_lst SET lst_activation='1' WHERE lst_activation='0'";
                    if ($conn->query($sql)== TRUE){
                        header("Location: http://localhost/ClinicButler/admLABDis.php?msg=actall");
                    }

            } else{
                header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=catup");
            }

    }else{

        $sql = "UPDATE checkup_cate SET activation_cate='1' WHERE category='$checkup_name' AND category_id='$category_id'";
            if ($conn->query($sql)== TRUE){

                $sql = "UPDATE checkup_lst SET lst_activation='1' WHERE category_id='$category_id'";
                    if ($conn->query($sql)== TRUE){
                        header("Location: http://localhost/ClinicButler/admLABDis.php?msg=cateok");
                    }
            
            } else{
                header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=erchcate");
            }

    }

}elseif($action=='updchck'){
    
    $checkup_name=$_POST['checkup_name'];
    $checkup_indx=$_POST['checkup_indx'];
    $category_id=$_POST['category_id'];
    $checkup_price=$_POST['checkup_price'];

    $sql = "UPDATE checkup_lst SET checkup_name='$checkup_name',category_id='$category_id',checkup_price='$checkup_price' WHERE checkup_indx='$checkup_indx'";
        if ($conn->query($sql)== TRUE){
            header("Location: http://localhost/ClinicButler/admLABDis.php?msg=upckup");
        }else{
            header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=erupch");
        }

}elseif($action=='dacchcate'){
    
    $checkup_name=$_POST['checkup_name'];
    $category_id=$_POST['category_id'];

    if($checkup_name=="ALL" AND $category_id=="ALL"){

        $sql = "UPDATE checkup_cate SET activation_cate='0' WHERE activation_cate='1'";
            if ($conn->query($sql)== TRUE){

                $sql = "UPDATE checkup_lst SET lst_activation='0' WHERE lst_activation='1'";
                    if ($conn->query($sql)== TRUE){
                        header("Location: http://localhost/ClinicButler/admLABDis.php?chckupdeact=yes");
                    }

            } else{
                header("Location: http://localhost/ClinicButler/admLABDis.php?chckupALLdeact=error");
            }

    }else{

        $sql = "UPDATE checkup_cate SET activation_cate='0' WHERE category='$checkup_name' AND category_id='$category_id'";
            if ($conn->query($sql)== TRUE){

                $sql = "UPDATE checkup_lst SET lst_activation='0' WHERE category_id='$category_id'";
                    if ($conn->query($sql)== TRUE){
                        header("Location: http://localhost/ClinicButler/admLABDis.php?msg=dectokcat");
                    }

            } else{
                header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=erdectokcat");
            }

    }

    // $sql = "SELECT * FROM clinic_calendar WHERE id='$id' AND clinic_date>='$pcdate' ";
    // $result = $conn->query($sql);

    //     if ($result->num_rows > 0) {
    //         header("Location: http://localhost/ClinicButler/admCScldr.php?clinrmd=indate");
    //     }else{
    //         $sql = "UPDATE clin_room SET room_activ='0' WHERE id='$id'";
    //             if ($conn->query($sql)== TRUE){
    //                 header("Location: http://localhost/ClinicButler/admCScldr.php?clinrmd=yes");
    //             } else{
    //                 header("Location: http://localhost/ClinicButler/admCScldr.php?clinrmd=error");
    //             }
    //     }

}elseif($action=='addchechup'){
    
    $checkup_name=$_POST['checkup_name'];
    $category_id=$_POST['category_id'];
    $checkup_price=$_POST['checkup_price'];
    $lst_activation=$_POST['lst_activation'];

    if(empty($checkup_name) OR empty($category_id) OR empty($checkup_price)){

        header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=empty");

    }else{

        $sql = "SELECT * FROM checkup_lst WHERE checkup_name='$checkup_name' AND category_id='$category_id'";
        $result = $conn->query($sql);
    
             if ($result->num_rows > 0) {
    
                 header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=chckactiv");
    
             }else {
    
                     $sql = "INSERT INTO checkup_lst (checkup_indx, checkup_name, category_id, checkup_price, lst_activation) VALUES 
                     ('' , '$checkup_name' , '$category_id' , '$checkup_price' , '$lst_activation')";
    
                     if ($conn->query($sql) === TRUE) {
                         //echo "New record created successfully";
                         header("Location: http://localhost/ClinicButler/admLABDis.php?msg=addchckok");
                     } else {
                         header("Location: http://localhost/ClinicButler/admLABDis.php?errormsg=addckerror");
                     }
             }

    }
}


$conn->close();
?>