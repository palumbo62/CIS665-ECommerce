
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
    
    $_SESSION['redirect'] = 'BogSelectedView.php';

///////////////////////////////USE THIS CODE IF USER TRIES TO ADD COMMENT
    if (isset($propId)) {
        $_SESSION['propId'] = $propId;
    } else {
        $propId = $_SESSION['propId'];
    }
//        
//    if (empty($userId)) {
//        alertRedirect(3, 'BogLoginPage.php', 
//                      'You must be logged in to view listings. '
//                . ' You will now be redirected to our Login page!');
//    }

    $tag = "Viewing Property ID '$propId'";
    
    // get the property details 
    $details = bogGetPropProfById($propId);

    if (($errCode = bogGetLastErrorCode()) != 0) {
        $err = "Failed to retrieve property profile from database, err='$errCode'<br><br>";
    } else if (count($details) == 0) {
        $err = "Property profile for propId='$propId' not found!<br><br>";
    } else if (count($details) > 1) {
        $err =  "Multiple property profiles for propId='$propId' found!<br><br>";
    } 

    // If any errors are encountered notify the user and bail out
    if (isset($err)) {
        alertRedirect(3, 'BogListings.php', $err);
    }

    // Grab the image name for the property
    $imageName = (isset($details[0]['ImageName'])) 
                        ? trim($details[0]['ImageName'])
                        : 'default-house.jpg'; 

    // Build the input for adding a review but only allowed if a user
    // is logged in to the system
//                <?php echo "$details['PropertyIdPK']"?
    $addReviewOuput = '';
    if (!empty($userId)) {
        $addReviewOutput = '<h1>Add Review</h1>
            
            <br />
            <p>
                <label for="RatingID"> Rating: </label>
                <select name="RatingID" id="RatingID" required>
                    <option value="5">5 - Very Satisfied</option>
                    <option value="4">4 - Satisfied</option>
                    <option value="3">3 - Fair</option>
                    <option value="2">2 - Dissatisfied</option>
                    <option value="1">1 - Very Dissatisfied</option>
                </select>
                <br />
                <br />
                <label for="MonthYearVisit" > Date Visted: </label>
                <input type="date" name="MonthYearVisit" id="MonthYearVisit"
                        required
                        min="1900-01-01" max="' . date("m/d/Y") . '"/>' . 
                '<br />
                <br />
                <label for="comment">Comment: </label>
                <br />
                <textarea rows="5" cols="50" name="comments" id="comment" placeholder="Enter text here..."></textarea>
                <input type="hidden" name="propId" value="'  . $propId . '"/>' .
                '<br /><br />
                <button name="commentSubmit" type="submit" value="submit">Submit</button>
                <hr>                
            </p>";';
    }

    displayPageHeader("..\cssStyles\BOG_Style_Layout_All.css", $tag);
    displayTestimonialsPage();
?>

    <!-- Banner -->
    <!--From val_reservation--->
    <section id="bannerList">     
        <h2>Property View</h2> 
        <form action="BogRentalPage.php" method="post">
            <input type="hidden" name="propId" value="<?php echo $propId ?>" />
            <button name="resSubmit" type="submit" value="reserve">Reserve</button>
            <button type="submit" onclick="location.href='BogViewReservationsPropId.php?propId=<?php echo $propId ?>';return false;">View Reservations</button>
            <button type="submit" onclick="location.href='BogListings.php';return false;">Cancel</button>
        </form>
    </section>
    
    <!--FROM Val_reservation--->
    <?php     
    ?> 
    
    <section id="secondbannerList">
        <form action="BogAddCommentAction.php" method="post">
            <ul class="article-list-vertical-Select">
                <li>
                    <br />
                    <h1><?php echo $details[0]['PropertyTitle'] ?></h1>
                    <br>
                    <p>
                        Property ID:<?php echo $details[0]['PropertyIdPK'] ?><br />
                        Property Type:<?php echo $details[0]['PropertyTypeName'] ?><br />
                        Location:<?php echo '   ' . $details[0]['Address'] . '  ' . $details[0]['City']
                         . '  ' . $details[0]['State'] . ',' . '  ' . $details[0]['Zipcode']
                         ?><br />
                        Bedrooms:<?php echo $details[0]['NumBedrooms'] . '         ' ?> 
                        Bathrooms:<?php echo $details[0]['NumBathrooms'] ?><br />
                        Guest Count: <?php echo $details[0]['GuestCnt'] . '    ' ?>SqFt: <?php echo $details[0]['SqFt'] ?><br />
                        Daily Price: <?php  sprintf("%.2f",$details[0]['DailyPrice']) ?><br /><br />

                        <img src="<?php echo '../images/' . $imageName ?>" />
                        <br />
                        <br />
                    <hr>
                    </p>
                    
                    <br />
                    
                    <!---------------SUBMIT COMMENT---------------------->
                    <?php echo $addReviewOutput?>
                    <br />

                    <br />
                    
                    <!-----REVIEWS POPULATED FROM DB------->
                    <h1>Reviews</h1>
                    <p>
                        <?php 
                            // Retrieve the property reviews
                            $comments = bogGetCommentsByPropId($propId);

                            if (($errCode = bogGetLastErrorCode()) != 0) {
                                $err = "Failed to retrieve comment profile from database, err='$errCode'<br><br>";
                            } else if (count($comments) == 0) {
                                $err = "Comments for propId='$propId' not found!<br><br>";
                            } 
                            
                            if (isset($err)) {
                                alertRedirect(3, "BogSelectedView.php", $err);
                            }
                            
                            echo '<table id="Comments">
                                    <thead>
                                        <tr>
                                            <th>DateSubmitted</td>
                                            <th>Rating</th>
                                            <th>DateOfVisit</th>
                                            <th>Comments</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                            // display the results
                            foreach ($comments as $comment) {
                                echo '<tr>
                                        <td>' . $comment['DateSubmitted'] . '</td>
                                        <td>' . $comment['Rating'] . '</td>
                                        <td>' . $comment['MonthYearVisit'] . '</td>
                                        <td>' . $comment['Comments'] . '</td>
                                    </tr>';
                            }

                            echo '</tbody> </table> </section>';
                        ?>
                    </p>
                    <br />
                    
                    
                    
                </li>    
            </ul>
        </form>            
    </section>

<?php
    displayPageFooter('');
?>