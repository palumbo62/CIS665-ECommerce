//Demo 4 - DB Basics; LV;

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

// add the following namespace
using Microsoft.EntityFrameworkCore;

namespace Demo4.Models
{
    // this class inherits List<T>, a strongly typed list of objects that can be accessed by index.
    public class PaginatedList<T> : List<T>
    {
        // properties to keep track of the page index and total number of pages
        public int PageIndex { get; private set; }
        public int TotalPages { get; private set; }

        // the constructor creates a PaginatedList object containing only the records for the requested page 
        public PaginatedList(IQueryable<T> source, int pageIndex, int pageSize)
        {
            var count = source.Count();

            // the Skip method is used to bypass a specified number of records

            // the Take method is used to return a specified number of continuous records

            var items = source.Skip((pageIndex - 1) * pageSize).Take(pageSize).ToList();

            // add the "taken" records to this list

            this.AddRange(items);

            PageIndex = pageIndex;

            // the total number of pages is a function of the total number of records and page size (i.e., the number of records to be displayed on a page

            TotalPages = (int)Math.Ceiling(count / (double)pageSize);
        }

        public bool HasPreviousPage
        {
            // if the Page Index is > 1, return a value of true

            // this property is used to enable or disable the Previous Link in PaginationDemo view

            get
            {
                return (PageIndex > 1);
            }
        }

        public bool HasNextPage
        {

            // if the Page Index is < Total Number of Pages, return a value of true

            // this property is used to enable or disable the Next Link in PaginationDemo view

            get
            {
                return (PageIndex < TotalPages);
            }
        }
    }
}
