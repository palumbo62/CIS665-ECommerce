using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

using System.ComponentModel.DataAnnotations;

namespace HandsOnEx6.Models
{
    public class LoginInput

    {
        [Required(ErrorMessage = "Please enter a username")]
        [MaxLength(50)]
        public string Username { get; set; }

        [Required(ErrorMessage = "Please enter a password")]
        [MaxLength(50)]
        [UIHint("password")]
        public string UserPassword { get; set; }

        //This property is used to keep track of the URL the user was trying to
        //get to before they got redirected to the login page.  The page
        // they wanted was restricted
        public string ReturnURL { get; set; }
    }
}
