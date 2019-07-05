<?php  
session_start();
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

   


  </style>

<script language="JavaScript">
// Modified By Akila to Include Ajax Scripts for Validation
var xmlHttp = createXmlHttpRequestObject();
function createXmlHttpRequestObject()
{
  var xmlHttp;
  if(window.ActiveXObject)
  {
    try
    {
      xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    catch (e)
    {
      xmlHttp = false;
    }
  }
  else
  {
   if(window.XMLHttpRequest)
   {
    try
    {
      xmlHttp = new XMLHttpRequest();
    }
    catch (e)
    {
      xmlHttp = false;
    }
   }
  }
  if (!xmlHttp)
              alert("Error creating the XMLHttpRequest object.");
           else
              return xmlHttp;
}
function process()
{
           if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
           {
              name = encodeURIComponent(document.getElementById("myName").value);
              xmlHttp.open("GET", "PA_validate.php?name="+name, true);
              xmlHttp.onreadystatechange = handleServerResponse;
              xmlHttp.send(null);
           }
           else
              setTimeout('process()', 1000);
}
function handleServerResponse()
{
           if (xmlHttp.readyState == 4)
           {
              if (xmlHttp.status == 200)
              {
                xmlResponse = xmlHttp.responseXML;
                xmlDocumentElement = xmlResponse.documentElement;
                helloMessage = xmlDocumentElement.firstChild.data;
                document.getElementById("divMessage").innerHTML =
                                                       '<i>' + helloMessage + '</i>';
                setTimeout('process()', 1000);
              }
              else
              {
                alert("There was a problem accessing the server: " +
        xmlHttp.statusText);
              }
           }
}

function exit()
{
   
   document.forms[0].action="PA_logout.php";
}
function firstForm()
{
   document.forms[0].action="PA_appr_prev.php";
}
function thiForm()
{
   document.forms[0].action="PA_emp_rate.php";
}
function reportForm()
{
   document.forms[0].action="PA_report.php";
}

function InitForm()
{
   document.forms[0].action="PA_hr_init.php";
}

// modified by ankur kapoor on 22 nov 2005

function view_qtr()
{
  document.forms[0].action="PA_view_qtr_rep.php";	
}
function forForm()
{
 var y = document.f2.appr_to.value;
       	if(y)
       	document.forms[0].action="PA_rh_menu.php";
	else
	{
		alert("Please Select Employee from the list");
	        return(false);
	}
}
function repForm()
{
   document.forms[0].action="hr_report.php";
}
function view_emp_reports()
{
  document.forms[0].action = "manager_view_emp_reports.php";
}

function MeetForm()
{
 var x = document.f2.meet_to.value;
       	if(x)
       	document.forms[0].action="final.php";
	else
	{
		alert("Please Select Employee from the list");
	        return(false);
	}
}
function view_rep()
{
   document.forms[0].action= "PA_appr_emp_report.php";
}
function SelfAppraisal()
{
   document.forms[0].action= "PA_appr_self.php";    
}

function Update_salary_bday(){
   document.forms[0].action = "PA_update_bday_salary.php";  	
}

function Current_report(){
   document.forms[0].action = "PA_manager_report.php";
}


</script>
</HEAD>
<body style="background-color: #CDE1EB !important;">


<?php
   error_reporting(0);
   
  
    $_SESSION['USERNAME'] = $userName  =  $_GET['userName']; 
    $_SESSION['TOKEN'] = $securityToken = $_GET['securityToken'];
	  include_once('head.php');
    include_once('tsutils.php');
     
  ?>
  <!--<H3><B><CENTER>Performance Appraisal System</CENTER></B></H3>
<HR><BR><BR>-->
<BR><BR><BR><BR>
<?php
    
   //if(($login == "" || $passw == "") && $keychk == NULL){
   if(($userName == "" || $securityToken == "") && $keychk == NULL){
	 
      Redirect(MYIMSS_URL);
      //Error ("user_pass_empty");
      //exit();
   }
                                    
  
   if(!$keychk) {
      //$userName = $_GET['userName'];
      //$securityToken = $_GET['securityToken'];
      //$keychk = Authenticate ($login, $passw);
	  
       $keychk = Authenticate ($userName, $securityToken); 
	
   }
   //$passw = NULL;
   
   if ($keychk == NULL)
   {
      Redirect(MYIMSS_URL);  
   }
 
 if (! CheckAuthKey ($keychk)) 
   {
      Error ("Login");
      exit;
   }    
   // Default action of the page.
      echo "<FORM name =\"f2\"  METHOD=POST>";
      $db_proj = db_open ();
      $db_pas = db_open("pas_db",0); 

      /*  UI DESIGN     */
      $ecode = EmpCodeFromAuthKey ($keychk);

/*
if ($ecode != 1 && $ecode != 2 && $ecode != 9 && $ecode != 246 && $ecode != 256 && $ecode != 1045 && $ecode != 1141 && $ecode != 3)
{
   echo "<CENTER>The appraisal system is currently unavailable.</CENTER>\n";
   exit;
} 
*/



    
   $qtr_exe=pg_query($db_pas,"select qtr,qtr_start,qtr_end from pa_init");
   $qtr_arr= pg_fetch_array($qtr_exe);
   $current_qtr=$qtr_arr[qtr];
   $qtr_strt = $qtr_arr[qtr_start];
   $qtr_end = $qtr_arr[qtr_end];    
   $qtr_co= $qtr_strt.":".$qtr_end;
   //echo "select emp_limit from i_qtr_def where qtr_num=$current_qtr and qtr_desc='$qtr_co'";
   $emp_limit_exe=pg_query($db_pas,"select emp_limit from i_qtr_def where qtr_num=$current_qtr and qtr_desc='$qtr_co'"); 
   $emp_limit_arr=pg_fetch_array($emp_limit_exe,0);
   //print_r($emp_limit_arr);
   $emp_lim=$emp_limit_arr[emp_limit];
   //print_r($emp_lim);
   //echo "select emp_code from emp_code_gen where emp_code_entered=$emp_lim"; exit;
    $ecode_exe=pg_query($db_proj,"select emp_code from emp_code_gen where emp_code_entered='$emp_lim'");
    $ecode_ar=pg_fetch_array($ecode_exe,0);
    $ecod_not=$ecode_ar[emp_code];


   Function view($ecode)
    {
    $db_pas = db_open("pas_db",0);
    $view_rep = pg_query($db_pas,"select * from pa_view where emp_code='$ecode'");
      $view_arr=pg_fetch_array($view_rep,0);
      $access_view =$view_arr[access_view];
      $access_report=$view_arr[access_report];
     if($access_view=='t')
     return true;
     else
     return false;
     pg_close($db_pas); 
   }

// modified by ankur kapoor on 24th nov

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


   Function initiate($ecode)
    {
    $db_pas = db_open("pas_db",0);

    $init_rep = pg_query($db_pas,"select initiate_view from initiate_view where emp_code=$ecode");
     $view_arr=pg_fetch_array($init_rep,0);
     $initiate_view =$view_arr[initiate_view];
     if($initiate_view=='t')
     return true;
     else
     return false;
     pg_close($db_pas); 
   }

    $get_key = pg_query($db_pas,"select qtr,year from pa_init");
    $key_arr = pg_fetch_array($get_key,0);
    $year =$key_arr[year];
    $qtr =$key_arr[qtr];
 
    echo "<center><div class='container'><div class ='table-responsive'>";

    echo "<table style='background-color:white;' class='table table-condensed table-striped'>";
    echo "<tr>";
    $rephead_q = pg_query($db_proj,"select emp_code,emp_name from emp_master where reportsto=$ecode");
    $num_emp = pg_num_rows($rephead_q);
   $emp_q=pg_query($db_pas,"select emp_rate,mgr_rate,emp_proj from pa_lock where emp_code=$ecode and year=$year and qtr=$qtr");

    $emp_arr=pg_fetch_array($emp_q,0);
    $emp_rate =$emp_arr[emp_rate];
    $emp_proj =$emp_arr[emp_proj];

// added by Akila on 4 april 2007 ********************************************
   $emp_enter= pg_query($db_proj,"select emp_code_entered from emp_code_gen where emp_code = '$ecode'");
   $ec=pg_fetch_array($emp_enter,0);
   $ec_num=$ec[emp_code_entered];
   $hr_emp=pg_query($db_proj,"select * from bu_master where hr_partner=$ec_num");
   $num_hr = pg_num_rows($hr_emp);
   for($i=0;$i<$num_hr;$i++)
   {
   $bu_r=pg_fetch_array($hr_emp,$i);
   $bu_num[$i]=$bu_r['bu_code'];
   }
   $bu_head=pg_query($db_proj,"select * from bu_master where bu_head=$ec_num");
   $num_buh = pg_num_rows($bu_head);
//**************************************************************************** 

if($num_emp || $num_hr)
{

 if(!$emp_rate||!$emp_proj)
 {
  echo "<td bgcolor='#E5E7E9'><font size=3>Self Appraisal form of employee</font>:&nbsp;</td>";

  echo "<td bgcolor='#E5E7E9'>&nbsp;<input type=\"submit\" name=\"self_ass\" value=\"Self Appraisal\" onClick=\"SelfAppraisal()\"></td>";
  
  //echo "<td bgcolor='#E5E7E9'><input type=\"hidden\" name=\"ecode\" value=\"$ecode\"></td>";
 }
 else
 {
  echo "<td><center>View your Appraisal form: <input type=\"submit\" name=\"view_ass\" value=\"View Appraisal Form\" onClick=\"view_rep()\"></center></td></tr></table>";
  //echo "<td><input type=\"hidden\" name=\"emp_code\" value=\"$ecode\"></td>";
 }
}

else
 {
    if(!access_not_allowed($ecode))
    {  
     if(!$emp_rate||!$emp_proj)
     {
     echo "<table><tr><td><input type=\"submit\" class='button button4' name=\"proj_ass\" value=\"Project Assessment\" onClick=\"firstForm()\"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
    echo "<td><input type=\"submit\" class='button4 button' name=\"mgr_ass\" value=\"Performance Assessment\" onClick=\"thiForm()\"></td></tr></table>";
     }
     else   
     {
     echo "<table><tr><td><center>View your Appraisal form: <input type=\"submit\" name=\"view_ass\" value=\"View Appraisal Form\" onClick=\"view_rep()\"></center></td>";
        echo"<input type =\"hidden\" name =\"emp_code\" value = $ecode>";
     }
    }
    else
    {
     echo "<td><center>You are not allowed to fill your  Appraisal form for this quarter</center></td>";
    }
  }  
  //echo "select emp_code,emp_name from emp_master where reportsto=$ecode and emp_code <= $ecod_not and left_date is null"; exit;
 echo "</tr>";   
 
 if(!$num_hr)
 {
  $rephead_q = pg_query($db_proj,"select emp_code,emp_name from emp_master where reportsto=$ecode and emp_code <= $ecod_not and left_date is null");
 }
 else if($num_hr)
 {
 $rephead_q = pg_query($db_proj,"select emp_code,emp_name from emp_master where (reportsto=$ecode or bu_code in(select bu_code from bu_master where hr_partner=$ec_num)) and emp_code != $ecode and emp_code <= $ecod_not and left_date is null");
 }
   $nol=pg_numrows($rephead_q);
   $qry=$rephead_q;

if($num_emp>0 || $num_hr)
{
    echo "<tr><td><font size=3> Appraisal form of group:&nbsp;</font>";	
    echo "</td><td><SELECT NAME=\"appr_to\" id=\"myName\" onchange='process()'>";
    echo "<option></option>";
// added by akila for BU Change 4 th april 2007   
    for($l=0;$l<=$nol;$l++)
    {
    	$recs_q = pg_fetch_array ($qry,$l);
    	$emp_c =$recs_q[emp_code];
      
    	$emp_n =$recs_q[emp_name];
    	$emp_gen=EcodeEnteredFromEcode($emp_c);
    
    	$e=pg_query($db_pas,"select mgr_rate,emp_rate,emp_proj from pa_lock where emp_code =$emp_c and qtr=$qtr and year=$year");

    	$r = pg_fetch_array($e,0);
   
    	$emp_mrs = $r[mgr_rate];
    	$emp_rt = $r[emp_rate];
    	$emp_pro = $r[emp_proj]; 
     // Priority level is added names of the employee for appraisal
     // change made by ankur on 15 nov 2005  
   	$appr_flg_exe=pg_query($db_pas,"select appr_flag from appr_system where emp_code =$emp_gen");
   	$appr_flg_arr= pg_fetch_array($appr_flg_exe,0);
   	$appr_flg= trim($appr_flg_arr[appr_flag]);
   	if($appr_flg=='R')
   		$emp_n=$emp_n."[R]";
   	if($appr_flg=='S')
   		$emp_n=$emp_n."[S]";
   	if($appr_to==$emp_n)
     	{
      		if(!($emp_mrs =='t')&& $emp_c) 
       		{
        		if(!$emp_rt || !$emp_pro)
        		$emp_n='*'.$emp_n;  
        	echo "<OPTION value=$emp_c selected>$emp_n";
             
       		}
     	}
      	else   
      	{
         	if(!($emp_mrs=='t')&& $emp_c) 
          	{
           		if(!$emp_rt || !$emp_pro)
           		$emp_n='*'.$emp_n;  
           	echo "<OPTION value=$emp_c>$emp_n";
          	}  
      	}
     }   
    echo "</SELECT>\n";

  //For Displaying Notification message sent from server
    echo "<input type=\"submit\" name=\"show_form1\" value=\"Select\" onClick=\"forForm()\">";
    ?><font color=red><div id="divMessage"></div></font></td></tr><?php
    $rep_com =pg_query($db_pas,"select emp_code,rm_comm from pa_lock where mgr_rate = true and emp_rate =true  and year=$year and qtr=$qtr");
    $norows = pg_num_rows($rep_com);
    echo "<tr><td><font size=3>Appraisal Meeting  form of group:&nbsp;</font>";
    echo "</td><td><SELECT NAME=\"meet_to\" >";
    echo "<option></option>";

    for($j=0;$j<$norows;$j++)
    {
	    $rep_arr = pg_fetch_array($rep_com,$j);
	    $empcode  = $rep_arr[emp_code];
	    $rm_comm  = $rep_arr[rm_comm];
	    $ecode = EmpCodeFromAuthKey($keychk);

    	    //Modified By akila for BU Change*******************************
	    if($num_hr)
	    {
	       $rep_n  = pg_query($db_proj,"(select emp_name from emp_master where emp_code =$empcode and bu_code in (select bu_code from bu_master where hr_partner=$ec_num) and emp_code!=$ecode and left_date is null) union (select emp_name from emp_master where  emp_code!=$ecode and emp_code=$empcode and reportsto=$ecode and left_date is null)"); 
	    }
	    else
	    {	
	       $rep_n  = pg_query($db_proj,"select emp_name  from emp_master where emp_code =$empcode and reportsto=$ecode and  left_date is null");
	    } 
	    $rec_no=pg_numrows($rep_n);
	    for($t=0;$t<$rec_no;$t++)
	    {
        	$repemp_arr = pg_fetch_array($rep_n,$t);
	        $emp_name = $repemp_arr[emp_name];
        	$emp_gen=EcodeEnteredFromEcode($empcode); 
	        $appr_flg_exe=pg_query($db_pas,"select appr_flag from appr_system where emp_code =$emp_gen");
        	$appr_flg_arr= pg_fetch_array($appr_flg_exe,0);
	        $appr_flg= trim($appr_flg_arr[appr_flag]);
        	if($meet_to == $empcode)
	        {
		 	if($emp_name&&(!($rm_comm=='t')))
			 {  
		 	     if($appr_flg=='R')
			     $emp_name=$emp_name."[R]";
			     if($appr_flg=='S')
			     $emp_name=$emp_name."[S]";
			     echo "<OPTION value=$empcode selected>$emp_name";   
			 }
		}  
	        else
        	if($emp_name&&(!($rm_comm=='t')))
	       	{
	       	     if($appr_flg=='R')
        	     $emp_name=$emp_name."[R]";
	             if($appr_flg=='S')
        	     $emp_name=$emp_name."[S]";
	             echo "<OPTION value=$empcode>$emp_name";	
        	}
	    }
    }
	 echo "</SELECT>\n";
	 echo "<input type=\"submit\" name=\"show_form2\" value=\"Select\" onClick=\"MeetForm()\">";
	 echo"</td></tr>";
	 echo"<tr><td><font size = 3>View Employee's Appraisal Reports: </font>";
	 echo"<input type =\"hidden\" name=\"emp_code\" value =\"$ecode\">";
	 echo "</td><td><input type=\"submit\" name=\"viewemprep\" value=\"View Report\" onClick=\"view_emp_reports()\"></td></tr>";
	 echo "<tr><td><font size = 3>View Employee's Current Appraisal Status: </font>";
	 echo "<input type =\"hidden\" name=\"ecode\" value =\"$ecode\">";
	 echo "</td><td><input type =\"submit\" name=\"viewcurr\" value=\"Current Status\" onClick = \"Current_report()\"></td></tr>";
}
	  $rephead_q = pg_query($db_proj,"select emp_code,emp_name from emp_master where reportsto=$ecode and left_date is null");
	  $num_emp = pg_num_rows($rephead_q);
	 // echo"</table>";

    // echo "<table class='roundedCorners' width='60%'>";
	if(initiate($ecode))
	echo "<tr><td><font size=3>Appraisal Quarter Period Initiation</font>:&nbsp;</td><td><input type=\"submit\" name=\"show_form3\" value=\"Initiate\" onClick=\"InitForm()\"></td></tr>";
	echo"<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
	  echo "</center>";


          //To Check For Special User's
          
             $view_rep = pg_query($db_pas,"select access_report from pa_view where emp_code=$ecode");
             $view_arr=pg_fetch_array($view_rep,0);
             $access_report=$view_arr[access_report];

	  if(view($ecode))
	   {
	  echo "<tr><td><font size=3>Update the birthdays and salary revision due dates of all the employee</font>:&nbsp;</td><td><input type=\"submit\" name=\"upd_sb1\" value=\"Update\" onClick= \"Update_salary_bday()\"></td></tr>";
	   }
	  if(view($ecode) ||$num_buh|| $access_report)
	   {
	    echo "<tr><td><font size=3>Status of Appraisal form of employees</font>:&nbsp;</td><td><input type=\"submit\" name=\"sb1\" value=\"Report\" onClick= \"view_qtr()\"></td></tr>";
	   }
	 // echo"<tr><td colspan=2><center><input type=\"submit\" name =\"bt_ok\" Value=\"Logout\" onClick=\"exit()\"></center></td></tr>"; 
	
        echo "</table></center></div></div>";

	if($num_emp>0 ||$num_hr)
	{
	echo"<BR><BR><br><b><center>Note :</center></b>";
	echo"<center><font size =2>[*] :- Employee has not filled his/her appraisal from </font></center>";
	echo"<center><font color = red size =2>[ R ] :- Regular</font></center>";
	echo"<center><font color = green size =2>[ S ] :- Special</font></center>";
	}
	
	echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
	      echo "</FORM>";
    
?>

</body>
</html>

