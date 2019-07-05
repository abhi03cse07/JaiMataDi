<!--
     Modified By akila on 4-Apr-2007 for BU Head as Review Manager
-->

<html>
<head>
</head>
<form action ="PA_main_menu.php" method="POST">
<?php
error_reporting(0);
include_once('head.php');
//include_once "../tsutils.php";
include_once "pasutils.php";
//error_reporting(E_ERROR);



if($rep_flag != 1)                      //added on Jul 7 2008 for self appraisal report of individual to HR
{
 if (!CheckAuthKey ($keychk))
   {
      Error ("Login");
      exit;
   }
}
$db_conn = db_open("offproj",0);
$db_pas = db_open("pas_db",0);


//print_r($_POST);

######Saving in the database############################
$ecode = $emp_code;
$rgetname = pg_query($db_pas,"select emp_code from emp_master where reportsto=$ecode");
$name = $pg_num_rows[rgetname];

if($rep_flag !=1)                //added july 3 2008
{
   $get_key = pg_query($db_pas,"select qtr,year from pa_init");
   $key_arr = pg_fetch_array($get_key,0);
   $year =$key_arr[year];
   $qtr =$key_arr[qtr];
}
        
$emp_name_disp = EmpNameFromEmpCode($ecode);
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
$emp_info_q = pg_query($db_pas,"select dept,loc,dojg from pa_emp_info where pk_sl = $pk_sln"); 
$emp_info_fetch = pg_fetch_array($emp_info_q,0);
$dept_f = $emp_info_fetch[dept];
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
$desg_d = $emp_fetch[designation];
$desg_q = pg_query($db_conn,"select desg_desc from designation where desg_code = '$desg_d'");
$desg_fetch = pg_fetch_array($desg_q,0);
$desg_get = trim($desg_fetch[desg_desc]);
$report_code = ReportingHead($ecode);
$report_h = EmpNameFromEmpCode($report_code);

//Modified By Akila on 4-apr-2007 for Calling a new function for Review Manager
$rev_code=GetReviewManager($ecode);
$rev_man = EmpNameFromEmpCode($rev_code);
$dob_q = pg_query($db_conn,"select birthdate from dob where eno = $ecode");
$dob_fetch = pg_fetch_array($dob_q,0);
$dob = trim($dob_fetch[birthdate]);
$dob_arr = explode('-',$dob);
$dob=$dob_arr[2].'-'.$dob_arr[1].'-'.$dob_arr[0];
$sal_due_q = pg_query($db_pas,"select sr_due from salary_due where eno = $ecode");
$sal_fetch = pg_fetch_array($sal_due_q,0);
$sal_due = trim($sal_fetch[sr_due]);
$sal_arr = explode('-',$sal_due);
$sal_due=$sal_arr[2].'-'.$sal_arr[1].'-'.$sal_arr[0];
$res_func=pg_query($db_conn, "SELECT func_name FROM func_master,emp_master WHERE  emp_master.emp_code=$ecode AND emp_master.func=func_master.func_id");
$res_func_fetch = pg_fetch_array($res_func,0);
$res_func_name = $res_func_fetch[func_name];

//Added Jul 3 2008
if($rep_flag != 1)
{
$res_year = pg_query($db_pas, "SELECT year FROM pa_init");
$res_fetch = pg_fetch_array($res_year);
$cur_year = $res_fetch[year];
}
else
{
$cur_year=$year;
}

echo"<title>Performance Appraisal Form</title></head>";
echo"<br>
<span style='font-weight:bold'>&nbsp;&nbsp;&nbsp;Appraisal Period:</span>
<center><table style=\"width: 98%; text-align: left;\" border=\"0\"><tr><td>Year:&nbsp;&nbsp;$cur_year</td><td>Period:&nbsp;&nbsp;";

if($rep_flag != 1)                     //Added on Jul 3 2008
{
   period();
}
else
{
      echo $qtr_com;
}

echo"</td></tr></table></center><br>
<span style='font-weight:bold'>&nbsp;&nbsp;&nbsp;Employee Information</span>";
echo "<center><table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    <tr>
      <td>Employee Number</td> <td>$ecode_gen</td>
      <td> Name </td> <td >$emp_name</td>
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
   $proj_det_q = pg_query($db_pas,"select proj,task,mgr_comm,proj_com  from pa_emp_proj where pk_sl = $pk_sln and slno = $sl_get");
   $proj_det_f = pg_fetch_array($proj_det_q,0);
   $proj_a = trim($proj_det_f[proj]);
   $proj_a = stripslashes($proj_a);
   //$proj_a  
   $task_a = trim($proj_det_f[task]);
   $task_a = stripslashes($task_a);
   $mgr_com = trim($proj_det_f[mgr_comm]);
    $mgr_com = stripslashes($mgr_com);
   $proj_com = trim($proj_det_f[proj_com]);
    $proj_com = stripslashes($proj_com);
  echo "  <br><span style='font-weight:bold'>&nbsp;&nbsp;&nbsp;Projects/Assignments carried out during the Review Period</span>";

  echo "<center><table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody><tr>
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
  echo "</tbody></table></center>";
}  //end for


##################################Training attended
$tpa_q = pg_query($db_pas,"select train_prog,f_date,t_date,rem from pa_tpa where pk_sl = $pk_sln");
$tpa_num = pg_num_rows($tpa_q);
if($tpa_num>0)
 {
	echo "<br><span style='font-weight:bold'>&nbsp;&nbsp;&nbsp;Training Programmes attended during the Review Period</span>
	<center><table style=\"width: 98%; text-align: left;\" border=\"1\">
        <tbody>
        <tr><td>Sl No</td><td>Training Programme</td><td>From Date (dd-mm-yyyy)</td><td>To Date (dd-mm-yyyy)</td><td>Remarks</td>
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

	echo "<br><span style='font-weight:bold'>&nbsp;&nbsp;&nbsp;Skills Acquired</span>";
	echo "<center><table style=\"width: 98%; text-align: left;\" border=\"1\">
  	<tbody>
  	<tr><td>Sl No</td><td>Skill (Platform, Tool, Language etc)</td><td>Level (1=&gt; Low 5=&gt; high)</td></tr>";

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
	echo "<br><span style='font-weight:bold'>&nbsp;&nbsp;&nbsp;Domain Expertise Acquired</span>";
	echo "<center><table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
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
	echo "</tbody></table></center>";
}


######################################
//added by Ankur on 3rd feb 2006

//Additional information provided

$add_q = pg_query($db_pas,"select info from pa_add_info where pk_sl = $pk_sln");
$add_num = pg_num_rows($add_q);
$add_arr = pg_fetch_array($add_q);
$add_info = $add_arr[info];
if($add_num>0 )
{
	echo "<h4>Additional Information</h4>";
	echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    	<tr><td>$add_info</td></tr></tbody></table>";
}

########################################
###################################

#print_r($_POST);
//include_once "../tsutils.php";
//include_once "pasutils.php";
$ecode = $emp_code;
error_reporting(E_ERROR);
$db_conn = db_open("offproj",0);

$ecode_gen = EcodeEnteredFromEcode($ecode);
$emp_name = EmpNameFromEmpCode($ecode);
$db_pas = db_open("pas_db",0);
//$result_key = pg_query($db_pas,"select pk_sl from pa_lock where emp_code = $ecode and year = 2005 and qtr = 1 and mgr_rate = false");
$result_key = pg_query($db_pas,"select pk_sl from pa_lock where emp_code = $ecode and year =$year and qtr =$qtr and emp_rate=true and emp_proj=true");
$res_arr = pg_fetch_array($result_key,0);
$pk_sl =$res_arr[pk_sl];
echo"<body style = 'background-color:#CDE1EB !important;'>";
//echo "<table><tr><td width = \"60%\">Employee Code: $ecode_gen </td><td>Employee Name: $emp_name</td></tr></table>";
$emp_arr = pg_query($db_pas,"select emp_final_date,mgr_final_date,over_rate,emp_final,man_final,pa_mgr_com,pa_emp_com,emp_rate,emp_rate_w,mgr_rate,mgr_rate_w,emp_total,mgr_total from pa_assess where pk_sl = $pk_sl");
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
//$emp_sel_w[11] = (int)$emp_sel_w[11];
$mgr_sel_w[11] =  substr_replace($mgr_sel_w[11],' ',strlen($mgr_sel_w[11])-1,1);
//$mgr_sel_w[11] = (int)$mgr_sel_w[11];
$mgr_sel[0] =  substr_replace($mgr_sel[0],' ',0,-1);
$mgr_sel[0] = (int)$mgr_sel[0];
$mgr_sel[11] =  substr_replace($mgr_sel[11],' ',strlen($mgr_sel[11])-1,1);
$mgr_sel[11] = (int)$mgr_sel[11];
$mgr_sel_w[0] =  substr_replace($mgr_sel_w[0],' ',0,1);
//$mgr_sel_w[0] = (int)$mgr_sel_w[0];
Function EmpRateList($rlist,$listm)
{
	$db_pas = db_open("pas_db",0);
	$emp_rate = pg_query($db_pas,"select rate_code,rate_desc  from i_work_def");
	$num_rows = pg_num_rows($emp_rate);
		
	echo"<select name = $rlist onChange = \"fact()\">";
	echo"<option></option>";
	for($num=0;$num<$num_rows;$num++)
                {
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
$db_pas = db_open("pas_db");
$ifactor_query = pg_query($db_pas,"select sno,exec_wt,staff_wt  from i_factor");
$num_rows = pg_num_rows($ifactor_query);
for($num=0;$num<$num_rows;$num++)
{
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
	if($num==10)
        {
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
		
echo "<span style='font-weight:bold'> <center>Performance Assessment </center></span>
<center><table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>

    <tr>
      <td>Factor<br>(1)</td>
      <td>Weight<br>(2)</td>
      <td>Employee's Rating<br>(3)</td>
      <td>Employee's Weighted Rating<br>(4)=(2)*(3)</td>
    </tr>
    
	<tr>
      <td>Quality of Work</td>";
      echo"<td><input type=\"text\" name =\"first\" value = $x0 size = 4 disabled></td>";
     echo "<td>";
    // EmpRateList("rlist1",$emp_sel[0]);
     
    RateDesc($emp_sel[0]);
    # echo"$onem"; 
      
     echo"</td>";
      echo"<td><input type=\"text\" name =\"firstw\"  value =\"$firstwm\" size = 4 disabled  ></td> </tr>";
      
      echo" <tr>
      <td>Quantity of Work</td>";
      echo"<td><input type=\"text\" name =\"second\" value = $x1 size = 4 disabled></td>";
      echo"<td>";
     //EmpRateList("rlist2",$emp_sel[1]);
    RateDesc($emp_sel[1]);
     //  EmpRateList("rlist2");
      #echo"$twom";
      echo "</td>";
      echo"<td><input type=\"text\" name =\"secondw\"  value = \"$emp_sel_w[1]\" size = 4 disabled></td>
    </tr>
    
	<tr>
      <td>Dependability</td>";
      echo"<td><input type=\"text\" name =\"third\" value = $x2 size = 4 disabled></td>";
      echo"<td>";
       //EmpRateList("rlist3",$emp_sel[2]);
       RateDesc($emp_sel[2]);
       #echo"$threem";
      echo "</td>";
      echo"<td><input type=\"text\" name =\"thirdw\"  value = $emp_sel_w[2]  size = 4  disabled></td>";
      echo"
    </tr>
    <tr>
      <td>Job Knowledge</td>";
      echo"<td><input type=\"text\" name =\"four\" value = $x3 size = 4 disabled></td>";
      echo"<td>";
       RateDesc($emp_sel[3]);
       #echo"$fourm";
      echo "</td>
      <td><input type=\"text\" name =\"fourw\"  value = \"$emp_sel_w[3]\" size = 4  disabled ></td>";
      echo"";
    echo"</tr>
    <tr>
      <td>Interest, Initiative and
Responsibility
      </td>";
      echo"<td><input type=\"text\" name =\"five\" value = $x4 size = 4 disabled></td>";
      echo"<td>";
       RateDesc($emp_sel[4]);
       # echo"$fivem";
      echo "</td><td>
      <input type=\"text\" name =\"fivew\"  value = \"$emp_sel_w[4]\"  size = 4 disabled></td>";
     
   echo"</tr>
    <tr>
      <td>Spoken and Written Communication
      </td>";
      echo"<td><input type=\"text\" name =\"six\" value = $x5 size = 4 disabled></td>";
      echo"<td>";
       RateDesc($emp_sel[5]);
       #echo"$sixm";
      echo"</td>
      <td><input type=\"text\" name =\"sixw\"  value = \"$emp_sel_w[5]\" size = 4  disabled ></td>
     
    </tr>
    <tr>
      <td>Discipline and Time Control
      </td>";
      echo"<td><input type=\"text\" name =\"seven\" value = $x6 size = 4 disabled></td>";
      echo"<td>";
       RateDesc($emp_sel[6]);
       # echo"$sevenm"; 
      echo"</td>
      <td><input type=\"text\" name =\"sevenw\"  value =\"$emp_sel_w[6]\" size = 4 disabled ></td>
      
    </tr>
    <tr>
      <td colspan=\"5\"><span
 style=\"font-weight: bold;\">Potential Attributes</span>
      </td>
    </tr>
    <tr>
      <td>Creativity, Intelligence and
Mental Calibre
      </td>
      <td><input type=\"text\" name =\"eight\" value = $x7 size = 4 disabled></td>
      <td>";
        RateDesc($emp_sel[7]);
	#echo"$eightm";
      echo "</td>
      <td><input type=\"text\" name =\"eightw\"  value = \"$emp_sel_w[7]\" size = 4  disabled></td>
     
      
    </tr>
    <tr>
      <td>Interpersonal Relationships and
Adaptability
      </td>
      <td><input type=\"text\" name =\"nine\" value = $x8 size = 4 disabled></td>
       <td>";
       RateDesc($emp_sel[8]);
       # echo"$ninem";
       echo "</td>
      <td><input type=\"text\" name =\"ninew\"  value = \"$emp_sel_w[8]\" size = 4  disabled></td>
		
    </tr>
    <tr>
      <td>Team Work
      </td>
      <td><input type=\"text\" name =\"ten\" value = $x9 size = 4  disabled></td>
      <td>";
       RateDesc($emp_sel[9]);
       #echo"$tenm";
      echo "      </td>
      <td><input type=\"text\" name =\"tenw\" value =\"$emp_sel_w[9]\" size = 4 disabled  ></td>
      
    </tr>
    <tr>
      <td>Leadership
      </td>
      <td><input type=\"text\" name =\"eleven\" value = $x10 size = 4  disabled></td>
      <td>";
      RateDesc($emp_sel[10]);
      # echo"$elevenm";
      echo "</td>
      <td><input type=\"text\" name =\"elevenw\" value =\"$emp_sel_w[10]\"  size = 4 disabled ></td>
      

 
    </tr>
    <tr>
      <td>Planning and Organizing
      </td>
      <td><input type=\"text\" name =\"twelve\" value = $x11 size = 4 disabled></td>
      <td>";
      RateDesc($emp_sel[11]);
      echo "</td>
      <td><input type=\"text\" name =\"twelvew\"  value = \"$emp_sel_w[11]\" size = 4 disabled></td>
      
    
    </tr>
    <tr>
      <td>Total Score
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input type=\"text\" name = \"totm\" value = \"$emp_total\"  size = 4 disabled></td>
    </tr>
  </tbody>
</table></center>
<span style=\"font-weight: bold;\">";
echo"<br>";
/*echo "Overall Assessment
<br><br>
<table style=\"width: 98%; text-align: left;\" border=\"1\">
  <tbody>
   <tr>
   <td colspan=\"2\" style=\"vertical-align: top; font-weight: bold;\" width=\"35%\">Overall
   Rating</td>
   <td style=\"vertical-align: top; font-weight: bold;\">Manager's Comments</td>
      <td style=\"vertical-align: top; font-weight: bold;\">Employee's Comments</td>
     </tr>
         <tr>";
	 if($over_rate == 'first_r')
       echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"$first_r\" checked > </td>";
       else
       echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"first_r\"> </td>";
       echo"<td>Not Acceptable &lt;55</td>
      <td rowspan=\"6\"><textarea rows = \"20\" cols =\"40\" name =\"pa_mgr_comm\" >$pa_mgr_comm</textarea></td>
     <td rowspan=\"6\"><textarea rows = \"20\" cols =\"40\" name =\"pa_emp_comm\" >$pa_emp_comm</textarea></td>
  </tr>
         </tr>
     <tr>";
	 if($over_rate == 'second_r')
         echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"$second_r\" checked ></td>";
         else
         echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"second_r\"  ></td>";
	 
      	 echo"<td>Average 55 - 64</td>
</tr> <tr>";
	 if($over_rate == 'third_r')
echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"$third_r\" checked ></td>";
else
echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"third_r\" ></td>";

echo"<td style=>Good 65 - 74</td> </tr>
<tr>";
	 if($over_rate == 'four_r')
 echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"$four_r\" checked > </td>";
 else
 echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"four_r\" ></td>";
echo"<td>Very Good 75 - 84</td>
</tr>
<tr>";
	 if($over_rate == 'five_r')
echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"five_r\" checked ></td>";
else
echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"five_r\" ></td>";

echo"<td>Excellent &gt;= 84</td>
</tr>
</tbody>
</table> ";
echo"<br><br>";
echo"<table width = \"100%\">
   <tr>
<td width = \"35%\">Employee's Confirmation:</td>";
if($emp_final)
echo"<td><INPUT type=\"checkbox\" name=\"emp_final\" value = \"emp_final\" checked></td>";
else
echo"<td><INPUT type=\"checkbox\" name=\"emp_final\" value = \"emp_final\" ></td>";

echo"<td>Manager's Confirmation:</td>";
if($man_final)
echo"<td><INPUT type=\"checkbox\" name=\"man_final\" value = \"man_final\" checked></td>";
else
echo"<td><INPUT type=\"checkbox\" name=\"man_final\" value = \"man_final\" ></td>";
echo"</tr>
<tr>
<td>Employee's Confirmation Date:</td>
<td><INPUT type=\"text\" name=\"emp_dd\" value = \"$emp_date_fi[2]\" size = 2>
<INPUT type=\"text\" name=\"emp_mm\" value = \"$emp_date_fi[1]\" size = 2>
<INPUT type=\"text\" name=\"emp_yy\" value = \"$emp_date_fi[0]\" size = 3></td>
<td>Manager's Confirmation Date:</td>
<td><INPUT type=\"text\" name=\"man_dd\" value = \"$mgr_date_fi[2]\" size = 2></td>
<td><INPUT type=\"text\" name=\"man_mm\" value = \"$mgr_date_fi[1]\"  size = 2></td>
<td><INPUT type=\"text\" name=\"man_yy\" value = \"$mgr_date_fi[0]\" size = 3></td>
</tr>
   </table>";
echo"<br><br>";
echo"<center>";
echo"<INPUT type=\"hidden\" name=\"ecode\" value=\"$ecode\" >";
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\" >";
echo"<INPUT type=\"hidden\" name=\"appr_to\" value=\"$appr_to\" >";
echo"<INPUT type=\"hidden\" name=\"pk_sl\" value=\"$pk_sl\" >";
echo"<INPUT type=\"submit\" name=\"next_scr\" value=\"Submit\" >";
echo"</center>";*/
//echo"<center><input type = \"Submit\" name =\"sb1\" value = \"Exit\" onClick= \"exit()\"></center>";

echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\" >";
echo"<INPUT type=\"hidden\" name=\"login\" value=\"$login\" >";
?>
</form>
</body>
</html>
