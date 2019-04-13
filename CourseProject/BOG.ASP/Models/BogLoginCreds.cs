using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace BOG.ASP.Models
{
    public class BogLoginCreds
    {
        [EmailAddress]
        [Required(ErrorMessage = "Please enter a valid email address")]
        [StringLength(50)]
        public string email { get; set; }

        [Required(ErrorMessage = "Please enter a valid password")]
        [StringLength(20)]
        public string password { get; set; }

        private bool validCreds { get; set; }

        public BogLoginCreds()
        {
            validCreds = false;
        }

        // Validation of the current credentials
        public bool valid()
        {
            // Invoke the SQL code to check the credentials against the 
            // DB and return true if valid, false otherwise
            validCreds = true;

            // validate the user credentials here
            return (validCreds);
        }
    }
}
