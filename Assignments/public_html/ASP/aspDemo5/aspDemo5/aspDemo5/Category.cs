using System;
using System.Collections.Generic;

namespace Demo5.Models
{
    public partial class Category
    {
        public Category()
        {
            Product = new HashSet<Product>();
            SubCategory = new HashSet<SubCategory>();
        }

        public int CategoryPk { get; set; }
        public string CategoryName { get; set; }
        public string CategoryImage { get; set; }
        public string Thumbnail { get; set; }
        public string Description { get; set; }
        public string TinyThumb { get; set; }

        public virtual ICollection<Product> Product { get; set; }
        public virtual ICollection<SubCategory> SubCategory { get; set; }
    }
}
