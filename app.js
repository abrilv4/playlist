$(function () {
    let idactual;
    let totalmusicas=0
    console.log('jQuery esta funcionando');
    actualizar();
    function actualizar(){
        $.ajax({
            url: 'listamusica.php',
            type: 'GET',
            success: function (response) {
                let musicas = JSON.parse(response);
                totalmusicas=musicas.length;
                let template = '';
                musicas.forEach(musica => {
                    template += `
                        <br><table class="container-musica" idMusica="${musica.ID_M}">
                            <tr>
                                <td class='id'>${musica.ID_M}</td>
                                <td class='nombre'>${musica.NOMBRE_M}</td>
                                <td class='autor'>${musica.AUTOR_M}</td>
                                <td class='genero'>${musica.CATEGORIA_M}</td>
                                <td class='fechaPublicacion'>${musica.FECHAPUBLICACION_M}</td>
                                <td class='tiempo'>${musica.TIEMPO_M}</td>
                                <td>
                                    <button class="lista">
                                        <img class="play" src="play.png">
                                    </button>
                                </td>
                            </tr>
                        </table><br>
                    `
                });
                $('#lista-musica').html(template);
            }
        })
    }
    
    $(document).on('click', '.lista', function(){
        let element = $(this)[0].parentElement.parentElement.parentElement.parentElement;
        let id = $(element).attr('idMusica')
        idactual= Number(id);
        play(id)
    })
    function siguiente(){
        if(idactual===totalmusicas){
            alert('ya no hay mas musicas para reproducir')
        }
        else{
        idactual=idactual+1; 
        play(idactual.toString())
        }
        
    }
    function anterior(){
        if(idactual===1){
            alert('no puede ir atras porque es la primera musica')
        }
        else{
        idactual=idactual-1; 
        play(idactual.toString())
        }
        
        
    }
    $(document).on('click', '.boton-siguiente', siguiente);
    $(document).on('click', '.boton-anterior', anterior);
    function play(id){
        $.ajax({
            url: 'musicaid.php',
            type: 'POST',
            data: {id},
            success: function(response){
                let enlace = JSON.parse(response);
                let template1 ='';
                let template2 ='';
                let template3 ='';
                enlace.forEach(link =>{
                    template1 += `<audio controls class="audio-class" id="audio" autoplay>
                        <source src="https://drive.google.com/uc?export=download&amp;id=${link.ENLACE_M}" type="audio/mp3">
                    </audio>
                    `
                    template2 += `<h1 id="nombreM">${link.NOMBRE_M}</h1>`
                    template3 += `<h3 id="nombreM">${link.AUTOR_M}</h3>`
                }
                );
                $('#audio').html(template1);
                $('#nombreM').html(template2);
                $('#nombreA').html(template3);
            }
        })

    }
})

