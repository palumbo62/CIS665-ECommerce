<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE5
    Name:          Robert Palumbo
    Due Date:      3.7.2019 @ 11:59pm

    PHP - Hands-on-Exercise 5

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

displayPageHeader("Add an Actor");
?>

<script src="PHPHOE5-jsLibrary.js" type="text/javascript"></script>

<form name ="addForm" id="addForm" action="PHPHOE5WP-Add.php" method="post" onsubmit="return checkForm(this)">

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
        <input type="radio" id="gender" value="M" name="gender" checked> Male<br>
        <input type="radio" id="gender" value="F" name="gender" > Female
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

displayPageFooter('PHPHOE5');
?>