<?php
/*
    Purpose: File Upload
    Author: LV
    Date: March 2018

    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogImageUploadAction.php
    
        Provides file upload functionality for property images.
        Adapter for use within this project.
    
 */
    //require_once ("../siteCommon.php");
    //require_once ("loadsql.php");
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogUploadSql.php");

//Check for file upload errors; if there is an error store an empty string; otherwise the file name



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

?>
