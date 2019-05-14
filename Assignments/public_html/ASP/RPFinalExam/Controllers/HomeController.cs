using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Security.Claims;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Authentication;
using Microsoft.AspNetCore.Authentication.Cookies;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using RPFinalExam.Models;

namespace RPFinalExam.Controllers
{
    public class HomeController : Controller
    {
        private readonly PalumboExamDBContext _context;

        protected FilterInfo filterInfo = new FilterInfo();

        // List of property types                                                               
        private IEnumerable<SelectListItem> teamList = null;


        //RLP - NOTE we didn't use scaffolding so we have to write all ths manually
        public HomeController(PalumboExamDBContext context)
        {
            this._context = context;

            teamList = new SelectList(_context.NhlTeams.OrderBy(c => c.NhlTeamPk), "NhlTeamPk", "NhlTeamName");
        }

        public int? GetCurrUserId()
        {
            int userId = Int32.Parse(HttpContext.User.Claims.FirstOrDefault(x => x.Type == ClaimTypes.Sid).Value);

            return userId;
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
                var aUser = await _context.UserInfo.FirstOrDefaultAsync(u => u.UserLoginName == loginInput.Username &&
                                                u.UserLoginPassword == loginInput.UserPassword);

                if (aUser != null)
                {
                    // Claim is used to create an IDENTITY which then can be used throughout the session to show 
                    // user is authenticated.  You can use a 'principal' which allows multiple identities

                    var claims = new List<Claim>();

                    claims.Add(new Claim(ClaimTypes.Name, aUser.UserFirstName));
                    claims.Add(new Claim(ClaimTypes.Sid, aUser.UserPk.ToString()));

                    string[] roles = { "User" };

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
                    return RedirectToAction(nameof(UpdateProfile));
                }
                else
                {
                    TempData["message"] = "Invalid credentials";
                }
            }

            // failure case is to send user back to login page and pass the current form model with the parameters
            // they already entered...so they don't have to reenter them
            return View(loginInput);
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

        // GET: Admin/Create
        public IActionResult NhlAddPlayer()
        {
            ViewData["NhlTeamFk"] = teamList;

            return View();
        }

        // POST: Admin/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> NhlAddPlayer([Bind("NhlPlayerPk,NhlTeamFk,NhlPlayerName,NhlPlayerAge,NhlPlayPosition")] NhlPlayer nhlPlayer)
        {
            if (ModelState.IsValid)
            {
                _context.Add(nhlPlayer);
                await _context.SaveChangesAsync();

                //TempData is a key/value dictionary that can be used to persist data. The data persists until it is read
                //Check _Layout.cshtml to see how the element with a key of "message" is used

                TempData["message"] = $"{nhlPlayer.NhlPlayerName} has been added";
                return RedirectToAction(nameof(NhlPlayerSearch));
            }

            // if the data is not valid

            //replaced code here

            ViewData["NhlTeamFk"] = new SelectList(_context.NhlTeams.OrderBy(c => c.NhlTeamPk), "NhlTeamPk", "NhlTeamName");

            return View(nhlPlayer);
        }

        public async Task<IActionResult> NhlPlayerSearch(int? teamFk, string playerName, int? playerAge, string playerPos)
        {
            var teamList = await _context.NhlTeams.Distinct().Select(p => new SelectListItem() {
                            Value = p.NhlTeamPk.ToString(),
                            Text = p.NhlTeamName,
                            Selected = (p.NhlTeamPk == teamFk)
            }).OrderBy(p => p.Text).ToListAsync();

            //new SelectList(_context.NhlTeams.OrderBy(c => c.NhlTeamPk), "NhlTeamPk", "NhlTeamName");
            ViewData["filterInfo"] = filterInfo;
            ViewData["teamList"] = teamList;

            // so you get ALL the products and then APPLY the FILTERS to narrow it down
            var playersX = from p in _context.NhlPlayer select p;
            var players = _context.NhlPlayer.Include(p => p.NhlTeamFkNavigation).Where (p => p.NhlTeamFk > 0);
            
            // Now filter
            if (teamFk != null)
            {
                //players = players.Where(p => p.NhlTeamFk == teamFk);
                players = players.Where(p => p.NhlTeamFk == teamFk);
            }

            if (!String.IsNullOrEmpty(playerName))
            {
                players = players.Where(p => p.NhlPlayerName.Contains(playerName));
            }

            if (playerAge != null)
            {
                players = players.Where(p => p.NhlPlayerAge >= playerAge);
            }

            if (playerPos != null)
            {
                players = players.Where(p => p.NhlPlayPosition[0] == playerPos[0]);
            }

            // Order by Name then Cost and call ToList to actually execute the query and
            // create the result set
            return View(await players.OrderBy(p => p.NhlTeamFkNavigation.NhlTeamName).ThenBy(p => p.NhlPlayerName).ToListAsync());
        }

        public IActionResult UpdateProfile()
        {
            if (HttpContext.User.Identity.IsAuthenticated)
            {
                UserInfo user = _context.UserInfo.Find(GetCurrUserId());

                return View(user);
            }

            return RedirectToAction("Login", "Home");
        }

        [HttpPost]
        public async Task<IActionResult> UpdateProfile(UserInfo userInfo)
        {
            if (ModelState.IsValid && userInfo != null) 
            {
                _context.Update(userInfo);
                await _context.SaveChangesAsync();

                // Send them to the login view - this is a differnet view so used TempData[] to send it
                TempData["success"] = $"{userInfo.UserFirstName}, your profile has been updated!";
            }

            return View("UpdateProfile", userInfo);
            //return RedirectToAction(nameof(UpdateProfile), userInfo);
        }

        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error()
        {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
    }
}
