<!-- Modified by Akila for BU Wise Reports
     Date         :9 Apr 2007 -->

<!-- Modified by Akila and Archana for the alignment of the Report & Adding New Report for Recruitment Details
     Date         :27 dec 2006 -->

<!-- Module       :Consolidated Appraisal Report
     Description  :This module deals with the consolidated report for a given financial year
     Developed by :Ankur Kapoor
     Date         :3 dec 2005 -->

 <html>
 <head> 
 <!--<title>Performance Appraisal Form</title>-->
 <script language="JavaScript">
 function cprocess()
  {
  window.close();
  return(false);
  }
 </script>

 <style>
table.roundedCorners { 
  border: 1px solid ;
  border-radius: 13px; 
  border-spacing: 0;
  }
table.roundedCorners td, 
table.roundedCorners th { 
  border-bottom: 1px solid ;
  padding: 10px; 
  }
table.roundedCorners tr:last-child > td {
  border-bottom: none;
}
</style>
 </head>
 <body style='background-color: #CDE1EB !important;'>
 

 <?
     #print_r($_POST);
 error_reporting(0);
 include_once('head.php');
     //include_once "../tsutils.php";
     include_once "pasutils.php";
    //error_reporting(E_ERROR);
 if (!CheckAuthKey ($keychk))
        {
            Error ("Login");
            exit;
        }
	$nyr= $f_year + 1;

 if(!$f_year || !$bu2)
        {
            echo "<center><b><br><br><br><font style=\"arial\" size=\"4\">Please select a financial year.</font></b></center>";
            exit;
        }
    
 echo"<h4 align = \"center\"> Year : $f_year - $nyr</h4>";
 $nyer = $f_year+1;
 if($f_year==2005)
 {
  $qtr1 = "1-April-2005:30-June-2005";
  $qtr2 = " ";
  $qtr3 = "1-July-2005:31-October-2005";
  $qtr4 = "1-November-2005:31-January-2006";
 }
 else
 {
  $qtr1 = "1-Feburary-".$f_year.":30-April-".$f_year;
  $qtr2 = "1-May-".$f_year.":31-July-".$f_year;
  $qtr3 = "1-August-".$f_year.":31-October-".$f_year;
  $qtr4 = "1-November-".$f_year.":31-January-".$nyer;
 }

 if($conso_rep) 
 {
     echo "<h3 align = \"center\">Consolidated Appraisal Report</h3>";
 }

 if($rec_rep)
 {
  echo "<h3 align = \"center\">Recruitment Effectiveness Report</h3>";
  $db_o=db_open("offproj",0);
  $tst_qry1 = pg_query($db_o, "select test_name from test_names");
  $tst_rows = pg_num_rows($tst_qry1);
      for($i=0,$j=0;$i<$tst_rows ;$i++)
      {
        $tst_arr = pg_fetch_array($tst_qry1,$i);
        $tst_arr2[$i] = $tst_arr[test_name];
        if(trim($tst_arr2[$i])!="Others")
        {
           $tst_arr1[$j]=$tst_arr2[$i];
           $j++;
        }

      }
      for($k=0;$k<sizeof($tst_arr1);$k++)
        {
                $tstname_arr[$tst_arr1[$k]]=$k;
        }

 }
    echo "<form name = \"f3\" method =\"post\" action =\"PA_view_qtr_rep.php\">";         
    echo "<BR><table class='roundedCorners' style=\"width: 98% ; text-align: center;\" border=\"10\" cellspacing = \"2\" align=\"center\"><tbody> <tr bgcolor = \"lightgrey\">";
          if($rec_rep)
          {
               echo"<td colspan = 6 >&nbsp</td>
               <td colspan = 1 >&nbsp</td>
               <td colspan = $j ><b>Test Scores</b></td>
               <td colspan = 1 >&nbsp</td>";
          }
          if($conso_rep)
          {
          	echo "<td colspan = 4 >&nbsp</td>";
          }
          echo "<td colspan = 2><b>Q1</b></td>
          <td colspan = 2><b>Q2</b></td>
          <td colspan = 2><b>Q3</b></td>
          <td colspan = 2><b>Q4</b></td></tr>
          <tr bgcolor = \"lightgrey\">
          <td colspan = 2><b>Employee Code</b></td>";
          if($conso_rep)
          {
                  echo "<td colspan = 2 align =left><b>Employee Name</b></td>";
          }
          
          if($rec_rep)
          { 
                  echo "<td colspan = 4 align = left><b>Employee Name</b></td>
                  <td colspan = 1><b>GAT Score</b></td>";
                  for($i=0;$i<$j ;$i++)
                  {
                          echo "<td colspan = 1>$tst_arr1[$i]</td>";
                  }
                  echo "<td colspan = 1><b>Overall Score</b></td>";
          }
    echo "<td colspan = 1><font color = \"red\">ER</font></td>
          <td colspan = 1>MR</td>
          <td colspan = 1><font color = \"red\">ER</font></td>
          <td colspan = 1>MR</td>
          <td colspan = 1><font color = \"red\">ER</font></td>
          <td colspan = 1>MR</td>
          <td colspan = 1><font color = \"red\">ER</font></td>
          <td colspan = 1>MR</td></tr>";

 $db_conn=db_open("pas_db",0);
 $db_off = db_open("offproj",0);
      if(trim($bu2) != "All")
       {
       $cons_qry1 = pg_query($db_off, "select * from emp_master where bu_code='$bu2' and left_date is null order by emp_name");
       }
      else
       {
       $cons_qry1 = pg_query($db_off, "select * from emp_master where left_date is null order by emp_name"); 
       }
 $count_rows = pg_num_rows($cons_qry1);

      for($i=0;$i< $count_rows ;$i++)
      {
            $er1 ="&nbsp";
            $er2 ="&nbsp";
            $er3 ="&nbsp";
            $er4 ="&nbsp";

            $mr1 ="&nbsp";
            $mr2 ="&nbsp";
            $mr3 ="&nbsp";
            $mr4 ="&nbsp";
  	      
              $cons_arr1 = pg_fetch_array($cons_qry1,$i);
              $bu[$i]=$cons_arr1[bu_code];
	      $empcod[$i] = $cons_arr1[emp_code];
      	      $empname[$i] = EmpNameFromEmpCode($empcod[$i]);
	      $ecod_gen[$i] = EcodeEnteredFromEcode($empcod[$i]);
              if($rec_rep)
              {
                      $empscore[$i] = $cons_arr1[test_score];
	              $emptest[$i] = $cons_arr1[testname];
                      $gat[$i] = $cons_arr1[gat_score];
                      $overall[$i] = $cons_arr1[overall_score];
              }
                 
              $cons_qry2 = pg_query($db_conn, "select t1.qtr ,t2.emp_total,t2.mgr_total from pa_lock t1, pa_assess t2 where t1.pk_sl= t2.pk_sl and t1.year = $f_year and t1.emp_code = $empcod[$i]"); 
             $countr = pg_num_rows($cons_qry2);
               $er = "&nbsp";
               $mr = "&nbsp";
             for($j=0;$j < $countr ; $j++)
                 {
                   $cons_arr2 = pg_fetch_array($cons_qry2, $j);
                   $quater = $cons_arr2[qtr];
                   $er = $cons_arr2[emp_total];
                   $mr = $cons_arr2[mgr_total];
                   if($mr == "")
                        $mr="&nbsp";
                   if ( $quater == 1)
                      {
                        $er1 = $er;
                        $mr1 = $mr;
                      }  
                                          
                   if ( $quater == 2)
                      {
                        $er2 = $er;
                        $mr2 = $mr;
                      }   
             
                   if ( $quater == 3)
                      {
                        $er3 = $er;
                        $mr3 = $mr;
                      }   
                   if ( $quater == 4)
                      {
                        $er4 = $er;
                        $mr4 = $mr;
                      }  

                 }
                            
            if(($i%2)== 0 )
                $colr = "lightcyan";
            else
                $colr = "lightgrey";         
                
         echo "<tr bgcolor = \"$colr\">
          <td colspan = 2>$ecod_gen[$i]</b></td>";
          if($conso_rep)
          {
              echo "<td colspan = 2 align = left >$empname[$i]</td>";
          }
          if($rec_rep)
          {
              echo " <td colspan = 4 align = left >$empname[$i]</td>";
              if($gat[$i])
                    echo "<td colspan=1><font color = \"blue\">$gat[$i]</font></td>";
              else
                    echo "<td colspan=1><font color = \"blue\">&nbsp;</font></td>";


$db_han = db_open("offproj",0);

//#############################Storing Test Scores in an Array and displaying ################################

//################################### Refreshing The Array ###################################################
      for($k=0;$k<sizeof($tst_arr1);$k++)
      {
            $tstscore_arr[$k]="&nbsp";
      }
//############################################################################################################

  $tstscore_arr[$tstname_arr[$emptest[$i]]]=$empscore[$i];
          
  for($k=0;$k<sizeof($tst_arr1);$k++)
        {
               echo "<td colspan=1>$tstscore_arr[$k]</td>";
        }

//############################################################################################################

          if($overall[$i])
                    echo "<td colspan=1><font color = \"blue\">$overall[$i]</font></td>";
          else
                    echo "<td colspan=1><font color = \"blue\">&nbsp;</font></td>";

          }
         echo "<td colspan = 1><font color = \"red\">$er1</font></td>
          <td colspan = 1>$mr1</td>
          <td colspan = 1><font color = \"red\">$er2</font></td>
          <td colspan = 1>$mr2</td>
          <td colspan = 1><font color = \"red\">$er3</font></td>
          <td colspan = 1>$mr3</td>
          <td colspan = 1><font color = \"red\">$er4</font></td>
          <td colspan = 1>$mr4</td></tr>";
  
            $er1 ="&nbsp";
            $er2 ="&nbsp";
            $er3 ="&nbsp";
            $er4 ="&nbsp";
            
            $mr1 ="&nbsp";
            $mr2 ="&nbsp";
            $mr3 ="&nbsp";
            $mr4 ="&nbsp";
      }	      
    echo "</tbody></table>";

    echo"<br><br><center><input type = \"submit\" name = \"back_form\" value = \"Exit\"></center>";
    echo"<input type = \"hidden\" name = \"keychk\" value = \"$keychk\">";

?>
</form>
</body>
</html>
