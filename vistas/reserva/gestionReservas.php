<?php

    $contador = 0;

    echo "<div id='divContenedor'>
            <span id='titulo'>GESTIÓN DE RESERVAS</span>
            <div style='width: 200%; position: relative; left: 0px;'>";

            // ============================== PRIMER MES ===================================

            $hoy = (int)date('w'); // Día actual en la semana (de 1 a 7)
            if ($hoy == 0) $hoy = 7; // Para que los días vayan de 1 (lunes) a 7 (domingo), no de 0 (domingo) a 6 (lunes)
            $hoyMes = (int)date('d'); // Día actual del mes (de 1 a 31)
            $mes1 = (int)date('n'); // Mes actual (número)
            $anyo1 = (int)date('Y'); // Mes actual (número)
            $mes1Letra;
            switch ($mes1) {
                case 1:
                    $mes1Letra = "Enero";
                break;
                case 2:
                    $mes1Letra = "Febrero";
                break;
                case 3:
                    $mes1Letra = "Marzo";
                break;
                case 4:
                    $mes1Letra = "Abril";
                break;
                case 5:
                    $mes1Letra = "Mayo";
                break;
                case 6:
                    $mes1Letra = "Junio";
                break;
                case 7:
                    $mes1Letra = "Julio";
                break;
                case 8:
                    $mes1Letra = "Agosto";
                break;
                case 9:
                    $mes1Letra = "Septiembre";
                break;
                case 10:
                    $mes1Letra = "Octubre";
                break;
                case 11:
                    $mes1Letra = "Noviembre";
                break;
                case 12:
                    $mes1Letra = "Diciembre";
                break;
            }
            $diasTotalesMes1;
            $primerDiaSemanaMes1;
            $picoDias = $hoyMes % 7; 
            $primerDiaSemanaMes1 = $hoy - $picoDias + 1;
            if ($primerDiaSemanaMes1 < 1) $primerDiaSemanaMes1 += 7;
            /*$mes2 = (int)date('m') + 1; //Mes siguiente
            $diasTotalesMes2;
            if ($mes2 == 13) $mes2 = 1; // Si estamos a diciembre, el mes siguiente deberia ser enero.*/

            switch ($mes1) {
                case 1:
                case 3:
                case 5:
                case 7:
                case 8:
                case 10:
                case 12:
                    $diasTotalesMes1 = 31;
                break;
                case 4:
                case 6:
                case 9:
                case 11:
                    $diasTotalesMes1 = 30;
                case 2:
                    $diasTotalesMes1 = 28;
            }

            echo "<table class='mes'>
                    <tr>
                        <td colspan='7' class='tituloMes'>
                            $mes1Letra $anyo1
                        </td>
                    </tr>
                    <tr>
                        <td class='diaMes'>
                            L
                        </td>
                        <td class='diaMes'>
                            M
                        </td>
                        <td class='diaMes'>
                            X
                        </td>
                        <td class='diaMes'>
                            J
                        </td>
                        <td class='diaMes'>
                            V
                        </td>
                        <td class='diaMes'>
                            S
                        </td>
                        <td class='diaMes'>
                            D
                        </td>
                    </tr>
                    <tr>";

            $diaMes1Bucle = 1;
            for ($i=1; $i<=7*5; $i++) {
        
                if ($i>=$primerDiaSemanaMes1) {
                    if ($diaMes1Bucle <= $diasTotalesMes1) {
                        if ($i == $hoyMes) {
                            echo "<td style='background-color: blue; color: white;'>$i</td>";
                        } else {
                            echo "<td>$diaMes1Bucle</td>";
                        }
                        
                        if ($i%7==0) {
                            echo "</tr><tr>";
                        }
                        $diaMes1Bucle++;
                    }
                } else {
                    echo "<td></td>";
                }
                
                
            }

            echo "</table>";


            // ============================== SEGUNDO MES ===================================

            $hoy = (int)date('w'); // Día actual en la semana (de 1 a 7)
            if ($hoy == 0) $hoy = 7; // Para que los días vayan de 1 (lunes) a 7 (domingo), no de 0 (domingo) a 6 (lunes)
            $hoyMes = (int)date('d'); // Día actual del mes (de 1 a 31)
            $mes1 = (int)date('n'); // Mes actual (número)
            $anyo1 = (int)date('Y'); // Mes actual (número)
            $mes1Letra;
            switch ($mes1) {
                case 1:
                    $mes1Letra = "Enero";
                break;
                case 2:
                    $mes1Letra = "Febrero";
                break;
                case 3:
                    $mes1Letra = "Marzo";
                break;
                case 4:
                    $mes1Letra = "Abril";
                break;
                case 5:
                    $mes1Letra = "Mayo";
                break;
                case 6:
                    $mes1Letra = "Junio";
                break;
                case 7:
                    $mes1Letra = "Julio";
                break;
                case 8:
                    $mes1Letra = "Agosto";
                break;
                case 9:
                    $mes1Letra = "Septiembre";
                break;
                case 10:
                    $mes1Letra = "Octubre";
                break;
                case 11:
                    $mes1Letra = "Noviembre";
                break;
                case 12:
                    $mes1Letra = "Diciembre";
                break;
            }
            $diasTotalesMes1;
            $primerDiaSemanaMes1;
            $picoDias = $hoyMes % 7; 
            $primerDiaSemanaMes1 = $hoy - $picoDias + 1;
            if ($primerDiaSemanaMes1 < 1) $primerDiaSemanaMes1 += 7;
            /*$mes2 = (int)date('m') + 1; //Mes siguiente
            $diasTotalesMes2;
            if ($mes2 == 13) $mes2 = 1; // Si estamos a diciembre, el mes siguiente deberia ser enero.*/

            switch ($mes1) {
                case 1:
                case 3:
                case 5:
                case 7:
                case 8:
                case 10:
                case 12:
                    $diasTotalesMes1 = 31;
                break;
                case 4:
                case 6:
                case 9:
                case 11:
                    $diasTotalesMes1 = 30;
                case 2:
                    $diasTotalesMes1 = 28;
            }

            echo "<table class='mes'>
                    <tr>
                        <td colspan='7' class='tituloMes'>
                            $mes1Letra $anyo1
                        </td>
                    </tr>
                    <tr>
                        <td class='diaMes'>
                            L
                        </td>
                        <td class='diaMes'>
                            M
                        </td>
                        <td class='diaMes'>
                            X
                        </td>
                        <td class='diaMes'>
                            J
                        </td>
                        <td class='diaMes'>
                            V
                        </td>
                        <td class='diaMes'>
                            S
                        </td>
                        <td class='diaMes'>
                            D
                        </td>
                    </tr>
                    <tr>";

            $diaMes1Bucle = 1;
            for ($i=1; $i<=7*5; $i++) {
        
                if ($i>=$primerDiaSemanaMes1) {
                    if ($diaMes1Bucle <= $diasTotalesMes1) {
                        if ($i == $hoyMes) {
                            echo "<td style='background-color: blue; color: white;'>$i</td>";
                        } else {
                            echo "<td>$diaMes1Bucle</td>";
                        }
                        
                        if ($i%7==0) {
                            echo "</tr><tr>";
                        }
                        $diaMes1Bucle++;
                    }
                } else {
                    echo "<td></td>";
                }
                
                
            }
            echo "</table>";

            
    echo    "</div>
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