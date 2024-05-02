$(document).ready(function () {

    if (document.getElementById("listaAsistentes") !== null) {

        //Función para actualizar cada 5 segundos(5000 milisegundos)
        // setInterval(recargar_60s(),60000);

        $.ajax({
            type: 'post',
            url: 'php/get_confirmations.php',
            dataType: 'json',
            success: function (data) {
                if (data.status == 'ok') {
                    $("#listaAsistentes").html(data.content);
                } else if (data.status == 'error') {
                    // alert de sweet alert
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Volver a intentar. Error al obtener el listado'
                    });
                }
            },
        });

    }


    $('#btn_guardar_confirmacion').click(function () {
        // abrir alert
        let nombre = $('#inNombre').val();
        let apellido = $('#inApellido').val()

        if (nombre !== '' && apellido !== '') {
            let nombre_apellido = nombre + ' ' + apellido;

            $.ajax({
                type: 'post',
                url: 'php/save_confirmation.php',
                dataType: 'json',
                data: {
                    Nombre: nombre_apellido,
                },
                success: function (data) {
                    if (data.status == 'ok') {
                        let msj = 'Gracias por acompañar a mi mami.<br><br><small>Atte. Eduardo Noé</small>';
                        // alert(msj);
                        Swal.fire({
                            title: nombre,
                            html: msj,
                            imageUrl: 'img/corazon_1.png',
                            imageWidth: 50,
                            imageHeight: 50,
                            imageAlt: 'corazon',
                        }).then((result) => {
                            location.reload();
                        });
                    } else if (data.status == 'error') {
                        // alert de sweet alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Volver a intentar. Error al confirmar',
                            footer: 'Si volviste a intentar y no se pudo, notificale a Ceci.'
                        });
                    }
                },
            });
        } else {
            alert('Ingresa los dos datos por favor.');
        }

    });

    function recargar_60s() {
        location.reload(true);
    }


});