<?php

    include('conexion.php');

    $id=$_POST['id'];

    $query = "select ENLACE_M from musica where ID_M =$id";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Consulta Fallida'. mysqli_error($connection));
    }
    $json = array();
    while($row=mysqli_fetch_array($result)){
        $json[]=array(
            'ENLACE_M' => $row['ENLACE_M']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>