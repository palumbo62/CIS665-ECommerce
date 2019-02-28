<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Car
 *
 * @author peebs
 */
class Car {
    //put your code here
    public $make;
    public $model;
    
    private $_speed=0;  // _ is simply naming convention
    
    function __construct($carMake, $carModel) {
        $this->make = $carMake;  // -> is used for PHP in lieu of (.) selector
        $this->model = $carModel;
    }
    
    // instance method
    function accelerat() {
        
        // speed is too fast so don't accelerate 
        if ($this->_speed >= 100) {
            return false;
        }
        
        //increase speed by 10mph
        $this->_speed += 10;
        return true;
    }
    
    function brake() {
        // don't slow down if not moving
        if ($this->_speed <= 0) {
            return false;
        }
        
        // start slowing down
        $this->_speed -= 10;
        return true;
    }
    
    function getSpeed() {
        return $this->_speed;
    }
    
    // static method that can be called outside of any object instance
    static function calcMpg($miles, $gallons) {
        return $miles / $gallons;
    }
}
