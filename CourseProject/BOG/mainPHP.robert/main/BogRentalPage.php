<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogRentalPage.php
    
        Main entry point to the BOG Rental web page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   

    if (!empty($userId)) {
        $tag = "UserID='$userId' Rent Property - page needs work!";
    } else {
        $tag = "UserID NOT Set";
    }

    displayPageHeader("../cssStyles/listingCSS.css", $tag);
    displayRentPropertyPage();
?>

    <!-- Banner -->
    <section id="secondbanner">
        <p>Property: $Variable</p>
        <p>Address: $Variable</p>
        <p>DailyPrice: $Variable</p>
        <p>Bathroom #: $Variable</p>
        <p>Bedroom #: $Variable</p>
        <p>Square Footage: $Variable</p>
        <p>Max Guests: $Variable</p>
        <p>Picture: $Variable</p>
        <br />
    </section>

    <!-- Banner -->
    <section id="banner">
        <form action="BogRegisterAction.php" method='post'>
            <div class="container">

                <h2>Reserve Rental</h2>
                <br>
                <button name="reserveSubmit" type="submit" value="reserve">Reserve</button>
                <button name="reserveReset" type="reset" value="reset">Reset</button>
                <button type="button" onclick="location.href='BogHome.php';return false;">Cancel</button>
            </div>
        </form>
    </section>

<?php
    displayPageFooter('');
?>