using BOG.ASP.Models;
using Microsoft.AspNetCore.Mvc;
using System.Diagnostics;
using System.Linq;

namespace BOG.ASP.Controllers
{
    public class HomeController : Controller
    {
        public IActionResult Index() {
            //return View("BogHome");
            return View("BogAddProperty");

        }

        public IActionResult Privacy() {
            return View();
        }

        [HttpGet]
        public IActionResult BogHome() {
            return View();
        }

        [HttpPost]
        public IActionResult BogHomeSearch(BogHomeSearch aSearch) {
            //RLP Validate 
            if (ModelState.IsValid && (aSearch != null)) {
                // RLP Perform a search
                return View("BogHomeSearch", aSearch);
            }

            return View();
        }


        [HttpGet]
        public IActionResult BogRegister() {
            return View();
        }

        [HttpPost]
        public IActionResult BogRegister(BogUserProfile aUser) {
            if (ModelState.IsValid && (aUser != null)) {
                return View("BogRegisterThanks", aUser);
            }

            return View();
        }


        [HttpGet]
        public IActionResult BogAddProperty() {
            return View();
        }

        [HttpPost]
        public IActionResult BogAddPropertyAction(BogAddProperty aProperty)
        {
            if (ModelState.IsValid && (aProperty != null))
            {
                return View("BogAddPropertyThanks", aProperty);
            } else
            {
                var errors = ModelState.Values.SelectMany(v => v.Errors);
            }

            return View();
        }

        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error() {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
    }
}
