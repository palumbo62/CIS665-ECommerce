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
        private PalumboDBContext _bogDbContext;

        private ILogger _logger { get; }

        public BogSharedLib()
        {

        }
        public BogSharedLib(ILogger<Program> logger, PalumboDBContext aContext)
        {
            _logger = logger;
            _bogDbContext = aContext;
        }

        public bool validateLogin(BogLoginCreds aLogin)
        {
            string email = aLogin.email;
            string password = aLogin.password;

            // validate the user credentials here
            return (true);
        }

        public void logModelState(ModelStateDictionary model)
        {
            
            var errors = model.Values.SelectMany(v => v.Errors);

            foreach (ModelError e in errors)
            {
                _logger.LogDebug($"****** ModelError: {e.ErrorMessage}");
            }
        }
    }
}
