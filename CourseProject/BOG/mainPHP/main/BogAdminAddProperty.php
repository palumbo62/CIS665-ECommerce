<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogAdminAddProperty.php
    
        Main entry point to the BOG Admin add property management page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   
    $roleType = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['roleType'] : "";   
    
    // Must be ADMIN to manage property
    if (($roleType != 1) || empty($userId)) {
        header('Refresh: 3; URL=BogHome.php');

        echo '<h2>Must be Admin to add properties.  You will now be redirected to our Home page.</h2>';
        die();
    }
    
    $tag = "UserID='$userId' Add new property";

    displayPageHeader("../cssStyles/registerCSS.css", $tag);
    displayAdminAddPropertyPage();
?>

    <!-- User profile management  -->
    <form action="BogAdminAddPropertyAction.php">
        <div class="container">

            <h1>Account Information</h1>
            <p>
                Full Name: $fname $lname <br />
                Email:<br />
                Mobile Number:<br />
                Address: $street $city $state $zipcode

            </p>

            <p>Modify and update should redirect to a .php file</p>
            <br>
            <button name="propAdd" type="submit" value="add">Add</button>
            <button name="propReset" type="reset" value="reset">Reset</button>
            <button type="button" onclick="location.href='BogHome.php';return false;">Cancel</button>
        </div>
    </form>

<?php
    displayPageFooter('');
?>