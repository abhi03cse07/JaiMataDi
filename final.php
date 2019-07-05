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
<script src = message.js>
</script>
<script language="JavaScript" type = "text/javascript">
    function insert(theForm)
      {
          
          	 
	var xm1 = document.f1.first.value;
        var ym1 = document.f1.rlistp1.value;
	var zm1 = xm1*ym1;
	// zm1= parseFloat(zm1);  
	 //zm1 = zm1.toFixed(1);
        zm1=Math.round(zm1*10)/10;	
         var rm1 = document.f1.firstwp.value;
	// rm1 = parseFloat(rm1);
	// rm1 = rm1.toFixed(1);
        rm1=Math.round(rm1*10)/10;	
	 if(rm1!=zm1)
	 {
	  alert("You can not edit  weighted rating of \"Quality of Work\"field of Manager");
	   return(false);
	      }
	            var xm2 = document.f1.second.value;
	             var ym2 = document.f1.rlistp2.value;
		     var zp2 = xm2*ym2;
	           // zp2= parseFloat(zp2);  
                  //   zp2 = zp2.toFixed(1);
                  zp2=Math.round(zp2*10)/10;	
		     var rp2 = document.f1.secondwp.value;
	           // rp2 = parseFloat(rp2);
	           // rp2 = rp2.toFixed(1);
                 rp2=Math.round(rp2*10)/10;	
		     if(rp2!=zp2)
		    {
		    alert("You can not edit  weighted rating of \"Quantity of Work\"field of Manager");
		    return(false); 
	            }
	             var xm3 = document.f1.third.value;
	             var ym3 = document.f1.rlistp3.value;
		     var zm3 = xm3*ym3;
	            //zm3= parseFloat(zm3);  
                    // zm3 = zm3.toFixed(1);
                  zm3=Math.round(zm3*10)/10;	
	            var rm3 = document.f1.thirdwp.value;
	            rm3 = parseFloat(rm3);
	            rm3 = rm3.toFixed(1);
		    if(rm3!=zm3)
		    {
		    alert("You can not edit  weighted rating of \"Dependibilty\"field of Manager");
		    return(false); 
	            }
	             var xm4 = document.f1.four.value;
	             var ym4 = document.f1.rlistp4.value;
		     var zm4 = xm4*ym4;
	          //  zm4= parseFloat(zm4);  
                    // zm4 = zm4.toFixed(1);
                zm4=Math.round(zm4*10)/10;	
	            var rm4 = document.f1.fourwp.value;
	         //   rm4 = parseFloat(rm4);
	       //     rm4 = rm4.toFixed(1);
        rm4=Math.round(rm4*10)/10;	
		    if(rm4!=zm4)
		    {
		    alert("You can not edit  weighted rating of \"Job Knowledge\"field of Manager");
		    return(false); 
	            }
	             var xm5 = document.f1.five.value;
	             var ym5 = document.f1.rlistp5.value;
		     var zp5 = xm5*ym5;
	  //          zp5= parseFloat(zp5);  
        //             zp5 = zp5.toFixed(1);
        zp5=Math.round(zp5*10)/10;	
	            var rp5 = document.f1.fivewp.value;
	  //          rp5 = parseFloat(rp5);
	//            rp5 = rp5.toFixed(1);
        rp5=Math.round(rp5*10)/10;	
		    if(rp5!=zp5)
		    {
		    alert("You can not edit  weighted rating of \"Interest,Initiative And Responsibility\"field of Manager");
		    return(false); 
	            }
	             var xm6 = document.f1.six.value;
	             var ym6 = document.f1.rlistp6.value;
		     var zm6 = xm6*ym6;
	          //  zm6= parseFloat(zm6);  
                //     zm6 = zm6.toFixed(1);
                   zm6=Math.round(zm6*10)/10;	
	            var rm6 = document.f1.sixwp.value;
	          //  rm6 = parseFloat(rm6);
	         //   rm6 = rm6.toFixed(1);
                  rm6=Math.round(rm6*10)/10;	
		    if(rm6!=zm6)
		    {
		    alert("You can not edit  weighted rating of \"Spoken And Written Communication\"field of Manager");
	             
		    return(false); 
	            }
	             var xm7 = document.f1.seven.value;
	             var ym7 = document.f1.rlistp7.value;
		     var zm7 = xm7*ym7;
	            //zm7= parseFloat(zm7);  
                    // zm7 = zm7.toFixed(1);
                      zm7=Math.round(zm7*10)/10;	
	            var rm7 = document.f1.sevenwp.value;
	           // rm7 = parseFloat(rm7);
	           // rm7 = rm7.toFixed(1);
                    rm7=Math.round(rm7*10)/10;	
		    if(rm7!=zm7)
		    {
		    alert("You can not edit  weighted rating of \"Discipline And Time Control\"field of Manager");
		    return(false); 
	            }
	             var xm8 = document.f1.eight.value;
	             var ym8 = document.f1.rlistp8.value;
		     var zm8 = xm8*ym8;
	           // zm8= parseFloat(zm8);  
                   //  zm8 = zm8.toFixed(1);
                    zm8=Math.round(zm8*10)/10;	
	            var rs8 = document.f1.eightwp.value;
	           // rs8 = parseFloat(rs8);
	           // rs8 = rs8.toFixed(1);
                 rs8=Math.round(rs8*10)/10;	
		    if(rs8!=zm8)
		    {
		    alert("You can not edit  weighted rating of \"Creativity,Intelligence And Mental Calibre\"field of Manager");
		    return(false); 
	            }
	             var xp9 = document.f1.nine.value;
	             var yp9 = document.f1.rlistp9.value;
		     var zp9 = xp9*yp9;
	           // zp9= parseFloat(zp9);  
                    // zp9 = zp9.toFixed(1);
                    zp9=Math.round(zp9*10)/10;	
	            var rp9 = document.f1.ninewp.value;
	           // rp9 = parseFloat(rp9);
	           // rp9 = rp9.toFixed(1);
                     rp9=Math.round(rp9*10)/10;	
		    if(rp9!=zp9)
		    {
		    alert("You can not edit  weighted rating of \"Interpersonal Relationship And Adaptability\"field of Manager");
		    return(false); 
	            }
	             var xm10 = document.f1.ten.value;
	             var ym10= document.f1.rlistp10.value;
		     var zm10 = xm10*ym10;
	            //zm10= parseFloat(zm10);  
                     //zm10 = zm10.toFixed(1);
                     zm10=Math.round(zm10*10)/10;	
	            var rm10 = document.f1.tenwp.value;
	  //          rm10 = parseFloat(rm10);
	//            rm10 = rm10.toFixed(1);
                       rm10=Math.round(rm10*10)/10;	
		    if(rm10!=zm10)
		    {
		    alert("You can not edit  weighted rating of \"Team Work\"field of Manager");
		    return(false); 
	            }
	             var xp11 = document.f1.eleven.value;
	             var yp11= document.f1.rlistp11.value;
		     var zp11 = xp11*yp11;
	           // zp11= parseFloat(zp11);  
                   //  zp11 = zp11.toFixed(1);
               zp11=Math.round(zp11*10)/10;	
	            var rp11 = document.f1.elevenwp.value;
	          //  rp11 = parseFloat(rp11);
	           // rp11 = rp11.toFixed(1);
                 rp11=Math.round(rp11*10)/10;	
		    if(rp11!=zp11)
		    {
		    alert("You can not edit  weighted rating of \"Leadership\"field of Manager");
		    return(false); 
	            }
	             var xm12 = document.f1.twelve.value;
	             var ym12= document.f1.rlistp12.value;
		     var zm12 = xm12*ym12;
	           // zm12= parseFloat(zm12);  
                    // zm12 = zm12.toFixed(1);
                    zm12=Math.round(zm12*10)/10;	
	            var rp12 = document.f1.twelvewp.value;
	           // rp12 = parseFloat(rp12);
	           // rp12 = rp12.toFixed(1);
                       rp12=Math.round(rp12*10)/10;	
		    if(rp12!=zm12)
		    {
		    alert("You can not edit  weighted rating of \"Planning And Organizing\"field of Manager");
		    return(false); 
	            }
		    var totmz = parseFloat(zm12)+parseFloat(zp11)+parseFloat(zm10)+parseFloat(zp9)+parseFloat(zm8)+parseFloat(zm7)+parseFloat(zm6)+parseFloat(zp5)+parseFloat(zm4)+parseFloat(zm3)+parseFloat(zp2)+parseFloat(zm1); 
		   // totmz = parseFloat(totmz);
		    totmz = totmz.toFixed(1);
                    totmz=Math.round(totmz*10)/10;	
	            var rtotm = document.f1.totm.value;
		   // rtotm = parseFloat(rtotm);
		  // rtotm = rtotm.toFixed(1);
                  rtotm=Math.round(rtotm*10)/10;	
		    if(totmz!=rtotm)
	            {
	 	    alert("You can not edit total score of Manager ");
		    return(false);
		    }	    
      	               
             }
             function fact()
                  {
	              var x1 = document.f1.first.value;
	             var y1 = document.f1.rlistp1.value;
		     // x1 = x1.toFixed(1);
		     var z1 = x1*y1;
                   //  z1 = z1.toFixed(1)
                   z1=Math.round(z1*10)/10;	
		     document.f1.firstwp.value = z1;
	             var x2 = document.f1.second.value;
	             var y2 = document.f1.rlistp2.value;
		     var z2 = x2*y2;
                   //  z2 = z2.toFixed(1);
                   z2=Math.round(z2*10)/10;	
		     document.f1.secondwp.value = z2;
	             var x3 = document.f1.third.value;
	             var y3 = document.f1.rlistp3.value;
		     var z3 = x3*y3;
                   //  z3 = z3.toFixed(1);
                   z3=Math.round(z3*10)/10;	
		     document.f1.thirdwp.value = z3;
	             var x4 = document.f1.four.value;
	             var y4 = document.f1.rlistp4 .value;
		     var z4 = x4*y4;
                   //  z4 = z4.toFixed(1);
                   z4=Math.round(z4*10)/10;	
		     document.f1.fourwp.value = z4;
	             var x5 = document.f1.five.value;
	             var y5 = document.f1.rlistp5.value;
		     var z5 = x5*y5;
                   //  z5 = z5.toFixed(1);
                   z5=Math.round(z5*10)/10;	
		     document.f1.fivewp.value = z5;
	             var x6 = document.f1.six.value;
	             var y6 = document.f1.rlistp6.value;
		     var z6 = x6*y6;
                   //  z6 = z6.toFixed(1);
                   z6=Math.round(z6*10)/10;	
		     document.f1.sixwp.value = z6;
	             var x7 = document.f1.seven.value;
	             var y7 = document.f1.rlistp7.value;
		     var z7 = x7*y7;
                   //  z7 = z7.toFixed(1);
                   z7=Math.round(z7*10)/10;	
		     document.f1.sevenwp.value = z7;
		     var x8 = document.f1.eight.value;
	             var y8 = document.f1.rlistp8.value;
		     var z8 = x8*y8;
                   //  z8 = z8.toFixed(1);
                   z8=Math.round(z8*10)/10;	
		     document.f1.eightwp.value = z8;
	             var x9 = document.f1.nine.value;
	             var y9 = document.f1.rlistp9.value;
		     var z9 = x9*y9;
                   //  z9  = z9.toFixed(1);
                   z9=Math.round(z9*10)/10;	
		     document.f1.ninewp.value = z9;
	             var x10 = document.f1.ten.value;
	             var y10 = document.f1.rlistp10.value;
		     var z10 = x10*y10;
                   //  z10 = z10.toFixed(1);
                   z10=Math.round(z10*10)/10;	
		     document.f1.tenwp.value = z10;
	             var x11 = document.f1.eleven.value;
	             var y11 = document.f1.rlistp11.value;
		     var z11 = x11*y11;
                   //  z11 = z11.toFixed(1);
                   z11=Math.round(z11*10)/10;	
		     document.f1.elevenwp.value = z11;
	             var x12 = document.f1.twelve.value;
	             var y12 = document.f1.rlistp12.value;
		     var z12 = x12*y12;
                   //  z12 = z12.toFixed(1);
                   z12=Math.round(z12*10)/10;	
		     document.f1.twelvewp.value = z12;
             
		    var z = parseFloat(z1)+parseFloat(z2)+parseFloat(z3)+parseFloat(z4)+parseFloat(z5)+parseFloat(z6)+parseFloat(z7)+parseFloat(z8)+parseFloat(z9)+parseFloat(z10)+parseFloat(z11)+parseFloat(z12); 
	           //  z= z.toFixed(1); 
                   z=Math.round(z*10)/10;	
                     document.f1.totm.value = z;
	             var total = document.f1.totm.value;
		       
		     if(total<55)
	             {
		      document.f1.over_rate[0].checked="true";
		     }	     
		     
		     if(total>=55 && total<=64)
	             {
		      document.f1.over_rate[1].checked="true";
		     }	     
		     if(total>=64 && total<=74)
	             {
		      document.f1.over_rate[2].checked="true";
		     }	     
		     if(total>=74 && total<=84)
	             {
		      document.f1.over_rate[3].checked="true";
		     }	     
		     if(total>=84)
	             {
		      document.f1.over_rate[4].checked="true";
		     }	     
		   }

		    </script>
<title>Performance Appraisal Form</title>


</head>
<?
error_reporting(0);
#print_r($_POST);
//include_once "../tsutils.php";
include_once "head.php";
include_once "pasutils.php";
#require "PA_appr_next_insert.php";
error_reporting(E_ERROR);
if (!CheckAuthKey ($keychk))
   {
      Error ("Login");
      exit;
   }


echo"<body bgcolor = \"#CDE1EB\">";
$ecode = $meet_to;
$emp_name = EmpNameFromEmpCode($ecode);
//echo"meet_to:$meet_to";
//$ecode = $meet_to;
$db_pas = db_open("pas_db",0);
$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$year =$key_arr[year];
$qtr =$key_arr[qtr];

$result_key = pg_query($db_pas,"select pk_sl,rm_comm from pa_lock where emp_code = $ecode and year = $year and qtr =$qtr");
$res_arr = pg_fetch_array($result_key,0);
$pk_sl =$res_arr[pk_sl];
$rm_comm =$res_arr[rm_comm];
if($rm_comm)
{
	echo"<center>Appraisal Meeting completed for this Employee</center>";
exit();
}

echo"<form name =\"f1\" action = \"PA_final_submit.php\" method=\"post\" onSubmit = \"return insert(this)\">";
//$ecode = $appr_to;
//$ecode = $meet_to;
$db_conn = db_open("offproj",0);
$ecode_gen = EcodeEnteredFromEcode($ecode);
//$emp_name = EmpNameFromEmpCode($ecode);

//$db_pas = db_open("pas_db",0);
//$result_key = pg_query($db_pas,"select pk_sl from pa_lock where emp_code = $ecode and year = 2005 and qtr = 1");
//$res_arr = pg_fetch_array($result_key,0);
//$pk_sl =$res_arr[pk_sl];
echo"<body   style='background-color: #CDE1EB !important;'>";
$emp_arr = pg_query($db_pas,"select emp_final_date,mgr_final_date,over_rate,emp_final,man_final,pa_mgr_com,pa_emp_com,emp_rate,emp_rate_w,mgr_rate,mgr_rate_w,emp_total,mgr_total,sub_date from pa_assess where pk_sl = $pk_sl");


$num_rows = pg_num_rows($emp_arr);
for($i=0;$i<$num_rows;$i++)
{
$emp_rate_arr = pg_fetch_array($emp_arr,$i);
$emp_rate = $emp_rate_arr[emp_rate];
$emp_rate_w = $emp_rate_arr[emp_rate_w];
$emp_total = $emp_rate_arr[emp_total];
$mgr_total = $emp_rate_arr[mgr_total];
$man_final = $emp_rate_arr[man_final];
$emp_final = $emp_rate_arr[emp_final];
$over_rate = $emp_rate_arr[over_rate];
$emp_final_date = $emp_rate_arr[emp_final_date];
$mgr_final_date = $emp_rate_arr[mgr_final_date];
//test  
$mgr_rate = $emp_rate_arr[mgr_rate];
$mgr_rate_w = $emp_rate_arr[mgr_rate_w];
$pa_mgr_comm = $emp_rate_arr[pa_mgr_com];
$pa_mgr_comm = stripslashes($pa_mgr_comm);
$pa_emp_comm = $emp_rate_arr[pa_emp_com];
$pa_emp_comm = stripslashes($pa_emp_comm);
$pa_sub_date = $emp_rate_arr[sub_date];
$pa_sub_date = explode('-',$pa_sub_date);
$pa_date = $pa_sub_date[2].'-'.$pa_sub_date[1].'-'.$pa_sub_date[0];
}
echo "<table><tr bgcolor='#E5E7E9'><td width = \"70%\"><B>Employee Code:</b> $ecode_gen</td><td><b>Employee Name:</b> $emp_name</td></tr><br>";
echo "<input type=\"hidden\" name=\"emp_name\" value=\"$emp_name\">";
$emp_date_fi = explode('-',$emp_final_date);
$mgr_date_fi = explode('-',$mgr_final_date);
$emp_sel = explode(',',$emp_rate);
$mgr_sel = explode(',',$mgr_rate);
$emp_sel_w = explode(',',$emp_rate_w);
$mgr_sel_w = explode(',',$mgr_rate_w);
$firstwm =  substr_replace($emp_sel_w[0],' ',0,1);
$emp_sel[0] =  substr_replace($emp_sel[0],' ',0,-1);
$emp_sel[0] = (int)$emp_sel[0];
$emp_sel[11] =  substr_replace($emp_sel[11],' ',strlen($emp_sel[11])-1,1);
$emp_sel[11] = (int)$emp_sel[11];
$emp_sel_w[11] =  substr_replace($emp_sel_w[11],' ',strlen($emp_sel_w[11])-1,1);
//$emp_sel_w[11] = (int)$emp_sel_w[11];
$mgr_sel_w[11] =  substr_replace($mgr_sel_w[11],' ',strlen($mgr_sel_w[11])-1,1);
//$mgr_sel_w[11] = (int)$mgr_sel_w[11];
$mgr_sel[0] =  substr_replace($mgr_sel[0],' ',0,-1);
$mgr_sel[0] = (int)$mgr_sel[0];
$mgr_sel[11] =  substr_replace($mgr_sel[11],' ',strlen($mgr_sel[11])-1,1);
$mgr_sel[11] = (int)$mgr_sel[11];
$mgr_sel_w[0] =  substr_replace($mgr_sel_w[0],' ',0,1);
//$mgr_sel_w[0] = (int)$mgr_sel_w[0];
Function EmpRateList($rlist,$listm)
{
	$db_pas = db_open("pas_db",0);
	$emp_rate = pg_query($db_pas,"select rate_code,rate_desc  from i_work_def");
	$num_rows = pg_num_rows($emp_rate);
		
	 echo"<select name = $rlist onChange = \"fact()\">";
	echo"<option></option>";
	for($num=0;$num<$num_rows;$num++){
		$emp_rate_arr = pg_fetch_array($emp_rate,$num);
		$rate_code = $emp_rate_arr[rate_code];
		$rate_desc = trim($emp_rate_arr[rate_desc]);
		if($rate_code==$listm)
		echo"<option value = \"$rate_code\" selected >$rate_desc</option>";
		else
		echo"<option value = \"$rate_code\">$rate_desc</option>";
		}
		echo"</select>";
	pg_close();
		}

Function RateDesc($list)
{
$db_pas =db_open("pas_db",0);
$emp_rate_desc = pg_query($db_pas,"select rate_desc  from i_work_def where rate_code =$list");
$emp_arr = pg_fetch_array($emp_rate_desc,0);
$rate_desc = $emp_arr[rate_desc];
echo"$rate_desc";
}
		
$check = isExecutive($ecode);
//$db_pas = db_open("pas_db");
$ifactor_query = pg_query($db_pas,"select sno,exec_wt,staff_wt  from i_factor");
$num_rows = pg_num_rows($ifactor_query);
for($num=0;$num<$num_rows;$num++){
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
//echo"<br>";
echo"</table>";		
echo "<br><span style='font-weight:bold'>Performance Assessment</span>
<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
<tr bgcolor='#E5E7E9'><td colspan =6><b>Job Performance</b></td></tr>
    <tr>
      <td>Factor<br>(1)</td>
      <td>Weight<br>(2)</td>
      <td>Employee's Rating<br>(3)</td>
      <td>Employee's Weighted Rating<br>(4)=(2)*(3)</td>
      <td>Manager's Rating<br>(5)</td>
      <td>Manager's Weighted Rating<br>(6)=(2)*(5)</td>
    </tr>
    <tr>
      <td>Quality of Work</td>";
      echo"<td><input type=\"text\" name =\"first\" value = $x0 size = 4 disabled></td>";
     echo "<td>";
     //EmpRateList("rlist1",$emp_sel[0]);
     # echo"$onem"; 
      RateDesc($emp_sel[0]);
     echo"</td>";
      echo"<td><input type=\"text\" name =\"firstw\"  value =\"$firstwm\" size = 4  disabled ></td>";
      
      echo"<td>";
     // EmpRateList("rlistp1");
     EmpRateList("rlistp1",$mgr_sel[0]);
      echo"</td>
      <td><input type=\"text\" name =\"firstwp\"  value =\"$mgr_sel_w[0]\" size = 4  ></td>
      </tr>
      <tr>
      <td>Quantity of Work</td>";
      echo"<td><input type=\"text\" name =\"second\" value = $x1 size = 4 disabled></td>";
      echo"<td>";
     //EmpRateList("rlist2",$emp_sel[1]);
      RateDesc($emp_sel[1]);
         
     # EmpRateList("rlist2");
      #echo"$twom";
      echo "</td>";
      echo"<td><input type=\"text\" name =\"secondw\"  value = \"$emp_sel_w[1]\" size = 4 disabled></td>";
      echo"<td>";
     EmpRateList("rlistp2",$mgr_sel[1]);
     // EmpRateList("rlistp2");
      echo"</td>
      <td><input type=\"text\" name =\"secondwp\"  value =\"$mgr_sel_w[1]\" size = 4  ></td>
    </tr>
    <tr>
      <td>Dependability</td>";
      echo"<td><input type=\"text\" name =\"third\" value = $x2 size = 4 disabled></td>";
      echo"<td>";
      // EmpRateList("rlist3",$emp_sel[2]);
      RateDesc($emp_sel[2]);
       #echo"$threem";
      echo "</td>";
      echo"<td><input type=\"text\" name =\"thirdw\"  value = $emp_sel_w[2]  size = 4 disabled ></td>";
      echo"<td>";
     EmpRateList("rlistp3",$mgr_sel[2]);
     // EmpRateList("rlistp3");
      echo "</td>
      <td><input type=\"text\" name =\"thirdwp\"  value =\"$mgr_sel_w[2]\" size = 4  ></td>
    </tr>
    <tr>
      <td>Job Knowledge</td>";
      echo"<td><input type=\"text\" name =\"four\" value = $x3 size = 4 disabled></td>";
      echo"<td>";
       //EmpRateList("rlist4",$emp_sel[3]);
      RateDesc($emp_sel[3]);
       #echo"$fourm";
      echo "</td>
      <td><input type=\"text\" name =\"fourw\"  value = \"$emp_sel_w[3]\" size = 4 disabled ></td>";
      echo"<td>";
     EmpRateList("rlistp4",$mgr_sel[3]);
      //EmpRateList("rlistp4");
      echo"</td>
      <td><input type=\"text\" name =\"fourwp\" value = \"$mgr_sel_w[3]\" size = 4 ></td>";
    echo"</tr>
    <tr>
      <td>Interest, Initiative and
Responsibility
      </td>";
      echo"<td><input type=\"text\" name =\"five\" value = $x4 size = 4 disabled></td>";
      echo"<td>";
      // EmpRateList("rlist5",$emp_sel[4]);
      RateDesc($emp_sel[4]);
       # echo"$fivem";
      echo "</td>
      <td><input type=\"text\" name =\"fivew\"  value = \"$emp_sel_w[4]\"  size = 4 disabled ></td>";
      echo"<td>";
     EmpRateList("rlistp5",$mgr_sel[4]);
   
      echo "</td>
      <td><input type=\"text\" name =\"fivewp\" value = \"$mgr_sel_w[4]\" size = 4 ></td>";
     
   echo"</tr>
    <tr>
      <td>Spoken and Written Communication
      </td>";
      echo"<td><input type=\"text\" name =\"six\" value = $x5 size = 4 disabled></td>";
      echo"<td>";
      // EmpRateList("rlist6",$emp_sel[5]);
      RateDesc($emp_sel[5]);
       #echo"$sixm";
      echo"</td>
      <td><input type=\"text\" name =\"sixw\"  value = \"$emp_sel_w[5]\" size = 4  disabled></td>
      <td>";
     EmpRateList("rlistp6",$mgr_sel[5]);
     // EmpRateList("rlistp6");
echo "</td>
      <td><input type=\"text\" name =\"sixwp\" value = \"$mgr_sel_w[5]\"  size = 4 ></td>
    </tr>
    <tr>
      <td>Discipline and Time Control
      </td>";
      echo"<td><input type=\"text\" name =\"seven\" value = $x6 size = 4 disabled></td>";
      echo"<td>";
      // EmpRateList("rlist7",$emp_sel[6]);
      RateDesc($emp_sel[6]);
       # echo"$sevenm"; 
      echo"</td>
      <td><input type=\"text\" name =\"sevenw\"  value =\"$emp_sel_w[6]\" size = 4 disabled></td>
      <td>";
     EmpRateList("rlistp7",$mgr_sel[6]);
     // EmpRateList("rlistp7");
echo "</td>
<td><input type=\"text\" name =\"sevenwp\" value = \"$mgr_sel_w[6]\" size = 4 ></td>
    </tr>
    <tr bgcolor='#E5E7E9' >
      <td colspan=\"6\"><span
 style=\"font-weight: bold;\">Potential Attributes</span>
      </td>
    </tr>
    <tr>
      <td>Creativity, Intelligence and
Mental Calibre
      </td>
      <td><input type=\"text\" name =\"eight\" value = $x7 size = 4 disabled></td>
      <td>";
      //  EmpRateList("rlist8",$emp_sel[7]);
      RateDesc($emp_sel[7]);
	#echo"$eightm";
      echo "</td>
      <td><input type=\"text\" name =\"eightw\"  value = \"$emp_sel_w[7]\" size = 4 disabled ></td>
       <td>";
     EmpRateList("rlistp8",$mgr_sel[7]);
     // EmpRateList("rlistp8");
      echo "</td>
      <td><input type=\"text\" name =\"eightwp\" value = \"$mgr_sel_w[7]\" size = 4 ></td>
      
    </tr>
    <tr>
      <td>Interpersonal Relationships and Adaptability
      </td>
      <td><input type=\"text\" name =\"nine\" value = $x8 size = 4 disabled></td>
       <td>";
      // EmpRateList("rlist9",$emp_sel[8]);
      RateDesc($emp_sel[8]);
       # echo"$ninem";
       echo "</td>
      <td><input type=\"text\" name =\"ninew\"  value = \"$emp_sel_w[8]\" size = 4  disabled></td>
      <td>";
     EmpRateList("rlistp9",$mgr_sel[8]);
     //EmpRateList("rlistp9");
echo "</td>
      <td><input type=\"text\" name =\"ninewp\" value = \"$mgr_sel_w[8]\" size = 4></td>
    </tr>
    <tr>
      <td>Team Work
      </td>
      <td><input type=\"text\" name =\"ten\" value = $x9 size = 4  disabled></td>
      <td>";
      // EmpRateList("rlist10",$emp_sel[9]);
      RateDesc($emp_sel[9]);
       #echo"$tenm";
      echo "      </td>
      <td><input type=\"text\" name =\"tenw\" value =\"$emp_sel_w[9]\" size = 4   disabled></td>
      <td>";
     EmpRateList("rlistp10",$mgr_sel[9]);
//EmpRateList("rlistp10");
echo "      </td>
      <td><input type=\"text\" name =\"tenwp\" value = \"$mgr_sel_w[9]\" size = 4 ></td>
    </tr>
    <tr>
      <td>Leadership
      </td>
      <td><input type=\"text\" name =\"eleven\" value = $x10 size = 4  disabled></td>
      <td>";
      //EmpRateList("rlist11",$emp_sel[10]);
      RateDesc($emp_sel[10]);
      # echo"$elevenm";
      echo "</td>
      <td><input type=\"text\" name =\"elevenw\" value =\"$emp_sel_w[10]\"  size = 4 disabled></td>
      
<td>";
     EmpRateList("rlistp11",$mgr_sel[10]);
//EmpRateList("rlistp11");
echo "      </td>
      <td><input type=\"text\" name =\"elevenwp\" value = \"$mgr_sel_w[10]\" size = 4 ></td>
 
    </tr>
    <tr>
      <td>Planning and Organizing
      </td>
      <td><input type=\"text\" name =\"twelve\" value = $x11 size = 4 disabled></td>
      <td>";
      //EmpRateList("rlist12",$emp_sel[11]);
      RateDesc($emp_sel[11]);
      echo "</td>
      <td><input type=\"text\" name =\"twelvew\"  value = \"$emp_sel_w[11]\" size = 4  disabled></td>
      <td>";
     EmpRateList("rlistp12",$mgr_sel[11]);
//EmpRateList("rlistp12");
echo "</td>
      <td><input type=\"text\" name =\"twelvewp\" value = \"$mgr_sel_w[11]\" size = 4></td>
    
    </tr>
    <tr>
      <td>Total Score
      </td>
      <td></td>
      <td>&nbsp;</td>
      <td><input type=\"text\" name = \"tot\" value = \"$emp_total\"  size = 4  disabled></td>
      <td>&nbsp;</td>
      <td><input type=\"text\" name = \"totm\" value = \"$mgr_total\"  size = 4 ></td>
    </tr>
  </tbody>
</table>
<span style=\"font-weight: bold;\">";
//echo"<br>";
echo"<center>";
echo"<INPUT type=\"hidden\" name=\"ecode\" value=\"$ecode\" >";
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\" >";
//echo"<INPUT type=\"hidden\" name=\"meet_to\" value=\"$meet_to\" >";
//echo"<INPUT type=\"hidden\" name=\"pk_sl\" value=\"$pk_sl\" >";
echo"</center>";
//echo"</form>";
//echo "</body></html>";


$ecode = $meet_to;
//$db_pas = db_open("pas_db");

$ecode_gen = EcodeEnteredFromEcode($ecode);
$emp_name = EmpNameFromEmpCode($ecode);

/*<head>
<script language=\"JavaScript\" type = \"text/javascript\">
      function insert()
      {
      document.f1.action = \"PA_appr_insert_lower.php\";
      }
</script>
<title>Performance Appraisal Form</title>
</head>
<body bgcolor=\"#CDE1EB\">";*/
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
echo "<br><span style='font-weight:bold'>Training and Development Needs</span>
<table style=\"width: 98%; text-align: left;\" border=\"1\" cellpadding=\"2\" cellspacing=\"2\">
  <tbody>
    <tr bgcolor='#E5E7E9'>
      <td>Sl No </td> <td>Area </td> <td>Employee's Comments </td> <td>Manager's Comments </td>
    </tr>";
     $pnp_qq = pg_query($db_pas,"select * from pa_tdn where pk_sl = $pk_sl");
     $tdnrows = pg_num_rows($pnp_qq);
     if(!$tdnrows) $tdnrows = 4;
for($k=0;$k<$tdnrows;$k++)
{
     $slno = $k+1;
     $tdn_q = pg_query($db_pas,"select area,emp_com,mgr_com from pa_tdn where pk_sl = $pk_sl and slno=$slno");
     $tdn_fetch = pg_fetch_array($tdn_q,0);
     $area_d = $tdn_fetch[area];
     $area_d =stripslashes($area_d);
     $trn_comments = trim($tdn_fetch[emp_com]);
     $trn_comments = stripslashes($trn_comments);
     $trnmn_comments =trim($tdn_fetch[mgr_com]);
    $trnmn_comments = stripslashes($trnmn_comments);
     echo "<tr>
      <td>$slno</td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"area_d$k\">$area_d</textarea></td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"trn_comments$k\">$trn_comments</textarea></td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"trnmn_comments$k\">$trnmn_comments</textarea></td>";
      echo "</tr>";
      }
    
  echo"</tbody></table>";

echo "<br><span style='font-weight:bold'>Projects/Assignments for the Next Period</span>
<table style=\"width: 98%; text-align: left;\" border=\"1\" cellpadding=\"2\"
 cellspacing=\"2\">
  <tbody>
    <tr bgcolor='#E5E7E9'>
      <td>Sl No</td><td>Tasks/Targets</td><td>Employee's Comments </td> <td>Manager's Comments</td>
    </tr>";
     $pnp_qq = pg_query($db_pas,"select oid from pa_pnp where pk_sl = $pk_sl");
     $norows = pg_num_rows($pnp_qq);
     if(!$norows) $norows = 4; 
 for($kk=0;$kk<$norows;$kk++)
{
     $slno1 = $kk+1;
     $pnp_q = pg_query($db_pas,"select tasks,emp_com,mgr_com from pa_pnp where pk_sl = $pk_sl and slno=$slno1");
     $pnp_fetch = pg_fetch_array($pnp_q,0);
     $task_d = trim($pnp_fetch[tasks]);
     $task_d = stripslashes($task_d);
     $emp_comments = trim($pnp_fetch[emp_com]);
     $emp_comments = stripslashes($emp_comments);
     $man_comments = trim($pnp_fetch[mgr_com]);
     $man_comments = stripslashes($man_comments);
    echo "<tr>
      <td>$slno1</td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"task_d$kk\">$task_d</textarea></td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"emp_comments$kk\">$emp_comments</textarea></td>
      <td><textarea rows = \"3\" cols = \"20\" name = \"man_comments$kk\">$man_comments</textarea></td>";
      echo "</tr>";
      }
   
  echo"</tbody></table>";
echo"<INPUT type=\"hidden\" name=\"ecode\" value=\"$ecode\" >
<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\" >
<INPUT type=\"hidden\" name=\"appr_to\" value=\"$appr_to\" >";
//<br><br><center><INPUT type=\"submit\" name=\"next_scr\" value=\"Submit\" onClick =\"insert()\" ></center>";
//echo"</form>";
//echo "</body></html>";
//?><?

//include_once "../tsutils.php";
//include_once "pasutils.php";
//$db_conn = db_open("offproj",0);
//$db_pas = db_open("pas_db",0);


$ecode = $meet_to;
$emp_name_disp = EmpNameFromEmpCode($ecode);
//$year = 2005;
//$qtr = 1;
$getpk_sl = pg_query($db_pas,"select pk_sl from pa_lock where emp_code = $ecode and year=$year and qtr = $qtr");
$get_num_pk = pg_num_rows($getpk_sl);
if($get_num_pk>0)
 {
 $pk_sl_fetch = pg_fetch_array($getpk_sl,0);
 $pk_sln = $pk_sl_fetch[pk_sl];
 }
 else
 {
 echo "<BR><BR><BR><center><b>$emp_name_disp has not processed appraisal form yet.</b></center>";
	  exit;
   }

$emp_info_q = pg_query($db_pas,"select dept,loc,dojg from pa_emp_info where pk_sl = $pk_sln"); 
$emp_info_fetch = pg_fetch_array($emp_info_q,0);
$dept_f = $emp_info_fetch[dept];
$loc_f = $emp_info_fetch[loc];
$loc_ff = stripslashes($loc_f);
$doj_f = $emp_info_fetch[dojg];
$doj_arr = explode('-',$doj_f);
$doj_a = $doj_arr[2].'-'.$doj_arr[1].'-'.$doj_arr[0];
$ecode_gen = EcodeEnteredFromEcode($ecode);
$emp_name = EmpNameFromEmpCode($ecode);
$emp_dq = pg_query($db_conn,"select join_date,func,designation from emp_master where emp_code = $ecode");
$emp_fetch = pg_fetch_array($emp_dq,0);
$join_d = $emp_fetch[join_date];
$join_dar = explode('-',$join_d);
$join_dd = $join_dar[2] . '-'. $join_dar[1]. '-' . $join_dar[0];
$func_d = $emp_fetch[func];
$func_ename = FuncNameFromFuncCode($func_d);
$desg_d = trim($emp_fetch[designation]);
$desg_q = pg_query($db_conn,"select desg_desc from designation where desg_code = '$desg_d'");
$desg_fetch = pg_fetch_array($desg_q,0);
$desg_get = trim($desg_fetch[desg_desc]);
$report_code = Appraised_by($pk_sln);
$report_h = EmpNameFromEmpCode($report_code);
$rev_code=GetReviewManager($ecode);
$rev_man = EmpNameFromEmpCode($rev_code);
$dob_q = pg_query($db_conn,"select birthdate from dob where eno = $ecode_gen");
$dob_fetch = pg_fetch_array($dob_q,0);
$dob = trim($dob_fetch[birthdate]);
$sal_due_q = pg_query($db_pas,"select sr_due from salary_due where eno = $ecode_gen");
$sal_fetch = pg_fetch_array($sal_due_q,0);
$sal_due = trim($sal_fetch[sr_due]);

##############Project Part###########################
   $proj_q = pg_query($db_pas,"select distinct slno from pa_emp_proj where pk_sl = $pk_sln");
 
   //$proj_q = pg_query($db_pas,"select distinct slno from pa_emp_proj where pk_sl = $slno");
   $proj_rows = pg_num_rows($proj_q);
for($i=0;$i<$proj_rows;$i++)
 {
   $proj_r_fetch = pg_fetch_array($proj_q,$i);   
   $sl_get = $proj_r_fetch[slno];
   $proj_det_q = pg_query($db_pas,"select proj_com,proj,task,mgr_comm from pa_emp_proj where pk_sl = $pk_sln and slno = $sl_get");
   $proj_det_f = pg_fetch_array($proj_det_q,0);
   $proj_a = trim($proj_det_f[proj]);
   $proj_a = stripslashes($proj_a);
   $proj_com = trim($proj_det_f[proj_com]);
   $proj_com = stripslashes($proj_com);
   $task_a = trim($proj_det_f[task]);
   $task_a = stripslashes($task_a);
   $mgr_com = trim($proj_det_f[mgr_comm]);
    $mgr_com = stripslashes($mgr_com);
  echo "  </br><span style='font-weight:bold'>Projects/Assignments carried out during the Review Period</span>";

  echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody><tr bgcolor='#E5E7E9'>
  <td colspan=\"2\">Project/Assignment</td><td colspan=\"5\">$proj_a</td></tr>
       <tr><td colspan=\"2\">Task Assigned in Project</td><td colspan=\"5\">$task_a</td></tr>
    <tr>
      <td>Sl No</td>
      <td>Task Description</td>
      <td>Status</td>
      <td>Constraints Faced</td>
      <td>Whether Constraints were overcome</td>
      <td>Reason if not accomplished</td>
      </tr>";
   $task_det_q = pg_query($db_pas,"select task_desc,status_code,cons,const_over,reason from pa_emp_task where pk_sl = $pk_sln and slno = $sl_get");
   $task_num = pg_num_rows($task_det_q);
#echo "<tr><td>$task_num</td></tr>";
for($j=0;$j<$task_num;$j++)
 {
   $task_det_f = pg_fetch_array($task_det_q,$j);
   $task_sl = $j+1;
    $task_desc_s = trim($task_det_f[task_desc]);
    $task_desc_s = stripslashes($task_desc_s);
    $stat_code_s = $task_det_f[status_code];
    $stat_code_s = stripslashes($stat_code_s);
    $const_s = trim($task_det_f[cons]);
    $const_s = stripslashes($const_s);
    $c_over_s = trim($task_det_f[const_over]);
    $c_over_s = stripslashes($c_over_s);
    $reason_s = trim($task_det_f[reason]);
   $reason_s  = stripslashes($reason_s);
    $stat_desc_q = pg_query($db_pas,"select status_desc from i_task_def where status_code=$stat_code_s");
    $stat_desc_f = pg_fetch_array($stat_desc_q,0);
    $stat_desc =  trim($stat_desc_f[status_desc]);
    echo "<tr><td>$task_sl</td><td>$task_desc_s</td><td>$stat_desc</td><td>$const_s</td><td>$c_over_s</td><td>$reason_s</td></tr>";
}

  echo "<tr>
      <td colspan=\"2\">Manager's Comments</td>
      <td colspan=\"5\"><textarea rows = \"3\" cols = \"80\" name =\"mgr_comm$sl_get\">$mgr_com</textarea></td>
    </tr>";

  echo "</tbody></table>";
}  //end for


##################################Training attended
$tpa_q = pg_query($db_pas,"select train_prog,f_date,t_date,rem from pa_tpa where pk_sl = $pk_sln");
$tpa_num = pg_num_rows($tpa_q);
if($tpa_num>0)
 {
echo "
<br><span style='font-weight:bold'>Training Programmes attended during the Review Period</span>
<table style=\"width: 98%; text-align: left;\" border=\"1\">
  <tbody>
    <tr bgcolor='#E5E7E9'><td>Sl No</td><td>Training Programme</td><td>From Date (dd-mm-yyyy)</td><td>To Date (dd-mm-yyyy)</td><td>Remarks</td>
    </tr>";
 for($i=0;$i<$tpa_num;$i++)
  {  
    $tpa_f = pg_fetch_array($tpa_q,$i); 
   $tp_num = $i+1;
    $tp_att = trim($tpa_f[train_prog]);
    $tp_att = stripslashes($tp_att);
    $tf_date = $tpa_f[f_date];
    $tt_date = $tpa_f[t_date];
    $tf_arr = explode('-',$tf_date);
    $tf_date = $tf_arr[2].'-'.$tf_arr[1].'-'.$tf_arr[0]; 
    $tt_arr = explode('-',$tt_date);
    $tt_date = $tt_arr[2].'-'.$tt_arr[1].'-'.$tt_arr[0]; 
    $tp_rem = trim($tpa_f[rem]);
    $tp_rem = stripslashes($tp_rem);
    echo "<tr><td>$tp_num</td><td>$tp_att</td><td>$tf_date</td><td>$tt_date</td><td>$tp_rem</td></tr>";
}
echo "</tbody></table>";
}
###############################################
$sa_q = pg_query($db_pas,"select skill,level from pa_sa where pk_sl = $pk_sln");
$sa_num = pg_num_rows($sa_q);
if($sa_num>0)
 {

echo "<br><span style='font-weight:bold'>Skills Acquired</span>";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\">
  <tbody>
  <tr bgcolor='#E5E7E9'><td>Sl No</td><td>Skill (Platform, Tool, Language etc)</td><td>Level (1=&gt; Low 5=&gt; high)</td></tr>";

 for($i=0;$i<$sa_num;$i++)
  {  
    $sa_f = pg_fetch_array($sa_q,$i); 
   $sa_i = $i+1;
    $s_skill = trim($sa_f[skill]);
    $s_skill = stripslashes($s_skill);
    $s_level = $sa_f[level];
  echo "<tr><td>$sa_i</td><td>$s_skill</td><td>$s_level</td></tr>";
}   
echo "</tbody></table>";
}
###################################

$da_q = pg_query($db_pas,"select domain,level from pa_dea where pk_sl = $pk_sln");
$da_num = pg_num_rows($da_q);
if($da_num>0)
 {

echo "<br><span style='font-weight:bold'>Domain Expertise Acquired</span>";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    <tr bgcolor='#E5E7E9'><td>Sl No</td><td>Domain Expertise Area (Technology, Business, Industry etc)</td><td>Level (1=&gt; Low 5=&gt; high)</td></tr>";

 for($i=0;$i<$da_num;$i++)
  {   
$da_f = pg_fetch_array($da_q,$i);
   $da_i = $i+1;
    $d_domain = trim($da_f[domain]);
    $d_domain = stripslashes($d_domain);
    $d_level = $da_f[level];
  echo "<tr><td>$da_i</td><td>$d_domain</td><td>$d_level</td></tr>";
}   
echo "</tbody></table>";
}

######################################
//added by Ankur on 3rd feb 2006 

//Additional information provided
 
$add_q = pg_query($db_pas,"select info from pa_add_info where pk_sl = $pk_sln");
$add_num = pg_num_rows($add_q);
$add_arr = pg_fetch_array($add_q);
$add_info = $add_arr[info];
if($add_num > 0 )
{
echo "<br><span style='font-weight:bold'>Additional Information</span>";
echo "<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
    <tr><td>$add_info</td></tr></tbody></table>";

}

########################################
echo "<br><span style='font-weight:bold'>Overall Assessment</span>



<table style=\"width: 98%; text-align: left;\" border=\"1\">
  <tbody>
   <tr bgcolor='#E5E7E9'>
   <td colspan=\"2\" style=\"vertical-align: top; font-weight: bold;\" width=\"35%\">Overall
   Rating</td>
   <td style=\"vertical-align: top; font-weight: bold;\">Manager's Comments</td>
      <td style=\"vertical-align: top; font-weight: bold;\">Employee's Comments</td>
     </tr>
         <tr>";
	 if($over_rate == 'first_r')
       echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"first_r\" checked > </td>";
       else
       echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"first_r\"> </td>";
       echo"<td>Not Acceptable &lt;55</td>
      <td rowspan=\"5\"><textarea rows = \"20\" cols =\"40\" name =\"pa_mgr_comm\" >$pa_mgr_comm</textarea></td>
     <td rowspan=\"5\"><textarea rows = \"20\" cols =\"40\" name =\"pa_emp_comm\" >$pa_emp_comm</textarea></td>
  </tr>
         </tr>
     <tr>";
	 if($over_rate == 'second_r')
         echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"second_r\" checked ></td>";
         else
         echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"second_r\"  ></td>";
	 
      	 echo"<td>Average 55 - 64</td>
</tr> <tr>";
	 if($over_rate == 'third_r')
echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"third_r\" checked ></td>";
else
echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"third_r\" ></td>";

echo"<td style=>Good 65 - 74</td> </tr>
<tr>";
	 if($over_rate == 'four_r')
 echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"four_r\" checked > </td>";
 else
 echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"four_r\" ></td>";
echo"<td>Very Good 75 - 84</td>
</tr>
<tr>";
	 if($over_rate == 'five_r')
echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"five_r\" checked ></td>";
else
echo"<td><INPUT type=\"radio\" name=\"over_rate\" value = \"five_r\" ></td>";

echo"<td>Excellent &gt;= 85</td>
</tr>
</tbody>
</table> ";

echo"<br><br>";
echo"<table width = \"100%\">
   <tr>
<td width = \"35%\">Employee's Confirmation:</td>";
//if($emp_final)
$cur_date=date('d');
$cur_month=date('n');
$cur_year=date('Y');
echo "<input type=\"hidden\" name=\"cur_date\" value=\"$cur_date\">
<input type=\"hidden\" name=\"cur_month\" value=\"$cur_month\">
<input type=\"hidden\" name=\"cur_year\" value=\"$cur_year\">";
if($emp_final)
echo"<td><INPUT type=\"checkbox\" name=\"emp_final\" value = \"emp_final\" checked></td>";
else
echo"<td><INPUT type=\"checkbox\" name=\"emp_final\" value = \"emp_final\" ></td>";
echo"<td>Manager's Confirmation:</td>";
if($man_final)
echo"<td><INPUT type=\"checkbox\" name=\"man_final\" value = \"man_final\" checked></td>";
else
echo"<td><INPUT type=\"checkbox\" name=\"man_final\" value = \"man_final\" ></td>";
echo"</tr>";
echo "<tr>
<td>Employee's Confirmation Date (dd-mm-yyyy):</td>
<td width=\"15%\"><INPUT type=\"text\" name=\"emp_dd\" value = \"$cur_date\" size = \"1\" maxlength=2 disabled> 
<INPUT type=\"text\" name=\"emp_mm\" value = \"$cur_month\" size = 1 maxlength=2 disabled>
<INPUT type=\"text\" name=\"emp_yy\" value = \"$cur_year\" size = \"3\" maxlength=4 disabled></td>
<td>Manager's Confirmation Date (dd-mm-yyyy):</td>
<td width=\"15%\"><INPUT type=\"text\" name=\"man_dd\" value = \"$cur_date\" size =\"1\" maxlength=\"2\" disabled>
<INPUT type=\"text\" name=\"man_mm\" value = \"$cur_month\"  size =\"1\" maxlength=\"2\" disabled>
<INPUT type=\"text\" name=\"man_yy\" value = \"$cur_year\" size =\"3\" maxlength=\"4\" disabled></td>
</tr>
   </table>";
echo"<br><br>";
###################################
echo "<center><INPUT type=\"submit\" name=\"sub_scr\" value=\"Submit\"></center>";
echo "<input type=\"hidden\" name=\"keychk\" value=\"$keychk\">";
echo "<input type=\"hidden\" name=\"pk_sln\" value=\"$pk_sln\">";
echo "<input type=\"hidden\" name=\"ecode\" value=\"$ecode\">";
echo "<input type=\"hidden\" name=\"login\" value=\"$login\">";
echo "</form>";
echo "</body></html>";
?>
