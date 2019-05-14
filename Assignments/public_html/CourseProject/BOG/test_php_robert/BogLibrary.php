<?php
/*
Purpose: Demo1 - User-built Functions
Author: LV
Date: January 2017
*/

function displayDate ()
{
    return 'Today\'s date is ' . date('F j, Y, g:i A');
}

function getButtonValue($btnName) {
    echo "<script>document.getElementById('$btnName').value)</script>";
}

function alertRedirect($refresh, $url, $alert) {
    if (!isset($refresh)) {
        $refresh = 2;
    }
    
    if (!isset($url)) {
        $url = "BogHome.php";
    }

    header("Refresh: $refresh; $url");
//    echo '<h2 align="center">'.$alert.'</h2>'; 
    
    $output = <<<STR
            
        <!DOCTYPE html>
        <html>
            <head>
                <style>
                    html {
    height: 100%;
    background-size: cover;
    background-color: #383b43;
}

body {
    width:100%;
}



body, input, select, textarea, input {
    color: #444;
    font-family: "Raleway", Helvetica, sans-serif;
    font-size: 10pt;
    font-weight: 400;
    line-height: 1.65em;
    position: relative;
}
            
#bannerList {
    background-image: url(../images/dark_tint.png);
    background-position: center;
    background-color: #1E90FF;
    color: #ffffff;
    padding: 10em 0em 1em;
    text-align: center;
}
            

#bannerList p {
            color: white;
            font-size: 3em;
            line-height: 1.25em;
            margin: 0 0 0.5em 0;
            padding: 40;
        }

        
#bannerList input {       
            color: #444;
            font-family: "Raleway", Helvetica, sans-serif;
            font-size: 10pt;
            font-weight: 400;
            line-height: 1.65em;
            position: relative;
        }

                </style>
            </head>

            <body>
            <section id="bannerList">       
                    <p><b>$alert</b></p>
            </section>
               
            </body>
         </html>;
STR;

    echo $output;
    die();
}

// Function to upload a property image
function bogUploadImage() {
    $fileName = ($_FILES['uploadfile']['error'] != UPLOAD_ERR_OK) 
                        ? '' : $_FILES['uploadfile']['tmp_name'];     

    if (!empty($fileName)) {
        $fileType = exif_imagetype($fileName);  // get the file type

        switch ($fileType) {
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

    if (!empty($image)) {
        $tmpName = $_FILES['uploadfile']['tmp_name'];
        
        $imageName = basename($_FILES['uploadfile']['name']);  // removes path info (if present) and extracts just the file name
        $path = getcwd() + '..\\images\\' . $imageName;
        $path = '..\\images\\' . $imageName;  // set the path (including the file name), where the file is to be saved

        echo "NewImage='$image'  imageName='$imageName'  tmpName='$tmpName'  fullPath='$path'  fileType='$fileType'<br>";
        switch ($fileType) {
            case IMAGETYPE_GIF:  //if it is a GIF file
                imagegif($image, $path);
                break;
            case IMAGETYPE_JPEG: // if it is a JPEG file
                imagejpeg($image, $path);
                break;
        }
        echo "WorkingDir='" . getcwd() . "'<br>";
//        if (($res = copy($_FILES['uploadfile']['tmp_name'], $path))) {
//            echo "The file ". $_FILES['uploadfile']['tmp_name'] . " has been uploaded!<br>"; die();
//        } else {
//            echo "Sorry, there was an error uploading your file." . $_FILES['uploadfile']['tmp_name'];
//            echo "<br>Result='$res'  Error: '" . $_FILES['uploadfile']['error'] . "'<br>"; 
//            die();
//        }

        imagedestroy($image);
    } else {
        $imageName = '';
    }

    echo "FINAL IMAGE='$imageName'<br>"; 
    die();

    return $imageName;
}

?>
