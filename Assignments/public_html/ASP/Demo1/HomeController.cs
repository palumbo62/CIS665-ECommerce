//Demo 1 - MVC Basics; LV; Based on Adam Freeman's Pro ASP.Net Core MVC 2

using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Threading.Tasks;
using Microsoft.AspNetCore.Mvc;
using Demo1.Models;

namespace Demo1.Controllers
{
    public class HomeController : Controller
    {
        // the ASP.NET Routing module is responsible for mapping incoming browser requests to particular MVC controller actions - Microsoft Docs

        // this action method handles requests to the following URLs - Demo1/, Demo1/Home, Demo1/Home/Index 

        // a ViewResult object renders a view
        public ViewResult Index()
        {
            int hour = DateTime.Now.Hour;

            // a ViewBag object can be used to send data to the view from the controller
            // arbitrary properties can be assigned to the ViewBag object 

            ViewBag.Greeting = hour < 12 ? "Good Morning" : "Good Afternoon";

            // call the View method to render the View MyView

            return View("MyView");
        }

        // this action method responds to a regular browser request for SongForm

        [HttpGet]
        public ViewResult SongForm()
        {
            // call the View method to render the View SongForm

            return View();
        }

        // this overloaded action method responds to a POST request (i.e., when SongForm is submitted)
        // the Model Binding feature of MVC automatically parses the key/value pairs of the POST data to set the properties of a domain model object (in this case, the ListenerRequest object) 

        [HttpPost]
        public ViewResult SongForm(ListenerRequest aResponse)
        {

            // the ModelState property is checked to see if there are validation errors

            if (ModelState.IsValid)
            {
                // pass the form data, that is passed to the SongForm action method as a ListenerRequest object, to the AddListenerRequest method

                ListenerRequestsList.AddListenerRequest(aResponse);

                // call the View method to render a View called Thanks and pass the ListenerRequest object as an argument to the View

                return View("Thanks", aResponse);
            }
            else
            {
                // there is a validation error
                return View();
            }

        }

        // action method for a request for ListRequests 
        public ViewResult ListRequests()
        {
            // call the View method to render a View called ListRequests and pass the collection of ListenerRequest objects as an argument to the View

            return View(ListenerRequestsList.GetListenerRequests);
        }

    }
}
