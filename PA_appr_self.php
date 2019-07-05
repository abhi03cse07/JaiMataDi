<?php  
session_start();
$_SESSION['userName'];
include_once('head.php');
?>

<html>
<HEAD><TITLE>Performance Appraisal System</TITLE>

<style>

.button {
  background-color:   #778899; /* Green */
  border: none;
  color: white;
  padding: 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.button4 {border-radius: 12px;}

table.roundedCorners { 
  border: 1px solid;
  border-radius: 13px; 
  border-spacing: 0;
  height : 150px;
 
  }
table.roundedCorners td, 
table.roundedCorners th { 
  border-bottom: 1px solid;
  padding: 10px; 
  }
table.roundedCorners tr:last-child > td {
  border-bottom: none;
}
</style>

<script language="JavaScript">
function exit_form()
{
  document.forms[0].action="PA_main_menu.php?userName=<?php echo $_SESSION['userName']; ?>&securityToken=<?php echo $_SESSION['token']; ?>";
}

function firstForm()
{
   document.forms[0].action="PA_appr_prev.php";
}
function thiForm()
{
   document.forms[0].action="PA_emp_rate.php";
}
function forForm()
{
   document.forms[0].action="PA_rh_menu.php";
}
function repForm()
{
   document.forms[0].action="hr_report.php";
}
function MeetForm()
{
   document.forms[0].action="final.php";
}
function view_rep()
{
   document.forms[0].action="PA_appr_emp_report.php";
}
function SelfAppraisal()
{
   document.forms[0].action="PA_appr_self.php";
}
</script>
</HEAD>
<body style="background-color: #CDE1EB !important;">

<br>

<?php

   //require "../tsutils.php";
   //require "sub_head.php";
     error_reporting (E_ERROR);

 
   if (! CheckAuthKey ($keychk)) 
   {
      Error ("Login");
      exit;
   } 
    
	
   // Default action of the page.
      echo "<FORM METHOD=POST>";
  Function access_not_allowed($ecode)
   {
    $db_pas = db_open("pas_db",0);
    $db_off= db_open("offproj",0);

   // $ecode_enterd = EcodeEnteredFromEcode($ecode);
    $cur_qtr_exe = pg_query($db_pas,"select distinct qtr,qtr_start,qtr_end from pa_init");
    $cur_qtr_arr = pg_fetch_array($cur_qtr_exe,0);
    $cur_qtr = $cur_qtr_arr[qtr];

    $cur_qtr_start = $cur_qtr_arr[qtr_start];
    $cur_qtr_end = $cur_qtr_arr[qtr_end];
    $qtr_com = $cur_qtr_start.":".$cur_qtr_end;

    $access_exe= pg_query($db_pas,"select emp_limit from i_qtr_def where qtr_num = $cur_qtr and qtr_desc='$qtr_com'");

    $access_arr = pg_fetch_array($access_exe,0);
    $access_lim = $access_arr[emp_limit];


    $ecode_exe= pg_query($db_off,"select emp_code from emp_code_gen where emp_code_entered = '$access_lim'");

    $ecode_arr = pg_fetch_array($ecode_exe,0);
    $ecode_lim = $ecode_arr[emp_code];

 if($ecode <= $ecode_lim )
     return false;
    else
     return true;
    }

      
   $db_proj = db_open ();
  $db_pas = db_open("pas_db",0); 
   /*  UI DESIGN     */
      $ecode = EmpCodeFromAuthKey ($keychk);
      $get_key = pg_query($db_pas,"select qtr,year from pa_init");
   $key_arr = pg_fetch_array($get_key,0);
   $year =$key_arr[year];
   $qtr =$key_arr[qtr];

   echo "<center>";
   echo "<table   cellpadding='5' width='50%'>";
   echo "<tr>";
   $rephead_q = pg_query($db_proj,"select emp_code,emp_name from emp_master where reportsto=$ecode");

 $num_emp = pg_num_rows($rephead_q);
 $ecode= EmpCodeFromAuthKey($keychk);
 $emp_q=pg_query($db_pas,"select emp_rate,emp_proj from pa_lock where emp_code =$ecode and year=$year and qtr=$qtr");
 $emp_arr=pg_fetch_array($emp_q,0);
 $emp_rate =$emp_arr[emp_rate];
 $emp_proj =$emp_arr[emp_proj];

if(access_not_allowed($ecode))
{
echo "<center>You are not allowed to fill your  Appraisal form for this quater</center>";

//echo"<br><BR><center><input type=\"submit\" class='button button4' name =\"bt_ok\" Value=\"Back\" onClick=\"exit_form()\"></center>";

echo"<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
exit;
}


 if($emp_rate&& $emp_proj)
{
echo"You have already filled your Appraisal form";
exit();
}      	// echo "<td><center><input type=\"submit\" name=\"view_ass\" value=\"View Appraisal Form\" onClick=\"view_rep()\"></center></td>";
echo "</br>";
echo "<td><center><input type=\"submit\" class='button button4' name=\"proj_ass\" value=\" &nbsp;&nbsp;Project Assessment &nbsp;&nbsp;\" onClick=\"firstForm()\"></center></td>";
    echo "<td><center><input type=\"submit\" class='button button4' name=\"mgr_ass\" value=\"Performance Assessment\" onClick=\"thiForm()\"></center></td>";

   echo "</tr>";
   
    
//echo"<td colspan='2'><center><input type=\"submit\" class='button4 button' name =\"bt_ok\" Value=\"Back\" onClick=\"exit_form()\"></center></td></tr>";
echo "</table>";
   
echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo "<input type=\"hidden\" name=\"login\" value=\"$login\">";
    
      echo "</FORM>";
    
?>

</body>
</html>

