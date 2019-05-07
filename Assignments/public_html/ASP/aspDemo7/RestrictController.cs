//Demo 7 - Shopping Cart; LV

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;

//add the following namespaces

using Microsoft.EntityFrameworkCore;
using Demo7.Models;
using System.Security.Claims;
using Microsoft.AspNetCore.Authorization;

namespace Demo7.Controllers
{
    public class RestrictController : Controller
    {
        private readonly TaraStoreContext _context;

        public RestrictController(TaraStoreContext context)
        {
            _context = context;
        }

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

        [Authorize]
        public IActionResult CheckOut()
        {
            return RedirectToAction("MyCart", "Shop");
        }

        [Authorize]
        public IActionResult PlaceOrder()
        {
            Cart aCart = GetCart();

            if (aCart.CartItems().Any())
            {
                int userPK = Int32.Parse(HttpContext.User.Claims.FirstOrDefault(x => x.Type == ClaimTypes.Sid).Value);

                // insert order

                TblOrder aOrder = new TblOrder { CustomerFk = userPK, OrderDate = DateTime.Now };

                _context.Add(aOrder);
                _context.SaveChanges();

                // get the PK of the newly inserted order

                int orderPK = aOrder.OrderPk;

                // insert a orderdetail for each item in the cart

                foreach (CartItem aItem in aCart.CartItems())
                {
                    TblOrderDetail aDetail = new TblOrderDetail { ProductFk = aItem.Product.ProductPk, Quantity = aItem.Quantity, OrderFk = orderPK };
                    _context.Add(aDetail);
                }

                _context.SaveChanges();

                // remove all items from cart

                aCart.ClearCart();

                SaveCart(aCart);

                return View(nameof(OrderConfirmation));
            }

            return RedirectToAction("Search", "Shop");
        }

        private IActionResult OrderConfirmation()
        {
            return View();
        }

        private Cart GetCart()
        {
            Cart aCart = HttpContext.Session.GetObject<Cart>("Cart") ?? new Cart();
            return aCart;
        }

        private void SaveCart(Cart aCart)
        {
            HttpContext.Session.SetObject("Cart", aCart);
        }
    }
}