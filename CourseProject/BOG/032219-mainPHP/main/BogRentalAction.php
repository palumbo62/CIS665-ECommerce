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
    
//    echo "REDIRECT='$redirect'  regSubmit='$register'<br>";
    
    if (isset($reserve)) {
        // Set local variables from $_POST array elements 
        $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   
        $propId= $_GET['propId']; 
        $checkInDate = (isset($_POST['CheckIn'])) ? trim($_POST['CheckIn']) : '';        
        $checkOutDate = (isset($_POST['CheckOut'])) ? trim($_POST['CheckOut']) : ''; 
        $guestCnt = (isset($_POST['GuestCnt'])) ? trim($_POST['GuestCnt']) : '';        
        $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogHome.php';
 
        if(isset($reserve)== !empty($userId)) {
            $tag = "UserID='$userId' Search / Rent listing";
        } else {
            alertRedirect(3, 'BogLoginPage.php', 
                     'Must be logged in to make reservations.<br>'
                    . 'You will now be redirected to our Login page.');
        };
             
        // Save the reservation information to the session

        $resInfo = array('propId'=>$propId, 'CheckIn'=>$checkInDate, 
                         'CheckOut'=>$checkOutDate, 'GuestCnt'=>$guestCnt);

        // Save the data to the session 
        $_SESSION['resInfo'] = $resInfo;

        // Ensure that the reservation is available            
        bogAddReservProf($propId, $userId, $checkinDate, $checkoutDate);

        // Check the result of the add operation
        if (($errCode = bogGetLastErrorCode()) != 0) {
            alertRedirect(3, 'BogRentalPage.php', 
                        "Reservation failed to be added to BOG database, err'$errCode'");
        } elseif (($userId = bogGetLastInsertId()) == -1) {
            alertRedirect(3, 'BogRentalPage.php', 
                        "Reservation failed to be added to BOG database. You will be redirected to the Reservation Page.");
        } else {
            // Successful reservation - don't need this data saved anymore 
            unset($_SESSION['resInfo']);

            //typically not required; ensures that the session data is store
            session_write_close(); 

            // Redirect to the login page
            alertRedirect(3, 'BogHomePage.php', 
                          'Thank you for booking with us! You will now be redirected to our home page.');
        }
    } else {
        alertRedirect(3, 'BogHome.php', 
                'OOPS!  Something went wrong - contact the System Administrator!');
    }
    
?>
