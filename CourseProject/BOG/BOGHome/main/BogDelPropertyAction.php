<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogDeletePropertyAction.php
    
        This module will process a delete property (admin or user) request after
        an administrator completes the delete listing page and clicks on the 
        submit button.
*/ 
    session_start();

    require_once ("..\sqlCommon\bogSql.php");
    require_once ("..\phpCommon\BogLibrary.php");
    
    // Should have only made it here if Listing was 'submitted'
    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogHome.php';
    $delete = $_GET['delSubmit'];
    $propId = $_GET['propId'];
    
//    if (isset($delete) && 
    if (isset($propId) && is_numeric($propId)) {
        // Delete the listing
        $result = bogDelPropById($propId);
        
        // Check the result of the add operation
        if (($errCode = bogGetLastErrorCode()) != 0) {
            alertRedirect(3, 'BogDelProperty.php', 
                          "Property ID='$propId' to be deleted "
                            . "from the database, ErrCode='$errCode'");
        } else {
            // Dont need to hold on to this property any longer
            unset($_POST['propId']);
            
            //typically not required; ensures that the session data is store
            session_write_close(); 

            // Redirect to the login page
            alertRedirect(3, 'BogDelProperty.php', 
                          "Property listing has been deleted, ID='$propId'<br>"
                    . "You may now delete another property or cancel to return to home page.");
        }
    } else {
        alertRedirect(3, 'BogHome.php', 
                      'OOPS!  Something went wrong - contact the System Administrator!');
    }
?>
