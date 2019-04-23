<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogLogout.php
    
        Logs user out of the BOG system and destroys all relevant state
        information.
 */
    session_start();

    require_once ("..\phpCommon\BogLibrary.php");
    
    // Logout out of the session
    bogLogOut();
    
    // Redirect user back to the home page
    alertRedirect(2, 'BogHome.php', 
                  'Thank you for Logging out.  You will now be redirected to our home page');
?>