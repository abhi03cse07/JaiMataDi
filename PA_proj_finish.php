<html>
<head>
<script language = "javascript">
function menu()
{
document.forms[0].action = "PA_rh_menu.php";
}
</script>
</head>
<?
include_once "../tsutils.php";
error_reporting(E_ERROR);
if (! CheckAuthKey ($keychk))
{
        Error ("Login");
        exit;
} 

$db_pas = db_open("pas_db",0);
echo"<body bgcolor = \"#CDE1EB\">";
//echo"<form action = \"PA_rh_menu.php\">";
echo"<form action= \"PA_lower_manager.php\" method=\"POST\">";
$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$year =$key_arr[year];
$qtr =$key_arr[qtr];

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
  echo "<tr><td><center><b>Comments Successfully Added</b></center></td></tr>";
  echo"<br><tr><td><center><b>Do you want to fill Next Quarter Plan Form?</b> </center></td></tr><tr><td>
<br><center><input type = \"submit\" name = \"sb\"\  value = \"Yes\">";
 echo"&nbsp;&nbsp;<input type = \"submit\" name = \"sb\"\  value = \"No\" onClick =\"menu()\"></center></td></tr>";
   echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
   echo "<input type=\"hidden\" name=\"pk_sln\" value=\"$pk_sln\">";
   echo "<input type=\"hidden\" name=\"appr_to\" value=\"$appr_to\">";
echo"</form>";
//echo"<form action=\"PA_rh_menu.php\" method=\"POST\">";

   echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
   echo "<input type=\"hidden\" name=\"pk_sln\" value=\"$pk_sln\">";
   echo "<input type=\"hidden\" name=\"appr_to\" value=\"$appr_to\">";

   echo"</form>";
echo"</body>";
echo"</html>";

?>
