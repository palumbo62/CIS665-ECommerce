<?php

/*  Purpose: Demo3 Alt - Generic Data Object class
    Author: LV
    Date: February 2019
*/
    
class GenericData 
{
    //array for holding row data
    
    protected $rowData = array();
    
    // constructor for creating a rowData object
    //the constructor has to be removed if fetchObject(__CLASS__) is used; otherwise, 
    //the property values will be reinitialized (see php.net documentation)
    
    public function __construct(array $data)
    {
        foreach ($data as $key => $value)
        {
            if (array_key_exists($key, $this->rowData)) 
            {
                $this->rowData[$key] = $value;
            }
        }
    }
    
    //method for returning a column value
    
    public function __get($columnName)
    {
        if (array_key_exists($columnName, $this->rowData))
        {
            return $this->rowData[$columnName];
        }
        else
        {
            die("Column not found");
        }
    }
    
    //method for setting a column value
    
    public function __set($columnName, $value)
    {
        $this->rowData[$columnName] = $value;
    }
    
    // function to connect to the database

    protected static function dbConnect()
    {
    $serverName = 'buscissql1601\cisweb';
    $uName = 'csu';
    $pWord = 'rams';
    $db = 'RWStudios';
    
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

    protected static function dbDisconnect($conn)
    {
    // closes the specfied connection and releases associated resources

    $conn = null;
    }
}

?>
