/* 
 Purpose: Demo5 - Validation
 Author: LV
 Date: February 2019
 Javascript functions library
 */

// checks whether an input control is empty (i.e., the user failed to enter a required input)

function isEmpty(aControl)
{
    return (aControl.value.trim().length === 0) ? true : false;
}

// checks whether the value in an input control contains only digits (0-9)

function isDigits(aControl)
{
   // this regular expression literal is used to check whether a string contains just the digits 0-9

   var reg = /^\d{5}$/;
   return reg.test(aControl.value);  // uses the reqular expression method - test
}
// displays a message box with an appropriate message

function showAlert(aControl, aMessage)
{
    alert(aMessage);
    aControl.focus(); // sets the focus on the appropriate control
}

// this function receives a form object as its argument and performs multiple validations

function checkForm(aform)
{
    if (isEmpty(aform.loginID))  // calls the isEmpty method
    {
        showAlert(aform.loginID, "Please enter your Login ID");  // calls the showAlert method
        return false;  // returns false, so the submit event for the form is cancelled
    }
    else if (!isDigits(aform.loginID))  // calls the isDigits method
    {
        showAlert(aform.loginID, "Please enter a valid Login ID");  // calls the showAlert method
        return false;  // returns false, so the submit event for the form is cancelled
    }
    else if (isEmpty(aform.loginPassword))  // calls the isEmpty method
    {
        showAlert(aform.loginPassword, "Please enter your Password");  // calls the showAlert method
        return false;  // returns false, so the submit event for the form is cancelled
    }
    // the form has passed all validation tests; by returning a true value the form's submit event can proceed
    else return true;
}