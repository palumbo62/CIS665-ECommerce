<?php
/* 
    Purpose: Demo10 - Complete Application
    Author: LV
    Date: March 2019
    Uses: siteCommon2.php
 */

// this method call should be placed at the start (top) of every php file that uses session variables

session_start();

require_once ("../siteCommon2.php");

// call the displayPageHeader method in siteCommon2.php

displayPageHeader("Home Page");

// the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

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
        echo "<p>Hello, and welcome to Rockwell Studios!</p>";
    }
?>
   <p>You can search and find information about our classic and contemporary films, and  read reviews provided by our members.  Become a member today, and add your own reviews. We know you are a better judge of our films than those snooty "critics" at the Collegian. </p>
   <p>Enjoy your visit. Have fun!</p>
   
</section>

<?php
// call the displayPageFooter method in siteCommon2.php

displayPageFooter();
?>