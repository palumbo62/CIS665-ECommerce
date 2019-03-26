using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using HandsOnEx.Models;

namespace HandsOnEx.Controllers
{
    public class HomeController : Controller
    {
        public IActionResult index()
        {
            // this method handles the view for the index page of the application
            // look in views->home-> index.cshtml  which is the view code

            // Create dynamic message to send to the view using the ViewBag
            ViewBag.Message = "Welcome back Spring Breakers!";

            return View("MyView"); // returns our own specific view
        }

        [HttpGet]  // Action for a GET
        public IActionResult DestinationForm ()
        {
            return View();  // by default it returns view of the same name
        }

        [HttpPost]  // Overload the method - Parameter distinguishes
        public IActionResult DestinationForm(SBDestination aDestination)
        {
            // Model is tied to the view so the POST creates an object that contains all the data
            // Creates a view called "Thanks" and passes it the data object
            return View("Thanks", aDestination);
        }

        public IActionResult Privacy()
        {
            return View();
        }

        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error()
        {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
    }
}
