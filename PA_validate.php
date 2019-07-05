<?php
// Created By Akila to Include Validation using AJAX in PAS on 12-apr-2007

//$db_con = pg_Connect("port=5432 dbname=pas_db user=root");
$db_con = pg_connect ("pcc.integramicro.co.in", 5432, "", "pas_db");
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
echo '<response>';
$appr=$_GET['name'];  
if($_GET['name'])
{
    $get_key = pg_query($db_con,"select qtr,year from pa_init");
    $key_arr = pg_fetch_array($get_key,0);
    $year =$key_arr[year];
    $qtr =$key_arr[qtr];
    $emp_lock_q = pg_query($db_con,"select mgr_rate,emp_proj,emp_rate from pa_lock where emp_code =$appr and qtr=$qtr and year=$year");
      if(!pg_numrows($emp_lock_q))
      {
	      echo "Employee has not processed his/her appraisal form yet";
      }
      else
      {
      	     echo "Completed";
      }
}
else
echo " "; 
echo '</response>';

?>

