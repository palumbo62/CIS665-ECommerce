using System;
using System.Collections.Generic;

namespace Demo4.Models
{
    public partial class Product
    {
        public int ProductPk { get; set; }
        public int CategoryFk { get; set; }
        public int SubCategoryFk { get; set; }
        public string ModelNumber { get; set; }
        public string ModelName { get; set; }
        public string ProductImage { get; set; }
        public decimal UnitCost { get; set; }
        public string Description { get; set; }
        public string Thumbnail { get; set; }
        public string Availability { get; set; }

        public virtual Category CategoryFkNavigation { get; set; }
        public virtual SubCategory SubCategoryFkNavigation { get; set; }
    }
}
