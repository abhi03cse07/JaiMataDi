<!--
    Modified By Akila for BU head Changes 
-->

<html>
<body bgcolor = "#CDE1EB">
<?
include_once "../tsutils.php";
include_once "pasutils.php";
error_reporting(E_ERROR);
$db_pas=db_open("pas_db",0);
$db_conn=db_open("offproj",0);

// added by Akila on 4 april 2007 ********************************************

   $emp_enter= pg_query($db_conn,"select emp_code_entered from emp_code_gen where emp_code = $ecode");
   $ec=pg_fetch_array($emp_enter,0);
   $ec_num=$ec[emp_code_entered];
   $hr_emp=pg_query($db_conn,"select * from bu_master where hr_partner=$ec_num");
   $num_hr = pg_num_rows($hr_emp);

//****************************************************************************

$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$cur_year =$key_arr[year];
$cur_qtr =$key_arr[qtr];

$rep_com  = pg_query($db_pas,"select emp_code,pk_sl from pa_lock where mgr_rate = true and emp_rate =true and rm_comm=true and year=$year and qtr=$qtr");
$norows = pg_num_rows($rep_com);

$j=0;
for($u=0;$u<$norows;$u++)
{
        $rep_up_arr = pg_fetch_array($rep_com,$u);
        $empcodeup[$u]  = $rep_up_arr[emp_code];
        $ecode_gen = EcodeEnteredFromEcode($empcodeup[$u]);
        $rep_hr  = pg_query($db_conn,"(select emp_name,emp_code from emp_master where reportsto=$ecode and emp_code =$empcodeup[$u] and left_date is null)union( select emp_name,emp_code from emp_master where bu_code in(select bu_code from bu_master where hr_partner=$ec_num)and  emp_code =$empcodeup[$u] and emp_code!=$ecode and left_date is null)");
	$num_rep=pg_numrows($rep_hr);
        if($num_rep)
         {
        	$egenar[$j] = $ecode_gen;
               	$repemp_up_arr = pg_fetch_array($rep_hr,0);
         	$emp_name_up[$j] = $repemp_up_arr['emp_name'];
         	$empcodecp[$j]= $repemp_up_arr['emp_code'];
         	$pk_sl[$j] = $rep_up_arr[pk_sl];
         	$j++;
         }

}

echo"<tr><td><h5><center>Meeting Completed:&nbsp;$j</center></h5></td></tr><hr>";
echo"<table width=\"100%\">";
echo"<tr><td width=\"35%\"><b>No.</b></td><td width=\"65%\"><b>Name</b> </td></tr>";

for($i=0;$i<$j;$i++)
{
	$pk_sln=$pk_sl[$i];
	$emp_name = $emp_name_up[$i];
        
 // changes made by ankur on 16 nov 2005
       $colr="black";   

	if($cur_qtr==$qtr&& $cur_year==$year)
	{
 		$rep_flag_exe  = pg_query($db_pas,"select appr_flag from appr_system where emp_code =$egenar[$i]");
        	$rep_flag_arr = pg_fetch_array($rep_flag_exe,0);
        	$rep_flag=trim($rep_flag_arr[appr_flag]);
        	if($rep_flag=='R')
       			 $colr="red";
	        if($rep_flag=='S')
        		$colr="green";
	        if($rep_flag=='B')
        		$colr="blue";
	}
echo"<tr><td><font color= $colr> $egenar[$i]</font></td><td><a href=\"PA_complete_report.php?EMP_ID=$egenar[$i]&meet_to=$empcodecp[$i]&keychk=$keychk&pk_sln=$pk_sln&year=$year&qtr_com=$qtr_com\" target=\"BLANK\"><font color = $colr> $emp_name</a></font></td></tr>";
}
?>	
</table>
</body>
</html>

