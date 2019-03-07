<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE6
    Name:          Robert Palumbo
    Due Date:      3.12.2019 @ 11:59pm

    PHP - Hands-on-Exercise 6

    Form used to collect and submit actor profile data to the database. 
    
    Filename: PHPHOE6-AddActorForm.php 
 */
require_once ("PHPHOE6-SiteCommon.php");
require_once ("PHPHOE6-Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Add an Actor");

?>

<script src="PHPHOE6-jsLibrary.js" type="text/javascript"></script>

<form name ="addForm" id="addForm" action="PHPHOE6-AddActor.php" method="post" 
      onsubmit="return checkForm(this)">

    <label for="firstName">First Name:</label>   
    <input type="text" name="firstName" id="actorfname" maxlength="50" autofocus required 
           pattern="^[a-zA-Z ']+$" 
           title="Enter the actor's First Name"/>
    
    <label for="lastName">Last Name:</label>   
    <input type="text" name="lastName" id="actorlname" maxlength="50" autofocus required 
           pattern="^[a-zA-Z ']+$" 
           title="Enter the actor's Last Name"/>

    <label for="age">Age:</label>
    <input type="number" name="age" id="actorage" required 
           min="0" max="120" value="21" style="width: 13"
           title="Enter the actor's Age"/>
    
    <div id="gender">

    <input type="radio" id="gender" name="gender" value="M" checked> Male<br>
    <input type="radio" id="gender" name="gender" value="F"> Female
    </div>
    
    <label for="agentName">Agent Name:</label>   
    <input type="text" name="agentName" id="agentname"  value="Robert Palumbo"
           maxlength="50" autofocus required 
           pattern="^[a-zA-Z ']+$" 
           title="Enter the agent's name for this actor"/>

    <p>
        <input type="submit" value="Add Actor" />
    </p>        
</form>

<?php

// call the displayPageFooter method in siteCommon.php

displayPageFooter('PHPHOE6');
?>