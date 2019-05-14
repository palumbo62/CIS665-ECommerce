<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogGetReservByUserId.php
    
        PHP based web page used to test reservations by user id

*/
    require_once ("testSiteCommon.php");
    require_once ("bogSql.php");

    displayPageHeader('BOG - testBogGetReservByUserId()');

    echo '<section>';
?>

    <script src="..\javaScript\Bog-jsLibrary.js" type="text/javascript"></script>

    <form action="testBogGetReservProfByUserIdResults.php" name="reservByUserIdForm" id="reservByUserIdForm" method="post">
        <label for="userid">User ID: </label>

        <input type="number" name="userid" id="userid" required 
           min="1" max="999" style="width: 13"
           title="Enter a UserID"/>

        <p>
           <input type="submit" value="Submit" name="submit" 
                  style="width: 150px; margin: 0 auto;" /> <br />
        </p>
    </form>

<?php

    // call the displayPageFooter method in siteCommon.php

    displayPageFooter('BOG');
?>