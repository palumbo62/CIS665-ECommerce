using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.ModelBinding;
using BOG.ASP.Models;
using BOG.Models;
using Microsoft.Extensions.Logging;

namespace BOG.ASP.Libs
{
    public class BogSharedLib
    {
        public BogSharedLib()
        {
        }

        public bool validateLogin(BogLoginCreds aLogin)
        {
            string email = aLogin.email;
            string password = aLogin.password;

            // validate the user credentials here
            return (true);
        }
    }
}
