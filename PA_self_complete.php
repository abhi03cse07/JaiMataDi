<!--
  Modified By akila for BU wise report on 9-Apr-2007
-->

<html>
<body bgcolor = "#CDE1EB">
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
$rep_up=pg_query($db_pas,"select emp_code,pk_sl from pa_lock where emp_rate = true and emp_proj = true and mgr_rate=false and qtr=$qtr and year=$year");
$no_uprows = pg_num_rows($rep_up);
$t=0;
for($u=0;$u<$no_uprows;$u++)
{
	$rep_up_arr = pg_fetch_array($rep_up,$u);
	$empcodeup[$u]  = $rep_up_arr[emp_code];
        $ecode_gen = EcodeEnteredFromEcode($empcodeup[$u]);
        $pk_s[$u]=$rep_up_arr[pk_sl];

        $check=pg_query($db_conn,"select * from emp_master where emp_code=$empcodeup[$u]");
        $c_r=pg_fetch_array($check,0);
        $b=$c_r[bu_code];

	if(trim($bu1)!="All")
        {
         if(trim($b) == trim($bu1))
                {
                 $egenar[$t]=$ecode_gen;
                 $pk_sl[$t]=$pk_s[$u];
                 $repemp_up_arr[$t]=$c_r['emp_name'];
                 $t++;
                }
         }
         else
         {
           $egenar[$t]=$ecode_gen;
           $pk_sl[$t]=$pk_s[$u];
           $repemp_up_arr[$t]=$c_r['emp_name'];
           $t++;
        }
}
echo"<h5><center> Self Appraisal Completed:&nbsp;$t</center></h5><hr>";
echo"<table width=\"100%\">";     
echo"<tr><td width=\"35%\"><b>No.</b></td><td width=\"65%\"><b>Name</b> </td></tr>";
for($up=0;$up<$t;$up++)
{
        $pk_sln  = $pk_sl[$up];
        $emp_name_up = $repemp_up_arr[$up];
	$colr="black";
 if($cur_qtr== $qtr && $cur_year == $year)
 {
        $rep_flag_exe  = pg_query($db_pas,"select appr_flag from appr_system where emp_code =$egenar[$up]");
        $rep_flag_arr = pg_fetch_array($rep_flag_exe,0);
        $rep_flag=trim($rep_flag_arr[appr_flag]);

        if($rep_flag=='R')
          $colr="red";

        if($rep_flag=='S')
          $colr="green";

        if($rep_flag=='B')
          $colr="blue";

 }
/* echo"<tr><td width=\"35%\"><font color = $colr>$egenar[$up]</font></td><td width=\"65%\"><font color= $colr>$emp_name_up</font></td></tr>";*/

//##########################################################################################################################################################
//Changed on Jul 3 2008

$key_res=pg_query($db_conn,"select id from login where
emp_code=$empcodeup[$up]");
$kval=pg_fetch_array($key_res,0);
$keychk=trim($kval['id']);
echo"<tr><td width=\"35%\"><font color = $colr>$egenar[$up]</font></td><td
width=\"65%\"><a
href=\"PA_appr_emp_report.php?rep_flag=1&emp_code=$empcodeup[$up]&keychk=$keychk&pk_sln=$pk_sln&year=$year&qtr=$qtr&qtr_com=$qtr_com\"
target=\"BLANK\"><font color= $colr>$emp_name_up</font></a></td></tr>";
//###########################################################################################################################################################

}
echo"</table>";
echo"<input type = \"hidden\" name = \"keychk\" value=\"$keychk\">";	
?>
</body>
</html>

