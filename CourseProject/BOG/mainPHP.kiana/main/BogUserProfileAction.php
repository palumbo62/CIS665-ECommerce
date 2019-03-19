<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogUserProfileAction.php
    
        This module will process a user profile update request after
        a user modifies their profile clicks on the submit button.
*/ 
    session_start();

    require_once ("..\sqlCommon\bogSql.php");
    require_once ("..\phpCommon\BogLibrary.php");
    
    // Should have only made it here if Registration was 'submitted'
    $update = $_POST['userUpdate'];
        
//    echo "UPDT='$update' <br>";
//    die();
    
    if (isset($update))
    {
        // Set local variables to $_POST array elements 
        $userId = (isset($_POST['userid'])) ? $_POST['userid'] : '';
        $roleType = (isset($_POST['roletype'])) ? trim($_POST['roletype']) : '';
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
        $ccNumber = (isset($_POST['CCNumber'])) ? $_POST['CCNumber'] : 0;
        $ccExpDate = (isset($_POST['CCNumber'])) ? $_POST['CCExpDate'] : '01-01-1999';
        $ccCvc = (isset($_POST['CCCvc'])) ? $_POST['CCCvc'] : 0;
    
        if ($password == $confpass) {
            // Pull all the data from the POST array and call the SQL query
            // to add the registration to the database.

            bogUpdateUserProfByUserId($userId, $roleType, $email, $password, 
                            $firstName, $lastName,
                            $address, $city, $state, (int)$zipcode, 
                            (int)$phoneNumber,
                            (int)$ccNum, $ccExpDate, (int)$ccCvc);

            // Check the result of the add operation
            if (($errCode = bogGetLastErrorCode()) != 0) {
                alertRedirect(3, 'BogUserProfile.php', 
                              "User profile failed to be updated to BOG database, err'$errCode'");
            } else {
                // Save the updated information to the session

                $userProf = array('userid'=>$userId, 'roletype'=>$roleType, 
                                'email'=>$email, 'password'=>$password,
                                'confpass'=>$confpass,
                                'firstname'=>$firstName, 'lastname'=>$lastName,
                                'address'=>$address, 'city'=>$city,
                                'state'=>$state, 'zipcode'=>$zipcode,
                                'phonenumber'=>$phoneNumber);

                // Save the data to the session 
                $_SESSION['userProfUpdtInfo'] = $userProf;

                //typically not required; ensures that the session data is store
                session_write_close(); 

                // Redirect to the home page
                alertRedirect(3, 'BogHome.php', 
                              'Your profile has been updated!<br>'
                              . 'You will now be redirected to our home page.');
            }
        } else {
            alertRedirect(3, 'BogUserProfile.php', 
                          'Passwords do not match.  Please try again.');
        }
    }
?>
