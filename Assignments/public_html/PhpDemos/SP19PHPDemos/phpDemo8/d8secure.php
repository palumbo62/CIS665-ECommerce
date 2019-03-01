<?php
/*
    Purpose: Securing Applications
    Author: LV
    Date: February 2019
    Uses: siteCommon1.php, d8logincheck.php
 */

session_start();

// to secure a page, include a php page (for this demo, that page is "d8logincheck.php") 
// that contains the code to check whether the user has been authenticated

require_once ("d8logincheck.php");

require_once ("../siteCommon1.php");

// call the displayPageHeader method in siteCommon1.php

displayPageHeader("You are viewing this Secure Page because you have been authenticated");

?>

<!-- customize the greeting by accessing the user's first name that is stored
 in the session array element, "userInfo" (see d8loginform.php) -->

<section>

   <h2>Secure Page - Welcome back <?php echo $_SESSION['userInfo']['firstname'] ?> </h2>

</section>
    
<?php
// call the displayPageFooter method in siteCommon1.php

displayPageFooter();
?>
