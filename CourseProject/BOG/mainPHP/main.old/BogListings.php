<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogListings.php
    
        Main entry point to the BOG Listings web page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   

    if (!empty($userId)) {
        $tag = "UserID='$userId' Search / Rent listing";
    } else {
        $tag = "UserID NOT Set";
    }

    displayPageHeader("..\cssStyles\listingCSS.css", $tag);
    displayListingsPage();
?>

    <!-- Banner -->
    <section id="banner">
        <h2>Available Rentals</h2>
        <!-- Load icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- The form -->
        <form class="example" action="action_page.php">
            <input type="text" placeholder="Search by property type, City, State or Zipcode" name="search">
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
                    <!--<a style="background-image: url(../images/sands-of-life.jpg)"></a>-->

                    <h2><a href="RentalSelection.html">Variable Title form .Php</a></h2><br />
                    <p>Description: Input variables from php files. This should be programmed as a loop 
                        so each rental home retireved will form into a list</p><br />
                    <p>$variable/per night</p>
                    
                    <button type="submit" onclick="location.href='reservation_User_User.html'">Reserve</button>
                    <button type="button" onclick="location.href='BogHome.php';return false;">Cancel</button>
                </li>
            </ul>      
        </form>
    </section>

<?php
    displayPageFooter('');
?>