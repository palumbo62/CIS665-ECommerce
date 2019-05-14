using System;
using System.Collections.Generic;

namespace BOG.Models
{
    public partial class ReservationT
    {
        public int ReservationIdPk { get; set; }
        public int PropertyIdFk { get; set; }
        public int UserIdFk { get; set; }
        public DateTime CheckIn { get; set; }
        public DateTime CheckOut { get; set; }
        public decimal TotalPayment { get; set; }
        public short? GuestCnt { get; set; }

        public virtual PropertyT PropertyIdFkNavigation { get; set; }
        public virtual UserT UserIdFkNavigation { get; set; }
    }
}
