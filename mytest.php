<?
include_once "tsutils.php";
error_reporting(E_ERROR);
$pas_db = db_open("pas_db",0);
$db_conn = db_open("offproj",0);
$result_due  = pg_query($pas_db,"select eno,due from temp");
$rows = pg_num_rows($result_due);
for($i=0;$i<$rows;$i++)
{
$result_arr = pg_fetch_array($result_due,$i);
echo"$result_arr:aaa";
$Eno  = $result_arr[eno]; 
$Due  = $result_arr[due]; 
$due_d = explode('/',$Due);
$due = $due_d[2].'-'.$due_d[0].'-'.$due_d[1];
$result_in = pg_query($pas_db,"insert into salary_due (eno,due) values($Eno,'$due')");
}
$result_dob  = pg_query($db_conn,"select eno,birthdate from temp");
$nrows = pg_num_rows($result_dob);
//echo"nrows:$nrows";
for($i=0;$i<$nrows;$i++)
{
$result_dob_arr = pg_fetch_array($result_dob,$i);
$Eno1  = $result_dob_arr[eno]; 
$BirthDate  = $result_dob_arr[birthdate]; 
$dob_d = explode('/',$BirthDate);
$dob = $dob_d[2].'-'.$dob_d[0].'-'.$dob_d[1];
if($dob=='--')
{
echo"dob:$dob";
$dob11='null'; 
$result_b = pg_query($db_conn,"insert into dob(eno,birthdate) values($Eno1,$dob11)");
echo"insert into dob(Eno,BirthDate) values($Eno1,$dob11)";
}
if($dob!='--')
{
$result_br = pg_query($db_conn,"insert into dob(eno,birthdate) values($Eno1,'$dob')");
}
}
?>
