<html>
<title>Performance Appraisal System</title>
<head>
  <style>
table.roundedCorners { 
  border: 1px solid 
  //border-radius: 13px; 
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
<script language = "JavaScript">

function update_this(){
	document.forms[0].action = "PA_update_bday_salary_save.php";
}

function go_back(){
	document.forms[0].action = "PA_main_menu.php";
}

</script>
</head>

<body style='background-color: #CDE1EB !important;'>
<BR>
<?
error_reporting(0);
include_once('head.php');
//include"../tsutils.php";
//error_reporting(E_ERROR);
 if (! CheckAuthKey ($keychk))
   {
      Error ("Login");
      exit;
   }

       

      
      
      /*if($sub_sal){
		//create table sal_dummy (emp_code_entered character(20), birthdate date, sr_due date);
		echo "salary updates to be done here";
      }*/	     
      
	//echo "<form method=\"post\" action=\"PA_update_bday_salary.php\" enctype=\"multipart/form-data\">";

      echo "<form method=\"post\" action=\"PA_update_bday_salary.php\" enctype=\"multipart/form-data\">";
      if($upload){
     	 $uploaddir = "/tmp/"; 
     	 //$file_name = basename($_FILES['file_up']['name']);
	  $file_name = "salary_bday.txt";
      	 $uploadfile = $uploaddir.$file_name; 
      	 $move = move_uploaded_file($_FILES['file_up']['tmp_name'], $uploadfile); 
          //echo " uploaded file : $uploadfile";
         if($move){
		
		echo"<br><center><font color =\"blue\"><b>File successfully uploaded!</b></font></center>";	
         	chmod($uploadfile,0777); 
		echo"<br><center><h4>Update Salary due date, Birthdates and the Appraisal flags :</h4>";
   	echo"<input type = \"hidden\" name = \"keychk\" value = \"$keychk\">";
   	echo"<input type = \"hidden\" name = \"qtrnum\" value = \"$_POST[qtrnum]\">";
   	echo"<input type = \"hidden\" name = \"lastemp\" value = \"$_POST[lastemp]\">";
		echo"<input type = \"submit\" name = \"sub_sal\" value = \"Update\" onClick = \"update_this()\"></center>";
		    
         }
         else{
		//echo "Error uploading file.";
		echo"<br><center><font color = \"red\"><b> File uploading failed! </b></font></b></center>";	
         }
	//exit();
      echo "</form>\n";
     }else{
      echo "<form method=\"post\" action=\"PA_update_bday_salary.php\">";
	echo"<br>&nbsp;&nbsp;&nbsp;<span style='font-weight:bold'>Upload the file containing Salary due date, Birthdate and Appraisal flags information of the employees:</span><center><br><br>";
	echo"<table class= 'roundedCorners' border = 1 width = 50% align = \"center\">";
	echo"<tr>
     	<td colspan ='2' align  =\"left\">
        Select the file:    <input type =\"FILE\" name = \"file_up\" ></td>
     
     </tr>
     <tr><td>";
     echo "Select quarter: \n";
     echo "<select name=\"qtrnum\">\n";
     $dbp = db_open ("pas_db");
     $res = pg_exec ($dbp, "select * from i_qtr_def");
     $rcnt = pg_numrows ($res);
     for ($i=0 ; $i<$rcnt ; $i++)
     {
        $rec = pg_fetch_array ($res, $i);
        echo "<option value=\"$rec[qtr_desc]\">$rec[qtr_desc]\n";
     }
     echo "</select>\n";
     echo "</td><td>\n";
     echo "Last emp. code: \n";
     echo "<input type=text name=lastemp>\n";
     echo "</td>\n";
     //echo "<td align = \"left\">";

      //if(file_exists())	 
    echo"<input type = \"hidden\" name = \"file_name\" value = $file_name>";
    echo"<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"20000000\" >";		
    echo"<input type = \"hidden\" name = \"keychk\" value = \"$keychk\">";
    echo "<P>";
    echo "<tr><td colspan='2'><center><input type = \"submit\" name = \"upload\" value = \" Submit \"></center></td></tr>";
         echo "</table>";
 }
       
    
   echo "<input type = \"hidden\" name = \"keychk\" value = \"$keychk\">";
   //echo "<input type = \"submit\" name = \"back_sal\" value = \"Exit\" onClick = \"go_back()\"></center>";
    echo "</form>";

    echo "<br><br><br><br><br><form><center><font color=\"blue\">Check List:</font>";
    echo "<table><tr style=\"color: #0000FF;\"><td>1. Files should be saved in CSV format.</td></tr>";
    echo "<tr style=\"color: #0000FF;\"><td>2. Last field should be of last employee number who joined before the quarter.</td></tr>";
    echo "<tr style=\"color: #0000FF;\"><td>3. Files should not have any blank lines and blank entries.</td></tr>";
    echo "</table></center></form>";
    //echo "the letter is :  ".$usr." ".$pass;

?>
</body>
</html>

