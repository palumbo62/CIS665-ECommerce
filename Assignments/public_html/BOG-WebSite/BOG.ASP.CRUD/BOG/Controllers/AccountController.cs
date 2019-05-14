//Demo 6 - Authentication Basics; LV

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

//add the following namespaces

using Microsoft.EntityFrameworkCore;
using Microsoft.AspNetCore.Authentication;
using Microsoft.AspNetCore.Authentication.Cookies;
using System.Security.Claims;

using BOG.Controllers;
using BOG.Models;
using Microsoft.AspNetCore.Mvc.ModelBinding;
using Microsoft.Extensions.Logging;
using Microsoft.AspNetCore.Mvc.Rendering;

namespace BOG.Controllers
{
    public class AccountController : Controller
    {
        private readonly PalumboDBContext _context;

        private ILogger _logger { get; }

        public AccountController(PalumboDBContext context, ILogger<Program> aLogger)
        {
            _context = context;
            _logger = aLogger;
        }

        // the returnURL captures the View the user was trying to reach before being redirected to the Login View

        public IActionResult Login(string returnURL)
        {
            // if returnURL is null or empty, it is set to "/" (i.e., Home/Index)

            returnURL = String.IsNullOrEmpty(returnURL) ? "/" : returnURL;

            // create a new instance of LoginInput and pass it to the Login View

            return View(new LoginInput { ReturnURL = returnURL });
        }


        // Post action (when user submits the Login form)

        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Login([Bind("UserEmail,UserPassword,ReturnURL")] LoginInput loginInput)
        {
            if (ModelState.IsValid)
            {
                // check if login credentials are valid

                var aUser = await _context.UserT.FirstOrDefaultAsync(u => u.Email == loginInput.UserEmail && u.Password == loginInput.UserPassword);

                // if valid

                if (aUser != null)
                {
                    // From Microsoft documentation - "A claim is a statement about a subject by an issuer. Claims represent attributes of the subject that are useful in the context of authentication and authorization operations"

                    // Examples of claims would be data on a Driver's License card (i.e., name, date of birth)

                    var claims = new List<Claim>();

                    // the Type property can be used to store information about the claim

                    claims.Add(new Claim(ClaimTypes.Name, aUser.FirstName + aUser.LastName));
                    claims.Add(new Claim(ClaimTypes.Sid, aUser.UserIdPk.ToString()));

                    // role(s) are stored as a comma-delimited list in the "UserRoles" column in the LoginInfo table

                    //RolesT role = await _context.RolesT.Where(p => p.RoleIdPk == aUser.RoleIdFk).FirstOrDefaultAsync();
                    var roles = _context.RolesT.Where(p => p.RoleIdPk == aUser.RoleIdFk);

                    foreach (RolesT role in roles)
                    {
                        claims.Add(new Claim(ClaimTypes.Role, role.RoleName.Trim()));
                    }

                    // From Microsoft documentation - "The ClaimsIdentity class is a concrete implementation of a claims-based identity; that is, an identity described by a collection of claims."

                    // a collection of claims can be used to create a ClaimsIndentity along with the authentication scheme (in this case, cookie-based authentication)

                    // Example of identity would be a Driver's License card

                    var identity = new ClaimsIdentity(claims, CookieAuthenticationDefaults.AuthenticationScheme);

                    // multiple identities can be stored in a ClaimsPrincipal

                    // Example, a user's multiple identities (driver's license, employee ID, passport) can make up a ClaimsPrincipal

                    var principal = new ClaimsPrincipal(identity);

                    // the SignInAsync method issues the authentication cookie to the user

                    await HttpContext.SignInAsync(CookieAuthenticationDefaults.AuthenticationScheme, principal);

                    // return the user to the View they were originally trying to reach or Home/Index

                    return Redirect(loginInput?.ReturnURL ?? "/");
                }

                // if credentials are not valid

                else
                {
                    ViewData["message"] = "Invalid credentials";
                }
            }
            else
            {
                var errors = ModelState.Values.SelectMany(v => v.Errors);
            }
            // return user to Login View

            return View(loginInput);
        }
       
        // GET: Sign Up for an account
        [HttpGet]
        public IActionResult SignUp()
        {
            ViewData["PropertyTypes"] = new SelectList(_context.PropertyTypeT.OrderBy(p => p.PropertyTypeName), "PropertyTypeIdPK", "PropertyTypeName");

            return View();
        }

        // Post action (when user submits the new account form)

        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> SignUp([Bind("Email,Password,FirstName,LastName,Address,City,State,Zipcode,PhoneNumber,RoleIdFk")] UserT userInfo)
        {
            if (ModelState.IsValid)
            {
                // check for duplicate username

                var aUser = await _context.UserT.FirstOrDefaultAsync(u => u.Email == userInfo.Email);

                // if no duplication

                if (aUser is null)
                {
                    // set default role to "user" and create new record in LoginInfo

                    _context.Add(userInfo);
                    await _context.SaveChangesAsync();

                    TempData["success"] = "Account created";

                    // redirect to Login View

                    return RedirectToAction(nameof(Login));
                }
                else
                {
                    ViewData["message"] = "Choose a different username";
                }
            }
            else
            {
                logModelState(ModelState);
            }
            // return user to SignUp View

            return View(userInfo);
        }

        // method to log user out and redirect to Home View
        [HttpGet]
        public async Task<RedirectToActionResult> Logout()
        {
            await HttpContext.SignOutAsync(CookieAuthenticationDefaults.AuthenticationScheme);
            return RedirectToAction("Index", "Home");
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