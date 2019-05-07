// Demo 2 - C# Review; LV
// A sample class to demonstrate extension method

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace Demo2.Models
{
    public class CarInventory
    {
        // one collection property to store car objects
        public IEnumerable<Car> Cars { get; set; }
    }
}
