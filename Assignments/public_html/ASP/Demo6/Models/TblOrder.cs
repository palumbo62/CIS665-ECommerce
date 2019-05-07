// Demo 6 - Authentication Basics; LV

using System;
using System.Collections.Generic;

namespace Demo6.Models
{
    public partial class TblOrder
    {
        public TblOrder()
        {
            TblOrderDetail = new HashSet<TblOrderDetail>();
        }

        public int OrderPk { get; set; }
        public DateTime? OrderDate { get; set; }
        public int CustomerFk { get; set; }

        public virtual LoginInfo CustomerFkNavigation { get; set; }
        public virtual ICollection<TblOrderDetail> TblOrderDetail { get; set; }
    }
}
