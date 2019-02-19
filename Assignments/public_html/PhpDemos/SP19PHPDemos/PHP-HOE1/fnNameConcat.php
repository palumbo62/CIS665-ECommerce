<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
       Class:         CIS665
       Assignment:    PHP-HOE1
       Name:          Robert Palumbo
       Due Date:      2.21.2019 @ 11:59pm

       PHP - Hands-on-Exercise 1

       Function:  fnNameConcat( string S) : string
 *          if length of S is even, concatenate last name to first 3 characters of S
        *   if length of S is odd,  concatenate first name to last 3 characters of S        

       Filename: fnNameConcat.php
*/

function fnNameConcat($S) {
    if ((strlen($S) % 2) == 0) {
        // EVEN case
       return 'Palumbo' . substr($S, 0, 3);
    } else {
        // ODD case
       return 'Robert' . substr($S, strlen($S)-3, 3);
    }
}

