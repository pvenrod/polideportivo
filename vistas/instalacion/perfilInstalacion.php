<?php

    $instalacion = $data["instalacion"][0];
    $horario = $data["horarios"];

    echo "<div id='divContenedor' style='width: 600px'>
            <span id='titulo'>$instalacion->nombre</span>
            <table id='tablaPrincipal'>
                <tr>
                    <td>
                        <table class='tituloTablaPerfil'>
                            <tr>
                                <td><span><strong>Información de la instalación</strong></td>
                            </tr>
                        </table>
                                <table id='perfil'>
                                    <form action='index.php' method='post' autocomplete='off' enctype='multipart/form-data'>
                                    <tr style='height: 20px'></tr>
                                    <tr>
                                        <td>
                                            <img src='$instalacion->imagen'>
                                        </td>
                                        <td style='padding-left: 20px; padding-top: 20px;'>
                                            <table>
                                                <tr>
                                                    <td>
                                                        Nombre:<br>
                                                        <input type='text' id='nombre' class='oculto' value='$instalacion->nombre' name='nombre' title='Doble click para editar' readonly ondblclick='activar(this.id)'>
                                                    </td>
                                                </tr>
                                                <tr style='height: 10px'></tr>
                                                <tr>
                                                    <td>
                                                        Precio por hora:<br>
                                                        <input type='number' id='precioHora' step='0.1' class='oculto' value='$instalacion->precioHora' name='precioHora' title='Doble click para editar' readonly ondblclick='activar(this.id)'>
                                                    </td>
                                                </tr>
                                                <tr style='height: 10px''></tr>
                                                <input type='hidden' name='action' value='modificarInstalacion'>
                                                <input type='hidden' name='id' value='$instalacion->id'>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr style='height: 20px'></tr>
                                    <tr>
                                        <td colspan='2'>
                                            Descripción:<br>
                                            <textarea id='descripcion' style='resize: none; width: 100%;' class='oculto' name='descripcion' readonly ondblclick='activar(this.id)'>$instalacion->descripcion</textarea> 
                                        </td>
                                    </tr>
                                    <tr style='height: 50px'></tr>
                                    <tr>
                                        <td colspan='2'>
                                            Nueva imagen: <br>
                                            <img src='$instalacion->imagen' style='width: 30px; height: 30px; box-shadow: none; vertical-align: middle'>
                                            <input type='file' name='imagen' id='imagen' title='Doble click para editar' onclick='activar(this.id)'>
                                        </td>
                                    </tr>
                                    <tr style='height: 20px'></tr>
                                    <tr>
                                        <th><button id='botonGuardar' class='botonGuardar' onclick='guardar($instalacion->id)' style='display: none'>Guardar</button></th>
                                        <td><button type='button' class='botonEliminar' onclick='eliminar($instalacion->id)'>Eliminar instalación</button></td>
                                    </tr>
                                    </form>
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

                $(\"#textoConfirmacion\").html('¿Estás seguro de que deseas eliminar \"<strong>$instalacion->nombre</strong>\"?');
        
                $('#botonConfirmar').click(function() {
                    location.href='index.php?action=eliminarInstalacion&id=' + $instalacion->id;
                });
                $('#botonCancelar').click(function() {
                    $('#fondo').hide();
                    $('#divConfirmacion').hide();
                });
                
                $('#fondo').show();
                $('#divConfirmacion').show();

            }

            $(document).ready(function() {

                for (i=0; i<24; i++) {

                    
                    $('select').append('<option value=\"' + i + '\">' + i + '</option>');
                    
                    $('select').attr('onclick','activar(this.id)');

                }

            });

        </script>";