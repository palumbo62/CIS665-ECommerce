<?php
/* 
    Purpose: Demo8 - Securing Applications
    Author: LV
    Date: February 2019
    Uses: siteCommon1.php
 */

// this method call should be placed at the start (top) of every php file that uses session variables

session_start();

require_once ("../siteCommon1.php");

// call the displayPageHeader method in siteCommon1.php

displayPageHeader("Home Page");

// the session array element "userInfo" will be set (see d8loginform.php) if the user has been authenticated

$logFName = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['firstname'] : "";   

?>

<section>
<?php
   // if the user is authenticated, customize greeting"
if (!empty($logFName))
    {
        echo "<p>Welcome back to Rockwell Studios, $logFName!</p>";
    }
    else
    {
        echo "<p>Hello, and welcome to the home of Rockwell Studios on the web!</p>";
    }
?>
   <p>You can find information about our classic and contemporary films, browse and buy from our extensive collection of movie memorabilia, and join our exclusive Ram Club to receive special offers and invitations. </p>
   <p>We hope you enjoy your visit. Have fun!</p>
</section>

<?php
// call the displayPageFooter method in siteCommon1.php

displayPageFooter();
?>