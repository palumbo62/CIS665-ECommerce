<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogTestimonials.php
    
        Main entry point to the BOG Testimonials web page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : "";   

    if (!empty($userId)) {
        $tag = "UserID='$userId' Add new testimonial";
    } else {
        $tag = "UserID NOT Set";
    }

  
     
    displayPageHeader("..\cssStyles\BOG_Style_Layout_All.css", $tag);
    displayTestimonialsPage();
?>

    <!-- Banner -->
    <section id="bannerList"> 
        <form action="BogRentalAction.php" method='post'>
        <h2>Selected View</h2>
        <button name="reserveSubmit" type="submit" value="reserve" onclick="location.href='BogRentalPage.php';return false;">Reserve</button>
        <button name="viewReserve" type="submit" value="reserve" onclick="location.href='BogViewReservation.php';return false;">View Reservation</button>
<!--        <button type="reserveSubmit" onclick="location.href='BogRentalPage.php';return false;">Reserve</button>-->
<!--        <button type="submit" onclick="location.href='BogViewReservation.php';return false;">View Reservations</button>-->
        </form>
    </section>
    
    <section id="banner">
        <form action="BogTestimonials.php"  method="POST">
            <div class="containerComment">    
                <label for="listingSelected">Title of Listing</label>
                <p>This is where we need to connect the button with the title that
                was selected. This might be tricky</p>
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                
                <hr>
                <label for="listingSelected">Reviews</label>
                <p>This is where we will call from the data base of stored comments 
                for the particular rental. The form below should only add to the database, 
                being that this section is calling from the DB already.</p>
                 <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <br />
                <hr>
                <h3>Add Review</h3>
                <label for="RatingID"> Rating: </label>
                <select name="RatingID">
                    <option value=""></option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>   
                <br><br>
                <label for="MonthYearVisit" > Date Visted: </label>
                <input type="text" placeholder="XX/XXXX"  maxlength="7" pattern="^[0-9]{2}/[0-9]{4}$" name="MonthYearVisit">
                <br><br>
                <label for="comment">Comment: </label>
                <textarea rows="4" cols="50" name="comment" placeholder="Enter text here..."></textarea>
                
                <div id="button">
                <button name="commentSubmit" type="submit" value="submit">Submit</button>
               <div/>
            </div>
        </form>
    </section>


        
     <?php foreach($_SESSION as $comment){
             echo "Rating: " . $comment["RatingID"] . "<br> Date Visited: " . $comment["MonthYearVisit"]. "<br> Comment: ".$comment["comment"];
     }
     
     ?>
    </section>
    
  <?PHP 
  
   $comments = $_POST['commentSubmit'];
   
 if (isset($comments))
    {
        // Set local variables to $_POST array elements 

       $ratingID = $_POST['RatingID'];
       $monthYearVisit = $_POST['MonthYearVisit'];
      // $commentBox = (isset($_POST['comment']));
      
        
     

            // Check the result of the add operation
            if ($_POST['RatingID'] < 1 or $_POST['RatingID'] > 5) {
                echo "Enter a Rating";               
            }       
          
            else {
                // Save the registration information to the session

                $commentInfo = array('RatingID'=>$ratingID, 'MonthYearVisit'=>$monthYearVisit, 
                                'comment'=>$_POST['comment']);

                // Save the data to the session 
                $_SESSION['commentInfo'] = $commentInfo;

                //typically not required; ensures that the session data is store
               // session_write_close();
                
               
            }
        
               
   }

    displayPageFooter('');
?>