<html>
<head><title>Performance Appraisal System</title>
<script language ="JavaScript">

function back_form()
{
document.forms[0].action="PA_view_qtr_rep.php";
}

function home_form()
{
document.forms[0].action="PA_main_menu.php";

}
</script>
</head>

<?
error_reporting(0);
include "pasutils.php";
include "tsutils.php";
error_reporting(E_ERROR);
$db_pas=db_open("pas_db");
$res_year = pg_query($db_pas, "SELECT year FROM pa_init");
$res_fetch = pg_fetch_array($res_year);
//$cur_year = $res_fetch[year];
//$cur_year = $qtr_start;

//echo"<html>

echo"<body bgcolor=\"#CDE1EB\" >";
echo"<form name=\"f2\" TARGET=\"form\"  method=\"post\">";
echo"<center><h3> Performance Appraisal Status</h3> </center> <center><h4>Year: $cur_year &nbsp    Period: $qtr_com</h4></center>";

 echo"<center>";
 echo "<table border=\"0\" cellpadding=2 width=\"90%\">";
 echo "<tr>";


//echo "<td><center><input type=\"submit\" name=\"backform\" value=\"Back\" onClick=\"back_form()\"></center></td>";

//echo "<td><center><input type=\"submit\" name=\"homeform\" value=\"Exit\" onClick=\"home_form()\"></center></td>";
echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";

echo "</tr>";
echo "</table>";
echo "</center>";


//period();
echo"</form>";
echo"</body>";
?>	

</html>
