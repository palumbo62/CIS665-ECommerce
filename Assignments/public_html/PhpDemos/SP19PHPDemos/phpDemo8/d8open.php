<?php
/* 
    Purpose: Securing Applications
    Author: LV
    Date: February 2019
    Uses: siteCommon1.php
 */
session_start();

require_once ("../siteCommon1.php");

// call the displayPageHeader method in siteCommon1.php

displayPageHeader("This page is open to all visitors");
?>
<section>
   
   <h2>Open Page - Don't have to be logged in </h2>
      
</section>

<?php
// call the displayPageFooter method in siteCommon1.php

displayPageFooter();
?>