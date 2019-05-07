using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

//RLP
using Microsoft.EntityFrameworkCore;
using HandsOnEx6.Models;
using Microsoft.AspNetCore.Authentication;
using Microsoft.AspNetCore.Authentication.Cookies;
using System.Security.Claims;
using Microsoft.AspNetCore.Authorization;
//RLP - end

namespace HandsOnEx6.Controllers
{
    public class RestrictController : Controller
    {
        //RLP
        private readonly TaraStoreContext _context;

        //RLP - NOTE we didn't use scaffolding so we have to write all ths manually
        public RestrictController(TaraStoreContext context)
        {
            this._context = context;
        }

        public IActionResult Index()
        {
            return View();
        }

        //This annotation Makes the method only available if USER is authorized, can also add ROLE
       [Authorize]
        public async Task<IActionResult> MyOrders()
        {
            int userPK = Int32.Parse(HttpContext.User.Claims.FirstOrDefault(u => u.Type == ClaimTypes.Sid).Value);

            var orderDetail = _context.TblOrderDetail
                                .Include(od => od.OrderFkNavigation)
                                .Include(od => od.ProductFkNavigation)
                                .Where(u => u.OrderFkNavigation.CustomerFk == userPK)
                                .OrderBy(d => d.OrderFkNavigation.OrderDate);

            return View(await orderDetail.ToListAsync());
        }

        [Authorize(Roles = "Admin")]
        public async Task<IActionResult> AllOrders()
        {
            // Only want customers that actually have orders
            var customer = _context.LoginInfo.Where(c => c.TblOrder.Count > 0)
                               .Include(c => c.TblOrder)
                               .ThenInclude(o => o.TblOrderDetail)
                               .ThenInclude(d => d.ProductFkNavigation)
                               .OrderBy(c => c.FullName);

            return View(await customer.ToListAsync());
        }
    }
}