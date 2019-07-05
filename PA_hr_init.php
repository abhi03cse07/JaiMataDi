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
</script>			
</head>
<body bgcolor="#CDE1EB">
<h2 align = "center">Periodic Performance Appraisal System</h2>
<h3 align = "center">(Strictly Personal and Confidential)</h3>
<h3 align = "center">Employee Appraisal Initiation Form</h3>
<?
include "tsutils.php";
include "pasutils.php";
$db_conn=db_open("pas_db",0);
echo"<form action=\"PA_hr_init_save.php\" name=\"f1\" method=\"POST\">";
$qtr_result=pg_query($db_conn,"select * from i_qtr_def ");
$no=pg_num_rows($qtr_result);
echo"<table width=\"75%\" align=\"center\" border=\"1\" >
<tbody><tr><td width=\"55%\">Period</td> <td align=\"left\">"; 
echo"<SELECT name=\"qtr_com\" tabindex=\"1\">
<option></option>";
for($i=0;$i<$no;$i++)
{
$qtr_arr=pg_fetch_array($qtr_result,$i);
$qtr_desc=trim($qtr_arr[qtr_desc]);
echo"<option value=\"$qtr_desc\">$qtr_desc</option>";
}                                         

echo"</SELECT></td> </tr></tbody></table>";
//echo"<table width=\"75%\" border=\"1\" style=\"margin-left:92px\"><tbody>";
echo"<table width=\"75%\" border=\"1\" align=\"center\"><tbody>";
echo"<tr><td >Last date for closure of Self Appraisal </td><td>";
echo "<select name=\"emp_dd\" >";
echo "<option></option>";
for($cntr=1;$cntr<=31;$cntr++)
echo "<option >$cntr</option>";
echo "</select>";
$months = array(1=>"Jan",2=>"Feb",3=>"Mar",4=>"Apr",5=>"May",6=>"Jun",7=>"Jul",8=>"Aug",9=>"Sep",10=>"Oct",11=>"Nov",12=>"Dec");
echo "<select name=\"emp_month\" ";
echo "<option></option>";
for($cntr=1;$cntr<=12;$cntr++)
echo "<option value=\"$cntr\">$months[$cntr]</option>";
echo "</select><select name=\"emp_year\">";
echo "<option></option>";
for($cntr=2005;$cntr<=2036;$cntr++)
echo "<option value=\"$cntr\">$cntr</option>";
echo "</select> </td>   </tr>";
echo"<tr><td width=65%>Last date for closure of Appraisal Meeting </td><td >";
echo "<select name=\"rh_dd\" >";
echo "<option></option>";
for($cntr=1;$cntr<=31;$cntr++)
echo "<option >$cntr</option>";
echo "</select>";
$months = array(1=>"Jan",2=>"Feb",3=>"Mar",4=>"Apr",5=>"May",6=>"Jun",7=>"Jul",8=>"Aug",9=>"Sep",10=>"Oct",11=>"Nov",12=>"Dec");
echo "<select name=\"rh_month\" ";
echo "<option></option>";
for($cntr=1;$cntr<=12;$cntr++)
echo "<option value=\"$cntr\">$months[$cntr]</option>";
echo "</select><select name=\"rh_year\">";
echo "<option></option>";
for($cntr=2005;$cntr<=2036;$cntr++)
echo "<option value=\"$cntr\">$cntr</option>";
echo "</select> </td>   </tr>";
echo"</tbody>
</table>";
//echo "<table width=\"75%\" border=\"1\" style=\"margin-left:92px\"><tbody>";
echo "<table width=\"75%\" border=\"1\" align=\"center\"><tbody>";
echo "<tr><td><center>Mail Content</center></td></tr>
<tr><td><center><textarea name=\"text_mssg\" cols=67 rows=5></textarea></center></td></tr>
</tbody></table>";
echo"<center> <BR><font size =\"4\" color = \"blue\">Check List</font>
      <table width = \"50%\" textalign = \"left\" border =\"0\">
      <tbody><tr>
      <td><b>1.Check out Employee numbers boundary</b></td></tr>
     <tr><td><b>2.Salary revision due date of all employees</b></td></tr>
     <tr><td><b>3.Birth date of newly added employees</b></td></tr>
     <tr><td><b>4.S,R,B flags of all employees - excel sheet </b></td></tr></tbody></table></center>";

echo"<br><br><center><INPUT type=\"submit\" name=\"init_proc\" value=\"Initiate\"></center>
<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo"</body>";
?>
</form>
</body>
</html>
