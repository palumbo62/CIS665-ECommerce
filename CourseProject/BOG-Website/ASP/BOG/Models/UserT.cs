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
        [StringLength(50, MinimumLength = 8)]
        [EmailAddress]
        public string Email { get; set; }

        [Required(ErrorMessage = "Please enter a password")]
        //[MaxLength(20)]
        [StringLength(20, MinimumLength = 4)]
        [RegularExpression(@"^[a-zA-Z0-9@$!'.]{1,20}$", ErrorMessage = "4-20 alpha-numerics chars, $!'@.")]
        //[RegularExpression(@"(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}")]
        public string Password { get; set; }

        [Required(ErrorMessage = "Please enter first name")]
        [StringLength(30)]
        [RegularExpression(@"^[a-zA-Z]+$", ErrorMessage = "Upper and lower case letters")]
        public string FirstName { get; set; }

        [Required(ErrorMessage = "Please enter last name")]
        [StringLength(30)]
        [RegularExpression(@"^[a-zA-Z]+$", ErrorMessage = "Upper and lower case letters")]
        public string LastName { get; set; }

        [Required(ErrorMessage = "Please enter a home address")]
        [StringLength(30)]
        [RegularExpression(@"^[a-zA-Z0-9 '.]{1,30}$", ErrorMessage = "Upper and lower case letters")]
        public string Address { get; set; }

        [Required(ErrorMessage = "Please enter home city")]
        [StringLength(30)]
        [RegularExpression(@"^[a-zA-Z '.]+$", ErrorMessage = "Upper and lower case letters")]
        public string City { get; set; }

        [Required(ErrorMessage = "Please select home state from the drop down list")]
        public string State { get; set; }

        [Required(ErrorMessage = "Please enter a zipcode")]
        [Range(10000, 99999)]
        [RegularExpression(@"^[0-9]{5}$", ErrorMessage = "5-numeric digits")]
        public int Zipcode { get; set; }

        [Required(ErrorMessage = "Please enter a phone number")]
        [Phone]
        [RegularExpression(@"^[0-9]{10}$", ErrorMessage = "10-numeric digits")]
        public long PhoneNumber { get; set; }

        public long? Ccnumber { get; set; }
        public DateTime? CcexpDate { get; set; }
        public short? Cccvc { get; set; }

        public virtual ICollection<CommentsT> CommentsT { get; set; }
        public virtual ICollection<ReservationT> ReservationT { get; set; }
    }
}
