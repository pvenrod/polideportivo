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
            <form action='index.php' method='get' id='ordenar'>
                <select name='criterio' onchange='$(\"#ordenar\").submit()' id='criterio'>
                    <option value='id'>Ordenar por id</option>
                    <option value='usuario'>Ordenar por usuario</option>
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
                        <button class='nuevo-usuario' onclick='$(\"#nuevo\").show();$(\"#fondo\").show()'>Nuevo usuario</button>
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
                            <table style='width: 70%'>
                                <tr style='height: 10px;'></tr>
                                <tr>
                                    <th style='width: 50%'><strong>Usuario:</strong></th>
                                    <td style='width: 50%'><input type='text' name='usuario' value='$usuario->usuario' readonly class='inputSinEscribir'></td>
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
                            <button class='nuevo-usuario' onclick='$(\"#nuevo\").show();$(\"#fondo\").show()'>Nuevo usuario</button>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div id='fondo'></div>
        <div class='nuevo-usuario-div' id='nuevo'>
            <table class='tituloTablaPerfil'>
                <tr>
                    <td><span><strong>Información personal</strong></td>
                </tr>
            </table>
            <table>
                <form action='index.php' method='post' autocomplete='off' enctype='multipart/form-data'>
                <tr style='height: 20px'></tr>
                <tr>
                    <td>
                        <img src='img/usuarios/default.jpg'>
                    </td>
                    <td style='padding-left: 20px; padding-top: 20px;'>
                        <table>
                            <tr>
                                <td>
                                    Usuario:<br>
                                    <input required type='text' id='usuario' name='usuario'>
                                </td>
                            </tr>
                            <tr style='height: 10px'></tr>
                            <tr>
                                <td>
                                    Nombre completo:<br>
                                    <input required type='text' id='nombre' name='nombre'> <br>
                                    <div style='height: 5px;'></div>
                                    <input required type='text' id='apellido1' name='apellido1'><br>
                                    <div style='height: 5px;'> </div>
                                    <input type='text' id='apellido2' name='apellido2'>
                                </td>
                            </tr>
                            <tr style='height: 10px''></tr>
                        </table>
                    </td>
                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <td>
                        Email<br>
                        <input required type='text' id='email' name='email'>           
                    </td>
                    <td style='padding-left: 20px;'>
                        Contraseña<br>
                        <input required type='password' id='contrasenya' name='contrasenya'>
                    </td>
                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <td>
                        DNI<br>
                        <input required type='text' id='dni' name='dni'>           
                    </td>
                    <td style='padding-left: 20px;'>
                        Roles<br>
                        <select name='roles[]' multiple>
                            <option value='1'>Admin</option>
                            <option value='2' selected>Estándar</option>
                            <option value='3'>Deshabilitado</option>
                        </select>
                    </td>               
                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <td colspan='2'>
                        Imagen de perfil: <br>
                        <img src='img/usuarios/default.jpg' style='width: 30px; height: 30px; box-shadow: none; vertical-align: middle'>
                        <input type='file' name='imagen' id='imagen' title='Doble click para editar' onclick='activar(this.id)'>
                    </td>
                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <th><button class='botonModificar'>Crear</button></th>
                    <td><button type='button' class='botonEliminar' onclick='$(\"#nuevo\").hide();$(\"#fondo\").hide()'>Cancelar</button></td>
                </tr>
                <input type='hidden' name='action' value='crearUsuario'>
                </form>
            </table>
        </div>
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



        </script>";