<html>
<head><title>PA_hr_init</title>
<script language="JavaScript">
function test()
{
document.forms[0].action="PA_report.php";
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
$qtr_year=$qtr_start[2];

//change made by ankur on 14 nov 2005

for($i=1;$i<=12;++$i)
{
        if($qtr_start[1]==$arr_month[$i])
                $qtr_start[1]=$i;

        if($qtr_end[1]==$arr_month[$i])
                $qtr_end[1]=$i;
}

if(!$qtr_com)
{
        echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please select Appraisal Period.</font></b></center>";
        exit;
}

echo"<form>";
echo"<br><br>";
echo"<center><b><font style=\"arial\" size=\"2\">Employee's Appraisal Form for the year $qtr_year</font></b></center><br>";
echo"<center><b><font style=\"arial\" size=\"2\">and Period :$qtr_com</font></b></center><br>";
echo"<center><input type=\"submit\" name =\"sb1\" Value=\"See Report\" onClick =\"test()\"></center>";
echo"<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo"<INPUT type=\"hidden\" name=\"qtr_com\" value=\"$qtr_com\">";
echo"<INPUT type=\"hidden\" name=\"qtr_year\" value=\"$qtr_year\">";
echo"<INPUT type=\"hidden\" name=\"qtr_num\" value=\"$qtr_num\">";

echo"</form>";
echo"</body></html>";

?>
