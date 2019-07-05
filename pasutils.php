<?

function DateValidation ($dd, $mm, $yy, $name)
{
   if($dd && $mm && $yy)
     {
        if(!checkdate($mm,$dd,$yy))
          {
  echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please enter a valid $name</font></b></center>";
  exit();
   }
else
 {
  if(is_num($dd) == 0)
    {
     echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please enter a valid
    day for $name</font></b></center>";
          exit();
     }
       if(is_num($mm) ==0)
       {
       echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please enter a valid
       month for $name</font></b></center>";
           exit();
	   }
         if($yy < 1000 || $yy > 9999)
         {
	            echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please enter a valid year for $name</font></b></center>";
	               exit();
	            }
           }
   }
 }
		 
/*Function dateSelect($date,$month,$year,$def_flag)
 {
if($def_flag ==1)
 {
  $cur_date = date("j"); 
  $cur_mon = date("M");
  $cur_year = date("Y");
 }
echo "<select name=$date>";
echo "<option></option>";
for($cntr=1;$cntr<=31;$cntr++) {
if(($cntr==$cur_date) && !$date)
    	echo "<option selected>$cntr</option>";
else
   if($cntr==$cur_date)
    	echo "<option selected>$cntr</option>";
   else 	
    	echo "<option value=\"$cntr\">$cntr</option>";
}
echo "</select>";

//Code for the month Field
$months = array
(
1=>"Jan",
2=>"Feb",
3=>"Mar",
4=>"Apr",
5=>"May",
6=>"Jun",
7=>"Jul",
8=>"Aug",
9=>"Sep",
10=>"Oct",
11=>"Nov",
12=>"Dec"
);

echo "<select name=$month>";
echo "<option></option>";
for($cntr=1;$cntr<=12;$cntr++) {
if(($months[$cntr]==$cur_mon) && !$month)
	echo "<option selected value=\"$cntr\">$months[$cntr]</option>";
else
   if($months[$cntr]==$cur_mon)
	echo "<option selected value=\"$cntr\">$months[$cntr]</option>";
   else 	
    echo "<option value=\"$cntr\">$months[$cntr]</option>";
}
echo "</select>";

//Code for the Year Field
echo "<select name=$year>";
echo "<option></option>";
for($cntr=2000;$cntr<=2036;$cntr++) {
	
if(($cntr==$cur_year) && !$year)
    	echo "<option selected>$cntr</option>";
else
   if($cntr==$cur_year)
    	echo "<option selected>$cntr</option>";
   else 	
    	echo "<option>$cntr</option>";
}
echo "</select>";
}
*/
Function sendMail($toaddr,$sub,$message,$from,$reply_to,$cc)
  {
     $mail = mail ($toappr, $sub, $message, "From: $PCC_ID\nReply-To: $tosendr\nCc: $cc") ;
  }
Function ReviewManager($emp_code)
{
$db_conn = db_open();
$ret_rev = pg_query($db_conn,"select reportsto from emp_master where emp_code = (select reportsto from emp_master where emp_code = $emp_code)");
$rev_arr =pg_fetch_array($ret_rev,0);
$ret_revmanager = $rev_arr[reportsto];
return $ret_revmanager; 
}
//Added By akila to get BU head as Reviewing Manager*********
Function GetReviewManager($emp_code)
{
$db_conn = db_open();
$bu_q=pg_query($db_conn,"select bu_code from emp_master where emp_code=$emp_code");
$bu_ar=pg_fetch_array($bu_q,0);

$bu_h=$bu_ar['bu_code'];
//echo $bu_h;
$ret_rev = pg_query($db_conn,"select emp_code from emp_code_gen where emp_code_entered in(select bu_head from bu_master where bu_code='$bu_h')");
$rev_arr =pg_fetch_array($ret_rev,0);

$ret_revmanager = $rev_arr[emp_code];
echo $ret_revmanager;
//******Temporary change for the Appraisal period May 2007 to July 2007*******

$res = pg_query ($db_conn,"SELECT reportsto FROM emp_master WHERE emp_code=$emp_code AND left_date is NULL"); 
$rec = pg_fetch_array ($res, 0);
$app=$rec[reportsto];
$temp_man=pg_query($db_conn,"select * from temp_rev_manager where emp_code='$app'");
$cnt=pg_num_rows($temp_man);
if($cnt)
{
      $ret_revmanager=1141;
}

if($app == 1141) 
{
      $ret_revmanager=275;
}


$temp_man_app=pg_query($db_conn,"select * from temp_rev_manager where emp_code='$emp_code'");
$count=pg_num_rows($temp_man_app);
if($count)
{
      $ret_revmanager=275;
}
                        

//****************************************************************************

return $ret_revmanager; 

}
//**************************************************************
/*Function EmpRateList($rlist)
{
$db_conn = db_open("pas_db",0);
$emp_rate = pg_query($db_conn,"select rate_code,rate_desc  from i_work_def");
$num_rows = pg_num_rows($emp_rate);
echo"<select name = $rlist onChange = \"fact()\">";
echo"<option></option>";
for($num=0;$num<=$num_rows;$num++){
$emp_rate_arr = pg_fetch_array($emp_rate,$num);
$rate_code = $emp_rate_arr[rate_code];
$rate_desc = trim($emp_rate_arr[rate_desc]);
echo"<option value = \"$rate_code\">$rate_desc</option>";
}
echo"</select>";
}*/
Function isExecutive($emp_code)
{
$db_conn = db_open();
$executive_query = pg_query($db_conn,"select grade from emp_master where  emp_code=$emp_code");
$executive_arr = pg_fetch_array($executive_query,0);
$exe_grade = $executive_arr[grade];
if($exe_grade>25)
return true;
else
return false;
pg_close();
}

// Function to check for the mail to be send to the corresponding reporting heads by ankur on 14 nov 2005

Function isReadyMail($emp_code)
{
$db_conn = db_open("pas_db",0);
$ready_query = pg_query($db_conn,"select emp_rate,emp_proj from pa_lock where  emp_code=$emp_code");
$ready_arr = pg_fetch_array($ready_query,0);
$emprate = trim($ready_arr[emp_rate]);
$empproj = trim($ready_arr[emp_proj]);
if($emprate=='t'&& $empproj=='t')
{
return true;
}
else
{
return false;
}
pg_close();
}
Function factor()
{
$db_conn =$db_open("pas_db");
$ifactor_query = pg_query($db_conn,"select sno,exec_wt,staff_wt  from i_factor");
$weight_arr = pg_fetch_array($ifactor_query,0);
$num_rows = pg_num_rows($ifactor_query);
for($num=0;$num<=$num_rows;$num++){
$exec_wt = $weight_arr[exec_wt];
$staff_wt = $weight_arr[staff_wt];
$sno = $weight_arr[sno];
if($num==0)
{
if(isExecutive($emp_code))
$x1 = $exec_wt; 
$x1 =$staff_wt; 
echo"x1:$x1";

}
if($num==1)
{
if(isExecutive($emp_code))
$x2 = $exec_wt; 
$x2 =$staff_wt; 
}
if($num==3)
{
if(isExecutive($emp_code))
$x3 = $exec_wt; 
$x3 =$staff_wt; 
}
if($num==4)
{
if(isExecutive($emp_code))
$x4 = $exec_wt; 
$x4 =$staff_wt; 
}
if($num==5)
{
if(isExecutive($emp_code))
$x5 = $exec_wt; 
$x5 =$staff_wt; 
}
if($num==6)
{
if(isExecutive($emp_code))
$x6 = $exec_wt; 
$x6 =$staff_wt; 
}
if($num==7)
{
if(isExecutive($emp_code))
$x7 = $exec_wt; 
$x7 =$staff_wt; 
}
if($num==8)
{
if(isExecutive($emp_code))
$x8 = $exec_wt; 
$x8 =$staff_wt; 
}
if($num==9)
{
if(isExecutive($emp_code))
$x9 = $exec_wt; 
$x9 =$staff_wt; 
}
if($num==10)
{
if(isExecutive($emp_code))
$x10 = $exec_wt; 
$x10 =$staff_wt; 
}
if($num==11)
{
if(isExecutive($emp_code))
$x11 = $exec_wt; 
$x11 =$staff_wt; 
}
if($num==12)
{
if(isExecutive($emp_code))
$x12 = $exec_wt; 
$x12 =$staff_wt; 
}

}
}
function period()
{
$db_pas=db_open("pas_db",0);
$qtr_result=pg_query($db_pas,"select qtr_start,qtr_end from pa_init");
$qtr_arr=pg_fetch_array($qtr_result);
$qtr_start=$qtr_arr[qtr_start];
$qtr_end=$qtr_arr[qtr_end];
$qtr_period=$qtr_start.' - '.$qtr_end;
echo"$qtr_period";
}
Function ShowStatusList($namelist)
{
       $db_pas = db_open("pas_db");
       $task_q = pg_query($db_pas,"select status_code,status_desc from i_task_def");
       $num_rows = pg_num_rows($task_q);
       echo"<select name=\"$namelist\">";
       echo"<option></option>";
       for($num=0;$num<$num_rows;$num++){
       $task_qar = pg_fetch_array($task_q,$num);
       $task_desc = trim($task_qar[status_desc]);
       $task_code = $task_qar[status_code];
       if(($namelist == $task_code) && !$namelist)
       echo"<option value = \"$task_code\" selected>$task_desc</option>";
       else
       if($namelist == $task_code)
       echo"<option value = \"$task_code\" selected>$task_desc</option>";
       else         
       echo"<option value = \"$task_code\">$task_desc</option>";
}
echo"</select>";
}

// New function Added by Ankur Kapoor

function Appraised_by($pk_sln)
{
	$db_pas = db_open("pas_db");
        $appr_exe = pg_query($db_pas,"select appr_by from pa_lock where pk_sl = $pk_sln");
 	$appr_arr = pg_fetch_array($appr_exe);
 	$apprby = $appr_arr[appr_by];
	
	return $apprby;	   

}

?>
