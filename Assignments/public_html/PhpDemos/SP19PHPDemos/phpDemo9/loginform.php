<?php
/*
    Purpose: Online Store
    Author: LV
    Date: March 2019
*/

session_start();

require_once("shopsql.php");

// Set local variables to $_POST array elements (userlogin and userpassword) or empty strings

$userLogin = (isset($_POST['userlogin'])) ? trim($_POST['userlogin']) : '';
$userPassword = (isset($_POST['userpassword'])) ? trim($_POST['userpassword']) : '';
   
$redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'shopsearch.php';

// if the form was submitted

if (isset($_POST['login']))
{
    //Call getUser method to check credentials

    $userList = getUser($userLogin, $userPassword);

    if (count($userList)===1) //If credentials check out
    {
        extract($userList[0]);

        // assign user info to an array

        $userInfo = array('contactpk'=>$contactpk, 'firstname'=>$firstname, 'userrole'=>$userrolename);

        // assign the array to a session element

        $_SESSION['userInfo'] = $userInfo;

        // redirect the user

        header('location:' . $redirect);
        die();
    }

    else // Otherwise, display error message
    {
        $error = 'Invalid login credentials<br />Please try again.';
    }
}

// display form

require_once ("../siteCommon.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Login Form");
echo "<section>";
// if error variable was set, display it

if (isset($error))
{
    echo '<div id="error">' . $error . '</div>';
}
?>

<form action="loginform.php" name="loginform" id="loginform" method="post">

    <input type="hidden" name ="redirect" value ="<?php echo $redirect ?>" />

    <label for="userlogin">Username:</label>
   <input type="text" name="userlogin" id ="userlogin" value="<?php echo $userLogin; ?>" maxlength="10" autofocus="autofocus" required="required" pattern="^[\w@\.-]+$" title="User Name has invalid characters"/>
   <label for="userpassword">Password:</label> 
   <input type="password" name="userpassword" id="userpassword" value="<?php echo $userPassword; ?>" maxlength="10" required="required" pattern="^[\w@\.-]+$" title="User Name has invalid characters" />
      <p>
         <input type="submit" value="Login" name="login" /> <br />
      </p>

</form>
</section>
<?php
// call the displayPageFooter method in siteCommon.php

displayPageFooter();
?>

