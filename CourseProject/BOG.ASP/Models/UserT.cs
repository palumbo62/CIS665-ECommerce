using System;
using System.Collections.Generic;

namespace BOG.ASP.Models
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
        public string Email { get; set; }
        public string Password { get; set; }
        public string FirstName { get; set; }
        public string LastName { get; set; }
        public string Address { get; set; }
        public string City { get; set; }
        public string State { get; set; }
        public int Zipcode { get; set; }
        public long PhoneNumber { get; set; }
        public long? Ccnumber { get; set; }
        public DateTime? CcexpDate { get; set; }
        public short? Cccvc { get; set; }

        public virtual ICollection<CommentsT> CommentsT { get; set; }
        public virtual ICollection<ReservationT> ReservationT { get; set; }
    }
}
