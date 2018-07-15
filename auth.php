<?php
 

 $sn = "localhost";
 $un = "root";
 $ps = "";
 $db = "myworkbook";

 $con = new mysqli($sn,$un,$ps,$db);

 $c_users_tab = " CREATE TABLE IF NOT EXISTS users ( 
                     
                     id INT(200) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                     user_fname varchar(499),
                     user_lname varchar(499),
                     user_email varchar(499),
                     user_pass varchar(100),
                     user_join timestamp,
                     user_sess int(2)
                 )";
$con->query($c_users_tab);


$c_manual_job_tab = "CREATE TABLE IF NOT EXISTS manual_jobs (
                     
                     job_id int(200) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                     job_by int(200) ,
                     FOREIGN KEY (job_by) REFERENCES users(id),
                     board_type varchar(499),
                     job_type varchar(499),
                     company_name varchar(1200),
                     job_title varchar(1200),
                     job_loc varchar(1200),
                     job_url varchar(2000),
                     job_desc varchar(4999),
                     job_time timestamp
                  )";

$con->query($c_manual_job_tab);

$c_auto_job_tab = "CREATE TABLE IF NOT EXISTS auto_jobs (
                   
                   ajob_id int(200) UNSIGNED AUTO_INCREMENT PRIMARY KEy,
                   ajob_by  int(200),
                   FOREIGN KEY (ajob_by) REFERENCES users(id),
                   job_title varchar(1200),
                   job_desc varchar(1200),
                   job_comp varchar(1200),
                   job_loca varchar(1200),
                   job_url varchar(2000),
                   job_time timestamp
                 ) ";

$con->query($c_auto_job_tab);


#------------------------------------------------------------
#-----------------------------------  R E G I S T E R U S E R 
#------------------------------------------------------------


if(isset($_POST["reg_new_user"])){

	if( 
		!empty($_POST["su-fname"]) && 
	    !empty($_POST["su-lname"]) &&
	    !empty($_POST["su-email"]) &&
	    !empty($_POST["su-pass"]) 
	  ){
        
        if(isset($_POST["su-check"])){

        	$su_fn = $_POST['su-fname'];
			$su_ln = $_POST['su-lname'];
			$su_em = $_POST['su-email'];
			$su_ps = $_POST['su-pass'];
        	
        	$i_users_tab = "INSERT INTO `users` VALUES (NULL,'$su_fn','$su_ln','$su_em','$su_ps',now(),1) ";
        	if ($con->query($i_users_tab)) {
           	   echo "great";
            } else{
            	echo $con->error;
            }                                          

        } else{
        	echo "not-checked";
        }

	} else{
		echo "empty-box";
	}

}

#--------------------------------------------------------
#-------------------------------------  L O G I N U S E R
#--------------------------------------------------------


if(isset($_POST["login_user"])){

	if( 
	    !empty($_POST["lg-email"]) &&
	    !empty($_POST["lg-pass"]) 
	  ){

        $lg_em = $_POST["lg-email"];
        $lg_ps = $_POST["lg-pass"];

        $s_users_tab = "SELECT * FROM `users` WHERE `user_email` = '$lg_em' AND `user_pass` = '$lg_ps' ";

        $count =  $con->query($s_users_tab);
        
        if(mysqli_num_rows($count)>0){ 
			echo "great";
		} else{
			echo "no-user";
		}
        

	} else{
		echo "empty-box";
	}

}

#------------------------------------------------------------------
#-------------------------------------  A D D J O B M A N U A L L Y
#------------------------------------------------------------------


if(isset($_POST["mjob_add"])){
     if(  !empty($_POST["mj_cname"]) && 
     	  !empty($_POST["mj_jobtit"]) && 
     	  !empty($_POST["mj_loc"]) && 
     	  !empty($_POST["mj_url"]) &&
     	  !empty($_POST["mj_desc"])
     	){
            
            if(strtolower($_POST["board_type"]) == "board type"  OR 
               strtolower($_POST["job_type"]) == "job type"  ){

                echo "menu-select";

            } else{
                
                $mj_cn = $_POST["mj_cname"];
				$mj_jti = $_POST["mj_jobtit"];
				$mj_lo = $_POST["mj_loc"];
				$mj_ur = $_POST["mj_url"];
				$mj_de = $_POST["mj_desc"];
				$mj_bt = $_POST["board_type"];
				$mj_jt = $_POST["job_type"];

            	$i_manual_job_tab = "INSERT INTO `manual_jobs` VALUES (NULL,1,'$mj_bt','$mj_jt','$mj_cn','$mj_jti','$mj_lo',
            	                                                       '$mj_ur','$mj_de',now())";

            	if($con->query($i_manual_job_tab)){
            		echo "great";
            	} else{
            		echo $con->error;
            	}
            	
            }


     	} else{
     		echo "empty-box";
     	}
}

#----------------------------------------------------------
#-------------------------------------  A D D A U T O J O B 
#----------------------------------------------------------

if(isset($_GET["ajob_add"])){
     
    $aj_jh = $_GET["jobHead"]; 
    $aj_jd = addslashes($_GET["jobDesc"]); 
    $aj_jc = $_GET["jobComp"]; 
    $aj_jl = $_GET["jobLoca"]; 
    $aj_ju = $_GET["jobUrl"]; 

	$i_auto_job_tab = "INSERT INTO `auto_jobs` VALUES (NULL,1,'$aj_jh','$aj_jd','$aj_jc','$aj_jl','$aj_ju',now())";

	if($con->query($i_auto_job_tab)){
		echo "Inserted";
	}else{
		echo $con->error;
	}

	
}














































?>