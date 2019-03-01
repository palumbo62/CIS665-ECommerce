<?php
/*
    Purpose: Demo7 - Cookies
    Author: LV
    Date: February 2019
 */

require_once ("../siteCommon.php");

displayPageHeader("View Cookies");

// if there are cookies; display them

if (!empty($_COOKIE))
{
    echo '<pre style="font-size:xx-large">';
    print_r($_COOKIE);
    echo '</pre>';
}
else
{
    echo '<h2> No cookies are set</h2>';
}
?>

<h2><a href="d7cookies.php">Back to main cookie page</a></h2>

<?php
displayPageFooter();
?>

