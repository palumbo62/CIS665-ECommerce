using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace BOG.ASP.Models
{
    public class BogAppContext
    {
        // Context for the current user after successful login
        public UserT currUser = new UserT();

        public class UserInfo
        {
            public int Roletype
            {
                get; set;
            }

            public string Firstname
            {
                get; set;
            }

            public string Lastname
            {
                get; set;
            }

            public int Id
            {
                get; set;
            }
        }

        public bool UserLoggedIn
        {
            get; set;
        }

        public int CurrPropId
        {
            get; set;
        }
        
    }
}
