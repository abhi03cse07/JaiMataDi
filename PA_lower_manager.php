<?

include_once('head.php');
//include_once "../tsutils.php";
include_once "pasutils.php";
error_reporting(E_ERROR);
if (!CheckAuthKey ($keychk))
   {
      Error ("Login");
      exit;
   }
$db_conn = db_open("offproj",0);
$ecode = $appr_to;
$db_pas = db_open("pas_db");
$pk_sl_q = pg_query($db_pas,"select pk_sl from pa_lock where emp_code = $ecode and qtr =$qtr and year =$year");
$pk_sl_f = pg_fetch_array($pk_sl_q,0);
$pk_sl = $pk_sl_f[pk_sl];
if($pk_sl_q)
$ecode_gen = EcodeEnteredFromEcode($ecode);
$emp_name = EmpNameFromEmpCode($ecode);

echo "<html>
<head>
<script language=\"JavaScript\" type = \"text/javascript\">
      function insert()
      {
      document.f1.action = \"PA_appr_insert_lower.php\";
      }
</script>
<title>Performance Appraisal Form</title>
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


</head>
<body style='background-color: #CDE1EB !important;'>
";
Function EmpRateList($rlist)
{
	$db_conn = db_open("pas_db",0);
	$emp_rate = pg_query($db_conn,"select rate_code,rate_desc  from i_work_def");
	$num_rows = pg_num_rows($emp_rate);
		
	 echo"<select name = $rlist onChange = \"fact()\">";
	echo"<option></option>";
	for($num=0;$num<=$num_rows;$num++){
		$emp_rate_arr = pg_fetch_array($emp_rate,$num);
		$rate_code = $emp_rate_arr[rate_code];
		$rate_desc = trim($emp_rate_arr[rate_desc]);
		echo"<option value = \"$rate_code\">$rate_desc</option>";
		}
		echo"</select>";
	}
//echo"<form name =\"f1\" action =\"$PHP_SELF#book\" method=\"post\">";
echo"<form name =\"f1\" action =\"PA_rh_main_menu.php\"  method=\"post\">";
echo "<br>&nbsp;&nbsp;&nbsp;<span style='font-weight:bold'>Training and Development Needs</span>
<center><table style=\"width: 98%; text-align: left;\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">
  <tbody>
    <tr bgcolor='#E5E7E9'>
      <td>Sl No </td> <td>Area </td> <td>Employee's Comments </td> <td>Manager's Comments </td>
    </tr>";
     $pnp_qq = pg_query($db_pas,"select * from pa_tdn where pk_sl = $pk_sl");
     $tdnrows = pg_num_rows($pnp_qq);
     if(!$tdnrows) $tdnrows = 4;
for($k=0;$k<$tdnrows;$k++)
{
     $slno = $k+1;
     $tdn_q = pg_query($db_pas,"select area,emp_com,mgr_com from pa_tdn where pk_sl = $pk_sl and slno=$slno");
     $tdn_fetch = pg_fetch_array($tdn_q,0);
     $area_d = $tdn_fetch[area];
     $trn_comments = trim($tdn_fetch[emp_com]);
     $trnmn_comments =trim($tdn_fetch[mgr_com]);
    echo "<tr >
      <td>$slno</td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"area_d$k\">$area_d</textarea></td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"trn_comments$k\">$trn_comments</textarea></td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"trnmn_comments$k\">$trnmn_comments</textarea></td>";
      echo "</tr>";
      }
    
  echo"</tbody></table></center>";

echo "<br>&nbsp;&nbsp;&nbsp;<span style='font-weight:bold'>Projects/Assignments for the Next Period</span>
<center><table style=\"width: 98%; text-align: left;\" border=\"1\" cellpadding=\"2\"
 cellspacing=\"2\">
  <tbody>
    <tr bgcolor='#E5E7E9'>
      <td>Sl No</td><td>Tasks/Targets</td><td>Employee's Comments </td> <td>Manager's Comments</td>
    </tr>";
     $pnp_qq = pg_query($db_pas,"select oid from pa_pnp where pk_sl = $pk_sl");
     $norows = pg_num_rows($pnp_qq);
     if(!$norows) $norows = 4; 
 for($kk=0;$kk<$norows;$kk++)
{
     $slno1 = $kk+1;
     $pnp_q = pg_query($db_pas,"select tasks,emp_com,mgr_com from pa_pnp where pk_sl = $pk_sl and slno=$slno1");
     $pnp_fetch = pg_fetch_array($pnp_q,0);
     $task_d = trim($pnp_fetch[tasks]);
     $emp_comments = trim($pnp_fetch[emp_com]);
     $man_comments = trim($pnp_fetch[mgr_com]);
    echo "<tr>
      <td>$slno1</td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"task_d$kk\">$task_d</textarea></td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"emp_comments$kk\">$emp_comments</textarea></td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"man_comments$kk\">$man_comments</textarea></td>";
      echo "</tr>";
      }
   
  echo"</tbody></table></center><br>
<INPUT type=\"hidden\" name=\"ecode\" value=\"$ecode\" >
<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\" >
<INPUT type=\"hidden\" name=\"appr_to\" value=\"$appr_to\" >
<center><INPUT type=\"submit\" name=\"next_scr\" value=\"Submit\" onClick =\"insert()\" ></center>";
echo"</form>";
echo "</body></html>";
?>
