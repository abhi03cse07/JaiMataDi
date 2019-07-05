<!--
  Modified By akila for BU wise report on 9-Apr-2007
-->

<?
include_once "../tsutils.php";
include_once "pasutils.php";
error_reporting(E_ERROR);
$db_conn =db_open("offproj",0); 
$db_pas =db_open("pas_db",0); 
$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);

// modified by ankur kapoor on 24th november

$cur_year =$key_arr[year];
$cur_qtr =$key_arr[qtr];

echo"<html>";
echo"<body bgcolor = \"#CDE1EB\">";
$emp_limit_exe=pg_query($db_pas,"select emp_limit from i_qtr_def where qtr_num= $qtr and qtr_desc = '$qtr_com'");
$emp_limit_arr=pg_fetch_array($emp_limit_exe,0);
$emp_lim=$emp_limit_arr[emp_limit];

$ecode_exe=pg_query($db_conn,"select emp_code from emp_code_gen where emp_code_entered='$emp_lim'");
$ecode_arr=pg_fetch_array($ecode_exe,0);
$ecode_not=$ecode_arr[emp_code];

$pas_diff  = pg_query($db_pas,"select emp_code from pa_lock where year =$year and qtr=$qtr and emp_rate = true and emp_proj = true ");
$t = pg_num_rows($pas_diff);
for($p=0;$p<$t;$p++)
{
$pas_arr = pg_fetch_array($pas_diff,$p);
$pas_code = $pas_arr[emp_code];
$arr[$p] = $pas_code;
}
$arr_no = count($arr);
if(!($arr_no))
{
echo"<tr><td>No one has filled appraisal form</td></tr>";
exit();
}
$off_diff  = pg_query($db_conn,"select emp_code  from emp_master where emp_code <= $ecode_not and left_date is null");
$s = pg_num_rows($off_diff);
for($o=0;$o<$s;$o++)
{
		$off_arr = pg_fetch_array($off_diff,$o);
		$off_code = $off_arr[emp_code];
		$off[$o] = $off_code;

}
$result = array_diff($off,$arr);
sort($result);
$emp_no = count($result);
//Modified By Akila on 4-apr-2007
$t=0;
for($q1=0;$q1<$emp_no;$q1++)
{
 if($result[$q1])
 {
 $ecode_gen = EcodeEnteredFromEcode($result[$q1]);
 
 	 $check=pg_query($db_conn,"select * from emp_master where emp_code=$result[$q1] and left_date is null");
 	 $c_r=pg_fetch_array($check,0);
 	 $b=$c_r[bu_code];
 	if(trim($bu1)!="All")
 	{
         if(trim($b) == trim($bu1))
  		{
		$egenar[$t]=$ecode_gen;
                $off_emp_arr[$t]=$c_r[emp_name];
                $t++;
  		}
	 }
         else
         {
           $egenar[$t]=$ecode_gen;
           $off_emp_arr[$t]=$c_r[emp_name];
           $t++;
         }
 }
}
echo"<h5><center>Not Submited:&nbsp;$t</center></h5><hr>";
echo"<table width=\"100%\">";
echo"<tr><td width=\"35%\" ><b>No.</b></td><td width=\"65%\" >
<b>Name</b> </td></tr>";
for($q=0;$q<$t;$q++)
{
   $off_emp = $off_emp_arr[$q];
   // changes made by ankur on 16 nov 2005
   $colr="black";
 if($qtr==$cur_qtr && $year==$cur_year)
 {
  $rep_flag_exe  = pg_query($db_pas,"select appr_flag from appr_system where emp_code=$egenar[$q]");
        $rep_flag_arr = pg_fetch_array($rep_flag_exe,0);
        $rep_flag=trim($rep_flag_arr[appr_flag]);

         if($rep_flag=='R')
            $colr="red";

         if($rep_flag=='S')
            $colr="green";

         if($rep_flag=='B')
            $colr="blue";
 }
echo"<tr><td><font color = $colr>$egenar[$q]</font></td><td><font color = $colr>$off_emp</font></td></font></tr>";
}
echo"</table>";
//echo"</form>";
echo"</body>";
echo"</html>";
?>

