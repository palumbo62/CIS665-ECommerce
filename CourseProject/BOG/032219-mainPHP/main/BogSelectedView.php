
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

    require_once ("..\phpCommon\BogLibrary.php");
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated

    $userId = (isset($_SESSION['userInfo']))? $_SESSION['userInfo']['userId'] : '';   
    $propId = $_GET['propId'];

    if (!empty($userId)) {
        $tag = "Listing Page Property ID '$propId";
    } elseif (empty($propId)) {
        alertRedirect(3, 'BogHome.php', 
                      'OOPS!  Something went wrong - contact the System Administrator!');
    }
     
    displayPageHeader("..\cssStyles\BOG_Style_Layout_All.css", $tag);
    displayTestimonialsPage();
?>

    <!-- Banner -->
    <!--From val_reservation--->
    <section id="bannerList">       
        <h2>Selected View</h2> 
        <button type="submit" onclick="location.href='BogRentalPage.php?propId=<?php echo $propId ?>';return false;">Reserve</button>
        <button type="submit" onclick="location.href='BogViewReservation.php?propId=<?php echo $propId ?>';return false;">View Reservations</button>
        <button type="submit" onclick="location.href='BogListings.php';return false;">Cancel</button>
    </section>
<!--    <section id="bannerList"> 
        <form action="BogRentalAction.php" method='post'>
        <h2>Selected View</h2>
        <button name="reserveSubmit" type="submit" value="reserve" onclick="location.href='BogRentalPage.php';return false;">Reserve</button>
        <button name="viewReserve" type="submit" value="reserve" onclick="location.href='BogViewReservation.php';return false;">View Reservation</button>
        <button type="reserveSubmit" onclick="location.href='BogRentalPage.php';return false;">Reserve</button>
        <button type="submit" onclick="location.href='BogViewReservation.php';return false;">View Reservations</button>
        </form>
    </section>-->
    
    
    <!--FROM Val_reservation--->
    <?php     
                
    // get the details for rental

    $propertyDetails = bogGetPropProfById($propId);

    if (($errCode = bogGetLastErrorCode()) != 0) {
        echo "Failed to retrieve property profile from database, err='$errCode'<br><br>";
    } else if (count($propertyDetails) == 0) {
        echo "Property profile for propId='$propId' not found!<br><br>";
        var_dump($_GET);
    } else if (count($propertyDetails) > 1) {
        echo "Multiple property profiles for propId='$propId' found!<br><br>";
    } else {
        echo '<table id="PropProfiles">
                            <thead>
                                <tr>
                                     <th>PropId</th>
                                     <th>PropTypeId</th>
                                     <th>Addr</th>
                                     <th>City</th>
                                     <th>State</th>
                                     <th>Zip</th>
                                     <th>Price</th>
                                     <th>#Beds</th>
                                     <th>#Baths</th>
                                     <th>Sqft</th>               
                                     <th>#Guest</th>               
                                     <th>Pic</th>               
                                     <th>Type</th>               
                             </tr>
                        </thead>
                    <tbody>';





        foreach ($propertyDetails as $details) {
            echo '<tr>
                       <td>' . $details['PropertyIdPK'] . '</td>
                       <td>' . $details['PropertyTypeIdFK'] . '</td>
                       <td>' . $details['Address'] . '</td>
                       <td>' . $details['City'] . '</td>
                       <td>' . $details['State'] . '</td>
                       <td>' . $details['Zipcode'] . '</td>
                       <td>' . $details['DailyPrice'] . '</td>
                       <td>' . $details['NumBedrooms'] . '</td>
                       <td>' . $details['NumBathrooms'] . '</td>
                       <td>' . $details['SqFt'] . '</td>
                       <td>' . $details['GuestCnt'] . '</td>
                       <td>' . $details['Pic'] . '</td>
                       <td>' . $details['PropertyTypeName'] . '</td>
                   </tr>';
        }

        echo '</tbody> </table> </section>';

        echo "<pre>";
        print_r($propProfile);
        echo "</pre >";
    }
    ?> 
    
    <section id="banner">
        <form action="BogTestimonials.php"  method="POST">
            <div class="containerComment">    
                <label for="listingSelected">Title of Listing</label>
                <p><?php echo $details['Address']  ?></p>
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