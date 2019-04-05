<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo "This is a test<br>";

function calcWeekPay($devType, $HrsWorked) {
    $payRate = 0;
    
    if ($devType == 1) {
        // PHP dev
        $payRate = 53.36;
    } elseif ($devType == 2) {
        //ASP dev
        $payRate = 63.93;
    }
    
    $regHours = $HrsWorked / 40.0;
    $OTHours = $HrsWorked % 40.0;
    
    echo fmod($HrsWorked, 40.0);
    $weeklyPay = ($payRate * $regHours) + ((2 * $payRate) * $OTHours);

    echo "RATE=$payRate Dev=$devType  REG=$regHours OT=$HrsWorked  WP=$weeklyPay'<br>'";
    
    return $weeklyPay;
}

echo calcWeekPay(2, 60);
?>