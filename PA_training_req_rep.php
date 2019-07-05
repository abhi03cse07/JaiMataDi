<!--
     Module       :Training Requirements Reports
     Description  :This module deals with training requirements need for a particular area of 
                   the employee based on quarter and BU selected.
     Developed by :Akilandeswari
     Date         :9 apr 2007 

-->
<!-- Module       :Training Requirements Reports  
     Description  :This module deals with training requirements need for a particular area
     Developed by :Ankur Kapoor
     Date         :2 dec 2005 -->   

<html>
<head>
<!--<title>Performance Appraisal Form</title>-->
<script language="JavaScript">
function cprocess()
{
	window.close();
	return(false);
}
	</script>
	</head>

	<body bgcolor="#CDE1EB">
	<h2 align = "center">Periodic Performance Appraisal System</h2>
	<h3 align = "center">Employee's Training Requirements Report</h3>
	
	<?
	#print_r($_POST);
	include_once "../tsutils.php";
	include_once "pasutils.php";
	error_reporting(E_ERROR);
	if (!CheckAuthKey ($keychk))
	{
		Error ("Login");
		exit;
	}

if(!$qtr_com || !$bu1)
      {
	        echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please select Appraisal Period.</font></b></center>";
	        exit;
      }
     echo"<h4 align = \"center\">Period : $qtr_com </h4>";
$db_pas = db_open("pas_db",0);
$db_off = db_open("offproj",0);

 $qtr_exe=pg_query($db_pas,"select qtr_num from i_qtr_def where qtr_desc='$qtr_com'");
 $qtr_arr= pg_fetch_array($qtr_exe,0);
 $qtr = $qtr_arr[qtr_num];
 $qtr_year_ped=explode(':',$qtr_com);
 $qtr_year=explode('-',$qtr_year_ped[0]);
  
 $qry_exe = pg_query($db_pas,"select distinct t1.pk_sl,t1.emp_code,t2.area,t2.emp_com,t2.mgr_com from pa_lock t1,pa_tdn t2 where t2.pk_sl=t1.pk_sl and t2.area !='' and t1.qtr=$qtr and t1.year=$qtr_year[2]" );
 $numrows= pg_num_rows($qry_exe);

 if(!$numrows)
 {
	 echo"<br><b><center>No one requires training in this quarter session</center></b>";
	 exit();
 }
	
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
  <tr>
  <td><b>Employee Code</b></td>
  <td><b>Employee Name</b></td>
  <td><b>Training Area</b></td>
  <td><b>Manager's Comments</b></td>
  <td><b>Employee's Comments</b></td>
  </tr>";
  for($i=0;$i<$numrows;$i++)
  { 
	 $qry_arry= pg_fetch_array($qry_exe,$i);
         $emp_cod=$qry_arry[emp_code];
         $tr_area = $qry_arry[area];
         $empcom = $qry_arry[emp_com];
         $mgrcom = $qry_arry[mgr_com];
         	 
	 $ecode_gen = EcodeEnteredFromEcode($emp_cod);
         $emp_name = EmpNameFromEmpCode($emp_cod);
      
         if($dup_ecode == $emp_cod)
         {
         $emp_name= " ";
         $ecode_gen= " ";
         }
         $dup_ecode = $emp_cod;
        
         if(trim($bu1)!="All")
         {
         $ch_b=pg_query($db_off,"select bu_code from emp_master where emp_code=$dup_ecode");
         $b_arr=pg_fetch_array($ch_b,0);
         $bc=$b_arr[bu_code];
         	if(trim($bc) == trim($bu1))
                {
                echo"<tr>
                <td>$ecode_gen </td>
                <td>$emp_name </td>
                <td>$tr_area </td>
                <td>$mgrcom </td>
                <td>$empcom </td>
                </tr>";       
                }
         }
         else
         {
		echo"<tr>
		<td>$ecode_gen </td>
	 	<td>$emp_name </td>
	 	<td>$tr_area </td>
	 	<td>$mgrcom </td>
	 	<td>$empcom </td>
	  	</tr>";
         }
     }
 echo"</tbody></table>";
 echo"<form name =\"f2\" method=\"POST\" action =\"PA_view_qtr_rep.php\">";
 echo"<BR><BR><center><input type= \"submit\" name =\"back_form\" value = \"Exit\"></center>";
 echo"<input type=\"hidden\" name =\"keychk\" value =\"$keychk\">"; 
?>

</body>
</html>
