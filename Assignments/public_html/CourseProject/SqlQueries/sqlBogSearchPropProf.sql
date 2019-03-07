Select p.[PropertyID.PK], pt.PropertyTypeName, Address, City, State, Zipcode,
DailyPrice, NumBedrooms, NumBathrooms, Sqft, GuestCnt, Pic
From PropertyT p
    Inner Join PropertyTypeT pt
        On p.[PropertyTypeID.FK] = pt.[PropertyTypeID.PK]
Where 0=0
 And p.[PropertyTypeID.FK] = $propertyTypeID
 And Address like '%$address#'
 And City like '%$city%'
 And State = '$state'
 And Zipcode = $zipcode
 And DailyPrice <= $dailyPrice
 And NumBedrooms >= $numBedrooms
 And NumBathrooms >= $numBathrooms
 And SqFt <= $sqft
 And GuestCnt >= $guestCnt
Order by p.[PropertyID.PK];