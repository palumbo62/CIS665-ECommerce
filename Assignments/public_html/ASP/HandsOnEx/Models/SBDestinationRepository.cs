using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace HandsOnEx.Models
{
    public class SBDestinationRepository
    {
        //Instantiate a List collection of SBDestination objects - kept private to 
        //prevent direct access to the structure
        private static List<SBDestination> sbDestinations = new List<SBDestination>();
        
        public static IEnumerable<SBDestination> GetDestinations
        {
            get
            {
                return sbDestinations;
            }
        }

        //Public static accessor to the list above - the enumerable allows the list to
        //be processed in a loop 
        public static IEnumerable<SBDestination> GetSBDestinations
        {
            get
            {
                return sbDestinations;
            }
        }

        //Needs a method to add an item to the list
        public static void AddDestination(SBDestination aDestination)
        {
            sbDestinations.Add(aDestination);
        }

    }
}
