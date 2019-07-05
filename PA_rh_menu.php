<?php
session_start();
?>

<html>
<HEAD><TITLE>Performance Appraisal System</TITLE>
	<style type="text/css">
		
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


	</style>
<script language="JavaScript">
function firstForm()
{
   document.forms[0].action="PA_appr_prev_rh.php";
}
function manForm()
{
   document.forms[0].action="PA_above_manager.php";
}
function manProj()
{
   document.forms[0].action="PA_lower_manager.php";
}
function exitProj()
{
   document.forms[0].action="PA_main_menu.php?userName=<?php echo $_SESSION['userName']; ?>&securityToken=<?php echo $_SESSION['token']; ?>";
}
</script>
</HEAD>
<body style="background-color: #CDE1EB !important;">
<!--<H3><B><CENTER>Performance Appraisal System</CENTER></B></H3>-->
<HR>

<?php
   error_reporting(0);
   include_once('head.php');

   //require "../tsutils.php";
    //error_reporting (E_ERROR);
  
 /*  if (! CheckAuthKey ($keychk)) 
   {
      Error ("Login");
      exit;
   }*/
    
      echo "<FORM METHOD=POST action = \"PA_rh_menu.php\">";
      $db_pas = db_open("pas_db",0);
      
     $get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$year =$key_arr[year];
$qtr =$key_arr[qtr];
 
     $emp_lock_q = pg_query($db_pas,"select mgr_rate,emp_proj,emp_rate from pa_lock where emp_code = $appr_to and qtr =$qtr and year = $year");
     $emp_lock_f = pg_fetch_array($emp_lock_q,0);
     $emp_p_l = trim($emp_lock_f[emp_proj]); 
     $emp_r_l = trim($emp_lock_f[emp_rate]);
     $emp_m_r = trim($emp_lock_f[mgr_rate]);
     if(!$emp_p_l || !$emp_r_l)
      {
echo "<BR><BR><BR><center><b>Employee has not processed his/her appraisal form yet.</b></center>";
	      exit();
      }
     if($emp_m_r =='t' )
      {
echo "<BR><BR><BR><center><b>Employee has already processed his/her appraisal form.</b></center>";
	      exit();
      }
  $db_proj = db_open ();
   $ecode = EmpCodeFromAuthKey ($keychk);
   echo "<center>";
   echo "<br><br><table border=\"0\" cellpadding=5 width=\"90%\">";
   echo "<tr>";
   echo "<input type=\"hidden\" name=\"appr_to\" value=\"$appr_to\">";
   echo "<td><center><input type=\"submit\"  class = 'button button4' name=\"proj_ass\" value=\"Project Assessment\" onClick=\"firstForm()\"></center></td>";
   echo "<input type=\"hidden\" name=\"login\" value=\"$login\">";
   echo "<input type=\"hidden\" name=\"appr_to\" value=\"$appr_to\">";
   echo "<td><center><input type=\"submit\" class='button button4' name=\"man_ass\" value=\"Next Quarter Plan\" onClick=\"manProj()\"></center></td>";
   echo "<input type=\"hidden\" name=\"login\" value=\"$login\">";
      echo "<td><center><input type=\"submit\" class='button4 button' name=\"man_form\" value=\"Performance Assessment\" onClick=\"manForm()\"></center></td>";
   echo "<input type=\"hidden\" name=\"login\" value=\"$login\">";
   echo "<input type=\"hidden\" name=\"appr_to\" value=\"$appr_to\">";
   //echo "<td><input type=\"submit\" class='button button4' name=\"exit\" value=\"Back\" onClick = \"exitProj()\">";
   echo "</tr>";
   echo "</table>";
   echo "</center>";
   echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
   echo "<input type=\"hidden\" name=\"appr_to\" value=\"$appr_to\">";
   echo "<input type=\"hidden\" name=\"login\" value=\"$login\">";
   echo "</FORM>";
?>

</body>
</html>

