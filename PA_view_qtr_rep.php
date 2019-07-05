<?
#############Modified By Akila for Bu wise Report on April 9th 2007#####################################
################# Modified by Akila and Archana for adding Recruitment Effectiveness Report Button in Consolidated Report and its Alignment ################
?>


<html>
<head>
<script language="JavaScript" src="calendar.js"></script>

<script type="text/javascript" >
function sendDate(fieldname)
{
 var cal = new calendar(document.forms[0].elements[fieldname]);
 cal.year_scroll = true;
 cal.time_comp = true;
 cal.popup();
}

function show_report()
{

	document.forms[0].action= "PA_report.php";
}

function next_form_ON()
{
	document.forms[0].action= "PA_training_req_rep.php";
}

function show_full_report()
{
       document.forms[0].action= "PA_consolidated_report.php";
}

function back_form()
{

         document.forms[0].action= "PA_main_menu.php";
}
</script>
<style>
table.roundedCorners { 
  border: 1px solid ;
  //border-radius: 13px; 
  border-spacing: 0;
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
</head>
<body style='background-color: #CDE1EB !important;'>

<?
error_reporting(0);
include_once('head.php');
//include "../tsutils.php";
include "pasutils.php";
//error_reporting(E_ERROR);
$db_conn=db_open("pas_db",0);
$db_con=db_open("offproj",0);
//echo"<form action=\"PA_report.php\" name=\"f1\" method=\"POST\">";
echo"<form name=\"f1\" method= \"POST\" >";
//echo"<form method = \"post\">";
$qtr_result=pg_query($db_conn,"select * from i_qtr_def ");
$no=pg_num_rows($qtr_result);

/************** Modified by Akila **********/
$ecode = EmpCodeFromAuthKey($keychk);
$emp_enter= pg_query($db_con,"select emp_code_entered from emp_code_gen where emp_code = $ecode");
$ec=pg_fetch_array($emp_enter,0);
$ec_num=$ec[emp_code_entered];
//For Listing the BU's
$bu_result=pg_query($db_con,"select * from bu_master");
$no1=pg_num_rows($bu_result);
//To Identify the BU Head
$bu_head=pg_query($db_con,"select * from bu_master where bu_head=$ec_num");
$num_buh = pg_num_rows($bu_head);
$b_ar=pg_fetch_array($bu_head,0);
$b_c=$b_ar[bu_code];
//To Get access of the special users
$view_rep = pg_query($db_conn,"select access_view,access_report from pa_view where emp_code=$ecode");
$view_arr=pg_fetch_array($view_rep,0);
$access_view =$view_arr[access_view];
$access_report=$view_arr[access_report];
######################################## Emp Rec #########################################################################
echo"<br><br><br><table class='roundedCorners' width=\"75%\" align=\"center\" border=\"1\" >
<tbody><tr><td width=\"50%\">Select the period & BU </td> <td align=\"left\">";
echo"<SELECT name=\"qtr_com\" tabindex=\"1\">
<option></option>";
for($i=0;$i<$no;$i++)
{
$qtr_arr=pg_fetch_array($qtr_result,$i);
$qtr_desc=trim($qtr_arr[qtr_desc]);
echo"<option value=\"$qtr_desc\">$qtr_desc</option>";
}
echo"</SELECT> BU <SELECT name=\"bu1\">";
if($access_report=='t'||!$num_buh || $access_view =='t')
{
 echo "<option>All</option>";
 for($i=0;$i<$no1;$i++)
 {
  $bu_arr=pg_fetch_array($bu_result,$i);
  $bu_code=trim($bu_arr[bu_code]);
  echo"<option value=\"$bu_code\">$bu_code</option>";
 }
}
else
{
  echo "<option value=\"$b_c\">$b_c</option>";
}
//*****************************************************************************//
echo"</SELECT></td></tr>";
echo"<tr><td>View employee's appraisal report</td>";
echo "<td><INPUT type=\"submit\" name=\"init_proc\" value=\"Appraisal Report\" onClick = \"show_report()\"></td></tr>";
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo"<tr><td>View employee's training report</td>";
echo "<td><INPUT type=\"submit\" name=\"training_proc\" value=\"Training  Report\" onClick= \"next_form_ON()\"></td></tr>";
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
//echo "</tbody>";
//echo "<table style=\"width: 75%; text-align: center;\" align= \"center\" border=\"1\"><tbody>";
echo "<tr><td colspan='2'><span style='font-weight:bold'>CONSOLIDATED REPORTS</span></td></tr>";
//echo "<table style=\"width: 75%; text-align: left;\" align= \"center\" border=\"1\"><tbody>";
echo "<tr><td width=\"50%\">Select the financial year :</td>";

echo "<td><select name=\"f_year\">";
echo "<option></option>";
for($cntr=2005;$cntr<=2036;$cntr++)
    {
     $cntr2 = $cntr+1; 
     $cntr1 = $cntr."-".$cntr2;
     echo "<option value=\"$cntr\">$cntr1</option>";
    }
//******** Added by Akila *****************//

echo "</select> BU <SELECT name=\"bu2\">";
if($access_report=='t'||!$num_buh || $access_view=='t')
{
 echo "<option>All</option>";
  for($i=0;$i<$no1;$i++)
  {
   $bu_arr=pg_fetch_array($bu_result,$i);
   $bu_code=trim($bu_arr[bu_code]);
   echo"<option value=\"$bu_code\">$bu_code</option>";
  }
}

else
{
  echo "<option value=\"$b_c\">$b_c</option>";
}
echo"</SELECT> </td></tr>";

//*********** Ended by Akila **************//

//echo "<table style=\"width: 68%; text-align: center;\" align= \"center\" border=\"1\"><tbody>";
echo "<tr><td align= \"left\" width=\"50%\">View Appraisal Report : </td>";
echo "<td align= \"left\" ><INPUT type=\"submit\" name=\"conso_rep\" value=\"Appraisal Report\" onClick= \"show_full_report()\"></td></tr>";
echo "<tr><td align= \"left\" width=\"50%\">View Recruitment Effectiveness  Report : </td>";
echo "<td align= \"left\" ><INPUT type=\"submit\" name=\"rec_rep\" value=\"Recruitment Effectiveness Report\" onClick= \"show_full_report()\"></td></tr>";
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo "</tbody></table>";

//echo "<BR><BR><center><INPUT type=\"submit\" name=\"conso_rep\" value=\"Exit\" onClick= \"back_form()\"></center>";

############################################################################################################################
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
?>
</font>
</body>
</html>

