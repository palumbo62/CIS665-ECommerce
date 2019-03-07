<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogLogin.php
    
        PHP based web page used to test logging into the BOG website by
        email address and password.

*/

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - testBogLogin()');

    echo '<section>';
?>

    <script src="..\javaScript\Bog-jsLibrary.js" type="text/javascript"></script>

    <form action="testLoginResults.php" name="loginForm" id="loginForm" method="post">
        <label for="emailAddr">Email: </label>
        <input type="text" name="emailAddr" id ="emailAddr" 
            maxlength="50" autofocus="autofocus" required="required" 
            pattern="^[\w@\.-]+$" title="Enter valid email address" />

        <label for="password">Password:</label> 
        <input type="password" name="password" id="userpassword" 
            maxlength="20" required="required" 
            pattern="^[\w@\.-]+$" title="Enter password" />

        <p>
           <input type="submit" value="Login" name="login" 
                  style="width: 150px; margin: 0 auto;" /> <br />
        </p>
    </form>

<?php

    // call the displayPageFooter method in siteCommon.php

    displayPageFooter('BOG');
?>