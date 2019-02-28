<!DOCTYPE html> 
<html>
   <head>
      <!--
         Demo1 - Basic PHP - Functions & Variables
         Author: LV
         Date: January 2017
      -->
      <meta charset="UTF-8" />
      <title>Demo1 - Arrays</title>
        
      <link href="d1styles.css" rel="Stylesheet" />

   </head>

   <body>

      <header>
        <h2>Arrays</h2>
      </header>
      
      <section>
        <p>
            <?php

               $fruits = array('apple','banana','cherry','grape','mango','orange');

               //Display specific elements of the array

               print "$fruits[0] <br /> $fruits[2] <br /> $fruits[5] <br /> <br />";

               // if using single quote:
               // print $fruits[0] . '<br />' . $fruits[2] . '<br />' . $fruits[5] . '<br /> <br />';

               //Print all elements of the array

               foreach($fruits as $aFruit)
               {
                   echo $aFruit . '<br />';
               }
               echo '<br />';

               //array elements can also be assigned explict non-negative integer or string keys

               $meals = array('breakfast' => 'cereal', 'lunch' => 'salad', 'dinner' => 'lamb chops');

               print $meals['breakfast'] . '<br />' . $meals['dinner'] . '<br /> <br />';

              //Print all elements of the array

               foreach($meals as $aKey => $aValue)
               {
                   echo '<strong>Key:</strong> ' . $aKey . ' <strong>Value:</strong> ' . $aValue . '<br />';
               }
               echo '<br />';

               //Multidimensional Arrays (arrays within arrays)

               $menu = array('breakfast' => 'cereal', 'lunch' => array('soup' => 'Tomato', 
                   'entre' => 'Meat Loaf'), 'dinner' => array('soup' => 'chowder', 'entre' => 'Lamb Chops',
                   'dessert' => 'Lemon Pie'));

                           
               echo 'Today\'s Dinner Dessert is ';
               echo $menu['dinner']['dessert'];

               echo '<br /> <br />';

               // Displaying a ragged multidimensional array

               foreach($menu as $aKey => $aValue)
               {
                   if (is_array($aValue))
                   {   
                       echo '<strong>Key:</strong> ' . $aKey . '<br />';

                       foreach($aValue as $bKey => $bValue)
                       {
                          echo '<strong>Key:</strong> ' . $bKey . ' <strong>Value:</strong> ' . $bValue . '<br />';
                       }
                   }
                   else
                   {
                       echo '<strong>Key:</strong> ' . $aKey . ' <strong>Value:</strong> ' . $aValue . '<br />';
                   }

               }
               echo '<br />';

              //Check array values

               echo '<pre>';
               print_r($menu);
               echo '</pre>';
            ?>

         </p>
      </section>
   </body>
</html>

