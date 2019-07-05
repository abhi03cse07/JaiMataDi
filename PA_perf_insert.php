<?php
session_start();
//echo $_SESSION['userName'];exit;

?>
<html>
<head>
<script language ="JavaScript">
function menu()
{
document.forms[0].action="PA_main_menu.php?userName=<?php echo $_SESSION['userName']; ?>&securityToken=<?php echo $_SESSION['token']; ?>"
}
//function exit()
//{
//document.forms[0].action="PA_rh_menu.php"
//}
</script>
</head>
<body bgcolor = "#CDE1EB">
<?
error_reporting(0);
include_once('head.php');
//include_once "tsutils.php";
include_once "pasutils.php";
error_reporting(E_ERROR);
$db_pas = db_open("pas_db",0);
echo"<form  name =\"f2\" method=\"POST\">";
if($totm<55)
{
$over_rate = 'first_r';
}
if($totm>=55 && $totm<=64)
{
$over_rate = 'second_r';
}


if($totm>64&&$totm<=74)
{
$over_rate = 'third_r';
}
if($totm>74&&$totm<=84)
{
$over_rate = 'four_r';
}
if($totm>84)
{
$over_rate = 'five_r';
}
$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$year =$key_arr[year];
$qtr =$key_arr[qtr];

$result_k = pg_query($db_pas,"select pk_sl from pa_lock where emp_code = $ecode and year =$year and qtr = $qtr");
$res_arr = pg_fetch_array($result_k,0);
$pk_sl =$res_arr[pk_sl];

$result = pg_exec($db_pas,"update pa_assess set mgr_rate=array[$rlistp1,$rlistp2,$rlistp3,$rlistp4,$rlistp5,$rlistp6,$rlistp7,$rlistp8,$rlistp9,$rlistp10,$rlistp11,$rlistp12],mgr_rate_w = array[$firstwp,$secondwp,$thirdwp,$fourwp,$fivewp,$sixwp,$sevenwp,$eightwp,$ninewp,$tenwp,$elevenwp,$twelvewp],over_rate = '$over_rate',mgr_total = $totm where pk_sl = $pk_sl");




if($result)
{
echo "<BR><BR><BR><center><b>Data Updated Successfully</b></center>";
 $upd= pg_exec($db_pas,"update pa_lock set mgr_rate = 't' where pk_sl = $pk_sl and year=$year and qtr=$qtr");
 
echo"<center><br><input type = \"submit\" name = \"sb1\"\  value = \"Ok\" onClick =\"menu() \">";
   echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo "<input type=\"hidden\" name=\"from_emp\" value=$ecode>";
//echo"<input type = \"submit\" name = \"sb2\"\  value = \"No\" onClick = \"exit()\"></center>";
}
else
echo"<center><b>Data  not be  updated</b></center>";
	  
   echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
   echo "<input type=\"hidden\" name=\"pk_sln\" value=\"$pk_sln\">";
   echo "<input type=\"hidden\" name=\"appr_to\" value=\"$appr_to\">";
   echo "<input type=\"hidden\" name=\"login\" value=\"$login\">";
   
   echo"</form>";
echo"</body>";
echo"</html>";

?>
