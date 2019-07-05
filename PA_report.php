<!--
 Modified By Akila for Self Appraisal Reports on 7th July 2008
-->

<html>
<?
include "../tsutils.php";
include "pasutils.php";
error_reporting(E_ERROR);
if(!$qtr_com ||!$bu1)
{
        echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please select Appraisal Period.</font></b></center>";
        exit;
}
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

echo"<frameset rows=\"23%,77%\">";
echo"<frame src= \"PA_report_heading.php?keychk=$keychk&qtr_com=$qtr_com&cur_year=$qtr_year\">";	
echo"<frameset cols=\"25%,30%,21%,24%\" FRAMEBORDER=\"YES\" >";
echo"<frame  src= \"PA_not_process.php?qtr=$qtr_num&year=$qtr_year&qtr_com=$qtr_com&bu1=$bu1\">";
echo"<frame  src= \"PA_self_complete.php?qtr=$qtr_num&year=$qtr_year&bu1=$bu1&qtr_com=$qtr_com\">";
echo"<frame  src= \"PA_under_process.php?keychk=$keychk&qtr=$qtr_num&year=$qtr_year&qtr_com=$qtr_com&bu1=$bu1\">";
echo"<frame  src= \"PA_complete_process.php?keychk=$keychk&qtr=$qtr_num&year=$qtr_year&qtr_com=$qtr_com&bu1=$bu1\" >";
echo"</frameset>";	
echo"</frameset>";	
echo"<input type=\"hidden\" name=\"qtr_com\" value=\"$qtr_com\">";
echo"<input type=\"hidden\" name=\"qtr_start\" value=\"$qtr_start\">";

?>
</html>	
