using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace BOG.ASP.Models
{
    public class BogAddProperty
    {
        public string propType { get; set; }

        public string propDesc { get; set; }

        public string title { get; set; }

        public string address { get; set; }

        public string city { get; set; }

        public string state { get; set; }

        public string zipcode { get; set; }

        public decimal dailyPrice { get; set; }

        public int numBeds { get; set; }

        public int numBaths { get; set; }

        public int guestCnt { get; set; }

        public int sqft { get; set; }

        public int imageFname { get; set; }

    }
}
