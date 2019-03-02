<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testGetCommentsByPropId.php
    
        PHP based web page used to test retrieving comments from the
        database by property Id.

*/
    require_once ("..\phpCommon\BogSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Test bogGetCommentsByPropId()');

    echo '<section>';

    $propId = 5;
    $comments = bogGetCommentsByPropId($propId);

    if (($errCode = bogGetLastErrorCode()) != 0) { 
        echo "Failed to retrieve comment profile from database, err='$errCode'<br><br>";
    } else if (count($comments) == 0) {
        echo "Comments for propId='$propId' not found!<br><br>";
    } else {
        echo    '<table id="Comments">
                    <thead>
                        <tr>
                            <th>CommentID</th>
                            <th>UserID</th>
                            <th>PropID</th>
                            <th>Rating</th>
                            <th>DateSubmit</th>
                            <th>DateVisit</th>
                            <th>Comments</th>
                        </tr>
                    </thead>
                    <tbody>';

        // display the results

        foreach ($comments as $comment) {
            echo   '<tr>
                       <td>' . $comment['CommentID.PK'] . '</td>
                       <td>' . $comment['UserID.FK'] . '</td>
                       <td>' . $comment['PropertyID.FK'] . '</td>
                       <td>' . $comment['Rating'] . '</td>
                       <td>' . $comment['DateSubmitted'] . '</td>
                       <td>' . $comment['MonthYearVisit'] . '</td>
                       <td>' . $comment['Comments'] . '</td>
                   </tr>';
        }

        echo  '</tbody> </table> </section>';

        echo "<pre>";
        print_r($comments);
        echo "</pre >";
    }

    // call the displayPageFooter method in mySiteCommon.php

    displayPageFooter('BOG');
?>
