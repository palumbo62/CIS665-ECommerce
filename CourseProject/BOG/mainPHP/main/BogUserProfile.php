<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogUserProfile.php
    
        Main entry point to the BOG user profile management page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   

    if (!empty($userId)) {
        $tag = "UserID='$userId' Add update profile";
    } else {
        $tag = "UserID NOT Set";
    }

    displayPageHeader("..\cssStyles\accountCSS.css", $tag);
    displayUserProfilePage();
?>

    <!-- User profile management  -->
    <form action="BogUserProfileUpdateAction.php">
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
            <button name="profModify" type="submit" value="modify">Update</button>
            <button name="profReset" type="reset" value="reset">Reset</button>
            <button type="button" onclick="location.href='BogHome.php';return false;">Cancel</button>
        </div>
    </form>

<?php
    displayPageFooter('');
?>