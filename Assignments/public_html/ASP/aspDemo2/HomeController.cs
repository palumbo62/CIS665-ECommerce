//Demo 2 - C# Review; LV; Based on Adam Freeman's Pro ASP.Net Core MVC 2

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Demo2.Models;

namespace Demo2.Controllers
{
    public class HomeController : Controller
    {
        public ViewResult Index()
        {
            // Example 1 - null conditional operator

            // instantiate a strongly typed list collection of strings

            List<string> results = new List<string>();

            // add property values of car objects as strings to results

            foreach (Car aCar in Car.GetCars())
            {
                // ? is a null conditional operator
                // test the value of aCar for null before attempting to access its properties
                // used to avoid NullReferenceException errors when attempting to access the properties of a null object 

                string make = aCar?.CarManufacturer;
                string model = aCar?.CarModel;
                decimal? price = aCar?.CarPrice;
                string size = aCar?.CarSize.ToString();
                string stock = aCar?.InStock.ToString();

                // string interpolation - for concatenating string literals and variables

                results.Add($"Manufacturer: {make}, Model: {model}, Price: {price:c2}, Size: {size}, In Stock: {stock}");
            }

            return View(results);



            //// Example 2 - null coalescing operator

            //List<string> results = new List<string>();

            //foreach (Car aCar in Car.GetCars())
            //{
            //    // ?? is a coalescing operator
            //    // used to provide a fallbackvalue for null value

            //    string make = aCar?.CarManufacturer ?? "<Unknown Manufacturer>";
            //    string model = aCar?.CarModel ?? "<Unknown Model>"; 
            //    decimal? price = aCar?.CarPrice ?? 0;
            //    string size = aCar?.CarSize.ToString() ?? "<Unknown Size>";
            //    string stock = aCar?.InStock.ToString() ?? "<Who knows>";

            //    results.Add($"Manufacturer: {make}, Model: {model}, Price: {price:c2}, Size: {size}, In Stock: {stock}");
            //}

            //return View(results);



            //// Example 3 - index initializer

            //// initializing a collection that uses an index

            //Dictionary<string, Car> cars = new Dictionary<string, Car>
            //{
            //    ["Forte"] = new Car { CarManufacturer = "Kia", CarModel = "Forte", CarPrice = 19790, CarSize = CarClassification.Compact },
            //    ["Fusion"] = new Car { CarManufacturer = "Ford", CarModel = "Fusion", CarPrice = 27840, CarSize = CarClassification.MidSize },
            //    ["LaCrosse"] = new Car { CarManufacturer = "Buick", CarModel = "LaCrosse", CarPrice = 33070, CarSize = CarClassification.Large }
            //};

            //return View(cars.Keys);



            //// Example 4 - pattern matching

            //// pattern matching - to test if an object is of a specific type or has specific characteristics

            //object[] data = new object[] { 100M, 25.50M, "beach?", "mountain?", "no, office", 100, 25 };

            //decimal total = 0;

            //for (int i = 0; i < data.Length; ++i)
            //{
            //    // if data[i] is a decimal, then the value of data[i] will be assigned to d

            //    if (data[i] is decimal d)
            //    {
            //        total += d;
            //    }
            //}

            //return View(new string[] { $"Total: {total:c2}" });



            //// Example 5 - pattern matching and the when keyword

            //// pattern matching - used in switch statement; the when keyword can be used for additional restrictions

            //object[] data = new object[] { 100M, 25.50M, "beach?", "mountain?", "no, office", 100, 25 };

            //decimal total = 0;

            //for (int i = 0; i < data.Length; ++i)
            //{
            //    // if data[i] is a decimal, then the value of data[i] will be assigned to decValue
            //    // if data[i] is an integer and the value is > 50, then the value of data[i] will be assigned to intValue

            //    switch (data[i])
            //    {
            //        case decimal decValue:
            //            total += decValue;
            //            break;
            //        case int intValue when intValue > 50:
            //            total += intValue;
            //            break;
            //    }
            //}

            //return View(new string[] { $"Total: {total:c2}" });



            //// Example 6 - using an extension method

            //// instantiate and initialize a CarInventory object

            //CarInventory aInventory = new CarInventory { Cars = Car.GetCars() };

            //// call the extension method to calculate the total value of cars

            //decimal carPricesTotal = aInventory.TotalValue();

            //return View(new string[] { $"Total: {carPricesTotal:c2}" });



            ////Example 7 - type inferencing

            //// the var keyword can be used to declare variables without an explicit variable type
            //// the compiler infers the type from the values assigned to the array

            //var models = new[] { "Malibu", "Passat", "Avalon", "Impala", "Prius", "Elantra" };

            //return View(models);



            // Example 8 - lambda expressions

            // lambda expressions enable the creation of simple anonymous methods
            // these methods do not have names and can be passed as an argument to methods
            
            // c => c?.CarPrice > 30000 is an example of a lambda expression
            // c is the parameter; the type is inferred automatically; in this case a Car type
            // => is the lambda operator (read as "goes to")
            // c?.CarPrice > 30000 is an expression that represents the lambda's body and returns a bool result(i.e., true if price > 30000 or false if price <= 30000)
            
            // the lambda expression is passed as an argument to the Where extension method

            // decimal carPricesTotal = Car.GetCars().Where(c => c?.CarPrice > 30000).TotalValue1();

            // return View(new string[] { $"Total: {carPricesTotal:c2}" });

            // filter and select using lambda expressions
            
            // return View(Car.GetCars().Where(c => c?.CarPrice > 20000M).Select(c => c?.CarModel));

            // filter cars whose CarModel property value starts with the letter 'M'

            // return View(Car.GetCars().Where(c => c?.CarModel[0] == 'M').Select(c => c?.CarModel));



            // Example 9 - anonymous types

            // anonymously typed objects can be created without defining a class
            // the type definition is created automatically by the compiler

            //var cars = new[]
            //{
            //    new {Model = "WRX", Price = 36195M},
            //    new {Model = "Volt", Price = 38120M},
            //    new {Model = "Charger", Price = 59545M},
            //    new {Model = "Volt", Price = 38120M},
            //    new {Model = "Clarity", Price = 36620M},
            //};

            // return View(cars.Select(c => c.Model));

            // demonstrates the class name assigned by the compiler for the anonymous objects

            // return View(cars.Select(c => c.GetType().Name));



            // Example 10 - getting names

            //var cars = new[]
            //{
            //    new {Model = "WRX", Price = 36195M},
            //    new {Model = "Volt", Price = 38120M},
            //    new {Model = "Charger", Price = 59545M},
            //    new {Model = "Volt", Price = 38120M},
            //    new {Model = "Clarity", Price = 36620M},
            //};

            // return View(cars.Select(p => $"Model: {p.Model}, Price: {p.Price:c2}"));

            // nameof method is used to get the name of the property
            
            // return View(cars.Select(p => $"{nameof(p.Model)}: {p.Model}, {nameof(p.Price)}: {p.Price:c2}"));
        }
    }
}