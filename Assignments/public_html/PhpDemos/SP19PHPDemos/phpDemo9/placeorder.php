<?php
/*
    Purpose: Online Store
    Author: LV
    Date: March 2019
*/

require_once ('ShopCart.php');

session_start();

// if the session variable is not set or is empty display appropriate message; otherwise display the items

if (!isset($_SESSION['aCart']) || count($_SESSION['aCart']->getCartItems()) === 0)
{
    header('Refresh: 5; URL=shopsearch.php');
    echo '<h2>You shopping cart is empty <br /> You will be redirected to our store in 5 seconds.</h2>';
    echo '<h2>If you are not redirected, please <a href="shopsearch.php">Click here to visit our Store</a>.</h2>';
    die();
}

require_once('logincheck.php');

require_once ('shopsql.php');

// call the insertOrder method; get the orderPK of the newly added order

$orderIDResult = insertOrder($_SESSION['userInfo']['contactpk']);

$newOrderID = $orderIDResult[0]['newOrderID'];

// for each item in the shopping cart, 
// insert a row into the merchandiseorderitems table

foreach($_SESSION['aCart']->getCartItems() as $aKey => $aValue)
{
    
    insertOrderItem($newOrderID, $aKey, $aValue);

    // delete the item from the cart
    
    $_SESSION['aCart']->deleteCartItem($aKey);
}

include_once ('../siteCommon.php');

displayPageHeader("Order Confirmation");

$output = <<<ABC
<section>
<h2 style="text-align: center">Thank you for your order</h2>
<p style="text-align: center">
    <a href="shopsearch.php">[Back to our store]</a>
</p>
</section>
ABC;

// display the output

echo $output;

displayPageFooter();

?>
