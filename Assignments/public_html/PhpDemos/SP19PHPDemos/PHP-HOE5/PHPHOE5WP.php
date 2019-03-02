<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE5
    Name:          Robert Palumbo
    Due Date:      3.7.2019 @ 11:59pm

    PHP - Hands-on-Exercise 4

    Create PHP pages/functions to allow users to add a new actor record. The 
    form should have appropriate controls to enter an actor’s first name 
    (NameFirst), last name (NameLast), age, gender and agent (ActorAgent). 
    Include appropriate client-side validations for each control.  
    Note: Gender is stored as “M” or “F” in the database. 
  
    Filename: PHPHOE5WP.php 
 */
require_once ("PHPHOE5-SiteCommon.php");
require_once ("PHPHOE5-Sql.php");

// call the displayPageHeader method in siteCommon.php

displayPageHeader("Add a Movie");
?>

<script src="PHPHOE5-jsLibrary.js" type="text/javascript"></script>

<form name ="addForm" id="addForm" action="PHPHOE5WP-Add.php" method="post" onsubmit="return checkForm(this)">

    <label for="actorfname">First Name:</label>   
    <input type="text" name="actorfname" id="actorfname" maxlength="50" autofocus required 
           pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" 
           title="Actor First Name has invalid characters"/>
    
    <label for="actorlname">Last Name:</label>   
    <input type="text" name="actorlname" id="actorlname" maxlength="50" autofocus required 
           pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" 
           title="Actor Last Name has invalid characters"/>

    <label for="actorage">Age:</label>
    <input type="number" name="actorage" id="actorage" required 
           min="0" max="120" style="width: 3"/>
    
    <div id="gender">

    <input type="radio" id="gender" name="gender" value="male" checked> Male<br>
    <input type="radio" id="gender" name="gender" value="female"> Female
    </div>
    
    <label for="agentname">Agent Name:</label>   
    <input type="text" name="agentname" id="agentname" maxlength="50" autofocus required 
           pattern="^[a-zA-Z0-9][\w\s\&,]*[a-zA-Z0-9\!\?\.]$" 
           title="Agent Name has invalid characters"/>

    <p>
        <input type="submit" value="Add Actor" />
    </p>        
</form>

<?php

// call the displayPageFooter method in siteCommon.php

displayPageFooter();
?>