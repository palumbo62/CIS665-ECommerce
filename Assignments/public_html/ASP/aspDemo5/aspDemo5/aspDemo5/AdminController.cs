//Demo 5 - CRUD Basics; LV; Based on Adam Freeman's Pro ASP.Net Core MVC 2 & Microsoft ASP.Net Core Documentation

// This code for this controller and the views in the Views/Admin folder were auto-generated
// Changes and additions were made to the auto-generated code

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using Demo5.Models;

namespace Demo5.Controllers
{
    public class AdminController : Controller
    {
        private readonly TaraStoreContext _context;

        public AdminController(TaraStoreContext context)
        {
            _context = context;
        }

        // Asynchronous methods improve performance by taking advantage of multiple processors to complete tasks in parallel
        // Work that will be done asynchronously are represented as Tasks
        // The await keyword tells the compiler to wait for the results of the asynchronous method to be returned before continuing to execute other statements in the method

        public async Task<IActionResult> Index()
        {
            //Added OrderBy

            var taraStoreContext = _context.Product.Include(p => p.CategoryFkNavigation).Include(p => p.SubCategoryFkNavigation).OrderBy(p => p.ModelName);

            return View(await taraStoreContext.ToListAsync());
        }

        // GET: Admin/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                // changed code here
                // if id is null, send the user back to the Index View
                
                // the nameOf method is used to obtain the name of a variable, method or class
                // return RedirectToAction("Index") can be restated as follows:

                return RedirectToAction(nameof(Index));
            }

            // find the product whose ProductPk matches id

            var product = await _context.Product
                .Include(p => p.CategoryFkNavigation)
                .Include(p => p.SubCategoryFkNavigation)
                .FirstOrDefaultAsync(m => m.ProductPk == id);

            if (product == null)
            {
                //changed code here

                return RedirectToAction(nameof(Index));
            }

            return View(product);
        }

        // GET: Admin/Create
        public IActionResult Create()
        {
            // corrected column names here; and ordered the items

            // the SelectList list objects will be used in the View to set-up drop downs for CategoryFK and SubCategoryFK

            // records from the Category and SubCategory tables will be used to create the items in the drop-downs
            
            // CategoryFK and SubCategoryPK will be the values and CategoryName and SubCategoryName will be the text for each item in the drop-downs
           
            ViewData["CategoryFk"] = new SelectList(_context.Category.OrderBy(c => c.CategoryName), "CategoryPk", "CategoryName");
            ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(s => s.SubCategoryName), "SubCategoryPk", "SubCategoryName");

            return View();
        }

        // POST: Admin/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("ProductPk,CategoryFk,SubCategoryFk,ModelNumber,ModelName,ProductImage,UnitCost,Description,Thumbnail,Availability")] Product product)
        {
            if (ModelState.IsValid)
            {
                _context.Add(product);
                await _context.SaveChangesAsync();

                //TempData is a key/value dictionary that can be used to persist data. The data persists until it is read
                //Check _Layout.cshtml to see how the element with a key of "message" is used

                TempData["message"] = $"{product.ModelName} has been added";
                return RedirectToAction(nameof(Index));
            }

            // if the data is not valid

            //replaced code here

            ViewData["CategoryFk"] = new SelectList(_context.Category.OrderBy(c => c.CategoryName), "CategoryPk", "CategoryName", product.CategoryFk);

            ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(s => s.SubCategoryName), "SubCategoryPk", "SubCategoryName", product.SubCategoryFk);

            return View(product);
        }

        // GET: Admin/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                //changed code here

                RedirectToAction(nameof(Index));
            }

            var product = await _context.Product.FindAsync(id);

            if (product == null)
            {
                //changed code here

                return RedirectToAction(nameof(Index));
            }

            // corrected column names here

            // the SelectList list objects will be used in the View to set-up drop downs for CategoryFK and SubCategoryFK

            // records from the Category and SubCategory tables will be used to create the items in the drop-downs 
            // CategoryFK and SubCategoryPK will be the values and CategoryName and SubCategoryName will be the text for each item in the drop-downs
            // the items selected by default in the drop-downs will be the Category and SubCategory whose CategoryPk and SubCategoryPk match the CategoryFk and SubCategoryFk of the product being edited

            ViewData["CategoryFk"] = new SelectList(_context.Category.OrderBy(c => c.CategoryName), "CategoryPk", "CategoryName", product.CategoryFk);

            ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(s => s.SubCategoryName), "SubCategoryPk", "SubCategoryName", product.SubCategoryFk);

            return View(product);
        }

        // POST: Admin/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("ProductPk,CategoryFk,SubCategoryFk,ModelNumber,ModelName,ProductImage,UnitCost,Description,Thumbnail,Availability")] Product product)
        {
            if (id != product.ProductPk)
            {
                //changed code here

                return RedirectToAction(nameof(Index));
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(product);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!ProductExists(product.ProductPk))
                    {
                        //changed code here

                        return RedirectToAction(nameof(Index));
                    }

                    // changed code here

                    return RedirectToAction(nameof(Index));
                 }

                //TempData is a key/value dictionary that can be used to persist data. The data persists until it is read
                //Check _Layout.cshtml to see how the element with a key of "message" is used

                TempData["message"] = $"{product.ModelName} has been updated";

                return RedirectToAction(nameof(Index));
            }

            // if the data is not valid

            //replaced code here

            ViewData["CategoryFk"] = new SelectList(_context.Category.OrderBy(c => c.CategoryName), "CategoryPk", "CategoryName", product.CategoryFk);

            ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(s => s.SubCategoryName), "SubCategoryPk", "SubCategoryName", product.SubCategoryFk);

            return View(product);
        }

        // GET: Admin/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                //changed code here

                RedirectToAction(nameof(Index));
            }

            var product = await _context.Product
                .Include(p => p.CategoryFkNavigation)
                .Include(p => p.SubCategoryFkNavigation)
                .FirstOrDefaultAsync(m => m.ProductPk == id);

            if (product == null)
            {
                //changed code here

                return RedirectToAction(nameof(Index));
            }

            return View(product);
        }

        // POST: Admin/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            //changed code here

            var product = await _context.Product.FindAsync(id);

            if (product == null)
            {
                return RedirectToAction(nameof(Index));
            }

            // string productName = product.ModelName;

            try
            {
                _context.Product.Remove(product);
                await _context.SaveChangesAsync();
            }
            catch
            {
                TempData["message"] = $"{product.ModelName} not deleted";
                return RedirectToAction(nameof(Index));
            }
            
            //TempData is a key/value dictionary that can be used to persist data. The data persists until it is read
            //Check _Layout.cshtml to see how the element with a key of "message" is used

            TempData["message"] = $"{product.ModelName} has been deleted";
            return RedirectToAction(nameof(Index));
        }

        private bool ProductExists(int id)
        {
            return _context.Product.Any(e => e.ProductPk == id);
        }
    }
}
