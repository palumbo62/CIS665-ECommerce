//Demo 2 - C# Review; LV

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
 
namespace Demo2.Models
{
    // an enumeration is a set of constants represented by identifiers
    // by default, enumeration values are integers.  
    public enum CarClassification
    {
        Compact = 1,
        MidSize = 2,
        Large = 3
    }

    public class Car
    {
        //auto-implemented properties
        // "syntactic sugar" - i.e., features that make writing code easier
        public string CarManufacturer { get; set; }
        public string CarModel { get; set; }

        // the CarPrice property is a nullable decimal, which means this property can have a null value (i.e., undefined value)
        public decimal? CarPrice { get; set; }
        
        // an auto-implemented property can be assigned an initial value
        public CarClassification CarSize { get; set; } = CarClassification.MidSize;
        
        //the set property is private; i.e., cannot be set outside of the class
        public bool InStock { get; private set; }

        //constructor

        // by default the InStock property is initialized to true
        public Car(bool stock=true)
        {
            InStock = stock;
        }

        // for demo purposes, a few Car objects are instantiated, and returned in an array 

        public static Car[] GetCars()
        {
            // instantiate car objects and initialize property values

            Car mazda3 = new Car { CarManufacturer = "Mazda", CarModel = "Mazda3", CarPrice = 25900M, CarSize = CarClassification.Compact };

            // the property value for InStock is passed as an argument

            Car camry = new Car(false) { CarManufacturer = "Toyota", CarModel = "Camry", CarPrice = 31700M };

            // the CarPrice property for this object will be null

            Car maxima = new Car { CarManufacturer = "Nissan", CarModel = "Maxima", CarSize=CarClassification.Large };

            // initialize a Car array with 3 Car objects and return the array

            return new Car[] { mazda3, camry, maxima, null };
        }
    }
}
