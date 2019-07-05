<?
session_start();

define('PRODUCTID','14');
define('PRODUCTKEY','37d3ca5d53a3d43fc37292959d3719e1');
define('IAUTH_URL', 'https://test.myimss.work/iauth');
//define('IAUTH_URL_PRODUCT', 'https://test.myimss.work');
define('SESSION_VALIDATE_PATH', '/rs/iauth/validate/session');
define('LOGOUT_PATH', '/rs/iauth/access/logout');
define('REDIRECT_PATH', '/access/login');
define('PRODUCT_LIST', '/rs/iauth/product/list');
define('MENU_KEY', 'LOG');
define('MENU_ACTION', 'V');
define('RETRIVE_USER_DETAILS', '1');
define("MYIMSS_URL", IAUTH_URL . "/access/login");

#######################################################################################################



function session_validate($username, $token)
{
    //echo "user: ".$username;die;
    //echo "<pre>";print_r($_SESSION);die;
    $curl_variables->productId = PRODUCTID;
    $curl_variables->productKey = PRODUCTKEY;
    $curl_variables->userName = $username;
    $curl_variables->securityToken = $token;
    $curl_variables->menuKey = MENU_KEY;
    $curl_variables->menuAction = MENU_ACTION;
    $curl_variables->retrieveUserDetails = RETRIVE_USER_DETAILS;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, IAUTH_URL . SESSION_VALIDATE_PATH);
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
    if ($decode_result['resultStatus'] == 'success')
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
        return $reurn_array;
    }
    else
    {
        /*if ($thisclient && $_GET['auth'] && $ost->validateLinkToken($_GET['auth']))
         $thisclient->logOut();
        unset($_SESSION);*/
        Redirect(MYIMSS_URL);
        exit();
    }

}
