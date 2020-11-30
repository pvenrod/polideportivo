<?php

    $usuario = $data["usuario"][0];

    echo "<div id='divContenedor'>
            <span id='titulo'>Perfil de $usuario->usuario</span>
            <table id='tablaPrincipal'>
                <tr>
                    <td>";

                    if ($usuario->borrado == "si") {
                        echo "<div class='perfilInfo elementoBorrado'>";
                    } else {
                        echo "<div class='perfilInfo'>";
                    }
                            
    echo                "<table class='tituloTablaPerfil'>
                            <tr>
                                <td><span><strong>Información personal</strong></td>
                            </tr>
                        </table>
                                <table id='perfil'>
                                    <form action='index.php' method='post' autocomplete='off' enctype='multipart/form-data'>
                                    <tr style='height: 20px'></tr>
                                    <tr>
                                        <td>
                                            <img src='$usuario->imagen'>
                                        </td>
                                        <td style='padding-left: 20px; padding-top: 20px;'>
                                            <table>
                                                <tr>
                                                    <td>
                                                        Usuario:<br>
                                                        <input type='text' id='usuario' class='oculto' value='$usuario->usuario' name='usuario' title='Doble click para editar' readonly ondblclick='activar(this.id)'>
                                                    </td>
                                                </tr>
                                                <tr style='height: 10px'></tr>
                                                <tr>
                                                    <td>
                                                        Nombre completo:<br>
                                                        <input type='text' id='nombre' class='oculto' value='$usuario->nombre' name='nombre' title='Doble click para editar' readonly ondblclick='activar(this.id)'> <br>
                                                        <div style='height: 5px;'></div>
                                                        <input type='text' id='apellido1' class='oculto' value='$usuario->apellido1' name='apellido1' title='Doble click para editar' readonly ondblclick='activar(this.id)'><br>
                                                        <div style='height: 5px;'> </div>
                                                        <input type='text' id='apellido2' class='oculto' value='$usuario->apellido2' name='apellido2' title='Doble click para editar' readonly ondblclick='activar(this.id)'>
                                                    </td>
                                                </tr>
                                                <tr style='height: 10px''></tr>
                                                <input type='hidden' name='action' value='modificarUsuario'>
                                                <input type='hidden' name='id' value='$usuario->id'>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='height: 20px'></tr>
                                    <tr>
                                        <td>
                                            Email<br>
                                            <input type='text' id='email' class='oculto' value='$usuario->email' name='email' title='Doble click para editar' readonly ondblclick='activar(this.id)'>           
                                        </td>
                                        <td style='padding-left: 20px;'>
                                            Nueva contraseña<br>
                                            <input type='password' id='contrasenya' class='oculto'  value='' name='contrasenya' placeholder='Nueva contraseña...' title='Doble click para editar' readonly ondblclick='activar(this.id)'>
                                        </td>
                                    </tr>
                                    <tr style='height: 20px'></tr>
                                    <tr>
                                        <td>
                                            DNI<br>
                                            <input type='text' id='dni' class='oculto' value='$usuario->dni' name='dni' title='Doble click para editar' readonly ondblclick='activar(this.id)'>           
                                        </td>
                                        <td style='padding-left: 20px;'>
                                            Roles<br>
                                            <div id='roles' ondblclick='activar(this.id)'>
                                                <select name='roles[]' multiple class='oculto' disabled title='Doble click para editar'>";

                                                    $rolesUsuario = array();

                                                    foreach ($data["rolesUsuario"] as $rol) {
                                                        $rolesUsuario[] = $rol->id;
                                                    }

                                                    foreach($data["todosLosRoles"] as $rol) {

                                                        if (in_array($rol->id,$rolesUsuario)) {
                                                            echo "<option value='$rol->id' selected>$rol->nombre</option>";
                                                        } else {
                                                            echo "<option value='$rol->id'>$rol->nombre</option>";
                                                        }

                                                    }
                                            
        echo                                    "</select>
                                            </div>
                                        </td>               
                                    </tr>
                                    <tr style='height: 20px'></tr>
                                    <tr>
                                        <td colspan='2'>
                                            Nueva imagen de perfil: <br>
                                            <img src='$usuario->imagen' style='width: 30px; height: 30px; box-shadow: none; vertical-align: middle'>
                                            <input type='file' name='imagen' id='imagen' title='Doble click para editar' onclick='activar(this.id)'>
                                        </td>
                                    </tr>
                                    <tr style='height: 20px'></tr>
                                    <tr>
                                        <th><button id='botonGuardar' class='botonGuardar' onclick='guardar($usuario->id)' style='display: none'>Guardar</button></th>";
                                        if ($usuario->borrado == "si") {
                                            echo "<td><button type='button' class='botonGuardar' onclick='activarUsuario($usuario->id)'>Activar usuario</button></td>";
                                        } else {
                                            echo "<td><button type='button' class='botonEliminar' onclick='eliminar($usuario->id)'>Eliminar usuario</button></td>";
                                        }
        echo                            "</tr>
                                    </form>
                                </table>
                            </div>
                        </td>
                        <td>
                            <div class='perfilReservas'>
                                <table class='tituloTablaPerfil'>
                                    <tr>
                                        <td><span>Reservas de <strong>$usuario->usuario</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
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
                                                    
            function activar(id) {
                $(\"#botonGuardar\").show();
                $(\"#\"+id).removeClass('oculto');
                $(\"#\"+id).attr('readonly',false);
                $(\"#\"+id).attr('disabled',false);
                $('#roles select').attr('disabled',false);

                if (id=='roles') {

                    $('#roles select').attr('disabled',false);

                    console.log('roles');
                }
            }

            function eliminar() {

                $(\"#textoConfirmacion\").html('¿Estás seguro de que deseas eliminar a <strong>$usuario->usuario</strong>?');
        
                $('#botonConfirmar').click(function() {
                    location.href='index.php?action=eliminarUsuario&id=' + $usuario->id;
                });
                $('#botonCancelar').click(function() {
                    $('#fondo').hide();
                    $('#divConfirmacion').hide();
                });
                
                $('#fondo').show();
                $('#divConfirmacion').show();

            }

            function activarUsuario() {

                $(\"#textoConfirmacion\").html('¿Estás seguro de que deseas activar a <strong>$usuario->usuario</strong>?');

                $('#botonConfirmar').click(function() {
                    location.href='index.php?action=activarUsuario&id=' + $usuario->id;
                });
                $('#botonCancelar').click(function() {
                    $('#fondo').hide();
                    $('#divConfirmacion').hide();
                });
                
                $('#fondo').show();
                $('#divConfirmacion').show();

            }

        </script>";