<?php
/*
    Purpose: Online Store - Database Functions
    Author: LV
    Date:  March 2019
 */

require_once '../dbConnExec_1.php';

function getMerchandiseByName($merchandiseName)
{
    $query = <<<STR
Select merchandisepk, merchandisename, merchandiseprice, imagenamesmall
From merchandise
Where merchandisename like '%$merchandiseName%'
STR;

    return executeQuery($query);
}

function getMerchandiseDetails($merchandisePK)
{
    $query = <<<STR
Select merchandisepk, merchandisename, merchandisedescription, merchandiseprice, imagenamelarge, movietitle
From merchandise inner join film on filmfk = filmpk
Where merchandisepk = $merchandisePK
STR;

    return executeQuery($query);
}

function getMerchandiseInCart($merchandisePKs)
{
    $query = <<<STR
Select merchandisepk, merchandisename, merchandiseprice
From merchandise
Where merchandisepk in ($merchandisePKs)
STR;

    return executeQuery($query);
}

function getUser($userLogin, $userPassword)
{
    $query = <<<STR
Select contactpk, firstname, userrolename
From contact inner join userrole
on userrolefk = userrolepk
Where userlogin = '$userLogin'
and userpassword = '$userPassword'
STR;

return executeQuery($query);
}

function insertOrder($contactFK)
{
    $query = <<<STR
Insert into merchandiseorder(contactfk)
Values ($contactFK);
Select SCOPE_IDENTITY() As newOrderID;
STR;

    return executeQuery($query);
}

function insertOrderItem($merchandiseOrderFK, $merchandiseFK, $orderQty)
{
    $query = <<<STR
Insert into merchandiseorderitem(merchandiseorderfk, merchandisefk, orderqty)
Values ($merchandiseOrderFK, $merchandiseFK, $orderQty)
STR;

    executeQuery($query);
}

?>