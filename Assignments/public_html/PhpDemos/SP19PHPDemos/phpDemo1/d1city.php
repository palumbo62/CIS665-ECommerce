<?php
/* 
   Purpose: Demo1 - PHP Class
   Author: LV
   Date: January 2017
 */

class City
{
   //Property
   
   private $_cityName;

   // Constructor
   
   public function __construct($nameOfCity)
   {
       $this->_cityName = $nameOfCity;
   }
   
   // Methods
   
   public function getCityName()
   {
       return $this->_cityName;
   }
   
   public function getCityNameUpper()
   {
       return strtoupper($this->_cityName);
   }
  
  public function getCityNameLower()
   {
       return strtolower($this->_cityName);
   }
   
   public function reverseCityName()
   {
       return strrev($this->_cityName);
   }
   
   public function getCityNameLength()
   {
       return strlen($this->_cityName);
   }
   
   public function replaceCityName($replaceWhat, $replaceWith)
   {
       return str_replace($replaceWhat, $replaceWith, $this->_cityName);
   }
}

?>
