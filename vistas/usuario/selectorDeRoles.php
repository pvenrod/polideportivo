<form action='index.php' method='post' id='formularioIniciarSesion' style="height: 180px;">
    <span>SELECCIONA EL ROL DESEADO</SPAN><br>
    <select name="rol">
        <?php

            foreach ($data["roles"] as $rol) {

                echo "<option value='$rol->id'>$rol->nombre</option>";

            }

        ?>
    </select><br>
    <input type='hidden' name='action' value='procesarSeleccionDeRol'>
    <input type='submit' value='Acceder al sistema'>

<?php
    if (isset($data["msjError"])) {

        echo "<p style='color: red'>" . $data["msjError"] . "</p>";

    }

    if (isset($data["msjInfo"])) {

        echo "<p style='color: blue'>" . $data["msjError"] . "</p>";

    }
?>

</form>