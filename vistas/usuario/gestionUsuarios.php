<?php

    $contador = 0;

    echo "<div id='divContenedor'>
            <span id='titulo'>GESTIÓN DE USUARIOS</span>
            <form action='index.php' method='post' id='borrados'>";

                if (isset($data["borrados"])) {
                    if ($data["borrados"] == "on") {
                        echo "<input type='checkbox' name='borrados' onclick='$(\"#borrados\").submit()' checked> Mostrar borrados";
                    } else {
                        echo "<input type='checkbox' name='borrados' onclick='$(\"#borrados\").submit()'> Mostrar borrados";
                    }
                } else {
                    echo "<input type='checkbox' name='borrados' onclick='$(\"#borrados\").submit()'> Mostrar borrados";
                }

               
    echo        "<input type='hidden' name='action' value='borrados'>
            </form>
            <form action='index.php' method='post' id='ordenar'>
                <select name='criterio' onchange='$(\"#ordenar\").submit()'>
                    <option value='id'>Ordenar por id</option>
                    <option value='nombre'>Ordenar por nombre</option>
                    <option value='apellido1'>Ordenar por primer apellido</option>
                    <option value='apellido2'>Ordenar por segundo apellido</option>
                    <option value='dni'>Ordenar por DNI</option>
                </select>
                <input type='hidden' name='action' value='ordenar'>
            </form>
            <form action='index.php' method='post' id='buscador' autocomplete='off'>
                <input type='text' name='texto' placeholder='Usuario, nombre, DNI...'>
                <input type='hidden' name='action' value='buscarUsuario'>
                <button><img src='img/lupa.png'></button>
            </form>
            <table>";

    if (count($data["usuarios"]) == 0) {

        echo "<tr>
                <td>
                    <div class='elemento no-linea'>
                        <p>No se ha encontrado ningún usuario.</p>
                        <button class='nuevo-usuario'>Nuevo usuario</button>
                    </div>
                </td>
            </tr>";

    } else {

        foreach ($data["usuarios"] as $usuario) {

            if ($contador % 3 == 0) {
                echo "<tr>";
            }
    
            echo "<td style='position:relative'>";

            if ($usuario->borrado == "si") {
                echo "<div class='elemento elementoBorrado' onclick='perfil($usuario->id)' onmouseover='$(\"#$usuario->id\").show();$(\"#nuevo\").hide();cargarImagen($usuario->id)' onmouseout='$(\"#$usuario->id\").hide()'>";
            } else {
                echo "<div class='elemento' onclick='perfil($usuario->id)' onmouseover='$(\"#$usuario->id\").show();$(\"#nuevo\").hide();cargarImagen($usuario->id)' onmouseout='$(\"#$usuario->id\").hide()'>";
            }
                    
            echo        "<span onmouseover='$(\"#$usuario->id\").show();$(\"#nuevo\").hide();cargarImagen($usuario->id)' >$usuario->usuario</span>
                    </div>";

            if ($usuario->borrado == "si") {
                echo "<div class='elementoDetalles elementoBorrado' id='$usuario->id' onmouseover='$(\"#$usuario->id\").show();$(\"#nuevo\").hide()' onmouseout='$(\"#$usuario->id\").hide()'>";
            } else {
                echo "<div class='elementoDetalles' id='$usuario->id' onmouseover='$(\"#$usuario->id\").show();$(\"#nuevo\").hide()' onmouseout='$(\"#$usuario->id\").hide()'>";
            }

                    
            echo            "<img src='img/usuarios/default.jpg' id='imagen$usuario->id'><br>
                        <form enctype='multipart/form-data' autocomplete='off' action='index.php' method='post'>
                            <table>
                                <tr style='height: 10px;'></tr>
                                <tr>
                                    <th><strong>Usuario:</strong></th>
                                    <td><input type='text' name='usuario' value='$usuario->usuario' readonly class='inputSinEscribir'></td>
                                </tr>
                                <tr style='height: 10px;'></tr>
                                <tr>
                                    <th><strong>Email:</strong></th>
                                    <td><input type='text' name='email' value='$usuario->email' readonly class='inputSinEscribir'></td></td>
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
                                    <th><button type='button' class='botonModificar' onclick='perfil($usuario->id)'>Ver perfil</button></th>
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
        
    }
    

        echo    "<tr>
                    <td style='position: relative' colspan='3'>
                        <div class='elemento no-linea' style='background-color: transparent;padding: 10px 0px 10px 0px;'>
                            <button class='nuevo-usuario' onclick='$(\"#nuevo\").show()'>Nuevo usuario</button>
                        </div>
                        <div class='elementoDetalles' id='nuevo' style='width: 50%'>
                        <img src='img/usuarios/default.jpg'><br>
                        <form enctype='multipart/form-data' autocomplete='off' action='index.php' method='post' id='formNuevo'>
                            <table>
                                <tr style='height: 10px;'></tr>
                                <tr>
                                    <th><strong>Usuario:</strong></th>
                                    <td><input type='text' name='usuario' class='inputEscribir' id='nuevo-1'></td>
                                </tr>
                                <tr style='height: 10px;'></tr>
                                <tr>
                                    <th><strong>Email:</strong></th>
                                    <td><input type='text' name='email' class='inputEscribir' id='nuevo-2'></td></td>
                                </tr>
                                <tr style='height: 10px;'></tr>
                                <tr>
                                    <th><strong>Nombre:</strong><br></th>
                                    <td>
                                        <input type='text' name='nombre' class='inputEscribir' id='nuevo-3'>
                                    </td>
                                </tr>
                                <tr style='height: 10px;'></tr>
                                <tr>
                                    <th><strong>Primer apellido:</strong></th>
                                    <td>
                                        <input type='text' name='apellido1' class='inputEscribir' id='nuevo-4'>
                                    </td>
                                </tr>
                                <tr style='height: 10px;'></tr>
                                <tr>
                                    <th><strong>Segundo apellido:</strong></th>
                                    <td>
                                        <input type='text' name='apellido2' class='inputEscribir' id='nuevo-5'>
                                    </td>
                                </tr>
                                <tr style='height: 10px;'></tr>
                                <tr>
                                    <th><strong>DNI:</strong></th>
                                    <td><input type='text' name='dni' class='inputEscribir' id='nuevo-6'></td>
                                </tr>
                                <tr style='height: 10px;'></tr>
                                <tr id='trImagenNuevo'>
                                    <th><strong>Imagen de perfil:</strong></th>
                                    <td>
                                        <input type='file' name='imagen' class='inputEscribir' id='nuevo-3'>
                                    </td>
                                </tr>
                                <tr style='height: 10px;'></tr>
                                <tr>
                                    <th><button class='botonModificar'>Crear</button></th>
                                    <td><button type='button' class='botonEliminar' onclick='$(\"#nuevo\").hide()'>Cancelar</button></td>
                                </tr>
                            </table>
                            <input type='hidden' name='action' value='crearUsuario'>
                        </form>
                    </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id='fondo'></div>
        <div id='divConfirmacion'>
            <span>¿Estás seguro de que deseas eliminar este usuario?</span>
            <br>
            <button id='botonConfirmar'>Confirmar</button>
            <button id='botonCancelar'>Cancelar</button>
        </div>
        
        <script>


            function perfil(idUsuario) {
                location.href=\"index.php?action=perfil&id=\"+idUsuario;
            }

            function guardar(idForm) {
                $('#form'+idForm).submit();
            }

            function eliminar(idBoton) {
                $('#botonConfirmar').click(function() {
                    location.href='index.php?action=eliminarUsuario&id=' + idBoton;
                });
                $('#botonCancelar').click(function() {
                    $('#fondo').hide();
                    $('#divConfirmacion').hide();
                });
                
                $('#fondo').show();
                $('#divConfirmacion').show();
            }

            function cargarImagen(id) {
                if ($('#imagen'+id).attr('src') == 'img/usuarios/default.jpg') {
                    $.get('index.php?action=cargarImagen&id='+id, function( data ) {
                        $('#imagen'+id).attr('src',data);
                      });
                }
            }

        </script>";