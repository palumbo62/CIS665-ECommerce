<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogLogin.php
    
        Main entry point to the BOG Login web page
*/ 
    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\phpCommon\BogLibrary.php");
    require_once ("..\sqlCommon\bogSql.php");

    // Set local variables to $_POST array elements (userlogin and userpassword) or empty strings

    $email = (isset($_GET['email'])) ? trim($_GET['email']) : '';
    $password = (isset($_GET['password'])) ? trim($_GET['password']) : '';
    $login = $_GET['userLogin'];

    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogHome.php';

    echo "REDIRECT='$redirect'  email='$email'  password='$password'  login='$login'<br>'";
    // if the form was submitted

    if (isset($login))
    {
        //Call bogLogin to validate the user credentials
        $userList = bogLogin($email, $password);

        if (count($userList) === 1) //If credentials check out
        {
            extract($userList[0]);
//            echo "<pre>";
//            print_r($userList);
//            echo "</pre>";
            
            // assign user info to an array

            $userInfo = array('userId'=>$UserIdPK, 'firstName'=>$FirstName, 
                              'lastName'=>$LastName, 'roleType'=>$RoleIdFK);

            // Save the data to the session 
            $_SESSION['userInfo'] = $userInfo;
            
            //typically not required; ensures that the session data is store
            session_write_close(); 

            // redirect the user
            if ($RoleIdFK = 1) {
                $redirect = "BogLoginResults_Admin.php";
            } else {
                $redirect = "BobLoginResults_User.php";
            }

            // Successful login - redirect to the home page
            alertRedirect(2, 'BogHome.php', 'Login Successful!');
        } else {
            // Invalid credentials

            alertRedirect(3, 'BogLoginPage.php', 
                         'User credential are invalid.  Please try again.');
        }
    }

    // Display the page

    displayPageHeader("../cssStyles/loginPageCSS.css", "Login Page");
    displayLoginPage();
?>

    <section id="banner">
        <form action="BogLoginPage.php">
            <div class="container">
                <input type="hidden" name ="redirect" value ="<?php echo $redirect?>" /><br>
                
                <input type="text" placeholder="EmailAddress" name="email" required
                       maxlength="50" autofocus="autofocus" required
                       pattern="^[\w@\.-]+$" title="Enter email address"><br>
                
                <input type="password" placeholder="Password" name="password" required 
                       maxlength="20" required="required" pattern="^[\w@\.-]+$" 
                       title="Enter password"><br> 

                 <!--Button Should reach out to php page and confirm user or admin access-->
                <br>
                <button name="userLogin" type="submit" value="login">Login</button>
                <button name="userReset" type="reset" value="reset">Reset</button>
                <button type="button" onclick="location.href='BogHome.php';return false;">Cancel</button>
               
                <!--<button type="submit" value="Login" name="login">Login</button>-->
                <p>
                    <a href="BogRegister.php" style="text-underline-position:auto">Register for Account</a>
                </p>
            </div>
        </form>  
    </section>

<?php
    displayPageFooter('');
?>
