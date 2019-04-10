using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace BOG.ASP.Models
{
    public class BogUserProfile
    {
        public string email { get; set; }

        public string password { get; set; }

        public string confpass { get; set; }
        
        public string firstName { get; set; }

        public string lastName { get; set; }

        public string address { get; set; }

        public string city { get; set; }

        public string state { get; set; }

        public string zipcode { get; set; }

        public string phoneNumber { get; set; }

        public string roletype { get; set; }

    }
}
