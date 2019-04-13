using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

using BOG.ASP.Models;

namespace BOG.ASP.Libs
{
    public class BogLoginCheck
    {
        public bool validateLogin(BogLoginCreds aLogin)
        {
            string email = aLogin.email;
            string password = aLogin.password;

            
            // validate the user credentials here
            return (true);
        }
    }
}
