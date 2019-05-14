using HandsOnEx4.Models;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System;
using System.Linq;

namespace HandsOnEx4.Controllers
{
    public class HOE4Controller : Controller
    {
        // Link to be able to access the database
        private readonly TaraStoreContext aTSContext;

        // Add constructor which uses dependency injection to specify
        // the context to use at runtime
        public HOE4Controller(TaraStoreContext aContext)
        {
            aTSContext = aContext;
        }

        public IActionResult TableView()
        {
            // implicit variable with type coming from the variable used to assign
            //
            // All of the next line uses LINQ (Language Integrated Query)
            // aTSContext gives access to all the database tables which were auto 
            // created for us.   Check out Product.cs to see these 2 extra properties
            // which created the navigation properties shown here (category and subcategory)
            // which then allows us to access the data between tables without doing a join
            // operation
            //
            // Also uses Lambda - allows creation of anonymous classes or method inline.
            // 'p' is a parameter which allows access to the Category and further SubCategory
            // using minimal amount of code/syntax
            //
            var products = aTSContext.Product.Include(p => p.CategoryFkNavigation).Include
                (p => p.SubCategoryFkNavigation);


            // Reference the HOE4 views
            return View(products.ToList());
        }

        // Added for showing a list view of products
        public IActionResult ListView()
        {
            //LINQ syntax with lambda
            var products = aTSContext.Product.OrderBy(p => p.ModelName);

            return View(products.ToList());
        }

        // SORTING THE DATA IN THE VIEW
        public IActionResult SortView(string sortOrder)
        {
            // IMPORTANT STUFF HERE - INFO IS PASSED THRU THE URL
            // Want to use sortOrder  to be able to tell the View how to sort
            // the specified information based upon user selection - it starts
            // out in ascending order (we are uing model name and price)
            // This is by clickin on the column header and reverse the order
            // on the next time user click on the column header again
            ViewData["NameSortParam"] = String.IsNullOrEmpty(sortOrder) ? "nameDesc" : "";
            ViewData["PriceSortParam"] = sortOrder == "price" ? "priceDesc" : "price";

            // Get the data and sort it, using LINQ with a 'method' syntax that looks
            // more like SQL (sort of backwards usage).  p is a range variable

            // select all products 'p' in the Product table
            var products = from p in aTSContext.Product select p;

            // now look at sortOrder parameter to determine how to sort it
            switch (sortOrder)
            {
                case "nameDesc":
                    // descending on ModelName descending
                    products = products.OrderByDescending(p => p.ModelName);
                    break;
                case "price":
                    products = products.OrderBy(p => p.UnitCost);
                    break;
                case "priceDesc":
                    // descending on ModelName descending
                    products = products.OrderByDescending(p => p.UnitCost);
                    break;
                default:
                    products = products.OrderBy(p => p.ModelName);
                    break;
            }

            return View(products.ToList());
        }


        // FILTERING THE DATA IN THE VIEW - AGAIN USING PARAMS ON HOW TO SORT
        // decimal? mean param can be NULL
        public IActionResult FilterView(string searchName, decimal? priceMin, decimal? priceMax)
        {
            // Pass the params back to the View so user can see what they searched on
            ViewData["NameFilter"] = searchName;
            ViewData["PriceMinFilter"] = priceMin;
            ViewData["PriceMaxFilter"] = priceMax;

            // so you get ALL the products and then APPLY the FILTERS to narrow it down
            var products = from p in aTSContext.Product select p;

            // Now filter
            if (!String.IsNullOrEmpty(searchName))
            {
                products = products.Where(p => p.ModelName.Contains(searchName));
            }

            if (priceMin != null)
            {
                products = products.Where(p => p.UnitCost >= priceMin);
            }

            if (priceMax != null)
            {
                products = products.Where(p => p.UnitCost <= priceMax);
            }

            // Order by Name then Cost and call ToList to actually execute the query and
            // create the result set
            return View(products.OrderBy(p => p.ModelName).ThenBy(p => p.UnitCost).ToList());
        }
    }
}