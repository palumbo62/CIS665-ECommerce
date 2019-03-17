<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogAddReserv.php
    
        PHP based web page used to test adding a new reservation profile to the
        database.
*/
    require_once ("testSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Test testBogAddReserv');

    echo '<section>';
?>

<script src="..\javaScript\Bog-jsLibrary.js" type="text/javascript"></script>

<form name ="addReservation" id="addForm" action="testBogAddReservResults.php" 
      method="post" onsubmit="return checkForm(this)">

    <label for="propId">Property ID:</label>   
    <input type="number" name="propId" id="propId" maxlength="5" autofocus required 
           min="1" max="99999"
           title="Enter a Property ID: "/>

    <label for="userId">User ID:</label>   
    <input type="number" name="userId" id="userId" maxlength="5" autofocus required 
           min="1" max="99999"
           title="Enter a User ID"/>
    
    <label for="checkinDate">CheckIn Date:</label>   
    <input type="date" name="checkinDate" id="checkinDate" 
           autofocus required 
           title="Enter Check-in Date" />
    
    <label for="checkOutDate">CheckOut Date:</label>   
    <input type="date" name="checkoutDate" id="checkoutDate" 
           autofocus required 
           title="Enter Check-out Date" />
    <p>
        <input type="submit" value="Make Reservation" />
    </p>        
</form>

<?php
    displayPageFooter('BOG');
?>