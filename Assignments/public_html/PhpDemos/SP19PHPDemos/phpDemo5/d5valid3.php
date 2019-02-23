<?php
/*
    Purpose: Demo5 - Validation
    Author: LV
    Date: February 2019
    Action: d5process3.php
 */
require_once ("../siteCommon.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("HTML 5 Validation");

echo '<section>';
?>

<form name ="loginForm" id="loginForm" action="d5process3.php"
      method = "post">
   <label for="loginID">Username:</label>
   <input type="text" name="loginID" id ="loginID" maxlength="5" autofocus="autofocus" required pattern="^\d{5}$" title="Please enter a valid Login ID"/>
   <label for="loginPassword">Password:</label> 
   <input type="password" name="loginPassword" id="loginPassword" maxlength="20" required />
      <p>
         <input type="submit" value="Login" name="search" />
      </p>
</form>
</section>
 
<?php
// call the displayPageFooter method in siteCommon.php
displayPageFooter();
?>
