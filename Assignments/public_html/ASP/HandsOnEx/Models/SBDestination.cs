using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

// RLP - requires and added for validation 
using System.ComponentModel.DataAnnotations;

namespace HandsOnEx.Models
{
    public class SBDestination
    {
        // For all properties in a Model you can specify validation properties


        //Name is required and 30 chars
        [Required(ErrorMessage = "Please enter your name:")]
        [StringLength(30)]
        public string Name { get; set; }

        [Required(ErrorMessage = "Please enter a destination")]
        [StringLength(50)]
        public string Destination { get; set; }

        [Range(0,10000, ErrorMessage ="Please enter and amount between 0 and 10000")]
        public decimal Cost { get; set; }

        [Required(ErrorMessage = "Please select a transportation option")]
        public string TravelMode { get; set; }
    }
}
