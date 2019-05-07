using System;
using System.Collections.Generic;

//XRLP
using System.ComponentModel.DataAnnotations;

namespace HandsOnEx4.Models
{
    public partial class Product
    {
        public int ProductPk { get; set; }
        public int CategoryFk { get; set; }
        public int SubCategoryFk { get; set; }

        //XRLP
        [Required(ErrorMessage = "Please enter a model number")]
        [MaxLength(50)]
        public string ModelNumber { get; set; }

        //XRLP
        [Required(ErrorMessage = "Please enter a model name")]
        [MaxLength(50)]
        public string ModelName { get; set; }

        //XRLP
        [Required(ErrorMessage = "Please enter a file name for product image")]
        [MaxLength(50)]
        [RegularExpression(@"^[a-zA-Z0-9]+.(jpg|jpeg)$", 
            ErrorMessage = "Please enter a valid jpg/jpeg file name")]
        public string ProductImage { get; set; }

        //XRLP
        [Required(ErrorMessage = "Please enter a unit cost")]
        [Range(2,1000, ErrorMessage = "Please enter an amount between 2 and 1000")]
        public decimal UnitCost { get; set; }

        //XRLP
        [Required(ErrorMessage = "Please enter a description")]
        [MaxLength(2000)]
        public string Description { get; set; }

        //XRLP
        [Required(ErrorMessage = "Please enter a file name for the thumbnail")]
        [MaxLength(50)]
        [RegularExpression(@"^[a-zA-Z0-9]+.gif$", ErrorMessage = "Please enter a valid gif file name")]
        public string Thumbnail { get; set; }

        //XRLP
        public string Availability { get; set; }

        public virtual Category CategoryFkNavigation { get; set; }
        public virtual SubCategory SubCategoryFkNavigation { get; set; }
    }
}
