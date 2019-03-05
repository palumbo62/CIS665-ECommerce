<?php
/*
    Purpose: File Upload
    Author: LV
    Date: March 2018
    
 */
require_once ("../siteCommon.php");
require_once ("loadsql.php");

//Check for file upload errors; if there is an error store an empty string; otherwise the file name

$fileName = $_FILES['uploadfile']['error'] != UPLOAD_ERR_OK ? '' : $_FILES['uploadfile']['tmp_name'];

// if there were no errors, check the file type
// in this example, only gif and jpeg are permissable

if (!empty($fileName))
{
    $fileType = exif_imagetype($fileName);  // get the file type

    switch ($fileType)
    {
        case IMAGETYPE_GIF:  //if it is a GIF file
            $image = imagecreatefromgif($fileName) or $image = ''; // create a new gif image from the file
            break;
        case IMAGETYPE_JPEG: // if it is a JPEG file
            $image = imagecreatefromjpeg($fileName) or $image = ''; // create a new jpeg image from the file
            break;
        default:
            $image = '';
    }
 }

// if the file is a valid GIF or JPEG file, store it

if (!empty($image))
{
    $imageName = basename($_FILES['uploadfile']['name']);  // removes path info (if present) and extracts just the file name
    $path = '../images/' . $imageName;  // set the path (including the file name), where the file is to be saved

    switch ($fileType)
    {
        case IMAGETYPE_GIF:  //if it is a GIF file
            imagegif($image, $path);
            break;
        case IMAGETYPE_JPEG: // if it is a JPEG file
            imagejpeg($image, $path);
            break;
    }
    imagedestroy($image);
}
else
{
    $imageName = '';
}

// Call the addMovie method


addMovie($_POST['movietitle'], $_POST['pitchtext'], $_POST['amountbudgeted'],
    $_POST['ratingpk'], $_POST['summary'], $_POST['dateintheaters'], $imageName);

displayPageHeader("New Movie " . $_POST['movietitle'] . " added");
?>

<p style="text-align: center">
    <a href="load1.php">[Add another movie]</a>
</p>

<?php
displayPageFooter();
?>
