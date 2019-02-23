<?php
/*
    Purpose: Demo5 - Validation
    Author: LV
    Date: February 2019
    Action: d5process2.php
 */
require_once ("../siteCommon.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Client-side Validation with JavaScript");

echo '<section>';
?>

<!-- include the javascript library -->

<script src="d5jsLibrary.js" type="text/javascript"></script>

<!-- when the form is submitted, the checkForm (javascript) method is called;

"this" is a javascript object reference that refers to the currently selected object;

below, "this" is a reference to the form itself, which is passed as the argument -->

<form name ="loginForm" id="loginForm" action="d5process2.php"
      method = "post" onsubmit="return checkForm(this)">
   <label for="loginID">Username:</label>
   <input type="text" name="loginID" id ="loginID" maxlength="5" onfocus="this.select()" />
   <label for="loginPassword">Password:</label> 
   <input type="password" name="loginPassword" id="loginPassword" maxlength="20" onfocus="this.select()" />
      <p>
         <input type="submit" value="Login" name="search" />
      </p>
</form>
</section>
 
<?php
// call the displayPageFooter method in siteCommon.php
displayPageFooter();
?>
