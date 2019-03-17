<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogHome.php
    
        Main entry point to the BOG website
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userName = (isset($_SESSION['userInfo'])) ? $_SESSION['userInfo']['firstName'] : "";   

    if (!empty($userName)) {
        $tag = "Welcome back to BeOurGuest, $userName!";
    } else {
        $tag = "Hello, and welcome to BeOurGuest!";
    }

    displayPageHeader("../cssStyles/homeCSS.css", $tag);
    displayHomePage();
?>

    <section id="banner">
        <!-- Load icon library -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <h2>BeOurGuest</h2>

        <p>
            We have a ride range of vacation homes
            from Condos, Cabins, Family homes, and even beach houses
        </p>
        <br />
        <p>Book your perfect vacation home today! </p>
        <!-- The form -->

        <div>
        <form class="example" action="action_page.php">

            <input type="text" placeholder="Search by property type, City, State or Zipcode" name="search">
            <button name="propSearch" type="submit" value="search"><i class="fa fa-search"></i></button>
        </form>
        </div>
    </section>

    <!-- Banner -->
    <section id="secondbanner">
        <h2>Most Popular Rentals</h2>

        <div class="row">
            <a href="RentalSelection.html">
                <div class="column" style="background-image: url(../images/dark_tint.png), url(../images/cabin1.jpg)">
                    <h3>Luxury Cabin - Aspen, CO</h3>
                    <p>5 Bedroom &bull; $140/night</p>
                </div>
            </a>

            <a href="RentalSelection.html">
                <div class="column" style="background-image: url(../images/dark_tint.png), url(../images/farmhouse.jpg)">
                    <h3>Column 2</h3>
                    <p>Some text..</p>
                </div>
            </a>
            <a href="RentalSelection.html">
                <div class="column" style="background-image: url(../images/dark_tint.png), url(../images/condo.jpg)">
                    <h3>Column 3</h3>
                    <p>Some text..</p>
                </div>
            </a>
            <a href="RentalSelection.html">
                <div class="column" style="background-image: url(../images/dark_tint.png), url(../images/cabin2.JPG)">
                    <h3>Column 4</h3>
                    <p>Some text..</p>
                </div>
            </a>
        </div>
    </section>

<?php
    displayPageFooter('');
?>