<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogViewReservation.php
    
        Main entry point to the BOG Testimonials web page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogLibrary.php");
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated
    $redirect = (isset($_SESSION['redirect'])) ? $_SESSION['redirect'] : 'BogLoginPage.php';
    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : '';   
    $firstName = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['firstName'] : 'Sorry'; 
    $propId = $_GET['propId'];

    if (!empty($userId)) {
        $tag = "View Reservations";
    } else {
        alertRedirect(3, 'BogLoginPage.php', 
                     'You must be logged in to view reservations. You will now be redirected to our Login page.');
    }
     
    // Get reservations for he current user
    $resvProfs = bogGetReservProfsByUserId($userId);

    // Check for any errors
    if (($errCode = bogGetLastErrorCode()) != 0) { 
        $err = "Failed to retrieve user profile from database, err='$errCode'<br><br>";
    } else if (count($resvProfs) == 0) {
        $err = "$firstName, There were no reservations found under your profile!";
    }

    // If any errors are encountered notify the user and bail out
    if (isset($err)) {
        alertRedirect(3, $redirect, $err);
    }

    // Build the output to display in the form
    foreach ($resvProfs as $rp) {
        $output .= "<tr>" .
                        "<td>" . $rp['CheckIn'] ."</td>" .
                        "<td>" . $rp['CheckOut'] . "</td>" .
                        "<td>" . $rp['Address'] . "</td>" .
                        "<td>" . $rp['City'] . "</td>" .
                        "<td>" . $rp['State'] . "</td>" .
                        "<td>" . $rp['Zipcode'] . "</td>" .
                   "</tr>";
    }
    
    displayPageHeader("..\cssStyles\BOG_Style_Layout_All.css", $tag);
    displayTestimonialsPage();
?>

    <!-- Banner -->
    <section id="bannerList">       
        <h2>Reservations</h2>        
    </section>
    
    <section id="banner">
        <table class="blueTable">
            <thead>
               <tr>
                    <th>CheckIn-Date</th>
                    <th>CheckOut-Date</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zipcode</th>
               </tr>
            </thead>
            <tbody>
                <?php echo $output ?>
            </tbody>
        </table>
        <br>
        <button type="button" onclick="location.href='BogUserProfile.php';return false;">Cancel</button>
    </section>

<?php 

    displayPageFooter('');
?>