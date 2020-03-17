// $('#btn-agregar').on('click', function(){

// });
var first = false;
// var send = false;
function agregar(){
    let html = '';
    let pregunta = $('#examen-pregunta').val();
    let respuesta = $('input[name="Examen[respuesta]"]:checked').val();
    let strRespuesta = respuesta=='1'?'Verdadero':'Falso';

    if (!first){
        $('#table-preguntas tbody').html('');
        first = true;
    }
    
    html +=  `<tr>
        <td>
            <input type="hidden" name="preguntas[]" value="`+pregunta+`">
            ¿ `+pregunta+` ?
        </td>
        <td>
            <input type="hidden" name="respuestas[]" value="`+ respuesta +`">
            `+strRespuesta+`
        </td>
        <td>
            <a class="btn btn-round btn-just-icon btn-danger" title="Eliminar pregunta" onclick="eliminarItem(this)">
                <i class="material-icons">clear</i>
            </a>
        </td>
    </tr>`;

    $('#table-preguntas tbody').append(html);

    $('#examen-pregunta').val('');
    // $('input[name="Preguntas[respuesta_correcta]"]:checked').val('')
}

function eliminarItem(trElement){
    $(trElement).closest('tr').remove();
    let respuestas = $('input[name="respuestas[]"]');
    if (respuestas.length == 0){
        $('#table-preguntas tbody').html('');
        $('#table-preguntas tbody').append(`<tr>
            <td class="text-center" colspan="3">No hay preguntas</td>
        </tr>`);
    }
}

$('#examen-pregunta').on('keypress', function (e) {
    if (e.which == 13) {
        agregar();
    }
});

// $('#w0').on('submit', function(e){
//     console.log(send);
//     if (send){
//         alert('enviando');
//         e.preventDefault(); 
//     }
// });
// function sendForm(){
//     send = true;
// }
// $('#').on('submit', function(e){
//     e.preventDefault();
// });