using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

using HandsOnEx.Models;

namespace HandsOnEx.Controllers
{
    public class HOE2Controller : Controller
    {
        public IActionResult Index()
        {
            List<string> results = new List<string>();

            foreach (Employee aEmployee in Employee.GetEmployees())
            {
                // REMEMBER: List contains a NULL object that we put in and we need to account for that
                // Insert a 'null conditional operator' to check if object is null
                // This is the ? below and if object is NULL property is ignored
                // you can then colalesce a value IF the object is NULL, use ??
                string name = aEmployee?.Name ?? "<Unknown>";
                string dept = aEmployee?.Department ?? "<Unknown>";

                // If you dont use the ? here you will get an error because this field
                // is defined as nullable in the model.
                decimal? salary = aEmployee?.Salary ?? 0;
                string fullTime = aEmployee?.IsFullTime.ToString() ?? "<Unknown>";

                // package in dynanic variables within the {} 
                //    called string interpolation: contains literals and variables in the string
                //    c0 in salary formats the salary value
                results.Add($"Name: {name}, Department: {dept}, Salary: {salary:c0}, Full Time: {fullTime}");
            }

            // Anonymous type example - we commented out the return  View(results) to show this
            //    data type is inferrred from the actual data - which are strings
            var departments = new[] { "IT", "HR", "Accounting", "Shipping", "Production" };

            // Model just expects a collection of strings so this should be fine.
            return View(departments);

            // Pass our results list on to the View so it can be rendered - this is the original return value
            //return View(results);
        }
    }
}