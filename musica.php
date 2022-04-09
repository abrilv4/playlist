<?php
    include_once("conexion.php")
?>

<!DOCTYPE html>
<html lang="es">

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
            <a href="index.html"><img class="logo" src="logo1.png"></a>
            <h1 class="title">La Voz de los mayores</h1>
        </div>
    </div>
    <div class="container-medio">
        
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
                $id_MU =[];
                $enlace_MU =[];
                $vector_canciones=[];
                $pos = 0;
                $num = 1;
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
                echo "<div class='lista-musica'>";
                echo "<br>";
                while($fila=mysqli_fetch_row($resultados)){
                    echo "<div class='container-musica'>";
                    $id_M = $fila[0];
                    $enlace = $fila[3];
                    $id_MU [] =   $id_M;
                    $enlace_MU [] = $enlace;
                    echo "<button class='botones' onclick='saludar($id_M)' id='$id_M'><table><tr><td class='id'>";   
                    echo $num."</td><td class='nombre' border='1px'>";
                    $num++;
                    echo $fila[1]."</td><td class='autor'>";
                    echo $fila[2]."</td><td class='genero'>"; 
                    $id_enlace = $id_M."/_".$enlace;
                    $vector_canciones[]=$id_enlace;
                    echo $fila[4]."</td><td class='fechaPublicacion'>";
                    echo $fila[5]."</td><td class='tiempo'>";
                    echo $fila[6]."</td></tr></table></button>";
                    //echo "<br>";
                    //echo $id_enlace;
                    echo "</div>";
                    echo "<br>";
                    
                    
                    
                }
                echo '<script>
                    function saludar(id){
                        console.log("Hola Mundo");
                        alert("Hola mundo "+id);
                    }
                    </script>';
                /*for($i=0;$i<3;$i++){
                    echo $vector_canciones[$i];
                    echo "<br>";
                }*/
                echo "</div>"
               
            ?>
        
    </div>
    <div class="container-inferior">
        <div class="info-musica">
        <?php  
             $consulta_NA = "SELECT NOMBRE_M, AUTOR_M FROM MUSICA WHERE ID_M = '$id_MU[$pos]' " ;
             $resultadosNA = mysqli_query ($conexion,$consulta_NA);
             while ( $filaN = mysqli_fetch_row ( $resultadosNA)){
                    echo  $filaN [0];
                    echo "<br>";
                    echo  $filaN [1];
             }
        ?>  
        <script>
            function mostrarInfo(){
                <?php  
                    $consulta_NA = "SELECT NOMBRE_M, AUTOR_M FROM MUSICA WHERE ID_M = '$id_MU[$pos]' " ;
                    $resultadosNA = mysqli_query ($conexion,$consulta_NA);
                    while ( $filaN = mysqli_fetch_row ( $resultadosNA)){
                         echo  $filaN [0];
                         echo "<br>";
                         echo  $filaN [1];
                    }
                ?>
            }
         </script>
        </div>
        <div class="herramientas">
            <button onclick = "anterior(); mostrarInfo()" class="boton-anterior">
                <img class="anterior" src="siguiente musica.png">
            </button>
            <script>
                var  canciones  =  <?php  echo  json_encode ($enlace_MU); ?> ;
                var  id_cancion  =  <?php  echo  json_encode ($id_MU); ?> ;
                var  indice  =  <?php  echo  json_encode ($pos); ?> ;
                function anterior(){
                    if (indice > 0){
                            índice  =  índice  - 1 ;
                    } else{
                            índice  =  canciones.length()-1 ;
                     }
                    play(); 
                }
                function play(){
                     <?php
                         echo  "<audio controls class='audio'>
                         <source src ='https://drive.google.com/file/d/1pUXNDF10qDBQfcor6v5cOHRnWiSkfX1h/view?usp=sharing'
                         type ='audio/mp3'>
                         </audio>" ;
                    ?>
                }
                function siguiente(){
                    if (indice < canciones.length()){
                            índice  =  índice + 1 ;
                    } else{
                            índice  =  0 ;
                     }
                    play(); 
                }
            </script>
            <?php
            function play($id){         
                    $en="SELECT ENLACE_M FROM musica WHERE ID_M=$id";
                    echo "
                    <audio controls class='audio'>
                        <source src='https://drive.google.com/uc?export=download&amp;id=.$en' type='audio/mp3'>
                    </audio> ";
                }
            ?>
            
            <audio controls class="audio">
                <source src="https://drive.google.com/uc?export=download&amp;id=1Mfg6nHYkEq1gTyfuodfSnWgOn0qz0ACy"
                    type="audio/mp3">
            </audio>
            <button class="boton-siguiente">
                <img class="anterior" src="siguiente musica.png" onclick = "siguiente(); mostrarInfo()"> 
            </button>
        </div>
    </div>
</body>

</html>