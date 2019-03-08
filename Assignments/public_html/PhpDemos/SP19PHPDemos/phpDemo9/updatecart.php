<?php
/* 
    Purpose: Online Store
    Author: LV
    Date: March 2019
*/

require_once ('ShopCart.php');

session_start();

// if the form element merchandisepk is set

if (isset($_POST['merchandisepk']))
{
    // if the session element aCart is not set

    if (!isset($_SESSION['aCart']))
    {
        // instantiate a shopCart object

        $_SESSION['aCart'] = new shopCart();
    }
    
        // if the form element merchandiseqty is set (if the user updates the quanity for a product in their shopping cart)

    if (isset($_POST['merchandiseqty']))
    {
        // call the updateCartItem method

        $_SESSION['aCart']->updateCartItem($_POST['merchandisepk'],$_POST['merchandiseqty']);
    }
    else
    {
        // call the addCartItem method
        $_SESSION['aCart']->addCartItem($_POST['merchandisepk']);
    }
}

header('location:viewcart.php');
exit();
?>
