using Microsoft.AspNetCore.Mvc.Rendering;
using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace BOG.Models
{
    public class BogHomeSearch
    {
        public string proptype { get; set; }

        [MaxLength(30)]
        [RegularExpression(@"^[a-zA-Z '.]+$", ErrorMessage = "Upper and lower case letters")]
        public string city { get; set; }

        public string state { get; set; }

        [MaxLength(5)]
        [RegularExpression(@"^[0-9]{5}$", ErrorMessage = "5-numeric digits")]
        public string zipcode { get; set; }

        public List<SelectListItem> propTypeLlist;
    }
}