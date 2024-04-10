<?php

    $db = new SQLite3('cat_homepage.db');

    $enteredUsername = "grape";
    $enteredPassword = "secret1234";

    $query = "SELECT * FROM users WHERE username='{$enteredUsername}' AND password='{$enteredPassword}' ";
    $result = $db->query($query);

    echo "your query : $query";
    echo "<br>";

    if ($result->fetchArray()) {
        echo "this is on database : $enteredUsername/$enteredPassword";
        echo $result->fetchArray();
    }else{
        echo "CAUTION not in database : $enteredUsername/$enteredPassword";
    }

?>