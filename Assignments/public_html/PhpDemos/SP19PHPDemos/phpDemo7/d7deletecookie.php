<?php
/* 
    Purpose: Demo7 - Cookies
    Author: LV
    Date: February 2019
 */

require_once ("../siteCommon.php");

displayPageHeader("Delete Cookies");

$expire = time()-1000;

setcookie('lastsearch', null, $expire);

setcookie('lastmaxrows', null, $expire);

header('Refresh: 5; URL=d7cookies.php');

?>

<h2>Deleting cookies...</h2>
<h3>You will be redirected to the cookie example page in 5 seconds.</h3>
<h3>If your browser does not redirect you automatically,
    <a href="d7cookies.php">Click here</a>.</h3>

<?php
displayPageFooter();
?>
