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

    require_once ("..\sqlCommon\bogSql.php");
    require_once ("BogLibrary.php");
    
    // Should have only made it here if Registration was 'submitted'
    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogLoginPage.php';

//    if (isset($register))
    {
        // Set local variables to $_POST array elements 

        $roleType = (isset($_POST['roletype'])) ? trim($_POST['roletype']) : '';
        $email = (isset($_POST['email'])) ? trim($_POST['email']) : ''; 
        $password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
        $passwordconf = (isset($_POST['passwordconf'])) ? trim($_POST['passwordconf']) : '';
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
        $userId = -1; // if the add is successful then update with new ID below

        if ($password == $passwordconf) {
            // Pull all the data from the POST array and call the SQL query
            // to add the registration to the database.
            bogAddUserProf($roleType, $email, $password, $firstName, $lastName,
                            $address, $city, $state, (int)$zipcode, (int)$phoneNumber,
                            (int)$ccNum, $ccExpDate, (int)$ccCvc);

            // Check the result of the add operation
            if (($errCode = bogGetLastErrorCode()) != 0) {
                echo "User profile failed to be added to BOG database, err'$errCode'";
            } else {
                if (($userId = bogGetLastInsertId()) == -1) {
                    echo "User profile failed to be added to database!<br><br>";
                } else {
                    // Save the registration information to the session

                    $regInfo = array('UserPK'=>$userId, 'Role'=>$roleType, 
                                    'Email'=>$email, 'Password'=>$password,
                                    'FirstName'=>$firstName, 'LastName'=>$lastName,
                                    'Address'=>$address, 'City'=>$city,
                                    'State'=>$state, 'Zipcode'=>$zipcode,
                                    'PhoneNumber'=>$phoneNumber);

                    // Save the data to the session 
                    $_SESSION['regInfo'] = $regInfo;

                    //typically not required; ensures that the session data is store
                    session_write_close(); 

                    //alertMessage("UserID '$email' successfully registered!");
                    
                    // Redirect to the login page
                    header('Refresh: 2; URL=BogLoginPage.php');

                    echo '<h2>Thank you for Registering.  You will now be redirected to our login page.</h2>';
                    die();
                }
            }
        } else {
            alertMessage("invalid credentials - Display an appropriate error somwhere");

            // Redirect to the login page
            header('location:' . "BogRegisterPage.php");
            die();
        }
    }
?>
