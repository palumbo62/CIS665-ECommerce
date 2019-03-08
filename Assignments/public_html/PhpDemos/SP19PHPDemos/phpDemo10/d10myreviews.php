<?php
/*
    Purpose: Demo10 - Edit/Delete My Reviews
    Author: LV
    Date: March 2019
    Uses: siteCommon2.php, d10sql.php
*/

session_start();

require_once ("d10logincheck.php");

require_once ("../siteCommon2.php");
require_once ("d10Sql.php");

// call the displayPageHeader method in siteCommon2.php

displayPageHeader("Edit/Delete your Reviews");

$reviewList = getUserReviews($_SESSION['userInfo']['contactpk']);  //gets the list of reviews for a user

// get a count of the number of reviews returned by the method

$reviewsCount = count($reviewList);

echo "<section>";

if ($reviewsCount === 0)
{
    echo '<h3>You don\'t have reviews. <a href="d9search.php">Find movies to review</a></h3>';
}
else
{
$output = <<<HTML
<table>
      <caption>{$_SESSION['userInfo']['firstname']}, you have $reviewsCount review(s)</caption>
      <tbody>
HTML;

// display each review with a link to edit the review or a button to delete it

foreach ($reviewList as $review)
{
    extract($review);
    $reviewpk = urlencode(trim($reviewpk));
    $reviewDate = date_format(new DateTime($reviewdate), "F j, Y");
    $output .= <<<HTML
    <tr>
        <td>
            $movietitle
        </td>
        <td colspan="3">
            $reviewsummary
        </td>
    </tr>
    <tr>
        <td>
            $reviewrating Reels
        </td>
        <td>
            Review Date: $reviewDate
        </td>
        <td>
            <a href="d10editreview.php?reviewpk=$reviewpk">[Edit]</a>
        </td>
        <td>
            <form action="d10deletereview.php" method="post">
            <input type="hidden" name="reviewpk" value="$reviewpk" />
            <input type="submit" value="Delete" onclick="return confirm('Delete Review?');" />
            </form>
         </td>
    </tr>
HTML;
}
$output .= "<tbody></table>";
echo $output;
}
echo "</section><br />";
// call the displayPageFooter method in siteCommon2.php

displayPageFooter();

?>
