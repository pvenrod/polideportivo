<?php

    $contador = 0;

    echo "<div id='divContenedor'>
            <span id='titulo'>GESTIÓN DE USUARIOS</span>
            <table>";


    foreach ($data["usuarios"] as $usuario) {

        if ($contador % 3 == 0) {
            echo "<tr>";
        }

        echo "<td style='position: relative'>
                <div class='elemento' onmouseover='$(\"#$usuario->id\").show()' onmouseout='$(\"#$usuario->id\").hide()'>
                    <span onmouseover='$(\"#$usuario->id\").show()' >$usuario->usuario</span>
                </div>
                <div class='elementoDetalles' id='$usuario->id' onmouseover='$(\"#$usuario->id\").show()' onmouseout='$(\"#$usuario->id\").hide()'>
                    <img src='$usuario->imagen'><br>
                    <form enctype='multipart/form-data' autocomplete='off' action='index.php' method='post' id='form$usuario->id'>
                        <table>
                            <tr style='height: 10px;'></tr>
                            <tr>
                                <th><strong>Usuario:</strong></th>
                                <td><input type='text' name='usuario' value='$usuario->usuario' readonly class='inputSinEscribir' id='$usuario->id-1'></td>
                            </tr>
                            <tr style='height: 10px;'></tr>
                            <tr>
                                <th><strong>Email:</strong></th>
                                <td><input type='text' name='email' value='$usuario->email' readonly class='inputSinEscribir' id='$usuario->id-2'></td></td>
                            </tr>
                            <tr style='height: 10px;'></tr>
                            <tr>
                                <th><strong>Nombre completo:</strong></th>
                                <td>
                                    <input type='text' name='nombre' value='$usuario->nombre' readonly class='inputSinEscribir' id='$usuario->id-3'>
                                    <input type='text' name='apellido1' value='$usuario->apellido1' readonly class='inputSinEscribir' id='$usuario->id-4'>
                                    <input type='text' name='apellido2' value='$usuario->apellido2' readonly class='inputSinEscribir' id='$usuario->id-5'>
                                </td>
                            </tr>
                            <tr style='height: 10px;'></tr>
                            <tr>
                                <th><strong>DNI:</strong></th>
                                <td><input type='text' name='dni' value='$usuario->dni' readonly class='inputSinEscribir' id='$usuario->id-6'></td>
                            </tr>
                            <tr style='height: 10px;'></tr>
                            <tr id='trImagen$usuario->id' style='display: none'>
                                <th><strong>Imagen de perfil:</strong></th>
                                <td>
                                    <input type='file' name='imagen' class='inputSinEscribir' id='$usuario->id-3'>
                                </td>
                            </tr>
                            <tr style='height: 10px;'></tr>
                            <tr>
                                <th><button type='button' class='botonModificar' onclick='modificar($usuario->id)' id='modificar$usuario->id'>Modificar</button></th>
                                <td><button type='button' class='botonEliminar' onclick='eliminar($usuario->id)'>Eliminar</button></td>
                            </tr>
                        </table>
                        <input type='hidden' name='action' value='modificarUsuario'>
                        <input type='hidden' name='id' value='$usuario->id'>
                    </form>
                </div>
            </td>";


        $contador++;

        if ($contador % 3 == 0) {
            echo "</tr>";
        }

    }

    echo    "</table>
        </div>
        <div id='fondo'></div>
        <div id='divConfirmacion'>
            <span>¿Estás seguro de que deseas eliminar este usuario?</span>
            <br>
            <button id='botonConfirmar'>Confirmar</button>
            <button id='botonCancelar'>Cancelar</button>
        </div>
        
        <script>


            function modificar(idUsuario) {
                $('#modificar'+idUsuario).removeClass('botonModificar');
                $('#modificar'+idUsuario).addClass('botonGuardar');
                $('#modificar'+idUsuario).html('Guardar');
                $('#modificar'+idUsuario).attr('onclick','guardar(' + idUsuario + ')');
                $('#trImagen'+idUsuario).show();

                for (i=1; i<=6; i++) {

                    $('#' + idUsuario + '-' + i).removeClass('inputSinEscribir');
                    $('#' + idUsuario + '-' + i).addClass('inputEscribir');
                    $('#' + idUsuario + '-' + i).attr('readonly',false);

                }
            }

            function guardar(idForm) {
                $('#form'+idForm).submit();
            }

            function eliminar(idBoton) {
                $('#botonConfirmar').click(function() {
                    location.href='index.php?action=eliminarUsuario&id=' + idBoton;
                })
                
                $('#fondo').show();
                $('#divConfirmacion').show();
            }

        </script>";