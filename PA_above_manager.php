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
  function rhscreen()
  {
  document.forms[0].action = "PA_rh_menu.php";
   document.forms[0].submit();
  }
  function insert(theForm)
      {
          
	  var l = theForm.totm.value;
	  var p1 = theForm.firstwp.value;
	  if(p1==0.0)
	  {
	  //alert("Please Enter Quality of work field"); 
	  check(1);
	  theForm.firstwp.focus(); 
	  return(false);
	   }
	  var p2 = theForm.secondwp.value;
	  if(p2==0.0)
	  {
	 // alert("Please Enter Quantity of work field"); 
	  check(2);
	   return(false);
	   }
	  var p3 = theForm.thirdwp.value;
	  if(p3==0.0)
	  {
	   //alert("Please Enter Dependibility field"); 
	   check(3);
	    return(false);
	   }
	  var p4 = theForm.fourwp.value;
	  if(p4==0.0)
	  {
	 // alert("Please Enter Job Knowledge  field"); 
	  check(4);
	    return(false);
	   }
	 var p5 = theForm.fivewp.value;
	  if(p5==0.0)
	  {
	 // alert("Please Enter Interest Initiative And Responsibility  field"); 
	    check(5);
	    return(false);
	   }
	 var p6 = theForm.sixwp.value;
	  if(p6==0.0)
	  {
	 // alert("Please Enter Spoken And Written Communication field"); 
	   check(6);
	   return(false);
	   }
	 var p7 = theForm.sevenwp.value;
	  if(p7==0.0)
	  {
	   // alert("Please Discipline And Time Control field"); 
	   check(7);
	   return(false);
	   }
	  var p8 = theForm.eightwp.value;
	  if(p8==0.0)
	  {
	 // alert("Please Enter Creativity ,Intelligence And Mental Calibre field"); 
	 check(8); 
	 return(false);
	   }
	  var p9 = theForm.ninewp.value;
	  if(p9==0.0)
	  {
	 // alert("Please Enter Interpersonal Relationship And Adaptability field"); 
	   check(9);
	    return(false);
	   }
	  var p10 = theForm.tenwp.value;
	  if(p10==0.0)
	  {
	   // alert("Please Enter Team work field"); 
	   check(10);
	   return(false);
	   }
	  var p11 = theForm.elevenwp.value;
	  if(p11==0.0)
	  {
	 // alert("Please Enter Leadership field"); 
	  check(11); 
	  return(false);
	   }
	  var p12 = theForm.twelvewp.value;
	  if(p12==0.0)
	  {
	 // alert("Please Enter Planning And Organizing field"); 
	  check(12);  
	  return(false);
	   }
          	 
 /*       var xx1 = document.f1.first.value;
        var yy1 = document.f1.rlist1.value;
	var zz1 = xx1*yy1;
	 zz1= parseFloat(zz1);  
	zz1 = zz1.toFixed(1);
	 var rs1 = document.f1.firstw.value;
	  //rs1 = parseFloat(rs1);
	 // rs1 = rs1.toFixed(1);
	 rs1=Math.round(rs1*10)/10; 
        if(zz1!=rs1)
	 {
	 alert("You can not edit  weighted rating of \"Quality of Work\"field of Employee");
	   return(false);
	   }
	   var xx2 = document.f1.second.value;
	            var yy2 = document.f1.rlist2.value;
		    var zz2 = xx2*yy2;
	            zz2= parseFloat(zz2);  
                    zz2 = zz2.toFixed(1);
	            var rs2 = document.f1.secondw.value;
	           // rs2 = parseFloat(rs2);
	           // rs2 = rs2.toFixed(1);
	           rs2=Math.round(rs2*10)/10; 
		    
		    if(rs2!=zz2)
		    {
		    alert("You can not edit  weighted rating of \"Quantity of Work\"field of Employee");
		    return(false); 
	            }
	             var xx3 = document.f1.third.value;
	             var yy3 = document.f1.rlist3.value;
		     var zz3 = xx3*yy3;
                    
	           // zz3= parseFloat(zz3);  
		   // zz3 = zz3.toFixed(1);
	            zz3=Math.round(zz3*10)/10; 
	            var rs3 = document.f1.thirdw.value;
	            //rs3 = parseFloat(rs3);
	           // rs3 = rs3.toFixed(1);
	            rs3=Math.round(rs3*10)/10; 
		    if(rs3!=zz3)
		    {
		    alert("You can not edit  weighted rating of \"Dependibilty\"field of Employee");
		    return(false); 
	            }
	            var xx4 = document.f1.four.value;
	            var yy4 = document.f1.rlist4.value;
		    var zz4 = xx4*yy4;
	           // zz4= parseFloat(zz4);  
                   // zz4 = zz4.toFixed(1);
	            zz4=Math.round(zz4*10)/10; 
	            var rs4 = document.f1.fourw.value;
	           // rs4 = parseFloat(rs4);
	           // rs4 = rs4.toFixed(1);
	            rs4=Math.round(rs4*10)/10; 
		    if(rs4!=zz4)
		    {
		    alert("You can not edit  weighted rating of \"Job Knowledge\"field of Employee");
		    return(false); 
	            }
	            var xx5 = document.f1.five.value;
	            var yy5 = document.f1.rlist5.value;
		    var zz5 = xx5*yy5;
	           // zz5= parseFloat(zz5);  
                   // zz5 = zz5.toFixed(1);
	             zz5=Math.round(zz5*10)/10; 
	            var rs5 = document.f1.fivew.value;
	            //rs5 = parseFloat(rs5);
	           // rs5 = rs5.toFixed(1);
	            rs5=Math.round(rs5*10)/10; 
		    if(rs5!=zz5)
		    {
		    alert("You can not edit  weighted rating of \"Interest,Initiative And Responsibility\"field of Employee");
		    return(false); 
	            }
	            var xx6 = document.f1.six.value;
	            var yy6 = document.f1.rlist6.value;
		    var zz6 = xx6*yy6;
	           // zz6= parseFloat(zz6);  
                   // zz6 = zz6.toFixed(1);
	            zz6=Math.round(zz6*10)/10; 
	            var rs6 = document.f1.sixw.value;
	           // rs6 = parseFloat(rs6);
	           // rs6 = rs6.toFixed(1);
	            rs6=Math.round(rs6*10)/10; 
		    if(rs6!=zz6)
		    {
		    alert("You can not edit  weighted rating of \"Spoken And Written Communication\"field of Employee");
	             document.f1.sixw.value = zz6;
		    return(false); 
	            }
	            var xx7 = document.f1.seven.value;
	            var yy7 = document.f1.rlist7.value;
		    var zz7 = xx7*yy7;
	            //zz7= parseFloat(zz7);  
                    
                  //  zz7 = zz7.toFixed(1);
	             zz7=Math.round(zz7*10)/10; 
	            var rs7 = document.f1.sevenw.value;
	            rs7 = parseFloat(rs7);
	            rs7 = rs7.toFixed(1);
		    if(rs7!=zz7)
		    {
		    alert("You can not edit  weighted rating of \"Discipline And Time Control\"field of Employee");
		    return(false); 
	            }
	            var xx8 = document.f1.eight.value;
	            var yy8 = document.f1.rlist8.value;
		    var zz8 = xx8*yy8;
	          //  zz8= parseFloat(zz8);  
                  
                    //zz8 = zz8.toFixed(1);
	             zz8=Math.round(zz8*10)/10; 
	            var rs8 = document.f1.eightw.value;
	            //rs8 = parseFloat(rs8);
	           // rs8 = rs8.toFixed(1);
	           rs8=Math.round(rs8*10)/10; 
		    if(rs8!=zz8)
		    {
		    alert("You can not edit  weighted rating of \"Creativity,Intelligence And Mental Calibre\"field of Employee");
		    return(false); 
	            }
	            var xx9 = document.f1.nine.value;
	            var yy9 = document.f1.rlist9.value;
		    var zz9 = xx9*yy9;
	            //zz9= parseFloat(zz9);  
                    //zz9 = zz9.toFixed(1);
	            zz9=Math.round(zz9*10)/10; 
	            var rs9 = document.f1.ninew.value;
	            //rs9 = parseFloat(rs9);
	           // rs9 = rs9.toFixed(1);
	                rs9=Math.round(rs9*10)/10; 
		    if(rs9!=zz9)
		    {
		    alert("You can not edit  weighted rating of \"Interpersonal Relationship And Adaptability\"field of Employee");
		    return(false); 
	            }
	            var xx10 = document.f1.ten.value;
	            var yy10= document.f1.rlist10.value;
		    var zz10 = xx10*yy10;
	            //zz10= parseFloat(zz10);  
                   // zz10 = zz10.toFixed(1);
	           zz10=Math.round(zz10*10)/10; 
	            var rs10 = document.f1.tenw.value;
	           // rs10 = parseFloat(rs10);
	           // rs10 = rs10.toFixed(1);
	            rs10=Math.round(rs10*10)/10; 
		    if(rs10!=zz10)
		    {
		    alert("You can not edit  weighted rating of \"Team Work\"field of Employee");
		    return(false); 
	            }
	            var xx11 = document.f1.eleven.value;
	            var yy11= document.f1.rlist11.value;
		    var zz11 = xx11*yy11;
	           // zz11= parseFloat(zz11);  
                   // zz11 = zz11.toFixed(1);
	             zz11=Math.round(zz11*10)/10; 
	            var rs11 = document.f1.elevenw.value;
	           // rs11 = parseFloat(rs11);
	           // rs11 = rs11.toFixed(1);
	           rs11=Math.round(rs11*10)/10; 
		    if(rs11!=zz11)
		    {
		    alert("You can not edit  weighted rating of \"Leadership\"field of Employee");
		    return(false); 
	            }
	            var xx12 = document.f1.twelve.value;
	            var yy12= document.f1.rlist12.value;
		    var zz12 = xx12*yy12;
	           // zz12= parseFloat(zz12);  
                   // zz12 = zz12.toFixed(1);
	           zz12=Math.round(zz12*10)/10; 
	            var rs12 = document.f1.twelvew.value;
	            //rs12 = parseFloat(rs12);
	            //rs12 = rs12.toFixed(1);
	            rs12=Math.round(rs12*10)/10; 
		    if(rs12!=zz12)
		    {
		    alert("You can not edit  weighted rating of \"Planning And Organizing\"field of Employee");
		    return(false); 
	            }
		    var totz = parseFloat(zz1)+parseFloat(zz2)+parseFloat(zz3)+parseFloat(zz4)+parseFloat(zz5)+parseFloat(zz6)+parseFloat(zz7)+parseFloat(zz8)+parseFloat(zz9)+parseFloat(zz10)+parseFloat(zz11)+parseFloat(zz12); 
		    //totz = totz.toFixed(1);
	            totz=Math.round(totz*10)/10; 
	            var rtot = document.f1.tot.value;
		    if(totz!=rtot)
	            {
		    alert("You can not edit total score of Employee ");
		    return(false);
		    }	  */  
	var xm1 = document.f1.first.value;
        var ym1 = document.f1.rlistp1.value;
	var zm1 = xm1*ym1;
	// zm1= parseFloat(zm1);  
	 //zm1 = zm1.toFixed(1);
	 zm1=Math.round(zm1*10)/10; 
	var rm1 = document.f1.firstwp.value;
	// rm1 = parseFloat(rm1);
	 //rm1 = rm1.toFixed(1);
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
                    // zp2 = zp2.toFixed(1);
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
	            //rm3 = parseFloat(rm3);
	           // rm3 = rm3.toFixed(1);
	              rm3=Math.round(rm3*10)/10; 
		    if(rm3!=zm3)
		    {
		    alert("You can not edit  weighted rating of \"Dependibilty\"field of Manager");
		    return(false); 
	            }
	             var xm4 = document.f1.four.value;
	             var ym4 = document.f1.rlistp4.value;
		     var zm4 = xm4*ym4;
	            // zm4= parseFloat(zm4);  
                    // zm4 = zm4.toFixed(1);
	              zm4=Math.round(zm4*10)/10; 
	            var rm4 = document.f1.fourwp.value;
	           // rm4 = parseFloat(rm4);
	           // rm4 = rm4.toFixed(1);
	            rm4=Math.round(rm4*10)/10; 
		    if(rm4!=zm4)
		    {
		    alert("You can not edit  weighted rating of \"Job Knowledge\"field of Manager");
		    return(false); 
	            }
	             var xm5 = document.f1.five.value;
	             var ym5 = document.f1.rlistp5.value;
		     var zp5 = xm5*ym5;
	            //zp5= parseFloat(zp5);  
                    // zp5 = zp5.toFixed(1);
	           zp5=Math.round(zp5*10)/10; 
	            var rp5 = document.f1.fivewp.value;
	           // rp5 = parseFloat(rp5);
	           // rp5 = rp5.toFixed(1);
	           rp5=Math.round(rp5*10)/10; 
		    if(rp5!=zp5)
		    {
		    alert("You can not edit  weighted rating of \"Interest,Initiative And Responsibility\"field of Manager");
		    return(false); 
	            }
	             var xm6 = document.f1.six.value;
	             var ym6 = document.f1.rlistp6.value;
		     var zm6 = xm6*ym6;
	           // zm6= parseFloat(zm6);  
                    // zm6 = zm6.toFixed(1);
	            zm6=Math.round(zm6*10)/10; 
	            var rm6 = document.f1.sixwp.value;
	           // rm6 = parseFloat(rm6);
	           // rm6 = rm6.toFixed(1);
	           rm6=Math.round(rm6*10)/10; 
		    if(rm6!=zm6)
		    {
		    alert("You can not edit  weighted rating of \"Spoken And Written Communication\"field of Manager");
	             
		    return(false); 
	            }
	             var xm7 = document.f1.seven.value;
	             var ym7 = document.f1.rlistp7.value;
		     var zm7 = xm7*ym7;
	            zm7= parseFloat(zm7);  
                   //  zm7 = zm7.toFixed(1);
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
                    // zm8 = zm8.toFixed(1);
	             zm8=Math.round(zm8*10)/10; 
	            var rs8 = document.f1.eightwp.value;
	           // rs8 = parseFloat(rs8);
	            //rs8 = rs8.toFixed(1);
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
	            //rp9 = rp9.toFixed(1);
	            rp9=Math.round(rp9*10)/10; 
		    if(rp9!=zp9)
		    {
		    alert("You can not edit  weighted rating of \"Interpersonal Relationship And Adaptability\"field of Manager");
		    return(false); 
	            }
	             var xm10 = document.f1.ten.value;
	             var ym10= document.f1.rlistp10.value;
		     var zm10 = xm10*ym10;
	            // zm10= parseFloat(zm10);  
                    // zm10 = zm10.toFixed(1);
	             zm10=Math.round(zm10*10)/10; 
	            var rm10 = document.f1.tenwp.value;
	           // rm10 = parseFloat(rm10);
	          //  rm10 = rm10.toFixed(1);
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
                     //zp11 = zp11.toFixed(1);
	             zp11=Math.round(zp11*10)/10; 
	            var rp11 = document.f1.elevenwp.value;
	           // rp11 = parseFloat(rp11);
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
                   //  zm12 = zm12.toFixed(1);
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
		   // totmz = totmz.toFixed(1);
	           totmz=Math.round(totmz*10)/10; 
	            var rtotm = document.f1.totm.value;
		    rtotm = parseFloat(rtotm);
		   //rtotm = rtotm.toFixed(1);
	            rtotm=Math.round(rtotm*10)/10; 
		    if(totmz!=rtotm)
	            {
	 	    alert("You can not edit total score of Manager ");
		    return(false);
		    }	    
   // function test()
   // {
   var name=confirm("Are you sure you have entered the ratings on Appraisal Form of Employee");
   if (name==true)
   {
      document.forms[0].action = "PA_perf_insert.php";
      document.forms[0].submit();
    }
   else
    {
     //alert("hi");
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
                    // z2 = z2.toFixed(1);
	             z2=Math.round(z2*10)/10; 
		     document.f1.secondwp.value = z2;
	             var x3 = document.f1.third.value;
	             var y3 = document.f1.rlistp3.value;
		     var z3 = x3*y3;
                    // z3 = z3.toFixed(1);
	             z3=Math.round(z3*10)/10; 
		     document.f1.thirdwp.value = z3;
	             var x4 = document.f1.four.value;
	             var y4 = document.f1.rlistp4 .value;
		     var z4 = x4*y4;
                    // z4 = z4.toFixed(1);
	              z4=Math.round(z4*10)/10; 
		     document.f1.fourwp.value = z4;
	             var x5 = document.f1.five.value;
	             var y5 = document.f1.rlistp5.value;
		     var z5 = x5*y5;
                    // z5 = z5.toFixed(1);
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
                     //z7 = z7.toFixed(1);
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
	            // z= z.toFixed(1); 
	           z=Math.round(z*10)/10; 
                     document.f1.totm.value = z;
	             var total = document.f1.totm.value;
		   /*  if(total<55)
	             {
		      document.f1.over_rate[0].checked="true";
		     }	     
		     
		     if(total>=55 && total<=64)
	             {
		      document.f1.over_rate[1].checked="true";
		     }	     
		     if(total>=65 && total<=74)
	             {
		      document.f1.over_rate[2].checked="true";
		     }	     
		     if(total>=75 && total<=84)
	             {
		      document.f1.over_rate[3].checked="true";
		     }	     
		     if(total>84)
	             {
		      document.f1.over_rate[4].checked="true";
		     }	     
	             var xe1 = document.f1.first.value;
	             var ye1 = document.f1.rlist1.value;
		     var ze1 = xe1*ye1;
                    // ze1 = ze1.toFixed(1)
	           ze1=Math.round(ze1*10)/10; 
		     document.f1.firstw.value = ze1;
	             var xe2 = document.f1.second.value;
	             var ye2 = document.f1.rlist2.value;
		     var ze2 = xe2*ye2;
                   //  ze2 = ze2.toFixed(1);
	           ze2=Math.round(ze2*10)/10; 
		     document.f1.secondw.value = ze2;
	             var xe3 = document.f1.third.value;
	             var ye3 = document.f1.rlist3.value;
		     var ze3 = xe3*ye3;
                   //  ze3 = ze3.toFixed(1);
	           ze3=Math.round(ze3*10)/10; 
		     document.f1.thirdw.value = ze3;
	             var xe4 = document.f1.four.value;
	             var ye4 = document.f1.rlist4 .value;
		     var ze4 = xe4*ye4;
                   //  ze4 = ze4.toFixed(1);
	           ze4=Math.round(ze4*10)/10; 
		     document.f1.fourw.value = ze4;
	             var xe5 = document.f1.five.value;
	             var ye5 = document.f1.rlist5.value;
		     var ze5 = xe5*ye5;
                   //  ze5 = ze5.toFixed(1);
	           ze5=Math.round(ze5*10)/10; 
		     document.f1.fivew.value = ze5;
	             var xe6 = document.f1.six.value;
	             var ye6 = document.f1.rlist6.value;
		     var ze6 = xe6*ye6;
                   //  ze6 = ze6.toFixed(1);
	           ze6=Math.round(ze6*10)/10; 
		     document.f1.sixw.value = ze6;
	             var xe7 = document.f1.seven.value;
	             var ye7 = document.f1.rlist7.value;
		     var ze7 = xe7*ye7;
                     //ze7 = ze7.toFixed(1);
	           ze7=Math.round(ze7*10)/10; 
		     document.f1.sevenw.value = ze7;
		     var xe8 = document.f1.eight.value;
	             var ye8 = document.f1.rlist8.value;
		     var ze8 = xe8*ye8;
                   //  ze8 = ze8.toFixed(1);
	           ze8=Math.round(ze8*10)/10; 
		     document.f1.eightw.value = ze8;
	             var xe9 = document.f1.nine.value;
	             var ye9 = document.f1.rlist9.value;
		     var ze9 = xe9*ye9;
                   //  ze9  = ze9.toFixed(1);
	           ze9=Math.round(ze9*10)/10; 
		     document.f1.ninew.value = ze9;
	             var xe10 = document.f1.ten.value;
	             var ye10 = document.f1.rlist10.value;
		     var ze10 = xe10*ye10;
                   //  ze10 = ze10.toFixed(1);
	           ze10=Math.round(ze10*10)/10; 
		     document.f1.tenw.value = ze10;
	             var xe11 = document.f1.eleven.value;
	             var ye11 = document.f1.rlist11.value;
		     var ze11 = xe11*ye11;
                   //  ze11 = ze11.toFixed(1);
	           ze11=Math.round(ze11*10)/10; 
		     document.f1.elevenw.value = ze11;
	             var xe12 = document.f1.twelve.value;
	             var ye12 = document.f1.rlist12.value;
		     var ze12 = xe12*ye12;
                   //  ze12 = ze12.toFixed(1);
	           ze12=Math.round(ze12*10)/10; 
		     document.f1.twelvew.value = ze12;
             
		    var ze = parseFloat(ze1)+parseFloat(ze2)+parseFloat(ze3)+parseFloat(ze4)+parseFloat(ze5)+parseFloat(ze6)+parseFloat(ze7)+parseFloat(ze8)+parseFloat(ze9)+parseFloat(ze10)+parseFloat(ze11)+parseFloat(ze12); 
	           //  ze= ze.toFixed(1); 
	           ze=Math.round(ze*10)/10; 
                     document.f1.tot.value = ze;*/
  
 }

		    </script>
<title>Performance Appraisal Form</title>


</head>
<?
error_reporting(0);
#print_r($_POST);
include_once('head.php');
//include_once "../tsutils.php";
include_once "pasutils.php";
error_reporting(E_ERROR);
if (! CheckAuthKey ($keychk))
   {
      Error ("Login");
      exit;
   }
$ecode = $appr_to;
$db_conn = db_open("offproj",0);
echo"<form name =\"f1\"  method=\"POST\" onSubmit = \"return insert(this)\">";

//if($next_scr)
// {
/*$db_pas = db_open("pas_db",0);
$result_key = pg_query($db_pas,"select mgr_rate from pa_lock where emp_code = $ecode and year = $year and qtr = $qtr");
$res_arr = pg_fetch_array($result_key,0);
$mgr_rate =$res_arr[mgr_rate];
if($mgr_rate == 't')
{
//echo"You have already filled manager's rating form";
//exit;
//echo"<input type = \"submit\" name =\"sb1\" value = \"Ok\" onClick = exit()>i";
}*/

/*$pa_mgr_com = addslashes($pa_mgr_com);
$pa_emp_com = addslashes($pa_emp_com);
$rm_com = addslashes($rm_com);
$result = pg_exec($db_pas,"update pa_assess set mgr_rate=array[$rlistp1,$rlistp2,$rlistp3,$rlistp4,$rlistp5,$rlistp6,$rlistp7,$rlistp8,$rlistp9,$rlistp10,$rlistp11,$rlistp12],emp_rate = array[$rlist1,$rlist2,$rlist3,$rlist4,$rlist5,$rlist6,$rlist7,$rlist8,$rlist8,$rlist9,$rlist10,$rlist11,$rlist12],emp_rate_w = array[$firstw,$secondw,$thirdw,$fourw,$fivew,$sixw,$sevenw,$eightw,$ninew,$tenw,$elevenw,$twelvew],mgr_rate_w = array[$firstwp,$secondwp,$thirdwp,$fourwp,$fivewp,$sixwp,$sevenwp,$eightwp,$ninewp,$tenwp,$elevenwp,$twelvewp],mgr_total = $totm,emp_total = $tot,pk_sl = $pk_sl,pa_mgr_com='$pa_mgr_com',pa_emp_com='$pa_emp_com',rm_com='$rm_com'"); 

if($result)
{
  echo "<BR><BR><BR><center><b>Data Updated Successfully</b></center>";
//  echo"<input type =\"submit\" name  = \"sb1\" value = \"Ok\" onClick = \"menu()\">";
//exit();
 }
else
 {
  echo "<BR><BR><BR><center><b>Data Could not be updated</b></center>";
  exit();
 }

 }*/

$ecode = $appr_to;
$ecode_gen = EcodeEnteredFromEcode($ecode);
$emp_name = EmpNameFromEmpCode($ecode);
$db_pas=db_open("pas_db",0);
$get_key = pg_query($db_pas,"select qtr,year from pa_init");
$key_arr = pg_fetch_array($get_key,0);
$year =$key_arr[year];                                                                         
$qtr =$key_arr[qtr];
$db_pas = db_open("pas_db",0);
$result_key=pg_query($db_pas,"select pk_sl from pa_lock where emp_code=$ecode and year = $year and qtr = $qtr");
$res_arr = pg_fetch_array($result_key,0);
$pk_sl =$res_arr[pk_sl];

#########################################
// added by ankur on 4th feb 2006

$db_offp = db_open("offproj",0);
$rep_exe = pg_query($db_offp,"select reportsto from emp_master where emp_code=$ecode");
$rep_arr = pg_fetch_array($rep_exe);
$repto = $rep_arr[reportsto];

//echo " Repoting Head =  $repto"; 

$appr_exe = pg_query($db_pas,"update pa_lock set appr_by=$repto where pk_sl= $pk_sl"); 


########################################
echo"<body style='background-color: #CDE1EB !important;'>";
$emp_arr = pg_query($db_pas,"select emp_final_date,mgr_final_date,over_rate,emp_final,man_final,pa_mgr_com,pa_emp_com,emp_rate,emp_rate_w,mgr_rate,mgr_rate_w,emp_total,mgr_total,sub_date from pa_assess where pk_sl = $pk_sl");
//echo "<table><tr><td width = \"60%\">Employee Code: $ecode_gen </td><td>Employee Name: $emp_name</td></tr></table>";


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
echo "<table align='center'><tr><td width = \"60%\"><B>Employee Code:</b> $ecode_gen</td><td><b>Employee Name:</b> $emp_name</td></tr>";
echo"<br><tr><td colspan='2'><b>Submission Date of Employee</b>:&nbsp;$pa_date<b>&nbsp;&nbsp;(dd-mm-yyyy)</b></td></tr></table>";
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
$mgr_sel_w[11] =  substr_replace($mgr_sel_w[11],' ',strlen($mgr_sel_w[11])-1,1);
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
	#echo"<form name =\"f1\" action =\"$PHP_SELF#book\" method=\"post\">";
//echo"ecode:$ecode";
$check = isExecutive($ecode);
$db_pas = db_open("pas_db");
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
		
	echo "
<table style=\"width: 98%; text-align: left;\" border=\"1\"><tbody>
<tr><td colspan ='4' bgcolor='#E5E7E9'><b>Job Performance</b></td></tr>
    <tr>
      <td>Factor<br>(1)</td>
      <td>Weight<br>(2)</td>";
      echo"<td>Manager's Rating<br>(5)</td>
      <td>Manager's Weighted Rating<br>(6)=(2)*(5)</td>
    </tr>
    <tr>
      <td>Quality of Work</td>";
      echo"<td><input type=\"text\" name =\"first\" value = $x0 size = 4 disabled></td>";
     echo "<td>";
   /*  EmpRateList("rlist1",$emp_sel[0]);
     # echo"$onem"; 
      
     echo"</td>";
      echo"<td><input type=\"text\" name =\"firstw\"  value =\"$firstwm\" size = 4  ></td>";
      
      echo"<td>";
     // EmpRateList("rlistp1");*/
     EmpRateList("rlistp1",$mgr_sel[0]);
      echo"</td>
      <td><input type=\"text\" name =\"firstwp\"  value =\"$mgr_sel_w[0]\" size = 4  ></td>
      </tr>
      <tr>
      <td>Quantity of Work</td>";
      echo"<td><input type=\"text\" name =\"second\" value = $x1 size = 4 disabled></td>";
     // echo"<td>";
   /*  EmpRateList("rlist2",$emp_sel[1]);
      # EmpRateList("rlist2");
      #echo"$twom";
      echo "</td>";
      echo"<td><input type=\"text\" name =\"secondw\"  value = \"$emp_sel_w[1]\" size = 4></td>";
     */
      echo"<td>";
     EmpRateList("rlistp2",$mgr_sel[1]);
     // EmpRateList("rlistp2");
      echo"</td>
      <td><input type=\"text\" name =\"secondwp\"  value =\"$mgr_sel_w[1]\" size = 4  ></td>
    </tr>
    <tr>
      <td>Dependability</td>";
      echo"<td><input type=\"text\" name =\"third\" value = $x2 size = 4 disabled></td>";
      /*echo"<td>";
       EmpRateList("rlist3",$emp_sel[2]);
       #echo"$threem";
      echo "</td>";
      echo"<td><input type=\"text\" name =\"thirdw\"  value = $emp_sel_w[2]  size = 4 ></td>";
      */
      echo"<td>";
     EmpRateList("rlistp3",$mgr_sel[2]);
     // EmpRateList("rlistp3");
      echo "</td>
      <td><input type=\"text\" name =\"thirdwp\"  value =\"$mgr_sel_w[2]\" size = 4  ></td>
    </tr>
    <tr>
      <td>Job Knowledge</td>";
      echo"<td><input type=\"text\" name =\"four\" value = $x3 size = 4 disabled></td>";
     /* echo"<td>";
       EmpRateList("rlist4",$emp_sel[3]);
       #echo"$fourm";
      echo "</td>*/
   //echo"td><input type=\"text\" name =\"fourw\"  value = \"$emp_sel_w[3]\" size = 4  ></td>";
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
     /* echo"<td>";
       EmpRateList("rlist5",$emp_sel[4]);
       # echo"$fivem";
      echo "</td>*/
    //echo"<td><input type=\"text\" name =\"fivew\"  value = \"$emp_sel_w[4]\"  size = 4 ></td>";
      echo"<td>";
     EmpRateList("rlistp5",$mgr_sel[4]);
   
      echo "</td>
      <td><input type=\"text\" name =\"fivewp\" value = \"$mgr_sel_w[4]\" size = 4 ></td>";
     
   echo"</tr>
    <tr>
      <td>Spoken and Written Communication
      </td>";
      echo"<td><input type=\"text\" name =\"six\" value = $x5 size = 4 disabled></td>";
    /*  echo"<td>";
       EmpRateList("rlist6",$emp_sel[5]);
       #echo"$sixm";
      echo"</td>*/
     // echo"td><input type=\"text\" name =\"sixw\"  value = \"$emp_sel_w[5]\" size = 4  ></td>
     echo"<td>";
     EmpRateList("rlistp6",$mgr_sel[5]);
     // EmpRateList("rlistp6");
echo "</td>
      <td><input type=\"text\" name =\"sixwp\" value = \"$mgr_sel_w[5]\"  size = 4 ></td>
    </tr>
    <tr>
      <td>Discipline and Time Control
      </td>";
      echo"<td><input type=\"text\" name =\"seven\" value = $x6 size = 4 disabled></td>";
    /*  echo"<td>";
       EmpRateList("rlist7",$emp_sel[6]);
       # echo"$sevenm"; 
      echo"</td>*/
     // echo"<td><input type=\"text\" name =\"sevenw\"  value =\"$emp_sel_w[6]\" size = 4 ></td>
      echo"<td>";
     EmpRateList("rlistp7",$mgr_sel[6]);
     // EmpRateList("rlistp7");
echo "</td>
<td><input type=\"text\" name =\"sevenwp\" value = \"$mgr_sel_w[6]\" size = 4 ></td>
    </tr>
    <tr>
      <td colspan=\"6\" bgcolor='#E5E7E9'><span
 style=\"font-weight: bold;\">Potential Attributes</span>
      </td>
    </tr>
    <tr>
      <td>Creativity, Intelligence and
Mental Calibre
      </td>
      <td><input type=\"text\" name =\"eight\" value = $x7 size = 4 disabled></td>";
     /* <td>
        EmpRateList("rlist8",$emp_sel[7]);
	#echo"$eightm";
      echo "</td>
      <td><input type=\"text\" name =\"eightw\"  value = \"$emp_sel_w[7]\" size = 4  ></td>
       <td>";*/
       echo"<td>";
       EmpRateList("rlistp8",$mgr_sel[7]);
      echo "</td>
      <td><input type=\"text\" name =\"eightwp\" value = \"$mgr_sel_w[7]\" size = 4 ></td>
      
    </tr>
    <tr>
      <td>Interpersonal Relationships and Adaptability
      </td>
      <td><input type=\"text\" name =\"nine\" value = $x8 size = 4 disabled></td>";
       /*<td>
       EmpRateList("rlist9",$emp_sel[8]);
       # echo"$ninem";
       echo "</td>
      <td><input type=\"text\" name =\"ninew\"  value = \"$emp_sel_w[8]\" size = 4 ></td>
      <td>";*/
      echo"<td>";
      EmpRateList("rlistp9",$mgr_sel[8]);
     //EmpRateList("rlistp9");
echo "</td>
      <td><input type=\"text\" name =\"ninewp\" value = \"$mgr_sel_w[8]\" size = 4></td>
    </tr>
    <tr>
      <td>Team Work
      </td>
      <td><input type=\"text\" name =\"ten\" value = $x9 size = 4  disabled></td>";
      /*<td>
       EmpRateList("rlist10",$emp_sel[9]);
       #echo"$tenm";
      echo "      </td>
      <td><input type=\"text\" name =\"tenw\" value =\"$emp_sel_w[9]\" size = 4  ></td>*/
      echo"<td>";
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
     // EmpRateList("rlist11",$emp_sel[10]);
      # echo"$elevenm";
     // echo "</td>
     // <td><input type=\"text\" name =\"elevenw\" value =\"$emp_sel_w[10]\"  size = 4 ></td>
      
     EmpRateList("rlistp11",$mgr_sel[10]);
//EmpRateList("rlistp11");
echo "      </td>
      <td><input type=\"text\" name =\"elevenwp\" value = \"$mgr_sel_w[10]\" size = 4 ></td>
 
    </tr>
    <tr>
      <td>Planning and Organizing
      </td>
      <td><input type=\"text\" name =\"twelve\" value = $x11 size = 4 disabled></td>";
      /*<td>
      EmpRateList("rlist12",$emp_sel[11]);
      echo "</td>
      <td><input type=\"text\" name =\"twelvew\"  value = \"$emp_sel_w[11]\" size = 4 ></td>*/
      echo"<td>";
     EmpRateList("rlistp12",$mgr_sel[11]);
//EmpRateList("rlistp12");
echo "</td>
      <td><input type=\"text\" name =\"twelvewp\" value = \"$mgr_sel_w[11]\" size = 4></td>
    
    </tr>
    <tr>
      <td colspan='3' bgcolor='#E5E7E9'><b>Total Score</b>
      </td>";
      
      //<td><input type=\"text\" name = \"tot\" value = \"$emp_total\"  size = 4 ></td>
      echo"
      <td bgcolor='#E5E7E9'><input type=\"text\" name = \"totm\" value = \"$mgr_total\"  size = 4 ></td>
    </tr>
  </tbody>
</table>
<span style=\"font-weight: bold;\">";
echo"<br>";
/*echo "Overall Assessment
<br><br>
<table style=\"width: 98%; text-align: left;\" border=\"1\">
<tbody>
<tr>
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
<td rowspan=\"6\"><textarea rows = \"20\" cols =\"40\" name =\"pa_mgr_comm\" >$pa_mgr_comm</textarea></td>
     <td rowspan=\"6\"><textarea rows = \"20\" cols =\"40\" name =\"pa_emp_comm\" >$pa_emp_comm</textarea></td>
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
if($emp_final)
echo"<td><INPUT type=\"checkbox\" name=\"emp_final\" value = \"emp_final\" checked></td>";
else
echo"<td><INPUT type=\"checkbox\" name=\"emp_final\" value = \"emp_final\" ></td>";

echo"<td>Manager's Confirmation:</td>";
if($man_final)
echo"<td><INPUT type=\"checkbox\" name=\"man_final\" value = \"man_final\" checked></td>";
else
echo"<td><INPUT type=\"checkbox\" name=\"man_final\" value = \"man_final\" ></td>";
echo"</tr>
<tr>
<td>Employee's Confirmation Date:</td>
<td><INPUT type=\"text\" name=\"emp_dd\" value = \"$emp_date_fi[2]\" size = 2>
<INPUT type=\"text\" name=\"emp_mm\" value = \"$emp_date_fi[1]\" size = 2>
<INPUT type=\"text\" name=\"emp_yy\" value = \"$emp_date_fi[0]\" size = 3></td>
<td>Manager's Confirmation Date:</td>
<td><INPUT type=\"text\" name=\"man_dd\" value = \"$mgr_date_fi[2]\" size = 2></td>
<td><INPUT type=\"text\" name=\"man_mm\" value = \"$mgr_date_fi[1]\"  size = 2></td>
<td><INPUT type=\"text\" name=\"man_yy\" value = \"$mgr_date_fi[0]\" size = 3></td>
</tr>*/
   echo"</table>";
echo"<br><br>";
echo"<INPUT type=\"hidden\" name=\"ecode\" value=\"$ecode\" >";
echo"<INPUT type=\"hidden\" name=\"keychk\" value=\"$keychk\" >";
echo"<INPUT type=\"hidden\" name=\"appr_to\" value=\"$appr_to\" >";
echo"<INPUT type=\"hidden\" name=\"pk_sl\" value=\"$pk_sl\" >";
echo"<center><INPUT type=\"submit\" name=\"next_scr\" value=\"Submit\" onClick= \"test()\">";
echo"&nbsp;";
//echo"<INPUT type=\"submit\" name=\"exit\" value=\"Exit\" onClick= \"rhscreen() \">";
echo"<INPUT type=\"hidden\" name=\"login\" value=\"$login\" >";

echo"</center>";
echo"</form>";
echo "</body></html>";
?>
