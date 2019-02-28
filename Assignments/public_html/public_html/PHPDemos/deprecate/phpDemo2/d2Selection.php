<?php
/* 
    Purpose: Demo2 - Conditional Processing
    Author: LV
    Date: January 2017
 */

function displayDayMessage1()
{
    // Assign the day of week of today's date to variables

    $dowN = date('w'); // day of the week in numeric format (0 to 6 - 0 is Sunday)
    $dowT = date('l');  // unabbreviated day of the week (Sunday through Saturday)

    if ($dowN == 0)
    {
        $message = $dowT . ' - Relax';
    }
    elseif ($dowN == 6)
    {
        $message = $dowT . ' - Party';
    }
    elseif ($dowN == 5)
    {
        $message = $dowT . ' - Made it';
    }
    else
    {
        $message = $dowT . ' - Hang in there';
    }

    return $message;
}

function displayDayMessage2()
{
    // Assign the day of week of today's date to variables

    $dowN = date('w') ;
    $dowT = date('l');

    switch ($dowN)
    {
        case 0:
            $message = $dowT . ' - Relax';
            break;
        case 6:
            $message = $dowT . ' - Party';
            break;
        case 5:
            $message = $dowT . ' - Made it';
            break;
        default:
            $message = $dowT . ' - Hang in there';
     }

     return $message;
}

function displayDayMessage3()
{
    // Assign the day of week of today's date to variables

    $dowN = date('w') ; // day of the week in numeric format (0 to 6 - 0 is Sunday)
    $dowT = date('l');  // unabbreviated day of the week (Sunday through Saturday)

    // ternaray operator

    return ($dowN == 0 || $dowN == 6) ? $dowT .' -  Relax' : $dowT .' - Get going';
    
}
function getRoomRate($discount)
{
    // Assign the month of today's date to variable

    $moy = date('n'); // month in numeric format (1 through 12)

    // Use Nested If statements to find the appropriate rate

    if ($discount == 'Y' || $discount == 'y')
    {
        if ($moy >= 6 && $moy <= 9)
        {
            $roomRate = 90;
        }
        else
        {
            $roomRate = 45;
        }
    }
    else
    {
       if ($moy >= 6 && $moy <= 9)
       {
           $roomRate = 100;
       }
       else
       {
           $roomRate = 50;
       }
    }

    return $roomRate;
}

?>
