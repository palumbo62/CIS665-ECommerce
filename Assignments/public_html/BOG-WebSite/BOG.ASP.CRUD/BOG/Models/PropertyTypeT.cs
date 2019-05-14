using System;
using System.Collections.Generic;

namespace BOG.Models
{
    public partial class PropertyTypeT
    {
        public PropertyTypeT()
        {
            PropertyT = new HashSet<PropertyT>();
        }

        public int PropertyTypeIdPk { get; set; }
        public string PropertyTypeName { get; set; }

        public virtual ICollection<PropertyT> PropertyT { get; set; }
    }
}
