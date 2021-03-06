<?php

    $contador = 0;
    $horariosHoy = $data["horarios"];

    echo "<div id='divContenedor'>
            <span id='titulo'>GESTIÓN DE INSTALACIONES</span>
            <form action='index.php' method='get' id='ordenar'>
                <select name='criterio' onchange='$(\"#ordenar\").submit()' id='criterio'>
                    <option value='id'>Ordenar por id</option>
                    <option value='nombre'>Ordenar por nombre</option>
                    <option value='precioHora'>Ordenar por precio/hora</option>
                </select>
                <input type='hidden' name='action' value='ordenarInstalaciones'>
            </form>
            <form action='index.php' method='get' id='buscador' autocomplete='off'>
                <input type='text' name='texto' placeholder='Nombre, descripción...'>
                <input type='hidden' name='action' value='buscarInstalacion'>
                <button><img src='img/lupa.png'></button>
            </form>
            <table>";

    if (count($data["instalaciones"]) == 0) {

        echo "<tr>
                <td>
                    <div class='elemento no-linea'>
                        <p>No se ha encontrado ninguna instalación.</p>
                        <button class='nuevo-usuario' onclick='$(\"#nuevo\").show();$(\"#fondo\").show()'>Nueva instalación</button>
                    </div>
                </td>
            </tr>";

    } else {

        foreach ($data["instalaciones"] as $instalacion) {

            $horario = $horariosHoy[array_search($instalacion->id, array_column($horariosHoy,'idInstalacion'))];

            if ($contador % 3 == 0) {
                echo "<tr>";
            }
    
            echo "<td style='position:relative'>
                    <div class='elemento' onclick='instalacion($instalacion->id)' onmouseover='$(\"#$instalacion->id\").slideDown(200);$(\"#nuevo\").hide();cargarImagen($instalacion->id)' onmouseout='$(\"#$instalacion->id\").hide()'>
                        <span onmouseover='$(\"#$instalacion->id\").show();$(\"#nuevo\").hide();cargarImagen($instalacion->id)' >$instalacion->nombre</span>
                    </div>
                    <div class='elementoDetalles' id='$instalacion->id' onmouseover='$(\"#$instalacion->id\").show();$(\"#nuevo\").hide()' onmouseout='$(\"#$instalacion->id\").hide()'>
                        <img src='img/instalaciones/default.jpg' id='imagen$instalacion->id'><br>
                            <form enctype='multipart/form-data' autocomplete='off' action='index.php' method='post'>
                                <table style='width: 70%'>
                                    <tr style='height: 10px;'></tr>
                                    <tr>
                                        <th style='width: 50%'><strong>Nombre:</strong></th>
                                        <td style='width: 50%'><input type='text' name='usuario' value='$instalacion->nombre' readonly class='inputSinEscribir'></td>
                                    </tr>
                                    <tr style='height: 10px;'></tr>
                                    <tr>
                                        <th style='width: 50%'><strong>Horario hoy:</strong></th>
                                        <td style='width: 50%'><input type='text' name='usuario' value='De $horario->hora_inicio a $horario->hora_fin' readonly class='inputSinEscribir'></td>
                                    </tr>
                                    <tr style='height: 10px;'></tr>
                                    <tr>
                                        <th style='width: 50%'><strong>Precio por hora:</strong></th>
                                        <td style='width: 50%'><input type='text' name='usuario' value='$instalacion->precioHora €' readonly class='inputSinEscribir'></td>
                                    </tr>
                                    <tr style='height: 10px;'></tr>
                                    <tr id='trImagen$instalacion->id' style='display: none'>
                                        <th><strong>Imagen de perfil:</strong></th>
                                        <td>
                                            <input type='file' name='imagen' class='inputSinEscribir' id='$instalacion->id-3'>
                                        </td>
                                    </tr>
                                    <tr style='height: 10px;'></tr>
                                    <tr>
                                        <th><button type='button' class='botonModificar' onclick='instalacion($instalacion->id)'>Ver perfil</button></th>
                                        <td><button type='button' class='botonEliminar' onclick='eliminar($instalacion->id)'>Eliminar</button></td>
                                    </tr>
                                </table>
                                <input type='hidden' name='action' value='modificarUsuario'>
                                <input type='hidden' name='id' value='$instalacion->id'>
                            </form>
                    </div>
                </td>";
    
    
            $contador++;
    
            if ($contador % 3 == 0) {
                echo "</tr>";
            }
    
        }
        
    }
    

        echo    "<tr>
                    <td style='position: relative' colspan='3'>
                        <div class='elemento no-linea' style='background-color: transparent;padding: 10px 0px 10px 0px;'>
                            <button class='nuevo-usuario' onclick='$(\"#nuevo\").show();$(\"#fondo\").show()'>Nueva instalación</button>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id='fondo'></div>
        <div class='nuevo-usuario-div' id='nuevo'>
            <table class='tituloTablaPerfil'>
                <tr>
                    <td><span style='margin-left: -40px'><strong>Información de la instalación</strong></span></td>
                </tr>
            </table>
            <table>
                <form action='index.php' method='post' autocomplete='off' enctype='multipart/form-data'>
                <tr style='height: 20px'></tr>
                <tr>
                    <td>
                        <img src='img/instalaciones/default.jpg'>
                    </td>
                    <td style='padding-left: 20px; padding-top: 20px;'>
                        <table>
                            <tr>
                                <td>
                                    Nombre:<br>
                                    <input required type='text' id='usuario' name='nombre'>
                                </td>
                            </tr>
                            <tr style='height: 10px'></tr>
                            <tr>
                                <td>
                                    Precio por hora (€):<br>
                                    <input type='number' name='precioHora'></textarea>
                                </td>
                            </tr>
                            <tr style='height: 10px''></tr>
                        </table>
                    </td>
                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <td colspan='2'>
                        Descripción:<br>
                        <textarea name='descripcion' style='width: 100%; height: 60px;'></textarea> 
                    </td>
                </tr>
                <tr style='height: 20px'></tr>
                <tr>

                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <td>
                        Horario Lunes: <br>
                        <span style='font-size: 17px;'>De </span>
                        <select name='d1'>
                        </select>
                        <span style='font-size: 17px;'>a </span>
                        <select name='d2'>
                        </select>
                    </td>
                    <td>
                        Horario Martes: <br>
                        <span style='font-size: 17px;'>De </span>
                        <select name='d3'>
                        </select>
                        <span style='font-size: 17px;'>a </span>
                        <select name='d4'>
                        </select>
                    </td>
                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <td>
                        Horario Miércoles: <br>
                        <span style='font-size: 17px;'>De </span>
                        <select name='d5'>
                        </select>
                        <span style='font-size: 17px;'>a </span>
                        <select name='d6'>
                        </select>
                    </td>
                    <td>
                        Horario Jueves: <br>
                        <span style='font-size: 17px;'>De </span>
                        <select name='d7'>
                        </select>
                        <span style='font-size: 17px;'>a </span>
                        <select name='d8'>
                        </select>
                    </td>
                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <td>
                        Horario Viernes: <br>
                        <span style='font-size: 17px;'>De </span>
                        <select name='d9'>
                        </select>
                        <span style='font-size: 17px;'>a </span>
                        <select name='d10'>
                        </select>
                    </td>
                    <td>
                        Horario Sábado: <br>
                        <span style='font-size: 17px;'>De </span>
                        <select name='d11'>
                        </select>
                        <span style='font-size: 17px;'>a </span>
                        <select name='d12'>
                        </select>
                    </td>
                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <td>
                        Horario Domingo: <br>
                        <span style='font-size: 17px;'>De </span>
                        <select name='d13'>
                        </select>
                        <span style='font-size: 17px;'>a </span>
                        <select name='d14'>
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr style='height: 50px'></tr>
                <tr>
                    <td colspan='2'>
                        Imagen de la instalación: <br>
                        <img src='img/instalaciones/default.jpg' style='width: 30px; height: 30px; box-shadow: none; vertical-align: middle'>
                        <input type='file' name='imagen' id='imagen' title='Doble click para editar' onclick='activar(this.id)'>
                    </td>
                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <th><button class='botonModificar'>Crear</button></th>
                    <td><button type='button' class='botonEliminar' onclick='$(\"#nuevo\").hide();$(\"#fondo\").hide()'>Cancelar</button></td>
                </tr>
                <input type='hidden' name='action' value='crearInstalacion'>
                </form>
            </table>
        </div>
        <div id='divConfirmacion'>
            <span>¿Estás seguro de que deseas eliminar esta instalación?</span>
            <br>
            <button id='botonConfirmar'>Confirmar</button>
            <button id='botonCancelar'>Cancelar</button>
        </div>
        
        <script>


            function instalacion(idUsuario) {
                location.href=\"index.php?action=instalacion&id=\"+idUsuario;
            }

            function guardar(idForm) {
                $('#form'+idForm).submit();
            }

            function eliminar(idBoton) {
                $('#botonConfirmar').click(function() {
                    location.href='index.php?action=eliminarInstalacion&id=' + idBoton;
                });
                $('#botonCancelar').click(function() {
                    $('#fondo').hide();
                    $('#divConfirmacion').hide();
                });
                
                $('#fondo').show();
                $('#divConfirmacion').show();
            }

            function cargarImagen(id) {
                $.get('index.php?action=cargarImagenInstalacion&id='+id, function( data ) {
                    $('#imagen'+id).attr('src',data);
                });
            }

            cambiarSelect = function() {";

            if (isset($_REQUEST["criterio"])) {
                    echo "var criterio ='" . $_REQUEST["criterio"] . "'";
                } else {
                    echo "var criterio = 'id'";
                }
                
            echo "
                var optionsCriterio = document.getElementById('criterio').getElementsByTagName('option');

                for (i=0; i<optionsCriterio.length; i++) {
                    if (optionsCriterio[i].value == criterio) {
                        optionsCriterio[i].setAttribute('selected','selected')
                        
                    }
                }

                
            }

            setTimeout(cambiarSelect,10);


            $(document).ready(function() {

                for (i=0; i<24; i++) {

                    $('select').append('<option value=\"' + i + '\">' + i + '</option>');

                }

                $('select#criterio').html('<option value=\"id\">Ordenar por id</option><option value=\"nombre\">Ordenar por nombre</option><option value=\"precioHora\">Ordenar por precio/hora</option>')

            });

        </script>";