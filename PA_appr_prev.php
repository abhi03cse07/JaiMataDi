<?php

include_once('head.php');

?>


<html>
<head><title>Performance Appraisal Form</title>
<style>

  table {
    border-collapse: collapse;
	
  }
  th, td {
    border: 1px solid;
	 
    padding: 10px;
    text-align: left;
  }
</style>

<script language = "javascript" type = "text/javascript">

function perfass()
{
document.forms[0].action = "PA_emp_rate.php";
document.forms[0].submit();
}
function frm_exit()
{
document.forms[0].action = "PA_main_menu.php";
document.forms[0].submit();
}
function test()
{
//return(false);
document.forms[0].action = "PA_appr_self.php";
}
function addinfo_form()
{

document.forms[0].action = "PA_add_info.php";
}

function count_Char(obj,lab,max)
{
	result = document.getElementById(lab);
       	if(obj.value.length > max )
	{
	    obj.value = obj.value.substring(0,max); 
        }
        result.value = max - obj.value.length ;
        //result.value = 200 ;
        

}
</script>
</head>
<body  style="background-color: #CDE1EB !important;">

<?
#print_r($_POST);

//include_once "tsutils.php";
include_once "pasutils.php";
error_reporting(E_ERROR);


 if (! CheckAuthKey ($keychk))
   {
      Error ("Login");
      exit;
   }
$db_conn = db_open("offproj",0);
$db_pas = db_open("pas_db",0);
$arr_month= array(1 => "January",2 => "February",3 => "March",4 => "April",5 => "May",6 => "June
",7 => "July",8 => "August",9 => "September",10 => "October",11 => "November",12 => "December");
?>


<!------------------------------------Session CountDown-------------------------------->

<?php 
       session_start();  
//echo $_SESSION['userName'];

?>

<!--<p id="demo"></p>

<script>
// Set the date we're counting down to
var dt = new Date();
         dt.setSeconds( dt.getSeconds() + 320 );

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = dt - now;
    
  // Time calculations for days, hours, minutes and seconds
  
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML =  minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (minutes < 05) {
    	//document.location.reload(true);
		
  }
});
</script>-->



<?php 

echo "<form  name = \"f1\" action =\"$PHP_SELF#book\" method=\"post\"  onSubmit = \"return func(this)\">";
######Saving in the database############################
if($perf_exit)
 {
  echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">You have chosen to fill the performance assessment form later.</font></b></center>";
echo"<br><center><input type=\"submit\" name=\"ss\" value=\"Ok\" onClick=\"frm_exit()\"></center>";  
echo"<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
exit();
 }
if($sub_scr)
{

$qtr_period= pg_query($db_pas,"select qtr_start,qtr_end from pa_init");
$qtr_arr = pg_fetch_array($qtr_period,0);
$qtr_start = trim($qtr_arr[qtr_start]);
$qtr_start_d =explode('-',$qtr_start); 
$qtr_end = trim($qtr_arr[qtr_end]);
$qtr_end_d = explode('-',$qtr_end);

for($i=1;$i<=12;++$i)
{
        if($qtr_start_d[1]==$arr_month[$i])
                $qtr_start_d[1]=$i;

        if($qtr_end_d[1]==$arr_month[$i])
                $qtr_end_d[1]=$i;
}

	
$cur_stamp = mktime(0,0,0,date("n"),date("j"),date("Y"));
$qsd=1;
$qsm = 4;
$qed = 30;
$qem = 6;
$qtr_st_stamp = mktime(0,0,0,$qsm,$qsd,$year);	
$qtr_end_stamp = mktime(0,0,0,$qem,$qed,$year);	
//DateValidate($dob_dd,$dob_mm,$dob_yy,'date of birth');

 $dobar[0]=$_POST[$dob_yy];
 $dobar[1]=$_POST[$dob_mm];
 $dobar[2]=$_POST[$dob_dd];
 $dob_st = Date2Stamp($dobar);

if(!$emp_loc0)
 {
  echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please enter your current work location</font></b></center>";
  exit();
 }

          $grp_stamp = mktime(0,0,0,$group_mm,$group_dd,$group_yy);
	  $curr_stamp = mktime(0,0,0,date("n"),date("j"),date("Y"));
	  if($grp_stamp>$curr_stamp)
	       {
		                echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Date of Joining group can not be greater than current date</font></b></center>";
	                exit();
	       }
DateValidation($group_dd,$group_mm,$group_yy,'Date Of Joining Group');

 $i=0;
   $proj_txt = 'proj_txt'.$i;
   $diff_proj = 'diff_proj'.$i;
   $proj_task = 'proj_task'.$i;  

   $task1_d = 'task1_d'.$i;
   $stat1_d = 'stat1_d'.$i;
   
  if(!($_POST[$proj_txt]) || (!$_POST[$proj_task]) || !($_POST[$task1_d]) || (!$_POST[$stat1_d]))
   {
  echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please enter atleast one project and atleast one task with status of the task</font></b></center>";
  exit();
   }

  for($i=1;$i<$p_rows;$i++)
   {
    $proj_txt = 'proj_txt'.$i;
    $proj_task = 'proj_task'.$i;  

    $task1_d = 'task1_d'.$i;
    if($_POST[$task1_d] &&((!$_POST[$proj_txt]) || (!$_POST[$proj_task])))
     {
  echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please enter project and task name for which you have added task description</font></b></center>";
  exit();
     } 
    }
for($i=0;$i<$t_rows;$i++)
 {
   $tp_att = 'tp_att'.$i;
   $st_tpd = 'st_tpd'.$i;
   $st_tpm = 'st_tpm'.$i;
   $st_tpy = 'st_tpy'.$i;
   $end_tpd = 'end_tpd'.$i;
   $end_tpm = 'end_tpm'.$i;
   $end_tpy = 'end_tpy'.$i;

   //if($_POST[$tp_att])
   // {
        if($_POST[$st_tpd] && $_POST[$st_tpm] && $_POST[$st_tpy])
          {
            $st_stamp = mktime(0,0,0,$_POST[$st_tpm],$_POST[$st_tpd],$_POST[$st_tpy]);
	    $cur_stamp = mktime(0,0,0,date("n"),date("j"),date("Y"));
	    //$qtr_st_stamp  = mktime(0,0,0,$qtr_mm,$qtr_dd,$qtr_yy);  
	    $qtr_st_stamp  = mktime(0,0,0,$qtr_start_d[1],$qtr_start_d[0],$qtr_start_d[2]);  
	    //$qtr_end_stamp  = mktime(0,0,0,$qtr_emm,$qtr_edd,$qtr_eyy);  
	    $qtr_end_stamp  = mktime(0,0,0,$qtr_end_d[1],$qtr_end_d[0],$qtr_end_d[2]);  
	    if($st_stamp>$qtr_end_stamp)
	             {
    echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">From  Date should fall within Appraisal Period</font></b></center>";
	                exit();
	              }
	    if($st_stamp<$qtr_st_stamp)
	             {
		                echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">From  Date should fall within Appraisal Period</font></b></center>";
	                exit();
	              }
	    if($st_stamp>$cur_stamp)
	             {
		                echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">From  Date can not be greater than current date</font></b></center>";
	                exit();
	              }
                   
      DateValidation($_POST[$st_tpd], $_POST[$st_tpm],$_POST[$st_tpy],'start date for training attended');
       $st_date = $st_tpy.'-'.$st_tpm.'-'.$st_tpd;
      }
     else $st_date = null;
     if($_POST[$end_tpd] && $_POST[$end_tpm] && $_POST[$end_tpy])
      {
          $end_stamp = mktime(0,0,0,$_POST[$end_tpm],$_POST[$end_tpd],$_POST[$end_tpy]);
	  $cur_stamp = mktime(0,0,0,date("n"),date("j"),date("Y"));
	    if($end_stamp>$qtr_end_stamp)
	             {
		                echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">To  Date should fall within  Appraisal Period</font></b></center>";
	                exit();
	              }
	    if($end_stamp<$qtr_st_stamp)
	             {
		                echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">To  Date should fall within Appraisal Period</font></b></center>";
	                exit();
	              }
	       if($end_stamp>$cur_stamp)
	         {
		                echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">To  Date can not be greater than current date</font></b></center>";
	                exit();
	         }
     
      DateValidation($_POST[$end_tpd], $_POST[$end_tpm],$_POST[$end_tpy],'end date for training attended');
      
      $end_date = $end_tpy.'-'.$end_tpm.'-'.$end_tpd;
       if($st_date)
       {
        $endar[0]=$_POST[$end_tpy];
        $endar[1]=$_POST[$end_tpm];
        $endar[2]=$_POST[$end_tpd];
        $end_st = mktime(0,0,0,$_POST[$end_tpm],$_POST[$end_tpd],$_POST[$end_tpy]);
        $star[0]=$_POST[$st_tpy];
        $star[1]=$_POST[$st_tpm];
        $star[2]=$_POST[$st_tpd];
	#        $st_st = Date2Stamp($star);
        $st_st = mktime(0,0,0,$_POST[$st_tpm],$_POST[$st_tpd],$_POST[$st_tpy]);
         if($st_st>$end_st)
          {
 	     echo "<br><br><br><center><b>End date of training can't be earlier than start date</b></center>";
	     exit();
          }
	  
       }  //if($st_date)
    }    //if($_POST[$end_tpd] && $_POST[$end_tpm] && $_POST[$end_tpy])
 // }// if($_POST[$tp_att])
} //for($i=0;$i<t_rows;$i++)
$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$year =$key_arr[year];  $qtr =$key_arr[qtr];
$ecode = EmpCodeFromAuthKey($keychk);
$find_rec = pg_query($db_pas,"select pk_sl,emp_rate,emp_proj from pa_lock where emp_code = $ecode and year = $year and qtr = $qtr");
$find_num = pg_num_rows($find_rec);
$pl_fetch = pg_fetch_array($find_rec,0);
$emp_rate = $pl_fetch[emp_rate];
$emp_proj = $pl_fetch[emp_proj];
$pk_sll = $pl_fetch[pk_sl];
	

if($find_num == 0||(($emp_rate=='t')&&(!$emp_proj)))
{
	  if($emp_rate=='t'&&(!$emp_proj))
          {
          	$last_sl=$pk_sll;
          }
          else
          {

         	$find_maxsl = pg_query($db_pas,"select max(pk_sl) as last_sl from pa_lock");
	 	$sl_fetch = pg_fetch_array($find_maxsl,0);
	 	$last_sl = $sl_fetch[last_sl];
	 	$last_sl = (int)$last_sl;
	 	if(!$last_sl) $last_sl = 1;
	 	else $last_sl++;

 	 	$pa_lock_ins =  pg_query($db_pas,"insert into pa_lock(emp_code,year,qtr,pk_sl) values($ecode,$year,$qtr,$last_sl)");
         }
	if($last_sl){
              //Modified By akila to add bu_code in pa_emp_record table on 4-4-07
               $b_q = pg_query($db_conn,"select bu_code from emp_master where emp_code = $ecode");
               $b_ar=pg_fetch_array($b_q,0);
               $bu_code=$b_ar[bu_code]; 
               $insert_into_pa_emp_records = pg_query($db_pas,"insert into pa_emp_record (pk_sl,sr_due,previous_id,desg,dept,grp,emp_name) values ($last_sl,'$sal_due_f',$ecode_gen, '$desg_get', '$res_func_name', '$func_ename', '$emp_name')" );
               $update_into_pa_emp_records = pg_query($db_pas,"UPDATE pa_emp_record SET review_mgr='$rev_code' where pk_sl='$last_sl'");
               $update_pa_emp_records = pg_query($db_pas,"UPDATE pa_emp_record SET bu='$bu_code' where pk_sl='$last_sl'");
	
		if($insert_into_pa_emp_records)
		{
//			echo "<br>Inserted into emp_record";
		}

	}

	 if($pa_lock_ins||$last_sl)
	  {
           $emp_dept = addslashes($emp_dept);		  
          // $res_lock_name = addslashes($res_lock_name);		  
           $emp_loc0 = addslashes($emp_loc0);		  
	   $dob = $dob_yy.'-'.$dob_mm.'-'.$dob_dd;
	   $group_date = $group_yy.'-'.$group_mm.'-'.$group_dd;
	   if($group_date=='--')
	   {
           $group_date ='null';	   
	   $pa_emp_info_ins = pg_query($db_pas,"insert into pa_emp_info(pk_sl,loc,dojg) values($last_sl,'$emp_loc0',$group_date)");
	   }
	   else
	   $pa_emp_info_ins = pg_query($db_pas,"insert into pa_emp_info(pk_sl,loc,dojg) values($last_sl,'$emp_loc0','$group_date')");

   for($i =0;$i<$p_rows;$i++)
   {
      $proj_sl = $i+1;
      $proj_txt = sprintf("proj_txt$i");
      $diff_proj = sprintf("diff_proj$i");
      $proj_task = sprintf("proj_task$i");  

      $proj_txt  = $$proj_txt; 
      $diff_proj  = $$diff_proj; 
      $proj_task = $$proj_task;

   if($proj_txt && $proj_task)
    {
      $proj_txt  = addslashes($proj_txt); 
      $diff_proj  = addslashes($diff_proj); 
      $proj_task = addslashes($proj_task);
   $emp_proj_ins = pg_query($db_pas,"insert into pa_emp_proj (pk_sl,slno,proj,task,proj_com) values($last_sl,$proj_sl,'$proj_txt','$proj_task','$diff_proj')");

   $task1_d = sprintf("task1_d$i");
   $stat1_d = sprintf("stat1_d$i");
    $cons1_d = sprintf("cons1_d$i");
   $c_over1_d = sprintf("c_over1_d$i");
   $reason1_d = sprintf("reason1_d$i");

   $task1_d = $$task1_d;  
   $stat1_d = $$stat1_d;
 $cons1_d = $$cons1_d;
   $c_over1_d = $$c_over1_d;
   $reason1_d = $$reason1_d;

   $task1_d = addslashes(trim($task1_d));  
   $cons1_d = addslashes(trim($cons1_d));
   $c_over1_d = addslashes(trim($c_over1_d));
   $reason1_d = addslashes(trim($reason1_d));

  if(!$stat1_d) $stat1_d =0;

  if($task1_d)
 $task1_d_ins = pg_query($db_pas,"insert into pa_emp_task (pk_sl,slno,task_desc, status_code, cons, const_over, reason) values($last_sl,$proj_sl,'$task1_d',$stat1_d,'$cons1_d','$c_over1_d','$reason1_d')");
   
   $task2_d = sprintf("task2_d$i");
   $stat2_d = sprintf("stat2_d$i");
   $cons2_d = sprintf("cons2_d$i");
   $c_over2_d = sprintf("c_over2_d$i");
   $reason2_d = sprintf("reason2_d$i");

   $task2_d = $$task2_d;  
   $stat2_d = $$stat2_d;
   $cons2_d = $$cons2_d;
   $c_over2_d = $$c_over2_d;
   $reason2_d = $$reason2_d;

if($task2_d)
 {
   $task2_d = addslashes(trim($task2_d));  
   $cons2_d = addslashes(trim($cons2_d));
   $c_over2_d = addslashes(trim($c_over2_d));
   $reason2_d = addslashes(trim($reason2_d));

   if(!$stat2_d) $stat2_d =0;

  if($task2_d)
  $task2_d_ins = pg_query($db_pas,"insert into pa_emp_task (pk_sl,slno,task_desc, status_code, cons, const_over, reason) values($last_sl,$proj_sl,'$task2_d',$stat2_d,'$cons2_d','$c_over2_d','$reason2_d')");
 }
   
   $task3_d = sprintf("task3_d$i");
   $stat3_d = sprintf("stat3_d$i");
   $cons3_d = sprintf("cons3_d$i");
   $c_over3_d = sprintf("c_over3_d$i");
   $reason3_d = sprintf("reason3_d$i");
   $task3_d = $$task3_d;  
   $stat3_d = $$stat3_d;
   $cons3_d = $$cons3_d;
   $c_over3_d = $$c_over3_d;
   $reason3_d = $$reason3_d;
if($task3_d)
 {
   $task3_d = addslashes(trim($task3_d));  
   $cons3_d = addslashes(trim($cons3_d));
   $c_over3_d = addslashes(trim($c_over3_d));
   $reason3_d = addslashes(trim($reason3_d));

   if(!$stat3_d) $stat3_d =0;

   if($task3_d)
  $task3_d_ins = pg_query($db_pas,"insert into pa_emp_task (pk_sl,slno,task_desc, status_code, cons, const_over, reason) values($last_sl,$proj_sl,'$task3_d',$stat3_d,'$cons3_d','$c_over3_d','$reason3_d')");
 }
   
   $task4_d = sprintf("task4_d$i");
   $stat4_d = sprintf("stat4_d$i");
   $cons4_d = sprintf("cons4_d$i");
   $c_over4_d = sprintf("c_over4_d$i");
   $reason4_d = sprintf("reason4_d$i");   
   $task4_d = $$task4_d;  
   $stat4_d = $$stat4_d;
   $cons4_d = $$cons4_d;
   $c_over4_d = $$c_over4_d;
   $reason4_d = $$reason4_d;
if($task4_d)
 {
   $task4_d = addslashes(trim($task4_d));  
   $cons4_d = addslashes(trim($cons4_d));
   $c_over4_d = addslashes(trim($c_over4_d));
   $reason4_d = addslashes(trim($reason4_d));
   if(!$stat4_d) $stat4_d =0;
   if($task4_d)
  $task4_d_ins = pg_query($db_pas,"insert into pa_emp_task (pk_sl,slno,task_desc, status_code, cons, const_over, reason) values($last_sl,$proj_sl,'$task4_d',$stat4_d,'$cons4_d','$c_over4_d','$reason4_d')");
     }   
   }
   }//end project for

#Training attended data insertion

for($t=0;$t<$t_rows;$t++)
 {
   $tp_att = sprintf("tp_att$t");
   $st_tpd = sprintf("st_tpd$t");
   $st_tpm = sprintf("st_tpm$t");
   $st_tpy = sprintf("st_tpy$t");
   $end_tpd = sprintf("end_tpd$t");
   $end_tpm = sprintf("end_tpm$t");
   $end_tpy = sprintf("end_tpy$t");
   $tp_rem = sprintf("tp_rem$t");
   
   $tp_att = $$tp_att;
   $st_tpd = $$st_tpd;
   $st_tpm = $$st_tpm;
   $st_tpy = $$st_tpy;
   $end_tpd = $$end_tpd;
   $end_tpm = $$end_tpm;
   $end_tpy = $$end_tpy;
   $tp_rem = $$tp_rem;
 
if($st_tpd && $st_tpm && $st_tpy)
      $st_date = $st_tpy.'-'.$st_tpm.'-'.$st_tpd;
 else $st_date = null;
if($end_tpd && $end_tpm && $end_tpy)
    $end_date = $end_tpy.'-'.$end_tpm.'-'.$end_tpd;
else $end_date = null;

   $tp_att = addslashes(trim($tp_att)); 
   $tp_rem = addslashes(trim($tp_rem));
   if($tp_att)
   $tpa_ins = pg_query($db_pas,"insert into pa_tpa (pk_sl,train_prog,f_date,t_date,rem) values($last_sl, '$tp_att', '$st_date', '$end_date','$tp_rem')");
 }//end for

for($s=0;$s<$s_rows;$s++)
 {
   $skill_d = sprintf("skill_d$s");
   $level = sprintf("level$s");

   $skill_d = $$skill_d;
   $level = $$level;

   if(!$level) $level =0;
  $skill_d = addslashes(trim($skill_d));
  if($skill_d)
   $sa_ins = pg_query($db_pas,"insert into pa_sa (pk_sl,skill,level) values($last_sl,'$skill_d',$level)");   

 }//end for	
for($d=0;$d<$d_rows;$d++)
 {
   $domain = sprintf("domain$d");
   $dlevel = sprintf("dlevel$d");

   $domain = $$domain;
   $dlevel = $$dlevel;
   if(!$dlevel) $dlevel =0;
  $domain = addslashes(trim($domain));
  if($domain)
   $dea_ins = pg_query($db_pas,"insert into pa_dea (pk_sl,domain,level) values($last_sl,'$domain',$dlevel)");   

 }//end for

 // Insertion for additional information in the data base
      
  $addinfo = addslashes(trim($addinfo));
   if($addinfo)
   { 
  $info_to_add = pg_query($db_pas,"insert into pa_add_info(pk_sl,info) values($last_sl,'$addinfo')");       
   }


 }	//end if
$pa_lock_upd = pg_query($db_pas,"update pa_lock set emp_proj = true where pk_sl = $last_sl and  year=$year and qtr=$qtr");
$mailserver="integramicro.com";
//$mailserver="tuxedo.integramicro.co.in";

$mailtorh=isReadyMail($ecode);
/*if($mailtorh)
{
$empname=EmpNameFromEmpCode($ecode);
$mailRH = pg_query($db_conn,"select reportsto from emp_master where emp_code= $ecode");
$mailRH_arr=pg_fetch_array($mailRH,0);
$RH_code= $mailRH_arr[reportsto];
$loginRH = pg_query($db_conn,"select login from emp_master where emp_code= $RH_code");
$loginRH_arr=pg_fetch_array($loginRH,0);
$RH_login=trim($loginRH_arr[login]);
$RH_name=EmpNameFromEmpCode($RH_code);
$toaddr= $RH_login."@$mailserver";
$sub= "Intemation of completion of self Appraisal :- $empname";
$mesg= "$empname($em_code) has completed his/her self appraisal form.\n Please intimate $empname the date of appraisal meeting.";
//echo "$toaddr";
//$sub= "Appraisal form  submited by $empname";
//$mesg= "Appraisal form is submited by $empname \n kindly check it out";
$cc="From: $PCC_ID\nReply-To: $tosendr\nCc: $cc";
$ismail=mail($toaddr,$sub,$mesg,$cc);
if(!$ismail)
{
echo "<br><br><br><br><center><b>mail couldnot be send</b></center><br><br>";
}
echo "<BR><center><b>A mail has been sent to your reporting head</b></center>";
echo "<BR><center><b>$RH_name</b></center>";
echo "<BR><center><b>Regarding the completion of your appraisal form</b></center>";

}*/


echo "<br><br><br><center><b>Data Successfully Added</b></center><br>";

if(!$emp_rate)
{
echo "<center><b>Do you want to fill Performance Assessment form now? If Yes,Click Performance Assessment Button else Exit</b></center>";
//include "PA_emp_rate.php";
echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo"<br><center><INPUT type=\"submit\" name=\"perf_ass\" value=\"Performance Assessment\" onClick=\"perfass()\">";
echo"&nbsp;&nbsp;";
echo"<INPUT type=\"submit\" name=\"perf_exit\" value=\"Exit\" ></center>";

echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
exit();
}
else
{
if($mailtorh)
{
$empname=EmpNameFromEmpCode($ecode);
$mailRH = pg_query($db_conn,"select reportsto from emp_master where emp_code= $ecode");
$mailRH_arr=pg_fetch_array($mailRH,0);
$RH_code= $mailRH_arr[reportsto];
$loginRH = pg_query($db_conn,"select login from emp_master where emp_code= $RH_code");
$loginRH_arr=pg_fetch_array($loginRH,0);
$RH_login=trim($loginRH_arr[login]);
$RH_name=EmpNameFromEmpCode($RH_code);
$em_code=EcodeEnteredFromEcode($ecode);

// Added by Ankur kapoor on 3rd feb 2006
$loginEMP = pg_query($db_conn,"select login from emp_master where emp_code = $ecode");
$loginEMP_arr = pg_fetch_array($loginEMP,0);
$EMP_login = trim($loginEMP_arr[login]);

//echo " Login name is $EMP_login"; 
$toaddr= $RH_login."@$mailserver";
$toaddr2 = $EMP_login."@$mailserver";


$sub= "Intimation of completion of self Appraisal :- $empname";
$sub2= "Intimation of completion of your Appraisal";

$mesg= "$empname($em_code) has completed his/her self appraisal form.\nPlease intimate $empname the date of appraisal meeting.";

$mesg2 = "Dear $empname ($em_code),
          You have successfully completed your appraisal form for the current quater.

          A mail has been sent to your reporting head $RH_name regarding the completion
          of your appraisal form.";

//echo "$toaddr";
//$sub= "Appraisal form  submited by $empname";
//$mesg= "Appraisal form is submited by $empname \n kindly check it out";
$cc="From: $PCC_ID\nReply-To: $tosendr\nCc: $cc";
$ismail=mail($toaddr,$sub,$mesg,$cc);
$ismail2=mail($toaddr2,$sub2,$mesg2,$cc);

if(!$ismail)
{
echo "<br><br><br><br><center><b>mail couldnot be send</b></center><br><br>";
}
else
{
echo "<BR><center><b>A mail has been sent to your reporting head $RH_name</b></center>";
//echo "<BR><center><b>$RH_name</b></center>";
echo "<center><b>Regarding the completion of your appraisal form<BR><BR></b></center>";
}

}

echo"<center><INPUT type=\"submit\" name=\"exit\" value=\"Ok\" onClick =\"frm_exit()\"></center>";
echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
exit();
}
}
else
 {
echo "<br><br><br><center><b>Data could not be added</b></center>";
exit();
 }
}//end if

$ecode = EmpCodeFromAuthKey($keychk);

$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$year =$key_arr[year];  $qtr =$key_arr[qtr];
$pa_lock_q =pg_query($db_pas,"select emp_proj from pa_lock where emp_code = $ecode and qtr=$qtr and year = $year");
$pa_lock_f = pg_fetch_array($pa_lock_q,0);
$pa_lock_val = trim($pa_lock_f[emp_proj]);
if($pa_lock_val=='t')
 {
	 echo "<br><br><br><center><b>You have already filled Project and training information</b></center>";
	 exit();
 

}
$ecode_gen = EcodeEnteredFromEcode($ecode);
$emp_name = EmpNameFromEmpCode($ecode);
$emp_dq = pg_query($db_conn,"select join_date,func,designation from emp_master where emp_code = $ecode");
$emp_fetch = pg_fetch_array($emp_dq,0);
$join_d = $emp_fetch[join_date];
$join_dar = explode('-',$join_d);
$join_dd = $join_dar[2] . '-'. $join_dar[1]. '-' . $join_dar[0];
$func_d = $emp_fetch[func];
$func_ename = FuncNameFromFuncCode($func_d);
$desg_d = trim($emp_fetch[designation]);
$desg_q = pg_query($db_conn,"select desg_desc from designation where desg_code = '$desg_d'");
$desg_fetch = pg_fetch_array($desg_q,0);
$desg_get = trim($desg_fetch[desg_desc]);
$report_code = ReportingHead($ecode);
$report_h = EmpNameFromEmpCode($report_code);

//Modified By Akila to Call new Function to Extract Review Manager on 4-April-2007
$rev_code=GetReviewManager($ecode);

$rev_man = EmpNameFromEmpCode($rev_code);
$dob_q = pg_query($db_conn,"select birthdate from dob where eno = $ecode");

//$dob_q = pg_query($db_conn,"select birthdate from dob where eno = $ecode_gen");
$dob_fetch = pg_fetch_array($dob_q,0);
$dob_fetch = $dob_fetch[birthdate];
$dob_ff = explode('-',$dob_fetch);
$dob= $dob_ff[2].'-'.$dob_ff[1].'-'.$dob_ff[0];

$sal_due_q = pg_query($db_pas,"select sr_due from salary_due where eno = $ecode");
//$sal_due_q = pg_query($db_pas,"select sr_due from salary_due where eno = $ecode_gen");
$sal_fetch = pg_fetch_array($sal_due_q,0);
$sal_due_f = trim($sal_fetch[sr_due]);
$sal_due_fr = explode('-',$sal_due_f);
$sal_due = $sal_due_fr[2].'-'.$sal_due_fr[1].'-'.$sal_due_fr[0];

$res_func = pg_exec ($db_conn, "SELECT func_name FROM func_master,emp_master WHERE  emp_master.emp_code=$ecode AND emp_master.func=func_master.func_id");
$res_func_fetch = pg_fetch_array($res_func,0);
$res_func_name = $res_func_fetch[func_name];
$res_lock = pg_query($db_pas, "SELECT * FROM location order by location");
$num_rows = pg_num_rows($res_lock);
$res_year = pg_query($db_pas, "SELECT year FROM pa_init");
$res_fetch = pg_fetch_array($res_year);
$cur_year = $res_fetch[year];

echo"<input type = \"hidden\" name = \"ecode_gen\" value = \"$ecode_gen\" >";
echo"<input type = \"hidden\" name = \"rev_code\" value = \"$rev_code\" >";
echo"<input type = \"hidden\" name = \"desg_get\" value = \"$desg_get\" >";
echo"<input type = \"hidden\" name = \"sal_due_f\" value = \"$sal_due_f\" >";
echo"<input type = \"hidden\" name = \"res_func_name\" value = \"$res_func_name\">";
echo"<input type = \"hidden\" name = \"func_ename\" value = \"$func_ename\">";
echo"<input type = \"hidden\" name = \"emp_name\" value = \"$emp_name\">";


echo "
<br><span style='font-weight:bold'>Appraisal Period:</span>
<table style=\"width: 98%; class='' text-align: left;\" border=\"0\"><tr bgcolor='#E5E7E9'><td>Year:&nbsp;&nbsp;$cur_year</td><td>Period:&nbsp;&nbsp;";
period();

echo"</td></tr></table>
<br>Employee Information";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    <tr bgcolor='#E5E7E9'>
      <td>Employee Number</td> <td>$ecode_gen</td>
      <td> Name </td> <td >$emp_name</td>
    </tr>
    <tr>
     <td>Date of Birth (dd-mm-yyyy) </td>
     <td>$dob</td>";
     /* <td> <INPUT TYPE=\"text\" NAME=\"dob_dd\"  VALUE=\"$dob_dd\"  SIZE=\"2\" MAXLENGTH=\"2\">-
     <INPUT TYPE=\"text\" NAME=\"dob_mm\" VALUE=\"$dob_mm\" SIZE=\"2\" MAXLENGTH=\"2\">-
      <INPUT TYPE=\"text\" NAME=\"dob_yy\" VALUE=\"$dob_yy\" SIZE=\"3\" MAXLENGTH=\"4\">*/
      echo"</td>
      <td>Date of Joining Integra (dd-mm-yyyy)</td><td>$join_dd</td></tr>
      <tr><td>Department/Division</td>";
      echo"<td>
      $res_func_name     
      </td>";
      
     echo"<td>Designation</td><td>$desg_get</td></tr>
      <tr><td>Current Work Location</td>";
     $j=0;
      $emp_loc = sprintf("emp_loc$j");
       $emp_loc = $$emp_loc;
       //$emp_loc = stripslashes($emp_loc);
      //echo"<td><INPUT TYPE=\"text\" NAME=\"emp_loc\" VALUE=$emp_loc ></td>";
      echo"<td><select name=\"emp_loc$j\">";
       echo"<option></option>";
       for($lc=0;$lc<$num_rows;$lc++){
       $res_lock_fetch = pg_fetch_array($res_lock,$lc);
       $res_lock_name = trim($res_lock_fetch[location]);
       $res_id = $res_lock_fetch[id];
       if(($res_lock_name==$emp_loc) && !$emp_loc)
       {
       echo"<option value = \"$res_lock_name\" selected>$res_lock_name</option>";
       }
       else
       if($res_lock_name==$emp_loc)
       echo"<option value = \"$res_lock_name\" selected>$res_lock_name</option>";
       else
       echo"<option value = \"$res_lock_name\">$res_lock_name</option>";
         }
	 echo"</select></td>";  
       echo"<td>Group</td><td>$func_ename</td></tr>
      <tr> <td>Date of Joining Project/Client Location  (dd-mm-yyyy)</td>";
      echo"<td><INPUT TYPE=\"text\" NAME=\"group_dd\" VALUE=\"$group_dd\" SIZE=\"1\" MAXLENGTH=\"2\">-
      <INPUT TYPE=\"text\" NAME=\"group_mm\" VALUE=\"$group_mm\" SIZE=\"1\" MAXLENGTH=\"2\">-
      <INPUT TYPE=\"text\" NAME=\"group_yy\" VALUE=\"$group_yy\" SIZE=\"3\" MAXLENGTH=\"4\">
      </td>
      <td>Appraising Manager</td><td>$report_h</td>
      </tr>
      <tr><td>Reviewing Manager</td><td>$rev_man</td>
      <td>Salary Revision Due on (dd-mm-yyyy)</td>
      <td>$sal_due </td>";
     /*<INPUT TYPE=\"text\" NAME=\"group_dd\" VALUE=\"$sr_dd\" SIZE=\"2\" MAXLENGTH=\"2\">-
      <INPUT TYPE=\"text\" NAME=\"group_mm\" VALUE=\"$sr_mm\" SIZE=\"2\" MAXLENGTH=\"2\">-
      <INPUT TYPE=\"text\" NAME=\"group_yy\" VALUE=\"$sr_yy\" SIZE=\"3\" MAXLENGTH=\"4\">*/
          echo"</tr>
     </tbody></table>";
##############Project Part###########################
  echo "  <br>Projects/Assignments carried out during the Review Period";

    
if($p_rows==0)
{
   echo "<input type=\"hidden\" name=\"p_rows\" value=\"1\">";
   $jp=1;
}
else
{
   $aj=$p_rows-1;
   $proj_txt = sprintf("proj_txt$aj");
   $diff_proj = sprintf("diff_proj$aj");
   $proj_task = sprintf("proj_task$aj");
   $mgr_comm = sprintf("mgr_comm$aj");
   
   $task1_d = sprintf("task1_d$aj");
   $stat1_d = sprintf("stat1_d$aj");
   $cons1_d = sprintf("cons1_d$aj");
   $c_over1_d = sprintf("c_over1_d$aj");
   $reason1_d = sprintf("reason1_d$aj");
   
   $task2_d = sprintf("task2_d$aj");
   $stat2_d = sprintf("stat2_d$aj");
   $cons2_d = sprintf("cons2_d$aj");
   $c_over2_d = sprintf("c_over2_d$aj");
   $reason2_d = sprintf("reason2_d$aj");
   
   $task3_d = sprintf("task3_d$aj");
   $stat3_d = sprintf("stat3_d$aj");
   $cons3_d = sprintf("cons3_d$aj");
   $c_over3_d = sprintf("c_over3_d$aj");
   $reason3_d = sprintf("reason3_d$aj");
   
   $task4_d = sprintf("task4_d$aj");
   $stat4_d = sprintf("stat4_d$aj");
   $cons4_d = sprintf("cons4_d$aj");
   $c_over4_d = sprintf("c_over4_d$aj");
   $reason4_d = sprintf("reason4_d$aj");   
   
   $proj_txt  = $$proj_txt; 
   $proj_txt  = stripslashes($proj_txt);
   $diff_proj  = $$diff_proj; 
   $diff_proj  = stripslashes($diff_proj);
   $proj_task = $$proj_task;
   $mgr_comm  = $$mgr_comm;
   $mgr_comm  = stripslashes($mgr_comm);
   
   $task1_d = $$task1_d;  
   $task1_d =stripslashes($task1_d);  
   $stat1_d = $$stat1_d;
   $cons1_d = $$cons1_d;
   $cons1_d = stripslashes($cons1_d);
   $c_over1_d = $$c_over1_d;
   $c_over1_d = stripslashes($c_over1_d);
   $reason1_d = $$reason1_d;
   $reason1_d = stripslashes($reason1_d);
   
   $task2_d = $$task2_d;  
   $task2_d = stripslashes($task2_d);  
   $stat2_d = $$stat2_d;
   $cons2_d = $$cons2_d;
   $cons2_d = stripslashes($cons2_d);
   $c_over2_d = $$c_over2_d;
   $c_over2_d =stripslashes($c_over2_d);
   $reason2_d = $$reason2_d;
   $reason2_d = stripslashes($reason2_d);
   
   $task3_d = $$task3_d;  
   $task3_d =stripslashes($task3_d);  
   $stat3_d = $$stat3_d;
   $cons3_d = $$cons3_d;
   $cons3_d = stripslashes($cons3_d);
   $c_over3_d = $$c_over3_d;
   $c_over3_d = stripslashes($c_over3_d);
   $reason3_d = $$reason3_d;
   $reason3_d =stripslashes($reason3_d);
    
   $task4_d = $$task4_d;  
   $task4_d = stripslashes($task4_d);  
   $stat4_d = $$stat4_d;
   $cons4_d = $$cons4_d;
   $cons4_d = stripslashes($cons4_d);
   $c_over4_d = $$c_over4_d;
   $c_over4_d = stripslashes($c_over4_d);
   $reason4_d = $$reason4_d;
     $reason4_d = stripslashes($reason4_d);

   
   if($next_proj && $proj_txt !="" && $proj_task !="" && $task1_d !="" && $stat1_d !="")
   {
     printf("<input type=\"hidden\" name=\"p_rows\" value=\"%d\">",$p_rows+1);	
     $jp = $p_rows+1;
   }
   else
   {
       printf("<input type=\"hidden\" name=\"p_rows\" value=\"%d\">",$p_rows); 
      $jp = $p_rows;
   }
}

for($p=0;$p<$jp;$p++)
{
   $proj_txt = sprintf("proj_txt$p");
   $diff_proj = sprintf("diff_proj$p");
   $proj_task = sprintf("proj_task$p");
   $mgr_comm = sprintf("mgr_comm$p");

   $task1_d = sprintf("task1_d$p");
   $stat1_d = sprintf("stat1_d$p");
   $cons1_d = sprintf("cons1_d$p");
   $c_over1_d = sprintf("c_over1_d$p");
   $reason1_d = sprintf("reason1_d$p");
   
   $task2_d = sprintf("task2_d$p");
   $stat2_d = sprintf("stat2_d$p");
   $cons2_d = sprintf("cons2_d$p");
   $c_over2_d = sprintf("c_over2_d$p");
   $reason2_d = sprintf("reason2_d$p");
   
   $task3_d = sprintf("task3_d$p");
   $stat3_d = sprintf("stat3_d$p");
   $cons3_d = sprintf("cons3_d$p");
   $c_over3_d = sprintf("c_over3_d$p");
   $reason3_d = sprintf("reason3_d$p");
   
   $task4_d = sprintf("task4_d$p");
   $stat4_d = sprintf("stat4_d$p");
   $cons4_d = sprintf("cons4_d$p");
   $c_over4_d = sprintf("c_over4_d$p");
   $reason4_d = sprintf("reason4_d$p");   
   $proj_txt  = $$proj_txt; 
   $proj_txt  = stripslashes($proj_txt); 
   $proj_task = $$proj_task;
   $proj_task = stripslashes($proj_task);
   $diff_proj = $$diff_proj;
   $diff_proj = stripslashes($diff_proj);
   $mgr_comm  = $$mgr_comm;
   $mgr_comm  = stripslashes($mgr_comm);
   
   $task1_d = $$task1_d;  
   $task1_d =stripslashes($task1_d);  
   $stat1_d = $$stat1_d;
   $cons1_d = $$cons1_d;
   $cons1_d = stripslashes($cons1_d);
   $c_over1_d = $$c_over1_d;
   $c_over1_d = stripslashes($c_over1_d);
   $reason1_d = $$reason1_d;
   $reason1_d = stripslashes($reason1_d);
   
   $task2_d = $$task2_d;  
   $task2_d = stripslashes($task2_d);  
   $stat2_d = $$stat2_d;
   $cons2_d = $$cons2_d;
   $cons2_d = stripslashes($cons2_d);
   $c_over2_d = $$c_over2_d;
   $c_over2_d = stripslashes($c_over2_d);
   $reason2_d = $$reason2_d;
   $reason2_d = stripslashes($reason2_d);
   
   $task3_d = $$task3_d;  
   $task3_d = stripslashes($task3_d);  
   $stat3_d = $$stat3_d;
   $cons3_d = $$cons3_d;
   $cons3_d = stripslashes($cons3_d);
   $c_over3_d = $$c_over3_d;
   $c_over3_d = stripslashes($c_over3_d);
   $reason3_d = $$reason3_d;
   $reason3_d = stripslashes($reason3_d);
    
   $task4_d = $$task4_d;  
   $task4_d = stripslashes($task4_d);  
   $stat4_d = $$stat4_d;
   $cons4_d = $$cons4_d;
   $cons4_d = stripslashes($cons4_d);
   $c_over4_d = $$c_over4_d;
   $c_over4_d = stripslashes($c_over4_d);
   $reason4_d = $$reason4_d;
   $reason4_d = stripslashes($reason4_d);
      
  if($next_proj)
    echo "<a name=\"book\">";

    

echo "<table style=\"width: 69%; text-align: left;\" border=\"1\"><tbody><tr>
<td colspan=\"2\">Project/Assignment</td>";
echo"<td width=\"10%\" >";
 $db_conn = db_open("offproj",0); 
 //$db_conn = db_open(); 
$result = pg_query($db_conn, "SELECT * FROM proj_master WHERE aped IS NULL OR proj_code IN (SELECT DISTINCT (proj_code) FROM proj_invoice_details  WHERE invoice_amt > 0 AND closed='f') ORDER BY proj_name");
       $rows = pg_num_rows($result);
       echo"<select name=\"proj_txt$p\">";
       echo"<option>None</option>";
       for($num=0;$num<$rows;$num++){
       $proj_qar = pg_fetch_array($result,$num);
       $proj_name = trim($proj_qar[proj_name]);
       $proj_code = $proj_qar[proj_code];
        if(($proj_txt == $proj_name) && !$proj_txt)
         echo"<option value = \"$proj_name\" selected>$proj_name</option>";
        else
         if($proj_txt == $proj_name)
         echo"<option value = \"$proj_name\" selected>$proj_name</option>";
         else         
          echo"<option value = \"$proj_name\">$proj_name</option>";
        }
	echo"</td>
        <td  width=\"12%\" align=\"left\"><input  name=\"diff_proj$p\"  type=\"text\" value =\"$diff_proj\" size=\"52\" ></td>
        </tr>";
       echo"<tr>
       <td colspan=\"2\">Task Assigned in Project</td>
       <td  colspan=\"5\"><textarea cols= \"80\" rows = \"3\" name =\"proj_task$p\">$proj_task</textarea></td>
       </tr>
   </table>
	

 <table width=\"91%\" border=\"1\">

    <tr bgcolor='#E5E7E9'>
      <td>Sl No</td>
      <td>Task Description</td>
      <td width=\"10%\">Status</td>
      <td>Constraints Faced</td>
      <td>Whether Constraints were overcome</td>
      <td>Reason if not accomplished</td>
      </tr>";


    echo "<tr>
      <td>1</td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"task1_d$p\">$task1_d</textarea></td>
      <td>";
#      ShowStatusList("stat1_d$p");
	   $task_q = pg_query($db_pas,"select status_code,status_desc from i_task_def");
       $num_rows = pg_num_rows($task_q);
       echo"<select name=\"stat1_d$p\" >";
       //echo"<option>N/A</option>";
       for($num=0;$num<$num_rows;$num++){
       $task_qar = pg_fetch_array($task_q,$num);
       $task_desc = trim($task_qar[status_desc]);
       $task_code = $task_qar[status_code];
        if(($stat1_d == $task_code) && !$stat1_d)
         echo"<option value = \"$task_code\" selected>$task_desc</option>";
        else
         if($stat1_d == $task_code)
         echo"<option value = \"$task_code\" selected>$task_desc</option>";
         else         
          echo"<option value = \"$task_code\">$task_desc</option>";
        }
echo"</select>";
      
 echo"</td>
      <td><textarea rows = \"3\" cols = \"18\" name = \"cons1_d$p\">$cons1_d</textarea></td>
      <td><textarea rows = \"3\" cols = \"18\" name = \"c_over1_d$p\">$c_over1_d</textarea></td>
      <td><textarea rows = \"3\" cols = \"18\" name = \"reason1_d$p\">$reason1_d</textarea></td>";
      
    echo "</tr>";

        echo "<tr>
      <td>2</td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"task2_d$p\">$task2_d</textarea></td>
      <td>";
#      ShowStatusList("stat2_d$p");
       echo"<select name=\"stat2_d$p\">";
       //echo"<option>N/A</option>";
       for($num=0;$num<$num_rows;$num++){
       $task_qar = pg_fetch_array($task_q,$num);
       $task_desc = trim($task_qar[status_desc]);
       $task_code = $task_qar[status_code];
        if(($stat2_d == $task_code) && !$stat2_d)
         echo"<option value = \"$task_code\" selected>$task_desc</option>";
        else
         if($stat2_d == $task_code)
         echo"<option value = \"$task_code\" selected>$task_desc</option>";
         else         
          echo"<option value = \"$task_code\">$task_desc</option>";
        }
echo"</select>";
 echo" </td>
      <td><textarea rows = \"3\" cols = \"18\" name = \"cons2_d$p\">$cons2_d</textarea></td>
      <td><textarea rows = \"3\" cols = \"18\" name = \"c_over2_d$p\">$c_over2_d</textarea></td>
      <td><textarea rows = \"3\" cols = \"18\" name = \"reason2_d$p\">$reason2_d</textarea></td>";
      
    echo "</tr>";
    echo "<tr>
      <td>3</td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"task3_d$p\">$task3_d</textarea></td>
      <td>";
#      ShowStatusList("stat3_d$p");
       echo"<select name=\"stat3_d$p\">";
       //echo"<option>N/A</option>";
       for($num=0;$num<$num_rows;$num++){
       $task_qar = pg_fetch_array($task_q,$num);
       $task_desc = trim($task_qar[status_desc]);
       $task_code = $task_qar[status_code];
        if(($stat3_d == $task_code) && !$stat3_d)
         echo"<option value = \"$task_code\" selected>$task_desc</option>";
        else
         if($stat3_d == $task_code)
         echo"<option value = \"$task_code\" selected>$task_desc</option>";
         else         
          echo"<option value = \"$task_code\">$task_desc</option>";
        }
echo"</select>";
 echo" </td>
      <td><textarea rows = \"3\" cols = \"18\" name = \"cons3_d$p\">$cons3_d</textarea></td>
      <td><textarea rows = \"3\" cols = \"18\" name = \"c_over3_d$p\">$c_over3_d</textarea></td>
      <td><textarea rows = \"3\" cols = \"18\" name = \"reason3_d$p\">$reason3_d</textarea></td>";
      
    echo "</tr>";
    echo "<tr>
      <td>4</td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"task4_d$p\">$task4_d</textarea></td>
      <td>";
#      ShowStatusList("stat4_d$p");
       echo"<select name=\"stat4_d$p\">";
       //echo"<option>N/A</option>";
       for($num=0;$num<$num_rows;$num++){
       $task_qar = pg_fetch_array($task_q,$num);
       $task_desc = trim($task_qar[status_desc]);
       $task_code = $task_qar[status_code];
        if(($stat4_d == $task_code) && !$stat4_d)
         echo"<option value = \"$task_code\" selected>$task_desc</option>";
        else
         if($stat4_d == $task_code)
         echo"<option value = \"$task_code\" selected>$task_desc</option>";
         else         
          echo"<option value = \"$task_code\">$task_desc</option>";
        }
echo"</select>";
 echo" </td>
      <td><textarea rows = \"3\" cols = \"18\" name = \"cons4_d$p\">$cons4_d</textarea></td>
    <td><textarea rows = \"3\" cols = \"18\" name = \"c_over4_d$p\">$c_over4_d</textarea></td>
   <td><textarea rows = \"3\" cols = \"18\" name = \"reason4_d$p\">$reason4_d</textarea></td>";
      
    echo "</tr>
    </table>";
/*  echo "<tr>
      <td colspan=\"2\">Manager's Comments</td>
      <td colspan=\"5\"><textarea rows = \"3\" cols = \"80\" name =\"mgr_comm$p\">$mgr_comm</textarea></td>
    </tr>";*/

  echo "</tbody></table>";
}  //end for

   echo "<INPUT type=\"submit\" name=\"next_proj\" value=\"Next Project\">";

##################################Training attended

echo "
<br><br>Training Programmes attended during the Review Period
<table style=\"width: 98%; text-align: left;\" border=\"1\">
  <tbody>
    <tr bgcolor='#E5E7E9'><td>Sl No</td><td>Training Programme</td><td>From Date (dd-mm-yyyy)</td><td>To Date (dd-mm-yyyy)</td><td>Remarks</td><td>&nbsp;&nbsp;</td>
    </tr>";
    
if($t_rows==0)
{
   echo "<input type=\"hidden\" name=\"t_rows\" value=\"1\">";
   $tp=1;
}
else
{
   $t=$t_rows-1;
   $tp_att = sprintf("tp_att$t");
   $st_tpd = sprintf("st_tpd$t");
   $st_tpm = sprintf("st_tpm$t");
   $st_tpy = sprintf("st_tpy$t");
   $end_tpd = sprintf("end_tpd$t");
   $end_tpm = sprintf("end_tpm$t");
   $end_tpy = sprintf("end_tpy$t");
   $tp_rem = sprintf("tp_rem$t");
   $next_t_rec = sprintf("next_t_rec$t");
   
   $tp_att = $$tp_att;
   $tp_att = stripslashes($tp_att);
   $st_tpd = $$st_tpd;
   $st_tpm = $$st_tpm;
   $st_tpy = $$st_tpy;
   $end_tpd = $$end_tpd;
   $end_tpm = $$end_tpm;
   $end_tpy = $$end_tpy;
   $tp_rem = $$tp_rem;
   $tp_rem = stripslashes($tp_rem);
   $next_t_rec = $$next_t_rec;
   
  
   if($next_t_rec && $tp_att !="")
   {
     printf("<input type=\"hidden\" name=\"t_rows\" value=\"%d\">",$t_rows+1);	
     $tp = $t_rows+1;
   }
   else
   {
       printf("<input type=\"hidden\" name=\"t_rows\" value=\"%d\">",$t_rows); 
      $tp = $t_rows;
   }
}

for($f=0;$f<$tp;$f++)
{
   $tp_att = sprintf("tp_att$f");
   $st_tpd = sprintf("st_tpd$f");
   $st_tpm = sprintf("st_tpm$f");
   $st_tpy = sprintf("st_tpy$f");
   $end_tpd = sprintf("end_tpd$f");
   $end_tpm = sprintf("end_tpm$f");
   $end_tpy = sprintf("end_tpy$f");
   $tp_rem = sprintf("tp_rem$f");
   $next_t_rec = sprintf("next_t_rec$f");
   
   $tp_att = $$tp_att;
   $tp_att = stripslashes($tp_att);
   $st_tpd = $$st_tpd;
   $st_tpm = $$st_tpm;
   $st_tpy = $$st_tpy;
   $end_tpd = $$end_tpd;
   $end_tpm = $$end_tpm;
   $end_tpy = $$end_tpy;
   $tp_rem = $$tp_rem;
   $tp_rem = stripslashes($tp_rem);
   $next_t_rec = $$next_t_rec;
   
   $slno = $f+1; 
   
   $t_rw = $t_rows-1;
   $next_t_r = sprintf("next_t_rec$t_rw");
   $next_t_r = $$next_t_r;
   if($next_t_r)
    echo "<a name=\"book\">";

   
    echo "<tr>
      <td>$slno</td>
      <td><textarea rows = \"3\" cols = \"20\" name=\"tp_att$f\">$tp_att</textarea></td>
      <td>";
#       dateSelect("st_tpd$f","st_tpm$f","st_tpy$f",1);
   echo "<INPUT TYPE=\"text\" NAME=\"st_tpd$f\" VALUE=\"$st_tpd\" SIZE=\"1\" MAXLENGTH=\"2\">-
      <INPUT TYPE=\"text\" NAME=\"st_tpm$f\" VALUE=\"$st_tpm\" SIZE=\"1\" MAXLENGTH=\"2\">-
      <INPUT TYPE=\"text\" NAME=\"st_tpy$f\" VALUE=\"$st_tpy\" SIZE=\"3\" MAXLENGTH=\"4\">";
       echo "</td>
      <td>";
#       dateSelect("end_tpd$f","end_tpm$f","end_tpy$f",1);
   echo "<INPUT TYPE=\"text\" NAME=\"end_tpd$f\" VALUE=\"$end_tpd\" SIZE=\"1\" MAXLENGTH=\"2\">-
      <INPUT TYPE=\"text\" NAME=\"end_tpm$f\" VALUE=\"$end_tpm\" SIZE=\"1\" MAXLENGTH=\"2\">-
      <INPUT TYPE=\"text\" NAME=\"end_tpy$f\" VALUE=\"$end_tpy\" SIZE=\"3\" MAXLENGTH=\"4\">";
      echo "</td>
      <td><textarea rows = \"3\" cols = \"20\" name=\"tp_rem$f\">$tp_rem</textarea>
      </td>";
      if($f == ($tp-1))
      echo "<td><INPUT type=\"submit\" name=\"next_t_rec$f\" value=\"Next Record\"></td>";
      else
      echo "<td>&nbsp;</td>";
    echo "</tr>";
}
echo "</tbody></table>";
###############################################
echo "<br><br>Skills Acquired";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\">
  <tbody>
  <tr bgcolor='#E5E7E9'><td>Sl No</td><td>Skill (Platform, Tool, Language etc)</td><td>Level (1=&gt; Low 5=&gt; high)</td><td>&nbsp;</td></tr>";

  
if($s_rows==0)
{
   echo "<input type=\"hidden\" name=\"s_rows\" value=\"1\">";
   $sp=1;
}
else
{
   $e=$s_rows-1;
   $skill_d = sprintf("skill_d$e");
   $level = sprintf("level$e");
   $next_s_rec = sprintf("next_s_rec$e");

   $skill_d = $$skill_d;
   $skill_d = stripslashes($skill_d);
   $level = $$level;
   $next_s_rec = $$next_s_rec;      
  
   if($next_s_rec && $skill_d !="")
   {
     printf("<input type=\"hidden\" name=\"s_rows\" value=\"%d\">",$s_rows+1);	
     $sp = $s_rows+1;
   }
   else
   {
       printf("<input type=\"hidden\" name=\"s_rows\" value=\"%d\">",$s_rows); 
      $sp = $s_rows;
   }
}

for($s=0;$s<$sp;$s++)
{
   $skill_d = sprintf("skill_d$s");
   $level = sprintf("level$s");
   $next_s_rec = sprintf("next_s_rec$s");

   $skill_d = $$skill_d;
   $skill_d = stripslashes($skill_d);
   $level = $$level;
   $next_s_rec = $$next_s_rec;      
   
   $slno = $s+1; 
 
   
   $s_rw = $s_rows-1;
   $next_s_r = sprintf("next_s_rec$s_rw");
   $next_s_r = $$next_s_r;
   if($next_s_r)
    echo "<a name=\"book\">";

   
    
  echo "<tr>
      <td>$slno</td>
      <td><textarea rows = \"3\" cols = \"50\" name =\"skill_d$s\">$skill_d</textarea></td>
      <td>";
 echo "<select name=\"level$s\">";
echo "<option></option>";
for($cntr=1;$cntr<=5;$cntr++) {
if(($cntr==$level) && !$level)
    	echo "<option selected>$cntr</option>";
else
   if($cntr==$level)
    	echo "<option selected>$cntr</option>";
   else 	
    	echo "<option>$cntr</option>";
}
echo "</select>";
 echo "</td>";
 if($s==($sp-1))
   echo "<td><INPUT type=\"submit\" name=\"next_s_rec$s\" value=\"Next Record\"></td>";
 else
 echo "<td>&nbsp;</td>";  
 echo "</tr>";
}   
echo "</tbody></table>";
###################################
echo "<br>Domain Expertise Acquired";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    <tr bgcolor='#E5E7E9'><td>Sl No</td><td>Domain Expertise Area (Technology, Business, Industry etc)</td><td>Level (1=&gt; Low 5=&gt; high)</td>
      <td>&nbsp;</td></tr>";
      
if($d_rows==0)
{
   echo "<input type=\"hidden\" name=\"d_rows\" value=\"1\">";
   $dp=1;
}
else
{
   $g=$d_rows-1;
   $domain = sprintf("domain$g");
   $dlevel = sprintf("dlevel$g");
   $next_d_rec = sprintf("next_d_rec$g");

   $domain = $$domain;
   $domain = stripslashes($domain);
   $dlevel = $$dlevel;
   $next_d_rec = $$next_d_rec;      
  
   if($next_d_rec && $domain !="")
   {
     printf("<input type=\"hidden\" name=\"d_rows\" value=\"%d\">",$d_rows+1);	
     $dp = $d_rows+1;
   }
   else
   {
       printf("<input type=\"hidden\" name=\"d_rows\" value=\"%d\">",$d_rows); 
      $dp = $d_rows;
   }
}

for($d=0;$d<$dp;$d++)
{
   $domain = sprintf("domain$d");
   $dlevel = sprintf("dlevel$d");
   $next_d_rec = sprintf("next_d_rec$d");

   $domain = $$domain;
   $domain = stripslashes($domain);
   $dlevel = $$dlevel;
   $next_d_rec = $$next_d_rec;      
   
   $slno = $d+1; 

   
   $d_rw = $d_rows-1;
   $next_d_r = sprintf("next_d_rec$d_rw");
   $next_d_r = $$next_d_r;
   if($next_d_r)
    echo "<a name=\"book\">";
              
    echo "<tr>
      <td>$slno</td>
      <td><textarea rows = \"3\" cols = \"50\" name = \"domain$d\">$domain</textarea></td>
      <td>";
 echo "<select name=\"dlevel$d\">";
echo "<option></option>";
for($cntr=1;$cntr<=5;$cntr++) {
if(($cntr==$dlevel) && !$dlevel)
    	echo "<option selected>$cntr</option>";
else
   if($cntr==$dlevel)
    	echo "<option selected>$cntr</option>";
   else 	
    	echo "<option>$cntr</option>";
}
echo "</select>";
 echo "</td>";
  if($d==($dp-1))
   echo "<td><INPUT type=\"submit\" name=\"next_d_rec$d\" value=\"Next Record\"></td>";
 else
 echo "<td>&nbsp;</td>";  
echo "</tr>";
}    

echo "</tbody></table><BR>";
############################################
echo "<br>Additional Information (Max Character count : 2000)";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    <tr>
     <td><center><textarea name = \"addinfo\"  rows = \"8\" cols = \"100\" onkeyup = \"count_Char(this,'test1',2000)\" >$addinfo</textarea></center> </td>
     </tr>";
  echo "</tbody></table><BR>";
echo"<b>Characters Left :</b>";
echo"<input type =\"text\" name = \"test1\" id = \"test1\" disabled size= \"4\" >";
###################################
echo "<center><INPUT type=\"submit\" name=\"sub_scr\" value=\"Submit\"  >";
echo "&nbsp;&nbsp;<INPUT type=\"submit\" name=\"cancel\" value=\"Cancel\" onClick = \"test()\"  >";
echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo "</form>";
echo "</body></html>";
?>
