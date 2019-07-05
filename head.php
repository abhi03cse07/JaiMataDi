<?
session_start();
 //echo $username = $_SESSION['userName']; exit;
// error_reporting( E_ALL ); 
 include_once('tsutils.php');

#product details to identify by imss
#define('PRODUCTID', '16');
#define('PRODUCTKEY', '37d3ca4g53ae943fc3411295fd3719ea');
//define('PRODUCTID','14');
//define('PRODUCTKEY','37d3ca5d53a3d43fc37292959d3719e1');
//define('IAUTH_URL', 'https://test.myimss.work/iauth');
//define('IAUTH_URL_PRODUCT', 'https://test.myimss.work');
//define('SESSION_VALIDATE_PATH', '/rs/iauth/validate/session');
//define('LOGOUT_PATH', '/rs/iauth/access/logout');
//define('REDIRECT_PATH', '/access/login');
//define('PRODUCT_LIST', '/rs/iauth/product/list');
//define('MENU_KEY', 'LOG');
//define('MENU_ACTION', 'V');
//define('RETRIVE_USER_DETAILS', '1');
//define("MYIMSS_URL", IAUTH_URL . "/access/login");
   
   
   
 
//function session_validate($username, $token)
//{
    //echo "user: ".$username;die;
	$username = $_SESSION['USERNAME'];
	$token = $_SESSION['TOKEN'];
	
	 //session_validate($username, $token );
   $userDetail   =  session_validate($username, $token );
   $user = $_SESSION['userName'];
   $token = $_SESSION['token'];
   $prdId = $userDetail['prdId'];
   $name =  $userDetail['name'];
   $email = $userDetail['email'];
   //$image = $userDetail['image'];
   $id = $userDetail['empID'];
   $image = "https://apps.myimss.work/images/Employees_new/".$id.".jpg";
	 
	 
    //echo "<pre>";print_r($_SESSION);die;
    $curl_variables->productId = PRODUCTID;
    $curl_variables->productKey = PRODUCTKEY;
    $curl_variables->userName = $username;
    $curl_variables->securityToken = $token;
    $curl_variables->menuKey = MENU_KEY;
    $curl_variables->menuAction = MENU_ACTION;
    $curl_variables->retrieveUserDetails = RETRIVE_USER_DETAILS;

    $ch = curl_init();
    //curl_setopt($ch, CURLOPT_URL, IAUTH_URL . SESSION_VALIDATE_PATH);
    curl_setopt($ch, CURLOPT_URL, IAUTH_URL . PRODUCT_LIST);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curl_variables));
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    curl_close($ch);

    $decode_result = json_decode($server_output);
	
	
	
		//echo "<pre>";print_r($decode_result);die;
		
    //echo "<pre>";print_r($curl_variables);die;
/*    if ($decode_result['resultStatus'] == 'success')
    {
       $name = $decode_result['firstName'] . " " . $decode_result['lastName']; 
        $email = $decode_result['emailId'];
        $image = $decode_result['imageUrl'];
        $prdID = $decode_result['productId'];
        $reurn_array = array(
            'name' => $name,
            'email' => $email,
            'image' => $image,
			'prdId' =>  $prdID
        );
            $_SESSION['userName'] = $username;
            $_SESSION['token'] = $token;
        //return $reurn_array;
		//echo "<pre>"; print_r($reurn_array);
    }
    else
    {
       
        Redirect(MYIMSS_URL);
        exit();
    }

//}

function json_encode($a = false)
{
    if (is_null($a)) return 'null';
    if ($a === false) return 'false';
    if ($a === true) return 'true';
    if (is_scalar($a))
    {
        if (is_float($a))
        {
            return floatval(str_replace(",", ".", strval($a)));
        }
        if (is_string($a))
        {
            static $jsonReplaces = array(
                array(
                    "\\",
                    "/",
                    "\n",
                    "\t",
                    "\r",
                    "\b",
                    "\f",
                    '"'
                ) ,
                array(
                    '\\\\',
                    '\\/',
                    '\\n',
                    '\\t',
                    '\\r',
                    '\\b',
                    '\\f',
                    '\"'
                )
            );
            return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
        }
        else return $a;
    }
    $isList = true;
    for ($i = 0, reset($a);$i < count($a);$i++, next($a))
    {
        if (key($a) !== $i)
        {
            $isList = false;
            break;
        }
    }
    $result = array();
    if ($isList)
    {
        foreach ($a as $v) $result[] = json_encode($v);
        return '[' . join(',', $result) . ']';
    }
    else
    {
        foreach ($a as $k => $v) $result[] = json_encode($k) . ':' . json_encode($v);
        return '{' . join(',', $result) . '}';
    }
}

function json_decode($json)
{
    $comment = false;
    $out = '$x=';

    for ($i = 0;$i < strlen($json);$i++)
    {
        if (!$comment)
        {
            if ($json[$i] == '{' || $json[$i] == '[') $out .= ' array(';
            else if ($json[$i] == '}' || $json[$i] == ']') $out .= ')';
            else if ($json[$i] == ':') $out .= '=>';
            else $out .= $json[$i];
        }
        else $out .= $json[$i];
        if ($json[$i] == '"') $comment = !$comment;
    }
    eval($out . ';');
    return $x;
}

function Redirect($url)
{
   //session_destroy();
    echo "<script type='text/javascript'>document.location.href='{$url}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';
}

function logout($username, $token)
{
    //echo $username."////".$token;
    $curl_variables->productId = PRODUCTID;
    $curl_variables->productKey = PRODUCTKEY;
    $curl_variables->userName = $username;
    $curl_variables->securityToken = $token;
    $ch = curl_init();
	

    curl_setopt($ch, CURLOPT_URL, IAUTH_URL . LOGOUT_PATH);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($curl_variables));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json'
    ));

    $server_output = curl_exec($ch);

    curl_close($ch);

    $decode_result = json_decode($server_output);

    if ($decode_result['resultStatus'] == 'success')
    {
        Redirect(MYIMSS_URL);
    }
    else
    {
        return false;
    }
}  */

##################################################################################################################
$a = $decode_result['listOfElements'];


?>


<html>
<head>

 <link rel="icon" type="image/png" href="/iauth/images/im_icon.png">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>iAuth - home</title>
<!-- MD Bootstrap 3.3.7 -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/mdb.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="css/ionicons.min.css">
<!-- Theme style -->
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
	       folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="css/all-skins.min.css">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="css/all.css">
<link rel="stylesheet" href="cs/jquery.qtip.min.css">
<link rel="stylesheet" href="cs/select2.min.css" />
<link rel="stylesheet" href="cs/iauth.css">
<!-- Google Font -->
<link rel="stylesheet" href="css/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	



</head>
<body>
	
	
		





 <!--Main Navigation-->
    <header  style="background-color: #061743 !important;  position: fixed;
        width: 100%;">
		
       <nav class="navbar navbar-expand-md navbar-light double-nav scrolling-navbar">
            <a class="navbar-brand" href="PA_main_menu.php?userName=<?php echo $_SESSION['userName']; ?>&securityToken=<?php echo $_SESSION['token']; ?>">
                <img class="" src="http://www.myimss.work/logos/logo_myim_white.png" width="100px;" style="padding-left:10px;">
                <div style="font-size:20px;float:right;font-weight:200;color:white;padding-top:8px;">Performance Appraisal System</div>
            </a>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <li class="nav-item avatar dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-th white-text " style="font-size:150%;padding-top:2px;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-secondary" style="font-size:85%;min-width:200px;border: 1px solid #dadada;box-shadow: 0px 2px 2px 2px #f5e4e4;"
                        aria-labelledby="navbarDropdownMenuLink-5">
 
                      
                        
                                <?php
##########################################Product Name and Link From API###########################################################################								
                                        for($i=0;$i<count($a); $i++){ 
										
										 $product = $a[$i]['productName'];
										 
 /*---------------------------------------Code for icon--------------------------------------------------------------------------------------*/								 
										 
									switch ($product) {
                                    case "iManage":
                                     $icon = 'fa fa fa-cogs';
                                     break;
                                    
									case "IT Support":
                                     $icon = 'fa fa fa-wrench';
                                    break;
									
									case "Wiki";
                                    $icon = 'fa fa fa-universal-access';
                                    break;
									
									case "Scoop";
                                    $icon = 'fa fa fa-eye';
                                    break;
									
									case "Skills";
									$icon = 'fa fa fa-university';
                                    break;
									
									case "Appraisals";
                                    $icon = 'fa fa-check-square';
                                    break;
									
									case "Library";
                                    $icon = 'fa fa fa-folder-open';
                                    break;
									
									case "Sendy";
                                    $icon = 'fa fa fa-envelope-square';
                                    break;
									
									case "MyIMSS Admin";
                                    $icon = 'fa fa fa-cogs';
                                    break;
									
									case "All Apps";
                                    $icon = 'fa fa fa-cubes';
                                    break;
									
									
                                 
									
									default:
                                    $icon = 'fa fa fa-comment';
                                     }
   /*------------------------------------------------------------------------------------------------------------------------------*/                      									 
										 
							    ?>
							
								        <a class="dropdown-item waves-effect waves-light"
											 
											href="<?php echo $a[$i]['url']; ?>">
											<i class="<?php  echo $icon ; ?>"></i>
											&nbsp; <?php echo $a[$i]['productName'];   ?>
											</a> 
										
                                <?php   }
#########################################################Api Code End#################################################################################								
								 ?>
										
									
								
							
								
									
										
									
								
							
						
                    </div>
                </li>
                <li class="nav-item avatar dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <img src=<?php echo $image;?> class="rounded-circle z-depth-0" alt="User Image" style="width:30px;height: 30px;border-radius: 50%;">
                         
                        
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-secondary" style="text-align:center;font-size:85%;border: 1px solid #dadada;box-shadow: 0px 2px 2px 2px #f5e4e4;" aria-labelledby="navbarDropdownMenuLink-5">
                         
                        <img src="<?php echo $image;  ?>" class="rounded-circle z-depth-0" alt="User Image" style="max-width:60px;">
                        
                        
                        <p style="font-weight:bold;"><?php echo $name;   ?></p>
                        <p style="font-size:90%;">
                        <small><?php echo $email;  ?></small></p>
						
                        <p class="dropdown-item waves-effect waves-light" style="text-align:center;font-size:75%;line-height: 95%;border-bottom: #cdcdcd 1px solid;"></p>
                        <a class="dropdown-item waves-effect waves-light" href="PA_logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
		
    </header>
	
	<br><br><br><br>
	
	
	<script src="/iauth/plugins/jquery/3_2_1/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="/iauth/plugins/jquery-ui/1_11_4/jquery-ui.min.js"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script> $.widget.bridge('uibutton', $.ui.button); </script>
	<!-- Bootstrap 3.3.7 -->
	
	
	<!-- mdbootstrap 4_5_15 -->
	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	
	
	
	
	
	<!-- Slimscroll -->
	<script src="js/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="js/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="js/adminlte.min.js"></script>
	<!-- bootstrap datepicker -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	<!-- Qtip-->
	<script src="js/jquery.qtip.min.js"></script>
	<!-- iCheck 1.0.1 -->
	<script src="js/icheck.min.js"></script>
	<!-- ChartJS -->
	<script src="js/Chart.min.js"></script>
	<!-- JQuery Validation-->
	<script src="js/jquery.validate.min.js"></script>
	<script src="js/additional-methods.min.js"></script>
	<!-- iAuth Common javascript methods-->
	<script src="js/commonMethods.js"></script>
	<script src="js/sideMenu.js" type="text/javascript"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/header.js"></script>
	
	<!--  Google Analytics Script -->
	<script type="text/javascript" src="http://www.myimss.work/includes/ga.js"></script>
	
    <script type="text/javascript" src="http://files.imss.work/assets/library/head.js/packageloader-mdlbootstrap.js"></script>
    <script type="text/javascript">
		$(document).ready(function() {
			$("#outer-content-wrapper").css("margin-left","0px");
			$("#footer-content-wrapper").css("margin-left","0px");
			
			$("#login-box").css("margin-top","0px");
			$("#login-box").css("padding-top","0px");
		
		});
	</script>
    
	<script type="text/javascript">
var CONTEXT_PATH = "/iauth";
var MODULE_TASK_ADD = "A";
var MODULE_TASK_MODIFY = "M";
var MODULE_TASK_DELETE = "D";
var UI_DATE_FORMAT = "dd-mm-yyyy"; 
var TEST_ANSWERS_SEPERATOR_CHAR = ",";


var MODAL_TYPE_INFO = 1;
var MODAL_TYPE_ERROR = 2;
var MODAL_TYPE_SUCCESS = 3;
var MODAL_TYPE_WARNING = 4;
var MODAL_TYPE_DEFAULT = 5;

$(document).ready(function() {
	
	$("input.int-focus-on-load:first").focus();

});

</script>

	
	 <script
		src="/iauth/js/home.js"></script>