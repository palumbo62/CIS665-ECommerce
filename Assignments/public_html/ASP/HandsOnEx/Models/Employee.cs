using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

// Example of how to create/define class using C# from 4.2.2019 session
namespace HandsOnEx.Models
{
    public class Employee
    {
        public string Name { get; set; }

        // Default value if none assigned will be marketing
        public string Department { get; set; } = "Marketing"; 

        // ? means this valuablle is NULLABLE.  In C# be default decimal values
        // cannot be NULL - You are required to specify a value for it
        public decimal? Salary { get; set; }

        // Private set; means outside world cannot set this property - it can
        // only be set from within the class
        //
        // ALSO - if you do NOT specify a set; then you hvae to set the value
        // for the first imte in the constructor
        public bool IsFullTime { get; private set; } 

        //Constructor 
        //  Contains a default value so you don't have to specify the parameter
        //  when you call the constructor
        public Employee (bool empStatus = true) {
            IsFullTime = empStatus;
        }

        // For demoing only we are puttint everything in the class
        public static Employee[] GetEmployees() {
            Employee robert = new Employee { Name = "Robert Palumbo", Department = "Executive", Salary = 250000 };
            Employee christian = new Employee { Name = "Christian Palumbo", Department = "R&D", Salary = 150000, IsFullTime = false};
            Employee nat = new Employee { Name = "Natalie Palumbo", Department = "HR", Salary = 130000 };
            Employee alex = new Employee { Name = "Alex Palumbo", Department = "Finance", Salary = 150000, IsFullTime = false};


            return new Employee[] { robert, christian, nat, alex, null};
        }
    }
}
