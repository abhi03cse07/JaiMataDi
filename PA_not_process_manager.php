<?
// Modified by Akila on 4 th April 2007

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

$pas_diff  = pg_query($db_pas,"select emp_code from pa_lock where year = $year and qtr = $qtr and emp_rate = true and emp_proj = true");
$t = pg_num_rows($pas_diff);

// added by Akila on 4 april 2007 ********************************************
   $emp_enter= pg_query($db_conn,"select emp_code_entered from emp_code_gen where emp_code = $ecode");
   $ec=pg_fetch_array($emp_enter,0);
   $ec_num=$ec[emp_code_entered];
   $hr_emp=pg_query($db_conn,"select * from bu_master where hr_partner=$ec_num");
   $num_hr = pg_num_rows($hr_emp);
   $bu_r=pg_fetch_array($hr_emp,0);
   $bu_num=$bu_r[bu_code];
//****************************************************************************


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

//added by akila 
if(!$num_hr)
{
	$off_diff  = pg_query($db_conn,"select emp_code from emp_master where emp_code <= $ecode_not and reportsto = $ecode and left_date is null");
}
else
{
        $off_diff  = pg_query($db_conn,"select emp_code from emp_master where emp_code <= $ecode_not and (bu_code in (select bu_code from bu_master where hr_partner=$ec_num) or reportsto=$ecode)  and emp_code!=$ecode and left_date is null");
}
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
echo"<h5><center>Not Submited:&nbsp;$emp_no</center></h5><hr>";
echo"<table width=\"100%\">";
echo"<tr><td width=\"35%\" ><b>No.</b></td><td width=\"65%\" >
<b>Name</b> </td></tr>";
for($q1=0;$q1<$emp_no;$q1++)
{
 if($result[$q1])
 {
  $ecode_gen = EcodeEnteredFromEcode($result[$q1]);
  $egenar[$q1]=$ecode_gen;
 }
}
//sort($egenar);
$no=count($egenar);
for($q=0;$q<$no;$q++)
{
 if($egenar[$q])
 {
	$off_emp=pg_query($db_conn,"select emp_name from emp_master where emp_code in (select emp_code from emp_code_gen where emp_code_entered ='$egenar[$q]') and left_date is null");
	$off_emp_arr = pg_fetch_array($off_emp,0);
	$off_emp = $off_emp_arr[emp_name];
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
}
echo"</table>";
echo"</body>";
echo"</html>";
?>



