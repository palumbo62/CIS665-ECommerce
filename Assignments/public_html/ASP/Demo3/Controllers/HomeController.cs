//Demo 3 - Razor Basics; LV; Based on Adam Freeman's Pro ASP.Net Core MVC 2

using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Demo3.Models;

namespace Demo3.Controllers
{
    public class HomeController : Controller
    {
        public IActionResult Index()
        {
            // create a new Car object

            Car aCar = new Car()
            {
                CarID = 100001,
                CarManufacturer = "Volvo",
                CarModel = "S90 Hybrid",
                CarPrice = 65850,
                CarSize = "Large"
            };

            // for demo purposes, a dynamic property, Inventory, is created
            // this property is used in Index view to demo conditional Razor statements

            ViewBag.Inventory = 2;

            // for demo purposes, a Car array is created
            // the array is used in Index view to demo iteration statements

            Car[] myCars =
            {
                new Car {CarManufacturer = "Bugatti", CarModel = "Chiron", CarPrice=2700000M},
                new Car {CarManufacturer = "Ferrari", CarModel = "Sergio", CarPrice=3000000M},
                new Car {CarManufacturer = "Aston Martin", CarModel = "Valkyrie", CarPrice=3200000M},
                new Car {CarManufacturer = "W Motors", CarModel = "Lykan Hypersport", CarPrice=3400000M}
            };

            return View(myCars);
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
