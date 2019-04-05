<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testBogSearchPropByLoc.php
    
        PHP based web page used to test search for properties in the BOG
        database based upon the specified search criteria.

*/
    require_once ("testSiteCommon.php");
    require_once ("bogSql.php");

    displayPageHeader('BOG - Test testBogSearchPropByLoc()');

    echo '<section>';
?>    

    <script src="..\javaScript\Bog-jsLibrary.js" type="text/javascript"></script>

    <form action="testBogSearchPropByLocResults.php" 
          name="searchForm" id="searchForm" method="post">
        <label for="propCity">Property City: </label>
        <input type="text" name="propCity" id ="propCity" 
            maxlength="50" autofocus="autofocus"  
            pattern="^[a-zA-Z ']+$" 
            title="Enter city name"/>
        
        <label for="propState">Property State: </label>
        <select id="state" name="propState">
            <option value=''></option>
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

        <label for="propType">Property Type: </label>
        <select id="propType" name="propType">
            <option value=''></option>
            <option value=1>Home</option>
            <option value=2>Condo</option>
            <option value=3>Cabin</option>
            <option value=4>Apartment</option>
            <option value=5>Tiny House</option>
            <option value=6>Cottage</option>
        </select>        
        
        <Label for="propZip">Property Zip:</Label>
        <input type="text" pattern="[0-9]{5}" 
               name="propZip" title="Enter digit zip code" />
        <p>
           <input type="submit" value="Search" name="search" 
                  style="width: 150px; margin: 0 auto;" /> <br />
        </p>
    </form>
        
<?php
    displayPageFooter('BOG');
?>
