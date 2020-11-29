<?php

    $usuario = $data["usuario"][0];

    echo "<div id='divContenedor'>
            <span id='titulo'>Perfil de $usuario->usuario</span>
            <table>";
    

        echo    "<tr>
                    
                </tr>
            </table>
        </div>
        <div id='fondo'></div>
        <div id='divConfirmacion'>
            <span>¿Estás seguro de que deseas eliminar este usuario?</span>
            <br>
            <button id='botonConfirmar'>Confirmar</button>
            <button id='botonCancelar'>Cancelar</button>
        </div>";