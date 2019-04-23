using BOG.Models;
using Microsoft.Extensions.Logging;
using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations;
using System.Linq;
using System.Threading.Tasks;

namespace BOG.ASP.Models
{   
    public class BogLoginCreds
    {
        // Context to access the database
        private PalumboDBContext aBogContext;

        // 1 = admin   2 = registered user
        private int roleType;

        // indicates if a user is currently logged into the system
        private bool loggedIn;

        private ILogger _logger { get; }

        public BogLoginCreds(ILogger<Program> logger, PalumboDBContext aContext)
        {
            _logger = logger;
            aBogContext = aContext;
            validCreds = false;

            _logger.LogDebug("NEED TO REMOVE HARD CODED USER LOGGED IN STATUS");
            loggedIn = true;

            _logger.LogDebug("NEED TO REMOVE HARD CODED ADMIN ROLE");

            roleType = 1;
        }

        [EmailAddress]
        [Required(ErrorMessage = "Please enter a valid email address")]
        [StringLength(50)]
        public string email { get; set; }

        [Required(ErrorMessage = "Please enter a valid password")]
        [StringLength(20)]
        public string password { get; set; }

        private bool validCreds { get; set; }

        public BogLoginCreds()
        {
            validCreds = true;

            loggedIn = true;

            roleType = 1;
        }

        public int userLoggedIn()
        {
            return loggedIn ? 1 : 0;
        }

        public bool userIsAdmin()
        {
            // 1 = admin 2 = registered user
            return roleType == 1;
        }

        public bool userIsMember()
        {
            // 1 = admin 2 = registered user
            return roleType == 2;
        }

        public int getRoleType()
        {
            return roleType;
        }

        // Validation of the current credentials
        public bool valid()
        {
            // Invoke the SQL code to check the credentials against the 
            // DB and return true if valid, false otherwise
            validCreds = true;

            // validate the user credentials here
            return (validCreds);
        }
    }
}
