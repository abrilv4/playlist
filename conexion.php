
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <body>
    <?php
            $db_host="localhost";
            $db_nombre="lavozdelosmayores";
            $db_usuario="root";
            $db_contra="";

            $conexion=mysqli_connect($db_host,$db_usuario,$db_contra,$db_nombre);

            if(mysqli_connect_errno()){
                echo "Fallo al conectar con la BBDD";
                exit();
            }
            mysqli_set_charset($conexion, "utf8");
            $consulta="SELECT * FROM musica";
            $resultados=mysqli_query($conexion,$consulta);
            
            while($fila=mysqli_fetch_row($resultados)){
                echo "<table><tr><td>";
                echo $fila[0] . "</td><td>";
                echo $fila[1] . "</td><td>";
                echo $fila[2] . "</td><td>";
                echo $fila[3] . "</td><td>";
                echo $fila[4] . "</td><td>";
                echo $fila[5] . "</td><td>";
                echo $fila[6] . "</td><td></tr></table>";
                echo "<br>";
            }
            mysqli_close($conexion);
        ?>
    </body>
</html>