
<html>
<?
error_reporting(0);
session_start();
 $u = $_SESSION['userName'];
 $t = $_SESSION['token'];
 include_once('head.php');
//include_once "tsutils.php";
include_once "pasutils.php";
?>



<?php
error_reporting(E_ERROR);
$db_pas = db_open("pas_db",0);
echo"<body bgcolor = \"#CDE1EB\">"; ?>
<form action = 'PA_main_menu.php?userName=<?php echo $u; ?>&securityToken=<?php echo $t; ?>' method='POST'>
<?php
$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$year =$key_arr[year];                                                                         $qtr =$key_arr[qtr];
$getpk_sl = pg_query($db_pas,"select pk_sl from pa_lock where emp_code = $ecode and year=$year and qtr = $qtr");
$pk_sl_fetch = pg_fetch_array($getpk_sl,0);
$pk_sln = $pk_sl_fetch[pk_sl];
$proj_q = pg_query($db_pas,"select distinct slno from pa_emp_proj where pk_sl = $pk_sln");
$proj_rows = pg_num_rows($proj_q);
for($i=0;$i<$proj_rows;$i++)
   {
   $proj_r_fetch = pg_fetch_array($proj_q,$i);   
   $sl_get = $proj_r_fetch[slno];
   $var_name = 'mgr_comm'.$sl_get;
   $mgr_com = $_POST[$var_name];
   $mgr_com = addslashes($mgr_com);
   $emp_proj_upd = pg_query($db_pas,"update pa_emp_proj set mgr_comm = '$mgr_com' where pk_sl = $pk_sln and slno = $sl_get");
   }
 $appr_to = $ecode; 
	  
   echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
   echo "<input type=\"hidden\" name=\"pk_sln\" value=\"$pk_sln\">";
   echo "<input type=\"hidden\" name=\"appr_to\" value=\"$appr_to\">";
$db_conn = db_open("pas_db");
$result_key = pg_query($db_conn,"select pk_sl from pa_lock where emp_code = $ecode and year =$year and qtr = $qtr");
$res_arr = pg_fetch_array($result_key,0);
$pk_sl =$res_arr[pk_sl];
$pdn_upd = pg_query($db_conn,"select slno from pa_tdn where pk_sl = $pk_sl");
$no_pnp = pg_fetch_array($pdn_upd,0);
$no_pnp_t = $no_pnp[slno];
if($no_pnp_t)     
{
for($k=0;$k<4;$k++)
{
	$area_d= sprintf("area_d$k");
	$area_d =$$area_d;
	$trn_comments= sprintf("trn_comments$k");
	$trn_comments =$$trn_comments;
	$trnmn_comments= sprintf("trnmn_comments$k");
	$trnmn_comments =$$trnmn_comments;
	$area_d =addslashes($area_d);
	$trn_comments =addslashes($trn_comments);
	$trnmn_comments = addslashes($trnmn_comments);
	$slno = $k+1;
$result_tdn=pg_exec($db_conn,"update pa_tdn set area ='$area_d',emp_com = '$trn_comments',mgr_com ='$trnmn_comments' where slno=$slno and pk_sl = $pk_sl");
}
}
else
{
for($k=0;$k<4;$k++)
{
	$area_d= sprintf("area_d$k");
	$area_d =$$area_d;
	$trn_comments= sprintf("trn_comments$k");
	$trn_comments =$$trn_comments;
	$trnmn_comments= sprintf("trnmn_comments$k");
	$trnmn_comments =$$trnmn_comments;
	$area_d =addslashes($area_d);
	$trn_comments =addslashes($trn_comments);
	$trnmn_comments = addslashes($trnmn_comments);
	$slno = $k+1;
$result_tdn = pg_exec($db_conn,"insert into pa_tdn(slno,area,emp_com,mgr_com,pk_sl) values($slno,'$area_d','$trn_comments','$trnmn_comments',$pk_sl)");
}
}

$pnp_upd = pg_query($db_conn,"select slno from pa_pnp where pk_sl = $pk_sl");
$no_pnp = pg_fetch_array($pnp_upd,0);
$no_pnp_p = $no_pnp[slno];
if($no_pnp_p)     
{
for($kk=0;$kk<4;$kk++)
{
	$task_d  = sprintf("task_d$kk");
	$emp_comments = sprintf("emp_comments$kk");
        $task_d   = $$task_d;
	$man_comments = sprintf("man_comments$kk");
	$emp_comments = $$emp_comments;
        $man_comments   = $$man_comments;
        $task_d   = addslashes($task_d);
	$emp_comments = addslashes($emp_comments);
        $man_comments = addslashes($man_comments);
	$slnop = $kk+1;	       
$result_pnp = pg_exec($db_conn,"update pa_pnp set tasks= '$task_d',emp_com='$emp_comments',mgr_com='$man_comments',pk_sl=$pk_sl where slno= $slnop and pk_sl = $pk_sl");
}
}
else
{
for($kk=0;$kk<4;$kk++)
{
	$task_d  = sprintf("task_d$kk");
	$emp_comments = sprintf("emp_comments$kk");
        $task_d   = $$task_d;
	$man_comments = sprintf("man_comments$kk");
	$emp_comments = $$emp_comments;
        $man_comments   = $$man_comments;
        $task_d   = addslashes($task_d);
	$emp_comments = addslashes($emp_comments);
        $man_comments = addslashes($man_comments);
	$slnop = $kk+1;	       
$result_pnp = pg_exec($db_conn,"insert into pa_pnp(slno,tasks,emp_com,mgr_com,pk_sl) values($slnop,'$task_d','$emp_comments','$man_comments',$pk_sl)");
}
}

$pa_mgr_comm = addslashes($pa_mgr_comm);
$pa_emp_comm = addslashes($pa_emp_comm);
$rm_comm = addslashes($rm_com);

$emp_final_date = $cur_year.'-'.$cur_month.'-'.$cur_date;
$mgr_final_date = $cur_year.'-'.$cur_month.'-'.$cur_date;

if(($emp_dd)||($emp_mm)||($emp_yy))
{
if(!($emp_dd)|| !($emp_mm)|| !($emp_yy))
{ 
echo "<BR><BR><BR><center><b><font style=\"arial\" size=2>Please Enter valid Employee's confirmation Date</font></b></center>";
exit();
}
else
{
DateValidation($emp_dd,$emp_mm,$emp_yy,'Employee Confirmation Date');
$emp_stamp = mktime(0,0,0,$emp_mm,$emp_dd,$emp_yy);
$cur_stamp = mktime(0,0,0,date("n"),date("j"),date("Y"));
if($emp_stamp>$cur_stamp)
     {
	 echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Employee's Confirmation Date can not be greater than  current date</font></b></center>";
	        exit();
       }
	       
}
}
if(($man_dd)||($man_mm)||($man_yy))
{
if(!($man_dd)|| !($man_mm)|| !($man_yy))
{
echo "<BR><BR><BR><center><b><font style=\"arial\" size=2>Please Enter valid Manager's confirmation Date</font></b></center>";
exit();
}
else
{DateValidation($man_dd,$man_mm,$man_yy,'Manager confirmation Date');
$man_stamp = mktime(0,0,0,$man_mm,$man_dd,$man_yy);
$cur_stamp = mktime(0,0,0,date("n"),date("j"),date("Y"));
if($man_stamp>$cur_stamp)
     {
	 echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Manager's Confirmation Date can not be greater than  current date</font></b></center>";
	        exit();
      }
       }
       }
if($totm<55)		   
{
$over_rate = 'first_r'; 
}
if($totm>=55 && $totm<=64)		   
{
$over_rate = 'second_r'; 
}
if($totm>=65&&$totm<=74)		   
{
$over_rate = 'third_r'; 
}
if($totm>=75&&$totm<=84)		   
{
$over_rate = 'four_r'; 
}
if($totm>84)		   
{
$over_rate = 'five_r'; 
}
if($emp_final_date=='--'&& $mgr_final_date=='--')
{
$emp_f1 = 'null';
$mgr_f2 = 'null';
$result = pg_exec($db_pas,"update pa_assess set mgr_rate=array[$rlistp1,$rlistp2,$rlistp3,$rlistp4,$rlistp5,$rlistp6,$rlistp7,$rlistp8,$rlistp9,$rlistp10,$rlistp11,$rlistp12],mgr_rate_w = array[$firstwp,$secondwp,$thirdwp,$fourwp,$fivewp,$sixwp,$sevenwp,$eightwp,$ninewp,$tenwp,$elevenwp,$twelvewp],mgr_total = $totm,pa_mgr_com='$pa_mgr_comm',pa_emp_com='$pa_emp_comm',emp_final_date = $emp_f1,mgr_final_date = $mgr_f2,over_rate = '$over_rate',emp_final='$emp_final',man_final='$man_final' where pk_sl = $pk_sl");
}
if($mgr_final_date=='--'&& $emp_final_date!='--')
{
$mgr_s = 'null';
$result = pg_exec($db_pas,"update pa_assess set mgr_rate=array[$rlistp1,$rlistp2,$rlistp3,$rlistp4,$rlistp5,$rlistp6,$rlistp7,$rlistp8,$rlistp9,$rlistp10,$rlistp11,$rlistp12],mgr_rate_w = array[$firstwp,$secondwp,$thirdwp,$fourwp,$fivewp,$sixwp,$sevenwp,$eightwp,$ninewp,$tenwp,$elevenwp,$twelvewp],mgr_total = $totm,pa_mgr_com='$pa_mgr_comm',pa_emp_com='$pa_emp_comm',emp_final_date = '$emp_final_date',mgr_final_date=$mgr_s,over_rate = '$over_rate',emp_final='$emp_final',man_final='$man_final' where pk_sl = $pk_sl");
}
if($emp_final_date=='--'&& $mgr_final_date!='--')
{
$emp_f3 = 'null';
$result = pg_exec($db_pas,"update pa_assess set mgr_rate=array[$rlistp1,$rlistp2,$rlistp3,$rlistp4,$rlistp5,$rlistp6,$rlistp7,$rlistp8,$rlistp9,$rlistp10,$rlistp11,$rlistp12],mgr_rate_w = array[$firstwp,$secondwp,$thirdwp,$fourwp,$fivewp,$sixwp,$sevenwp,$eightwp,$ninewp,$tenwp,$elevenwp,$twelvewp],mgr_total = $totm,pa_mgr_com='$pa_mgr_comm',pa_emp_com='$pa_emp_comm',emp_final_date = $emp_f3,mgr_final_date='$mgr_final_date',over_rate = '$over_rate',emp_final='$emp_final',man_final='$man_final' where pk_sl = $pk_sl");


}
if($emp_final_date!='--'&& $mgr_final_date!='--')
{
$result = pg_exec($db_pas,"update pa_assess set mgr_rate=array[$rlistp1,$rlistp2,$rlistp3,$rlistp4,$rlistp5,$rlistp6,$rlistp7,$rlistp8,$rlistp9,$rlistp10,$rlistp11,$rlistp12],mgr_rate_w = array[$firstwp,$secondwp,$thirdwp,$fourwp,$fivewp,$sixwp,$sevenwp,$eightwp,$ninewp,$tenwp,$elevenwp,$twelvewp],mgr_total = $totm,pa_mgr_com='$pa_mgr_comm',pa_emp_com='$pa_emp_comm',emp_final_date = '$emp_final_date',mgr_final_date='$mgr_final_date',over_rate = '$over_rate',emp_final='$emp_final',man_final='$man_final' where pk_sl = $pk_sl");
}
//if($result)
if($result_tdn ||$result_pnp||$result)
 {
 if($emp_final && $man_final)// && $emp_dd && $emp_mm && $emp_yy && $man_dd && $man_mm && $man_yy)
{ 
$upd= pg_exec($db_pas,"update pa_lock set rm_comm = 't' where pk_sl = $pk_sl and qtr=$qtr and year=$year");
 $pg_off=db_open('offproj','0');
// $mail_to=pg_exec($pg_off,"select login,emp_name from emp_master where emp_code in (select emp_code from mail_hr)");
$mailserver="integramicro.com";
//$mailserver="tuxedo.integramicro.co.in";
/* $row=pg_num_rows($mail_to);
 for($i=0;$i<$row;$i++)
 {
         $rec=pg_fetch_array($mail_to,$i);
	 $rec_login=trim($rec[login]);
	 $rec_name=trim($rec[emp_name]);*/
	 $rec_login="pas";
//	 $rec_login="narmathadevib";
	 $login=$rec_login."@$mailserver";
//	 $send_mail.=$login.',';
	 $subject="Intimation of completion of Appraisal Meeting: $emp_name($ecode)";
	 $message="Appraisal Meeting of $emp_name($ecode) has been completed.\n\n\nThanks & Regards\nIntegra Micro Systems";
//	 echo "$message";
         $header="From: $PCC_ID:\nBcc:$send_mail";


// }
 $sucess=mail($login,$subject,$message,$header);
         if(!$sucess)
         echo "<center><b><br><br><font style=\"arial\" size=2>Mail is not sent to $login.</font></b></center>";
       /*  else
         echo "<center><b><br><br><font style=\"arial\" size=\"2\".Mail is not sent to $login.</font></b><center>";*/
}
 echo "<BR><BR><BR><center><b><font style=\"arial\" size=2>Data Updated Successfully</font></b></center>";

 echo "<input type=\"hidden\" name=\"from_emp\" value=\"$ecode\">";
 
}

  else

  echo"<center><br><br><b><font style=\"arial\" size=2>Data not updated</font></b></center>";
  echo"<center><br><input type = \"submit\" name = \"sb\"\  value = \"Ok\"></center>";
  echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
  echo "<input type=\"hidden\" name=\"pk_sln\" value=\"$pk_sln\">";
  echo "<input type=\"hidden\" name=\"meet_to\" value=\"$ecode\">";
  echo "<input type=\"hidden\" name=\"login\" value=\"$login\">";
  echo"</form>";
  echo"</body>";
  echo"</html>";
?>
