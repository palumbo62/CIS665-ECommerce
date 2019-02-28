<?php
/*
    Purpose: Demo2 - Looping
    Author: LV
    Date: January 2017
 */

function demoForLoop()
{
    $output = '<ul>';
    
    for ($i = 1; $i <= 10; $i++)
    {
        $output .= "<li> $i </li>";
    }
   
   $output .= '</ul>';
   
    return $output;
}

function demoWhileLoop()
{
    $output = '<ul>';
    $counter = 11;

    while ($counter <= 20)
    {
        $output .= "<li> $counter </li>";
        $counter++;
    }

   $output .= '</ul>';

    return $output;
}

function demoDoWhileLoop()
{
    $output = '<ul>';
    $counter = 21;

    do
    {
        $output .= "<li> $counter </li>";
        $counter++;
    }
    while ($counter <= 30);

   $output .= '</ul>';

    return $output;
}

function demoForEachLoop()
{
    $output = '<ul>';
    $thirties = array(31,32,33,34,35,36,37,38,39,40);

   foreach ($thirties as $aThirty)
    {
        $output .= "<li> $aThirty </li>";
    }

   $output .= '</ul>';
   
   return $output;
}
?>
