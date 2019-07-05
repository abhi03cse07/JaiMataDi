<!--
  Modified By Akila for BU Wise Report on 9-Apr-2007
-->
<html>
<body bgcolor = "#CDE1EB">
<?
include_once "../tsutils.php";
include_once "pasutils.php";
error_reporting(E_ERROR);
$db_pas=db_open("pas_db",0);
$db_conn=db_open("offproj",0);
$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$cur_year =$key_arr[year];
$cur_qtr =$key_arr[qtr];

$rep_com  = pg_query($db_pas,"select emp_code,pk_sl from pa_lock where mgr_rate = true and emp_rate =true and rm_comm=true and year=$year and qtr=$qtr");
$norows = pg_num_rows($rep_com);
$t=0;
for($u=0;$u<$norows;$u++)
{
        $rep_up_arr = pg_fetch_array($rep_com,$u);
        $empcodeup[$u]  = $rep_up_arr[emp_code];
        $ecode_gen = EcodeEnteredFromEcode($empcodeup[$u]);
        $pk_sl[$u]  = $rep_up_arr[pk_sl];
        $check=pg_query($db_conn,"select * from emp_master where emp_code=$empcodeup[$u]");
        $c_r=pg_fetch_array($check,0);
        $b=$c_r[bu_code];
        if(trim($bu1)!="All")
        {
         if(trim($b) == trim($bu1))
                {
                $egenar[$t]=$ecode_gen;
                $pk_s[$t]=$pk_sl[$u];
                $repemp_arr[$t]=$c_r['emp_name'];
                $repempcode_arr[$t]=$c_r['emp_code'];
                $t++;
                }
         }
         else
         {
           $egenar[$t]=$ecode_gen;
           $pk_s[$t]=$pk_sl[$u];
           $repemp_arr[$t]=$c_r['emp_name'];
           $repempcode_arr[$t]=$c_r['emp_code'];
           $t++;
         }
}
echo"<tr><td><h5><center>Meeting Completed:&nbsp;$t</center></h5></td></tr><hr>";
echo"<table width=\"100%\">";
echo"<tr><td width=\"35%\"><b>No.</b></td><td width=\"65%\"><b>Name</b> </td></tr>";

for($i=0;$i<$t;$i++)
{
	$pk_sln=$pk_s[$i];
	$emp_name = trim($repemp_arr[$i]);
	$empcodecp = $repempcode_arr[$i];

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
echo"<tr><td><font color= $colr> $egenar[$i]</font></td><td><a href=\"PA_complete_report.php?EMP_ID=$egenar[$i]&meet_to=$empcodecp&keychk=$keychk&pk_sln=$pk_sln&year=$year&qtr_com=$qtr_com\" target=\"BLANK\"><font color = $colr> $emp_name</a></font></td></tr>";
	}
?>	
</table>
</body>
</html>

