<?php

    include('conexion.php');

    $id=$_POST['id'];

    $query = "select ID_M,NOMBRE_M,AUTOR_M,ENLACE_M from musica where ID_M =$id";
    $result = mysqli_query($connection, $query);
    if(!$result){
        die('Consulta Fallida'. mysqli_error($connection));
    }
    $json = array();
    while($row=mysqli_fetch_array($result)){
        $json[]=array(
            'ID_M' => $row['ID_M'],
            'NOMBRE_M' => $row['NOMBRE_M'],
            'AUTOR_M' => $row['AUTOR_M'],
            'ENLACE_M' => $row['ENLACE_M']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>