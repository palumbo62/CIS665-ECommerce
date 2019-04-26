using System;

using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Authentication;
using Microsoft.AspNetCore.Authentication.Cookies;

using Microsoft.Extensions.Logging;
using System.Diagnostics;
using Microsoft.EntityFrameworkCore;
using System.Linq;
using System.Security.Claims;
using System.Threading.Tasks;

using BOG.Models;
using BOG.ASP.Models;
using BOG.ASP.Libs;
using Microsoft.AspNetCore.Mvc.Rendering;
using System.Collections.Generic;
using static Microsoft.AspNetCore.Hosting.Internal.HostingApplication;

namespace BOG.ASP.Controllers
{
    public class HomeController : Controller
    {
        private BogSharedLib libs = new BogSharedLib();

        // Context to access the database
        private PalumboDBContext _bogDbContext;

        protected BogAppContext aBogAppContext = new BogAppContext();

        protected BogHomeSearch propSearchModel = new BogHomeSearch();

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
                                Value = p.PropertyTypeIdPk.ToString(),
                                Text = p.PropertyTypeName
                            }).ToList();
        }

        private void bogSetTempData(string viewMsg)
        {
            TempData["message"] = viewMsg;
        }


        public IActionResult Index()
        {
            //ViewData["PageTitle"] = "Hello and Welcome to BeOurGuest!";
            //TempData["PropTypeList"] = propTypeList;
            //TempData["PropSearchModel"] = propSearchModel;

            return RedirectToAction(nameof(BogHome));
        }

        public IActionResult Privacy()
        {
            return View();
        }

        [HttpGet]
        public IActionResult BogAbout()
        {
            return View();
        }

        [HttpGet]
        [HttpPost]
        public IActionResult BogHome()
        {
            string tag;

            if (TempData["PageTitle"] != null)
            {

                ViewData["PageTitle"] = TempData["PageTitle"];
            }
            else
            {
                ViewData["PageTitle"] = "Hello and Welcome to BeOurGuest!";

            }

            ViewData["PropTypeList"] = propTypeList;
            ViewData["PropSearchModel"] = propSearchModel;

            return View();
        }

        /*
        ********************************************************
        * HANDLE ALERT EVENTS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogShowAlert(string v1, string v2, string v3)
        {
            BogAlertMsg alert = new BogAlertMsg(v1, v2, v3);
            return View(alert);
        }


        /*
        ********************************************************
        * HANDLE LOGIN/LOGOUT EVENTS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogLoginPage()
        {
            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> BogLoginValidate(string email, string password)
        {
            if (ModelState.IsValid)
            {
                // check if login credentials are valid

                //// Try to find the credentials in the database
                //var aUser = _bogDbContext.UserT.FirstOrDefaultAsync(p => (p.Email == email && p.Password == password));

                // Try to find the credentials in the database
                var aUser = await _bogDbContext.UserT.FirstOrDefaultAsync(p => (p.Email == email && p.Password == password));

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

                    RolesT role = await _bogDbContext.RolesT.Where(p => p.RoleIdPk == aUser.RoleIdFk).FirstOrDefaultAsync();

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

                    TempData["PageTitle"] = $"Welcome back to BeOurGuest, {aUser.FirstName}";
                    TempData["UserId"] = aUser.UserIdPk;
                    TempData["UserRole"] = aUser.RoleIdFk;

                    return RedirectToAction(nameof(BogHome));
                }
            }

            libs.logModelState(ModelState);

            return RedirectToAction("BogShowAlert", new { v1 = "Invalid credentials entereded!", v2 = "BogLoginPage", v3 = "Login?" });
        }


        [HttpGet]
        public async Task<IActionResult> BogLogout()
        {
            ViewData["PropTypeList"] = propTypeList;
            ViewData["PropSearchModel"] = propSearchModel;

            await HttpContext.SignOutAsync(CookieAuthenticationDefaults.AuthenticationScheme);

            TempData.Clear();

            _logger.LogDebug("Session has been CLEARED");

            TempData["message"] = "Thank you for visiting BeOurGuest!";
            
            return RedirectToAction(nameof(BogHome));
        }

        /*
         ********************************************************
         * HANDLE PROPERTY SEARCH EVENTS HERE
         ********************************************************
         */
        [HttpGet]
        public async Task<IActionResult> BogProperties()
        {
            var properties = _bogDbContext.PropertyT.Include(p => p.PropertyTypeIdFkNavigation);

            if (properties.Count() > 0)
            {
                ViewData["PropTypeList"] = propTypeList;
                ViewData["PropSearchModel"] = propSearchModel;

                ViewData["ViewAction"] = "BogViewProperty";
                ViewData["ViewButtonText"] = "View Property";

                return View(await properties.ToListAsync());
            }

            return RedirectToAction("BogShowAlert", new { v1 = "There are no reservations for this property!", v2 = "BogReservationPage", v3 = "Retry?" });
        }


        [HttpGet]
        public async Task<IActionResult> BogHomeSearch(int? proptype, string city, string state, string zipcode)
        {
            //RLP Validate 
            if (ModelState.IsValid)
            {
                // Pass the params back to the View so user can see what they searched on

                 propTypeList = await _bogDbContext.PropertyTypeT.Distinct().Select(p => new SelectListItem() { 
                    Value = p.PropertyTypeIdPk.ToString()
                    ,Text = p.PropertyTypeName
                    ,Selected = (p.PropertyTypeIdPk == proptype)
                }).OrderBy(p => p.Text).ToListAsync();

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
                return View("BogProperties", 
                            await properties.OrderBy(p => p.PropertyTypeIdFk).ThenBy(p => p.State).ThenBy(p => p.Zipcode).ToListAsync());
            }

            libs.logModelState(ModelState);

            return RedirectToAction("BogShowAlert", new { v1 = "Oops! An error has occurred retrieving properties!", v2 = "BogHomePage", v3 = "Retry?" });
        }

        [HttpGet]
        public async Task<IActionResult> BogViewProperty(int? propId)
        {
            if (propId == null)
            {
                return RedirectToAction(nameof(Index));
            }

            // retrieve the selected property
            var property =  await _bogDbContext.PropertyT.Include(p => p.PropertyTypeIdFkNavigation).
                                Where(p => p.PropertyIdPk == propId).FirstOrDefaultAsync();

            // if for whatever reason the property wasn't found just bail
            if (property == null)
            {
                return RedirectToAction(nameof(BogHome));
            }

            // Retrieve any reservations and reviews that had been submitted for this property
            var propReviews = _bogDbContext.CommentsT.Where(p => p.PropertyIdFk == propId);
            var propReservations = _bogDbContext.ReservationT.Where(p => p.PropertyIdFk == propId);

            ViewData["Reviews"] = await propReviews.ToListAsync();
            ViewData["Reservations"] = await propReservations.ToListAsync();

            _logger.LogDebug($"VIEW SELECTED PROPERTY DETAILS HERE! ID={property.PropertyIdPk} Addr={property.Address} " +
                $"City={property.City} State={property.State} Zip={property.Zipcode}");

            return View("BogSelectedProperty", property);
        }

        /*
         ********************************************************
        * HANDLE PROPERTY RESERVATION EVENTS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogViewReservationsByPropId(int? propId)
        {
            if (propId == null)
            {
                return RedirectToAction(nameof(Index));
            }

            var reservations = _bogDbContext.ReservationT.Include(p => p.PropertyIdFkNavigation).Where(p => p.PropertyIdFk == propId);

            // Only display the reservation table if there are any for the property
            if (reservations.Count() > 0)
            {
                ViewData["ReturnPropId"] = propId;

                return View("BogViewReservationsByPropId", reservations);
            }

            return RedirectToAction("BogShowAlert", new { v1 = "There are no reservations for this property!", v2 = "BogReservationPage", v3 = "Retry?" });
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

            libs.logModelState(ModelState);

            return RedirectToAction("BogShowAlert", new { v1 = "Oops! A reservation error has occurred!", v2 = "BogReservationPage", v3 = "Retry?" });
        }

        [HttpPost]
        public IActionResult BogStartReservation(PropertyT aProperty)
        {
            ViewData["BogAppContext"] = aBogAppContext;
            ViewBag.PropertId = aProperty.PropertyIdPk;

            _logger.LogDebug($"RESERVE PROPERTY HERE! PropId={aProperty.PropertyIdPk}  " +
                $"Addr={aProperty.Address} City={aProperty.City} State={aProperty.State} Zip={aProperty.Zipcode}");

            // User must be logged in to make a reservation
            if (HttpContext.User.Identity.IsAuthenticated)
            {
                if (ModelState.IsValid && (aProperty != null))
                {
                    // RLP - Add reservation and check for errors...
                    return View("BogReservationPage");
                }   
            }
            else
            {
                return RedirectToAction("BogShowAlert", new { v1 = "You must be logged in to make a reservation!", v2 = "BogLoginPage", v3 ="Login?" });
            }

            libs.logModelState(ModelState);

            return RedirectToAction("BogShowAlert", new { v1 = "Oops!A reservation error has occurred!", v2 = "BogProperties", v3 = "Go Back?" });
        }

        /*
        ********************************************************
        * HANDLE USER REGISTRATION EVENTS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogRegisterPage() {

            return View();
        }

        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> BogRegisterValidate(UserT aUser, string confPassword) {
            _logger.LogCritical("*** NEED TO VALIDATE PASSWORDS BEFORE ADDING USER!");
            _logger.LogCritical("*** NEED TO DISPLAY REGISTRATION COINFIRMATION THEN REDIRECT TO LOGIN PAGE!");

            if (ModelState.IsValid && (aUser != null)) {
                // check for existing email - if so it is already registered and thus can't be used
                var user = await _bogDbContext.UserT.FirstOrDefaultAsync(p => p.Email == aUser.Email);

                if (user == null)
                {
                    _bogDbContext.Add(aUser);
                    await _bogDbContext.SaveChangesAsync();

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
                    return RedirectToAction("BogShowAlert", new { v1 = $"Email address '{aUser.Email}' has already been taken", v2 = "BogRegisterPage", v3 = "Retry?" });
                }
            }

            libs.logModelState(ModelState);

            return RedirectToAction("BogShowAlert", new { v1 = "Oops! A reservation error has occurred!", v2 = "BogRegister", v3 = "Retry?" });
        }


        /*
        ********************************************************
        * HANDLE PROPERTY ADDITIONS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogAddProperty()
        {
            ViewData["PropTypeList"] = propTypeList;
            ViewData["PropSearchModel"] = propSearchModel;

            return View();
        }

        [HttpPost]
        public async Task<IActionResult> BogAddPropertyAction(PropertyT aProperty)
        {
            ViewData["BogAppContext"] = aBogAppContext;
            
            if (ModelState.IsValid && (aProperty != null))
            {
                _bogDbContext.Add(aProperty);
                await _bogDbContext.SaveChangesAsync();

                aProperty.PropertyTypeIdFkNavigation = await _bogDbContext.PropertyTypeT.FindAsync(aProperty.PropertyTypeIdFk);

                return View(aProperty);
            }

            libs.logModelState(ModelState);

            return RedirectToAction("BogShowAlert", new { v1 = "Oops! An error has occurred adding property!", v2 = "BogAddProperty", v3 = "Retry?" });
        }

        /*
        ********************************************************
        * HANDLE PROPERTY DELETIONS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogDelProperty()
        {
            var properties = _bogDbContext.PropertyT.Include(p => p.PropertyTypeIdFkNavigation);

            ViewData["PropTypeList"] = propTypeList;
            ViewData["PropSearchModel"] = propSearchModel;

            ViewData["ViewAction"] = "BogDelPropertyAction";
            ViewData["ViewButtonText"] = "Delete Property";

            return View("BogProperties", properties.ToList());
        }

        [HttpGet]
        public async Task<IActionResult> BogDelPropertyAction(int? propId)
        {
            if (ModelState.IsValid  && propId != null) 
            {
                // retrieve the selected property
                var property = await _bogDbContext.PropertyT.Include(p => p.PropertyTypeIdFkNavigation).
                                    Where(p => p.PropertyIdPk == propId).FirstOrDefaultAsync();

                // if for whatever reason the property wasn't found just bail
                if (property == null)
                {
                    RedirectToAction(nameof(BogHome));
                }

                return View(property);
            }

            libs.logModelState(ModelState);

            return RedirectToAction("BogShowAlert", new { v1 = "Oops! An error has occurred deleting property!", v2 = "BogDelProperty", v3 = "Retry?" });
        }

        [HttpGet]
        public async Task<IActionResult> BogDelPropertyConfirmed(int? propId)
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

                try
                {
                    if (comments.Count() > 0)
                    {
                        _bogDbContext.CommentsT.RemoveRange(comments);
                    }

                    if (reservations.Count() > 0)
                    {
                        _bogDbContext.ReservationT.RemoveRange(reservations);
                    }

                    _bogDbContext.Remove(property);
                    await _bogDbContext.SaveChangesAsync();
                }
                catch
                {
                    return RedirectToAction("BogShowAlert", new { v1 = "Property could not be deleted!", v2 = "BogDelProperty", v3 = "Retry?" });
                }

                return RedirectToAction("BogShowAlert", new { v1 = "Property has been successfully deleted!", v2 = "BogDelProperty", v3 = "Delete Another?" });
            }

            libs.logModelState(ModelState);

            return RedirectToAction("BogShowAlert", new { v1 = "Oops! An error has occurred deleting property!", v2 = "BogDelProperty", v3 = "Retry?" });
        }

        /*
        ********************************************************
        * HANDLE USER PROFILE EVENTS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogUserProfile(int? userId)
        {
            //var UserID = TempData["UserID"];
            //var UserID = HttpContext.Session.GetInt32("UserID");
            if (userId != null)
            {
                var user = _bogDbContext.UserT.Find(userId);

                if (user != null)
                {
                    return View(user);
                }
            }

            libs.logModelState(ModelState);

            return RedirectToAction("BogShowAlert", new { v1 = "Oops! An error has occurred retreiving user profile!", v2 = "BogUserProfile", v3 = "Retry?" });
        }

        [HttpPost]
        public async Task<IActionResult> BogUserProfileAction(UserT aUser)
        {
            if (ModelState.IsValid && aUser != null)
            {
                _bogDbContext.UserT.Update(aUser);
                await _bogDbContext.SaveChangesAsync();

                TempData["message"] = "User profile has been updated!";
                return View(aUser);
            }
            else
            {
                TempData["message"] = "User profile update could not be processed!";
            }

            libs.logModelState(ModelState);

            return RedirectToAction("BogShowAlert", new { v1 = "Oops! An error has occurred retreiving user profile!", v2 = "BogUserProfile", v3 = "Retry?" });
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
