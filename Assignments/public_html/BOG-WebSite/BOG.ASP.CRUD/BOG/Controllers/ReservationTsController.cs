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
    public class ReservationTsController : Controller
    {
        private readonly PalumboDBContext _context;

        private ILogger _logger { get; }

        public ReservationTsController(PalumboDBContext context, ILogger<Program> aLogger)
        {
            _context = context;
            _logger = aLogger;
        }


        // GET: ReservationTs
        public async Task<IActionResult> Index()
        {
            var PalumboDBContext = _context.ReservationT.Include(r => r.PropertyIdFkNavigation).Include(r => r.UserIdFkNavigation);
            return View(await PalumboDBContext.ToListAsync());
        }

        // GET: ReservationTs/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var reservationT = await _context.ReservationT
                .Include(r => r.PropertyIdFkNavigation)
                .Include(r => r.UserIdFkNavigation)
                .FirstOrDefaultAsync(m => m.ReservationIdPk == id);
            if (reservationT == null)
            {
                return NotFound();
            }

            return View(reservationT);
        }

        // GET: ReservationTs/Create
        public IActionResult Create()
        {
            ViewData["PropertyIdFk"] = new SelectList(_context.PropertyT, "PropertyIdPk", "Address");
            ViewData["UserIdFk"] = new SelectList(_context.UserT, "UserIdPk", "Address");
            return View();
        }

        // POST: ReservationTs/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("ReservationIdPk,PropertyIdFk,UserIdFk,CheckIn,CheckOut,TotalPayment,GuestCnt")] ReservationT reservationT)
        {
            if (ModelState.IsValid)
            {
                _context.Add(reservationT);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            ViewData["PropertyIdFk"] = new SelectList(_context.PropertyT, "PropertyIdPk", "Address", reservationT.PropertyIdFk);
            ViewData["UserIdFk"] = new SelectList(_context.UserT, "UserIdPk", "Address", reservationT.UserIdFk);
            return View(reservationT);
        }

        // GET: ReservationTs/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var reservationT = await _context.ReservationT.FindAsync(id);
            if (reservationT == null)
            {
                return NotFound();
            }
            ViewData["PropertyIdFk"] = new SelectList(_context.PropertyT, "PropertyIdPk", "Address", reservationT.PropertyIdFk);
            ViewData["UserIdFk"] = new SelectList(_context.UserT, "UserIdPk", "Address", reservationT.UserIdFk);
            return View(reservationT);
        }

        // POST: ReservationTs/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("ReservationIdPk,PropertyIdFk,UserIdFk,CheckIn,CheckOut,TotalPayment,GuestCnt")] ReservationT reservationT)
        {
            if (id != reservationT.ReservationIdPk)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(reservationT);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!ReservationTExists(reservationT.ReservationIdPk))
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
            ViewData["PropertyIdFk"] = new SelectList(_context.PropertyT, "PropertyIdPk", "Address", reservationT.PropertyIdFk);
            ViewData["UserIdFk"] = new SelectList(_context.UserT, "UserIdPk", "Address", reservationT.UserIdFk);
            return View(reservationT);
        }

        // GET: ReservationTs/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var reservationT = await _context.ReservationT
                .Include(r => r.PropertyIdFkNavigation)
                .Include(r => r.UserIdFkNavigation)
                .FirstOrDefaultAsync(m => m.ReservationIdPk == id);
            if (reservationT == null)
            {
                return NotFound();
            }

            return View(reservationT);
        }

        // POST: ReservationTs/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var reservationT = await _context.ReservationT.FindAsync(id);
            _context.ReservationT.Remove(reservationT);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool ReservationTExists(int id)
        {
            return _context.ReservationT.Any(e => e.ReservationIdPk == id);
        }
    }
}
