// Demo 5 - CRUD Basics; LV

using System;
using System.Collections.Generic;

//added namespace

using System.ComponentModel.DataAnnotations;

namespace Demo5.Models
{
    public partial class Product
    {
        //validation rules added

        public int ProductPk { get; set; }
        public int CategoryFk { get; set; }
        public int SubCategoryFk { get; set; }

        [Required(ErrorMessage = "Please enter a model number")]
        [MaxLength(50)]
        public string ModelNumber { get; set; }

        [Required(ErrorMessage = "Please enter a model name")]
        [MaxLength(50)]
        public string ModelName { get; set; }

        [Required(ErrorMessage = "Please enter a file name for product image")]
        [MaxLength(50)]
        [RegularExpression(@"^[\w-]{1,36}.jpg$", ErrorMessage = "Please enter a valid jpg file name")]
        public string ProductImage { get; set; }

        [Required(ErrorMessage = "Please enter a unit cost")]
        [Range(2, 1000, ErrorMessage = "Please enter an amount between 2 and 1000")]
        public decimal UnitCost { get; set; }

        [Required(ErrorMessage = "Please enter a description")]
        [MaxLength(2000)]
        public string Description { get; set; }

        [MaxLength(50)]
        [RegularExpression(@"^[\w-]{1,36}.gif$", ErrorMessage = "Please enter a valid gif file name")]
        public string Thumbnail { get; set; }

        [MaxLength(50)]
        public string Availability { get; set; }

        public virtual Category CategoryFkNavigation { get; set; }
        public virtual SubCategory SubCategoryFkNavigation { get; set; }
    }
}
