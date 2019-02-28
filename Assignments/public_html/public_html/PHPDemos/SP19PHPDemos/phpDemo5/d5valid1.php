<?php
/*
    Purpose: Demo5 - Validation
    Author: LV
    Date: February 2019
    Action: d5process1.php
 */
require_once ("../siteCommon.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Server-side Validation");

echo '<section>';

// if the URL parameter (error) is set and is not empty, then display its contents

// the URL parameter (error) will be set, if the user is redirected to this page from the "action" page

if (isset($_GET['error']) && $_GET['error'] != '')
{
    echo '<div id="error">' . $_GET['error'] . '</div>';
}
?>

<form name ="loginForm" id="loginForm" action="d5process1.php" method = "post">
   <label for="loginID">Username:</label>
   <input type="text" name="loginID" id ="loginID" maxlength="5" />
   <label for="loginPassword">Password:</label> 
   <input type="password" name="loginPassword" id="loginPassword" maxlength="20" />
      <p>
         <input type="submit" value="Login" name="search" />
      </p>
</form>
</section>
<?php
// call the displayPageFooter method in siteCommon.php
displayPageFooter();
?>
