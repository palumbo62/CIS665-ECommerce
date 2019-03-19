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
                    }

                    .centerAlert { 
                        width: 80%;
                        height: 90%;
                        margin: auto;
                        position: relative;
                        border: 5px solid green; 
                        background-color: lightgray;
                    }

                    .centerAlert p {
                        margin: auto;
                        position: relative;
                        text-align: center;
                        font-size: 20pt;
                        top: 50%;
                        left: 50%;
                        -ms-transform: translate(-50%, -50%);
                        transform: translate(-50%, -50%);
                    }
                </style>
            </head>

            <body>
                <div class="centerAlert">
                    <p><b>$alert</b></p>
                </div>'
            </body>
         </html>;
STR;

    echo $output;
    die();
}

?>
