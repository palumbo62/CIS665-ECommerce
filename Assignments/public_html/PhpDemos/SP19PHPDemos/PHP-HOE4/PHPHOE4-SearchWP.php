<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE4
    Name:          Robert Palumbo
    Due Date:      3.5.2019 @ 11:59pm

    PHP - Hands-on-Exercise 4

    Develop PHP pages/functions to enable a user to search for actors by last name (the user could enter
    a full or partial last name), maximum age (use the Age column for the search; not AgeReal) and
    gender (use radio buttons for gender). The user can choose to provide or not provide values for each
    search criterion. Retrieve and display all the actors (NameFirst, NameLast, Age and Gender) that
    match the specified criteria
  
    Filename: PHPHOE4-SearchWP.php
 */
require_once ("PHPHOE4-SiteCommon.php");
require_once ("PHPHOE4-Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("<br />Search for an actor by lastname, age, and/or gender<br />");
?>

<section>
<form action="PHPHOE4-ResultsWP.php" method = "post" name="SearchByMultiCriteria" id="SearchByMultiCriteria">
    <label for="lastname">Actor Last Name:</label>
    <input type="text" name="lastname" id="lastname" maxlength="20"  />
    <label for="age">Actor Age:</label>
    <input type="number" name="age" id="age" min="0" max="120" value=21 style="width: 3"/>

    <div>
    <label for="gender" id="gender">Actor Gender:</label>
    <input type="radio" name="gender" value="M" checked id="gender">&nbsp;Male<br>
    <input type="radio" name="gender" value="F" id="gender">&nbsp;Female<br>
    </div>
    <p>
      <input name = "search" type="submit" value="Search" />
   </p>      

</form>
</section>
<?php

// call the displayPageFooter method in siteCommon.php

displayPageFooter('PHP-HOE4');
?>
