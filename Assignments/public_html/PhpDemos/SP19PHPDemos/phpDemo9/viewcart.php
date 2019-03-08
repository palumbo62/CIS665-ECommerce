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

require_once ('shopsql.php');

// get a list of merchandiseIDs for the cart items; string them together delimiting with a comma

$merchandiseIDs = join(array_keys($_SESSION['aCart']->getCartItems()),',');

//get merchandise details for the items in the cart

$cartList = getMerchandiseInCart($merchandiseIDs);

require_once ('../siteCommon.php');

displayPageHeader("Shopping Cart");

// get a count of the number of items in the cart

$cartItems = count($cartList);

// prepare the output using heredoc syntax

$output = <<<HTML
<section>
<h2 style="text-align: center">You have $cartItems product(s) in your cart</h2>

<table>
    <tr>
        <th>Item Name</th>
        <th>Item Quantity</th>
        <th>Unit Price</th>
        <th>Extended price</th>
    </tr>
HTML;

foreach ($cartList as $aItem)
{
    extract($aItem);
    $merchandiseQty = $_SESSION['aCart']->getQtyByMerchandiseID($merchandisepk);
    $extendedPrice = $merchandiseQty * $merchandiseprice;
    $totalPrice += $extendedPrice;
    $formattedExtendedPrice = number_format($extendedPrice, 2);
    $formattedPrice = number_format($merchandiseprice, 2);
    $output .= <<<HTML
    <tr>
        <td>
            $merchandisename
        </td>
        <td>
            <form action="updatecart.php" method="post">
                <input type="hidden" name="merchandisepk" value="$merchandisepk" />
                <input type="number" name="merchandiseqty" value="$merchandiseQty" size="2" maxlength="2" required="required" min="0" max="20" />
                <input type="submit" name=submit" value="Update Quantity" />
            </form>
        </td>
        <td style="text-align: right">
            $$formattedPrice
        </td>
        <td style="text-align: right">
            $$formattedExtendedPrice
        </td>
    </tr>
HTML;
}
$formattedTotalPrice = number_format($totalPrice,2);
$output .= <<<HTML
    <tr>
        <td colspan="2" style="text-align: center">
            <b>Your order total is: $$formattedTotalPrice</b>
        </td>
        <td colspan="2" style="text-align: center">
        <form action="checkout.php" method="post">
            <input type="submit" name="submit" id="proceed" value = "Proceed to Checkout" />
        </form>
        </td>
    </tr>
</table>
<p style="text-align: center">
    <a href="shopsearch.php">[Continue shopping]</a>
</p>
</section>
HTML;

// display the output

echo $output;

displayPageFooter();

?>


