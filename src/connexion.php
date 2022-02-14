
<?php

    try {
    $database = new PDO('mysql:host={ip};dbname={NAME_DB}', '{user}', '{psw}');
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (Exception $e) {
        echo $e->getMessage();
        die();
    };

?>