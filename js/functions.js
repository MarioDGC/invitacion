$(document).ready(function () {

    if (document.getElementById("listaAsistentes") !== null) {

        //Función para actualizar cada 5 segundos(5000 milisegundos)
        // setInterval(recargar_60s(),60000);

        $.ajax({
            type: 'post',
            url: 'php/get_confirmations.php',
            dataType: 'json',
            data: {
                action: 'listado'
            },
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


        $.ajax({
            type: 'post',
            url: 'php/get_confirmations.php',
            dataType: 'json',
            data: {
                action: 'conteo'
            },
            success: function (data) {
                if (data.status == 'ok') {
                    $("#conteo_confirmados").html(data.content);
                } else if (data.status == 'error') {
                    // alert de sweet alert
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Volver a intentar. Error al obtener el conteode asistentes'
                    });
                }
            },
        });

    }


    $('#btn_guardar_confirmacion').click(function () {
        // abrir alert
        let nombre = $('#inNombre').val();
        let num_asistentes = $('#inApellido').val();

        if (nombre !== '' && num_asistentes !== '') {
            let asistente = num_asistentes > 1 ? 'asistentes' : 'asistente';
            let nombre_asistentes = nombre + ' ' + num_asistentes + ' ' + asistente;

            $.ajax({
                type: 'post',
                url: 'php/save_confirmation.php',
                dataType: 'json',
                data: {
                    Nombre: nombre_asistentes,
                    Num_asistentes: num_asistentes
                },
                success: function (data) {
                    if (data.status == 'ok') {
                        let msj = 'Gracias por acompañarnos.<br><br><small>Fam. González Salinas</small>';
                        // alert(msj);
                        Swal.fire({
                            title: nombre.toUpperCase(),
                            html: msj,
                            imageUrl: 'img/bautizo_2.png',
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
                            footer: 'Si volviste a intentar y no se pudo, notificale a Ceci o Mario.'
                        });
                    }
                },
            });
        } else {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: 'Ingresa los dos datos por favor.',
            });
        }

    });

    function recargar_60s() {
        location.reload(true);
    }

    const capitalize = (s) => {
        if (typeof s !== 'string') return '';
        return s.charAt(0).toUpperCase() + s.slice(1).toLowerCase();
    };


});