using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using BOG.Models;
using Microsoft.AspNetCore.Mvc.Rendering;
using Microsoft.Extensions.Logging;

namespace BOG.Controllers
{
    public class HomeController : Controller
    {
        private readonly PalumboDBContext _context;

        protected BogHomeSearch homeSearch = null;

        private ILogger _logger { get; }

        public HomeController(PalumboDBContext context, ILogger<Program> aLogger)
        {
            _context = context;
            _logger = aLogger;

            homeSearch = new BogHomeSearch();
            homeSearch.propTypeLlist = context.PropertyTypeT.Distinct().Select(p => new SelectListItem()
                                            {
                                                Value = p.PropertyTypeIdPk.ToString(),
                                                Text = p.PropertyTypeName
                                            }).ToList();
        }

        public IActionResult Index()
        {
            ViewData["HomeSearch"] = homeSearch;

            return View();
        }

        public IActionResult About()
        {
            return View();
        }

        public IActionResult Privacy()
        {
            return View();
        }

        [ResponseCache(Duration = 0, Location = ResponseCacheLocation.None, NoStore = true)]
        public IActionResult Error()
        {
            return View(new ErrorViewModel { RequestId = Activity.Current?.Id ?? HttpContext.TraceIdentifier });
        }
    }
}
