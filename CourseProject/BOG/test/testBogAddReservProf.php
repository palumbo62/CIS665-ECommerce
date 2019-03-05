<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogAddReservProf.php
    
        PHP based web page used to add a reservation to the BOG database.
 */
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Test testBogAddReservProf');

    echo '<section>';

    // Call the bogAddReservation method
    $propId = $_POST['propId'];
    $userId = $_POST['userId'];
    $checkin = $_POST['checkinDate'];
    $checkOut = $_POST['checkoutDate'];
    
    bogAddReservProf($propId,$userId,$checkin,$checkOut);
    
    if (($errCode = bogGetLastErrorCode()) != 0) {
        echo "Reservation profile FAILED to be added to BOG database, err='$errCode'";
    } else {
        if (($propId = bogGetLastInsertId()) == -1) {
            echo "Reservation profile failed to be added to database!<br><br>";
        } else {
            //$propProf = bogGet
            displayPageHeader("Reservation Added: PropId=$propId  UserId=$userId  CheckIn=$checkin  CheckOut=$checkOut");
        }
    }
?>

<p style="text-align: center">
    <a href="testBogMakeReserv.php">[Make another reservation]</a>
</p>

<?php
displayPageFooter();
?>
