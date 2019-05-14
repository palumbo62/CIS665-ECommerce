using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;

namespace BOG.Models
{
    public partial class UserT
    {
        public UserT()
        {
            CommentsT = new HashSet<CommentsT>();
            ReservationT = new HashSet<ReservationT>();
        }

        public int UserIdPk { get; set; }
        public int RoleIdFk { get; set; }

        [Required(ErrorMessage = "Please enter a valid email address")]
        [EmailAddress]
        public string Email { get; set; }

        [Required(ErrorMessage = "Please enter a password")]
        [MaxLength(20)]
        [RegularExpression(@"^[a-zA-Z0-9@$!'.]{8,20}$", ErrorMessage = "8-20 alpha-numerics chars, $!'@.")]
        //[RegularExpression(@"(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}")]
        public string Password { get; set; }
         
        [Required(ErrorMessage = "Please enter first name")]
        [MaxLength(30)]
        [RegularExpression(@"^[a-zA-Z]+$", ErrorMessage = "Upper and lower case letters")]
        public string FirstName { get; set; }

        [Required(ErrorMessage = "Please enter last name")]
        [MaxLength(30)]
        [RegularExpression(@"^[a-zA-Z]+$", ErrorMessage = "Upper and lower case letters")]
        public string LastName { get; set; }

        [Required(ErrorMessage = "Please enter a home address")]
        [MaxLength(30)]
        [RegularExpression(@"^[a-zA-Z0-9 '.]{1,30}$", ErrorMessage = "Upper and lower case letters")]
        public string Address { get; set; }

        [Required(ErrorMessage = "Please enter home city")]
        [MaxLength(30)]
        [RegularExpression(@"^[a-zA-Z '.]+$", ErrorMessage = "Upper and lower case letters")]
        public string City { get; set; }

        [Required(ErrorMessage = "Please select home state from the drop down list")]
        public string State { get; set; }

        [Required(ErrorMessage = "Please enter a zipcode")]
        [RegularExpression(@"^[0-9]{5}$", ErrorMessage = "5-numeric digits")]
        public string Zipcode { get; set; }

        [Required(ErrorMessage = "Please enter a phone number")]
        [RegularExpression(@"^[0-9]{10}$", ErrorMessage = "10-numeric digits")]
        public string PhoneNumber { get; set; }

        public long? Ccnumber { get; set; }
        public DateTime? CcexpDate { get; set; }
        public short? Cccvc { get; set; }

        public virtual ICollection<CommentsT> CommentsT { get; set; }
        public virtual ICollection<ReservationT> ReservationT { get; set; }
    }
}
