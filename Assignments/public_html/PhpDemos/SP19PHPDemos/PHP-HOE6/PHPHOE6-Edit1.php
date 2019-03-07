<?php
/*
    Class:         CIS665
    Assignment:    PHP-HOE6
    Name:          Robert Palumbo
    Due Date:      3.12.2019 @ 11:59pm

    PHP - Hands-on-Exercise 6

    Used to preprocess how an actor profile should be displayed when
    the 'Edit' actor selection is made. 
    
    Filename: PHPHOE6-AddActorForm.php 
 */
require_once ("PHPHOE6-SiteCommon.php");
require_once ("PHPHOE6-Sql.php");

// declare and initialize Add/Edit flag variable

$editmode = false;

// if a numeric actor key was passed through the URL

if ((isset($_GET['ActorPK'])) && (is_numeric($_GET['ActorPK'])))
{
    // get the details for the movie to be edited
    
    $actorDetails = getActorDetailsByID((int)$_GET['ActorPK']);
    
    // if movie details are returned for the filmid, set $editmode to true
    
    $editmode = (count($actorDetails) == 1);
}

// if mode is $editmode is true

if ($editmode)
{
    extract($actorDetails[0]);

    $formtitle = 'Update an Actor';
    $buttontext = 'Update';
    
    $maleChecked = ($Gender == 'M') ? true : false;
 }
else  //otherwise, set the column variables to ""
{
    $NameFirst = '';
    $NameLast = '';
    $Age = '';
    $Gender = 'M';
    $maleChecked = true;
    $ActorAgent = 'Robert Palumbo';

    $formtitle = 'Add an Actor';
    $buttontext = 'Add';
}

// call the displayPageHeader method in siteCommon.php

displayPageHeader($formtitle);
?>

<script src="PHPHOE6-jsLibrary.js" type="text/javascript"></script>

<form name ="addEditForm" id="addEditForm" action="PHPHOE6-Edit1a.php" method="post" 
      onsubmit="return checkForm(this)">

<?php
    if ($editmode)  //put the filmpk in a hidden field
    {
        echo '<input type="hidden" name="ActorPK" value="' . $ActorPK . '" />';
    }
?>
    <label for="firstName">First Name:</label>   
    <input type="text" name="firstName" id="actorfname" maxlength="50" autofocus required 
           value="<?php echo $NameFirst; ?>"
           pattern="^[a-zA-Z ']+$" 
           title="Enter the actor's First Name"/>
    
    <label for="lastName">Last Name:</label>   
    <input type="text" name="lastName" id="actorlname" maxlength="50" autofocus required 
           value="<?php echo $NameLast; ?>"
           pattern="^[a-zA-Z ']+$" 
           title="Enter the actor's Last Name"/>

    <label for="age">Age:</label>
    <input type="number" name="age" id="actorage" required 
           value="<?php echo $Age; ?>"
           min="0" max="120" value="21" style="width: 13"
           title="Enter the actor's Age"/>
    
    <div id="gender">
    <input type="radio" id="gender" name="gender" value='M' 
            <?php if ($maleChecked == true) {echo 'checked';}?>> Male<br>
    <input type="radio" id="gender" name="gender" value='F'
            <?php if (!$maleChecked == true) {echo 'checked';}?>> Female
    </div>
    
    <label for="agentName">Agent Name:</label>   
    <input type="text" name="agentName" id="agentname"
           value="<?php echo $ActorAgent; ?>"
           maxlength="50" autofocus required 
           pattern="^[a-zA-Z ']+$" 
           title="Enter the agent's name for this actor"/>

    <p>
        <input type="submit" value="<?php echo $buttontext ?>" />
        <a href="PHPHOE6-All.php">Cancel</a>
    </p>        
</form>

<?php
// call the displayPageFooter method in siteCommon.php

displayPageFooter('PHPHOE6');
?>