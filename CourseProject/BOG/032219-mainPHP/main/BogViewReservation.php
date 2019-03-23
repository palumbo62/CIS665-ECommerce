<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogViewReservation.php
    
        Main entry point to the BOG Testimonials web page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogLibrary.php");
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated
    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogLoginPage.php';
    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : '';   
    $propId = $_GET['propId'];
    
    if (!empty($userId)) {
        $tag = "View Reservations - Property ID: $propId";

        if (empty($propId)) {
            alertRedirect(3, 'BogLoginPage.php', 
                      'OOPS!  Something went wrong - contact the System Administrator!');
        }
    } else {
            alertRedirect(3, 'BogLoginPage.php', 
                     'You must be logged in to view reservations. You will now be redirected to our Login page.');
    }
     
    displayPageHeader("..\cssStyles\BOG_Style_Layout_All.css", $tag);
    displayTestimonialsPage();
?>

    <!-- Banner -->
    <section id="bannerList">       
        <h2>Reservations</h2>        
    </section>
    
    <section id="banner">
       <table class="blueTable">
           <thead>
               <tr>
                   <th>Rental</th>
                   <th>Location</th>
                   <th>Dates</th>
                   <th>Remove</th>
               </tr>
           </thead>
           <tbody>
               <tr>
                   <td>$rental title</td>
                   <td>$location</td>
                   <td>$$dates selected</td>
                   <td><button>Delete</ button></td>
               </tr>
           </tbody>
       </table>
    </section>


        
<?php 

    displayPageFooter('');
?>