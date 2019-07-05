<html>
<head><title>PA_hr_init</title>
<script language="JavaScript">
function test()
{
document.forms[0].action="PA_main_menu.php";
}
</script>
</head>
<body bgcolor=\"#CDE1EB\">
<?
include "tsutils.php";
include "pasutils.php";
error_reporting(E_ERROR);

//change made by ankur on 14 nov 2005

$arr_month= array(1 => "January",2 => "February",3 => "March",4 => "April",5 => "May",6 => "June",7 => "July",8 => "August",9 => "September",10 => "October",11 => "November",12 => "December");

$db_pas = db_open("pas_db",0);
$db_off = db_open("offproj",0);
$db_conn=db_open("pas_db",0);
$qtr_result=pg_query($db_conn,"select qtr_num from i_qtr_def where qtr_desc='$qtr_com'");
$qtr_arr=pg_fetch_array($qtr_result,0);
$qtr_num=$qtr_arr[qtr_num];
$qtr_com_arr=explode(':',$qtr_com);
$qtr_com_st = $qtr_com_arr[0];
$qtr_start=explode('-',$qtr_com_st);
$qtr_end=explode('-',$qtr_com_arr[1]);

//change made by ankur on 14 nov 2005

for($i=1;$i<=12;++$i)
{
	if($qtr_start[1]==$arr_month[$i])
                $qtr_start[1]=$i;

        if($qtr_end[1]==$arr_month[$i])
                $qtr_end[1]=$i;
}

/*if($qtr_start[1]=='July')
$qtr_start[1]=7;
if($qtr_start[1]=='January')
$qtr_start[1]=1;
if($qtr_start[1]=='March')
$qtr_start[1]=3;
if($qtr_start[1]=='April')
$qtr_start[1]=4;
if($qtr_start[1]=='June')
$qtr_start[1]=6;
if($qtr_start[1]=='September')
$qtr_start[1]=9;
if($qtr_start[1]=='October')
$qtr_start[1]=10;
if($qtr_start[1]=='December')
$qtr_start[1]=12;
if($qtr_end[1]=='July')
$qtr_end[1]=7;
if($qtr_end[1]=='January')
$qtr_end[1]=1;
if($qtr_end[1]=='March')
$qtr_end[1]=3;
if($qtr_end[1]=='April')
$qtr_end[1]=4;
if($qtr_end[1]=='June')
$qtr_end[1]=6;
if($qtr_end[1]=='September')
$qtr_end[1]=9;
if($qtr_end[1]=='October')
$qtr_end[1]=10;
if($qtr_end[1]=='December')
$qtr_end[1]=12;*/

// changes end here

$qtr_com_last = $qtr_com_arr[1];
$app_year_arr=explode('-',$qtr_com_st);
$app_year=$app_year_arr[2];
$qtr_com_start  = mktime(0,0,0,$qtr_start[1],$qtr_start[0],$qtr_start[2]);
$qtr_com_end  = mktime(0,0,0,$qtr_end[1],$qtr_end[0],$qtr_end[2]);
$emp_date = $emp_dd.'-'.$emp_month.'-'.$emp_year;
$qtr_emp_stamp  = mktime(0,0,0,$emp_month,$emp_dd,$emp_year);
$qtr_rh_stamp  = mktime(0,0,0,$rh_month,$rh_dd,$rh_year);
$cur_day=date('j');
$cur_month=date('n');
$cur_year=date('Y');
$cur_date=mktime(0,0,0,$cur_month,$cur_day,$cur_year);
DateValidation($emp_dd,$emp_month,$emp_year,"date for employee");
DateValidation($rh_dd,$rh_month,$rh_year,"date for reporting head");
//if($qtr_emp_stamp<$qtr_com_start)
if($cur_date>$qtr_emp_stamp)
{
//echo"<center><b> Last date for employee submiting form should be greater than quarter period </b></center>";
//exit();
}
//if($qtr_rh_stamp<$qtr_com_start)
if($cur_date>$qtr_rh_stamp)
{
//echo"<center><b> Last date for reporing head submiting form should be greater than quarter period </b></center>";
//exit();
}

/*$rh_date = $rh_dd.'-'.$rh_month.'-'.$rh_year;
$pa_del = pg_query($db_pas,"delete from pa_init");
$pa_init_ins = pg_query($db_pas,"insert into pa_init(year,qtr,emp_end_date,rh_end_date,qtr_start,qtr_end) values($app_year,$qtr_num,'$emp_date','$rh_date','$qtr_com_st','$qtr_com_last')");
$pa_init_ins = pg_query($db_pas,"insert into pa_init(year,qtr,qtr_start,qtr_end) values($app_year,$qtr_num,'$qtr_com_st','$qtr_com_last')");*/


//change made by ankur on 14 nov 2005

$rh_mon= numerical_month($rh_month);
$emp_mon= numerical_month($emp_month);
$emp_rh_diff=$qtr_rh_stamp-$qtr_emp_stamp;
$diff=1296000;
$newemp_mn=$emp_month;
$newrh_mn=$rh_month;

if(!$qtr_com)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please select Appraisal Period.</font></b></center>";
	exit;
}


if(!$qtr_com && !$emp_dd && !$emp_month && !$emp_dd && !$emp_year && !$rh_dd && !$rh_month && !$rh_year)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please select Appraisal Period.</font></b></center>";
	exit;
}

//if($qtr_com && !$emp_dd && !$emp_month && !$emp_year && !$rh_dd && !$rh_month && !$rh_year)
if(!$emp_dd && !$emp_month && !$emp_year)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Select last date for closure of Self Appraisal.</font></b></center>";
	exit;
}

//if($qtr_com && $emp_dd && !$emp_month && !$emp_year && !$rh_dd && !$rh_month && !$rh_year)
if(!$emp_dd || !$emp_month || !$emp_year)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Invalid Employee's date.</font> </b></center>";
	exit;
}

/*if($qtr_com && $emp_dd && $emp_month && !$emp_year && !$rh_dd && !$rh_month && !$rh_year)
{
echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Invalid Employee's date.</font></b></center>";
	exit;
}*/

//if($emp_dd && $emp_yy)
//{
if($qtr_emp_stamp < $cur_date)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Employee date should not be earlier than current date.</font></b></canter>";
	exit;
}
//}
/*else if(!$emp_dd || !$emp_yy)
{
echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Invalid Employee's date.</font></b></center>";
	exit;
}*/

if($qtr_end[2] == $emp_year)
{
	if(($newemp_mn-$qtr_end[1]) > 3)
	{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Employee date cannot exceed more than three months from the quarter period.</font></center></b>";
	exit;
	}

	else if(($newemp_mn-$qtr_end[1]) <= 0)
	{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Employee's date cannot be earlier or within the quarter period.</font></center></b>";
	exit;
	}
}
else if(($emp_year - $qtr_end[2]) == 1)
{
 	if(($qtr_end[1] - $newemp_mn) < 9)
	{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Employee date cannot exceed more than three months from the quarter period.</font></center></b>";
	exit;
	}
}

else if(($emp_year - $qtr_end[2]) > 1)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Employee date cannot exceed more than three months from the quarter period.</font></center></b>";
	exit;
}

else if(($qtr_end[2]-$emp_year)>=1)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Employee date cannot be earlier than the quarter period.</font></b></center>";
	exit;
}

//if($qtr_com && $emp_dd && $emp_month && $emp_year && !$rh_dd && !$rh_month && !$rh_year)
if(!$rh_dd && !$rh_month && !$rh_year)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Select last date for closure of Appraisal Meeting.</font></b></center>";
	exit;
}

//if($qtr_com && $emp_dd && $emp_month && $emp_year && $rh_dd && !$rh_month && !$rh_year)
if(!$rh_dd || !$rh_month || !$rh_year)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Invalid Manager's date.</font></b></center>";
	exit;
}

/*if($qtr_com && $emp_dd && $emp_month && $emp_year && $rh_dd && $rh_month && !$rh_year)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Invalid Manager's date.</font></b></center>";
	exit;
}*/

//if($rh_dd && $rh_yy)
//{
if($qtr_rh_stamp < $cur_date)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Manager's date should not be earlier than current date.</font></b></canter>";
	exit;
}
//}
/*else if(!$rh_dd || !$rh_yy)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Invalid Manager's date.</font></b></center>";
	exit;
}*/
	
if(($emp_rh_diff < $diff) && ($emp_rh_diff >=0))
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Difference between Employee's and Manager's date should be greater than 15 days.</font></center></b>";
	exit();
}

else if($emp_rh_diff < 0)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">The Reporting Head submition date should be greater than Employee submition date.</font></center></b>";
	exit;
}

if($qtr_end[2] == $rh_year)
{
	if(($newrh_mn-$qtr_end[1]) > 3)
	{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Manager's date cannot exceed more than three months from the quarter period.</font></center></b>";
	exit;
	}

	else if(($newrh_mn-$qtr_end[1]) <= 0)
	{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Manager's date should not be earlier or within the quarter period.</font></center></b>";
	exit;
	}
}

else if(($rh_year - $qtr_end[2]) == 1)
{
 	if(($qtr_end[1] - $newrh_mn) < 9)
	{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Manager's date cannot exceed more than three months from the quarter period.</font></center></b>";
	exit;
	}
}

else if(($rh_year - $qtr_end[2]) > 1)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Manager date cannot exceed more than three months from the quarter period.</font></center></b>";
	exit;
}

else if(($qtr_end[2]-$rh_year)>=1)
{
	echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Manager date cannot be earlier than the quarter period.</font></b></center>";
	exit;
}

// change made by ankur on 2 dec 2005

$rh_date = $rh_dd.'-'.$rh_month.'-'.$rh_year;
$pa_del = pg_query($db_pas,"delete from pa_init");
$pa_init_ins = pg_query($db_pas,"insert into pa_init(year,qtr,emp_end_date,rh_end_date,qtr_start,qtr_end) values($app_year,$qtr_num,'$emp_date','$rh_date','$qtr_com_st','$qtr_com_last')");
$pa_init_ins = pg_query($db_pas,"insert into pa_init(year,qtr,qtr_start,qtr_end) values($app_year,$qtr_num,'$qtr_com_st','$qtr_com_last')");





if($pa_init_ins)
{
$MAILSERVER="integramicro.com";
$Subject ="Appraisal Forms are online";
$clsr_time="\n\nLast date for the closure of Self Appraisal is $emp_dd-$emp_month-$emp_year.\nLast date for the closure of Appraisal Meeting is $rh_dd-$rh_month-$rh_year.\n\n\nThanks & Regards\nHR Department";
$Msg_emp =$text_mssg."$clsr_time";
	
$emplogin="imspl@integramicro.com,imsplpd@integramicro.com,imssplpd@integramicro.com";
$headers11="From: $PCC_ID:\nBcc:$emplogin";
//echo "$emplogin";
$to_name="pas@integramicro.com";
$sucess2=mail($to_name,$Subject,$Msg_emp,$headers11);

/*if(!$sucess2)
{
echo "Error Occured while sending mail2";
//exit();
}*/


/*if($no_emp>0)
 {
   $rh_login=LoginFromEmpCode($ecode[$i]);
   $emp_c[$i]=EmpCodeFromLogin($rh_login);
 }
}
sort($emp_c);
$rno=count($emp_c);
$eno=count($ecode);
$result=array_diff($ecode,$emp_c);
sort($result);
$num=count($result);
$MAILSERVER="testing.integramicro.co.in";
for($q1=0;$q1<$eno;$q1++)
{
 if($result[$q1])
 {
   $emp_login=LoginFromEmpCode($result[$q1]);
   $emp_name=EmpNameFromEmpCode($result[$q1]);
   $emplog=$emp_login."@$MAILSERVER"; 
   $emp_log_in.="$emp_name<$emplog>,"; 
 }
}
//echo"<br><br>Mail for employee login are<br>:$emp_log_in<br> ";
for($q2=0;$q2<$rno;$q2++)
{
  if($emp_c[$q2])
  { 
   $rhlog=LoginFromEmpCode($emp_c[$q2]);
   $rh_name=EmpNameFromEmpCode($emp_c[$q2]);
   $rhlogtest=$rhlog."@$MAILSERVER"; 
   $rhlogin=$rhlogin."$rh_name<$rhlogtest>,"; 
  }
}*/
//$rhlogin=substr($rhlogin,0,-1);
$emp_rh=$emp_dd+10;
//echo"Mail for reporting  head login are:$rhlogin";
//$sucess1=mail($rhlogin,$Subject,$Msg_rh,$headers12);
//if(!$sucess1)
//{
//echo"Error Occured while sending mail";
//exit();
//}
echo"<form>";
echo"<br><br>";
echo"<center><b><font style=\"arial\" size=\"2\">Quarter has been initiated successfully</font></b></center><br>";
echo"<center><input type=\"submit\" name =\"sb1\" Value=\"Ok\" onClick =\"test()\"></center>";
echo"<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo"</form>";
}
echo"</body></html>";

//change made by ankur on 14th nov

function numerical_month($mon)
{

$arr_mon= array(1 => "January",2 => "February",3 => "March",4 => "April",5 => "May",6 => "June",7 => "July",8 => "August",9 => "September",10 => "October",11 => "November",12 => "December");

for($i=1;$i<=12;$i++)
	{
		if($mon == $arr_mon[$i])
			return $i;
	}			

}

?>
