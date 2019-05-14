using BOG.Models;
using Microsoft.Extensions.Logging;
using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace BOG.Models
{   
    public class BogPassword
    {
        public string CurrPassword { get; set; }

        public string NewPassword { get; set; }

        public string ConfPassword { get; set; }
    }
}
