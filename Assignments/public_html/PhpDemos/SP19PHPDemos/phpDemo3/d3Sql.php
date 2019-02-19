<?php
/* 
    Purpose: Demo3 - Sql Methods to access data from the RW Studios DB
    Author: LV
    Date: January 2019
    Uses: dbConnExec.php
 */
    
require_once '../dbConnExec.php';

function getFilmsList()
{
    // the SQL query to be executed on the database

    $query = "Select filmpk, movietitle, pitchtext, summary, dateintheaters
            From film
            Order by movietitle";
   
   // call the executeQuery method (in dbConnExec.php)
   // and return the result

   return executeQuery($query);
   
   //Alternatively, call a stored procedure
   
//    return executeQuery("Exec getFilmsList");
}

function getFilmByFilmPK($filmPK)
{
    // the SQL query to be executed on the database
    
    $query = "Select filmpk, movietitle, pitchtext, summary, dateintheaters, amountbudgeted
		From film
                Where filmpk = $filmPK";

    // call the executeQuery method and return the result

        return executeQuery($query);
    
    // Alternatively, call a stored procedure
    
    // return executeQuery("Exec getFilmByFilmPK $filmPK");
}

function checkImageFile($filmPK)
{
    $fileName = "../images/f$filmPK.gif";
    
    return file_exists($fileName);
}
?>