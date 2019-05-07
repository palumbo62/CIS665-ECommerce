using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using HandsOnEx4.Models;

namespace HandsOnEx4.Controllers
{
    public class HOE5Controller : Controller
    {
        private readonly TaraStoreContext _context;

        public HOE5Controller(TaraStoreContext context)
        {
            _context = context;
        }

        // GET: HOE5
        public async Task<IActionResult> Index()
        {
            var taraStoreContext = _context.Product.Include(p => p.CategoryFkNavigation).
                Include(p => p.SubCategoryFkNavigation).OrderBy(p => p.ModelName);
            return View(await taraStoreContext.ToListAsync());
        }

        // GET: HOE5/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                //return NotFound();

                // Used nameof() because it will handle indirect reference to the name 
                // incase the actual name changes
                return RedirectToAction(nameof(Index));
            }

            // FirstOrDefault() - matches the first product OR a default product
            // Using just First() will throw an error if the product id is not found
            var product = await _context.Product
                .Include(p => p.CategoryFkNavigation)
                .Include(p => p.SubCategoryFkNavigation)
                .FirstOrDefaultAsync(m => m.ProductPk == id);

            if (product == null)
            {
                //return NotFound();
                // if this case happens we are assuming someone is messing directly
                // with the URL and trying to hack a product id so just redirect
                // back to home
                return RedirectToAction(nameof(Index));
            }

            return View(product);
        }

        // GET: HOE5/Create
        public IActionResult Create()
        {
            // Dropdown to provide to the user - we modified as shown

            // ViewData["CategoryFk"] = new SelectList(_context.Category, "CategoryPk", "CategoryImage");
            ViewData["CategoryFk"] = new SelectList(_context.Category.OrderBy(p => p.CategoryName), "CategoryPk", "CategoryName");
            //ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory, "SubCategoryPk", "Description");
            //ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(p => p.SubCategoryName), "SubCategoryPk", "SubCategoryName");
            ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(p => p.CategoryFkNavigation.CategoryName).ThenBy(s => s.SubCategoryName), "SubCategoryPk", "SubCategoryName");

            return View();
        }

        // POST: HOE5/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("CategoryFk,SubCategoryFk,ModelNumber,ModelName,ProductImage,UnitCost,Description,Thumbnail,Availability")] Product product)
        {
            if (ModelState.IsValid)
            {
                _context.Add(product);
                await _context.SaveChangesAsync();

                //XRLP
                TempData["message"] = $"{product.ModelName} has been added";

                return RedirectToAction(nameof(Index));
            }

            //XRLP - these lists are slightly differenet from the HttpGet Create above - this keeps track of the  categories they have 
            //already selected is reshown in case errors were detected - don't want the user to have to start over with their selections
            //but the defaaults that were autocreated will display the wrong names shown here

            //ViewData["CategoryFk"] = new SelectList(_context.Category, "CategoryPk", "CategoryImage", product.CategoryFk);
            //ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory, "SubCategoryPk", "Description", product.SubCategoryFk);

            ViewData["CategoryFk"] = new SelectList(_context.Category.OrderBy(p => p.CategoryName), "CategoryPk", "CategoryName", product.CategoryFk);
            //ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(p => p.SubCategoryName), "SubCategoryPk", "SubCategoryName", product.SubCategoryFk);
            ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(p => p.CategoryFkNavigation.CategoryName).ThenBy(s => s.SubCategoryName), "SubCategoryPk", "SubCategoryName");

            return View(product);
        }

        // GET: HOE5/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                //XRLP
                //return NotFound();
                return RedirectToAction(nameof(Index));
            }

            var product = await _context.Product.FindAsync(id);

            if (product == null)
            {
                //XRLP
                //return NotFound();
                return RedirectToAction(nameof(Index));
            }

            ViewData["CategoryFk"] = new SelectList(_context.Category.OrderBy(p => p.CategoryName), "CategoryPk", "CategoryName", product.CategoryFk);
            //ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(p => p.SubCategoryName), "SubCategoryPk", "SubCategoryName", product.SubCategoryFk);
            ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(p => p.CategoryFkNavigation.CategoryName).
                ThenBy(s => s.SubCategoryName), "SubCategoryPk", "SubCategoryName", product.SubCategoryFk);

            return View(product);
        }

        // POST: HOE5/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("ProductPk,CategoryFk,SubCategoryFk,ModelNumber,ModelName,ProductImage,UnitCost,Description,Thumbnail,Availability")] Product product)
        {
            if (id != product.ProductPk)
            {
                //XRLP
                //return NotFound();
                RedirectToAction(nameof(Index));
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(product);
                    await _context.SaveChangesAsync();
                }
                //XRLP - catch ANY error
                catch
                {
                    TempData["message"] = $"{product.ModelName} update failed";
                    return RedirectToAction(nameof(Index));
                }
                //catch (DbUpdateConcurrencyException)
                //{
                //    if (!ProductExists(product.ProductPk))
                //    {
                //        return NotFound();
                //    }
                //    else
                //    {
                //        throw;
                //    }
                //}
                TempData["message"] = $"{product.ModelName} has been updated";
                return RedirectToAction(nameof(Index));
            }

            ViewData["CategoryFk"] = new SelectList(_context.Category.OrderBy(p => p.CategoryName), "CategoryPk", "CategoryName", product.CategoryFk);
            //ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(p => p.SubCategoryName), "SubCategoryPk", "SubCategoryName", product.SubCategoryFk);
            ViewData["SubCategoryFk"] = new SelectList(_context.SubCategory.OrderBy(p => p.CategoryFkNavigation.CategoryName).
                ThenBy(s => s.SubCategoryName), "SubCategoryPk", "SubCategoryName", product.SubCategoryFk);

            return View(product);
        }

        // GET: HOE5/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                //return NotFound();
                return RedirectToAction(nameof(Index));
            }

            var product = await _context.Product
                .Include(p => p.CategoryFkNavigation)
                .Include(p => p.SubCategoryFkNavigation)
                .FirstOrDefaultAsync(m => m.ProductPk == id);

            if (product == null)
            {
                //return NotFound();
                return RedirectToAction(nameof(Index));
            }

            return View(product);
        }

        // POST: HOE5/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var product = await _context.Product.FindAsync(id);

            //RLP 
            if (product == null)
            {
                return RedirectToAction(nameof(Index));
            }

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

            TempData["message"] = $"{product.ModelName} has been deleted";
            return RedirectToAction(nameof(Index));
        }

        private bool ProductExists(int id)
        {
            return _context.Product.Any(e => e.ProductPk == id);
        }
    }
}
