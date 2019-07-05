<?php  
session_start();
//$_SESSION['userName'];

?>

<html>
<head>
<style>
 table {
    border-collapse: collapse;
	
  }
  th, td {
    border: 1px solid;
	 
    padding: 10px;
    text-align: left;
  }
</style>
<script type="text/javascript">

function Go_back()
{
	document.forms[0].action = "PA_main_menu.php?userName=<?php echo $_SESSION['userName']; ?>&securityToken=<?php echo $_SESSION['token']; ?>";
}

</script>
</head>
<body style = 'background-color:#CDE1EB !important';>


<?
include_once('head.php');
//include "../tsutils.php";
include "pasutils.php";
error_reporting(E_ERROR);
$db_conn=db_open("pas_db",0);
$db_off = db_open();
echo"<form name=\"f1\" method= \"POST\" action = \"manager_view_emp_reports.php\">";
$qtr_result=pg_query($db_conn,"select * from i_qtr_def ");
$no=pg_num_rows($qtr_result);

//echo "<h2 align = ='center'>Periodic Performance Appraisal System</h2>";
//echo  "<h3 align = 'center'>(Strictly Personal and Confidential)</h3>";
echo "<br><h3 align = 'center'>Employee's Periodic Appraisal Report</h3>";


echo"<table width=\"75%\" align=\"center\" border=\"1\" >
<tbody><tr><td width=\"55%\">Select the Appraisal Period</td> <td align=\"left\">";
echo"<SELECT name=\"qtr_com\" tabindex=\"1\">
<option></option>";
for($i=0;$i<$no;$i++)
{
$qtr_arr=pg_fetch_array($qtr_result,$i);
$qtr_desc=trim($qtr_arr[qtr_desc]);
echo"<option value=\"$qtr_desc\">$qtr_desc</option>";
}
echo"</SELECT></td></tr>";
echo"<tr><td>View employee's appraisal report</td>";
echo "<td><INPUT type=\"submit\" name=\"init_view\" value=\"Appraisal Report\"></td></tr>";
echo"</tbody></table>";
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo"<INPUT type=\"hidden\" name=\"emp_code\" value=\"$emp_code\">";
//echo"<INPUT type=\"hidden\" name=\"emp_code\" value=\"$emp_code\">";

// added by Akila on 4 april 2007 ********************************************
   $emp_enter= pg_query($db_off,"select emp_code_entered from emp_code_gen where emp_code = $emp_code");
   $ec=pg_fetch_array($emp_enter,0);
   $ec_num=$ec[emp_code_entered];
   $hr_emp=pg_query($db_off,"select * from bu_master where hr_partner=$ec_num");
   $num_hr = pg_numrows($hr_emp);
   $bu_r=pg_fetch_array($hr_emp,0);
   $bu_num=$bu_r[bu_code];
//****************************************************************************

if($init_view)
{
	if(!$qtr_com){
		echo"<br><center><font size = 4><b>Please Select Appraisal Period</b></font></center>";
	}
	else{
             $qtr_details_qry = pg_query($db_conn,"select qtr_num,emp_limit from i_qtr_def where qtr_desc = '$qtr_com'");
             $qtr_array = pg_fetch_array($qtr_details_qry,0);
             $qtr_number = $qtr_array[qtr_num];
             $emp_last = $qtr_array[emp_limit];
             $emp_li= pg_query($db_off,"select emp_code from emp_code_gen where emp_code_entered = '$emp_last'");
             $emp_ar=pg_fetch_array($emp_li,0);
             $emp_last_limit=$emp_ar[emp_code]; 
             $qtr_period = explode(':',$qtr_com);
            ?>
		 <br><br>
                 <center><font size = 4 color = "blue"><?echo"$qtr_period[0] to  $qtr_period[1]"?></font></center>
                 <br>
                 <table width = "90%" border = 0 align = "center" cellpadding = "2">
                 <tr bgcolor = "#FFFFFF">
                 <td><font color = "#2B60DE" size = "4" ><strong>Employees</strong></font></td>
                 <td><font color = "#2B60DE" size = "4" ><strong>Employee's Rating</strong></td>
                 <td><font color = "#2B60DE" size = "4" ><strong>Manager's Rating</strong></td>
                 <td><font color = "#2B60DE" size = "4" ><strong>Manager's Comments</strong></td>
                 <td><font color = "#2B60DE" size = "4" ><strong>Appraised By</strong></td>
                 </tr>
        <?
	$qtr_year_array = explode('-',$qtr_period[0]);
	$qtr_year = $qtr_year_array[2];

//Modified By Akila for BU wise Segregation for HR Partners

	if(!$num_hr)
        {
		$select_emp = pg_query($db_off,"select emp_code,emp_name from emp_master where reportsto=$emp_code and left_date is null and emp_code <= $emp_last_limit");      
        }
        
        else
        {
		$select_emp = pg_query($db_off,"select emp_code,emp_name from emp_master where (reportsto=$emp_code or bu_code in (select bu_code from bu_master where hr_partner=$ec_num)) and emp_code <= $emp_last_limit and emp_code!=$emp_code and left_date is null");      
        }
        $numof_emp = pg_num_rows($select_emp);
         
                $colr1 = "#3BB9FF";
                $colr2 = "#2B60DE";
           
	for($i=0;$i<$numof_emp;$i++){
		$select_emp_array = pg_fetch_array($select_emp,$i);
		$e_name = $select_emp_array[emp_name];
		$e_code = $select_emp_array[emp_code];
		$pksl_emp = pg_query($db_conn,"select pk_sl,appr_by,mgr_rate from pa_lock where emp_code = $e_code and year = $qtr_year and qtr = $qtr_number");
		$pksl_arr = pg_fetch_array($pksl_emp,0);
		$pksl = $pksl_arr[pk_sl];
		$apprby = $pksl_arr[appr_by];
		$apprby_manager = EmpNameFromEmpCode($apprby);
		$manager_rate = $pksl_arr[mgr_rate];
			$appraisal_value = pg_query($db_conn,"select emp_total,mgr_total,pa_mgr_com from pa_assess where pk_sl = $pksl");
			$app_arr = pg_fetch_array($appraisal_value,0);
			$emp_tot = $app_arr[emp_total];
			$mgr_tot = $app_arr[mgr_total];
			$mgr_comments = $app_arr[pa_mgr_com];
			if($i%2==0)
				$colr = $colr1;
			else
				$colr = $colr2;

			echo"<tr bgcolor = \"$colr\">";
		if($manager_rate){
                 	echo"<td><a href=\"PA_complete_report.php?meet_to=$e_code&keychk=$keychk&pk_sln=$pksl&year=$qtr_year&qtr_com=$qtr_com\" target=\"BLANK\"><font color = \"#FFFFFF\" size = \"3\" ><strong>$e_name</strong></font></a></td>";
		}
		else{
	           	echo"<td><font color = \"#FFFFFF\" size = \"3\" ><strong>$e_name</strong></font></a></td>";
		}
                   echo"<td><font color = \"#FFFFFF\" size = \"3\" ><strong>$emp_tot</strong></td>
                 	<td><font color = \"#FFFFFF\" size = \"3\" ><strong>$mgr_tot</strong></td>
                 	<td><font color = \"#FFFFFF\" size = \"3\" ><strong>$mgr_comments</strong></td>
                 	<td><font color = \"#FFFFFF\" size = \"3\" ><strong>$apprby_manager</strong></td>
           	    	</tr>";              
		
	}    	
	echo"</table>";
      }
}
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo"<INPUT type=\"hidden\" name=\"emp_code\" value=\"$emp_code\">";
?>
<br><br>
<center><INPUT type="submit" name="exit_butt" value="Back" onClick ="Go_back()"></center>
<?
echo"</form>";
?>
</body>
</html> 
