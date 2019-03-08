<?php
/*    Purpose: Online Store
    Author: LV
    Date: March 2019
 */

class shopCart
{
   //Properties

    private $cartItems;

   // Constructor

    public function __construct()
    {
        $this->cartItems = array();
    }

   // adds an item to the $cartItems array

    public function addCartItem($merchandiseID)
    {
        // if the item is not already in the array, add the item to the array

        if (!array_key_exists($merchandiseID, $this->cartItems))
        {
            $this->cartItems[$merchandiseID] = 1;
        }

        // else, increase the quantity for the item by one
        else
        {
            $this->cartItems[$merchandiseID] ++;
        }
    }

    // returns the $cartItems array

    public function getCartItems()
    {
        return $this->cartItems;
    }

    // returns the quantity for a specific item

    public function getQtyByMerchandiseID($merchandiseID)
    {
        return $this->cartItems[$merchandiseID];
    }

    // update the quantity for a specific item

    public function updateCartItem($merchandiseID, $orderQty)
    {
        if ((int)$orderQty === 0)
        {
            $this->deleteCartItem($merchandiseID);
        }
        else
        {
            $this->cartItems[$merchandiseID] = (int)$orderQty;
        }
    }

    // delete a specific item from the array

    public function deleteCartItem($merchandiseID)
    {
        unset($this->cartItems[$merchandiseID]);
    }
}

?>
