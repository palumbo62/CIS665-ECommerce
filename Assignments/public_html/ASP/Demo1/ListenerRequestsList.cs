//Demo 1 - MVC Basics; LV

using System.Collections.Generic;

namespace Demo1.Models
{
    // defined as a static class to store and access data from different places (i.e., files) in the application
    public class ListenerRequestsList
    {
        //List collection to store ListenerRequest objects

        private static List<ListenerRequest> listenerRequests = new List<ListenerRequest>();
        
        // returns the ListenerRequest objects in listenerRequests List as a read only collection
        public static IEnumerable<ListenerRequest> GetListenerRequests
        {
            get
            {
                return listenerRequests;
            }
        }

        // adds a ListenerRequest object to the listenerRequests List
        public static void AddListenerRequest(ListenerRequest aRequest)
        {
            listenerRequests.Add(aRequest);
        }
    }

}

