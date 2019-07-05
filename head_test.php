<?php



#product details to identify by imss
#define('PRODUCTID', '16');
#define('PRODUCTKEY', '37d3ca4g53ae943fc3411295fd3719ea');
define('PRODUCTID','14');
define('PRODUCTKEY','37d3ca5d53a3d43fc37292959d3719e1');
define('IAUTH_URL', 'https://test.myimss.work/iauth');
define('IAUTH_URL_PRODUCT', 'https://test.myimss.work');
define('SESSION_VALIDATE_PATH', '/rs/iauth/validate/session');
define('LOGOUT_PATH', '/rs/iauth/access/logout');
define('REDIRECT_PATH', '/access/login');
define('PRODUCT_LIST', '/rs/iauth/product/list');
define('MENU_KEY', 'LOG');
define('MENU_ACTION', 'V');
define('RETRIVE_USER_DETAILS', '1');
define("MYIMSS_URL", IAUTH_URL . "/access/login");


session_start();
echo  $user = $_SESSION['userName']."</br>";
echo  $token = $_SESSION['token'];

//   Information of the User from tsutils.
   /*require('tsutils.php');

   $userDetail   =  session_validate($userName,$securityToken);
   $user = $_SESSION['userName'];
   $token = $_SESSION['token'];
   $prdId = $userDetail['prdId'];
   $name =  $userDetail['name'];
   $email = $userDetail['email'];
   $image = $userDetail['image']; */
   
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
<body class="hold-transition sidebar-mini" style="text-align: center !important;font-family: 'Quicksand', sans-serif;">
	<div id="int-modal-content"></div>
	<div class="wrapper">
		





 <!--Main Navigation-->
    <header style="background-color: #061743 !important;">
		
       <nav class="navbar navbar-expand-md navbar-light double-nav scrolling-navbar">
            <a class="navbar-brand" href="">
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
                        
                        
                        
                        
							
								
									
										
											<a class="dropdown-item waves-effect waves-light"
											 
											href="<?php  echo IAUTH_URL ;?>?userName=<?php echo $user; ?>&securityToken=<?php echo $token; ?>&frmPrdId=<?php echo $prdId; ?>">
											<i class="fa fa fa-cogs"></i>
											&nbsp; iManage
											</a> 
										
									
										
									
								
							
								
									
										
											<a class="dropdown-item waves-effect waves-light"
											 
											href="<?php echo IAUTH_URL_PRODUCT; ?>/itsupport/login.php?userName=<?php echo $user; ?>&securityToken=<?php echo $token; ?>&frmPrdId= <?php echo $prdId; ?>">
											<i class="fa fa fa-wrench"></i>
											&nbsp; IT Support
											</a> 
										
									
								
							
								
									
										
											<a class="dropdown-item waves-effect waves-light"
											 
											href="<?php echo IAUTH_URL_PRODUCT; ?>/wiki/?userName=<?php echo $user; ?>&securityToken=<?php echo $token; ?>&frmPrdId=<?php echo $prdId;  ?>">
											<i class="fa fa fa-universal-access"></i>
											&nbsp; Wiki
											</a> 
										
									
								
							
								
									
										
											<a class="dropdown-item waves-effect waves-light"
											 
											href="<?php echo IAUTH_URL_PRODUCT; ?>/scoop?userName=<?php echo $user; ?>&securityToken=<?php echo $token; ?>&frmPrdId=<?php echo $prdId;  ?>">
											<i class="fa fa fa-eye"></i>
											&nbsp; Scoop
											</a> 
										
									
								
							
								
									
										
											<a class="dropdown-item waves-effect waves-light"
											 
											href="<?php echo IAUTH_URL_PRODUCT; ?>/sep/sepHome?userName=<?php echo $user; ?>&securityToken=<?php echo $token; ?>&frmPrdId=<?php echo $prdId;  ?>">
											<i class="fa fa fa-university"></i>
											&nbsp; Skills
											</a> 
										
									
								
							
								
									
										
											<a class="dropdown-item waves-effect waves-light"
											 
											href="PA_main_menu.php?userName=<?php echo $user; ?>&securityToken=<?php echo $token; ?>&frmPrdId=<?php echo $prdId;  ?>">
											<i class="fa fa-check-square  "></i>
											&nbsp; Appraisals
											</a> 
										
									
								
							
								
									
										
											<a class="dropdown-item waves-effect waves-light"
											 
											href="<?php echo IAUTH_URL_PRODUCT; ?>/library?userName=<?php echo $user; ?>&securityToken=<?php echo $token; ?>&frmPrdId=<?php echo $prdId;  ?>">
											<i class="fa fa fa-folder-open"></i>
											&nbsp; Library
											</a> 
										
									
								
							
								
									
										
											<a class="dropdown-item waves-effect waves-light"
											
												style="background-color: #6fffeb;"
											 
											href="<?php echo IAUTH_URL; ?>?userName=<?php echo $user; ?>&securityToken=<?php echo $token; ?>&frmPrdId=<?php echo $prdId;  ?>">
											<i class="fa fa fa-cubes"></i>
											&nbsp; All Apps
											</a> 
										
									
								
							
								
							
								
									
										
											<a class="dropdown-item waves-effect waves-light"
											 
											href="<?php echo IAUTH_URL_PRODUCT; ?>/feedback?userName=<?php echo $user; ?>&securityToken=<?php echo $token; ?>&frmPrdId=<?php echo $prdId;  ?>">
											<i class="fa fa fa-comment"></i>
											&nbsp; Feedback
											</a> 
										
									
								
							
						
                    </div>
                </li>
                <li class="nav-item avatar dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle white-text" style="font-size:150%;"></i>
                         
                        
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