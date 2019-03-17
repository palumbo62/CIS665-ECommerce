<?php
/* 
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.24.2019 @ 11:59pm

    Filename:       BogRegister.php
    
        Main entry point to the BOG Register web page
*/ 
    // this method call should be placed at the start (top) of every php file that uses session variables

    session_start();

    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");
    require_once ("..\phpcommon\BogLibrary.php");
    
    echo '<section>';

    // the session array element "userInfo" will be set (see d10loginform.php) if the user has been authenticated
    $redirect = (isset($_REQUEST['redirect'])) ? $_REQUEST['redirect'] : 'BogLoginPage.php';

    $tag = "Registration Page";

    displayPageHeader("../cssStyles/registerCSS.css", $tag);
    displayRegisterPage();
?>

    <section id="banner">
        <form action="BogRegisterAction.php" method='post'>
            <div class="container">

                <h2>Sign Up</h2>

                <!----- Email Id ---------------------------------------------------------->
                <input type="text" name="email" required
                       placeholder="EmailAddress"
                       maxlength="50" autofocus="autofocus" required
                       pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" 
                       title="Enter email address (max 50 chars)">

                <!----- Password ---------------------------------------------------------->
                <input type="password" name="password" required
                       placeholder="Password"
                       maxlength="20" required="required"
                       title="Enter password (max 20 chars)">

                <!----- Password Conf---------------------------------------------------------->
                <input type="password" name="passwordconf" required
                       placeholder="Password-Confirmation"
                       maxlength="20" required="required"
                       title="Enter password confirmation (max 20 chars)">

                <!--<pre></pre>-->

                <!----- Mobile Number ---------------------------------------------------------->
                <input type="text" name="phonenumber" required
                       placeholder="10-Digit-PhoneNumber"
                       maxlength="10" autofocus="autofocus"
                       pattern="^[0-9]{10}$"
                       title="Enter phone number">

                <!----- First Name ---------------------------------------------------------->
                <input type="text" name="firstname" required
                       placeholder="FirstName"
                       maxlength="30" autofocus="autofocus" 
                       pattern="^[a-zA-Z ']+$"
                       title="Enter first name (max 30 chars)">

                <!----- Last Name ---------------------------------------------------------->
                <input type="text" name="lastname" required
                       placeholder="LastName"
                       maxlength="30" autofocus="autofocus"
                       pattern="^[a-zA-Z ']+$"
                       title="Enter last name (max 30 chars)">

                <!----- Address ---------------------------------------------------------->
                <input type="text" name="address" required
                       placeholder="HomeAddress"
                       maxlength="50" autofocus="autofocus"
                       title="Enter home address">

                <!----- City ---------------------------------------------------------->
                <input type="text" name="city" required
                       placeholder="City"
                       maxlength="30" autofocus="autofocus"
                       title="Enter home city (max 30 chars)">

                <!----- ZIP Code ---------------------------------------------------------->
                <input type="text" name="zipcode" required
                       placeholder="5-Digit-Zipcode"
                       maxlength="5" autofocus="autofocus"
                       pattern="^[0-9]{5}$"                       
                       title="Enter home zipcode">

                <!----- State ---------------------------------------------------------->
                State &nbsp;&nbsp;<select id="state" name="state" 
                        title="Enter home state"
                        style='height: 25px'>
                    <option value=""></option>
                    <option value="AL">Alabama</option>
                    <option value="AK">Alaska</option>
                    <option value="AZ">Arizona</option>
                    <option value="AR">Arkansas</option>
                    <option value="CA">California</option>
                    <option value="CO">Colorado</option>
                    <option value="CT">Connecticut</option>
                    <option value="DE">Delaware</option>
                    <option value="DC">District Of Columbia</option>
                    <option value="FL">Florida</option>
                    <option value="GA">Georgia</option>
                    <option value="HI">Hawaii</option>
                    <option value="ID">Idaho</option>
                    <option value="IL">Illinois</option>
                    <option value="IN">Indiana</option>
                    <option value="IA">Iowa</option>
                    <option value="KS">Kansas</option>
                    <option value="KY">Kentucky</option>
                    <option value="LA">Louisiana</option>
                    <option value="ME">Maine</option>
                    <option value="MD">Maryland</option>
                    <option value="MA">Massachusetts</option>
                    <option value="MI">Michigan</option>
                    <option value="MN">Minnesota</option>
                    <option value="MS">Mississippi</option>
                    <option value="MO">Missouri</option>
                    <option value="MT">Montana</option>
                    <option value="NE">Nebraska</option>
                    <option value="NV">Nevada</option>
                    <option value="NH">New Hampshire</option>
                    <option value="NJ">New Jersey</option>
                    <option value="NM">New Mexico</option>
                    <option value="NY">New York</option>
                    <option value="NC">North Carolina</option>
                    <option value="ND">North Dakota</option>
                    <option value="OH">Ohio</option>
                    <option value="OK">Oklahoma</option>
                    <option value="OR">Oregon</option>
                    <option value="PA">Pennsylvania</option>
                    <option value="RI">Rhode Island</option>
                    <option value="SC">South Carolina</option>
                    <option value="SD">South Dakota</option>
                    <option value="TN">Tennessee</option>
                    <option value="TX">Texas</option>
                    <option value="UT">Utah</option>
                    <option value="VT">Vermont</option>
                    <option value="VA">Virginia</option>
                    <option value="WA">Washington</option>
                    <option value="WV">West Virginia</option>
                    <option value="WI">Wisconsin</option>
                    <option value="WY">Wyoming</option>
                </select>

                <div id="roletype">
                <label>    
                    <input type="radio" id="roletype"
                           name="roletype" value="2" checked/>User Account
                </label>
                <label>    
                    <input type="radio" id="roletype"
                           name="roletype" value="1"/>Admin Account
                </label>
                </div>
                
                <!--Button Should reach out to php page and confirm user or admin access-->
                <br>
                <button name="regSubmit" type="submit" value="register">Register</button>
                <button name="regReset" type="reset" value="reset">Reset</button>
                <button type="button" onclick="location.href='BogHome.php';return false;">Cancel</button>
            </div>
        </form>
    </section>

<?php
    displayPageFooter('');
?>