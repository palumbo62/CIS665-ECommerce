using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.EntityFrameworkCore;
using BOG.Models;
using Microsoft.Extensions.Logging;

namespace BOG.Controllers
{
    public class PropertyTsController : Controller
    {
        private readonly PalumboDBContext _context;

        private ILogger _logger { get; }

        public PropertyTsController(PalumboDBContext context, ILogger<Program> aLogger)
        {
            _context = context;
            _logger = aLogger;
        }

        // GET: PropertyTs
        public async Task<IActionResult> Index()
        {
            var PalumboDBContext = _context.PropertyT.Include(p => p.PropertyTypeIdFkNavigation);
            return View(await PalumboDBContext.ToListAsync());
        }

        // GET: PropertyTs/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var propertyT = await _context.PropertyT
                .Include(p => p.PropertyTypeIdFkNavigation)
                .FirstOrDefaultAsync(m => m.PropertyIdPk == id);
            if (propertyT == null)
            {
                return NotFound();
            }

            return View(propertyT);
        }

        // GET: PropertyTs/Create
        public IActionResult Create()
        {
            ViewData["PropertyTypeIdFk"] = new SelectList(_context.PropertyTypeT, "PropertyTypeIdPk", "PropertyTypeIdPk");
            return View();
        }

        // POST: PropertyTs/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("PropertyIdPk,PropertyTypeIdFk,PropertyTitle,Address,City,State,Zipcode,DailyPrice,NumBedrooms,NumBathrooms,SqFt,GuestCnt,Pic,ImageName,Description")] PropertyT propertyT)
        {
            if (ModelState.IsValid)
            {
                _context.Add(propertyT);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            ViewData["PropertyTypeIdFk"] = new SelectList(_context.PropertyTypeT, "PropertyTypeIdPk", "PropertyTypeIdPk", propertyT.PropertyTypeIdFk);
            return View(propertyT);
        }

        // GET: PropertyTs/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var propertyT = await _context.PropertyT.FindAsync(id);
            if (propertyT == null)
            {
                return NotFound();
            }
            ViewData["PropertyTypeIdFk"] = new SelectList(_context.PropertyTypeT, "PropertyTypeIdPk", "PropertyTypeIdPk", propertyT.PropertyTypeIdFk);
            return View(propertyT);
        }

        // POST: PropertyTs/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("PropertyIdPk,PropertyTypeIdFk,PropertyTitle,Address,City,State,Zipcode,DailyPrice,NumBedrooms,NumBathrooms,SqFt,GuestCnt,Pic,ImageName,Description")] PropertyT propertyT)
        {
            if (id != propertyT.PropertyIdPk)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(propertyT);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!PropertyTExists(propertyT.PropertyIdPk))
                    {
                        return NotFound();
                    }
                    else
                    {
                        throw;
                    }
                }
                return RedirectToAction(nameof(Index));
            }
            ViewData["PropertyTypeIdFk"] = new SelectList(_context.PropertyTypeT, "PropertyTypeIdPk", "PropertyTypeIdPk", propertyT.PropertyTypeIdFk);
            return View(propertyT);
        }

        // GET: PropertyTs/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var propertyT = await _context.PropertyT
                .Include(p => p.PropertyTypeIdFkNavigation)
                .FirstOrDefaultAsync(m => m.PropertyIdPk == id);
            if (propertyT == null)
            {
                return NotFound();
            }

            return View(propertyT);
        }

        // POST: PropertyTs/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var propertyT = await _context.PropertyT.FindAsync(id);
            _context.PropertyT.Remove(propertyT);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool PropertyTExists(int id)
        {
            return _context.PropertyT.Any(e => e.PropertyIdPk == id);
        }
    }
}
