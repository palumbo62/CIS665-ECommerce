using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

using HandsOnEx4.Models;
using Microsoft.EntityFrameworkCore;
using Microsoft.AspNetCore.Mvc.Rendering;

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

        // Parameter is used to access data thru the URL as a GET operation
        public IActionResult SortView(String sortOrder)
        {
            // Need to tell the View which way the sort order should be each time the
            // user clicks on a clickable column that can be sorted ascending  versus
            // descending - first time it defaults to name ascending order, next time it
            // will be descending order etc
            ViewData["NameSortParam"] = String.IsNullOrEmpty(sortOrder) ? "nameDesc" : "";
            ViewData["PriceSortParam"] = sortOrder == "price" ? "priceDesc" : "price";
        }
    }
}