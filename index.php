<?php

$sql = 'show tables;';

try {
    $dbh = new PDO('odbc:DSN=MyHive;');

    $result = $dbh->query($sql);

    $all = $result->fetchAll(PDO::FETCH_ASSOC);
    if ($all) {
        $keys = array_keys($all[0]);
        foreach ($keys as $col) {
            echo $col, "\t";
        }
        echo "\n\n";

        foreach ($all as $row) {
            foreach ($row as $v) {
                echo $v, "\t";
            }
            echo "\n";
        }
    }
} catch (PDOException $exception) {
    echo $exception->getMessage(), "\n\n";
}