// Demo 6 - Authentication Basics; LV

using System;
using System.Collections.Generic;

//add namespace

using System.ComponentModel.DataAnnotations;

namespace Demo6.Models
{
    public partial class LoginInfo
    {
        public LoginInfo()
        {
            TblOrder = new HashSet<TblOrder>();
        }

        //validation rules added
        public int UserPk { get; set; }

        [Required(ErrorMessage = "Please enter a username")]
        [MaxLength(50)]
        [RegularExpression(@"^[a-zA-Z]+$", ErrorMessage = "Upper and lower case letters")]
        public string Username { get; set; }

        [Required(ErrorMessage = "Please enter a password")]
        [MaxLength(50)]
        [RegularExpression(@"^[a-zA-Z0-9\*\$]+$", ErrorMessage = "Letters, digits, *, $")]
        public string UserPassword { get; set; }

        [Required(ErrorMessage = "Please enter your full name")]
        [MaxLength(50)]
        [RegularExpression(@"^[a-zA-Z]+\s[a-zA-Z]+$", ErrorMessage = "First and Last Name; Upper and lower case letters")]
        public string FullName { get; set; }
        public string UserRoles { get; set; }

        public virtual ICollection<TblOrder> TblOrder { get; set; }
    }
}
