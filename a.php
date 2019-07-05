<?php
include "../tsutils.php";
error_reporting(E_ERROR);

      

$db_off = db_open();
$db_pas = db_open("pas_db",0);
#$create_qry_off = pg_query($db_off,"create table dum_sal (emp_code_entered character(20), birthdate date, sr_due date, appr_flag character(1))");
//echo exec('echo "\." >> /tmp/sal2.txt');
//echo exec('cat /tmp/b.txt /tmp/sal2.txt > /tmp/temp.txt');
//echo exec('mv /tmp/temp.txt /tmp/sal2.txt');

echo exec('psql offproj < /tmp/sal2.txt');
//echo exec('tr \, "\t" < /tmp/emp_list.txt > /tmp/new_file');
$copy_from_table = pg_query($db_off,"\copy dum_sal from '/tmp/sal2.txt'");

$create_qry_pas = pg_query($db_pas,"create table dum_sal (emp_code_entered character(20), birthdate date, sr_due date, appr_flag character(1))");

echo exec('psql pas_db < /tmp/sal2.txt');
$copy_from_table1 = pg_query($db_pas,"\copy dum_sal_dob from '/tmp/sal2.txt'");

?>


