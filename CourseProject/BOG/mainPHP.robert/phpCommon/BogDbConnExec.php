<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       bobDbConnExec.php
    
        PHP based methods used to connect to and access the Team115 database.
 
        Database:  buscissql1601\cisweb\Team115DB
 */

$BOG_LastSqlErrorCode = 0;
$BOG_LastInsertId = 0;

// function to connect to the database
function dbConnect()
{
    $serverName = 'buscissql1601\cisweb';
    $uName = 'exposed';
    $pWord = 'source';
    $db = 'Team115DB';
    
    try
    {
        //instantiate a PDO object and set connection properties
        
        $conn = new PDO("sqlsrv:Server=$serverName; Database=$db", $uName, $pWord, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
           
    }
    // if connection fails
    
    catch (PDOException $e)
    {
        die('Connection failed: ' . $e->getMessage());
    }
    
    //return connection object

        return $conn;
}

//method to execute a query - the SQL statement to be executed, is passed to it

function executeQuery($query)
{
    // call the dbConnect function

    $conn = dbConnect();

    try
    {
        // execute query and assign results to a PDOStatement object

        $stmt = $conn->query($query);

        if ($stmt->columnCount() > 0)  // if rows with columns are returned
        {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);  //retreive the rows as an associative array
        }
     
        global $BOG_LastInsertId, $BOG_LastSqlErrorCode;
        
        $BOG_LastSqlErrorCode = $stmt->errorCode();
        $BOG_LastInsertId = $conn->lastInsertId();
        
        //echo "<br>LAST SQL ERRORCODE='$BOG_LastSqlErrorCode'<br>LAST INSERT ID='$BOG_LastInsertId'<br><br>";
//Uncomment these 4 lines to display $results
       
//        echo '<pre style="font-size:large">';
//        print_r("QUERY RESULTS: " . $results);
//        echo '</pre>';
//        die;
//       
//call dbDisconnect() method to close the connection

        dbDisconnect($conn);

        return $results;
    }
    catch (PDOException $e)
    {
        //if execution fails

        dbDisconnect($conn);
        die ('Query failed: ' . $e->getMessage());
    }
 }
 
function dbDisconnect($conn)
{
    // closes the specfied connection and releases associated resources

    $conn = null;
}

function bogGetLastErrorCode() {
    global $BOG_LastSqlErrorCode;

    return $BOG_LastSqlErrorCode;
}

function bogGetLastInsertId() {
    global $BOG_LastInsertId;
    
    $lastInsertId = $BOG_LastInsertId;
    
    if ($lastInsertId == null || $lastInsertId == '') {
        $lastInsertId = -1;
    }
    
    return $lastInsertId;
}
?>

