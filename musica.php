<?php
    include_once("conexion.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reproductor</title>
    <link rel="stylesheet" href="css/estilo_musica.css" />
</head>

<body>
    <div class="general">
        <div class="container-superior">
        <a class="logo" href="index.html"><img class="logo" src="logo1.png"></a><br>
            <h1 class="title">La Voz de los mayores</h1>
        </div>
    </div>
    <div class="container-medio">
        <div class="lista-musica">
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
                $id_M;
                $enlace;
                $id_MU=[];
                $enlace_MU=[];
                $vector_canciones=[];
                $num = 1;
                $pos = 0;
                $indice = 0;
                echo "<br><div class='title-musica'><table class= 'titulos'>
                    <tr>
                        <td class='t1'><b>N°</b></td>
                        <td class='t2'><b>Musica</b></td>
                        <td class='t3'><b>Artista</b></td>
                        <td class='t4'><b>Genero</b></td>
                        <td class='t5'><b>Lanzamiento</b></td>
                        <td class='t6'><b>Duracion</b></td>
                    </tr>
                </table></div>";
                echo "<br>";
                while($fila=mysqli_fetch_row($resultados)){
                    echo "<div class='container-musica'>";
                    echo "<table><tr><td class='id'>";
                    $id_M = $fila[0];
                    $enlace = $fila[3];
                    $id_MU[$indice] =  $id_M;
                    $enlace_MU[$indice] = $enlace;
                    echo $num."</td><td class='nombre'>";
                    $num++;
                    echo $fila[1]."</td><td class='autor'>";
                    echo $fila[2]."</td><td class='genero'>"; 
                    $id_enlace = $id_M."/_".$enlace;
                    $vector_canciones[$indice]=$id_enlace;
                    echo $fila[4]."</td><td class='fechaPublicacion'>";
                    echo $fila[5]."</td><td class='tiempo'>";
                    echo $fila[6]."</td></tr></table>";
                    //echo "<br>";
                    //echo $id_enlace;
                    echo "</div>";
                    echo "<br>";
                }
                /*for($i=0;$i<3;$i++){
                    echo $vector_canciones[$i];
                    echo "<br>";
                }*/

            ?>
        </div>
    </div>
    <div class="container-inferior">
        <div class="info-musica">
            <?php     
            $consulta_nombre = "SELECT NOMBRE_M FROM MUSICA WHERE ID_M = '$id_MU[$pos]'";
            $consulta_artista = "SELECT AUTOR_M FROM MUSICA WHERE ID_M = '$id_MU[$pos]'";
            $resultadosN=mysqli_query($conexion,$consulta_nombre);
            $resultadosA=mysqli_query($conexion,$consulta_artista);
            echo $resultadosN;
            echo $resultadosA;
            ?>
        </div>
        <div class="herramientas">
            <button class="boton-anterior">
                <img class="anterior" src="siguiente musica.png">
                <?php
                if($pos > 0){
                    $pos = $pos -1;
                }else{
                    $pos = $id_M.count()-1;
                }
                ?>
                <audio controls class="audio">
                     <source src =" https://drive.google.com/uc?export=download&id=" .$enlace_MU[$pos]
                         tipo =" audio/mp3 ">
                </audio>
            </button>
            <audio controls class="audio">
                 <source src =" https://drive.google.com/uc?export=download&id=1Mfg6nHYkEq1gTyfuodfSnWgOn0qz0ACy "
                     tipo =" audio/mp3 ">
            </audio>
            <button class="boton-siguiente">
                <img class="anterior" src="siguiente musica.png">
                <?php
                if($pos < $id_M.count()){
                    $pos = $pos +1;
                }else{
                    $pos = 0;
                }
                ?>
                <audio controls class="audio">
                     <source src =" https://drive.google.com/uc?export=download&id=" .$enlace_MU[$pos]
                         tipo =" audio/mp3 ">
                </audio>
            </button>
        </div>
    </div>
</body>

</html>