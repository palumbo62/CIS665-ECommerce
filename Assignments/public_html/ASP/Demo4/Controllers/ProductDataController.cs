//Demo 4 - DB Basics; LV;

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

//Add the following namespaces

using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using Demo4.Models;

namespace Demo4.Controllers
{
    public class ProductDataController : Controller
    {
        // declare a TaraStoreContext object variable

        private readonly TaraStoreContext aTSContext;

        // the controller's "dependency" on the TaraStoreContext class, is indicated by the parameter type in its constructor

        // using a technique called, Dependency Injection, MVC creates an instance of the TaraStoreContext class and passes that object to the constructor

        public ProductDataController(TaraStoreContext context)
        {
            aTSContext = context;
        }
        public IActionResult TableView()
        {
            // The context class has DbSet properties. The DbSet represents a collection of entities(i.e., Product, SubCategory, Category

            // Queries against the DbSet are specified using LINQ (Language Integrated Query)
            
            // define a LINQ query to retrieve all Products including Category and SubCategory data

            var products = aTSContext.Product.Include(p => p.CategoryFkNavigation).Include(p => p.SubCategoryFkNavigation);
            
            // the ToList() is a finalizing method that executes the query  

            return View(products.ToList());
        }

        public IActionResult ListView()
        {
            // define a LINQ query to retrieve all Products and order the result by Model Name

            var products = aTSContext.Product.OrderBy(p => p.ModelName);

            return View(products.ToList());
        }

        public IActionResult SortDemo(string sortOrder)
        {
            // the column to sort on is received as a parameter from the query string in the URL
            
            // ViewData is similar to ViewBag.  It is a dictionary collection of key/value pairs used to transfer data between Controller and Views

            // ternary operators are used to set the sort order for the next sort request - i.e. from ascending to descending and vice versa.

            // the ViewData elements will be used in the SortDemo View to set the hyperlinks for the column headings

            ViewData["NameSortParam"] = String.IsNullOrEmpty(sortOrder) ? "nameDesc" : "";

            ViewData["PriceSortParam"] = sortOrder == "price" ? "priceDesc" : "price";

            // define a LINQ query to retrieve all Products (using query syntax)

            var products = from p in aTSContext.Product select p;

            // a switch statement is used to specify the column and order (i.e., ascending or descending) to sort by

            switch (sortOrder)
            {
                case "nameDesc":
                    products = products.OrderByDescending(p => p.ModelName);
                    break;
                case "price":
                    products = products.OrderBy(p => p.UnitCost);
                    break;
                case "priceDesc":
                    products = products.OrderByDescending(p => p.UnitCost);
                    break;
                default:
                    products = products.OrderBy(p => p.ModelName);
                    break;
            }

            return View(products.ToList());
        }

        public IActionResult FilterDemo(string searchName, decimal? priceMin, decimal? priceMax)
        {
            // the ViewData elements are used pass back the filter values to the FilterDemo View

            ViewData["NameFilter"] = searchName;
            ViewData["PriceMinFilter"] = priceMin;
            ViewData["PriceMaxFilter"] = priceMax;

            var products = from p in aTSContext.Product select p;

            // depending on the filter values (received as parameters from the query string in the URL), where methods are used to filter the IQueryable object, products

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

            return View(products.OrderBy(p => p.ModelName).ThenBy(p => p.UnitCost).ToList());
        }

        public IActionResult PaginationDemo(int? pageNumber)
        {
            // the page number is received as a parameter from the query string in the URL

            // page size is set to 15

            int pageSize = 15;

            var products = from p in aTSContext.Product.OrderBy(p => p.ModelName) select p;

            // a new PaginatedList object is created, and sent to the PaginationDemo View

            return View(new PaginatedList<Product>(products, pageNumber ?? 1, pageSize));
        }

        // Combines the logic from the previous three demos
        // To reduce complexity, filtering is done on only Model Name
        public IActionResult SortFilterPageDemo(string sortOrder, string currentFilter, string searchName, int? pageNumber)
        {
            ViewData["CurrentSort"] = sortOrder;
            ViewData["NameSortParam"] = String.IsNullOrEmpty(sortOrder) ? "nameDesc" : "";
            ViewData["PriceSortParam"] = sortOrder == "price" ? "priceDesc" : "price";

            // if the search string has changed, the page number is reset to 1

            if (searchName != null)
            {
                pageNumber = 1;
            }
            else
            {
                searchName = currentFilter;
            }

            ViewData["CurrentFilter"] = searchName;

            var products = from p in aTSContext.Product select p;

            if (!String.IsNullOrEmpty(searchName))
            {
                products = products.Where(p => p.ModelName.Contains(searchName));
            }

            switch (sortOrder)
            {
                case "nameDesc":
                    products = products.OrderByDescending(p => p.ModelName);
                    break;
                case "price":
                    products = products.OrderBy(p => p.UnitCost);
                    break;
                case "priceDesc":
                    products = products.OrderByDescending(p => p.UnitCost);
                    break;
                default:
                    products = products.OrderBy(p => p.ModelName);
                    break;
            }

            int pageSize = 15;

            return View(new PaginatedList<Product>(products, pageNumber ?? 1, pageSize));
         }
    }
}