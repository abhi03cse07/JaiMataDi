<?php
session_start();
include_once('head.php');

?>

<html>
<head>
<style>
  table {
    border-collapse: collapse;
  }
  th, td {
    border: 1px solid;
    padding: 10px;
    text-align: left;
  }
</style>


<script src ="message.js">
</script>
<script language="JavaScript" type = "text/javascript">

     
       function exit_form()
       {
       window.location.href="PA_main_menu.php?userName=<?php echo $_SESSION['userName']; ?>&securityToken=<?php echo $_SESSION['token']; ?>";
       }
    
      function view()
      {
      document.f1.action= "PA_appr_emp_report.php";
      document.f1.submit();
      }
        function insert(theForm)
         {
      var l = theForm.tot.value;
	  var p1 = theForm.firstw.value;
	  if(p1==0.0)
	  {
	  //alert("Please Enter Quality of work field"); 
	  check(1);
	  theForm.firstw.focus(); 
	  return(false);
	  }
	  var p2 = theForm.secondw.value;
	  if(p2==0.0)
	  {
	   check(2); 
	  //alert("Please Enter Quantity of work field"); 
	   return(false);
	  }
	  var p3 = theForm.thirdw.value;
	  if(p3==0.0)
	  {
           check(3);	  
	 // alert("Please Enter Dependibility field"); 
	   return(false);
	   }
	  var p4 = theForm.fourw.value;
	  if(p4==0.0)
	  {
	   check(4);
		  // alert("Please Enter Job Knowledge  field"); 
	   return(false);
	   }
	 var p5 = theForm.fivew.value;
	  if(p5==0.0)
	  {
	  //alert("Please Enter Interest Initiative And Responsibility  field"); 
	  check(5); 
	  return(false);
	   }
	 var p6 = theForm.sixw.value;
	  if(p6==0.0)
	  {
	 // alert("Please Enter Spoken And Written Communication field"); 
	 check(6);  
	 return(false);
	   }
	 var p7 = theForm.sevenw.value;
	  if(p7==0.0)
	  {
	  //alert("Please Discipline And Time Control field"); 
	  check(7); 
	  return(false);
	   }
	  var p8 = theForm.eightw.value;
	  if(p8==0.0)
	  {
	   check(8);
		  //alert("Please Enter Creativity ,Intelligence And Mental Calibre field"); 
	  return(false);
	   }
	  var p9 = theForm.ninew.value;
	  if(p9==0.0)
	  {
	 // alert("Please Enter Interpersonal Relationship And Adaptability field"); 
	 check(9);  
	 return(false);
	   }
	  var p10 = theForm.tenw.value;
	  if(p10==0.0)
	  {
	  //alert("Please Enter Team work field"); 
	 check(10); 
	  return(false);
	   }
	  var p11 = theForm.elevenw.value;
	  if(p11==0.0)
	  {
	 // alert("Please Enter Leadership field"); 
	 check(11);  
	 return(false);
	   }
	  var p12 = theForm.twelvew.value;
	  if(p12==0.0)
	  {
	 // alert("Please Enter Planning And Organizing field"); 
	  check(12);  
	 return(false);
	   }
//	  document.f1.action ="PA_appr_insert_above.php";
	             var xx1 = document.f1.first.value;
	             var yy1 = document.f1.rlist1.value;
		     var zz1 = xx1*yy1;
                     //zz1 = zz1.toFixed(1);
                     zz1 = Math.round(zz1*10)/10;
	            var rs1 = document.f1.firstw.value;
		    if(rs1!=zz1)
		    {
		    alert("You can not edit  weighted rating of \"Quality of Work\"field of Employee");
		    return(false); 
	            }
	             var xx2 = document.f1.second.value;
	             var yy2 = document.f1.rlist2.value;
		     var zz2 = xx2*yy2;
                     //zz2 = zz2.toFixed(1);
                     zz2 = Math.round(zz2*10)/10;
	            var rs2 = document.f1.secondw.value;
		    if(rs2!=zz2)
		    {
		    alert("You can not edit  weighted rating of \"Quantity of Work\"field of Employee");
		    return(false); 
	            }
	             var xx3 = document.f1.third.value;
	             var yy3 = document.f1.rlist3.value;
		     var zz3 = xx3*yy3;
                    // zz3 = zz3.toFixed(1);
                     zz3 = Math.round(zz3*10)/10;
	            var rs3 = document.f1.thirdw.value;
		    if(rs3!=zz3)
		    {
		    alert("You can not edit  weighted rating of \"Dependibilty\"field of Employee");
		    return(false); 
	            }
	             var xx4 = document.f1.four.value;
	             var yy4 = document.f1.rlist4.value;
		     var zz4 = xx4*yy4;
                     //zz4 = zz4.toFixed(1);
                     zz4 = Math.round(zz4*10)/10;
	            var rs4 = document.f1.fourw.value;
		    if(rs4!=zz4)
		    {
		    alert("You can not edit  weighted rating of \"Job Knowledge\"field of Employee");
		    return(false); 
	            }
	             var xx5 = document.f1.five.value;
	             var yy5 = document.f1.rlist5.value;
		     var zz5 = xx5*yy5;
                     //zz5 = zz5.toFixed(1);
                     zz5 = Math.round(zz5*10)/10;
	            var rs5 = document.f1.fivew.value;
		    if(rs5!=zz5)
		    {
		    alert("You can not edit  weighted rating of \"Interest,Initiative And Responsibility\"field of Employee");
		    return(false); 
	            }
	             var xx6 = document.f1.six.value;
	             var yy6 = document.f1.rlist6.value;
		     var zz6 = xx6*yy6;
                     //zz6 = zz6.toFixed(1);
                     zz6 = Math.round(zz6*10)/10;
	            var rs6 = document.f1.sixw.value;
		    if(rs6!=zz6)
		    {
		    alert("You can not edit  weighted rating of \"Spoken And Written Communication\"field of Employee");
		    return(false); 
	            }
	             var xx7 = document.f1.seven.value;
	             var yy7 = document.f1.rlist7.value;
		     var zz7 = xx7*yy7;
                     //zz7 = zz7.toFixed(1);
                     zz7 = Math.round(zz7*10)/10;
	            var rs7 = document.f1.sevenw.value;
		    if(rs7!=zz7)
		    {
		    alert("You can not edit  weighted rating of \"Discipline And Time Control\"field of Employee");
		    return(false); 
	            }
	             var xx8 = document.f1.eight.value;
	             var yy8 = document.f1.rlist8.value;
		     var zz8 = xx8*yy8;
                     //zz8 = zz8.toFixed(1);
                     zz8 = Math.round(zz8*10)/10;
	            var rs8 = document.f1.eightw.value;
		    if(rs8!=zz8)
		    {
		    alert("You can not edit  weighted rating of \"Creativity,Intelligence And Mental Calibre\"field of Employee");
		    return(false); 
	            }
	             var xx9 = document.f1.nine.value;
	             var yy9 = document.f1.rlist9.value;
		     var zz9 = xx9*yy9;
                     //zz9 = zz9.toFixed(1);
                     zz9 = Math.round(zz9*10)/10;
	            var rs9 = document.f1.ninew.value;
		    if(rs9!=zz9)
		    {
		    alert("You can not edit  weighted rating of \"Interpersonal Relationship And Adaptability\"field of Employee");
		    return(false); 
	            }
	             var xx10 = document.f1.ten.value;
	             var yy10= document.f1.rlist10.value;
		     var zz10 = xx10*yy10;
                     //zz10 = zz10.toFixed(1);
                     zz10 = Math.round(zz10*10)/10;
	            var rs10 = document.f1.tenw.value;
		    if(rs10!=zz10)
		    {
		    alert("You can not edit  weighted rating of \"Team Work\"field of Employee");
		    return(false); 
	            }
	             var xx11 = document.f1.eleven.value;
	             var yy11= document.f1.rlist11.value;
		     var zz11 = xx11*yy11;
                     //zz11 = zz11.toFixed(1);
                     zz11 = Math.round(z111*10)/10;
	            var rs11 = document.f1.elevenw.value;
		    if(rs11!=zz11)
		    {
		    alert("You can not edit  weighted rating of \"Leadership\"field of Employee");
		    return(false); 
	            }
	             var xx12 = document.f1.twelve.value;
	             var yy12= document.f1.rlist12.value;
		     var zz12 = xx12*yy12;
                     //zz12 = zz12.toFixed(1);
                     zz12 = Math.round(zz12*10)/10;
	            var rs12 = document.f1.twelvew.value;
		    if(rs12!=zz12)
		    {
		    alert("You can not edit  weighted rating of \"Planning And Organizing\"field of Employee");
		    return(false); 
	            }
		    var ztot = parseFloat(zz1)+parseFloat(zz2)+parseFloat(zz3)+parseFloat(zz4)+parseFloat(zz5)+parseFloat(zz6)+parseFloat(zz7)+parseFloat(zz8)+parseFloat(zz9)+parseFloat(zz10)+parseFloat(zz11)+parseFloat(zz12); 
		   var rstot = document.f1.tot.value;
		   //ztot = ztot.toFixed(1);
                     ztot = Math.round(ztot*10)/10;
		   if(rstot!=ztot)
		    {
		    alert("You can not edit  total score field of Employee");
		    return(false);
		    } 
      
     
            }
                function fact()
                  {
	              var x1 = document.f1.first.value;
	             var y1 = document.f1.rlist1.value;
		     var z1 = x1*y1;
                     //z1 = z1.toFixed(1);
                     z1 = Math.round(z1*10)/10;
		     document.f1.firstw.value = z1;
	             var x2 = document.f1.second.value;
	             var y2 = document.f1.rlist2.value;
		     var z2 = x2*y2;
                    //z2 = z2.toFixed(1);
                     z2 = Math.round(z2*10)/10;
		     
		    document.f1.secondw.value = z2;
	             var x3 = document.f1.third.value;
	             var y3 = document.f1.rlist3.value;
		     var z3 = x3*y3;
                     //z3 = z3.toFixed(1);
                     z3 = Math.round(z3*10)/10;
		     document.f1.thirdw.value = z3;
	             var x4 = document.f1.four.value;
	             var y4 = document.f1.rlist4.value;
		     var z4 = x4*y4;
                     //z4 = z4.toFixed(1);
                     z4 = Math.round(z4*10)/10;
		     document.f1.fourw.value = z4;
	             var x5 = document.f1.five.value;
	             var y5 = document.f1.rlist5.value;
		     var z5 = x5*y5;
                     //z5 = z5.toFixed(1);
                     z5 = Math.round(z5*10)/10;
		     document.f1.fivew.value = z5;
	             var x6 = document.f1.six.value;
	             var y6 = document.f1.rlist6.value;
		     var z6 = x6*y6;
                     //z6 = z6.toFixed(1);
                     z6 = Math.round(z6*10)/10;
		     document.f1.sixw.value = z6;
	             var x7 = document.f1.seven.value;
	             var y7 = document.f1.rlist7.value;
		     var z7 = x7*y7;
                     //z7 = z7.toFixed(1);
                     z7 = Math.round(z7*10)/10;
		     document.f1.sevenw.value = z7;
	             var x8 = document.f1.eight.value;
	             var y8 = document.f1.rlist8.value;
		     var z8 = x8*y8;
                     //z8 = z8.toFixed(1);
                     z8 = Math.round(z8*10)/10;
		     document.f1.eightw.value = z8;
	             var x9 = document.f1.nine.value;
	             var y9 = document.f1.rlist9.value;
		     var z9 = x9*y9;
		    //  z9 = parseFloat(z9);
                     //z9  = z9.toFixed(1);
                     z9 = Math.round(z9*10)/10;
		     document.f1.ninew.value = z9;
	             var x10 = document.f1.ten.value;
	             var y10 = document.f1.rlist10.value;
		     var z10 = x10*y10;
                     //z10 = z10.toFixed(1);
                     z10 = Math.round(z10*10)/10;
		     // z10 = parseFloat(z10);
		     document.f1.tenw.value = z10;
	             var x11 = document.f1.eleven.value;
	             var y11 = document.f1.rlist11.value;
		     var z11 = x11*y11;
		     // z11 = z11.toFixed(1);
                     z11 = Math.round(z11*10)/10;
		     document.f1.elevenw.value = z11;
	             var x12 = document.f1.twelve.value;
	             var y12 = document.f1.rlist12.value;
		     var z12 = x12*y12;
                     //z12 = z12.toFixed(1);
                     z12 = Math.round(z12*10)/10;
		     document.f1.twelvew.value = z12;
             
		    var z = parseFloat(z1)+parseFloat(z2)+parseFloat(z3)+parseFloat(z4)+parseFloat(z5)+parseFloat(z6)+parseFloat(z7)+parseFloat(z8)+parseFloat(z9)+parseFloat(z10)+parseFloat(z11)+parseFloat(z12); 
	             //z= z.toFixed(1); 
	             //z= z.toFixed(1); 
                     z = Math.round(z*10)/10;
                     document.f1.tot.value = z;
	            //var rst = document.f1.tot.value;
		   // if(rst!=z)
		   // {
		   // alert("You can not edit  total score field of Employee");
		   // return(false); 
	           // }
		       
		    }

		  function view1()
                  {
					  
                     document.forms[0].action="PA_appr_self.php";
                     } 
		  function frm_exit()
                  {
                    var name=confirm("You have choosen to fill project assessment form later"); 
                  if(name==true)
                   document.forms[0].action="PA_main_menu.php";
                  else
                  return(false);
                    } 
		  function proj()
                  {
                     document.forms[0].action="PA_appr_prev.php";
                     } 
	   

                    </script>
													       


<title>Performance Appraisal Form</title>


</head>
<body style="background-color: #CDE1EB !important;">
<?
#print_r($_POST);
//include "../tsutils.php";
include "pasutils.php";
#require "PA_appr_next_insert.php";
error_reporting(E_ERROR);


 if (! CheckAuthKey ($keychk))
   {
      Error ("Login");
      exit;
   }

echo"<form name =\"f1\"  method=\"post\" onSubmit = \"return insert(this)\">";
$db_conn = db_open("offproj",0);
$db_pas = db_open("pas_db",0);

$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$year =$key_arr[year];                                                                         $qtr =$key_arr[qtr];



if($next_scr)
 {
$ecode = EmpCodeFromAuthKey($keychk);
$result_test = pg_query($db_pas,"select emp_rate from pa_lock where emp_code = $ecode and year = $year and qtr = $qtr");
$res_rate = pg_fetch_array($result_test,0);
$pk_rate =$res_rate[emp_rate];
if($pk_rate)
{
echo "<BR><br><BR><center><b>Data could not be added</b></center>";
exit();
}

//$result_key = pg_query($db_pas,"select pk_sl from pa_lock where emp_code = $ecode and year =$year and qtr = $qtr");
$find_rec = pg_query($db_pas,"select pk_sl,emp_rate,emp_proj from pa_lock where emp_code = $ecode and year = $year and qtr = $qtr");
//changed for either option
$find_num = pg_num_rows($find_rec);
//changed....
$pl_fetch = pg_fetch_array($find_rec,0);
$emp_rate = $pl_fetch[emp_rate];
$emp_proj = $pl_fetch[emp_proj];
$pk_sll = $pl_fetch[pk_sl];
if($find_num == 0||(($emp_rate=='t')&&(!($emp_proj)))||$emp_proj)
 {
     //Changed for filling either Form
     if(($emp_rate=='t')&&(!($emp_proj))||$emp_proj)
       {
        $pk_sl=$pk_sll;
	}
       else
         {
          $find_maxsl = pg_query($db_pas,"select max(pk_sl) as pk_sl from pa_lock ");
          $sl_fetch = pg_fetch_array($find_maxsl,0);
          $pk_sl = $sl_fetch[pk_sl];
          $pk_sl = (int)$pk_sl;
	  if(!$pk_sl) $pk_sl = 1;
          else $pk_sl++;
       $pa_lock_ins= pg_query($db_pas,"insert into pa_lock(emp_code,year,qtr,pk_sl) values($ecode,$year,$qtr,$pk_sl)");
      }						  
    }
																				     


//changed for either option

//$res_arr = pg_fetch_array($result_key,0);
//$pk_sl =$res_arr[pk_sl];
//$subm_date =date("d-m-Y",mktime(0,0,0,date("j"),date("n"),date("y"))); 
$subm_date =date("d-m-Y"); 
$sub_date = explode("-",$subm_date);
$sub_date_today = $sub_date[2].'-'.$sub_date[1].'-'.$sub_date[0];
$result = pg_exec($db_pas,"insert into pa_assess(emp_rate,emp_rate_w,emp_total,pk_sl,sub_date) values(array[$rlist1,$rlist2,$rlist3,$rlist4,$rlist5,$rlist6,$rlist7,$rlist8,$rlist9,$rlist10,$rlist11,$rlist12],array[$firstw,$secondw,$thirdw,$fourw,$fivew,$sixw,$sevenw,$eightw,$ninew,$tenw,$elevenw,$twelvew],$tot,$pk_sl,'$sub_date_today')"); 


if($result)
 {
 $emp_lock_mod = pg_query($db_pas,"update pa_lock set emp_rate = true,mgr_rate =false where pk_sl = $pk_sl and year=$year and qtr=$qtr"); 
$mailserver="integramicro.com";
//$mailserver="tuxedo.integramicro.co.in";
$mailtorh=isReadyMail($ecode);
/*if($mailtorh)
{
$empname=EmpNameFromEmpCode($ecode);
$mailRH = pg_query($db_conn,"select reportsto from emp_master where emp_code= $ecode");
$mailRH_arr=pg_fetch_array($mailRH,0);
$RH_code= $mailRH_arr[reportsto];
$loginRH = pg_query($db_conn,"select login from emp_master where emp_code= $RH_code");
$loginRH_arr=pg_fetch_array($loginRH,0);
$RH_login=trim($loginRH_arr[login]);
$RH_name=EmpNameFromEmpCode($RH_code);
// Added by Ankur kapoor on 3rd feb 2006
$loginEMP = pg_query($db_conn,"select login from emp_master where emp_code = $ecode");
$loginEMP_arr = pg_fetch_array($loginEMP,0);
$EMP_login = trim($loginEMP_arr[login]);


$em_code=EcodeEnteredFromEcode($ecode);
$toaddr= $RH_login."@$mailserver";
$toaddr2 = $EMP_login."@mailserver";
//echo "$toaddr";
$sub= "Intemation of completion of self Appraisal :- $empname";
$mesg= "$empname($em_code) has completed his/her self appraisal form.\nPlease intimate $empname the date of appraisal meeting.";

// Modified by Ankur Kapoor on 3rd feb 2006

$mesg2 = "Dear $empname ($em_code),
          You have successfully completed your appraisal form for the current quater.
            
          A mail has been sent to your reporting head $RH_name regarding the completion
          of your appraisal form.";

$sub2 = "Intemation of completion of your self Appraisal : - $empname";
 
         
$cc="From: $PCC_ID\nReply-To: $tosendr\nCc: $cc";
$cc2="From: $PCC_ID\nReply-To: $tosendr\nCc: $cc";


$ismail=mail($toaddr,$sub,$mesg,$cc);
if(!$ismail )
{
echo "<br><br><br><br><center><b>mail couldnot be send</b></center><br><br>";
}

echo "<BR><center><b>A mail has been sent to your reporting head</b></center>";
echo "<BR><center><b>$RH_name</b></center>";
echo "<BR><center><b>Regarding the completion of your appraisal form</b></center>";
}*/

echo "<BR><br><BR><center><b>Data updated successfully</b></center>";

if(!$emp_proj)
{
	echo"<br><b><center>Do you want to fill project assessment form</b></center><br>
	<center><input type=\"submit\" name=\"sb2\" value=\"Yes\" onClick =\"proj()\">
	<input type=\"submit\" name=\"sb3\" value=\"No\" onClick=\"frm_exit()\"></center>";
          echo"<input type = \"hidden\" name =\"keychk\" value =\"$keychk\"  >";
           exit();
   }

else
{

if($mailtorh)
{
$empname=EmpNameFromEmpCode($ecode);
$mailRH = pg_query($db_conn,"select reportsto from emp_master where emp_code= $ecode");
$mailRH_arr=pg_fetch_array($mailRH,0);
$RH_code= $mailRH_arr[reportsto];
$loginRH = pg_query($db_conn,"select login from emp_master where emp_code= $RH_code");
$loginRH_arr=pg_fetch_array($loginRH,0);
$RH_login=trim($loginRH_arr[login]);
$RH_name=EmpNameFromEmpCode($RH_code);

// Added by Ankur kapoor on 3rd feb 2006
$loginEMP = pg_query($db_conn,"select login from emp_master where emp_code = $ecode");
$loginEMP_arr = pg_fetch_array($loginEMP,0);
$EMP_login = trim($loginEMP_arr[login]);


$em_code=EcodeEnteredFromEcode($ecode);
$toaddr= $RH_login."@$mailserver";
$toaddr2 = $EMP_login."@$mailserver";
//echo "$toaddr";
$sub= "Intimation of completion of self Appraisal :- $empname";
$mesg= "$empname($em_code) has completed his/her self appraisal form.\nPlease intimate $empname the date of appraisal meeting.";
// Modified by Ankur Kapoor on 3rd feb 2006

$mesg2 = "Dear $empname ($em_code),
          You have successfully completed your appraisal form for the current quater.
            
          A mail has been sent to your reporting head $RH_name regarding the completion
          of your appraisal form.";

$sub2 = "Intimation of completion of your self Appraisal";
 
$cc="From: $PCC_ID\nReply-To: $tosendr\nCc: $cc";
//$cc2="From: $PCC_ID\nReply-To: $tosendr\nCc: $cc";

$ismail=mail($toaddr,$sub,$mesg,$cc);
$ismail2=mail($toaddr2,$sub2,$mesg2,$cc);
if(!$ismail )
{
echo "<br><br><br><br><center><b>mail couldnot be send</b></center><br><br>";
}
else
{
echo "<BR><center><b>A mail has been sent to you and your reporting head $RH_name</b></center>";
//echo "<BR><center><b>$RH_name</b></center>";
echo"<center><b>Regarding the completion of your appraisal form<BR></b></center>";
}
}

/*	 $mailserver="integramicro.com";
            $login="narmathadevib"."@$mailserver";
//            $send_mail.=$login.',';
            $subject="Appraisal Forms";
            $message="Appraisal Forms are filled by the employee:$emp_name";
            $header="From: $PCC_ID:\nBcc:$login";
            $sucess=mail($login,$subject,$message,$header);
            if($sucess)
            echo "Mail has been sent to $login";
            else
            echo "Mail is not sent to $login";*/


$emp_code  = EmpCodeFromAuthKey($keychk);
echo"<br><center><input type=\"submit\" name =\"ok\" value =\"Ok\" onClick =\"view1()\" ></center>"; 
  echo"<input type = \"hidden\" name =\"keychk\" value =\"$keychk\"  >";
  echo"<input type = \"hidden\" name =\"emp_code\" value =\"$emp_code\"  >";
 exit();
 }
 }
 else
  {
	 echo "<BR><br><BR><center><b>Data cannot be  updated </b></center>";
	 exit();
  }
 }
//echo"<body bgcolor=\"#CDE1EB\">";

$ecode = EmpCodeFromAuthKey($keychk);
$ecode_gen = EcodeEnteredFromEcode($ecode);
$emp_name = EmpNameFromEmpCode($ecode);
$emp_dq = pg_query($db_pas,"select pk_sl,emp_proj,emp_rate from pa_lock where emp_code = $ecode and qtr = $qtr and year = $year");
$emp_df = pg_fetch_array($emp_dq,0);
$emp_lock = trim($emp_df[emp_proj]);
$emp_rate_lock = trim($emp_df[emp_rate]);
if($emp_rate_lock)
 {
	 echo "<BR><BR><BR><center><B>You have already filled Performance Assessment form.</b></center>";
echo"<br><center><input type=\"submit\" name=\"sb1\" value=\"Ok \" onClick=\"view1()\"></center>";	 
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\" >";
exit();
 }
/*if(!$emp_lock)
 {
	 echo "<BR><BR><BR><center><B>You have not filled Project Assessment form. You are required to fill that form first</b></center>";
	 exit();
 }*/



Function EmpRateList($rlist)
{
	$db_conn = db_open("pas_db",0);
	$emp_rate = pg_query($db_conn,"select rate_code,rate_desc  from i_work_def");
	$num_rows = pg_num_rows($emp_rate);
	 echo"<select name = $rlist onChange = \"fact()\">";
	echo"<option></option>";
	for($num=0;$num<$num_rows;$num++){
		$emp_rate_arr = pg_fetch_array($emp_rate,$num);
		$rate_code = $emp_rate_arr[rate_code];
		$rate_desc = trim($emp_rate_arr[rate_desc]);
		echo"<option value = \"$rate_code\">$rate_desc</option>";
		}
		echo"</select>";
	}
	#echo"<form name =\"f1\" action =\"$PHP_SELF#book\" method=\"post\">";

/* Function to check whether form is for staff or executive*/
$check = isExecutive($ecode);
$db_conn = db_open("pas_db");
$ifactor_query = pg_query($db_conn,"select sno,exec_wt,staff_wt  from i_factor");
$num_rows = pg_num_rows($ifactor_query);
for($num=0;$num<=$num_rows;$num++){
$weight_arr = pg_fetch_array($ifactor_query,$num);
	$exec_wt = $weight_arr[exec_wt];
	$staff_wt = $weight_arr[staff_wt];
	$sno = $weight_arr[sno];
	if($num==0)
	{
  	if($check)
	$x0 = $exec_wt;
	else
	$x0 =$staff_wt;
	}
	if($num==1)
	{
  	if($check)
        $x1 = $exec_wt;
	else
	$x1 =$staff_wt;
	}
       	if($num==2)
	{
     	if($check)
	$x2 = $exec_wt;
	else
	$x2 =$staff_wt;
	}
       if($num==3)
	{
           if($check)
           $x3 = $exec_wt;
           else
           $x3 =$staff_wt;
         }
        
         if($num==4)
          {
          if($check)
          $x4 = $exec_wt;
          else
          $x4 =$staff_wt;
          }
        if($num==5)
         {
          if($check)
          $x5 = $exec_wt;
          else
          $x5 =$staff_wt;
         }
        if($num==6)
        {
          if($check)
           $x6 = $exec_wt;
	   else 
	   $x6 =$staff_wt;
	 }
	 if($num==7)
	  {
           if($check)
	   $x7 = $exec_wt;
	   else
	   $x7 =$staff_wt;
	  }
	    if($num==8)
	     {
	     if($check)
	     $x8 = $exec_wt;
	     else
	     $x8 =$staff_wt;
	     }
	     if($num==9)
	     {
	     if($check)
	     $x9 = $exec_wt;
	     else
	     $x9 =$staff_wt;
	      }
	    if($num==10){
	if($check)
	$x10 = $exec_wt;
	else
	$x10 =$staff_wt;
	}
	if($num==11)
	{
		if($check)
		$x11 = $exec_wt;
		else
		$x11 =$staff_wt;
	}
	if($num==12)
	{
		if($check)
		$x12 = $exec_wt;
		else
		$x12 =$staff_wt;
	}

	}
		
	echo " <center><br>Performance Assessment </center>
<table style=\"width: 100%; text-align: left;\" border=\"1\"><tbody>";
echo"<tr bgcolor='#E5E7E9'><td colspan='4'><b>Job Performance</b></td></tr>
<tr><td >Factor<br>(1)</td>
      <td>Weight<center>(2)</center></td>
      <td><center>Employee's Rating</center><center>(3)</center></td>
      <td><center>Employee's Weighted Rating</center><center>(4)=(2)*(3)</center></td>";
    echo"</tr>
    <tr>
      <td title = \" Quality of Work deals with accuracy, thoroughness, and consistency while carrying out the work, broadly the ability to deliver what is required. It should be seen whether non-accomplishment or dropping of a given assignment is due to inadequate quality. Customer feedback, if relevant and available, should also be used to measure quality \">Quality of Work</td>";
      echo"<td><input type=\"text\" name =\"first\" value = $x0 size = 4 disabled></td>";
     echo "<td>";
EmpRateList("rlist1");
      echo"</td>";

      echo"<td><input type=\"text\" name =\"firstw\"  value =\"$firstw\" size = 4 onClick =\"rateFunc()\" ></td>";

      //echo"<td><input type=\"text\" name =\"firstw\"  value =\"$firstw\" size = 4  onClick =\"rateFunc()\"></td>";

      
      echo"</tr>
      <tr>
      <td title = \"Quantity of Work deals with the volume of work executed and delivered. Volume of work delivered should be gauged with respect to the complexity of the work item delivered. \">Quantity of Work</td>";
      echo"<td><input type=\"text\" name =\"second\" value = $x1 size = 4 disabled></td>";
      echo"<td>";
      EmpRateList("rlist2");
      echo "</td>";
      echo"<td><input type=\"text\" name =\"secondw\"  value = \"$secondw\" size = 4 ></td>";
   echo"</tr>
    <tr>
      <td title = \"Dependability and Trust measures how trustworthy and reliable the employee is when given an assignment. Regularity and accuracy of status reports, schedule integrity, early indication of problems, keeping one.s word, and making oneself available whenever required are indicative of this factor. \">Dependability</td>";
      echo"<td><input type=\"text\" name =\"third\" value = $x2 size = 4 disabled></td>";
      echo"<td>";
      EmpRateList("rlist3");
      echo "</td>";
      echo"<td><input type=\"text\" name =\"thirdw\"  value = \"$thirdw\"  size = 4 ></td>";
   echo"</tr>
    <tr>
      <td title = \"Job Knowledge determines to what extent the employee has the required knowledge to carry out the assignment given. In case of insufficient knowledge for carrying out an assignment, the effort put in by the employee to narrow the knowledge gap should be considered. \">Job Knowledge</td>";
      echo"<td><input type=\"text\" name =\"four\" value = $x3 size = 4 disabled></td>";
      echo"<td>";
      EmpRateList("rlist4");
      echo "</td>
      <td><input type=\"text\" name =\"fourw\"  value = \"$fourw\" size = 4  ></td>";
   echo"</tr>
    <tr>
      <td title = \"Interest, Initiative, and Responsibility measures the ability of the employee to start a new activity and work with minimal supervision. Contribution beyond the routine in an assignment, or taking up an assignment on one's own initiative without compromising on other assignments on hand should be considered. \">Interest, Initiative and
Responsibility
      </td>";
      echo"<td><input type=\"text\" name =\"five\" value = $x4 size = 4 disabled></td>";
      echo"<td>";
      EmpRateList("rlist5");
      echo "</td>
      <td><input type=\"text\" name =\"fivew\"  value = \"$fivew\"  size = 4 ></td>";
    echo"</tr>
    <tr>
      <td title = \"Spoken and Written Communication should be measured with respect to the requirement of the assignment executed. If an assignment relies more on written communication, say by email, written communication should be given a higher consideration than spoken communication. \">Spoken and Written Communication
      </td>";
      echo"<td><input type=\"text\" name =\"six\" value = $x5 size = 4 disabled></td>";
      echo"<td>";
      EmpRateList("rlist6");
      echo"</td>
      <td><input type=\"text\" name =\"sixw\"  value = \"$sixw\" size = 4  ></td>
      ";
   echo"</tr>
    <tr>
      <td title = \"Discipline and Time Control measures qualities like promptness in carrying out work and timeliness of delivery. Again, this should be measured with respect to the assignment taken up, keeping in mind basic virtues like punctuality and time management. \">Discipline and Time Control
      </td>";
      echo"<td><input type=\"text\" name =\"seven\" value = $x6 size = 4 disabled></td>";
      echo"<td>";
      EmpRateList("rlist7");
       echo"</td>
      <td><input type=\"text\" name =\"sevenw\"  value =\"$sevenw\" size = 4 ></td>";
    echo"</tr>
    <tr bgcolor='#E5E7E9'>
      <td colspan=\"6\"><span
 style=\"font-weight: bold;\">Potential Attributes</span>
      </td>
    </tr>
    <tr>
      <td title = \"Creativity, Intelligence, and Mental Calibre measures the ability of the employee to grasp a new idea or concept and put it into action. \">Creativity, Intelligence and
Mental Calibre
      </td>
      <td><input type=\"text\" name =\"eight\" value = $x7 size = 4 disabled></td>
      <td>";
      EmpRateList("rlist8");
      echo "</td>
      <td><input type=\"text\" name =\"eightw\"  value = \"$eightw\" size = 4  ></td>";
   echo"</tr>
    <tr>
      <td title = \"Interpersonal Relationships and Adaptability measures the ability to network with a large number of other persons. \">Interpersonal Relationships and
Adaptability
      </td>
      <td><input type=\"text\" name =\"nine\" value = $x8 size = 4 disabled></td>
       <td>";
      EmpRateList("rlist9");
     echo "</td>
      <td><input type=\"text\" name =\"ninew\"  value = \"$ninew\" size = 4 ></td>";
   echo"</tr>
    <tr>
      <td title = \"Team Work measures the ability of the employee to function cohesively in a team. Apart from being a good contributor, a good team player has a healthy respect for the ability, time, and priorities of the other team members. \">Team Work
      </td>
      <td><input type=\"text\" name =\"ten\" value = $x9 size = 4  disabled></td>
      <td>";
     EmpRateList("rlist10");
echo "      </td>
      <td><input type=\"text\" name =\"tenw\" value =\"$tenw\" size = 4  ></td>";
   echo"</tr>
    <tr>
      <td title =\"Leadership deals with decision making, development of subordinates, and control and management of subordinates \"   >Leadership
      </td>
      <td><input type=\"text\" name =\"eleven\" value = $x10 size = 4  disabled></td>
      <td>";
EmpRateList("rlist11");
echo "</td>
      <td><input type=\"text\" name =\"elevenw\" value =\"$elevenw\"  size = 4 ></td>";
      
   echo"</tr>
    <tr>
      <td title = \"Planning and Organizing deals with the ability to break down the assignment into manageable tasks and carrying out the tasks according to a given priority and schedule.\">Planning and Organizing
      </td>
      <td><input type=\"text\" name =\"twelve\" value = $x11 size = 4 disabled></td>
      <td>";
EmpRateList("rlist12");
echo "</td>
      <td><input type=\"text\" name =\"twelvew\"  value = \"$twelvew\" size = 4 ></td>";
   echo"</tr>
    <tr bgcolor='#E5E7E9'>
      <td colspan='3'>Total Score
      </td>
      
      <td><input type=\"text\" name = \"tot\" value = \"$tot\"  size = 4 ></td>";
    echo"</tr>
  </tbody>
</table>";
echo"<BR><b> Note * </b> <table style='width: 40%; text-align: left;'><tbody>
     <tr bgcolor='#E5E7E9'><td><b>Employee's Rating</b> </td> <td><b> Value</b></td></tr>
     <tr><td>Always below expectations </td> <td> 1 </td></tr>
     <tr><td>Below expectations most times </td> <td> 2 </td></tr>
     <tr><td>Meets expectations  </td> <td> 3 </td></tr>
     <tr><td>Exceeds expectations sometimes </td> <td> 4 </td></tr>
     <tr><td>Often exceeds expectations </td> <td> 5 </td></tr></tbody></table>";
     		 

echo"<span style=\"font-weight: bold;\">";
echo"<br><br>";
echo"<center>";
echo"<INPUT type=\"submit\" name=\"next_scr\" value=\"Submit\"  onclick = \"totscore()\">";
echo"&nbsp;&nbsp;<input type=\"button\" name =\"bt_ok\" Value=\"Back\" onClick=\"exit_form()\">";
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\" >";
echo"<INPUT type=\"hidden\" name=\"pk_sl\" value=\"$pk_sl\" >";
echo"</center>";
echo"</form>";
echo "</body></html>";
?>
