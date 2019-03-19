<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogDelProperty.php
    
        Main entry point to the BOG Admin delete property management page
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

        echo '<h2>Must be Admin to delete properties.  You will now be redirected to our Home page.</h2>';
        die();
    }
    
    $tag = "UserID='$userId' Delete property, add support Actions";

    displayPageHeader("../cssStyles/listingCSS.css", $tag);
    displayDelPropertyPage();
?>
    <!-- Banner -->
    <section id="banner">
        <h2>All Current Listings</h2>
        <!-- Load icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- The form -->
        <form class="example" action="action_page.php">

            <input type="text" placeholder="Search by location or home type.." name="search">
            <button type="submit"><i class="fa fa-search"></i></button>

        </form>
    </section>

    <!-- Banner -->
    <section id="secondbanner">
        <form action="/action_page.php">

            <!---Vacation Listings-->
            <ul class="article-list-vertical">
                <li>
                    <img src="../images/cabin1.jpg" />
                    <div>
                        <h2><a href="RentalSelection.html">Title $title</a></h2>
                        <p>Description: Input variables from php files. This should 
                            be programmed as a loop so each rental home retireved 
                            will form into a list</p><br />
                        <p>$variable/per night</p>
                        <br>
                        <button name="propDel" type="submit" value="delete">Delete</button>
                        <button name="propReset" type="reset" value="reset">Reset</button>
                        <button type="button" onclick="location.href='BogHome.php';return false;">Cancel</button>
                    </div>
                </li>
            </ul>
        </form>
    </section>

<?php
    displayPageFooter('');
?>