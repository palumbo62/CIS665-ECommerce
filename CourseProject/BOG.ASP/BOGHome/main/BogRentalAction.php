<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogRentalAction.php
    
        
*/ 
    session_start();

    require_once ("..\sqlCommon\bogSql.php");
    require_once ("..\phpCommon\BogLibrary.php");
    
    // Should have only made it here if Registration was 'submitted'
    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogLoginPage.php';
    $reserve = $_POST['reserveSubmit'];
    $currDate = date('Y-m-d'); 
    
//    echo "REDIRECT='$redirect'  regSubmit='$reserve'<br>"; die();
    if (isset($reserve)) {
        // Set local variables from $_POST array elements 
        $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   
        $propId = $_POST['propId']; 
        $checkInDate = $_POST['checkInDate'];        
        $checkOutDate = $_POST['checkOutDate']; 
        $guestCnt = $_POST['guestCnt'];        

        if (empty($userId)) {
            alertRedirect(3, 'BogLoginPage.php', 
                     'Must be logged in to make reservations.<br>'
                    . 'You will now be redirected to our Login page.');
        };

        // Save the reservation information to the session

        $resInfo = array('userId'=>$userId, 'propId'=>$propId, 
                        'checkInDate'=>$checkInDate, 'checkOutDate'=>$checkOutDate, 
                        'guestCnt'=>$guestCnt);

        // Ensure checkout date is past the checkin date
        if ($checkOutDate <= $checkInDate) {
            alertRedirect(5, "BogRentalPage.php?propId=$propId", 
                        "Check out date must be at least one day after check in date.<br>"
                    . "Please try again with an alternate date range.");          
        } elseif (($checkInDate < $currDate) || ($checkOutDate < $currDate)) {
            alertRedirect(5, "BogRentalPage.php?propId=$propId", 
                        "Check in and check out dates cannot be in the past.<br>"
                    . "Please try again with an alternate date range.");          
        }
 
        
        // Check if the specified reservation dates are ok for the given property
        $rsvProfs = bogCheckReservExists($propId, $checkInDate, $checkOutDate);
//var_dump($rsvProfs); die();
        
        
        if (($errCode = bogGetLastErrorCode()) != 0) {
            alertRedirect(3, 'BogRentalPage.php', 
                        "An error occurred confirming your reservation, err'$errCode'");
        } elseif (count($rsvProfs) > 0) {
            alertRedirect(5, "BogRentalPage.php?propId=$propId", 
                        "It appears this property conflicts with a previous reservation.<br>"
                    . "Please try again with an alternate date range.");
        } 

        // Save the data to the session 
        $_SESSION['resInfo'] = $resInfo;

        // Ensure that the reservation is available            
        bogAddReservProf($propId, $userId, $checkInDate, $checkOutDate, $guestCnt);

        // Check the result of the add operation
        if (($errCode = bogGetLastErrorCode()) != 0) {
            alertRedirect(3, 'BogRentalPage.php', 
                "An error occurred confirming your reservation, err'$errCode'");
        } elseif (($rsvId = bogGetLastInsertId()) == -1) {
            alertRedirect(4, "BogRentalPage.php?propId=$propId", 
                "An error occurred confirming your reservation.");
        } 

        //typically not required; ensures that the session data is store
        session_write_close(); 

        // Redirect to the login page
        alertRedirect(5, 'BogHome.php', 
                    "Thank you for booking with us! Your reservation ID is '$rsvId'.<br> "
                . "You will now be redirected to our home page.");
    } else {
        echo"DUMMY"; die();
        alertRedirect(3, 'BogHome.php', 
                'OOPS!  Something went wrong - contact the System Administrator!');
    }
    
?>
