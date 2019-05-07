// Demo 7 - Shopping Cart; LV
// Defines a shopping cart item object

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

//add namespace

using System.ComponentModel.DataAnnotations;

namespace Demo7.Models
{
    public class CartItem
    {
        public Product Product { get; set; }

        [Required(ErrorMessage = "Please enter quantity")]
        [Range(2, 1000, ErrorMessage = "Please enter an amount between 1 and 20")]
        public int Quantity { get; set; }
    }
}
