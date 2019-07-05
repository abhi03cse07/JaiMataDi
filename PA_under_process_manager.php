<!--
  Modified By akila on 9-Apr-2007
-->

<html>
<body bgcolor = "#CDE1EB">
<!--//<form  method="POST">-->
<?
include_once "../tsutils.php";
include_once "pasutils.php";
error_reporting(E_ERROR);
$db_conn= db_open("offproj",0);
$db_pas= db_open("pas_db",0);
$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$cur_year =$key_arr[year];
$cur_qtr =$key_arr[qtr];

// added by Akila on 4 april 2007 ********************************************
   $emp_enter= pg_query($db_conn,"select emp_code_entered from emp_code_gen where emp_code = $ecode");
   $ec=pg_fetch_array($emp_enter,0);
   $ec_num=$ec[emp_code_entered];
   $hr_emp=pg_query($db_conn,"select * from bu_master where hr_partner=$ec_num");
   $num_hr = pg_num_rows($hr_emp);
//****************************************************************************

$rep_up=pg_query($db_pas,"select emp_code,pk_sl from pa_lock where emp_rate = true and mgr_rate =true and  year = $year and qtr= $qtr and rm_comm is null");
$no_uprows = pg_num_rows($rep_up);
$j=0;
for($u=0;$u<$no_uprows;$u++)
{
	$rep_up_arr = pg_fetch_array($rep_up,$u);
	$empcodeup[$u]  = $rep_up_arr[emp_code];
        $ecode_gen = EcodeEnteredFromEcode($empcodeup[$u]);
        $rep_off_up  = pg_query($db_conn,"(select emp_name,emp_code from emp_master where reportsto=$ecode and emp_code =$empcodeup[$u] and left_date is null)union( select emp_name,emp_code from emp_master where bu_code in(select bu_code from bu_master where hr_partner=$ec_num)and  emp_code = $empcodeup[$u] and emp_code!=$ecode and left_date is null)");
$num_rep=pg_numrows($rep_off_up);
        if($num_rep)
         {
         	$egenar[$j] = $ecode_gen;
         	$repemp_up_arr = pg_fetch_array($rep_off_up,0);
	 	$emp_name_up[$j] = $repemp_up_arr['emp_name'];
	 	$empcodecp[$j]= $repemp_up_arr['emp_code'];
         	$pk_sl[$j] = $rep_up_arr[pk_sl];
         	$j++;
         }
}

echo"<h5><center> Meeting Pending:&nbsp;$j</center></h5><hr>";
echo"<table width=\"100%\">";     
echo"<tr><td width=\"35%\"><b>No.</b></td><td width=\"65%\"><b>Name</b> </td></tr>";

for($up=0;$up<$j;$up++)
{
$pk_sln=$pk_sl[$up];
$colr="black";

	if($cur_qtr==$qtr&& $cur_year==$year)
	{
		$rep_flag_exe  = pg_query($db_pas,"select appr_flag from appr_system where emp_code =$egenar[$up]");
		$rep_flag_arr = pg_fetch_array($rep_flag_exe,0);
        	$rep_flag=trim($rep_flag_arr[appr_flag]);
       // changes made by ankur on 15 nov 2005  
	        if($rep_flag=='R')
        		$colr="red";
                if($rep_flag=='S')
        		$colr="green";
                if($rep_flag=='B')
        		$colr="blue";
	}
echo"<tr><td><font color= $colr >$egenar[$up] </font></td><td><a href=\"PA_meeting_pending.php?meet_to=$empcodecp[$up]&keychk=$keychk&pk_sln=$pk_sln&year=$year&qtr_com=$qtr_com\" target=\"BLANK\"><font color=$colr>$emp_name_up[$up] </font></a></td></tr>";

}
echo"</table>";
echo"<input type = \"hidden\" name = \"keychk\" value=\"$keychk\">";	
//echo"</form>";
?>
</body>
</html>

