<?php
    require_once('database.php');

    $item_num = filter_input(INPUT_POST, "item_num", FILTER_SANITIZE_STRING);

    if( $item_num != false ){
        $query = 'DELETE FROM todoitems WHERE ItemNum = :item_num';
        $statement = $db->prepare($query);
        $statement->bindValue(':item_num', $item_num);
        $success = $statement->execute();
        $statement->closeCursor(); 
    }

    include('index.php');
?>