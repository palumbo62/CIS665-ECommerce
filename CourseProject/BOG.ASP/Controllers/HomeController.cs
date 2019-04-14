using BOG.ASP.Models;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using System.Diagnostics;
using System.Linq;
using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Session;

namespace BOG.ASP.Controllers
{
    public class HomeController : Controller
    {
        // Context to access the database
        private Team115DBContext aBogContext;

        protected BogAppContext aBogAppContext = new BogAppContext();

        private  ILogger _logger { get; }

        public HomeController(ILogger<Program> logger, Team115DBContext aContext)
        {
            _logger = logger;
            aBogContext = aContext;
        }

        public IActionResult Index() {
            ViewData["PageTitle"] = "Hello and Welcome to BeOurGuest!";

            //return View("BogListings");
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

        [HttpPost]
        public IActionResult BogHome() {
            ViewData["BogAppContext"] = aBogAppContext;

            string tag;

            if (aBogAppContext.UserLoggedIn)
            {
                tag = $"Welcome back to BeOurGuest, {aBogAppContext.currUser.FirstName}" ;
            }
            else
            {
                tag = $"Hello and Welcome to BeOurGuest!";
            }

            ViewData["PageTitle"] = tag;

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

        [HttpPost]
        public IActionResult BogLoginPage(BogLoginCreds aLogin)
        {
            ViewData["BogAppContext"] = aBogAppContext;

            _logger.LogDebug($"Login Credentials: email={aLogin.email} password={aLogin.password}");

            if (ModelState.IsValid && (aLogin != null))
            {
                if (aLogin.valid())
                {
                    ViewData["PageTitle"] = $"Welcome back to BeOurGuest, {aBogAppContext.currUser.FirstName}";

                    ViewData["userCred"] = aLogin;

                    HttpContext.Session.SetInt32("UserLoggedIn", aLogin.userLoggedIn());
                    HttpContext.Session.SetInt32("UserRoleType", aLogin.getRoleType());

                    return View("BogHome");
                }
            }

            return View();
        }

        [HttpGet]
        public IActionResult BogLogout()
        {
            ViewData["BogAppContext"] = aBogAppContext;

            return View("BogHome");
        }

        /*
         ********************************************************
         * HANDLE PROPERTY SEARCH EVENTS HERE
         ********************************************************
         */
        [HttpGet]
        [HttpPost]
        public IActionResult BogProperties()
        {
            return View();
        }

        [HttpPost]
        public IActionResult BogHomeSearch(BogHomeSearch aSearch) {
            ViewData["BogAppContext"] = aBogAppContext;

            //RLP Validate 
            if (ModelState.IsValid && (aSearch != null)) {
                // RLP Perform a search
                return View("BogHomeSearch", aSearch);
            }

            return View();
        }

        [HttpPost]
        public IActionResult BogSelectedProperty(PropertyT aProperty)
        {
            ViewData["BogAppContext"] = aBogAppContext;
            ViewBag.PropertyId = aProperty.PropertyIdPk;

            _logger.LogDebug($"VIEW SELECTED PROPERTY DETAILS HERE! ID={aProperty.PropertyIdPk} Addr={aProperty.Address} " +
                $"City={aProperty.City} State={aProperty.State} Zip={aProperty.Zipcode}");

            if (ModelState.IsValid && (aProperty != null))
            {
                // RLP - Add reservation and check for errors...
                return View("BogSelectedProperty", aProperty);
            }

            return View("BogReservationPage");
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
            ViewBag.PropertId = 34;//  aProperty.PropertyIdPk;

            _logger.LogDebug($"RESERVE PROPERTY HERE! PropId={aProperty.PropertyIdPk}  Addr={aProperty.Address} City={aProperty.City} State={aProperty.State} Zip={aProperty.Zipcode}");

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
        public IActionResult BogRegister() {
            ViewData["BogAppContext"] = aBogAppContext;

            return View();
        }

        [HttpPost]
        public IActionResult BogRegister(BogUserProfile aUser) {
            ViewData["BogAppContext"] = aBogAppContext;
            
            if (ModelState.IsValid && (aUser != null)) {
                return View("BogRegisterThanks", aUser);
            }

            return View();
        }


        /*
        ********************************************************
        * HANDLE PROPERTY ADDITIONS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogAddProperty() {
            ViewData["BogAppContext"] = aBogAppContext;
            
            return View();
        }

        [HttpPost]
        public IActionResult BogAddPropertyAction(BogAddProperty aProperty)
        {
            ViewData["BogAppContext"] = aBogAppContext;
            
            if (ModelState.IsValid && (aProperty != null))
            {
                return View("BogAddPropertyThanks", aProperty);
            } else
            {
                var errors = ModelState.Values.SelectMany(v => v.Errors);
            }

            return View();
        }

        /*
        ********************************************************
        * HANDLE PROPERTY DELETIONS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogDelProperty()
        {
            ViewData["BogAppContext"] = aBogAppContext;

            return View();
        }

        [HttpPost]
        public IActionResult BogDelPropertyAction(PropertyT aProperty)
        {
            ViewData["BogAppContext"] = aBogAppContext;

            if (ModelState.IsValid && (aProperty != null))
            {
                return View("BogAddPropertyThanks", aProperty);
            }
            else
            {
                var errors = ModelState.Values.SelectMany(v => v.Errors);
            }

            return View();
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
