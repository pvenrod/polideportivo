<?php

    $contador = 0;

    echo "<div id='divContenedor' style='overflow: hidden'>
            <span id='titulo'>GESTIÓN DE RESERVAS</span>
            <button id='anterior' class='mesNoDisponible'><</button>
            <button id='siguiente'>></button>
            <table style='width: 200%; position: relative; left: 0px;' id='tablaMaestra'>";

            // ============================== PRIMER MES ===================================

            $hoy = (int)date('w'); // Día actual en la semana (de 1 a 7)
            if ($hoy == 0) $hoy = 7; // Para que los días vayan de 1 (lunes) a 7 (domingo), no de 0 (domingo) a 6 (lunes)
            $hoyMes = (int)date('d'); // Día actual del mes (de 1 a 31)
            $mes1 = (int)date('n'); // Mes actual (número)
            $anyo1 = (int)date('Y'); // Año actual (número)
            $mes1Letra;
            $ultimoDiaMes1;
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

            echo "<tr>
                    <td class='tdMaestro'>
                        <div style='display: inline; width: 100%; float: left;'>
                            <table class='mes'>
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
                        $diaSemana1Bucle = 1;
                        for ($i=1; $i<=7*5; $i++) {

                            if ($i>=$primerDiaSemanaMes1) {
                                if ($diaMes1Bucle <= $diasTotalesMes1) {
                                    if ($diaMes1Bucle == $hoyMes) {
                                        echo "<td style='background-color: blue; color: white;'>$diaMes1Bucle</td>";
                                    } else {
                                        echo "<td>$diaMes1Bucle</td>";
                                    }
                                    
                                    if ($i%7==0) {
                                        echo "</tr><tr>";
                                    }
                                    $diaMes1Bucle++;
                                    $diaSemana1Bucle++;
                                }
                            } else {
                                echo "<td class='diaVacio'></td>";
                            }
                            
                            if ($diaSemana1Bucle%7==0) {
                                $diaSemana1Bucle = 1;
                            }
                            
                        }

                        $ultimoDiaMes1 = $diaSemana1Bucle;

            echo    "</table>
                </td><td style='width: 20px'></td>";


            // ============================== SEGUNDO MES ===================================

            $mes2 = (int)date('m') + 1; //Mes siguiente
            $anyo2 = (int)date('Y'); // Año actual (número)
            if ($mes2 == 13)  {
                $mes2 = 1;
                $anyo2 += 1;
            }
            $mes2Letra;
            switch ($mes2) {
                case 1:
                    $mes2Letra = "Enero";
                break;
                case 2:
                    $mes2Letra = "Febrero";
                break;
                case 3:
                    $mes2Letra = "Marzo";
                break;
                case 4:
                    $mes2Letra = "Abril";
                break;
                case 5:
                    $mes2Letra = "Mayo";
                break;
                case 6:
                    $mes2Letra = "Junio";
                break;
                case 7:
                    $mes2Letra = "Julio";
                break;
                case 8:
                    $mes2Letra = "Agosto";
                break;
                case 9:
                    $mes2Letra = "Septiembre";
                break;
                case 10:
                    $mes2Letra = "Octubre";
                break;
                case 11:
                    $mes2Letra = "Noviembre";
                break;
                case 12:
                    $mes2Letra = "Diciembre";
                break;
            }
            $diasTotalesMes2;
            $primerDiaSemanaMes2 = $ultimoDiaMes1 + 3;
            /*
            $diasTotalesMes2;
             // Si estamos a diciembre, el mes siguiente deberia ser enero.*/

            switch ($mes2) {
                case 1:
                case 3:
                case 5:
                case 7:
                case 8:
                case 10:
                case 12:
                    $diasTotalesMes2 = 31;
                break;
                case 4:
                case 6:
                case 9:
                case 11:
                    $diasTotalesMes2 = 30;
                case 2:
                    $diasTotalesMes2 = 28;
            }

            echo "<td class='tdMaestro' style='padding-left: 40px;'>
                    <div style='display: inline'>
                        <table class='mes'>
                            <tr>
                                <td colspan='7' class='tituloMes'>
                                    $mes2Letra $anyo2
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

                    $diaMes2Bucle = 1;
                    for ($i=1; $i<=7*5; $i++) {
                
                        if ($i>=$primerDiaSemanaMes2) {
                            if ($diaMes2Bucle <= $diasTotalesMes2) {

                                echo "<td>$diaMes2Bucle</td>";
                                
                                if ($i%7==0) {
                                    echo "</tr><tr>";
                                }
                                $diaMes2Bucle++;
                            }
                        } else {
                            echo "<td class='diaVacio'></td>";
                        }
                        
                        
                    }
                echo    "</table>
                    </td>
                </tr>";

            
    echo    "</table>
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

            var pos = 1;

            $('#siguiente').click(function() {
                if (pos==1) {
                    $('#tablaMaestra').css('left', '-102%');
                    $('#siguiente').addClass('mesNoDisponible');
                    $('#anterior').removeClass('mesNoDisponible');
                    pos = 2;
                }
            })

            $('#anterior').click(function() {
                if (pos==2) {
                    $('#tablaMaestra').css('left', '0px');
                    $('#anterior').addClass('mesNoDisponible');
                    $('#siguiente').removeClass('mesNoDisponible');
                    pos = 1;
                }
            })

        </script>";