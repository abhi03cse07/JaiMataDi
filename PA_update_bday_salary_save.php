<html>
<title> Performance Appraisal System </title>
<body bgcolor = "#CDE1EB">
<?
include "../tsutils.php";
error_reporting(E_ERROR);

echo "<center><h2>Performance Appraisal System</h2></center>";
echo "<br>";

 if (! CheckAuthKey ($keychk))
   {
      Error ("Login");
      exit;
   }


$db_off = db_open();
$db_pas = db_open("pas_db",0);
////////////////////////////////////offproj database : table name : dob///////////////////////////////////////

$create_qry_off = pg_query($db_off,"create table dummy_sal_dob (emp_code_entered character(20), birthdate date, sr_due date, appr_flag character(1))");

/*
 Praveen
 The following line to copy the complete line is replaced with copy line by line command 
 the copy command doesnot work because it requires superuser permissions

//$copy_from_table = pg_query($db_off,"copy dummy_sal_dob (emp_code_entered, birthdate, sr_due, appr_flag ) from '/tmp/salary_bday.txt' delimiter as ','");

*/
$csvFile =  fopen("/tmp/salary_bday.txt", "r") or exit("Unable to open file!");
pg_query($db_off,"copy dummy_sal_dob from stdin delimiter as ','");
while(!feof($csvFile))
{
  pg_put_line($db_off,fgets($csvFile));
}
//pg_put_line($db_off,"\\.\n");
$copy_from_table = pg_end_copy($db_off);

fclose($csvFile);
/* 
   Changes by Praveen Completed.
*/

$drop_dob_qry = pg_query($db_off,"drop table dob");
// $drop_dob_qry = pg_query($db_off,"drop table if exists dob");

$create_dob_qry_off = pg_query($db_off,"create table dob as (select p1.emp_code ,p2.birthdate from emp_code_gen p1, dummy_sal_dob p2 where p1.emp_code_entered = p2.emp_code_entered)");

$alter_qry_off = pg_query($db_off,"alter table dob rename emp_code to eno");

 $drop_qry_off = pg_query($db_off,"drop table dummy_sal_dob");
 /*
  Praveen:
   The following copy command is replaced with pg_fetch_row and file write commands.
 $copy_to_qry_off = pg_query($db_off,"copy emp_code_gen (emp_code, emp_code_entered) to '/tmp/emp_value.txt' delimiter as ','"); 
 */

 $result = pg_query($db_off,"SELECT emp_code, emp_code_entered FROM emp_code_gen");
if(!$result)
{
 echo "Error in select query. Cannot write to a file";
 $copy_to_qry_off=false;
}
else
{
//  echo("<br> Writing to file");
 $file = fopen("/tmp/emp_value.txt","w");
 while($row = pg_fetch_row($result))
  {
   fputs($file,"$row[0],$row[1]\n");
  }
 $copy_to_qry_off=1;
}
/*
  Praveen Changes end here
*/

///////////////////////////////////////pas_db database : table name : salary_due, appr_system////////////////////////////////

$create_qry_pas = pg_query($db_pas,"create table dummy_sal_dob (emp_code_entered character(20), birthdate date, sr_due date, appr_flag character(1))");


/*
 Praveen
 The following line to copy the complete line is replaced with copy line by line command
 the copy command doesnot work because it requires superuser permissions

$copy_from_table_pas = pg_query($db_pas,"copy dummy_sal_dob (emp_code_entered, birthdate, sr_due, appr_flag) from '/tmp/salary_bday.txt' delimiter as ','");


*/
$csvFile =  fopen("/tmp/salary_bday.txt", "r") or exit("Unable to open file!");
pg_query($db_pas,"copy dummy_sal_dob from stdin delimiter as ','");
while(!feof($csvFile))
{
  pg_put_line($db_pas,fgets($csvFile));
}
$copy_from_table_pas = pg_end_copy($db_pas);

fclose($csvFile);
/*
   Changes by Praveen Completed.
*/


$drop_dob_qry = pg_query($db_pas,"drop table salary_due");

$create_emp_code_gen_table = pg_query($db_pas,"create table emp_code_gen(emp_code smallint, emp_code_entered character(20))");

/*
 Praveen
 The following line to copy the complete line is replaced with copy line by line command
 the copy command doesnot work because it requires superuser permissions

$copy_emp_code_gen_qry = pg_query($db_pas,"copy emp_code_gen (emp_code, emp_code_entered) from '/tmp/emp_value.txt' delimiter as ',' ");
*/
$csvFile =  fopen("/tmp/emp_value.txt", "r") or exit("Unable to open file!");
pg_query($db_pas,"copy emp_code_gen from stdin delimiter as ','");
while(!feof($csvFile))
{
  pg_put_line($db_pas,fgets($csvFile));
}
$copy_emp_code_gen_qry = pg_end_copy($db_pas);

fclose($csvFile);
/*
   Changes by Praveen Completed.
*/


$create_sal_qry_pas = pg_query($db_pas,"create table salary_due as (select p1.emp_code,p2.sr_due from emp_code_gen p1, dummy_sal_dob p2 where p1.emp_code_entered = p2.emp_code_entered)");

$delete_from_appr_systems = pg_query($db_pas,"drop table appr_system");
$copy_into_appr_system = pg_query($db_pas,"create table appr_system as (select emp_code_entered, appr_flag from dummy_sal_dob)");

$alter_appr_system = pg_query ($db_pas,"alter table appr_system rename emp_code_entered to emp_code");
$alter_qry_pas = pg_query ($db_pas,"alter table salary_due rename emp_code to eno");


$drop_qry_pas = pg_query($db_pas,"drop table dummy_sal_dob");
$drop_emp_code_gen = pg_query($db_pas,"drop table emp_code_gen");

//////////////////////////// echos the message into the display /////////////////////////////

if ($copy_from_table)
{
   
   $res = pg_query ($db_pas, "UPDATE i_qtr_def set emp_limit='$lastemp' where qtr_desc='$qtrnum'");
   if (! $res)
      echo "ERROR!!";
 
        //cho"<br><center><font size = \"2\" color = \"blue\">Data updation failed </font></center>";
}
else
{
	
   echo "<br><center><font size = \"2\" color = \"red\">Data updation failed </font></center>";
	echo "<form action = \"PA_main_menu.php\" method = \"post\">";
	echo "<input type = \"hidden\" name = \"keychk\" value = \"$keychk\">";
	echo "<br><center><input type = \"submit\" name = \"back_frm_upd\" value = \"Exit\"></center>";
	exit;
}
if ($create_dob_qry_off){

        echo"<br><center><font size = \"2\" color = \"blue\">Birth dates for all employees is successfully updated </font></center>";

}else{	
	echo"<br><center><font size = \"2\" color = \"red\">Birth dates updation failed!!! </font></center>";
}

if($create_sal_qry_pas){

        echo"<center><font size = \"2\" color = \"blue\">Salary revision due dates for all employees is successfully updated </font></center>";

}else{	
	echo"<center><font size = \"2\" color = \"red\">Salary revision due dates updation failed!!! </font></center>";
}

if($copy_into_appr_system){

       echo"<center><font size = \"2\" color = \"blue\">Appraisal flags for all employees is successfully updated </font></center>";

}else{	
       echo"<center><font size = \"2\" color = \"red\">Appraisal flags updation failed!!! </font></center>";
}


echo"<form action = \"PA_main_menu.php\" method = \"post\">";
echo"<input type = \"hidden\" name = \"keychk\" value = \"$keychk\">";
echo"<br><center><input type = \"submit\" name = \"back_frm_upd\" value = \"Exit\"></center>";

?>
</body>
</html>
