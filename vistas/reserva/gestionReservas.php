<?php

    $instalaciones = $data["instalaciones"];
    $reservas = $data["reservas"];
    $idUsuario = $data["idUsuario"];
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
                        $diaMes1BucleString;
                        for ($i=1; $i<=7*5; $i++) {

                            if ($i>=$primerDiaSemanaMes1) {
                                if ($diaMes1Bucle <= $diasTotalesMes1) {
                                    if ($diaMes1Bucle < 10) {
                                        $diaMes1BucleString = "0".$diaMes1Bucle;
                                    } else {
                                        (int)$diaMes1BucleString++;
                                    }
                                    if ($diaMes1Bucle == $hoyMes) {
                                        echo "<td style='background-color: blue; color: white' onmouseenter='$(\"#div1$diaMes1Bucle\").show(); buscarReservas(\"$anyo1-$mes1-$diaMes1BucleString\",\"td1$diaMes1Bucle\");' id='td1$diaMes1Bucle' onmouseleave='$(\"#div1$diaMes1Bucle\").hide();'>
                                                <span style='cursor: pointer;' onclick='mostrarReservas(\"$anyo1-$mes1-$diaMes1BucleString\")'>$diaMes1Bucle </span>
                                                <div style='position: relative; display: none;' id='div1$diaMes1Bucle'>
                                                    <img src='img/mas.png' class='nuevaReserva' title='Nueva reserva' id='$anyo1-$mes1-$diaMes1BucleString' onclick='nuevaReserva(this.id)'>
                                                </div>
                                            </td>";
                                    } else {
                                        
                                        if ($diaMes1Bucle<$hoyMes) {
                                            echo "<td style='background-color: #989898; cursor: not-allowed; border: 1px solid white;' onmouseenter='$(\"#div1$diaMes1Bucle\").show();' onmouseleave='$(\"#div1$diaMes1Bucle\").hide();'>
                                                    $diaMes1Bucle 
                                            </td>";
                                        } else {
                                            echo "<td onmouseenter='$(\"#div1$diaMes1Bucle\").show(); buscarReservas(\"$anyo1-$mes1-$diaMes1BucleString\",\"td1$diaMes1Bucle\");' id='td1$diaMes1Bucle' onmouseleave='$(\"#div1$diaMes1Bucle\").hide();' style='position:relative; ";

                                            foreach($reservas as $reserva) {

                                                $fecha = strtotime($reserva->fecha);
                                                if ($anyo1 == date('Y', $fecha) && $diaMes1Bucle == date('d', $fecha) && $mes1 == date('n', $fecha)) {
                                                    echo "background-color: #c2deea;";
                                                }
                
                                            }

                                            echo "'>
                                                    <span style='cursor: pointer;' onclick='mostrarReservas(\"$anyo1-$mes1-$diaMes1BucleString\")'>$diaMes1Bucle </span>
                                                    <div style='position: relative; display: none;' id='div1$diaMes1Bucle'>
                                                        <img src='img/mas.png' class='nuevaReserva' title='Nueva reserva' id='$anyo1-$mes1-$diaMes1BucleString' onclick='nuevaReserva(this.id)'>
                                                    </div>
                                            </td>";
                                        }

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
                    $diaMes2BucleString;
                    $mes2String;
                    for ($i=1; $i<=7*5; $i++) {
                
                        if ($i>=$primerDiaSemanaMes2) {
                            if ($diaMes2Bucle <= $diasTotalesMes2) {

                                if ($diaMes2Bucle < 10) {
                                    $diaMes2BucleString = "0".$diaMes2Bucle;
                                } else {
                                    (int)$diaMes2BucleString++;
                                }
                                if ($mes2 < 10) {
                                    $mes2String = "0".$mes2;
                                } else {
                                    (int)$mes2String++;
                                }
                                echo "<td onmouseenter='$(\"#div2$diaMes2Bucle\").show(); buscarReservas(\"$anyo2-$mes2String-$diaMes2BucleString\",\"td2$diaMes2Bucle\");' id='td2$diaMes2Bucle' onmouseleave='$(\"#div2$diaMes2Bucle\").hide();' ";

                                foreach($reservas as $reserva) {

                                    $fecha = strtotime($reserva->fecha);
                                    if ($anyo2 == date('Y', $fecha) && $diaMes2Bucle == date('d', $fecha) && $mes2 == date('n', $fecha)) {
                                        echo "style='background-color: #c2deea; cursor: pointer;'";
                                    }
    
                                }

                                echo ">
                                        <span style='cursor: pointer;' onclick='mostrarReservas(\"$anyo2-$mes2String-$diaMes2BucleString\")'>$diaMes2Bucle </span>
                                        <div style='position: relative; display: none;' id='div2$diaMes2Bucle'>
                                            <img src='img/mas.png' class='nuevaReserva' title='Nueva reserva' id='$anyo2-$mes2String-$diaMes2BucleString' onclick='nuevaReserva(this.id)'>
                                        </div>
                                </td>";
                                
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
                    <td><span><strong>Nueva reserva</strong></td>
                </tr>
            </table>
            <table id='tablaNuevaReserva'>
                <form action='index.php' method='post' autocomplete='off' enctype='multipart/form-data'>
                <tr style='height: 20px'></tr>
                <tr>
                    <td>Fecha:</td>
                    <td><input type='date' name='fecha' id='fechaInput'></td>
                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <td>Instalación:</td>
                    <td>
                        <select name='instalacion' style='width: 100%; padding: 8px' onchange='cambiarImagen()' id='instalacion'>";
                            
                            foreach ($instalaciones as $instalacion) {
                                echo "<option value='$instalacion->id'>$instalacion->nombre</option>";
                            }

    echo                "</select><br>
                        <img id='imgInstalacion' src='img/instalaciones/1.jpg' style='width: 100%; height: auto; position: relative; left: 50%; transform: translateX(-50%); border-radius: 0px; margin-top: 10px; box-shadow: 0px 5px 5px black;'>
                    </td>
                </tr>
                <tr style='height: 20px'></tr>
                <tr>
                    <th><button class='botonModificar'>Crear</button></th>
                    <td><button type='button' class='botonEliminar' onclick='$(\"#nuevo\").hide();$(\"#fondo\").hide()'>Cancelar</button></td>
                </tr>
                <input type='hidden' name='action' value='crearReserva'>
                <input type='hidden' name='idUsuario' value='$idUsuario'>
                </form>
            </table>
        </div>
        <div id='divReservasDeUnDia'>
            <span id='tituloReservas'></span>
            <img src='img/cruz.png' class='cerrar' title='Cerrar' onclick='quitarMostrarReserva()'>
            <img src='img/mas.png' class='nuevaReservaVentana2' title='Nueva reserva' onclick='nuevaReserva(this.id)'>
            <table id='tablaReservasDeUnDia'>
                <tr style='margin-bottom: 20px;'>
                    <th>Hora</th>
                    <th>Precio</th>
                    <th>Instalación</th>
                    <th colspan='2'>Acciones</th>
                </tr>
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

            function nuevaReserva(fecha) {

                $(\".nuevo-usuario-div\").slideDown('fast'); 
                $(\"#fondo\").show()
                $(\"#fechaInput\").val(fecha);
                $('#divReservasDeUnDia').hide();
                
            }


            function buscarReservas(fecha,td) {
                $.get('index.php?action=numeroReservas&fecha='+fecha, function( data ) {
                    if (parseInt(data)==1) {
                        $('#'+td).attr('title','Hay '+data+' reserva');
                    } else {
                        $('#'+td).attr('title','Hay '+data+' reservas');
                    }
                });
            }

            function mostrarReservas(fecha,td) {
                $.get('index.php?action=buscarReservas&fecha='+fecha, function( data ) {

                    var respuesta = JSON.parse(data);
                    var arrayRespuesta = Object.keys(respuesta);

                        $('#tituloReservas').html('Reservas del ' + fecha);
                        $('.nuevaReservaVentana2').attr('id',fecha);
                        $('#divReservasDeUnDia').slideDown('fast');
                        $('#fondo').show();

                        for (i=0; i<arrayRespuesta.length; i++) {

                            var horaInicio = respuesta[i].horaInicio.substring(0,5);
                            var horaFin = respuesta[i].horaFin.substring(0,5);
                            var precio = respuesta[i].precio;
                            var instalacion = respuesta[i].instalacion;
                            var id = respuesta[i].id;
                            var onclickModificar = '\'index.php?action=vistaModificarReserva&id='+ respuesta[i].id + '\'' ;
                            var onclickEliminar = '\'index.php?action=eliminarReserva&ajax=true&id='+ respuesta[i].id + '\'' ;

                            var trReserva = '<tr id=\"tr'+id+'\">\\n' +
                                                '<td>\\n' +
                                                    'De ' + horaInicio + ' a ' + horaFin + '\\n' + 
                                                '</td>\\n' +
                                                '<td>\\n' +
                                                    precio + '€\\n' + 
                                                '</td>\\n' +
                                                '<td>\\n' +
                                                    instalacion + '\\n' + 
                                                '</td>\\n' +
                                                '<td>\\n' +
                                                    '<button onclick=\"location.href=' + onclickModificar + '\" class=\"modificarReserva\">Modificar reserva</button>\\n' + 
                                                '</td>\\n' +
                                                '<td>\\n' +
                                                    '<button onclick=\"eliminarReserva('+id+')\" class=\"eliminarReserva\">Eliminar reserva</button>\\n' + 
                                                '</td>\\n' +
                                            '</tr>';

                            $('#tablaReservasDeUnDia').append(trReserva)
                            
                        }

            

                });
            }

            function quitarMostrarReserva() {
                $('#divReservasDeUnDia').html('<span id=\"tituloReservas\"></span>\\n' +
                                                '<img src=\"img/cruz.png\" class=\"cerrar\" title=\"Cerrar\" onclick=\"quitarMostrarReserva()\">\\n' +
                                                '<img src=\"img/mas.png\" class=\"nuevaReservaVentana2\" title=\"Nueva reserva\" onclick=\"nuevaReserva(this.id)\">\\n' +
                                                '<table id=\"tablaReservasDeUnDia\">\\n' +
                                                    '<tr style=\"margin-bottom: 20px;\">\\n' +
                                                        '<th>Hora</th>\\n' +
                                                        '<th>Precio</th>\\n' +
                                                        '<th>Instalación</th>\\n' +
                                                        '<th colspan=\"2\">Acciones</th>\\n' +
                                                    '</tr>\\n' +
                                                '</table>');
                $('#divReservasDeUnDia').slideUp('fast');
                $('#fondo').hide();
            }

            function eliminarReserva(id) {
                $.get('index.php?action=eliminarReserva&ajax=true&id='+id, function( data ) {
                    if (data == '1') {
                       $('#tr'+id).slideUp();
                    } else {
                        alert('Ha ocurrido un error borrando la reserva.');
                    }
                })
            }

            function cambiarImagen() {
                $('#imgInstalacion').attr('src','img/instalaciones/'+$('#instalacion').val()+'.jpg');
            }
        </script>";