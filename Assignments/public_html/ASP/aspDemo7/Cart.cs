// Demo 7 - Shopping Cart; LV
// Defines a cart object

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Newtonsoft.Json;

namespace Demo7.Models
{
    public class Cart
    {
        // a list collection to hold cart item objects

        [JsonProperty] private List<CartItem> cartItems = new List<CartItem>();

        // setting the maximum order quantity to 20
        
        const int MaxQuantity = 20;

        public void AddItem(Product aProduct)
        {
            CartItem aItem = cartItems.Where(p => p.Product.ProductPk == aProduct.ProductPk).FirstOrDefault();

            // If it is a new item

            if (aItem == null)
            {
                cartItems.Add(new CartItem { Product = aProduct, Quantity = 1 });
            }

            else
            {
                // Increase quantity by 1 if the current quantity is less than 20

                if (aItem.Quantity < MaxQuantity)
                {
                    aItem.Quantity += 1;
                }
            }
        }

        public void UpdateItem(Product aProduct, int quantity)
        {
            CartItem aItem = cartItems.Where(p => p.Product.ProductPk == aProduct.ProductPk).FirstOrDefault();

            if (aItem != null)
            {
                aItem.Quantity = (quantity <= MaxQuantity) ? quantity : MaxQuantity;
            }
        }

        public void RemoveItem(Product aProduct)
        {
            cartItems.RemoveAll(r => r.Product.ProductPk == aProduct.ProductPk);
        }

        public void ClearCart()
        {
            cartItems.Clear();
        }

        public decimal ComputeOrderTotal()
        {
            return cartItems.Sum(s => s.Product.UnitCost * s.Quantity);
        }

        public IEnumerable<CartItem> CartItems()
        {
            return cartItems;
        }
    }
}
