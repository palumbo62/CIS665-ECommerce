using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using System.Diagnostics;
using Microsoft.AspNetCore.Http;
using System;
using Microsoft.EntityFrameworkCore;
using System.Linq;
using System.Collections.Generic;

using BOG.Models;
using BOG.ASP.Models;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.AspNetCore.Authentication;
using Microsoft.AspNetCore.Authentication.Cookies;
using System.Security.Claims;

namespace BOG.ASP.Controllers
{
    public class HomeController : Controller
    {
        // Context to access the database
        private PalumboDBContext _bogDbContext;

        protected BogAppContext aBogAppContext = new BogAppContext();

        protected BogHomeSearch propSearchModel = new BogHomeSearch();

        protected string _bogConfPassword = null;

        // List of property types                                                               
        private IEnumerable<SelectListItem> propTypeList = null; 

        private  ILogger _logger { get; }

        public HomeController(ILogger<Program> logger, PalumboDBContext aContext)
        {
            _logger = logger;

            _bogDbContext = aContext;

            // Retrieve the propertypes from the DB - this list will be used
            // to autogen the property types drop-down
            propTypeList = _bogDbContext.PropertyTypeT.Distinct().Select(p => new SelectListItem() {
                Value = p.PropertyTypeIdPk.ToString(), Text = p.PropertyTypeName
            }).ToList();
        }

        public IActionResult Index() {
            ViewData["PageTitle"] = "Hello and Welcome to BeOurGuest!";
            ViewData["PropTypeList"] = propTypeList;
            ViewData["PropSearchModel"] = propSearchModel;

            return View("BogHome");
        }

        public IActionResult Privacy() {
            return View();
        }

        [HttpGet]
        public IActionResult BogAbout()
        {
            return View();
        }

        [HttpGet]
        [HttpPost]
        public IActionResult BogHome() {
            ViewData["BogAppContext"] = aBogAppContext;

            string tag;

            if (HttpContext.Session.GetInt32("UserLoggedIn") == 1)
            {
                tag = $"Welcome back to BeOurGuest, {HttpContext.Session.GetString("FirstName")}";
            }
            else
            {
                tag = $"Hello and Welcome to BeOurGuest!";
            }

            ViewData["PageTitle"] = tag;
            ViewData["PropTypeList"] = propTypeList;
            ViewData["PropSearchModel"] = propSearchModel;

            TempData["UserID"] = HttpContext.Session.GetInt32("UserID");

            return View();
        }

        /*
        ********************************************************
        * HANDLE LOGIN/LOGOUT EVENTS HERE
        ********************************************************
        */
        public IActionResult BogErrMsg(string bogErrMsg)
        {
            ViewBag.BogErrMsg = bogErrMsg;

            return View();
        }

        /*
        ********************************************************
        * HANDLE LOGIN/LOGOUT EVENTS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogLoginPage()
        {
            ViewData["BogAppContext"] = aBogAppContext;

            return View();
        }

        [HttpGet]
        //[ValidateAntiForgeryToken]
        public async System.Threading.Tasks.Task<IActionResult> BogLoginValidateAsync(string email, string password)
        {
            if (ModelState.IsValid)
            {
                // check if login credentials are valid

                //// Try to find the credentials in the database
                //var aUser = _bogDbContext.UserT.FirstOrDefaultAsync(p => (p.Email == email && p.Password == password));

                // Try to find the credentials in the database
                var aUser = _bogDbContext.UserT.FirstOrDefault(p => (p.Email == email && p.Password == password));

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

                    RolesT role = _bogDbContext.RolesT.Where(p => p.RoleIdPk == aUser.RoleIdFk).FirstOrDefault();

                    claims.Add(new Claim(ClaimTypes.Role, role.RoleName.Trim()));

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

                    ViewData["PropTypeList"] = propTypeList;
                    ViewData["PropSearchModel"] = propSearchModel;

                    TempData["loggedIn"] = $"Welcome back to BeOurGuest, {aUser.FirstName}";
                    TempData["UserID"] = aUser.UserIdPk;

                    return View("BogHome");
                }
            }

            TempData["message"] = "Invalid credentials";

            return View("BogLoginPage");
        }


        [HttpGet]
        public IActionResult BogLoginValidateXRLP(string email, string password)
        {
            ViewData["BogAppContext"] = aBogAppContext;

            _logger.LogDebug($"Login Credentials: email={email} password={password}");

            if (ModelState.IsValid)
            {
                // Try to find the credentials in the database
                var user = _bogDbContext.UserT.Where(p => (p.Email == email && p.Password == password)).FirstOrDefault();

                if (user != null) 
                {
                    TempData["loggedIn"] = $"Welcome back to BeOurGuest, {user.FirstName}";
                    TempData["UserID"] = user.UserIdPk;

                    HttpContext.Session.SetInt32("UserLoggedIn", 1);
                    HttpContext.Session.SetInt32("UserRoleType", user.RoleIdFk);
                    HttpContext.Session.SetInt32("UserID", user.UserIdPk);
                    HttpContext.Session.SetString("UserFirstName", user.FirstName);
                    HttpContext.Session.SetString("UserLastName", user.LastName);

                    ViewData["PropTypeList"] = propTypeList;
                    ViewData["PropSearchModel"] = propSearchModel;

                    return View("BogHome");
                    //return RedirectToAction(nameof(BogHome));
                }
            }

            return View("Error");
        }

        [HttpGet]
        public IActionResult BogLogout()
        {
            ViewData["BogAppContext"] = aBogAppContext;
            ViewData["PropTypeList"] = propTypeList;
            ViewData["PropSearchModel"] = propSearchModel;

            HttpContext.Session.Clear();
            HttpContext.SignOutAsync(CookieAuthenticationDefaults.AuthenticationScheme);

            TempData.Clear();

            _logger.LogDebug("Session has been CLEARED");

            TempData["loggedOut"] = "Thank you for visiting BeOurGuest!";
            
            return View("BogHome");
        }

        /*
         ********************************************************
         * HANDLE PROPERTY SEARCH EVENTS HERE
         ********************************************************
         */
        [HttpGet]
        public IActionResult BogProperties()
        {
            var properties = _bogDbContext.PropertyT.Include(p => p.PropertyTypeIdFkNavigation);

            ViewData["PropTypeList"] = propTypeList;
            ViewData["PropSearchModel"] = propSearchModel;
            ViewData["PropAction"] = "BogViewProperty";
            ViewData["PropButtonText"] = "View";

            HttpContext.Session.SetString("PropAction", "BogViewProperty");
            HttpContext.Session.SetString("PropActionButton", "View Property");

            return View(properties.ToList());
        }


        [HttpGet]
        public IActionResult BogHomeSearch(int? proptype, string city, string state, string zipcode)
        {
            //RLP Validate 
            if (ModelState.IsValid)
            {
                // Pass the params back to the View so user can see what they searched on

                propTypeList = _bogDbContext.PropertyTypeT.Distinct().Select(p => new SelectListItem() { 
                    Value = p.PropertyTypeIdPk.ToString()
                    ,Text = p.PropertyTypeName
                    ,Selected = (p.PropertyTypeIdPk == proptype)
                }).OrderBy(p => p.Text).ToList();

                var properties = _bogDbContext.PropertyT.Include(p => p.PropertyTypeIdFkNavigation).
                                    Where(p => p.State.Contains(String.IsNullOrEmpty(state) ? "" : state));
                                    //Where(p => p.Zipcode.ToString() == zipcode);

                //Filter by property type
                if (proptype != null)
                {
                    properties = properties.Where(p => p.PropertyTypeIdFk.Equals(proptype));
                }

                // Filter by property type
                if (!String.IsNullOrEmpty(city))
                {
                    properties = properties.Where(p => p.City.Contains(city));
                }

                //// Filter by property type
                if (!String.IsNullOrEmpty(state))
                {
                    properties = properties.Where(p => p.State.Contains(state));
                }

                // Filter by property type
                if (!String.IsNullOrEmpty(zipcode))
                {
                    properties = properties.Where(p => p.Zipcode.ToString() == zipcode);
                }

                ViewData["PropTypeList"] = propTypeList;
                ViewData["PropSearchModel"] = propSearchModel;
                ViewData["DBContext"] = _bogDbContext;

                // RLP Perform a search
                return View("BogProperties", properties.OrderBy(p => p.PropertyTypeIdFk).ThenBy(p => p.State).ThenBy(p => p.Zipcode).ToList());
            }

            return View("Error");
        }

        //[HttpGet]
        public IActionResult BogViewProperty(int? propId)
        {
            if (propId == null)
            {
                RedirectToAction(nameof(BogViewProperty));
            }

            // retrieve the selected property
            var property = _bogDbContext.PropertyT.Include(p => p.PropertyTypeIdFkNavigation).
                                Where(p => p.PropertyIdPk == propId).FirstOrDefault();

            // if for whatever reason the property wasn't found just bail
            if (property == null)
            {
                RedirectToAction(nameof(BogHome));
            }

            // Retrieve any reservations and reviews that had been submitted for this property
            var propReviews = _bogDbContext.CommentsT.Where(p => p.PropertyIdFk == propId);
            var propReservations = _bogDbContext.ReservationT.Where(p => p.PropertyIdFk == propId);

            ViewData["Reviews"] = propReviews.ToList();
            ViewData["Reservations"] = propReservations.ToList();

            _logger.LogDebug($"VIEW SELECTED PROPERTY DETAILS HERE! ID={property.PropertyIdPk} Addr={property.Address} " +
                $"City={property.City} State={property.State} Zip={property.Zipcode}");

            return View("BogSelectedProperty", property);
        }

        /*
         ********************************************************
        * HANDLE PROPERTY RESERVATION EVENTS HERE
        ********************************************************
        */
        [HttpPost]
        public IActionResult BogViewReservationsByPropId(PropertyT aProperty)
        {
            return View("BogViewReservationsByPropId", aProperty);
        }

        [HttpPost]
        public IActionResult BogReserveProperty(ReservationT aReservation)
        {
            ViewData["BogAppContext"] = aBogAppContext;

            _logger.LogDebug($"RESERVE PROPERTY HERE! Chkin={aReservation.CheckIn} Chkout={aReservation.CheckOut} " +
                $"GuestCnt={aReservation.GuestCnt} PropId={aReservation.PropertyIdFk}");

            if (ModelState.IsValid && (aReservation != null))
            {
                // RLP - Add reservation and check for errors...
                return View("index");
            }

            return View("BogReservationPage");
        }

        [HttpPost]
        public IActionResult BogStartReservation(PropertyT aProperty)
        {
            ViewData["BogAppContext"] = aBogAppContext;
            ViewBag.PropertId = aProperty.PropertyIdPk;

            _logger.LogDebug($"RESERVE PROPERTY HERE! PropId={aProperty.PropertyIdPk}  " +
                $"Addr={aProperty.Address} City={aProperty.City} State={aProperty.State} Zip={aProperty.Zipcode}");

            if (ModelState.IsValid && (aProperty != null))
            {
                // RLP - Add reservation and check for errors...
                return View("BogReservationPage");
            }

            return View("BogReservationPage");
        }

        /*
        ********************************************************
        * HANDLE USER REGISTRATION EVENTS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogRegisterPage() {
            ViewData["BogAppContext"] = aBogAppContext;
            ViewData["BogConfPassword"] = _bogConfPassword;

            return View();
        }

        [HttpPost]
        //[ValidateAntiForgeryToken]
        public IActionResult BogRegisterValidate(UserT aUser, string confPassword) {
            _logger.LogCritical("*** NEED TO VALIDATE PASSWORDS BEFORE ADDING USER!");
            _logger.LogCritical("*** NEED TO DISPLAY REGISTRATION COINFIRMATION THEN REDIRECT TO LOGIN PAGE!");

            if (ModelState.IsValid && (aUser != null)) {
                // check for existing email - if so it is already registered and thus can't be used
                var user = _bogDbContext.UserT.FirstOrDefault(p => p.Email == aUser.Email);

                if (user == null)
                {
                    _bogDbContext.Add(aUser);
                    _bogDbContext.SaveChanges();

                    TempData["success"] = "Account succcessfully created. You may now log in!";
                    return View("BogLoginPage");

                    // Make sure passwords are good
                    //if (user.Password.CompareTo(confPassword) == 0)
                    //{
                    //    _bogDbContext.Add(aUser);
                    //    _bogDbContext.SaveChanges();

                    //    return View("BogLoginPage");
                    //} 
                    //else
                    //{
                    //    ViewBag.BogErrMsg = $"Passwords do not match!";
                    //    ViewBag.BogRetryPage = "BogRegisterPage";

                    //    return View("BogShowRetryOption");
                    //}
                }
                else
                {
                    ViewBag.BogErrMsg = $"Email address '{aUser.Email}' has already been taken";
                    ViewBag.BogRetryPage = "BogRegisterPage";

                    return View("BogShowRetryOption");
                }
            }

            return View("BogRegister");
        }


        /*
        ********************************************************
        * HANDLE PROPERTY ADDITIONS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogAddProperty() {
            ViewData["PropTypeList"] = propTypeList;
            ViewData["PropSearchModel"] = propSearchModel;

            return View();
        }

        [HttpPost]
        public IActionResult BogAddPropertyAction(PropertyT aProperty)
        {
            ViewData["BogAppContext"] = aBogAppContext;
            
            if (ModelState.IsValid && (aProperty != null))
            {
                _bogDbContext.Add(aProperty);
                _bogDbContext.SaveChanges();

                aProperty.PropertyTypeIdFkNavigation = _bogDbContext.PropertyTypeT.Find(aProperty.PropertyTypeIdFk);

                return View(aProperty);
            } else
            {
                var errors = ModelState.Values.SelectMany(v => v.Errors);
            }

            return RedirectToAction(nameof(BogAddProperty));
        }

        /*
        ********************************************************
        * HANDLE PROPERTY DELETIONS HERE
        ********************************************************
        */
        [HttpGet]
        [HttpPost]
        public IActionResult BogDelProperty()
        {
            var properties = _bogDbContext.PropertyT.Include(p => p.PropertyTypeIdFkNavigation);

            ViewData["PropTypeList"] = propTypeList;
            ViewData["PropSearchModel"] = propSearchModel;

            HttpContext.Session.SetString("PropAction", "BogDelPropertyAction");
            HttpContext.Session.SetString("PropActionButton", "Delete Property");

            return View("BogProperties", properties.ToList());
        }

        [HttpGet]
        public IActionResult BogDelPropertyAction(int? propId)
        {
            if (ModelState.IsValid  && propId != null) 
            {
                // retrieve the selected property
                var property = _bogDbContext.PropertyT.Include(p => p.PropertyTypeIdFkNavigation).
                    Where(p => p.PropertyIdPk == propId).FirstOrDefault();

                // if for whatever reason the property wasn't found just bail
                if (property == null)
                {
                    RedirectToAction(nameof(BogHome));
                }

                return View(property);
            }

            return RedirectToAction(nameof(BogDelProperty));
        }

        [HttpGet]
        public IActionResult BogDelPropertyConfirmed(int? propId)
        {
            if (ModelState.IsValid && propId != null)
            {
                // retrieve the selected property
                var property = _bogDbContext.PropertyT.Find(propId);
                var comments = _bogDbContext.CommentsT.Where(p => p.PropertyIdFk == propId);
                var reservations = _bogDbContext.ReservationT.Where(p => p.PropertyIdFk == propId);


                // if for whatever reason the property wasn't found just bail
                if (property == null)
                {
                    RedirectToAction(nameof(BogHome));
                }

                if (comments.Count() > 0)
                {
                    _bogDbContext.CommentsT.RemoveRange(comments);
                }

                if (reservations.Count() > 0)
                {
                    _bogDbContext.ReservationT.RemoveRange(reservations);
                }

                _bogDbContext.Remove(property);
                _bogDbContext.SaveChanges();

                TempData["success"] = "Profile has been updated!";

                return View("BogHome");
            }

            return RedirectToAction(nameof(BogDelProperty));
        }

        /*
        ********************************************************
        * HANDLE USER PROFILE EVENTS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult bogUserProfile(int userId)
        {
            //var UserID = TempData["UserID"];
            //var UserID = HttpContext.Session.GetInt32("UserID");
            var user = _bogDbContext.UserT.Find(userId);

            if (user != null)
            {
                return View(user);
            }

            return RedirectToAction(nameof(BogHome));
        }

        [HttpPost]
        public IActionResult bogUserProfileAction(UserT aUser)
        {
            if (ModelState.IsValid && aUser != null)
            {
                _bogDbContext.UserT.Update(aUser);
                _bogDbContext.SaveChanges();

                TempData["success"] = "User profile has been updated!";
                return View(aUser);
            }
            else
            {
                TempData["success"] = "User profile update could not be processed!";
            }

            return RedirectToAction(nameof(BogHome));
        }


        /*
        ********************************************************
        * HANDLE ERROR EVENTS HERE
        ********************************************************
        */

        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error() {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
    }
}
