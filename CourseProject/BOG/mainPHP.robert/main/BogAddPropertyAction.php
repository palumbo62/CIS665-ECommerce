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
    $listing = $_POST['propAdd'];
    
    if (isset($listing)) {
        // Set local variables to $_POST array elements 

        $title = (isset($_POST['title'])) ? trim($_POST['title']) : '';
        $proptype = (isset($_POST['proptype'])) ? $_POST['proptype'] : 1;
        $address = (isset($_POST['address'])) ? trim($_POST['address']) : '';
        $city = (isset($_POST['city'])) ? trim($_POST['city']) : '';
        $state = (isset($_POST['state'])) ? trim($_POST['state']) : '';
        $zipcode = (isset($_POST['zipcode'])) ? $_POST['zipcode'] : 0;
        $price = (isset($_POST['price'])) ? $_POST['price'] : 0.00;
        $numbeds = (isset($_POST['numbeds'])) ? $_POST['numbeds'] : 0;
        $numbaths = (isset($_POST['numbaths'])) ? $_POST['numbaths'] : 0;
        $guests = (isset($_POST['guestcnt'])) ? $_POST['guestcnt'] : 0;
        $sqft = (isset($_POST['sqft'])) ? $_POST['sqft'] : 0;
        $pic = (isset($_POST['pic'])) ? $_POST['pic'] : 0;
        
        $fileName = ($_FILES['uploadfile']['error'] != UPLOAD_ERR_OK) 
                            ? '' : $_FILES['uploadfile']['tmp_name'];     
        
        $imageName = bogUploadImage($fileName);
        echo "FileName='$fileName'  ImageName='$imageName'<br><br>";
        
        // Save the listing information to the session        
        $listInfo = array('proptype'=>$proptype, 'title'=>$title, 
                          'address'=>$address, 'city'=>$city,
                          'state'=>$state, 'zipcode'=>$zipcode, 'price'=>$price,
                          'numbeds'=>$numbeds, 'numbaths'=>$numbaths,
                          'guestcnt'=>$guestcnt, 'sqft'=>$sqft,
                          'pic'=>$pic, 'imageName'=>$imageName);

        // Save the data to the session 
        $_SESSION['listInfo'] = $listInfo;

        // Pull all the data from the POST array and call the SQL query
        // to add the registration to the database.
        bogAddPropProf($proptype, $title, $address, $city, $state, 
                        $zipcode, $price, $numbeds, $numbaths, 
                        $sqft, $guests, $pic, $imageName);

        // Check the result of the add operation
        if (($errCode = bogGetLastErrorCode()) != 0) {
            alertRedirect(3, 'BogAddProperty.php', 
                          "Listing profile failed to be added to BOG database, err'$errCode'");
        } elseif (($propId = bogGetLastInsertId()) == -1) {
            alertRedirect(3, 'BogAddProperty.php', 
                          "Listing profile failed to be added to database!");
        } else {
            // Dont need to hold on to this property any longer
            unset($_SESSION['listInfo']);
            
            //typically not required; ensures that the session data is store
            session_write_close(); 

            // Redirect to the login page
            alertRedirect(3, 'BogAddProperty.php', 
                          "Property listing has been added, ID='$propId'<br>"
                    . "You may now add another property or cancel to return to home page.");
        }
    } else {
        alertRedirect(3, 'BogHome.php', 
                      'OOPS!  Something went wrong - contact the System Administrator!');
    }
?>
