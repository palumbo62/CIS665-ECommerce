using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

using HandsOnEx.Models;

// Demo controller for using Layouts
//
// NOTES: perform all heavy listing business logic in the controller
//
// Views/Shared/_Layout.cshtml is the DEFAULT layout that is used if you specify 
// Layout = null in a View definition
//
namespace HandsOnEx.Controllers
{
    public class HOE3Controller : Controller
    {
        public IActionResult Index()
        {

            Employee[] employees = Employee.GetEmployees();

            //return View(employees[0]);
            return View(employees);
        }
    }
}