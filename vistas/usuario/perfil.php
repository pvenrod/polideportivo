<?php

    $usuario = $data["usuario"][0];

    echo "<div id='divContenedor'>
            <span id='titulo'>Perfil de $usuario->usuario</span>
            <table id='tablaPrincipal'>
                <tr>
                    <td>
                        <div class='perfilInfo'>
                            <table id='perfil'>
                                <tr>
                                    <td style='font-size: 22px'><strong>Información personal</strong></td>
                                </tr>
                                <tr style='height: 20px'></tr>
                                <tr>
                                    <td>
                                        <img src='$usuario->imagen'>
                                    </td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <input type='text' value='$usuario->usuario' name='usuario'>
                                                </td>
                                            </tr>
                                            <tr style='height: 10px'></tr>
                                            <tr>
                                                <td>
                                                    <input type='text' value='$usuario->nombre' name='nombre'> 
                                                    <input type='text' value='$usuario->apellido1' name='apellido1'> 
                                                    <input type='text' value='$usuario->apellido2' name='apellido2'>
                                                </td>
                                            </tr>
                                            <tr style='height: 10px''></tr>
                                            <tr>
                                                <td>
                                                    <input type='text' value='$usuario->email' name='email'>
                                                </td>
                                            </tr>
                                            <tr style='height: 10px''></tr>
                                            <tr>
                                                <td>
                                                    <input type='text' value='' name='contrasenya' placeholder='Nueva contraseña...'>
                                                </td>
                                            </tr>
                                            <tr style='height: 10px''></tr>
                                            <tr>
                                                <td>
                                                    <input type='text' value='$usuario->dni' name='dni'>
                                                </td>
                                            </tr>
                                            <tr style='height: 10px''></tr>
                                            <tr>
                                                <td>
                                                    <select name='roles[]' multiple>";

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
                                                    
    echo                                            "</select>
                                                </td>
                                            </tr>
                                            
                                        </table>
                                    </td>
                                </tr>
                                <tr style='height: 20px'></tr>
                                <tr>
                                    <th><button type='button' class='botonGuardar' onclick='guardar($usuario->id)'>Guardar</button></th>
                                    <td><button type='button' class='botonEliminar' onclick='eliminar($usuario->id)'>Eliminar</button></td>
                                </tr>
                            </table>
                        </div>
                    </td>
                    <td>
                        <div class='perfilReservas'>
                            <table id='reservas'>
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
            <span>¿Estás seguro de que deseas eliminar a $usuario->usuario?</span>
            <br>
            <button id='botonConfirmar'>Confirmar</button>
            <button id='botonCancelar'>Cancelar</button>
        </div>";