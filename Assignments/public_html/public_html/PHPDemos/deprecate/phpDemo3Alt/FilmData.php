<?php
    require_once 'GenericData.php';

/*
    Purpose: Demo3 Alt - Film Data Class
    Author: LV
    Date: February 2019
 */
class FilmData extends GenericData
{

    protected $rowData = array('filmpk' => "", 'movietitle' => "", 'pitchtext' => "", 'amountbudgeted' => "", 'ratingfk' => "", 'summary' => "", 'imagename' => "", 'dateintheaters' => "");
    
    public static function getFilms()
    {
        $query = "Select filmpk, movietitle, pitchtext, summary, dateintheaters from film order by movietitle";
        return self::execQuery($query);
    }
    
    public static function getFilmByPK($filmPK)
    {
    // the SQL query to be executed on the database
    
    $query = "Select filmpk, movietitle, pitchtext, summary, dateintheaters, amountbudgeted
		From film
                Where filmpk = $filmPK";
    return self::execQuery($query);
    }
    
    private static function execQuery($query)
    {
        $conn = parent::dbConnect();
        try 
        {
            $stmt = $conn->query($query);
            $films = array();
            foreach ($stmt->fetchAll((PDO::FETCH_ASSOC)) as $row)
            {
                $films[] = new FilmData($row);
            }

// the fetchObject method fetchs the next row/record in the result set, returns it as a FilmData object, and sets the object's properties from corresponding column values.
// if this method is used, a constructor that just initializes properties would not be needed

//            while ($film = $stmt->fetchObject(__CLASS__))
//            {
//                $films[] = $film;
//            }
            
            parent::dbDisconnect($conn);
            return $films;
        } 
        catch (PDOException $ex)
        {
            parent::dbDisconnect($conn);
            die('Query failed: ' . $ex->getMessage());
        }
    }
    
    public function checkImageFile()
    {
        $fileName = "../images/f$this->filmpk.gif";
    
        return file_exists($fileName);
    }
}