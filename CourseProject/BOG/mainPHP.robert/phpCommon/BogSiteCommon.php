<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       bogSiteCommon.php
    
        PHP based support funtions common to all web site pages.
 
*/
function displayPageHeader($cssStyle, $pageTitle)
{
   $output = <<<STR
<!DOCTYPE html>
<html>
<head>
    <!--
      Project Test Template
      Be Our Guest(BOG) Vacation Rentals

     Team: Kiana Vigil, Valerie Duran, Robert Palumbo
     Date: 2/25/2019

    Filename: home.html

    -->

    <meta charset="utf-8" />
    <title>BeOurGuest - Vacation Rentals</title>
    <link href="$cssStyle" rel="stylesheet" />
    <style>
        .navbar a:hover, .dropdown:hover .dropbtn {
            background-color: green;
        }

        .dropdown {
            position: relative;
            display: block;
        }

        .dropdown .dropbtn {
            font-size: inherit;  
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .dropdown-content {
            display: none;
            width: 100%;
            position: absolute;
            background-color: #383b43;
            min-width: 160px;       
            box-shadow: none;
            z-index: 1;
        }

        .dropdown-content a {
			height: 50px;
            width: 100%;
            border: solid;
            border-width: thin;
            line-height: 50px;
            padding-left: 12px; 
            padding-right: 12px; 
            text-decoration: none;        
        }

        .dropdown:hover .dropdown-content {
            display: inline-block;
        }    
    </style>
</head>

<body>
    <!-- Header -->
    <header id="header">
        <h1>$pageTitle</h1>
        <nav id="nav">
            <ul>
                <li><a href="BogHome.php">Home</a></li>
                <li><a href="BogListings.php">Listings</a></li>
                <li><a href="BogTestimonials.php">Testimonials</a></li>
STR;

    // Update menu options based on user account type
    $roleType = $_SESSION['userInfo']['roleType'];   
    $userId = $_SESSION['userInfo']['userId'];   
    
    if ($roleType == 1) {
        // Admin User
        $output .= '<li><div class="dropdown">
                        <button class="dropbtn">Admin 
                          <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                          <a href="BogAdminAddProperty.php">Add Property</a>
                          <a href="BogAdminDelProperty.php">Delete Property</a>
                        </div>
                      </div> 
                    <li>';
    } elseif ($roleType == 2) {
        // Registered user
        $output .= '<li><a href="BogUserProfile.php">Account</a></li>';
    }
    
    $logStatus = (isset($_SESSION['userInfo']));   

    // if the user is authenticated, display "Log Out", else Log In"

    if ($logStatus)
    {
        $output .= '<li><a href="BogLogout.php">Log Out</a></li>';
    }
    else
    {
        $output .= '<li><a href="BogLoginPage.php">Login/Register</a></li>';
    }
  
    $output .= "</ul></nav></header>";

    echo $output;
}

function displayPageFooter($footerTitle)
{
    $userId = $_SESSION['userInfo']['userId'];   
    $firstName = $_SESSION['userInfo']['firstName'];   
    $lastName = $_SESSION['userInfo']['lastName'];   
    $roleType = $_SESSION['userInfo']['roleType'];   
    $roleName = ($roleType == 1) ?  'Admin' : 'User';
    $year = date('M-Y');

    $output = <<<STR
    <footer id="footer">
        <p>&copy; BeOurGuest, Inc. $footerTitle &nbsp;$year</p>
        <p> TEAM 115: Robert Palumbo, Valerie Duran, Kiana Vigil</p>
        <p> UserID='$userId'&nbsp;&nbsp;
            FirstName='$firstName'&nbsp;&nbsp;
            LastName='$lastName'&nbsp;&nbsp;
            RoleType='$roleName'</p>
    </footer>   
    </body>
    </html>
STR;
   
   echo $output;
}

function displayHomePage() 
{
//DO NOTHING FOR NOW
//    $output = <<<STR
//STR;
//
//   echo $output;
}
  
function displayListingsPage() 
{
//DO NOTHING FOR NOW
//    $output = <<<STR
//STR;
//
//   echo $output;
}

function displayTestimonialsPage() 
{
//DO NOTHING FOR NOW
//    $output = <<<STR
//STR;
//
//   echo $output;
}

function displayLoginPage()
{
//DO NOTHING FOR NOW
//    $output = <<<STR
//STR;
//
//   echo $output;
}

function displayRegisterPage()
{
//DO NOTHING FOR NOW
//    $output = <<<STR
//STR;
//
//   echo $output;
}

function displayUserProfilePage()
{
//DO NOTHING FOR NOW
//    $output = <<<STR
//STR;
//
//   echo $output;
}

function displayAdminAddPropertyPage()
{
//DO NOTHING FOR NOW
//    $output = <<<STR
//STR;
//
//   echo $output;
}

function displayAdminDelPropertyPage()
{
//DO NOTHING FOR NOW
//    $output = <<<STR
//STR;
//
//   echo $output;
}

function displayRentPropertyPage()
{
//DO NOTHING FOR NOW
//    $output = <<<STR
//STR;
//
//   echo $output;
}

function displayLoginResults_User() 
{
//DO NOTHING FOR NOW
//    $output = <<<STR
//STR;
//
//   echo $output;
}

function displayLoginResults_Admin()
{
//DO NOTHING FOR NOW
//    $output = <<<STR
//STR;
//
//   echo $output;
}

?>