using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.ComponentModel.DataAnnotations;

namespace RPFinalExam.Models
{
    public partial class UserInfo
    {
        public int UserPk { get; set; }

        //[Required(ErrorMessage = "Please enter first name")]
        [MaxLength(50)]
        [RegularExpression(@"^[a-zA-Z ]+$", ErrorMessage = "Upper and lower case letters")]
        public string UserFirstName { get; set; }

        //[Required(ErrorMessage = "Please enter last name")]
        [MaxLength(50)]
        [RegularExpression(@"^[a-zA-Z ]+$", ErrorMessage = "Upper and lower case letters")]
        public string UserLastName { get; set; }

        [ReadOnly(true)]
        public string UserLoginName { get; set; }

        [ReadOnly(true)]
        public string UserLoginPassword { get; set; }
    }
}
