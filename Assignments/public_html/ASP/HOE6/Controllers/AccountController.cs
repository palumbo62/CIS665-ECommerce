using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

//RLP
using Microsoft.EntityFrameworkCore;
using HandsOnEx6.Models;
using Microsoft.AspNetCore.Authentication;
using Microsoft.AspNetCore.Authentication.Cookies;
using System.Security.Claims;
//RLP - end

namespace HandsOnEx6.Controllers
{
    public class AccountController : Controller
    {
        //RLP
        private readonly TaraStoreContext _context;

        //RLP - NOTE we didn't use scaffolding so we have to write all ths manually
        public AccountController(TaraStoreContext context)
        {
            this._context = context;
        }

        //RLP
        [HttpGet]
        public IActionResult Login(string returnURL)
        {
            // if user if trying to login after coming from teh HOME page there won't be a return URL
            // then we just default to the home page "/" otherwise we track the page from the redirect
            // and that is where the user will be sent to AFTER logging in
            returnURL = String.IsNullOrEmpty(returnURL) ? "~/" : returnURL;

            return View(new LoginInput { ReturnURL = returnURL });
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        //RLP bind is used to indicate which properties of the model we will be using.  There can be more
        // properties in the model that we don't care about. Last parameter indicates the model to use
        public async Task<IActionResult> Login([Bind("Username", "UserPassword", "ReturnURL")] LoginInput loginInput)
        {
            if (ModelState.IsValid)
            {
                var aUser = await _context.LoginInfo.FirstOrDefaultAsync(u => u.Username == loginInput.Username &&
                                                u.UserPassword == loginInput.UserPassword);

                if (aUser != null)
                {
                    // Claim is used to create an IDENTITY which then can be used throughout the session to show 
                    // user is authenticated.  You can use a 'principal' which allows multiple identities

                    var claims = new List<Claim>();

                    claims.Add(new Claim(ClaimTypes.Name, aUser.FullName));
                    claims.Add(new Claim(ClaimTypes.Sid, aUser.UserPk.ToString()));

                    string[] roles = aUser.UserRoles.Split(",");

                    foreach (string role in roles)
                    {
                        // Adding a claim for each role the user has
                        claims.Add(new Claim(ClaimTypes.Role, role));
                    }

                    // The defined claims make up the IDENTITY
                    var identity = new ClaimsIdentity(claims, CookieAuthenticationDefaults.AuthenticationScheme);

                    // Now if you have multiple identities you place them all in a PRINICPAL, here we just have 1
                    // IDENTITY with multiple claims, you could add a list of IDENTITIES

                    var principal = new ClaimsPrincipal(identity);

                    // NOW SET THE COOKIE THAT WILL CONTAIN THIS INFO - this create a 'SIGNIN" cookie which
                    // maintains the "STATE" of the user and the login

                    await HttpContext.SignInAsync(CookieAuthenticationDefaults.AuthenticationScheme, principal);

                    // Syntax mean check if loginInput is not NULL and send user to page they were on "ReturnURL"
                    // otherwise send them to the home page "/"
                    return Redirect(loginInput?.ReturnURL ?? "~/");
                }
                {
                    ViewData["message"] = "Invalid credentials";
                }
            }

            // failure case is to send user back to login page and pass the current form model with the parameters
            // they already entered...so they don't have to reenter them
            return View(loginInput);
        }

        public IActionResult SignUp()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> SignUp([Bind("Username, UserPassword, FullName")] LoginInfo loginInfo)
        {
            if (ModelState.IsValid)
            {
                // Check is user already exists
                var aUser = await _context.LoginInfo.FirstOrDefaultAsync(u => u.Username == loginInfo.Username);

                if (aUser == null)
                {
                    // User credentials are not already in the DB so we can add them valid to be added as a new user, 
                    // their role is defaulted to a simple user for this case

                    loginInfo.UserRoles = "User";

                    // Add to DB
                    _context.Add(loginInfo);
                    await _context.SaveChangesAsync();

                    // Send them to the login view - this is a differnet view so used TempData[] to send it
                    TempData["success"] = "Account created!";

                    return RedirectToAction(nameof(Login));
                }
                else
                {
                    ViewData["message"] = "Choose a different username";
                }
            }

            return View(loginInfo);
        }

        public async Task<RedirectToActionResult> Logout()
        {
            await HttpContext.SignOutAsync(CookieAuthenticationDefaults.AuthenticationScheme);

            return RedirectToAction("Index", "Home");
        }

        public IActionResult Index()
        {
            return View();
        }
    }
}