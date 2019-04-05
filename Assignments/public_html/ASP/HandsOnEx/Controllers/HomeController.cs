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
        public IActionResult Index()
        {
            ViewBag.Message = "Welcome back Spring Breakers!";
            return View("MyView");
        }


        //Overloaded method to the Add method following
        [HttpGet]
        public IActionResult DestinationForm()
        {
            return View();
        }

        [HttpPost]

        public IActionResult DestinationForm(SBDestination aDestination)
        {
            // Add the destination SBDestinationRepository 
            if (ModelState.IsValid) {
                // Only add if the data is ok as defined by our validation rules in the model
                SBDestinationRepository.AddDestination(aDestination);
               return View("Thanks", aDestination);
            }
            else
            {
                // if the vlaidation fails redisplay the form so they 
                // can fix any errors
                return View();
            }
        }

        public IActionResult ShowDestinations()
        {
            return View(SBDestinationRepository.GetSBDestinations);
        }

        //public string Index()
        //{
        //    return "Look Ma, I can build web apps with Asp.Net Core";
        //}

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
