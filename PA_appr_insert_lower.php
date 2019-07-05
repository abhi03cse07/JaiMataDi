<html>
<head>
<script  language = "javascript" >
function next()
{
document.f1.action = "PA_above_manager.php";
document.f1.submit();
}
function exit()
{
document.forms[0].action ="PA_rh_menu.php";
}
</script>
</head>
<body bgcolor = "#CDE1EB">
<form name ="f1" method="POST">
<?php
error_reporting(0);
include_once('head.php');
//include_once "tsutils.php";	
include_once "pasutils.php";	
//error_reporting (E_ERROR);
$db_conn = db_open("pas_db");
//$appr_to = $ecode;
//$ecode = $appr_to;
$get_key = pg_query($db_conn,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$year =$key_arr[year];                                                                         $qtr =$key_arr[qtr];

$result_key = pg_query($db_conn,"select pk_sl from pa_lock where emp_code = $ecode and year = $year and qtr = $qtr");
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
if($result_tdn ||$result_pnp)
 {
	 echo "<BR><BR><BR><center><b>Data Successfully Added</b></center>";
	 echo "<BR><center><b>Do you want to fill Performance Assessment form  of employee now?</b></center>";
	 echo"<br><center><input type = \"submit\" name =\"b1\" value = \"Yes\" onClick = \"next()\">";
	 echo"&nbsp;&nbsp;<input type = \"submit\" name =\"b1\" value = \"No\" onClick = \"exit()\"></center>";

	 //echo"<input type = \"submit\" name =\"b2\" value = \"No\" onClick = \"exit()\">";
	 //echo"<center><input type = \"submit\" name =\"b1\" value = \"Ok\" onClick = \"exit(0\"></center>";
         
	 //exit();
 }
/*if($result_tdn && !$result_pnp)
 {
	 echo "<BR><BR><BR><center><b>Data added successfully</b></center>";
	 echo "<BR><BR><BR><center><b>Do You want to fille performance Assessment Form  Of Employee Now?</b></center>";
	 echo"<input type = \"submit\" name =\"b2\" value = \"Yes\" onClick = \"next()\">";
	// echo"<input type = \"submit\" name =\"b2\" value = \"No\" onClick = \"exit()\">";
	 // exit();
 }
if(!$result_tdn && $result_pnp)
 {
	 echo "<BR><BR><BR><center><b>Data added successfully</b></center>";
	 echo "<BR><BR><BR><center><b>Do You want to fille performance Assessment Form  Of Employee Now?</b></center>";
	 echo"<input type = \"submit\" name =\"b3\" value = \"Yes\" onClick = \"next()\">";
	// echo"<input type = \"submit\" name =\"b2\" value = \"No\" onClick = \"exit()\">";
	 //exit();
 }*/
 echo"<input type = \"hidden\" name = \"ecode\" value = \"$ecode\">";
 echo"<input type = \"hidden\" name = \"keychk\" value = \"$keychk\">";
 echo"<input type = \"hidden\" name = \"appr_to\" value = \"$appr_to\">";
 echo"<input type = \"hidden\" name = \"login\" value = \"$login\">";
echo"</form>";
echo"</body>";
echo"</html>";
?>	
