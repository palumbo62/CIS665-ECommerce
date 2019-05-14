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
    public class CommentsTsController : Controller
    {
        private readonly PalumboDBContext _context;

        private ILogger _logger { get; }

        public CommentsTsController(PalumboDBContext context, ILogger<Program> aLogger)
        {
            _context = context;
            _logger = aLogger;
        }


        // GET: CommentsTs
        public async Task<IActionResult> Index()
        {
            var PalumboDBContext = _context.CommentsT.Include(c => c.PropertyIdFkNavigation).Include(c => c.UserIdFkNavigation);
            return View(await PalumboDBContext.ToListAsync());
        }

        // GET: CommentsTs/Details/5
        public async Task<IActionResult> Details(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var commentsT = await _context.CommentsT
                .Include(c => c.PropertyIdFkNavigation)
                .Include(c => c.UserIdFkNavigation)
                .FirstOrDefaultAsync(m => m.CommentIdPk == id);
            if (commentsT == null)
            {
                return NotFound();
            }

            return View(commentsT);
        }

        // GET: CommentsTs/Create
        public IActionResult Create()
        {
            ViewData["PropertyIdFk"] = new SelectList(_context.PropertyT, "PropertyIdPk", "Address");
            ViewData["UserIdFk"] = new SelectList(_context.UserT, "UserIdPk", "Address");
            return View();
        }

        // POST: CommentsTs/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Create([Bind("CommentIdPk,UserIdFk,PropertyIdFk,Rating,DateSubmitted,MonthYearVisit,Comments")] CommentsT commentsT)
        {
            if (ModelState.IsValid)
            {
                _context.Add(commentsT);
                await _context.SaveChangesAsync();
                return RedirectToAction(nameof(Index));
            }
            ViewData["PropertyIdFk"] = new SelectList(_context.PropertyT, "PropertyIdPk", "Address", commentsT.PropertyIdFk);
            ViewData["UserIdFk"] = new SelectList(_context.UserT, "UserIdPk", "Address", commentsT.UserIdFk);
            return View(commentsT);
        }

        // GET: CommentsTs/Edit/5
        public async Task<IActionResult> Edit(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var commentsT = await _context.CommentsT.FindAsync(id);
            if (commentsT == null)
            {
                return NotFound();
            }
            ViewData["PropertyIdFk"] = new SelectList(_context.PropertyT, "PropertyIdPk", "Address", commentsT.PropertyIdFk);
            ViewData["UserIdFk"] = new SelectList(_context.UserT, "UserIdPk", "Address", commentsT.UserIdFk);
            return View(commentsT);
        }

        // POST: CommentsTs/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see http://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> Edit(int id, [Bind("CommentIdPk,UserIdFk,PropertyIdFk,Rating,DateSubmitted,MonthYearVisit,Comments")] CommentsT commentsT)
        {
            if (id != commentsT.CommentIdPk)
            {
                return NotFound();
            }

            if (ModelState.IsValid)
            {
                try
                {
                    _context.Update(commentsT);
                    await _context.SaveChangesAsync();
                }
                catch (DbUpdateConcurrencyException)
                {
                    if (!CommentsTExists(commentsT.CommentIdPk))
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
            ViewData["PropertyIdFk"] = new SelectList(_context.PropertyT, "PropertyIdPk", "Address", commentsT.PropertyIdFk);
            ViewData["UserIdFk"] = new SelectList(_context.UserT, "UserIdPk", "Address", commentsT.UserIdFk);
            return View(commentsT);
        }

        // GET: CommentsTs/Delete/5
        public async Task<IActionResult> Delete(int? id)
        {
            if (id == null)
            {
                return NotFound();
            }

            var commentsT = await _context.CommentsT
                .Include(c => c.PropertyIdFkNavigation)
                .Include(c => c.UserIdFkNavigation)
                .FirstOrDefaultAsync(m => m.CommentIdPk == id);
            if (commentsT == null)
            {
                return NotFound();
            }

            return View(commentsT);
        }

        // POST: CommentsTs/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public async Task<IActionResult> DeleteConfirmed(int id)
        {
            var commentsT = await _context.CommentsT.FindAsync(id);
            _context.CommentsT.Remove(commentsT);
            await _context.SaveChangesAsync();
            return RedirectToAction(nameof(Index));
        }

        private bool CommentsTExists(int id)
        {
            return _context.CommentsT.Any(e => e.CommentIdPk == id);
        }
    }
}
