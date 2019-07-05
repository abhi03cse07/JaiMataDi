<!--

Modified By Akila on 4April2007 for BU as Review Manager in the Report

-->

<html>
<head>
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
<!--<title>Performance Appraisal Form</title>-->
<script language="JavaScript">
function cprocess()
{
window.close();
return(false);
}
</script>
</head>
<?
#print_r($_POST);
include_once "../tsutils.php";
include_once "pasutils.php";
error_reporting(E_ERROR);
if (!CheckAuthKey ($keychk))
{
Error ("Login");
exit;
}
echo"<body bgcolor = \"#CDE1EB\">";
$ecode = $meet_to;
$emp_name = EmpNameFromEmpCode($ecode);
$db_pas = db_open("pas_db",0);
$db_conn=db_open("offproj",0);
$res_func=pg_query($db_conn,"SELECT func_name FROM func_master,emp_master WHERE emp_master.emp_code=$ecode AND emp_master.func=func_master.func_id");
$res_func_fetch = pg_fetch_array($res_func,0);
$res_func_name = $res_func_fetch[func_name];
$emp_info_q = pg_query($db_pas,"select loc,dojg from pa_emp_info where pk_sl=$pk_sln");
$emp_info_fetch = pg_fetch_array($emp_info_q,0);
$loc_f = $emp_info_fetch[loc];
$loc_ff = stripslashes($loc_f);
$doj_f = $emp_info_fetch[dojg];
$doj_arr = explode('-',$doj_f);
$doj_a = $doj_arr[2].'-'.$doj_arr[1].'-'.$doj_arr[0];
$ecode_gen = EcodeEnteredFromEcode($ecode);
$emp_name = EmpNameFromEmpCode($ecode);
$emp_dq = pg_query($db_conn,"select join_date,func,designation from emp_master where emp_code=$ecode");
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
//$report_code = ReportingHead($ecode);
$report_code = Appraised_by($pk_sln);
$report_h = EmpNameFromEmpCode($report_code);
$rev_code=GetReviewManager($ecode);
$rev_man = EmpNameFromEmpCode($rev_code);
$dob_q = pg_query($db_conn,"select birthdate from dob where eno = $ecode");
$dob_fetch = pg_fetch_array($dob_q,0);
$dob = trim($dob_fetch[birthdate]);
$dob = explode('-',$dob);
$dob=$dob[2].'-'.$dob[1].'-'.$dob[0];
$sal_due_q = pg_query($db_pas,"select sr_due from salary_due where eno = $ecode");
$sal_fetch = pg_fetch_array($sal_due_q,0);
$sal_due = trim($sal_fetch[sr_due]);
$sal_due = explode('-',$sal_due);
$sal_due=$sal_due[2].'-'.$sal_due[1].'-'.$sal_due[0];

// Added by Ankur Kapoor on 27th Nov 2006

//////////////////////////////

$sel_from_pa_emp = pg_query($db_pas,"select * from pa_emp_record where pk_sl = $pk_sln");
$num_rows = pg_num_rows($sel_from_pa_emp);

        $rec_array = pg_fetch_array($sel_from_pa_emp,0);
	if($num_rows > 0){
		$emp_name = trim($rec_array[emp_name]);
        	$func_ename= trim($rec_array[grp]);
        	$ecode_gen = $rec_array[previous_id];
		$res_func_name = trim($rec_array[dept]);
	}
        $rev_code = $rec_array[review_mgr];
        $rev_man =  EmpNameFromEmpCode($rev_code);
        $sal_due =  trim($rec_array[sr_due]);
        $sal_due =  explode('-',$sal_due);
        $sal_due =  $sal_due[2].'-'.$sal_due[1].'-'.$sal_due[0];
        $desg_get = trim($rec_array[desg]);

//////////////////////////////

echo"<form name =\"f1\" method=\"post\" >";
echo"<h2 align = \"center\">Integra Micro Software Services (P) Ltd.</h2>
<h3 align= \"center\">Periodic Performance Appraisal Form</h3>
<h4 align=\"center\">(Strictly Personal and Confidential)</h4>";

echo"<table style=\"width: 98%; text-align: left;\" border=\"0\"><tr bgcolor='#E5E7E9'><td>Year:&nbsp;&nbsp;$year</td>
<td>Period:&nbsp;&nbsp; $qtr_com";
//period();
echo"</td></tr></table>
<h3>Employee Information</h3>";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
<tr bgcolor='#E5E7E9' ><td>Employee Number</td> <td>$ecode_gen</td>
<td> Name </td> <td >$emp_name</td>
</tr>
<tr><td>Date of Birth (dd-mm-yyyy) </td>
<td> $dob </td>
<td>Date of Joining Integra (dd-mm-yyyy)</td><td>$join_dd</td></tr>
<tr><td>Department/Division</td>
<td>$res_func_name</td>
<td>Designation</td><td>$desg_get</td></tr>
<tr><td>Current Work Location</td>
<td>$loc_ff</td>
<td>Group</td><td>$func_ename</td></tr>
<tr><td>Date of Joining Group (dd-mm-yyyy)</td>
<td>$doj_a</td>
<td>Appraising Manager</td><td>$report_h</td>
</tr>
<tr><td>Reviewing Manager</td><td>$rev_man</td>
<td>Salary Revision Due on (dd-mm-yyyy)</td></td>
<td>$sal_due</td>
</tr>
</tbody></table>";
$proj_q = pg_query($db_pas,"select distinct slno from pa_emp_proj where pk_sl = $pk_sln");
$proj_rows = pg_num_rows($proj_q);
for($i=0;$i<$proj_rows;$i++)
 {
   $proj_r_fetch = pg_fetch_array($proj_q,$i);   
   $sl_get = $proj_r_fetch[slno];
   $proj_det_q = pg_query($db_pas,"select proj_com,proj,task,mgr_comm from pa_emp_proj where pk_sl = $pk_sln and slno = $sl_get");
   $proj_det_f = pg_fetch_array($proj_det_q,0);
   $proj_a = trim($proj_det_f[proj]);
   $proj_a = stripslashes($proj_a);
   $proj_com = trim($proj_det_f[proj_com]);
   $proj_com = stripslashes($proj_com);
   $task_a = trim($proj_det_f[task]);
   $task_a = stripslashes($task_a);
   $mgr_com = trim($proj_det_f[mgr_comm]);
    $mgr_com = stripslashes($mgr_com);
  echo "  <h3>Projects/Assignments carried out during the Review Period</h3>";
  echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody><tr bgcolor='#E5E7E9'>
  <td colspan=\"2\">Project/Assignment</td><td colspan=\"5\">$proj_a</td></tr>
       <tr><td colspan=\"2\">Task Assigned in Project</td><td colspan=\"5\">$task_a</td></tr>
    <tr>
      <td>Sl No</td>
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
      <td colspan=\"5\">$mgr_com</td>
    </tr>";

  echo "</tbody></table>";
}  //end for


#####################end Of project part#############

$db_conn = db_open("offproj",0);
$ecode_gen = EcodeEnteredFromEcode($ecode);
echo"<body bgcolor=\"#CDE1EB\">";
$emp_arr = pg_query($db_pas,"select emp_final_date,mgr_final_date,over_rate,emp_final,man_final,pa_mgr_com,pa_emp_com,emp_rate,emp_rate_w,mgr_rate,mgr_rate_w,emp_total,mgr_total,sub_date from pa_assess where pk_sl = $pk_sln");

$num_rows = pg_num_rows($emp_arr);
for($i=0;$i<$num_rows;$i++)
{
$emp_rate_arr = pg_fetch_array($emp_arr,$i);
$emp_rate = $emp_rate_arr[emp_rate];
$emp_rate_w = $emp_rate_arr[emp_rate_w];
$emp_total = $emp_rate_arr[emp_total];
$mgr_total = $emp_rate_arr[mgr_total];
$man_final = $emp_rate_arr[man_final];
$emp_final = $emp_rate_arr[emp_final];
$over_rate = $emp_rate_arr[over_rate];
$emp_final_date = $emp_rate_arr[emp_final_date];
$mgr_final_date = $emp_rate_arr[mgr_final_date];
//test  
$mgr_rate = $emp_rate_arr[mgr_rate];
$mgr_rate_w = $emp_rate_arr[mgr_rate_w];
$pa_mgr_comm = $emp_rate_arr[pa_mgr_com];
$pa_mgr_comm = stripslashes($pa_mgr_comm);
$pa_emp_comm = $emp_rate_arr[pa_emp_com];
$pa_emp_comm = stripslashes($pa_emp_comm);
$pa_sub_date = $emp_rate_arr[sub_date];
$pa_sub_date = explode('-',$pa_sub_date);
$pa_date = $pa_sub_date[2].'-'.$pa_sub_date[1].'-'.$pa_sub_date[0];
}
$emp_date_fi = explode('-',$emp_final_date);
$mgr_date_fi = explode('-',$mgr_final_date);
$emp_sel = explode(',',$emp_rate);
$mgr_sel = explode(',',$mgr_rate);
$emp_sel_w = explode(',',$emp_rate_w);
$mgr_sel_w = explode(',',$mgr_rate_w);
$firstwm =  substr_replace($emp_sel_w[0],' ',0,1);
$emp_sel[0] =  substr_replace($emp_sel[0],' ',0,-1);
$emp_sel[0] = (int)$emp_sel[0];
$emp_sel[11] =  substr_replace($emp_sel[11],' ',strlen($emp_sel[11])-1,1);
$emp_sel[11] = (int)$emp_sel[11];
$emp_sel_w[11] =  substr_replace($emp_sel_w[11],' ',strlen($emp_sel_w[11])-1,1);
$mgr_sel_w[11] =  substr_replace($mgr_sel_w[11],' ',strlen($mgr_sel_w[11])-1,1);
$mgr_sel[0] =  substr_replace($mgr_sel[0],' ',0,-1);
$mgr_sel[0] = (int)$mgr_sel[0];
$mgr_sel[11] =  substr_replace($mgr_sel[11],' ',strlen($mgr_sel[11])-1,1);
$mgr_sel[11] = (int)$mgr_sel[11];
$mgr_sel_w[0] =  substr_replace($mgr_sel_w[0],' ',0,1);
Function EmpRateList($rlist,$listm)
{
	$db_pas = db_open("pas_db",0);
	$emp_rate = pg_query($db_pas,"select rate_code,rate_desc  from i_work_def");
	$num_rows = pg_num_rows($emp_rate);
		
	 echo"<select name = $rlist onChange = \"fact()\">";
	echo"<option></option>";
	for($num=0;$num<$num_rows;$num++){
		$emp_rate_arr = pg_fetch_array($emp_rate,$num);
		$rate_code = $emp_rate_arr[rate_code];
		$rate_desc = trim($emp_rate_arr[rate_desc]);
		if($rate_code==$listm)
		echo"<option value = \"$rate_code\" selected >$rate_desc</option>";
		else
		echo"<option value = \"$rate_code\">$rate_desc</option>";
		}
		echo"</select>";
	pg_close();
		}

Function RateDesc($list)
{
$db_pas =db_open("pas_db",0);
$emp_rate_desc = pg_query($db_pas,"select rate_desc  from i_work_def where rate_code =$list");
$emp_arr = pg_fetch_array($emp_rate_desc,0);
$rate_desc = $emp_arr[rate_desc];
echo"$rate_desc";
}
		
$check = isExecutive($ecode);
$ifactor_query = pg_query($db_pas,"select sno,exec_wt,staff_wt  from i_factor");
$num_rows = pg_num_rows($ifactor_query);
for($num=0;$num<$num_rows;$num++){
$weight_arr = pg_fetch_array($ifactor_query,$num);
	$exec_wt = $weight_arr[exec_wt];
	$staff_wt = $weight_arr[staff_wt];
	$sno = $weight_arr[sno];
	if($num==0)
	{
  	if($check)
	$x0 = $exec_wt;
	else
	$x0 =$staff_wt;
	}
	if($num==1)
	{
  	if($check)
        $x1 = $exec_wt;
	else
	$x1 =$staff_wt;
	}
		if($num==2)
		{
			if($check)
			$x2 = $exec_wt;
			else
			$x2 =$staff_wt;
			}
                if($num==3)
		{
	            if($check)
                    $x3 = $exec_wt;
		    else
		    $x3 =$staff_wt;
                    }
        
             if($num==4)
	     {
		     if($check)
		     $x4 = $exec_wt;
		     else
		     $x4 =$staff_wt;
		     }
		     if($num==5)
		     {
			     if($check)
			     $x5 = $exec_wt;
			     else
			     $x5 =$staff_wt;
			     }
			     if($num==6)
	       {
	           if($check)
	            $x6 = $exec_wt;
		    else 
		    $x6 =$staff_wt;
	     }
	     if($num==7)
	     {
            if($check)
	     $x7 = $exec_wt;
	     else
	     $x7 =$staff_wt;
	     }
	    if($num==8)
	     {
	     if($check)
	     $x8 = $exec_wt;
	     else
	     $x8 =$staff_wt;
	     }
	     if($num==9)
	     {
	     if($check)
	     $x9 = $exec_wt;
	     else
	     $x9 =$staff_wt;
	      }
	    if($num==10){
	if($check)
	$x10 = $exec_wt;
	else
	$x10 =$staff_wt;
	}
	if($num==11)
	{
		if($check)
		$x11 = $exec_wt;
		else
		$x11 =$staff_wt;
	}
	if($num==12)
	{
		if($check)
		$x12 = $exec_wt;
		else
		$x12 =$staff_wt;
	}

	}
//echo"<br><br>";
		
echo "<h3> Performance Assessment</h3>
<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
<tr bgcolor='#E5E7E9'><td colspan ='6'><b>Job Performance</b></td></tr>
    <tr>
      <td>Factor(1)</td>
      <td>Weight<br>(2)</td>
      <td>Employee's Rating<br>(3)</td>
      <td>Employee's Weighted Rating<br>(4)=(2)*(3)</td>
      <td>Manager's Rating<br>(5)</td>
      <td>Manager's Weighted Rating<br>(6)=(2)*(5)</td>
    </tr>
    <tr>
      <td>Quality of Work</td>";
      echo"<td> $x0</td>";
     echo "<td>";
     //EmpRateList("rlist1",$emp_sel[0]);
     # echo"$onem"; 
      RateDesc($emp_sel[0]);
     echo"</td>";
      echo"<td>$firstwm</td>";
      
      echo"<td>";
    RateDesc($mgr_sel[0]);  
    echo"</td>
      <td>$mgr_sel_w[0]</td>
      </tr>
      <tr>
      <td>Quantity of Work</td>";
      echo"<td> $x1</td>";
      echo"<td>";
      RateDesc($emp_sel[1]);
         
      echo "</td>";
      echo"<td>$emp_sel_w[1]</td>";
      echo"<td>";
      RateDesc($mgr_sel[1]);
      echo"</td>
      <td>$mgr_sel_w[1]</td>
    </tr>
    <tr>
      <td>Dependability</td>";
      echo"<td> $x2</td>";
      echo"<td>";
      RateDesc($emp_sel[2]);
      echo "</td>";
      echo"<td> $emp_sel_w[2]</td>";
      echo"<td>";
      RateDesc($mgr_sel[2]);
      echo "</td>
      <td>$mgr_sel_w[2]</td>
    </tr>
    <tr>
      <td>Job Knowledge</td>";
      echo"<td> $x3</td>";
      echo"<td>";
      RateDesc($emp_sel[3]);
      echo "</td>
      <td>$emp_sel_w[3]</td>";
      echo"<td>";
      RateDesc($mgr_sel[3]);
      echo"</td>
      <td>$mgr_sel_w[3]</td>";
    echo"</tr>
    <tr>
      <td>Interest, Initiative and
Responsibility
      </td>";
      echo"<td> $x4 </td>";
      echo"<td>";
      RateDesc($emp_sel[4]);
      echo "</td>
      <td>$emp_sel_w[4]</td>";
      echo"<td>";
      RateDesc($mgr_sel[4]);
   
      echo "</td>
      <td>$mgr_sel_w[4]</td>";
     
   echo"</tr>
    <tr>
      <td>Spoken and Written Communication
      </td>";
      echo"<td>$x5</td>";
      echo"<td>";
      RateDesc($emp_sel[5]);
      echo"</td>
      <td>$emp_sel_w[5]</td>
      <td>";
      RateDesc($mgr_sel[5]);
echo "</td>
      <td>$mgr_sel_w[5]</td>
    </tr>
    <tr>
      <td>Discipline and Time Control
      </td>";
      echo"<td>$x6</td>";
      echo"<td>";
      RateDesc($emp_sel[6]);
      echo"</td>
      <td>$emp_sel_w[6]</td>
      <td>";
      RateDesc($mgr_sel[6]);
echo "</td>
<td>$mgr_sel_w[6]</td>
    </tr>
    <tr bgcolor='#E5E7E9'>
      <td colspan=\"6\"><span
 style=\"font-weight: bold;\">Potential Attributes</span>
      </td>
    </tr>
    <tr>
      <td>Creativity, Intelligence and
Mental Calibre
      </td>
      <td>$x7 </td>
      <td>";
      RateDesc($emp_sel[7]);
      echo "</td>
      <td>$emp_sel_w[7]</td>
       <td>";
      RateDesc($mgr_sel[7]);
      echo "</td>
      <td>$mgr_sel_w[7]</td>
      
    </tr>
    <tr>
      <td>Interpersonal Relationships and Adaptability
      </td>
      <td> $x8 </td>
       <td>";
      RateDesc($emp_sel[8]);
       echo "</td>
      <td>$emp_sel_w[8]</td>
      <td>";
      RateDesc($mgr_sel[8]);
echo "</td>
      <td>$mgr_sel_w[8]</td>
    </tr>
    <tr>
      <td>Team Work
      </td>
      <td>$x9 </td>
      <td>";
      RateDesc($emp_sel[9]);
      echo "      </td>
      <td>$emp_sel_w[9]</td>
      <td>";
      RateDesc($mgr_sel[9]);
echo"</td>
      <td>$mgr_sel_w[9]</td>
    </tr>
    <tr>
      <td>Leadership
      </td>
      <td> $x10 </td>
      <td>";
      RateDesc($emp_sel[10]);
      echo "</td>
      <td>$emp_sel_w[10]</td>
      
<td>";
      RateDesc($mgr_sel[10]);
echo "      </td>
      <td>$mgr_sel_w[10]</td>
 
    </tr>
    <tr>
      <td>Planning and Organizing
      </td>
      <td> $x11</td>
      <td>";
      RateDesc($emp_sel[11]);
      echo "</td>
      <td>$emp_sel_w[11]</td>
      <td>";
      RateDesc($mgr_sel[11]);
echo "</td>
      <td>$mgr_sel_w[11]</td>
    
    </tr>
    <tr>
      <td>Total Score
      </td>
      <td></td>
      <td>&nbsp;</td>
      <td>$emp_total</td>
      <td>&nbsp;</td>
      <td>$mgr_total</td>
    </tr>
  </tbody>
</table>
<span style=\"font-weight: bold;\">";
//echo"<br>";
echo"<center>";
echo"<INPUT type=\"hidden\" name=\"ecode\" value=\"$ecode\" >";
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\" >";
//echo"<INPUT type=\"hidden\" name=\"meet_to\" value=\"$meet_to\" >";
//echo"<INPUT type=\"hidden\" name=\"pk_sl\" value=\"$pk_sl\" >";
echo"</center>";
//echo"</form>";
//echo "</body></html>";
echo "<h3>Overall Assessment</h3>



<table style=\"width: 98%; text-align: left;\" border=\"1\">
  <tbody>
   <tr bgcolor='#E5E7E9'>
   <td colspan=\"2\" style=\"vertical-align: top; font-weight: bold;\" width=\"35%\">Overall
   Rating</td>
   <td style=\"vertical-align: top; font-weight: bold;\">Manager's Comments</td>
      <td style=\"vertical-align: top; font-weight: bold;\">Employee's Comments</td>
     </tr>
         <tr>";
     if($over_rate == 'first_r')
     {
     echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"first_r\" checked disabled> </td>";
    echo"<td>Not Acceptable &lt;55</td>";
       
    echo"<td rowspan=\"6\">$pa_mgr_comm</td>
     <td rowspan=\"6\">$pa_emp_comm</td>";
    }     
    echo"</tr>";
     echo"<tr>";
	 if($over_rate == 'second_r')
	 {
	 echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"second_r\" checked  disabled></td>";
	 echo"<td>Average 55 - 64</td> ";
        echo"<td rowspan=\"6\">$pa_mgr_comm</td>
        <td rowspan=\"6\">$pa_emp_comm</td>";
	 }
	 echo"</tr><tr>";
	 if($over_rate == 'third_r')
	 {
	 echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"third_r\" checked  disabled></td>";
      echo"<td style=>Good 65 - 74</td>";
        echo"<td rowspan=\"6\">$pa_mgr_comm</td>
        <td rowspan=\"6\">$pa_emp_comm</td>";
      }
echo"</tr>";
echo"<tr>";
	 if($over_rate == 'four_r')
	 {
	 echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"four_r\" checked disabled > </td>";
echo"<td>Very Good 75 - 84</td>";
        echo"<td rowspan=\"6\">$pa_mgr_comm</td>
        <td rowspan=\"6\">$pa_emp_comm</td>";
}
echo"</tr>";
echo"<tr>";
if($over_rate == 'five_r')
{  
 echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"five_r\" checked  disabled></td>";
 echo"<td>Excellent &gt;= 85</td>";
        echo"<td rowspan=\"6\">$pa_mgr_comm</td>
        <td rowspan=\"6\">$pa_emp_comm</td>";
}
 echo"</tr>
</tbody>
</table> ";

echo"<br>";
echo"<table width = \"98%\">
   <tr>
<td width = \"35%\">Employee's Confirmation:</td>";
if($emp_final)
echo"<td><INPUT type=\"checkbox\" name=\"emp_final\" value = \"emp_final\" checked disabled></td>";
//else
//echo"<td><INPUT type=\"checkbox\" name=\"emp_final\" value = \"emp_final\" ></td>";

echo"<td>Manager's Confirmation:</td>";
if($man_final)
echo"<td><INPUT type=\"checkbox\" name=\"man_final\" value = \"man_final\" checked disabled></td>";
//else
//echo"<td><INPUT type=\"checkbox\" name=\"man_final\" value = \"man_final\" ></td>";
echo"</tr>
<tr>
<td>Employee's Confirmation Date (dd-mm-yyyy):</td>
<td>$emp_date_fi[2]-$emp_date_fi[1]-$emp_date_fi[0]</td>
<td>Manager's Confirmation Date (dd-mm-yyyy):</td>
<td>$mgr_date_fi[2]-$mgr_date_fi[1]-$mgr_date_fi[0]</td>
</tr>
   </table>";

?>
<?
//include_once "../tsutils.php";
//include_once "pasutils.php";
//$db_conn = db_open("offproj",0);
$ecode = $meet_to;
//$db_pas = db_open("pas_db");

$ecode_gen = EcodeEnteredFromEcode($ecode);
$emp_name = EmpNameFromEmpCode($ecode);

echo "<html>";
/*<head>
<script language=\"JavaScript\" type = \"text/javascript\">
      function insert()
      {
      document.f1.action = \"PA_appr_insert_lower.php\";
      }
</script>
<title>Performance Appraisal Form</title>
</head>
<body bgcolor=\"#CDE1EB\">";
/*Function EmpRateList($rlist)
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
	}*/
$tpa_q = pg_query($db_pas,"select train_prog,f_date,t_date,rem from pa_tpa where pk_sl = $pk_sln");
$tpa_num = pg_num_rows($tpa_q);
if($tpa_num>0)
 {
echo "
<h3>Training Programmes attended during the Review Period</h3>
<table style=\"width: 98%; text-align: left;\" border=\"1\">
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
echo "</tbody></table>";
}
###############################################
$sa_q = pg_query($db_pas,"select skill,level from pa_sa where pk_sl = $pk_sln");
$sa_num = pg_num_rows($sa_q);
if($sa_num>0)
 {

echo "<h3>Skills Acquired</h3>";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\">
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
echo "</tbody></table>";
}
###################################

$da_q = pg_query($db_pas,"select domain,level from pa_dea where pk_sl = $pk_sln");
$da_num = pg_num_rows($da_q);
if($da_num>0)
 {

echo "<h3>Domain Expertise Acquired</h3>";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    <tr><td>Sl No</td><td>Domain Expertise Area (Technology, Business, Industry etc)</td><td>Level (1=&gt; Low 5=&gt; high)</td></tr>";

 for($i=0;$i<$da_num;$i++)
  {   
$da_f = pg_fetch_array($da_q,$i);
   $da_i = $i+1;
    $d_domain = trim($da_f[domain]);
    $d_domain = stripslashes($d_domain);
    $d_level = $da_f[level];
  echo "<tr><td>$da_i</td><td>$d_domain</td><td>$d_level</td></tr>";
}   
echo "</tbody></table>";
}
###########################################

//added by Ankur on 3rd feb 2006

//Additional information provided

$add_q = pg_query($db_pas,"select info from pa_add_info where pk_sl = $pk_sln");
$add_num = pg_num_rows($add_q);
$add_arr = pg_fetch_array($add_q);
$add_info = $add_arr[info];
if($add_num >0 )
{
echo "<h3>Additional Information</h3>";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    <tr><td>$add_info</td></tr></tbody></table>";

}


#########################################


echo "<h3>Training and Development Needs</h3>
<table style=\"width: 98%; text-align: left;\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">
  <tbody>
    <tr bgcolor='#E5E7E9'>
    <td>Sl No </td> <td>Area </td> <td>Employee's Comments </td> <td>Manager's Comments </td>
    </tr>";
     $pnp_qq = pg_query($db_pas,"select * from pa_tdn where pk_sl = $pk_sln");
     $tdnrows = pg_num_rows($pnp_qq);
     if(!$tdnrows) $tdnrows = 4;
for($k=0;$k<$tdnrows;$k++)
{
     $slno = $k+1;
     $tdn_q = pg_query($db_pas,"select area,emp_com,mgr_com from pa_tdn where pk_sl = $pk_sln and slno=$slno");
     $tdn_fetch = pg_fetch_array($tdn_q,0);
     $area_d = $tdn_fetch[area];
     $area_d =stripslashes($area_d);
     $trn_comments = trim($tdn_fetch[emp_com]);
     $trn_comments = stripslashes($trn_comments);
     $trnmn_comments =trim($tdn_fetch[mgr_com]);
    $trnmn_comments = stripslashes($trnmn_comments);
     echo "<tr >
      <td>$slno</td>
      <td>$area_d</td>
      <td>$trn_comments</td>
      <td>$trnmn_comments</td>";
      echo "</tr>";
      }
    
  echo"</tbody></table>";

echo "<h3>Projects/Assignments for the Next Period</h3>
<table style=\"width: 98%; text-align: left;\" border=\"1\" cellpadding=\"2\"
 cellspacing=\"2\">
  <tbody>
    <tr bgcolor='#E5E7E9'>
      <td>Sl No</td><td>Tasks/Targets</td><td>Employee's Comments </td> <td>Manager's Comments</td>
    </tr>";
     $pnp_qq = pg_query($db_pas,"select oid from pa_pnp where pk_sl = $pk_sln");
     $norows = pg_num_rows($pnp_qq);
     if(!$norows) $norows = 4; 
 for($kk=0;$kk<$norows;$kk++)
{
     $slno1 = $kk+1;
     $pnp_q = pg_query($db_pas,"select tasks,emp_com,mgr_com from pa_pnp where pk_sl = $pk_sln and slno=$slno1");
     $pnp_fetch = pg_fetch_array($pnp_q,0);
     $task_d = trim($pnp_fetch[tasks]);
     $task_d = stripslashes($task_d);
     $emp_comments = trim($pnp_fetch[emp_com]);
     $emp_comments = stripslashes($emp_comments);
     $man_comments = trim($pnp_fetch[mgr_com]);
     $man_comments = stripslashes($man_comments);
    echo "<tr>
      <td>$slno1</td>
      <td>$task_d</td>
      <td>$emp_comments</td>
      <td>$man_comments</td>";
      echo "</tr>";
      }
   
  echo"</tbody></table><br>";


##############Project Part###########################
##################################Training attended

###################################
//echo "<center><INPUT type=\"submit\" name=\"sub_scr\" value=\"Ok\" onClick=\"cprocess() \"></center>";
echo "</form>";
echo "</body></html>";
?>
