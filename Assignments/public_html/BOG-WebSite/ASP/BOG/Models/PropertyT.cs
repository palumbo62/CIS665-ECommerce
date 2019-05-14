using System;
using System.Collections.Generic;

namespace BOG.Models
{
    public partial class PropertyT
    {
        public PropertyT()
        {
            CommentsT = new HashSet<CommentsT>();
            ReservationT = new HashSet<ReservationT>();
        }

        public int PropertyIdPk { get; set; }
        public int PropertyTypeIdFk { get; set; }
        public string PropertyTitle { get; set; }
        public string Address { get; set; }
        public string City { get; set; }
        public string State { get; set; }
        public int Zipcode { get; set; }
        public decimal DailyPrice { get; set; }
        public short NumBedrooms { get; set; }
        public short NumBathrooms { get; set; }
        public short? SqFt { get; set; }
        public short? GuestCnt { get; set; }
        public byte[] Pic { get; set; }
        public string ImageName { get; set; }
        public string Description { get; set; }

        public virtual PropertyTypeT PropertyTypeIdFkNavigation { get; set; }
        public virtual ICollection<CommentsT> CommentsT { get; set; }
        public virtual ICollection<ReservationT> ReservationT { get; set; }
    }
}
