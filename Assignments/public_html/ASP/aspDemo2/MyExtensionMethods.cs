// Demo 2 - C# Review; LV
// assume that I need a new method to calculate the total value of the cars in CarInventory
// assume that the CarInventory class was created by someone else, and I cannot modify the class directly
// then, I can write an extension method to add the functionality I need (i.e., calculate the total value of the cars in CarInventory
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace Demo2.Models
{
    public static class MyExtensionMethods
    {

        // the this parameter in front of the first parameter indicates that this is an extension method
        // the parameter is the class to which the extension method is to be applied 
        public static decimal TotalValue(this CarInventory inventoryParam)
        {
            decimal total = 0;
            foreach (Car aCar in inventoryParam.Cars)
            {
                total += aCar?.CarPrice ?? 0;
            }

            return total;
        }

        // an extension method applied to an interface

        public static decimal TotalValue1(this IEnumerable<Car> carParam)
        {
            decimal total = 0;
            foreach (Car aCar in carParam)
            {
                total += aCar?.CarPrice ?? 0;
            }

            return total;
        }
    }
}
