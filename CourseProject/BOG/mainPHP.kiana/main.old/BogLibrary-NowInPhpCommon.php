<?php
/*
Purpose: Demo1 - User-built Functions
Author: LV
Date: January 2017
*/

function displayDate ()
{
    return 'Today\'s date is ' . date('F j, Y, g:i A');
}

function alertMessage($msg) {
    echo '<div id="error">' . $msg . '</div><br><br>';
//    readline("Press any key to continue");
//    echo "<script  type=\"text/javascript\">alert($msg)</script>";
}

function getButtonValue($btnName) {
    echo "<script>document.getElementById('$btnName').value)</script>";
}

?>

<!--<script type="text/javascript">
function alertMessage(msg) {
  alert(msg);
}

function getButtonValue(btnName) {
  document.getElementById(btnName).value);
}
</script>-->
