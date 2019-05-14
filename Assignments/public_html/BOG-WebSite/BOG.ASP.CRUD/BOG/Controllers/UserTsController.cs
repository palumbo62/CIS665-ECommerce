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
    public class UserTsController : Controller
    {
        private readonly PalumboDBContext _context;

        private ILogger _logger { get; }

        public UserTsController(PalumboDBContext context, ILogger<Program> aLogger)
        {
            _context = context;
            _logger = aLogger;
        }

        // GET: UserTs
        public async Task<IActionResult> Index()
        {
            return View(await _context.UserT.ToListAsync());
        }

        // GET: UserTs/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var userT = await _context.UserT
                .FirstOrDefaultAsync(m => m.UserIdPk == id);
            if (userT == null)
            {
                return NotFound();
            }

            return View(userT);
        }

        // GET: UserTs/Create
        public IActionResult Create()
        {
            return View();
        }

        // POST: UserTs/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("UserIdPk,RoleIdFk,UserEmail,Password,FirstName,LastName,Address,City,State,Zipcode,PhoneNumber,Ccnumber,CcexpDate,Cccvc")] UserT userT)
        {
            if (ModelState.IsValid)
            {
                _context.Add(userT);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            return View(userT);
        }

        // GET: UserTs/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var userT = await _context.UserT.FindAsync(id);
            if (userT == null)
            {
                return NotFound();
            }
            return View(userT);
        }

        // POST: UserTs/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("UserIdPk,RoleIdFk,UserEmail,Password,FirstName,LastName,Address,City,State,Zipcode,PhoneNumber,Ccnumber,CcexpDate,Cccvc")] UserT userT)
        {
            if (id != userT.UserIdPk)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(userT);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!UserTExists(userT.UserIdPk))
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
            return View(userT);
        }

        // GET: UserTs/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var userT = await _context.UserT
                .FirstOrDefaultAsync(m => m.UserIdPk == id);
            if (userT == null)
            {
                return NotFound();
            }

            return View(userT);
        }

        // POST: UserTs/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var userT = await _context.UserT.FindAsync(id);
            _context.UserT.Remove(userT);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool UserTExists(int id)
        {
            return _context.UserT.Any(e => e.UserIdPk == id);
        }
    }
}
