//Demo 6 - Authentication Basics; LV

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

//add the following namespaces

using Microsoft.EntityFrameworkCore;
using Demo6.Models;
using System.Security.Claims;
using Microsoft.AspNetCore.Authorization;

namespace Demo6.Controllers
{
    public class RestrictController : Controller
    {
        private readonly TaraStoreContext _context;

        public RestrictController(TaraStoreContext context)
        {
            _context = context;
        }

        // From Microsoft Documentation - "Specifies that access to a controller or action method is restricted to users who meet the authorization requirement."

        [Authorize]
        public async Task<IActionResult> MyOrders()
        {
            // retrieve the user's PK from the Claims collection
            // since the PK is stored as a string, it has to be parsed to an integer

            int userPK = Int32.Parse(HttpContext.User.Claims.FirstOrDefault(x => x.Type == ClaimTypes.Sid).Value);
            
            // retrieve the user's orders

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
            // retrieve all orders for those customers who have orders

            var customer = _context.LoginInfo
                .Where(c => c.TblOrder.Count > 0)
                .Include(cust => cust.TblOrder)
                .ThenInclude(order => order.TblOrderDetail)
                .ThenInclude(detail => detail.ProductFkNavigation)
                .OrderBy(c => c.FullName);

            return View(await customer.ToListAsync());
        }
    }
}