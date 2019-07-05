
<html>
<?php
error_reporting(0);
include_once('head.php');
//include "../tsutils.php";
include "pasutils.php";



$db_pas = db_open("pas_db",0);
$db_off = db_open("offproj",0);
$db_conn=db_open("pas_db",0);

$qtr_result=pg_query($db_conn,"select distinct qtr, year, qtr_start, qtr_end from pa_init");
$qtr_arr=pg_fetch_array($qtr_result,0);
$qtr_num=$qtr_arr[qtr];

$qtr_start = trim($qtr_arr[qtr_start]);
$qtr_end = trim($qtr_arr[qtr_end]);

$qtr_com = $qtr_start.":".$qtr_end ;
$qtr_year=$qtr_arr[year];
?>

<object width="97%" height="20%" data="PA_report_heading.php?keychk=<?php echo $keychk?>&qtr_com=<?php echo $qtr_com ?>&cur_year=<?php echo $qtr_year?>"></object>
<hr>
<object width="24%" height="400" data="PA_not_process_manager.php?qtr=<?php echo $qtr_num ?>&year=<?php echo $qtr_year ?>&qtr_com=<?php echo $qtr_com ?>&ecode=<?php  echo $ecode ?>"></object>
<object width="24%" height="400" data="PA_self_complete_manager.php?qtr=<?php echo $qtr_num ?>&year=<?php echo $qtr_year ?>&ecode=<?php echo $ecode ?>"></object>
<object width="24%" height="400" data="PA_under_process_manager.php?keychk=<?php echo $keychk ?>&qtr= <?php echo $qtr_num ?>&year=<?php echo $qtr_year ?>&qtr_com=<?php echo $qtr_com ?>&ecode=<?php echo $ecode ?>"></object>
<object width="24%" height="400" data="PA_complete_process_manager.php?keychk=<?php echo $keychk ?>&qtr=<?php echo $qtr_num ?>&year=<?php echo $qtr_year ?>&qtr_com=<?php echo $qtr_com ?>&ecode=<?php echo $ecode ?>"></object>


<?php
/*echo"<frameset rows=\"23%,77%\">";
   echo"<frame src= \"PA_report_heading.php?keychk=$keychk&qtr_com=$qtr_com&cur_year=$qtr_year\">";	
        echo"<frameset cols=\"25%,30%,21%,24%\" FRAMEBORDER=\"YES\" >";
              echo"<frame  src= \"PA_not_process_manager.php?qtr=$qtr_num&year=$qtr_year&qtr_com=$qtr_com&ecode=$ecode\">";
              echo"<frame  src= \"PA_self_complete_manager.php?qtr=$qtr_num&year=$qtr_year&ecode=$ecode\">";
              echo"<frame  src= \"PA_under_process_manager.php?keychk=$keychk&qtr=$qtr_num&year=$qtr_year&qtr_com=$qtr_com&ecode=$ecode\">";
              echo"<frame  src= \"PA_complete_process_manager.php?keychk=$keychk&qtr=$qtr_num&year=$qtr_year&qtr_com=$qtr_com&ecode=$ecode\" >";
        echo"</frameset>";	
echo"</frameset>";	
echo"<input type=\"hidden\" name=\"qtr_com\" value=\"$qtr_com\">";
echo"<input type=\"hidden\" name=\"qtr_start\" value=\"$qtr_start\">"; */
?>
</html>	
