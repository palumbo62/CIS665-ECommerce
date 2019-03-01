<?php
/* 
    Purpose: Securing Applications
    Author: LV
    Date: February 2019
    Uses: siteCommon1.php, d8sql.php
 */

session_start();

require_once ("d8Sql.php");

// Set local variables to $_POST array elements (userlogin and userpassword) or empty strings

$userLogin = (isset($_POST['userlogin'])) ? trim($_POST['userlogin']) : '';
$userPassword = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';
   
/*  $_REQUEST is an associative array that contains the contents of $_GET, $_POST, and $COOKIE
    $_REQUEST is used because the redirect file name could be received by this script
    either through the URL ($_GET) or as a form varaiable ($_POST).
    The first time this script is accessed the redirect file name
    will be in the URL (see d8logincheck.php).  On subsequent accesses, the redirect file name
    will be passed as a form variable (see below, where $redirect is used to set a hidden field)
 */

$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'd8home.php';

// if the form was submitted

if (isset($_POST['login']))
{
    //Call getUser method to check credentials

    $userList = getUser($userLogin, $userPassword);

    if (count($userList)==1) //If credentials check out
    {
        extract($userList[0]);

        // assign user info to an array

        $userInfo = array('contactpk'=>$contactpk, 'firstname'=>$firstname, 'userrole'=>$userrolename);

        // assign the array to a session array element

        $_SESSION['userInfo'] = $userInfo;
        session_write_close(); //typically not required; ensures that the session data is stored

        // redirect the user

        header('location:' . $redirect);
        die();
    }

    else // Otherwise, assign error message to $error
    {
        $error = 'Invalid login credentials<br />Please try again';
    }
}

// display form

require_once ("../siteCommon1.php");

// call the displayPageHeader method in siteCommon1.php

displayPageHeader("Login Form");
echo "<section>";
// if error variable was set, display it

if (isset($error))
{
    echo '<div id="error">' . $error . '</div>';
}
?>

<form action="d8loginform.php" name="loginForm" id="loginForm" method="post">

    <!-- Store the redirect file name in a hidden field  -->

   <input type="hidden" name ="redirect" value ="<?php echo $redirect ?>" />
   <label for="userlogin">Username:</label>
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo $userLogin; ?>" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="User Name has invalid characters" />
   <label for="userpassword">Password:</label> 
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="Password has invalid characters" />
      <p>
         <input type="submit" value="Login" name="login" /> <br />
         New customer?  <a href="d8register.php">Register Here</a>
      </p>
</form>
</section>
<?php
// call the displayPageFooter method in siteCommon1.php

displayPageFooter();
?>
