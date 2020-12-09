<?php

    $reserva = $data["reserva"][0];
    $instalaciones = $data["instalaciones"];
    $horaAperturaInstalacion = (int)$data["horario"][0]->hora_inicio;
    $horaCierreInstalacion = (int)$data["horario"][0]->hora_fin;
    $reservasInstalacion = $data["reservasInstalacion"];

    echo "<div id='divContenedor' style='width: 600px'>
            <span id='titulo'>$reserva->fecha</span>
            <table id='tablaPrincipal'>
                <tr>
                    <td colspan='2'>
                        <table class='tituloTablaPerfil'>
                            <tr>
                                <td><span><strong>Información de la reserva</strong></td>
                            </tr>
                        </table>
                                <table id='perfil'>
                                    <form action='index.php' method='get' autocomplete='off' enctype='multipart/form-data'>
                                    <tr style='height: 20px'></tr>
                                    <tr>
                                        <td style='width: auto !important'>
                                            Fecha:<br>
                                            <input type='date' id='nombre' class='oculto' value='$reserva->fecha' name='fecha' title='Doble click para editar'>
                                        </td>
                                        <td style='width: auto !important'>
                                            Hora de inicio:<br>
                                            <select id='horaInicioSelect' name='horaInicio'>";

                                                for ($i=$horaAperturaInstalacion; $i<=$horaCierreInstalacion; $i++) {

                                                    echo "<option";

                                                    foreach($reservasInstalacion as $reservaX) {

                                                        $fecha = strtotime($reserva->fecha);
                                                        $mes = date('m',$fecha);
                                                        $dia = date('d',$fecha);
                                                        $anyo = date('Y',$fecha);

                                                        $fechaReserva = strtotime($reservaX->fecha);
                                                        $mesX = date('m',$fechaReserva);
                                                        $diaX = date('d',$fechaReserva);
                                                        $anyoX = date('Y',$fechaReserva);

                                                        if (($i==$reservaX->horaInicio && $reservaX->id == $reserva->id) && ($mes==$mesX && $dia==$diaX && $anyo==$anyoX)) {
                                                            echo " selected ";
                                                        } else {
                                                            if (($i >= $reservaX->horaInicio && $i <= $reservaX->horaFin) && ($mes==$mesX && $dia==$diaX && $anyo==$anyoX)) {

                                                                echo " disabled style='background-color: red'; ";
    
                                                            }
                                                        }

                                                    }

                                                    echo " value='$i:00'>$i:00</option>";

                                                }

                    echo                    "</select>
                                        </td>
                                        <td style='width: auto !important'>
                                            Hora de fin:<br>
                                            <select id='horaFinSelect' name='horaFin'>";

                                                for ($i=$horaAperturaInstalacion; $i<=$horaCierreInstalacion; $i++) {

                                                    echo "<option";

                                                    foreach($reservasInstalacion as $reservaX) {

                                                        $fecha = strtotime($reserva->fecha);
                                                        $mes = date('m',$fecha);
                                                        $dia = date('d',$fecha);
                                                        $anyo = date('Y',$fecha);

                                                        $fechaReserva = strtotime($reservaX->fecha);
                                                        $mesX = date('m',$fechaReserva);
                                                        $diaX = date('d',$fechaReserva);
                                                        $anyoX = date('Y',$fechaReserva);
                                                        
                                                        if (($i==$reservaX->horaInicio && $reservaX->id == $reserva->id) && ($mes==$mesX && $dia==$diaX && $anyo==$anyoX)) {
                                                            echo " selected ";
                                                        } else {
                                                            if (($i >= $reservaX->horaInicio && $i <= $reservaX->horaFin) && ($mes==$mesX && $dia==$diaX && $anyo==$anyoX)) {

                                                                echo " disabled style='background-color: red'; ";
    
                                                            }
                                                        }

                                                    }

                                                    echo " value='$i:00'>$i:00</option>";

                                                }

                    echo                    "</select>
                                        </td>
                                    </tr>
                                    <tr style='height: 10px'></tr>
                                    <tr>
                                        <td colspan='3'>
                                            Instalación:<br>
                                            <select disabled name='instalacion' style='width: 100%; padding: 8px' onchange='cambiarImagen()' id='instalacion'>";
                                                    
                                                foreach ($instalaciones as $instalacion) {
                                                    if ($instalacion->id == $reserva->instalacion) {
                                                        echo "<option selected value='$instalacion->id'>$instalacion->nombre</option>";
                                                    } else {
                                                        echo "<option value='$instalacion->id'>$instalacion->nombre</option>";
                                                    }
                                                }
                    
                        echo                "</select><br>
                                            <img id='imgInstalacion' style='width: 100%; height: auto; position: relative; left: 50%; transform: translateX(-50%); border-radius: 0px; margin-top: 10px; box-shadow: 0px 5px 5px black;'>
                                        </td>
                                    </tr>
                                    <tr style='height: 10px''></tr>
                                    <input type='hidden' name='action' value='modificarReserva'>
                                    <input type='hidden' name='id' value='$reserva->id'>
                                    <input type='hidden' name='idUsuario' value='$reserva->usuario'>
                                    <tr style='height: 20px'></tr>
                                    
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                                        <th><button id='botonGuardar' class='botonGuardar'>Guardar</button></th>
                                        <td><button type='button' class='botonEliminar' onclick='eliminar($reserva->id)'>Eliminar reserva</button></td>
                                    </tr>
                                    </form>
            </table> 

        </div>
        <div id='fondo'></div>
        <div id='divConfirmacion'>
            <span id='textoConfirmacion'></span>
            <br>
            <button id='botonConfirmar'>Confirmar</button>
            <button id='botonCancelar'>Cancelar</button>
        </div>
        <script>

            function eliminar() {

                $(\"#textoConfirmacion\").html('¿Estás seguro de que deseas eliminar esta reserva?');
        
                $('#botonConfirmar').click(function() {
                    location.href='index.php?action=eliminarReserva&id=' + $reserva->id;
                });
                $('#botonCancelar').click(function() {
                    $('#fondo').hide();
                    $('#divConfirmacion').hide();
                });
                
                $('#fondo').show();
                $('#divConfirmacion').show();

            }

            cambiarImagen()

            function cambiarImagen() {
                $('#imgInstalacion').attr('src','img/instalaciones/'+$('#instalacion').val()+'.jpg');
            }

        </script>";