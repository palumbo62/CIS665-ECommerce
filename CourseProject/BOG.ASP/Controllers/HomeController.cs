using BOG.ASP.Models;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;
using System.Diagnostics;
using System.Linq;

namespace BOG.ASP.Controllers
{
    public class HomeController : Controller
    {
        protected BogAppContext bogAppContext = new BogAppContext();

        private  ILogger _logger { get; }

        public HomeController(ILogger<Program> logger)
        {
            _logger = logger;
        }

        public IActionResult Index() {
            ViewBag.Title = "Hello and Welcome to BeOurGuest!";

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
            ViewData["BogAppContext"] = bogAppContext;

            string tag;

            if (bogAppContext.UserLoggedIn)
            {
                tag = $"Welcome back to BeOurGuest, {bogAppContext.currUser.FirstName}" ;
            }
            else
            {
                tag = $"Hello and Welcome to BeOurGuest!";
            }

            ViewBag.PageTitle = tag;

            return View();
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
            ViewData["BogAppContext"] = bogAppContext;

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
            ViewData["BogAppContext"] = bogAppContext;
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
            ViewData["BogAppContext"] = bogAppContext;

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
            ViewData["BogAppContext"] = bogAppContext;
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
        * HANDLE LOGIN EVENTS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogLoginPage()
        {
            ViewData["BogAppContext"] = bogAppContext;

            return View();
        }

        [HttpPost]
        public IActionResult BogLoginPage(BogLoginCreds aLogin)
        {
            ViewData["BogAppContext"] = bogAppContext;

            _logger.LogDebug($"Login Credentials: email={aLogin.email} password={aLogin.password}");
            
            if (ModelState.IsValid && (aLogin != null))
            {
                if (aLogin.valid())
                {
                    string tag = $"Welcome back to BeOurGuest, {bogAppContext.currUser.FirstName}";

                    return View("BogHome");
                }
            }

            return View();
        }

        /*
        ********************************************************
        * HANDLE USER REGISTRATION EVENTS HERE
        ********************************************************
        */
        [HttpGet]
        public IActionResult BogRegister() {
            ViewData["BogAppContext"] = bogAppContext;

            return View();
        }

        [HttpPost]
        public IActionResult BogRegister(BogUserProfile aUser) {
            ViewData["BogAppContext"] = bogAppContext;
            
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
            ViewData["BogAppContext"] = bogAppContext;
            
            return View();
        }

        [HttpPost]
        public IActionResult BogAddPropertyAction(BogAddProperty aProperty)
        {
            ViewData["BogAppContext"] = bogAppContext;
            
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
        * HANDLE ERROR EVENTS HERE
        ********************************************************
        */

        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error() {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
    }
}
