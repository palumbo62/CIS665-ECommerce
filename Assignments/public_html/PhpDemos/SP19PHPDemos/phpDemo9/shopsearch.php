<?php
/*
    Purpose: Online Store
    Author: LV
    Date: March 2019
 */

// if the form is submitted

if (isset($_POST['search'])) 
{
    $merchandisename =  trim($_POST['merchandisename']);

    // cookies are set to expire 30 days from now (given in seconds)
    // store the search term as a cookie

    $expire = time() + (60 * 60 * 24 * 30);
    setcookie('lastsearch', $merchandisename, $expire);
}

// If a previous user is visting this page

elseif (isset($_COOKIE['lastsearch'])) 
{
    $merchandisename =  $_COOKIE['lastsearch'];
}

// If a user is visiting this page for the first time

else 
{
    $merchandisename =  '';
}

include_once ('shopsql.php');

include_once ('../siteCommon.php');

// get records that match the search term

if (isset($_POST['search']) || isset($_COOKIE['lastsearch']))
{
    $results = getMerchandiseByName($merchandisename);
    $resultsCount = count($results);
}
displayPageHeader("Product Search")
?>

<!-- display the search form -->
<section>
   
<div>
    <a href="viewcart.php">View Cart</a>
</div>
   
<form action="shopsearch.php" method = "post">
   <h2 style="text-align: center">Movie Store</h2>
   
   <label for="merchandisename">Merchandise name:</label>
      <input type="text" name="merchandisename" id ="merchandisename" maxlength="50" autofocus pattern="^[a-zA-Z\s]*$" title="Letters only"value="<?php echo $merchandisename; ?>" />
      <p>
         <input type="submit" value="Search" name="search" />
      </p>
</form>

<?php

// if the form was submitted (for a new search) or a previous user is revisiting this page,
// display results for the current search or his/her last search

if ((isset($_POST['search']) || isset($_COOKIE['lastsearch'])) && $resultsCount > 0)
{
    $counter = 0;

    $output = <<<ABC
    <table id="merchandise">
      <tr>
ABC;

    foreach ($results as $aResult) {
        extract($aResult);
        $merchandiseprice = number_format($merchandiseprice,2,'.',',');
        $output .= <<<ABC
            <td>
ABC;
        if ($imagenamesmall != '') {
            $output .= <<<ABC
<img src="images/$imagenamesmall"><br />
ABC;
        }
        $output .=<<<ABC
<strong> <a href="shopdetail.php?merchandisepk=$merchandisepk"> $merchandisename </a> <strong> <br />
<i> \$$merchandiseprice </i> <br />
</td>
ABC;
        $counter ++;

        if ($counter === $resultsCount) {
            $output .= <<<ABC
                </tr> </table>
ABC;
        }
        elseif ($counter % 2 == 0) {
            $output .= <<<ABC
                </tr><tr>
ABC;
        }
    }

    echo $output;
    echo "</section>";
}

displayPageFooter();

?>