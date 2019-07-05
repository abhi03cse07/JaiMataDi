<?
######### Modified By akila on 4-Apr-2007 for BU Head as Review Manager #######################
include_once('head.php');
//include_once "../tsutils.php";
include_once "pasutils.php";
error_reporting(E_ERROR);
 if (! CheckAuthKey ($keychk))
   {
      Error ("Login");
      exit;
   }

$db_conn = db_open("offproj",0);
$db_pas = db_open("pas_db",0);

######Saving in the database############################
/*if($sub_scr)
{
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
   echo"update pa_emp_proj set mgr_comm = '$mgr_com' where pk_sl = $pk_sln and slno = $sl_get";
   echo "<BR><BR><BR><center><b>Comments successfully Added</b></center>";
  
    exit();   
}//end if
*/
$ecode = $appr_to;
$res_func=pg_query($db_conn,"SELECT func_name FROM func_master,emp_master WHERE  emp_master.emp_code=$ecode AND emp_master.func=func_master.func_id");
$res_func_fetch = pg_fetch_array($res_func,0);
$res_func_name = $res_func_fetch[func_name];
$emp_name_disp = EmpNameFromEmpCode($ecode);
$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$year =$key_arr[year];                                                                         $qtr =$key_arr[qtr];

$getpk_sl = pg_query($db_pas,"select pk_sl from pa_lock where emp_code = $ecode and year = $year and qtr = $qtr");
$get_num_pk = pg_num_rows($getpk_sl);
if($get_num_pk>0)
 {
  $pk_sl_fetch = pg_fetch_array($getpk_sl,0);
  $pk_sln = $pk_sl_fetch[pk_sl];
 }
 else
  {
   echo "<BR><BR><BR><center><b>$emp_name_disp has not processed appraisal form yet.</b></center>";
	  exit;
   }

$emp_info_q = pg_query($db_pas,"select loc,dojg from pa_emp_info where pk_sl = $pk_sln"); 
$emp_info_fetch = pg_fetch_array($emp_info_q,0);
//$dob_f = $emp_info_fetch[dob];
//$dob_arr = explode('-',$dob_f);
//$dob_a = $dob_arr[2].'-'.$dob_arr[1].'-'.$dob_arr[0];
//$dept_f = $emp_info_fetch[dept];
$loc_f = $emp_info_fetch[loc];
$loc_ff = stripslashes($loc_f);
$doj_f = $emp_info_fetch[dojg];
$doj_arr = explode('-',$doj_f);
$doj_a = $doj_arr[2].'-'.$doj_arr[1].'-'.$doj_arr[0];
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
$rev_code=GetReviewManager($ecode);
$rev_man = EmpNameFromEmpCode($rev_code);
$dob_q = pg_query($db_conn,"select birthdate from dob where eno = $ecode");
//$dob_q = pg_query($db_conn,"select birthdate from dob where eno = $ecode_gen");
$dob_fetch = pg_fetch_array($dob_q,0);
$dob = trim($dob_fetch[birthdate]);
$dob_arr = explode('-',$dob);
$dob = $dob_arr[2].'-'.$dob_arr[1].'-'.$dob_arr[0];
$sal_due_q = pg_query($db_pas,"select sr_due from salary_due where eno = $ecode");
//$sal_due_q = pg_query($db_pas,"select sr_due from salary_due where eno = $ecode_gen");
$sal_fetch = pg_fetch_array($sal_due_q,0);
$sal_due = trim($sal_fetch[sr_due]);
$sal_arr = explode('-',$sal_due);
$sal_due = $sal_arr[2].'-'.$sal_arr[1].'-'.$sal_arr[0];
$res_year = pg_query($db_pas, "SELECT year FROM pa_init");
$res_fetch = pg_fetch_array($res_year);
$cur_year = $res_fetch[year];

//echo "<form action =\"$PHP_SELF#book\" method=\"post\">";
echo "<form action =\"PA_proj_finish.php\" method=\"post\">";
echo "<html>
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



</head>
<body style='background-color: #CDE1EB !important;'>
<span style='font-weight:bold'><center><h2>Project Assessment</h2></center></span>

<span style='font-weight:bold'>&nbsp;&nbsp;&nbsp;Appraisal Period:</span>
<center><table style=\"width: 98%; text-align: left;\" border=\"0\"><tr><td>Year:&nbsp;&nbsp;$cur_year</td><td>Period:&nbsp;&nbsp;";
period();
echo"</td></tr></table></center><br>
<span style='font-weight:bold'>&nbsp;&nbsp;&nbsp;Employee Information</span>";
echo "<center><table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    <tr>
      <td bgcolor='#E5E7E9'>Employee Number</td> <td bgcolor='#E5E7E9'>$ecode_gen</td>
      <td bgcolor='#E5E7E9' > Name </td> <td bgcolor='#E5E7E9'>$emp_name</td>
    </tr>
    <tr><td>Date of Birth (dd-mm-yyyy) </td>
      <td> $dob </td>
      <td>Date of Joining Integra (dd-mm-yyyy)</td><td>$join_dd</td></tr>
      <tr><td>Department/Division</td>
      <td>$res_func_name</td>
      <td>Designation</td><td>$desg_get</td></tr>
      <tr><td>Current Work Location</td>
      <td> $loc_ff</td>
      <td>Group</td><td>$func_ename</td></tr>
      <tr><td>Date of Joining Group (dd-mm-yyyy)</td>
      <td>$doj_a</td>
      <td>Appraising Manager</td><td>$report_h</td>
      </tr>
      <tr><td>Reviewing Manager</td><td>$rev_man</td>
      <td>Salary Revision Due on (dd-mm-yyyy)</td></td>
      <td>$sal_due</td>
     </tr>
     </tbody></table></center>";
##############Project Part###########################
   $proj_q = pg_query($db_pas,"select distinct slno from pa_emp_proj where pk_sl = $pk_sln");
   $proj_rows = pg_num_rows($proj_q);
for($i=0;$i<$proj_rows;$i++)
 {
   $proj_r_fetch = pg_fetch_array($proj_q,$i);   
   $sl_get = $proj_r_fetch[slno];
   $proj_det_q = pg_query($db_pas,"select proj,proj_com,task,mgr_comm from pa_emp_proj where pk_sl = $pk_sln and slno = $sl_get");
   $proj_det_f = pg_fetch_array($proj_det_q,0);
   $proj_a = trim($proj_det_f[proj]);
   $proj_a = stripslashes($proj_a);
   $proj_com = trim($proj_det_f[proj_com]);
   $proj_com = stripslashes($proj_com);
   $task_a = trim($proj_det_f[task]);
   $task_a = stripslashes($task_a);
   $mgr_com = trim($proj_det_f[mgr_comm]);
    $mgr_com = stripslashes($mgr_com);
  echo "  <br>&nbsp;&nbsp;&nbsp;<span style='font-weight:bold'>Projects/Assignments carried out during the Review Period</span>";

  echo "<center><table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody><tr>
  <td colspan=\"2\" bgcolor='#E5E7E9'>Project/Assignment</td><td colspan=\"5\" bgcolor='#E5E7E9'>$proj_a</td></tr>
       <tr><td colspan=\"2\">Task Assigned in Project</td><td colspan=\"5\">$task_a</td></tr>
    <tr bgcolor='#E5E7E9'>
      <td >Sl No</td>
      <td>Task Description</td>
      <td>Status</td>
      <td>Constraints Faced</td>
      <td>Whether Constraints were overcome</td>
      <td>Reason if not accomplished</td>
      </tr>";
   $task_det_q = pg_query($db_pas,"select task_desc,status_code,cons,const_over,reason from pa_emp_task where pk_sl = $pk_sln and slno = $sl_get");
   $task_num = pg_num_rows($task_det_q);
#echo "<tr><td>$task_num</td></tr>";
for($j=0;$j<$task_num;$j++)
 {
   $task_det_f = pg_fetch_array($task_det_q,$j);
   $task_sl = $j+1;
    $task_desc_s = trim($task_det_f[task_desc]);
    $task_desc_s = stripslashes($task_desc_s);
    $stat_code_s = $task_det_f[status_code];
    $stat_code_s = stripslashes($stat_code_s);
    $const_s = trim($task_det_f[cons]);
    $const_s = stripslashes($const_s);
    $c_over_s = trim($task_det_f[const_over]);
    $c_over_s = stripslashes($c_over_s);
    $reason_s = trim($task_det_f[reason]);
   $reason_s  = stripslashes($reason_s);
    $stat_desc_q = pg_query($db_pas,"select status_desc from i_task_def where status_code=$stat_code_s");
    $stat_desc_f = pg_fetch_array($stat_desc_q,0);
    $stat_desc =  trim($stat_desc_f[status_desc]);
    echo "<tr><td>$task_sl</td><td>$task_desc_s</td><td>$stat_desc</td><td>$const_s</td><td>$c_over_s</td><td>$reason_s</td></tr>";
}

  echo "<tr>
      <td colspan=\"2\">Manager's Comments</td>
      <td colspan=\"5\"><textarea rows = \"3\" cols = \"80\" name =\"mgr_comm$sl_get\">$mgr_com</textarea></td>
    </tr>";

  echo "</tbody></table></center>";
}  //end for


##################################Training attended
$tpa_q = pg_query($db_pas,"select train_prog,f_date,t_date,rem from pa_tpa where pk_sl = $pk_sln");
$tpa_num = pg_num_rows($tpa_q);
if($tpa_num>0)
 {
echo "
<br>&nbsp;&nbsp;&nbsp;<span style='font-weight:bold'>Training Programmes attended during the Review Period</span>
<center><table style=\"width: 98%; text-align: left;\" border=\"1\">
  <tbody>
    <tr bgcolor='#E5E7E9'><td>Sl No</td><td>Training Programme</td><td>From Date (dd-mm-yyyy)</td><td>To Date (dd-mm-yyyy)</td><td>Remarks</td>
    </tr>";
 for($i=0;$i<$tpa_num;$i++)
  {  
    $tpa_f = pg_fetch_array($tpa_q,$i); 
   $tp_num = $i+1;
    $tp_att = trim($tpa_f[train_prog]);
    $tp_att = stripslashes($tp_att);
    $tf_date = $tpa_f[f_date];
    $tt_date = $tpa_f[t_date];
    $tf_arr = explode('-',$tf_date);
    $tf_date = $tf_arr[2].'-'.$tf_arr[1].'-'.$tf_arr[0]; 
    $tt_arr = explode('-',$tt_date);
    $tt_date = $tt_arr[2].'-'.$tt_arr[1].'-'.$tt_arr[0]; 
    $tp_rem = trim($tpa_f[rem]);
    $tp_rem = stripslashes($tp_rem);
    echo "<tr><td>$tp_num</td><td>$tp_att</td><td>$tf_date</td><td>$tt_date</td><td>$tp_rem</td></tr>";
}
echo "</tbody></table></center>";
}
###############################################
$sa_q = pg_query($db_pas,"select skill,level from pa_sa where pk_sl = $pk_sln");
$sa_num = pg_num_rows($sa_q);
if($sa_num>0)
 {

echo "<br>&nbsp;&nbsp;&nbsp;<span style='font-weight:bold'>Skills Acquired</span>";
echo "<center><table style=\"width: 98%; text-align: left;\" border=\"1\">
  <tbody>
  <tr bgcolor='#E5E7E9'><td>Sl No</td><td>Skill (Platform, Tool, Language etc)</td><td>Level (1=&gt; Low 5=&gt; high)</td></tr>";

 for($i=0;$i<$sa_num;$i++)
  {  
    $sa_f = pg_fetch_array($sa_q,$i); 
   $sa_i = $i+1;
    $s_skill = trim($sa_f[skill]);
    $s_skill = stripslashes($s_skill);
    $s_level = $sa_f[level];
  echo "<tr><td>$sa_i</td><td>$s_skill</td><td>$s_level</td></tr>";
}   
echo "</tbody></table></center>";
}
###################################

$da_q = pg_query($db_pas,"select domain,level from pa_dea where pk_sl = $pk_sln");
$da_num = pg_num_rows($da_q);
if($da_num>0)
 {

echo "<br>&nbsp;&nbsp;&nbsp;<span style='font-weight:bold'>Domain Expertise Acquired</span>";
echo "<center><table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    <tr bgcolor='#E5E7E9'><td>Sl No</td><td>Domain Expertise Area (Technology, Business, Industry etc)</td><td>Level (1=&gt; Low 5=&gt; high)</td></tr>";

 for($i=0;$i<$da_num;$i++)
  {   
$da_f = pg_fetch_array($da_q,$i);
   $da_i = $i+1;
    $d_domain = trim($da_f[domain]);
    $d_domain = stripslashes($d_domain);
    $d_level = $da_f[level];
  echo "<tr><td>$da_i</td><td>$d_domain</td><td>$d_level</td></tr>";
}   
echo "</tbody></table></center>";
}
###################################

// Added by Ankur Kapoor on 3rd of feb 2006
// Additional information given

$add_q = pg_query($db_pas,"select info from pa_add_info where pk_sl = $pk_sln");
$add_num =pg_num_rows($add_q);
$add_arr = pg_fetch_array($add_q);
$add_info = $add_arr[info];

if($add_num > 0)
{

echo "<h4>Additional Information</h4>";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    <tr><td>$add_info</td></tr></tbody></table>";

} 


    
###################################
echo "<br><br><center><INPUT type=\"submit\" name=\"sub_scr\" value=\"Submit\"></center>";
echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo "<input type=\"hidden\" name=\"pk_sln\" value=\"$pk_sln\">";
echo "<input type=\"hidden\" name=\"ecode\" value=\"$ecode\">";
echo "</form>";
echo "</body></html>";
?>
