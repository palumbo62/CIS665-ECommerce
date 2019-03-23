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

     $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogLoginPage.php';
     
     
     
     if (isset($_SESSION['resInfo'])) {
        $userId = $_SESSION['resInfo']['userId'];
        $propId = $_SESSION['resInfo']['propId'];
        $checkInDate = $_SESSION['resInfo']['checkIn'];
        $checkOutDate = $_SESSION['resInfo']['$checkOut'];
        $guestCnt = $_SESSION['resInfo']['$GuestCnt'];
          }
          
         //var_dump($_SESSION);
          
   
     
     
    displayPageHeader("../cssStyles/BOG_Style_Layout_All.css", $tag);
    displayRentPropertyPage();
    
    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   

    if (!empty($userId)) {
        $tag = "UserID='$userId' Rent Property - page needs work!";
    } else {
        alertRedirect(3, 'BogLoginPage.php', 
                     'Must be logged in to make reservations.<br>'
                    . 'You will now be redirected to our Login page.');
    }
    echo "userId='$userId'  propID='$propId', checkIn='$checkinDate', checkOut='$checkoutDate', guestCnt='$guestCnt'";
    $tag = "Reservation Page";
   
    
    
   /* $propId= $_GET['propId'];
    $checkinDate =(isset($_GET['CheckIn']));
    $checkoutDate = (isset($_GET['CheckOut']));
    $guestCnt = $_GET['GuestCnt'];
    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogHome.php';

// remove any potentially malicious characters
    $checkinDate = preg_replace("/[^a-zA-Z0-9\s]/", '', $checkIn);
    $checkoutDate = preg_replace("/[^a-zA-Z0-9\s]/", '', $checkOut);
    
//Call the bogAddReservProf method
    $userID = 11;
    $propId = 61;
    bogAddReservProf($propId, $userId, $checkinDate, $checkoutDate);

    // Check the result of the add operation
    if (($errCode = bogGetLastErrorCode()) != 0) {
        alertRedirect(3, 'BogRegiser.php', 
                      "Reservation profile failed to be added to BOG database, err'$errCode'");
    } elseif (($resvId = bogGetLastInsertId()) == -1) {
        alertRedirect(3, 'BogRegiser.php', 
                      "Reservation profile failed to be added to database. Please try again!");
    } else {
        // Successful registration - don't need this data saved anymore 
        unset($_SESSION['resvInfo']);

        //typically not required; ensures that the session data is store
        session_write_close(); 

        // Redirect to the login page
        alertRedirect(3, 'BogHome.php', 
                      "Thank you.  Your reservation is confirmed. ConfID='$resvId'<br>"
                    .  "You will now be redirected to our Home page.'");
    }*/

//    $displayListings = bogGetAllPropProf();

//var_dump($checkInDate);





//if (count($checkinDate === 1 && $checkoutDate ===1))
//{
//   extract($checkinDate[0]&& $checkoutDate[0]);
//   
//   alertRedirect(2, 'BogHome.php', 'Reservation Successful!');
//}
//else
//{
//     alertRedirect(3, 'BogListingsPage.php', 
//                         'Dates Unavailable.  Please try a new listing.');
//    
//// prepare the output using heredoc syntax
//
//}
//$output .= <<<ABC
//<p style="text-align: center">
//    <a href="BogHome.php">[Back to Home Page]</a>
//</p></section>
//ABC;
//
//// display the output
//
//echo $output;
//

?>

    <!-- Banner -->
    <section id="bannerList">       
        <h2>Reservation</h2> 
    </section> 
    
    
    <section id="banner">
        <form action="BogRentalAction.php" method='post'>
            <div class="containerReservation">
               
                <br><br>
                <!----- Check In Date ------------------------------------------------------->
                <label for="CheckIn" > Check In Date: </label>
                <input type="text" name="CheckIn" placeholder="XX/XX/XXXX"  
                       maxlength="10" pattern="^[0-9]{2}/[0-9]{2}/[0-9]{4}$" 
                       value="<?php echo $checkInDate?>">
                <br><br>
                <!----- Check Out Date ------------------------------------------------------->
                <label for="CheckOut" > Check Out Date: </label>
                <input type="text" name="CheckOut" placeholder="XX/XX/XXXX" 
                       maxlength="10" pattern="^[0-9]{2}/[0-9]{2}/[0-9]{4}$"
                       value="<?php echo $checkOutDateDate?>">
                <br><br>
                <!----- Number of Guests ------------------------------------------------------->
                <label for="GuestCnt"> Number of Guests: </label>
                <input type="number" name="GuestCnt" minValue="0" placeholder="0" 
                       maxlength="100">                         
            </div>
           
            <div id="button">
                <button name="reserveSubmit" type="submit" value="reserve">Reserve</button>
                <button name="reserveReset" type="reset" value="reset">Reset</button>
                <button type="button" onclick="location.href='BogHome.php';return false;">Cancel</button>
            </div>
        </form>
    </section>

<?php
    displayPageFooter('');
?>