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

    displayPageHeader("..\cssStyles\commentsCSS.css", $tag);
    displayTestimonialsPage();
?>

    <!-- Banner -->
    <section id="banner">
        <form action="/action_page.php">

            <div class="container">
                <h1>Add Comment:</h1>
                <label for="fullName">Full Name: </label>
                <input type="text" name="fullName" required>
                <br />

                <label for="comment">Comment: </label>
                <textarea rows="4" cols="50" name="comment" form="usrform">Enter text here...</textarea>

                <button type="submit">Submit</button>
            </div>
        </form>
    </section>

    <!-- Banner -->
    <section id="secondbanner">
        <h1>Recent Comments:</h1>
    </section>

<?php
    displayPageFooter('');
?>