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

    require_once ("..\phpCommon\BogLibrary.php");
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated
    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogLoginPage.php';
    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : '';   
    $propId = $_GET['propId'];

    
    if (!empty($userId)) {
        $tag = "Reservation Page - Property ID '$propId'";

        if (empty($propId)) {
            alertRedirect(3, 'BogHome.php', 
                    'OOPS!  Something went wrong - contact the System Administrator!');
        }
    } else {
            alertRedirect(3, 'BogLoginPage.php', 
                    'You must be logged in to make reservations. You will now be redirected to our Login page.');
    }
     
    if (isset($_SESSION['resInfo'])) {
        $userId = $_SESSION['resInfo']['userId'];
        $propId = $_SESSION['resInfo']['propId'];
        $checkInDate = $_SESSION['resInfo']['checkInDate'];
        $checkOutDate = $_SESSION['resInfo']['checkOutDate'];
        $guestCnt = $_SESSION['resInfo']['guestCnt'];
        
        // Successful reservation - don't need this data saved anymore 
        unset($_SESSION['resInfo']);
    }

    // Minimum reservation date
    $minDate = date('Y-m-d'); 

//echo "minDate='$minDate' Curr Date='$currDate'  CurrDate2='$currDate2' DRV='$dateRangeValue'"; die();
        
    displayPageHeader("../cssStyles/BOG_Style_Layout_All.css", $tag);
    displayRentPropertyPage();
?>

</head>
    <!-- Banner -->
    <section id="bannerList">       
        <h2>Reservation Page</h2> 
    </section>
    
    <!-- Banner -->
    <section id="banner">
        <form action="BogRentalAction.php" method='post'>
            <div class="containerReserve">
                <!----- Check In Date ------------------------------------------------------->
                <label for="checkInDate" >CheckIn Date:</label>   
                <input type="date" name="checkInDate" id="checkInDate" 
                       autofocus required 
                       value="<?php echo $minDate ?>"
                       min="<?php echo $minDate ?>"
                       title="Enter Check-in Date" />
                
                <br />
                <br />

                <!----- Check Out Date ------------------------------------------------------->
                <label for="checkOutDate">CheckOut Date:</label>   
                <input type="date" name="checkOutDate" id="checkOutDate" 
                       autofocus required 
                       value="<?php echo $minDate ?>"
                       min="<?php echo $minDate ?>"
                       title="Enter Check-out Date" />
                <br />
                <br />

                <!----- Number of Guests ----------------------------------------------------->
                <label for="guestCnt"> Number of Guests: </label>
                <input type="number" name="guestCnt" id="guestCnt" maxlength="4" 
                       value="1" min="1" max="9999"
                       title="Enter number of guests "/>
                <br>
                <br>
                
                <input type="hidden" name="propId" value="<?php echo $propId ?>" />
                
                <button name="reserveSubmit" type="submit" value="reserve">Reserve</button>
                <button name="reserveReset" type="reset" value="reset">Reset</button>
                <button type="button" onclick="location.href='BogListings.php';return false;">Cancel</button>
            </div>         
           
        </form>
    </section>

<?php
    displayPageFooter('');
?>