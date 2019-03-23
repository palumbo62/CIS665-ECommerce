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
        $tag = "Listing Page - Property ID '$propId";

        if (empty($propId)) {
            alertRedirect(3, 'BogLoginPage.php', 
                      'OOPS!  Something went wrong - contact the System Administrator!');
        }
    } else {
            alertRedirect(3, 'BogLoginPage.php', 
                     'You must be logged in to make reservations. You will now be redirected to our Login page.');
    }
     
    if (isset($_SESSION['resInfo'])) {
        $userId = $_SESSION['resInfo']['userId'];
        $propId = $_SESSION['resInfo']['propId'];
        $checkInDate = $_SESSION['resInfo']['checkIn'];
        $checkOutDate = $_SESSION['resInfo']['$checkOut'];
        $guestCnt = $_SESSION['resInfo']['$GuestCnt'];
    }

    displayPageHeader("../cssStyles/BOG_Style_Layout_All.css", $tag);
    displayRentPropertyPage();
?>

<head>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
});
</script>
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
                <label for="CheckIn" > Check In Date: </label>
                <input type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
                
<!--                <input type="text" name="CheckIn" placeholder="XX/XX/XXXX"  
                       maxlength="10" pattern="^[0-9]{2}/[0-9]{2}/[0-9]{4}$" 
                       value="php echo $checkInDate?>">-->
                <br><br>
                <!----- Check Out Date ------------------------------------------------------->
<!--                <label for="CheckOut" > Check Out Date: </label>
                <input type="text" id="datepicker">
                
                name="CheckOut" placeholder="XX/XX/XXXX" 
                       maxlength="10" pattern="^[0-9]{2}/[0-9]{2}/[0-9]{4}$">-->
<!--                
                <br><br>
                <!----- Number of Guests ------------------------------------------------------->
                <label for="GuestCnt"> Number of Guests: </label>
                <input type="number" name="GuestCnt" minValue="0" placeholder="0" 
                       maxlength="100"><br />
                <br />
                
                <button name="reserveSubmit" type="submit" value="reserve">Reserve</button>
                <button name="reserveReset" type="reset" value="reset">Reset</button>
                <button type="button" onclick="location.href='BogListings.php';return false;">Cancel</button>
            </div>         
           
        </form>
    </section>

<?php
    displayPageFooter('');
?>