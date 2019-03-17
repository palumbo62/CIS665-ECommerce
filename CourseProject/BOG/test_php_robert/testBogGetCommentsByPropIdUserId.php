<?php
/*
    Class:          CIS665
    Assignment:     Course Project 
    Team-115:       Robert Palumbo, Kiana Vigil, Valerie Duran
    Due Date:       5.7.2019 @ 11:59pm

    Filename:       testGetCommentsByPropIdUserId.php
    
        PHP based web page used to test retrieving comments from the
        database by property Id and user Id.

*/
    require_once ("testSiteCommon.php");
    require_once ("..\sqlCommon\bogSql.php");

    displayPageHeader('BOG - Test bogGetCommentsByPropIdUserId()');

    echo '<section>';

    $propId = 37;
    $userId = 11;
    $comments = bogGetCommentsByPropIdUserId($propId, $userId);

    if (($errCode = bogGetLastErrorCode()) != 0) { 
        echo "Failed to retrieve comment profile from database, err='$errCode'<br><br>";
    } else if (count($comments) == 0) {
        echo "Comments for propId='$propId' userId='$userId' not found!<br><br>";
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
                       <td>' . $comment['CommentIdPK'] . '</td>
                       <td>' . $comment['UserIdFK'] . '</td>
                       <td>' . $comment['PropertyIdFK'] . '</td>
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
