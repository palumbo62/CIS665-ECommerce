// Demo 6 - Authentication Basics; LV

using System;
using System.Collections.Generic;

namespace Demo6.Models
{
    public partial class TblOrderDetail
    {
        public int OrderDetailPk { get; set; }
        public int ProductFk { get; set; }
        public int OrderFk { get; set; }
        public int Quantity { get; set; }

        public virtual TblOrder OrderFkNavigation { get; set; }
        public virtual Product ProductFkNavigation { get; set; }
    }
}
