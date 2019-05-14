<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogRegisterAction.php
    
        This module will process a registration (admin or user) request after
        a user completes the registration page and clicks on the submit 
        button.
*/ 
    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\phpCommon\BogLibrary.php");
    require_once ("..\sqlCommon\bogSql.php");
    
    // Should have only made it here if Registration was 'submitted'
    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogLoginPage.php';
    $register = $_POST['regSubmit'];
    
//    echo "REDIRECT='$redirect'  regSubmit='$register'<br>";
    
    if (isset($register)) {
        // Set local variables from $_POST array elements 

        $userId = -1; // if the add is successful then update with new ID below
        $roletype = (isset($_POST['roletype'])) ? trim($_POST['roletype']) : '';
        $email = (isset($_POST['email'])) ? trim($_POST['email']) : ''; 
        $password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
        $confpass = (isset($_POST['confpass'])) ? trim($_POST['confpass']) : '';
        $firstName = (isset($_POST['firstname'])) ? trim($_POST['firstname']) : '';
        $lastName = (isset($_POST['lastname'])) ? trim($_POST['lastname']) : '';
        $address = (isset($_POST['address'])) ? trim($_POST['address']) : '';
        $city = (isset($_POST['city'])) ? trim($_POST['city']) : '';
        $state = (isset($_POST['state'])) ? trim($_POST['state']) : '';
        $zipcode = (isset($_POST['zipcode'])) ? trim($_POST['zipcode']) : '';
        $phoneNumber = (isset($_POST['phonenumber'])) ? trim($_POST['phonenumber']) : '';
        $ccNumber = -1;
        $ccExpDate = '';
        $ccCvc = -1;
        
        // Save the registration information to the session
        if (isset($_POST['regReset'])) {
            unset($_SESSION['regInfo']);
        } else {
            $regInfo = array('userid'=>$userId, 'roletype'=>$roletype, 
                            'email'=>$email, 'password'=>$password,
                            'firstname'=>$firstName, 'lastname'=>$lastName,
                            'address'=>$address, 'city'=>$city,
                            'state'=>$state, 'zipcode'=>$zipcode,
                            'phoneNumber'=>$phoneNumber, 'ccnumber'=>$ccNumber,
                            'ccexpdate'=>$ccExpDate, 'cccvc'=>$ccCvc);

            // Save the data to the session 
            $_SESSION['regInfo'] = $regInfo;
        }

        // Ensure that the email is unique that is the key - this check is
        // performed here to ensure the registration page retains it contents
        $res = bogCheckEmailExists($email);

        if (bogCheckEmailExists($email) == true) {
            alertRedirect(3, 'BogRegister.php', 
                          "The chosen email address '$email' is already in use.<br>"
                          . "Please choose a different one.");
        }

        if ($password == $confpass) {
            // Pull all the data from the POST array and call the SQL query
            // to add the registration to the database.
            bogAddUserProf($roletype, $email, $password, $firstName, $lastName,
                            $address, $city, $state, (int)$zipcode, (int)$phoneNumber,
                            (int)$ccNum, $ccExpDate, (int)$ccCvc);

            // Check the result of the add operation
            if (($errCode = bogGetLastErrorCode()) != 0) {
                alertRedirect(3, 'BogRegiser.php', 
                              "User profile failed to be added to BOG database, err'$errCode'");
            } elseif (($userId = bogGetLastInsertId()) == -1) {
                alertRedirect(3, 'BogRegiser.php', 
                              "User profile failed to be added to database!");
            } else {
                // Successful registration - don't need this data saved anymore 
                unset($_SESSION['regInfo']);

                //typically not required; ensures that the session data is store
                session_write_close(); 

                // Redirect to the login page
                alertRedirect(3, 'BogLoginPage.php', 
                              'Thank you for Registering.  You will now be redirected to our login page.');
            }
        } else {
            alertRedirect(3, 'BogRegister.php', 
                          'Passwords do not match.  Please try again.');
        }
    } else {
        alertRedirect(3, 'BogHome.php', 
                      'OOPS!  Something went wrong - contact the System Administrator!');
    }
    
?>
