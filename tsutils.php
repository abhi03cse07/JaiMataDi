<?
session_start();
$TIMEOUT = 36000; # timeout authorization after 600 idle mins.
$MAILSERVER_INT = "integramicro.com";
$MAILSERVER = "integramicro.com";
$WEBSERVER = "pcc.integramicro.co.in";
$LDAPSERVER = "tuxedo.integramicro.co.in";
$PCC_ID = "pcc@$MAILSERVER";
$CMG_ID = "cmg@$MAILSERVER"; # CMG group alias on MAILSERVER
$HRD_ID = "hrd@$MAILSERVER"; # HRD group head alias on MAILSERVER
$HRDGROUP_ID = "hrdgroup@$MAILSERVER"; # HRD group alias on MAILSERVER
$ADMIN_ID = "admin@$MAILSERVER"; # Admin. group head alias on MAILSERVER
$MARKETING_ID = "mktg@$MAILSERVER"; # Marketing group alias on MAILSERVER
$GROUP_ID = "imss@$MAILSERVER"; # IMSS group alias on MAILSERVER
$PUR_ID = "purchase@$MAILSERVER_INT"; # Purchase group alias on MAILSERVER


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

#########################################################################
# Check username and password. If OK, make entry in table 'login', but
# only if entry doesn't already exist. Return key for further auth. checks.
#########################################################################
function Authenticate($user, $pwd)
{

    $doauth = 1;

    $ip = ip2addr();
   //session_destroy();
    if ($doauth)
    {
        //session_start();
        /***
        $svr = $GLOBALS["MAILSERVER"];
        //$mbox = imap_open ('{'.$svr.':110/pop3/notls}', "$user", "$pwd");
        
        if (! $mbox)
        {
         $db_conn = db_open ("offproj");
         $res = pg_exec ($db_conn, "DELETE FROM login WHERE login='$user'");
         pg_close ($db_conn);
         echo "Error 1";
         return NULL;
        }
        else
         imap_close ($mbox);
        ****/
        //commenting the below code of ldap auth
        /*$ds = ldap_connect ('tuxedo.integramicro.co.in');  // must be a valid LDAP server!
        
        if ($ds)
        {
         ldap_set_option ($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
         ldap_set_option ($ds, LDAP_OPT_REFERRALS, 0);
        
         // Search surname entry
         $sr = ldap_search ($ds, "dc=integramicro,dc=co,dc=in", "uid=$user");
         $res = ldap_get_entries ($ds, $sr);
         $resdn =  $res[0]['dn'];
         $res = ldap_bind ($ds, $resdn, $pwd);
        }
        if (! $ds || ! $res)    // ldap server connect failed, or bad user/password
        {
         $db_conn = db_open ("offproj");
         $res = pg_exec ($db_conn, "DELETE FROM login WHERE login='$user'");
         pg_close ($db_conn);
         return NULL;
        }*/
        //echo $user."/////".$pwd;die;
        $result_array = session_validate($user, $pwd);
        //echo "<pre>"; print_r($result_array);die;
        if (count($result_array) > 0)
        {   
	
           $_SESSION['userName'] = $user;
           $_SESSION['token'] = $pwd;
        }
        else
        {
			
            Redirect(MYIMSS_URL);
        }
    }

    $db_conn = db_open("offproj", 0);
    $res = pg_exec($db_conn, "SELECT * FROM emp_master WHERE login='$user' AND left_date is NULL");

    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        return NULL;
    }
    if (!pg_numrows($res))
    {
        Error("db_query");
        pg_close($db_conn);
        return NULL;
    }
    else
    {
        $rec = pg_fetch_array($res, 0);
        $ecode = $rec[emp_code];
    }

    $res = pg_exec($db_conn, "SELECT * FROM login WHERE login='$user'");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        return NULL;
    }
    $curstamp = time();
    if (pg_numrows($res))
    {
        $rec = pg_fetch_array($res, 0);
        $stamp = $rec[stamp] + $GLOBALS["TIMEOUT"];
        if ($curstamp > $stamp) $res = pg_exec($db_conn, "DELETE FROM login WHERE login='$user'");
        else
        {
            $res = pg_exec($db_conn, "UPDATE login SET stamp=$curstamp,
                           ipaddr=$ip WHERE login='$user'");
            pg_close($db_conn);
            return $rec[id];
        }
    }
    $str = sprintf("%d%s", $curstamp, $user);
    $key = md5($str);
    $res = pg_exec($db_conn, "INSERT INTO login VALUES ('$user', $ecode, 
                     '$curstamp', '$key', '$ip')");
    pg_close($db_conn);
    return $key;
}

#################################################################
function CheckAuthKey1($key)
{
    global $TIMEOUT;
    $ret = 0;
    $db_conn = db_open();
    $res = pg_exec($db_conn, "SELECT * FROM login WHERE id='$key'");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    if (pg_numrows($res))
    {
        $rec = pg_fetch_array($res, 0);
        $stamp = $rec[stamp] + $TIMEOUT;
        $curstamp = time();
        if ($curstamp < $stamp)
        {
            $res = pg_exec($db_conn, "UPDATE login SET stamp=$curstamp WHERE id='$key'");
            $ret = 1;
        }
    }
    pg_close($db_conn);
    return $ret;
}

function CheckAuthKey($key)
{
    $ret = 0;
    $db_conn = db_open();
    //echo "1";echo "<pre>";print_r($_SESSION);die;
    $user = $_SESSION['userName'];
    $token = $_SESSION['token'];
    $result_array = session_validate($user, $token);
    //echo "<pre>";print_r($result_array);die;
    if (count($result_array) > 0)
    {
        $rec = pg_fetch_array($res, 0);
        $stamp = $rec[stamp] + $TIMEOUT;
        $curstamp = time();
        $res = pg_exec($db_conn, "UPDATE login SET stamp=$curstamp WHERE id='$key'");
        $ret = 1;
    }
    else
    {
        //session_destroy();
        Redirect(MYIMSS_URL);
    }
    return $ret;
}

#################################################################
function Error($err)
{
    echo "<p>";
    echo "<br>";
    switch ($err)
    {
        case "ACL":
            echo "<p align=center><b>You do not have the required permissions to access this function.</b>";
        break;
        case "Login":
            echo "<p align=center><b>The user name or password you have entered is not correct or has expired. Please try again.</b>";
        break;
        case "db_connect":
            echo "<p align=center><b>Database connection failed.</b>";
        break;
        case "db_query":
            echo "<p align=center><b>Database query failed.</b>";
        break;
        case "no_record":
            echo "<p align=center><b>Unable to get specified record.</b>";
        break;
        case "already_assigned":
            echo "<p align=center><b>This employee has already been assigned.</b>";
        break;
        case "empty":
            echo "<p align=center><b>No matching records found.</b>";
        case "user_pass_empty":
            echo "<p align=center><b>Username or Password can't be empty</b>";
        break;
    }
    return (0);
}

#################################################################
function make_button($label)
{
    $img = imagecreate(60, 25);
    $col1 = imagecolorallocate($img, 0, 0, 255);
    $col2 = imagecolorallocate($img, 255, 255, 0);
    imagefill($img, 0, 0, $col1);
    imagestring($img, 3, 8, 5, $label, $col2);
    return $img;
}

#################################################################
# Show emp. list in drop down list ("$multiselect=0)
# or multiselect list ("$multiselect" is non-zero)
#################################################################
function ShowEmpList($ecode, $multiselect)
{
    $db_proj = db_open();
    $sel = 0;

    # $result = pg_exec ($db_proj, "SELECT * FROM emp_master
    #                      WHERE left_date is NULL ORDER BY emp_name");
    $result = pg_exec($db_proj, "SELECT t1.*, t2.emp_code_entered 
                     FROM emp_master t1, emp_code_gen t2
                        WHERE t1.left_date is NULL AND 
                        t1.emp_code=t2.emp_code ORDER BY emp_name");
    $nrows = pg_numrows($result);
    if (!$nrows) echo "<center><B>No employee details available.</B></center><P>";

    if (!$multiselect) echo "<SELECT NAME=\"elist\">\n";
    echo "<OPTION value=0>";
    for ($i = 0;$i < $nrows;$i++)
    {
        $rec = pg_fetch_array($result, $i);
        if ($ecode == $rec[emp_code])
        {
            echo "<OPTION value=$rec[emp_code] selected>$rec[emp_name]
         ($rec[emp_code_entered])\n";
            $sel = 1;
        }
        else echo "<OPTION value=$rec[emp_code]>$rec[emp_name]
         ($rec[emp_code_entered])\n";
    }
    /*
    if (! $ecode || ! $sel)
      echo "<OPTION value=0 selected>";
    else
      echo "<OPTION value=0>";
    */
    echo "</SELECT>\n";
}

#################################################################
# Helper function for ShowReportingStaff - fills selection list with
# all staff reporting (directly or indirectly) to $ecode
#################################################################
function FillReportingStaff($dbh, $ecode)
{
    $result = pg_exec($dbh, "SELECT * FROM emp_master
                        WHERE left_date is NULL AND reportsto=$ecode
                        ORDER BY emp_name");
    $nrows = pg_numrows($result);
    for ($i = 0;$i < $nrows;$i++)
    {
        $rec = pg_fetch_array($result, $i);
        FillReportingStaff($dbh, $rec[emp_code]);
        if ($ecode == $rec[emp_code]) echo "<OPTION value=$rec[emp_code] selected>$rec[emp_name]\n";
        else echo "<OPTION value=$rec[emp_code]>$rec[emp_name]\n";
    }
}

#################################################################
function ShowReportingStaff($ecode, $varval)
{
    $db_proj = db_open();

    if ($varval != "") echo "<SELECT NAME=\"$varval\">\n";
    else echo "<SELECT NAME=\"reporters\">\n";
    FillReportingStaff($db_proj, $ecode);
    if (!$ecode) echo "<OPTION value=0 selected>";
    else echo "<OPTION value=0>";
    echo "</SELECT>\n";
}

#################################################################
function HasStaff($ecode)
{
    $db_proj = db_open();

    $result = pg_exec($db_proj, "SELECT * FROM emp_master WHERE 
                        left_date is NULL AND reportsto=$ecode");
    $nrows = pg_numrows($result);
    if ($nrows > 0) return (1);
    else return (0);
}

#################################################################
function HasProjectStaff($pcode, $ecode)
{
    $db_proj = db_open();

    $result = pg_exec($db_proj, "SELECT T1.* FROM emp_master T1, proj_staff T2
                        WHERE T2.proj_code='$pcode' AND T1.emp_code=T2.emp_code AND
                        T1.left_date is NULL AND T1.reportsto=$ecode");
    $nrows = pg_numrows($result);
    if ($nrows > 0) return (1);
    else return (0);
}

#################################################################
function ShowOsList()
{
    $db_proj = db_open();

    $result = pg_exec($db_proj, "SELECT * FROM os_master 
                        WHERE obsolete != 'y' ORDER BY sequence, os");
    $nrows = pg_numrows($result);
    if (!$nrows) echo "<center><B>No OS details available.</B></center><P>";

    echo "<B>OS: </B>\n";
    echo "<SELECT NAME=\"oscode\">\n";
    for ($i = 0;$i < $nrows;$i++)
    {
        $rec = pg_fetch_array($result, $i);
        $os = trim($rec[osid]);
        echo "<OPTION value=$os>$rec[os]\n";
    }
    echo "</SELECT>\n";
}

#################################################################
function ShowEmploymentStatus($employcode)
{
    $db_proj = db_open();

    $result = pg_exec($db_proj, "SELECT * FROM employment_status_master");
    $nrows = pg_numrows($result);
    if (!$nrows) echo "<center><B>Employment details unavailable.</B></center><P>";

    echo "<SELECT NAME=\"employstat\">\n";
    for ($i = 0;$i < $nrows;$i++)
    {
        $rec = pg_fetch_array($result, $i);
        $ecode = trim($rec[employcode]);
        if ($employcode == $ecode) echo "<OPTION value=$ecode selected>$rec[employmentstatus]\n";
        else echo "<OPTION value=$ecode>$rec[employmentstatus]\n";
    }
    if (!$employcode) echo "<OPTION value=0 selected>";
    else echo "<OPTION value=0>";
    echo "</SELECT>\n";
}

#################################################################
function OSNameFromOSCode($osid)
{
    $db_proj = db_open();

    $result = pg_exec($db_proj, "SELECT * FROM os_master where osid=$osid");
    $nrows = pg_numrows($result);
    if ($nrows)
    {
        $rec = pg_fetch_array($result, 0);
        return ($rec[os]);
    }
    else return ("");
}

#################################################################
function ShowCurrencyList($sel)
{
    $db_proj = db_open();

    $result = pg_exec($db_proj, "SELECT * FROM currency");
    $nrows = pg_numrows($result);
    if (!$nrows) echo "<center><B>No currency details available.</B></center><P>";

    echo "<B>Currency: </B>\n";
    echo "<SELECT NAME=\"currency\">\n";
    for ($i = 0;$i < $nrows;$i++)
    {
        $rec = pg_fetch_array($result, $i);
        $currency = trim($rec[code]);
        if ($sel == $currency) echo "<OPTION value=$currency selected>$rec[currency]\n";
        else echo "<OPTION value=$currency>$rec[currency]\n";
    }
    echo "</SELECT>\n";
}

###################################################################
# hack - it actually shows projects for given user in the project,
# or all projects if user belongs to STG function (==10)
###################################################################
function UserProjects($ecode)
{
    $uproj = array();

    $db_conn = db_open();
    $res = pg_exec($db_conn, "SELECT DISTINCT ON (proj_code) T1.proj_code,
                  proj_name, T1.emp_code FROM proj_staff T1, proj_master T2,
                  emp_master T3 WHERE 
                  (T1.emp_code=$ecode OR (T3.emp_code=$ecode AND T3.func=10)) 
                  AND T1.proj_code=T2.proj_code AND T1.to_date is NULL");

    #                     AND (T1.emp_code=T3.emp_code OR T3.func=10)
    #                     AND T1.proj_code=T2.proj_code AND T1.to_date is NULL");
    if (!$res) return NULL;
    else
    {
        $nrecs = pg_numrows($res);
        for ($i = 0;$i < $nrecs;$i++)
        {
            $rec = pg_fetch_array($res, $i);
            $uproj[] = trim($rec[0]);
            $uproj[] = trim($rec[1]);
        }
    }
    pg_close($db_conn);
    return $uproj;
}

######################################################################
# return 2 arrays - project codes to which given emp_code is currently
# assigned, or reasons for which emp. is reserved
######################################################################
function GetAssgnForEmp($ecode, &$act, &$block)
{
    $db_conn = db_open();
    $res = pg_exec($db_conn, "SELECT proj_code FROM proj_staff WHERE emp_code=$ecode 
                     AND to_date is NULL");
    if (!$res) return NULL;
    else
    {
        $nrecs = pg_numrows($res);
        if (!$nrecs)
        {
            $res = pg_exec($db_conn, "SELECT reason FROM staff_reserved WHERE emp_code=$ecode 
                           AND to_date is NULL");
            $nrecs = pg_numrows($res);
            for ($i = 0;$i < $nrecs;$i++)
            {
                $rec = pg_fetch_array($res, $i);
                $block[] = trim($rec[0]);
            }
        }
        else
        {
            for ($i = 0;$i < $nrecs;$i++)
            {
                $rec = pg_fetch_array($res, $i);
                $act[] = trim($rec[0]);
            }
        }
    }
}

##############################################################
function ShowProjectStaff($pcode, $owner, $ecode)
{
    $db_proj = db_open();

    if ($ecode)
    {
        $grade = GradeFromEmpCode($ecode);
        $result = pg_exec($db_proj, "SELECT DISTINCT T1.emp_code, T2.emp_name FROM
                           proj_staff T1, emp_master T2 WHERE
                           T1.emp_code=T2.emp_code AND proj_code='$pcode' AND
                           T2.grade < $grade AND T1.to_date IS NULL AND
                           T2.left_date IS NULL
                           ORDER BY T2.emp_name ASC");
    }
    else $result = pg_exec($db_proj, "SELECT DISTINCT T1.emp_code, T2.emp_name FROM
                           proj_staff T1, emp_master T2 WHERE
                           T1.emp_code=T2.emp_code AND proj_code='$pcode'
                           ORDER BY T2.emp_name ASC");
    $nrows = pg_numrows($result);
    $rec = pg_fetch_array($result, 0);
    echo "<SELECT NAME=\"staff\">\n";
    if (!$owner) echo "<OPTION value=0 selected>";
    else echo "<OPTION value=0>";
    for ($i = 0;$i < $nrows;$i++)
    {
        $rec = pg_fetch_array($result, $i);
        $ecode = trim($rec[emp_code]);
        $ecode_gen = EcodeEnteredFromEcode($ecode);
        $ename = trim(EmpNameFromEmpCode($ecode));
        if ($ecode == $owner) echo "<OPTION VALUE=\"$ecode\" selected>$ename ($ecode_gen)\n";
        else echo "<OPTION VALUE=\"$ecode\">$ename ($ecode_gen)\n";
    }
    echo "</SELECT>\n";
}

#################################################################
# Show list of projects in a dropdown list. "$active" determines
# whether to show all projects or only the active ones.
#################################################################
function ShowProjectList($key, $active)
{
    $db_proj = db_open();

    if (!$key)
    {
        if ($active) $result = pg_exec($db_proj, "SELECT * FROM proj_master WHERE
                              aped IS NULL OR proj_code IN
                              (SELECT DISTINCT (proj_code) FROM proj_invoice_details
                              WHERE invoice_amt > 0 AND closed='f') 
                              ORDER BY process_model DESC, psd DESC");
        else $result = pg_exec($db_proj, "SELECT * FROM proj_master
                              ORDER BY process_model DESC, psd DESC");
    }
    else
    {
        $ecode = EmpCodeFromAuthKey($key);
        if ($active) $result = pg_exec($db_proj, "SELECT T1.* FROM proj_master T1,
                           proj_staff T2 WHERE aped IS NULL AND
                           T1.proj_code=T2.proj_code AND
                           T2.emp_code=$ecode AND T2.to_date is NULL ORDER BY
                           T1.process_model DESC, T1.psd DESC");
        else $result = pg_exec($db_proj, "SELECT T1.* FROM proj_master T1,
                           proj_staff T2 WHERE T1.proj_code=T2.proj_code AND
                           T2.emp_code=$ecode ORDER BY
                           T1.process_model DESC, T1.psd DESC");
        //T2.emp_code=$ecode AND T2.to_date is NULL ORDER BY
        
    }
    $nrows = pg_numrows($result);
    if ($nrows)
    {
        echo "<B>Project: </B>";
        echo "<SELECT NAME=\"pcode\">";
        echo "<OPTION>";
        $procmodel = 0;
        for ($i = 0;$i < $nrows;$i++)
        {
            $rec = pg_fetch_array($result, $i);
            if ($i && $rec[process_model] != $procmodel) echo "</OPTGROUP>\n";
            if ($rec[process_model] != $procmodel) echo "<OPTGROUP Label=\"--------------------------\">\n";
            $procmodel = $rec[process_model];
            $pcode = trim($rec[proj_code]);
            if ($rec[aped]) echo "<OPTION style=\"color:#808080\" value=$pcode>$rec[proj_name] ($rec[proj_code])\n";
            else echo "<OPTION value=$pcode>$rec[proj_name] ($rec[proj_code])\n";
        }
        echo "</SELECT>\n";
    }
    else echo "<center><B>No active projects.</B></center><P>\n";
    return ($nrows);
}

#################################################################
function ProjNameFromProjCode($id)
{
    if (!$id) return (0);
    $db_conn = db_open();
    $res = pg_exec("SELECT proj_name FROM proj_master WHERE proj_code='$id'");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    $rec = pg_fetch_array($res, 0);
    return (trim($rec[0]));
}

#################################################################
function EmpCodeFromAuthKey($key)
{
    $db_conn = db_open();
    $res = pg_exec($db_conn, "SELECT emp_code FROM login WHERE id='$key'");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    $rec = pg_fetch_array($res, 0);
    return ($rec[0]);
}

#################################################################
function EmpNameFromEmpCode($id)
{
    if (!$id || $id < (-1)) return ("NONE");
    $db_conn = db_open("offproj");

    $res = pg_exec($db_conn, "SELECT emp_name FROM emp_master WHERE emp_code=$id");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    $rec = pg_fetch_array($res, 0);
    return (trim($rec[0]));
}

#################################################################
function EmpFuncFromEmpCode($id)
{
    if (!$id || $id < (-1)) return ("NONE");
    $db_conn = db_open("offproj");

    $res = pg_exec($db_conn, "SELECT func FROM emp_master WHERE emp_code=$id");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    $rec = pg_fetch_array($res, 0);
    return ($rec[0]);
}

#################################################################
function IsEmpCurrent($id)
{
    if ($id < (-1)) return ("NONE");
    $db_conn = db_open();
    $res = pg_exec("SELECT * FROM emp_master WHERE emp_code='$id'");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    $rec = pg_fetch_array($res, 0);
    if ($rec[left_date]) return (0);
    else return (1);
}

#################################################################
function EmpCodeFromLogin($id)
{
    $db_conn = db_open();
    $res = pg_exec("SELECT emp_code FROM emp_master WHERE login='$id'
                     AND left_date is NULL");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    $rec = pg_fetch_array($res, 0);
    return (trim($rec[0]));
}

#################################################################
function LoginFromEmpCode($ecode)
{
    $db_conn = db_open();
    $res = pg_exec("SELECT login FROM emp_master WHERE emp_code=$ecode");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    $rec = pg_fetch_array($res, 0);
    return (trim($rec[0]));
}

#################################################################
function ReportingHead($id)
{
    $db_conn = db_open("offproj");
    $res = pg_exec("SELECT reportsto FROM emp_master WHERE emp_code=$id
                     AND left_date is NULL");
    if (!$res)
    {
        pg_close($db_conn);
        return (0);
    }
    $rec = pg_fetch_array($res, 0);
    $result = $rec[0];
    //******* Temporary Change for the Appraisal Period May 2007 to July 2007*************
    $temp_app_man = pg_query($db_conn, "select * from temp_rev_manager where emp_code='$id'");
    $count = pg_num_rows($temp_app_man);
    if ($count)
    {
        $result = 1141;
    }

    //************************************************************************************
    return ($result);
}

#################################################################
function ProjCodeFromProjName($id)
{
    if (!$id) return (0);
    $db_conn = db_open();
    $res = pg_exec("SELECT proj_code FROM proj_master WHERE proj_name='$id'");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    $rec = pg_fetch_array($res, 0);
    return (trim($rec[0]));
}

#################################################################
function CustNameFromCustCode($cust_code)
{
    $db_conn = db_open();
    $res = pg_exec("SELECT cust_name FROM cust_data WHERE trim(cust_code)='$cust_code'");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    $rec = pg_fetch_array($res, 0);
    return (trim($rec[0]));
}

#################################################################
function db_open($dbname, $open_flag)
{
    global $WEBSERVER;

    if ($dbname[0])
    {
        $db = strtolower($dbname);
        //$db_handle = pg_connect("$WEBSERVER", 5432, "", "$db");
        $conn_string = "host=172.16.1.162 port=5432 dbname=$db user=postgres password=postgres";
        $db_handle = pg_connect($conn_string);
    }
    //else $db_handle = pg_connect("$WEBSERVER", 5432, "", "offproj");
    else
    {
        $conn_string = "host=172.16.1.162 port=5432 dbname=offproj user=postgres password=postgres";
        $db_handle = pg_connect($conn_string);
    }
    if (!$open_flag)
    {
        if (!$db_handle)
        {
            Error("db_connect");
            exit;
        }
    }
    return $db_handle;
}

######################################################
function GetMon($m)
{
    $m = strval($m);
    $m = trim($m);
    switch ($m)
    {
        case 1:
            $mon = "Jan";
            return $mon;
        break;
        case 2:
            $mon = "Feb";
            return $mon;
        break;
        case 3:
            $mon = "Mar";
            return $mon;
        break;
        case 4:
            $mon = "Apr";
            return $mon;
        break;
        case 5:
            $mon = "May";
            return $mon;
        break;
        case 6:
            $mon = "Jun";
            return $mon;
        break;
        case 7:
            $mon = "Jul";
            return $mon;
        break;
        case 8:
            $mon = "Aug";
            return $mon;
        break;
        case 9:
            $mon = "Sep";
            return $mon;
        break;
        case 10:
            $mon = "Oct";
            return $mon;
        break;
        case 11:
            $mon = "Nov";
            return $mon;
        break;
        case 12:
            $mon = "Dec";
            return $mon;
        break;
    }
}

####################################################################
function rnd($float, $dec)
{
    if ($dec == 0) return round($float);
    else return floor($float * pow(10, $dec) + 0.5) / pow(10, $dec);
}

####################################################################
function SelectFromIrrReq()
{
    $db_conn = db_open();
    $query = "select * from irr_request";
    $result = pg_exec($db_conn, $query);
    return $result;
}

####################################################################
function CallExternalCPCNAME($keychk)
{
    $ecode = EmpCodeFromAuthKey($keychk);
    $a[0] = EmpNameFromEmpCode($ecode);
    $a[1] = "CPC";
    $a[2] = "External";
    return $a;
}

####################################
function CallExternalCPCID($keychk)
{
    $ecode = EmpCodeFromAuthKey($keychk);
    $b[0] = "$ecode";
    $b[1] = "0";
    $b[2] = "-1";
    return $b;
}

####################################
function is_num($str)
{
    $len = strlen($str);
    for ($i = 0;$i < $len;$i++)
    {
        $o = ord($str[$i]);
        if ($o < ord('0') || $o > ord('9')) return (0);
    }
    return (1);
}

#########################################
function CPC_EXTERNAL_NAME($auth_name)
{
    if ($auth_name == 0) return "CPC";
    else if ($auth_name == - 1) return "External";
}

########################################
function Log_File($login)
{
    $log = "log.txt";
    $cur_dd = date("M d Y");
    $cur_tt = date("H:i:s");
    $fl_op = fopen($log, "a+");
    fwrite($fl_op, "$cur_dd : $cur_tt : $login has successfully logged in.\n");
    fclose($fl_op);
}

#########################################################################
function Log_Update($login, $table_name)
{
    $log = "log.txt";
    $cur_dd = date("M d Y");
    $cur_tt = date("H:i:s");
    $fl_op = fopen($log, "a+");
    fwrite($fl_op, "$cur_dd $cur_tt : $login : The following data were updated in the table $table_name :\n");
    fclose($fl_op);
}

#########################################################################
function Log_Insert($login, $table_name)
{
    $log = "log.txt";
    $cur_dd = date("M d Y");
    $cur_tt = date("H:i:s");
    $fl_op = fopen($log, "a+");
    fwrite($fl_op, "$cur_dd $cur_tt : $login : The following data were inserted into the table $table_name :\n");
    fclose($fl_op);
}

#########################################################################
function Log_Delete($login, $table_name)
{
    $log = "log.txt";
    $cur_dd = date("M d Y");
    $cur_tt = date("H:i:s");
    $fl_op = fopen($log, "a+");
    fwrite($fl_op, "$cur_dd $cur_tt : $login : The records which matched the following were deleted :\n");
    fclose($fl_op);
}

#########################################################################
function LoginFromAuthKey($key)
{
    $db_conn = db_open();
    $res = pg_exec("SELECT login FROM login WHERE id='$key'");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    $rec = pg_fetch_array($res, 0);
    return (trim($rec[0]));
}

#########################################################################
function Email($email)
{
    if (!strchr($email, "@"))
    {
        echo "<br><br><br><center><b>Please enter a valid email</b></center>";
        exit();
    }
}

/************* DO NOT USE
Function EmpCodeFromEmpName ($id)
{
   if ($id < (-1))
      return ("NONE");
   $db_conn = db_open ();
   $res = pg_exec ("SELECT emp_code FROM emp_master WHERE emp_name='$id' ORDER BY emp_code DESC");
   if (! $res)
   {
      Error ("db_query");
      pg_close ($db_conn);
      exit;
   }
   $rec = pg_fetch_array ($res, 0);
   return (trim ($rec[0]));
}
********************/

#########################################################################
function uniqueArray($array)
{

    // Get unique elts as keys in assoc. array
    for ($i = 0, $n = count($array);$i < $n;$i++) $u_array[$array[$i]] = 1;

    // Copy keys only into another array
    reset($u_array);
    for ($i = 0, $n = count($u_array);$i < $n;$i++)
    {
        $unduplicated_array[] = key($u_array);
        next($u_array);
    }
    return $unduplicated_array;
}

#########################################################################
function ip2addr()
{
    $envval = getenv("REMOTE_ADDR");
    $octs = explode(".", $envval);
	//print_r($octs);
    $val = $octs[0];
    $val <<= 8;
    $val += $octs[1];
    $val <<= 8;
    $val += $octs[2];
    $val <<= 8;
    $val += $octs[3];
    return $val;
}

#########################################################################
function GetNumFromMon($m)
{
    switch ($m)
    {
        case "Jan":
            $mon = 1;
            return $mon;
        break;
        case "Feb":
            $mon = 2;
            return $mon;
        break;
        case "Mar":
            $mon = 3;
            return $mon;
        break;
        case "Apr":
            $mon = 4;
            return $mon;
        break;
        case "May":
            $mon = 5;
            return $mon;
        break;
        case "Jun":
            $mon = 6;
            return $mon;
        break;
        case "Jul":
            $mon = 7;
            return $mon;
        break;
        case "Aug":
            $mon = 8;
            return $mon;
        break;
        case "Sep":
            $mon = 9;
            return $mon;
        break;
        case "Oct":
            $mon = 10;
            return $mon;
        break;
        case "Nov":
            $mon = 11;
            return $mon;
        break;
        case "Dec":
            $mon = 12;
            return $mon;
        break;
    }
}

#########################################################################
function DateValidate($dd, $mm, $yy, $name)
{
    if ($dd && $mm && $yy)
    {
        if (!checkdate($mm, $dd, $yy))
        {
            echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please enter a valid $name</font></b></center>";
            exit();
        }
        else
        {
            if (is_num($dd) == 0)
            {
                echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please enter a valid day for $name</font></b></center>";
                exit();
            }
            if (is_num($mm) == 0)
            {
                echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please enter a valid month for $name</font></b></center>";
                exit();
            }
            if ($yy < 1000 || $yy > 9999)
            {
                echo "<center><b><br><br><br><font style=\"arial\" size=\"2\">Please enter a valid year for $name</font></b></center>";
                exit();
            }
        }
    }
    else
    {
        echo "<center><b><br><br><font style=\"arial\" size=\"2\">Please enter $name</font></b></center>";
        exit();
    }
}

#########################################################################
function grade($ecode, $pcode)
{
    $db_conn = db_open();
    $ret_pm = pg_exec($db_conn, "SELECT T1.grade_code FROM role T1,
                        proj_staff T2 WHERE T2.emp_code=$ecode AND
                        T2.proj_code='$pcode' AND T1.role_code=T2.role_code");
    $arr_pm = pg_fetch_array($ret_pm, 0);
    $ecode_grade = trim($arr_pm[grade_code]);

    return ($ecode_grade);
}

#########################################################################
function weekend($starttime, $duration)
{
    if ($starttime && $duration)
    {
        $org_st = $starttime;

        for ($i = 0;$i < $duration;$i++)
        {
            $daty = date(w, $starttime);
            $startdate = date("d-M-Y", $starttime);
            $starttime = $starttime + (60 * 60 * 24);

            if ($daty == 0 || $daty == 6)
            {
                $x = $x + 1;
                $duration = $duration + 1;
            }
            else
            {
                $leave = HolidayCheck($startdate);
                if ($leave == 1)
                {
                    $x = $x + 1;
                    $duration = $duration + 1;
                }
            }
        }

        $st_dd = date("d", $org_st);
        $st_mm = date("m", $org_st);
        $st_yy = date("Y", $org_st);

        $end_dt = mktime(0, 0, 0, $st_mm, $st_dd + $duration - 1, $st_yy);
        $end_dy = date(w, $end_dt);

        if ($end_dy == 0) $x = $x + 1;
        else if ($end_dy == 6) $x = $x + 2;
    }
    if (!$x) $x = 0;
    return $x;
}

#########################################################################
# Return timestamp constructed out of date value returned from SQL
# statement by exploding it into individual components.
#########################################################################
function Date2Stamp($dtarr)
{
    if ($dtarr)
    {
        $parts = explode("-", $dtarr);
        return (mktime(0, 0, 0, $parts[1], $parts[2], $parts[0]));
    }
    else return (NULL);
}

#########################################################################
# Return date in standard format (dd-Mon-yyyy) constructed out of date
# value returned from SQL statement
#########################################################################
function FormatDate($dtarr)
{
    if ($dtarr)
    {
        $parts = explode("-", $dtarr);
        return (date("d-M-Y", mktime(0, 0, 0, $parts[1], $parts[2], $parts[0])));
    }
    else return (NULL);
}

#########################################################################
# Return date components (D, M, Y) in parameters given date value
# returned from SQL statement
#########################################################################
function GetDMY($dtarr, &$d, &$m, &$y)
{
    $d = "";
    $m = "";
    $y = "";
    if ($dtarr)
    {
        $parts = explode("-", $dtarr);
        $d = $parts[2];
        $m = $parts[1];
        $y = $parts[0];
        return (1);
    }
    else return (NULL);
}

#########################################################################
# Return date in Julian date format given date value returned from
# SQL statement
#########################################################################
function GetJulianDate($dtarr)
{
    $comp = explode("-", $dtarr);
    return (gregoriantojd($comp[1], $comp[2], $comp[0]));
}

#########################################################################
# Show standard HTML footer with copyright message etc.
#########################################################################
function ShowFooter()
{
    echo "<BR><HR><BR>\n";
    echo "<FONT SIZE=-2>\n";
    echo "Generated by PCC (c) 1999-2006 Integra Micro Software Services (P) Ltd.\n";
    echo "</FONT>\n";
}

#########################################################################
#Function to compare date
#Return 1,if equal else NULL
#########################################################################
function CompareDates($date1, $date2)
{
    $date1_stamp = Date2Stamp($date1);
    $date2_stamp = Date2Stamp($date2);
    if ($date1_stamp == $date2_stamp) return (1);
    else return NULL;
}

####################################################################################################
#Function for finding no. of holidays from the a particular date to a particular duration of days
#Returns the no. of days
####################################################################################################
function weekend_days($starttime, $duration)
{
    if ($starttime && $duration)
    {
        $org_st = $starttime;

        for ($i = 0;$i < $duration;$i++)
        {
            $daty = date(w, $starttime);
            $startdate = date("d-M-Y", $starttime);
            $starttime = $starttime + (60 * 60 * 24);

            if ($daty == 0 || $daty == 6)
            {
                $x = $x + 1;
                #  $duration = $duration +1;
                
            }
            else
            {
                $leave = HolidayCheck($startdate);
                if ($leave == 1) $x = $x + 1;
            }

        }

    }
    if (!$x) $x = 0;
    return $x;
}

##########################################################################
#Function for finding the no. of days between two dates
#Returns no. of days
##########################################################################
function DiffDate($starttime, $endtime)
{

    $tk_diff = (($endtime - $starttime) / (24 * 60 * 60)) + 1;

    $end_dy = date(w, $endtime);
    $enddate = date("d-M-Y", $endttime);
    if ($end_dy == 0) $tk_diff = $tk_diff + 1;
    else if ($end_dy == 6) $tk_diff = $tk_diff + 2;
    else
    {
        $leave = HolidayCheck($enddate);
        if ($leave == 1) $tk_diff = $tk_diff + 1;
    }

    $diff_days = weekend_days($starttime, $tk_diff);

    $no_of_days = $tk_diff - $diff_days;

    return $no_of_days;
}

#########################################################################################
#Function for finding whether a given day falls on holiday
#Returns 1 if the given day falls on holiday
#########################################################################################
function HolidayCheck($holiday)
{
    $db_conn = db_open("offproj", 0);

    $result = pg_exec($db_conn, "SELECT * from holiday_list WHERE day = '$holiday'");

    if (!$result)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    $arr_holiday = pg_fetch_array($result, 0);

    if ($arr_holiday) return 1;
}

#########################################################################################
#Function to assign color to each Task
#Returns the color in numbers
#########################################################################################
function TasksColor($task_level)
{
    if ($task_level > 9) $level = substr($task_level, 1);
    else $level = $task_level;

    switch ($level)
    {
        case 1:
            $color = 111177;
        break;
        case 2:
            $color = 117711;
        break;
        case 3:
            $color = 771111;
        break;
        case 4:
            $color = 332211;
        break;
        case 5:
            $color = 117733;
        break;
        case 6:
            $color = 771133;
        break;
        case 7:
            $color = 776611;
        break;
        case 8:
            $color = 881188;
        break;
        case 9:
            $color = 338888;
        break;
        case 0:
            $color = 887755;
        break;
    }
    return $color;
}
#############################################################
#Function that returns the generated Emp Code
#returns Emp Code
############################################################
function EmpCodeGenerate($ecode)
{
    $db_proj = db_open();
    $res_emp_check = pg_exec($db_proj, "SELECT * FROM emp_code_gen");
    $arr_emp_check = pg_fetch_array($res_emp_check, 0);
    if (!$arr_emp_check)
    {
        return $code_gen = 10000000;
    }
    else
    {
        $res_emp_code = pg_exec($db_proj, "SELECT MAX(emp_code) from emp_code_gen");
        $arr_emp_code = pg_fetch_array($res_emp_code, 0);
        $code_gen = trim($arr_emp_code[max]);
        $code_gen = $code_gen + 1;
        return $code_gen;
    }
}
###############################################################
# Function to get entered Emp Code from the Emp Code generated
# returns entered Emp Code
###############################################################
function EcodeEnteredFromEcode($ecode)
{
    $db_emp = db_open();
    $result_code = pg_exec($db_emp, "SELECT emp_code_entered FROM emp_code_gen where emp_code = $ecode");
    $arr_code = pg_fetch_array($result_code, 0);
    $ecode_entered = trim($arr_code[emp_code_entered]);
    return $ecode_entered;
}

###############################################################
# Function to get Function Name from Function Code
# returns Function Name
###############################################################
function FuncNameFromFuncCode($func_code)
{
    $db_conn = db_open();
    $des_exec = pg_exec($db_conn, "select func_name from func_master where func_id = '$func_code'");
    $des_arr = pg_fetch_array($des_exec, 0);
    $fdes_desc = trim($des_arr[func_name]);
    return $fdes_desc;
}

###############################################################
# Function to get Message description from Message Code depending on the module and code
# returns Message description
###############################################################
function MessageFromMessageCode($module, $code)
{
    $db_conn = db_open();
    $table = "msg_" . $module;
    $res_message = pg_exec($db_conn, "SELECT * FROM $table WHERE message_code = '$code'");
    $arr_message = pg_fetch_array($res_message, 0);
    $message_desc = trim($arr_message[message_desc]);
    return $message_desc;
}

###############################################################
# Function to get Work Item Code from work Item Name based on projects or functions or enquiries
# returns work item code
###############################################################
function WorkItemCodeFromWorkItemName($table, $irr_workitemid)
{
    $db_conn = db_open();
    $res_wi = pg_exec($db_conn, "SELECT * FROM $table WHERE work_item_name = '$irr_workitemid'");
    $arr_wi = pg_fetch_array($res_wi, 0);
    $wi_id = trim($arr_wi[work_item_id]);
    return $wi_id;
}

###############################################################
# Function to get Grade based on Employee code
# returns grade
###############################################################
function GradeFromEmpCode($ecode)
{
    $db_conn = db_open();

    $res = pg_exec($db_conn, "SELECT grade FROM emp_master WHERE emp_code=$ecode");
    if (!$res)
    {
        Error("db_query");
        pg_close($db_conn);
        exit;
    }
    if (pg_numrows($res)) $rec = pg_fetch_array($res, 0);
    else return (0);

    return ($rec[grade]);
}

###############################################################
# Function to check if specified file can be accessed by specified user.
# Returns non-zero if permitted, 0 if not. Used for implementing ACL.
###############################################################
function AccessAllowed($ecode, $phpfile)
{
    $dbh = db_open();
    $fname = basename($phpfile);

    $res = pg_exec($dbh, "SELECT * FROM acl_emp WHERE emp_code=$ecode AND
                           access_page='$fname'");

    if (!$res)
    {
        Error("db_query");
        pg_close($dbh);
        exit;
    }
    if (pg_numrows($res)) return (1);
    else return (0);
}

###############################################################
function LogFileUpdate($module, $page_from, $query_str)
{
    $q_str = $page_from . ': ' . $query_str . "\n";
    $fp = fopen("$module.log", "a+");
    fwrite($fp, $q_str);
    fclose($fp);
}

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
        $empID = $decode_result['empId'];
        $reurn_array = array(
            'name' => $name,
            'email' => $email,
            'image' => $image,
			'prdId' =>  $prdID,
            'empID' =>  $empID
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
}

?>
