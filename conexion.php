<?php

    $connection = mysqli_connect(
        'localhost',
        'root',
        '',
        'lavozdelosmayores'
    );

    if(!$connection){
        echo "Base de datos no conectada";
    }

?>