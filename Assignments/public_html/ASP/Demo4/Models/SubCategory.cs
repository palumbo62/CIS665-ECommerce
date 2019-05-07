using System;
using System.Collections.Generic;

namespace Demo4.Models
{
    public partial class SubCategory
    {
        public SubCategory()
        {
            Product = new HashSet<Product>();
        }

        public int SubCategoryPk { get; set; }
        public int CategoryFk { get; set; }
        public string SubCategoryName { get; set; }
        public string SubCategoryImage { get; set; }
        public string Thumbnail { get; set; }
        public string Description { get; set; }

        public virtual Category CategoryFkNavigation { get; set; }
        public virtual ICollection<Product> Product { get; set; }
    }
}
