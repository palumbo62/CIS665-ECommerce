<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogAddPropertyAction.php
    
        This module will process a add property (admin or user) request after
        an administrator completes the add listing page and clicks on the submit 
        button.
*/ 
    session_start();

    require_once ("..\sqlCommon\bogSql.php");
    require_once ("..\phpCommon\BogLibrary.php");
    
    // Should have only made it here if Listing was 'submitted'
    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogHome.php';
    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : '';   
    
    $commentEntered = $_POST['commentSubmit'];
    
    if (isset($commentEntered)) {
        // Set local variables to $_POST array elements 

        $rating = $_POST['RatingID'];
        $propId = $_POST['propId'];

        $mmyyVisit = (isset($_POST['MonthYearVisit'])) ? $_POST['MonthYearVisit'] : '';
        $comments = (isset($_POST['comments'])) ? trim($_POST['comments']) : '';
        
//        echo "FileName='$fileName'  ImageName='$imageName'<br><br>";
//        die();
        // Save the listing information to the session        
        $commentInfo = array('userId'=>$userId, 'propId'=>$propId, 
                          'RatingID'=>$rating, 'MonthYearVisit'=>$mmyyVisit,
                          'comments'=>$comments);
                      var_dump($commentInfo);
        // Save the data to the session 
        $_SESSION['commentInfo'] = $commentInfo;

        // Pull all the data from the POST array and call the SQL query
        // to add the registration to the database     
        bogAddCommentsProf($userId, $propId, $rating,
            $mmyyVisit, $comments);

        // Check the result of the add operation
        if (($errCode = bogGetLastErrorCode()) != 0) {
            alertRedirect(3, 'BogAddProperty.php', 
                          "Review has failed to be added to BOG database, err'$errCode'");
        } elseif (($rvwId = bogGetLastInsertId()) == -1) {
            alertRedirect(3, 'BogAddProperty.php', 
                          "Review has failed to be added to BOG database!");
        }  else {
            //typically not required; ensures that the session data is store
            session_write_close(); 

            alertRedirect(3, 'BogSelectedView.php', 
                          "Your review of this propery has been received, ID='$rvwId'<br>");
        }
    } else {
        alertRedirect(3, 'BogHome.php', 
                      'OOPS!  Something went wrong - contact the System Administrator!');
    }
?>
