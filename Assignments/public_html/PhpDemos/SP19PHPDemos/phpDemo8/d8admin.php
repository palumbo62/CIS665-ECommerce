<?php
/*
    Purpose: Securing Applications
    Author: LV
    Date: February 2019
    Uses: siteCommon1.php, d8logincheck.php
 */

session_start();

require_once ("d8logincheck.php");

// this page is only for admins, so an additional check is performed 

// if the user is not an admin, redirect to the home page

if ($_SESSION['userInfo']['userrole'] != 'Admin')
{
    header('refresh: 2; URL=d8home.php');
    echo '<h2>Sorry, you are not authorized to view this page.</h2>';
    die();
}

require_once ("../siteCommon1.php");

// call the displayPageHeader method in siteCommon1.php

displayPageHeader("You are viewing this Admin Page because you have been authenticated and are authorized");

?>
<section>
   <h2>Admin Page - Welcome back <?php echo $_SESSION['userInfo']['firstname'] ?> </h2>
</section>

<?php
// call the displayPageFooter method in siteCommon1.php

displayPageFooter();
?>